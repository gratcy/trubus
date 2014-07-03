<?php
require APPPATH."third_party/MX/Config.php";

class MY_Config extends MX_Config {
	
	function __construct() {
		parent::__construct();
	}
	
	function set_custom_config_path($path) {
		array_push($this->_config_paths, $path);
	}
}