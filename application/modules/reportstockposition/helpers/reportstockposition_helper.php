<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function __get_stock_position_book_detail($bid, $branch, $ttype) {
    $CI =& get_instance();
	$CI -> load -> model('reportstockposition/reportstockposition_model');
	$br = $data = $CI -> reportstockposition_model ->__get_stockposition_book_detail($bid, $branch, 1, $ttype);
	$ct = $data = $CI -> reportstockposition_model ->__get_stockposition_book_detail($bid, $branch, 2, $ttype);
	return $br[0] -> total + $ct[0] -> total;
}

function __get_stock_position_book_process($bid, $branch) {
    $CI =& get_instance();
	$CI -> load -> model('reportstockposition/reportstockposition_model');
	$br = $CI -> reportstockposition_model ->__get_stock_book_process($bid, $branch);
	//~ $ct = $CI -> reportstockposition_model ->__get_stock_process($bcid,$bid, 2);
	//~ return $br + $ct;
	return $br;
}

function __get_stock_position_area_detail($bid, $branch, $area, $ttype) {
    $CI =& get_instance();
	$CI -> load -> model('reportstockposition/reportstockposition_model');
	$br = $data = $CI -> reportstockposition_model ->__get_stockposition_area_detail($bid, $branch, $area, $ttype);
	return (int) $br[0] -> total;
}
