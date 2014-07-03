<?php
if (!defined('BASEPATH')) exit( 'Direct access not allowed !!!' );

class Pagination_lib {
	var $adjacents;
	var $row_per_page;
	var $query;
	var $page_name;
	var $total_pages;

	function __construct() {
		$this -> _ci =& get_instance();
	}

	function pagination($query, $adjacents = 3, $row_per_page = 10, $page_name)	{
		$this -> sql = $query;
		$this -> limit = $row_per_page;
		$this -> adjacents = $adjacents;
		$this -> page_name = rtrim($page_name, '/');
		
		$pname = 'http://'.$_SERVER['HTTP_HOST'].rtrim($_SERVER['REQUEST_URI'],'/');
		$pname = str_replace($page_name,'', $pname);
		
		if($pname)
			$this -> page = substr($pname,1);
		else
			$this -> page = '';
	}

	function paginate() {
		$all_rs = $this -> _ci -> db -> query($this -> sql);
		$this -> total_pages = $all_rs -> num_rows();
		
		if ($this -> page) 
			$start = ($this -> page - 1) * $this -> limit;
		else
			$start = 0;
		
		if ($start < 0) $start = 0;
		
		$this -> sql = ''.$this -> sql.' LIMIT '.$start.', '.$this -> limit.'';
		$sql = $this -> _ci -> db -> query($this -> sql);

		return $sql -> result();
	}

	function pages() {
		if ($this -> page == 0) $this -> page = 1;
		$prev = $this -> page - 1;
		$next = $this -> page + 1;
		$lastpage = ceil($this -> total_pages/$this -> limit);
		$lpm1 = $lastpage - 1;

		if($lastpage > 1) {
			$pagination = '<div class="pagination">';
			if ($this -> page > 1) 
				$pagination.= '<a href="'.$this -> page_name.'/'.$prev.'">&laquo; previous</a>';
			else
				$pagination.= '<span class="disabled">&laquo; previous</span>';	

			if ($lastpage < 7 + ($this -> adjacents * 2))	{	
				for ($counter = 1; $counter <= $lastpage; $counter++) {
					if ($counter == $this -> page)
						$pagination.= '<span class="current">'.$counter.'</span>';
					else
						$pagination.= '<a href="'.$this -> page_name.'/'.$counter.'">'.$counter.'</a>';
				}
			}
			elseif($lastpage > 5 + ($this -> adjacents * 2)) {
				if($this -> page < 1 + ($this -> adjacents * 2)) {
					for ($counter = 1; $counter < 4 + ($this -> adjacents * 2); $counter++) {
						if ($counter == $this -> page)
							$pagination.= '<span class="current">'.$counter.'</span>';
						else
							$pagination.= '<a href="'.$this -> page_name.'/'.$counter.'">'.$counter.'</a>';
					}
					$pagination.= '...';
					$pagination.= '<a href="'.$this -> page_name.'/'.$lpm1.'">'.$lpm1.'</a>';
					$pagination.= '<a href="'.$this -> page_name.'/'.$lastpage.'">'.$lastpage.'</a>';
				}
				else if($lastpage - ($this -> adjacents * 2) > $this -> page && $this -> page > ($this -> adjacents * 2)) {
					$pagination.= '<a href="'.$this -> page_name.'/1">1</a>';
					$pagination.= '<a href="'.$this -> page_name.'/2">2</a>';
					$pagination.= '...';
					for ($counter = $this -> page - $this -> adjacents; $counter <= $this -> page + $this -> adjacents; $counter++)	{
						if ($counter == $this -> page)
							$pagination.= '<span class="current">'.$counter.'</span>';
						else
							$pagination.= '<a href="'.$this -> page_name.'/'.$counter.'">'.$counter.'</a>';
					}
					$pagination.= '...';
					$pagination.= '<a href="'.$this -> page_name.'/'.$lpm1.'">'.$lpm1.'</a>';
					$pagination.= '<a href="'.$this -> page_name.'/'.$lastpage.'">'.$lastpage.'</a>';		
				}
				else {
					$pagination.= '<a href="'.$this -> page_name.'/1">1</a>';
					$pagination.= '<a href="'.$this -> page_name.'/2">2</a>';
					$pagination.= '...';
					for ($counter = $lastpage - (2 + ($this -> adjacents * 2)); $counter <= $lastpage; $counter++) {
						if ($counter == $this -> page)
							$pagination.= '<span class="current">'.$counter.'</span>';
						else
							$pagination.= '<a href="'.$this -> page_name.'/'.$counter.'">'.$counter.'</a>';					
					}
				}
			}

			if ($this -> page < $counter - 1) 
				$pagination.= '<a href="'.$this -> page_name.'/'.$next.'">next &raquo;</a>';
			else
				$pagination.= '<span class="disabled">next &raquo;</span>';

			$pagination.= '</div>';
			return $pagination;
		}
	}
}
