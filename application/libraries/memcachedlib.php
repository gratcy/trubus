<?php
class Memcachedlib {
    var $memcached_obj, $sesresult, $_memcache_conf;
	public $login = false;
	private $_ci;

    function __construct() {
		$this -> _ci =& get_instance();
        if (!session_id()) {
            session_name( 'DistPal' );
            session_start();
        }
        
		if ($this -> _ci ->config->load('memcached', TRUE, TRUE))
		{
			if (is_array($this -> _ci->config->config['memcached']))
			{
				$this->_memcache_conf = NULL;

				foreach ($this -> _ci->config->config['memcached'] as $name => $conf)
				{
					$this->_memcache_conf[$name] = $conf;
				}
			}
		}
		
        $this -> ses_id = sha1(md5(session_id())) . session_id();

        $this -> memcached_obj = new Memcache;

        $this -> memcached_obj -> addServer($this->_memcache_conf['default']['hostname'], $this->_memcache_conf['default']['port']);

        $this -> sesresult = self::get('__login');

        self::__check_login();
        self::__save_post();
    }
    
    function __save_post() {
		if (preg_match('/\_update/i',$_SERVER['REQUEST_URI'])) return false;
		if ($_POST && count($_POST) > 0) self::set(__keyTMP($_SERVER['REQUEST_URI']), $_POST, 60);
	}

	function __check_login() {
		$trb = get_cookie('__palma');
		if ($trb) {
			$trb = unserialize($trb);
			
			if (isset($trb['uemail']) && isset($trb['uid']) && isset($trb['ubranchid']) && isset($trb['skey']) == md5(sha1($trb['ugid'].$trb['uemail']) . 'dist'))
				$this -> login = true;
			else
				$this -> login = false;

			$ck = $this -> sesresult;
			if ($this -> login == true && !$ck) {
				$this -> _ci -> load -> model('login/login_model');
				$permission = $this -> _ci -> login_model -> __get_permission($trb['ugid']);
				$trb['permission'] = $permission;
				if ($this -> _ci -> uri -> segment(2) !== 'logout') {
					if ($trb['expire']-time() > 0)
					$this -> add('__login', $trb, $trb['expire']-time(), true);
					else
					redirect(site_url('login/logout'));
				}
			}
		}
		
		if ($this -> _ci -> uri -> segment(1) !== 'login') {
			if (!$this -> login) redirect(site_url('login'));
		}
		else {
			if ($this -> _ci -> uri -> segment(2) !== 'logout') {
				if ($this -> login) redirect(site_url(''));
			}
		}
	}
	
	function add($key, $value, $expiration=false,$keyGlobal=false) {
        if (!$expiration)
            return $this -> memcached_obj -> set(self::set_key($key,$keyGlobal), json_encode($value), MEMCACHE_COMPRESSED);
        else
            return $this -> memcached_obj -> set(self::set_key($key,$keyGlobal), json_encode($value), MEMCACHE_COMPRESSED, $expiration);
	}
	
    function set($key, $value, $expiration=false,$keyGlobal=false) {
        if (!$expiration)
            return $this -> memcached_obj -> set(self::set_key($key,$keyGlobal), json_encode($value), MEMCACHE_COMPRESSED);
        else
            return $this -> memcached_obj -> set(self::set_key($key,$keyGlobal), json_encode($value), MEMCACHE_COMPRESSED, $expiration);
    }

    function get($key,$keyGlobal=false) {
		if ($keyGlobal)
			return json_decode($this -> memcached_obj -> get($key), true);
        else
			return json_decode($this -> memcached_obj -> get($this -> ses_id . $key), true);
    }

    function set_key($key,$keyGlobal) {
		if ($keyGlobal)
			return $key;
        else
			return $this -> ses_id . $key;

    }
    
    function delete($key=false,$keyGlobal=false) {
        if ($key)
            $this -> memcached_obj -> delete(($keyGlobal == true ? '' : $this -> ses_id) . $key);
        else
            $this -> memcached_obj -> flush(1);
    }

	function __regenerate_cache($key,$arr,$time=3600,$keyGlobal=false) {
		self::delete($key, $keyGlobal);
		return self::set($key, $arr, $time, $keyGlobal);
	}
}
