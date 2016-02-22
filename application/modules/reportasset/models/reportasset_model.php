<?php
class Reportasset_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }
    
	function __get_stock_asset($bid) {
		$this -> db -> select("SUM(istock) as totalqty FROM inventory_tab WHERE istatus=1 AND itype=1 AND ibcid=" . $bid);
		$totalQTY = $this -> db -> get() -> result();
		
		$this -> db -> select("SUM(a.istock*b.bprice) as bruto FROM inventory_tab a INNER JOIN books_tab b ON a.ibid=b.bid WHERE a.istatus=1 AND a.itype=1 AND a.ibcid=" . $bid);
		$Bruto = $this -> db -> get() -> result();
		
		return array('total' => $totalQTY[0] -> totalqty, 'bruto' => $Bruto[0] -> bruto);
	}
    
	function __get_stock_customer_asset($bid) {
		$this -> db -> select("SUM(a.istock) as totalqty FROM inventory_tab a INNER JOIN customer_tab b ON a.ibcid=b.cid WHERE a.itype=2 AND (a.istatus=1 OR a.istatus=0) AND b.cbid=" . $bid);
		$totalQTY = $this -> db -> get() -> result();
		
		$this -> db -> select("SUM(a.istock*c.bprice) as bruto FROM inventory_tab a INNER JOIN customer_tab b ON a.ibcid=b.cid INNER JOIN books_tab c ON a.ibid=c.bid WHERE a.itype=2 AND (a.istatus=1 OR a.istatus=0) AND b.cbid=" . $bid);
		$Bruto = $this -> db -> get() -> result();
		
		return array('total' => $totalQTY[0] -> totalqty, 'bruto' => $Bruto[0] -> bruto);
	}
}
