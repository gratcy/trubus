<?php
class Postupper {
    function __construct() {
		if (!preg_match('/'.addcslashes(site_url(),'/').'(login|users|pm|settings)/i', current_url())) {
			foreach($_POST as $K => $v) :
			if (!is_array($_POST[$K])) $_POST[$K] = strtoupper($_POST[$K]);
			endforeach;
		}
    }
}
