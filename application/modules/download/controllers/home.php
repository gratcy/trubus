<?php
/* -*- tab-width: 2; indent-tabs-mode: nil; c-basic-offset: 2 -*- */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller {
	function __construct() {
		parent::__construct();
	}

	function index($file) {
		@ini_set('memory_limit', '-1');
		
		$conf = $this->config->load('upload', TRUE);
		$path = $conf['download']['file'] . $file;

		if (is_file($path) === true) {
			$file = @fopen($path, 'rb');
			$speed = (isset($speed) === true) ? round($speed * 1024) : 524288;

			if (is_resource($file) === true) {
				set_time_limit(0);
				ignore_user_abort(false);

				while (ob_get_level() > 0) {
					ob_end_clean();
				}

				header('Expires: 0');
				header('Pragma: public');
				header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
				header('Content-Type: application/octet-stream');
				header('Content-Length: ' . sprintf('%u', filesize($path)));
				header('Content-Disposition: attachment; filename="' . basename($path) . '"');
				header('Content-Transfer-Encoding: binary');

				while (feof($file) !== true) {
					echo fread($file, $speed);
					while (ob_get_level() > 0) {
						ob_end_flush();
					}
					flush();
					sleep(1);
				}
				fclose($file);
			}
			
			exit();
		}

	}
}
