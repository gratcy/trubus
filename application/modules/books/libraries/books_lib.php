<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Books_lib {
    protected $_ci;

    function __construct() {
        $this->_ci = & get_instance();
        $this->_ci->load->model('books/books_model');
    }
    
    function __get_books($id='') {
		$get_books = $this -> _ci -> memcachedlib -> get('__books_select', true);
		
		if (!$get_books) {
			$books = $this -> _ci -> books_model -> __get_books_select();
			$this -> _ci -> memcachedlib -> set('__books_select', $books, 3600,true);
			$get_books = $this -> _ci -> memcachedlib -> get('__books_select', true);
		}
		
		$res = '<option value=""></option>';
		foreach($get_books as $k => $v)
			if ($id == $v['bid'])
				$res .= '<option value="'.$v['bid'].'" selected>'.$v['btitle'].'</option>';
			else
				$res .= '<option value="'.$v['bid'].'">'.$v['btitle'].'</option>';
		return $res;
	}
	
	
    function __get_books_detail($id='') {
		$books = $this -> _ci -> books_model -> __get_books_detail($id);
		$res = '';
		foreach($books as $k => $v)
			if ($id == $v -> bid)
				$res .= $v -> btitle;
			else
				$res .= $v -> bid.'">'.$v -> btitle;
		return $res;
	}	
	
	
    function __get_books_all($id='') {
		$books = $this -> _ci -> books_model -> __get_books_selectxx();
		$res = '<option value=""></option>';
		foreach($books as $k => $v)
			if ($id == $v -> bid)
				$res .= '<option value="'.$v -> bid.'-'.$v -> bprice.'-'.$v -> bdisc.'" selected>'.$v -> btitle.'-'.$v -> bprice.'-'.$v -> bdisc.'</option>';
			else
				$res .= '<option value="'.$v -> bid.'-'.$v -> bprice.'-'.$v -> bdisc.'">&nbsp;Judul : '.$v -> btitle.' &nbsp;Harga : '.$v -> bprice.' &nbsp;Discount : '.$v -> bdisc.'</option>';
		return $res;
	}	
}
