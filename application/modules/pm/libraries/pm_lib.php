<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pm_lib {
    protected $_ci;

    function __construct() {
        $this->_ci = & get_instance();
        $this->_ci->load->model('pm/pm_model');
    }
}
