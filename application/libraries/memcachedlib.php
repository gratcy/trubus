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

		if (isset($this -> sesresult['uemail']) && isset($this -> sesresult['uid']) && isset($this -> sesresult['ubranchid']) && isset($this -> sesresult['skey']) == md5(sha1($this -> sesresult['ugid'].$this -> sesresult['uemail']) . 'dist'))
			$this -> login = true;
		else
			$this -> login = false;
        self::__check_login();
        self::__save_post();
    }
    
    function __save_post() {
		if (preg_match('/\_update/i',$_SERVER['REQUEST_URI'])) return false;
		if ($_POST && count($_POST) > 0) self::set(__keyTMP($_SERVER['REQUEST_URI']), $_POST, 60);
	}

	function __check_login() {
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

	function __regenerate_cache($key,$arr,$time=3600) {
		self::delete($key);
		return self::set($key, $arr, $time,true);
	}
}
