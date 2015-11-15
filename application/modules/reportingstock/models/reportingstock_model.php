<?php
class Reportingstock_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }

    function __get_transaction_summary(&$arr) {
		$datesort = explode(' - ', $arr['datesort']);
		$dsa = str_replace('/','-',$datesort[0]);
		$dsb = str_replace('/','-',$datesort[1]);

		if($arr['approval'] == 2) $appr = " AND a.approval = 2";
		else $appr = " AND a.approval != 2";

		if(!$arr['customer'] || !$arr['customerr']) $cus = "";
		else $cus = " AND ( REPLACE(b.cname , ' ','')  between REPLACE('".$arr['customer']."', ' ','')  AND REPLACE('".$arr['customerr']."', ' ','') ) ";

		if(!$arr['area'] || !$arr['areax']) $area = "";
		else $area = " AND (c.aid  between ".$arr['area']."  AND ".$arr['areax'].") ";

		if($arr['typeb'] == 'JC') $tpb = "OR a.tnofaktur LIKE 'JC%'";
		else $tpb = "";

		if($arr['typec'] == 'JK') $tpc = "OR a.tnofaktur LIKE 'JK%'";
		else $tpc = "";

		if($arr['typed'] == 'HP') $tpd = "OR a.tnofaktur LIKE 'HP%'";
		else $tpd = "";

		if($arr['typee'] == 'RJC') $tpe = "OR a.tnofaktur LIKE 'RJC%'";
		else $tpe = "";

		if($arr['typef'] == 'RJK') $tpf = "OR a.tnofaktur LIKE 'RJK%'";
		else $tpf = "";

		if($arr['typeg'] == 'RHP') $tpg = "OR a.tnofaktur LIKE 'RHP%'";
		else $tpg = "";

		if($arr['typeh'] == 'BK') $tph = "OR a.tnofaktur LIKE 'BK%'";
		else $tph = "";

		if($arr['typei'] == 'RB') $tpi = "OR a.tnospo LIKE 'RB%' ";
		else $tpi = "";

		if ($arr['typea']) {
			$tpx = "";
		}
		else {
			if (!$arr['typea'] && !$arr['typec'] && !$arr['typed'] && !$arr['typee'] && !$arr['typef'] && !$arr['typeg'] && !$arr['typeh'] && !$arr['typei'])
				$tpx = "";
			else
				$tpx = " AND (a.tnofaktur = '' ".$tpb.$tpc.$tpd.$tpe.$tpf.$tpg.$tph.$tpi.")";
		}
		
		if(!$arr['kode_buku'] || !$arr['kode_bukux']) $kb = "";
		else $kb = " AND d.tbid between ".$arr['kode_buku']." AND ".$arr['kode_bukux']."";

		if(!$arr['publisher'] || !$arr['publisherx'])
			$pub = "";
		else
			$pub = " AND e.bpublisher between ".$arr['publisher']." AND ".$arr['publisherx']."";

		if ($arr['rtype'] == 1 || $arr['rtype'] == 3) {
			$fild = "";
			$groupby = " GROUP BY c.acode";
		}
		else {
			$fild = "e.bcode,e.btitle,d.tharga,";
			$groupby = " GROUP BY e.bcode";
		}

		if($typei == 'RB') {
			$this -> db -> select($fild."c.acode,a.tnofaktur, a.tnospo,a.ttanggal,c.aname, SUM(d.ttharga) as bruto, SUM(d.ttotal) as netto, SUM(d.tqty) as totalqty FROM transaction_tab a INNER JOIN publisher_tab p ON a.tpid=p.pid  INNER JOIN transaction_detail_tab d ON a.tid=d.ttid INNER JOIN books_tab e ON d.tbid=e.bid WHERE a.tstatus!=2 AND (a.ttanggal >= '".$dsa."' AND a.ttanggal <= '".$dsb."') AND a.tbid=".$arr['branchid']."".$appr.$tpx.$pub.$kb.$groupby, FALSE);
			return $this -> db -> get() -> result();
		}
		else {
			$this -> db -> select($fild."a.tnofaktur, a.tnospo,a.ttanggal,b.ccode,b.cname,c.acode, c.aname, SUM(d.ttharga) as bruto, SUM(d.ttotal) as netto, SUM(d.tqty) as totalqty FROM transaction_tab a INNER JOIN customer_tab b ON a.tcid=b.cid INNER JOIN area_tab c ON b.carea=c.aid INNER JOIN transaction_detail_tab d ON a.tid=d.ttid INNER JOIN books_tab e ON d.tbid=e.bid WHERE a.tstatus!=2 AND (a.ttanggal >= '".date('Y-m-d',strtotime($dsa))."' AND a.ttanggal <= '".date('Y-m-d',strtotime($dsb))."') AND a.tbid=".$arr['branchid']."".$appr.$cus.$area.$tpx.$pub.$kb.$groupby, FALSE);
			return $this -> db -> get() -> result();
		}
	}

	function __get_transaction_idx($branch,$approval,$datesorta,$datesortb,$customer,$customerr,$kode_buku,$kode_bukux,$area,$areax,$publisher,$publisherx,$typea,$typeb,$typec,$typed,$typee,$typef,$typeg,$typeh,$typei) {
		if($typeb == 'JC') $tpb = "OR a.tnofaktur LIKE 'JC%'";
		else $tpb = "";
		
		if($typec == 'JK') $tpc = "OR a.tnofaktur LIKE 'JK%'";
		else $tpc = "";
		
		if($typed == 'HP') $tpd = "OR a.tnofaktur LIKE 'HP%'";
		else $tpd = "";
		
		if($typee == 'RJC') $tpe = "OR a.tnofaktur LIKE 'RJC%'";
		else $tpe = "";
		
		if($typef == 'RJK') $tpf = "OR a.tnofaktur LIKE 'RJK%'";
		else $tpf = "";
		
		if($typeg == 'RHP') $tpg = "OR a.tnofaktur LIKE 'RHP%'";
		else $tpg = "";
		
		if($typeh == 'BK') $tph = "OR a.tnofaktur LIKE 'BK%'";
		else $tph = "";
		
		if($typei == 'RB') $tpi = "OR a.tnofaktur LIKE 'RB%'";
		else $tpi = "";
		
		if($tpb == "" && $tpc == "" && $tpd == "" && $tpe == "" && $tpf == "" && $tpg == "" && $tph == "" && $tpi == "") $tpx = "";
		else $tpx = " AND (a.tnofaktur = '' ".$tpb.$tpc.$tpd.$tpe.$tpf.$tpg.$tph.$tpi .")";
		
		if($approval == 2) $appr = " AND a.approval = 2";
		else $appr = " AND a.approval != 2";

		if(!$kode_buku || !$kode_bukux) $kb = "";
		else $kb = " AND b.tbid between '$kode_buku' AND '$kode_bukux' ";

		if(!$customer || !$customerr) $cus = "";
		else $cus = " AND ( REPLACE(c.cname , ' ','')  between REPLACE('".$customer."', ' ','')  AND REPLACE('".$customerr."', ' ','') ) ";

		if(!$area || !$areax) {
			$areaz = "";
			$narea = "(select aname from area_tab f where f.aid=c.carea) AS narea,";
		}
		else {
			$areaz = " AND (f.aname  between '".$area."'  AND '".$areax."') ";
			$narea = " f.aname AS narea, ";
		}

		if(!$publisher || !$publisherx) {
			$pubz = "";
			$spub = "(select pname from publisher_tab e where e.pid=d.bpublisher) AS pname,";
		}
		else {
			$pubz = " AND (d.bpublisher  between '".$publisher."'  AND '".$publisherx."') ";
			$spub = "(select pname from publisher_tab e where e.pid=d.bpublisher) AS pname, ";
		}

		if($typei == 'RB') {
			$this -> db -> select("a.ttanggal,a.tinfo as ket,d.bcode,p.pcode,b.tharga,b.ttharga,b.tdisc,b.ttotal,a.tnospo,a.tnofaktur,b.tid,b.ttid, $spub  b.tqty,b.tbid AS buku ,a.tcid AS customer, a.tbid AS branch,d.bpublisher,p.pname, d.btitle,d.bprice FROM transaction_tab a,transaction_detail_tab b,publisher_tab p,books_tab d 
			WHERE a.tbid='".$branch."' AND (a.ttanggal >= '".date('Y-m-d',strtotime($datesorta))."' AND a.ttanggal <= '".date('Y-m-d',strtotime($datesortb))."')".$appr ." AND a.tstatus !=2  AND a.tid=b.ttid AND a.tpid=p.pid AND b.tbid=d.bid  ".$kb.$pubz.$tpx , FALSE);
			return $this -> db -> get() -> result();
		}
		else {
			$this -> db -> select("a.ttanggal,a.tinfo as ket,d.bcode,c.ccode,b.tharga,b.ttharga,b.tdisc,b.ttotal,a.tnofaktur,b.tid,b.ttid, $spub $narea b.tqty,b.tbid AS buku ,a.tcid AS customer, a.tbid AS branch,d.bpublisher,c.carea,c.cname,d.btitle,d.bprice FROM transaction_tab a,transaction_detail_tab b,customer_tab c,books_tab d , area_tab f
			WHERE a.tbid='".$branch."' AND (a.ttanggal >= '".date('Y-m-d',strtotime($datesorta))."' AND a.ttanggal <= '".date('Y-m-d',strtotime($datesortb))."')".$appr ." AND a.tstatus !=2  AND a.tid=b.ttid AND a.tcid=c.cid AND b.tbid=d.bid AND f.aid=c.carea ".$kb.$cus.$areaz.$pubz.$tpx , FALSE);
			return $this -> db -> get() -> result();
		}
	}

	function __get_transaction_ids($branchid,$date,$customer,$type) {
		if ($customer && count($customer) > 0) $dcustomer = " AND a.tcid IN(".implode(',',$customer).")";
		else $dcustomer = "";
		if ($date && count($date) > 1) $ddate = " AND (a.ttanggal >= '".date('Y-m-d',strtotime($date[0]))."' AND a.ttanggal <= '".date('Y-m-d',strtotime($date[1]))."')";
		else $ddate = "";
		
		if (array_search(0,$type) !== false) {
			$this -> db -> select("a.tid FROM transaction_tab a WHERE a.tbid=".$branch."$dcustomer$ddate AND ((a.ttype=2 AND a.ttypetrans=1) OR (a.ttype=2 AND a.ttypetrans=2) OR (a.ttype=2 AND a.ttypetrans=4)) AND a.tstatus !=2", FALSE);
		}
		else {
			$konsinyasi = "";
			$credit = "";
			$retur = "";
		
			if (array_search(1,$type) !== false) $credit = " OR (a.ttype=2 AND a.ttypetrans=2)";
			if (array_search(2,$type) !== false) $konsinyasi = " OR (a.ttype=2 AND a.ttypetrans=1)";
			if (array_search(3,$type) !== false) $retur = " OR (a.ttype=2 AND a.ttypetrans=4)";
			
			$jenis = $konsinyasi . $credit . $retur;
			$jenis = substr($jenis, 4);
			$this -> db -> select("a.tid FROM transaction_tab a WHERE a.tbid=".$branch."$dcustomer$ddate AND (a.ttanggal BETWEEN '".date('Y-m-d',strtotime($date[0]))."' AND '".date('Y-m-d',strtotime($date[1]))."') AND (".$jenis.") AND a.tstatus !=2", FALSE);
		}
		return $this -> db -> get() -> result();
	}

	function __get_transaction_details_bookid($ids,$pub) {
		$ids = implode(',',$ids);
		if (is_array($pub) && count($pub) > 0)
			$this -> db -> select("a.ttid,a.tbid FROM transaction_detail_tab a LEFT JOIN books_tab b ON a.tbid=b.bid WHERE b.bpublisher IN (".implode(',',$pub).") AND a.tstatus=1 AND a.ttid IN (".$ids.")", FALSE);
		else
			$this -> db -> select("a.ttid,a.tbid FROM transaction_detail_tab a WHERE a.tstatus=1 AND a.ttid IN (".$ids.")", FALSE);
		return $this -> db -> get() -> result();
	}

	function __get_inventory_list($ids,$bid) {
		$ids = implode(',',$ids);
		$this -> db -> select("a.ttanggal,a.tnofaktur,a.tnospo,a.ttypetrans,b.tqty,c.cname FROM transaction_tab a LEFT JOIN transaction_detail_tab b ON a.tid=b.ttid LEFT JOIN customer_tab c ON a.tcid=c.cid WHERE a.tid IN($ids) AND b.tbid=" . $bid, FALSE);
		return $this -> db -> get() -> result();
	}

	function __get_name_option($id,$type) {
		if ($type == 1) $this -> db -> select("cname as name FROM customer_tab WHERE cname='". $id ."'");
		elseif ($type == 2) $this -> db -> select("aname as name FROM area_tab WHERE aname='" . $id."'");
		elseif ($type == 3) $this -> db -> select('pname as name FROM publisher_tab WHERE pid=' . $id);
		else $this -> db -> select('bcode as name FROM books_tab WHERE bid=' . $id);
		return $this -> db -> get() -> result();
	}
	
	function __get_transfer_record($bid,$dfrom,$dto,$kode_buku,$kode_bukux,$rtype,$approval) {
		if ($approval == 2) $approval = " AND a.dstatus=3 AND b.dstatus=3";
		else $approval = " AND a.dstatus!=2 AND b.dstatus!=2";
		
		if(!$kode_buku || !$kode_bukux) $kb = "";
		else $kb = " AND c.ddrid between '$kode_buku' AND '$kode_bukux' ";
		
		if ($rtype == 2) $rtype = ",'0' as tharga,'0' as bruto,'0' as netto,c.dqty as totalqty";
		else if ($rtype == 1) $rtype = ",f.bname as aname,c.dqty as totalqty,'0' as bruto,'0' as netto,f.bcode as acode";
		else $rtype = '';

		$this -> db -> select("a.ddocno as tnofaktur,a.ddesc as ket,from_unixtime(a.ddate,'%Y-%m-%d') as ttanggal,c.dqty as tqty,d.btitle,d.bcode,d.bprice,'0' as tdisc,'0' as ttharga,e.pname,f.bname as narea,f.bname as cname,f.bcode as ccode,'0' as ttotal".$rtype." FROM distribution_tab a LEFT JOIN distribution_request_tab b ON a.ddrid=b.did LEFT JOIN branch_tab f ON b.dbfrom=f.bid LEFT JOIN distribution_book_tab c ON a.ddrid=c.ddrid LEFT JOIN books_tab d ON c.dbid=d.bid LEFT JOIN publisher_tab e ON d.bpublisher=e.pid WHERE b.dbto=".$bid.$approval." AND c.dstatus=1 AND (from_unixtime(a.ddate,'%Y-%m-%d') >= '".date('Y-m-d',strtotime($dfrom))."' AND from_unixtime(a.ddate,'%Y-%m-%d') <= '".date('Y-m-d',strtotime($dto))."')".$kb, FALSE);
		return $this -> db -> get() -> result();
	}
	
	function __get_request_record($bid,$dfrom,$dto,$kode_buku,$kode_bukux,$rtype,$approval) {
		if ($approval == 2) $approval = " AND a.dstatus=3";
		else $approval = " AND a.dstatus!=2";
		
		if(!$kode_buku || !$kode_bukux) $kb = "";
		else $kb = " AND c.ddrid between '$kode_buku' AND '$kode_bukux' ";
		
		if ($rtype == 2) $rtype = ",'0' as tharga,'0' as bruto,'0' as netto,d.dqty as totalqty";
		else if ($rtype == 1) $rtype = ",c.bname as aname,d.dqty as totalqty,'0' as bruto,'0' as netto,e.bcode as acode";
		else $rtype = '';

		$this -> db -> select("a.did,a.ddesc as ket,a.dtype,from_unixtime(a.ddate,'%Y-%m-%d') as ttanggal,a.dtitle,a.ddesc,a.dstatus,b.bcode as ccode,b.bname as narea,c.bname as cname,d.dqty as tqty,e.btitle,e.bcode,e.bprice,'0' as tdisc,'0' as ttharga,f.pname,'0' as ttotal".$rtype." FROM distribution_request_tab a LEFT JOIN branch_tab b ON a.dbfrom=b.bid LEFT JOIN branch_tab c ON a.dbto=c.bid INNER JOIN distribution_book_tab d ON a.did=d.ddrid INNER JOIN books_tab e ON d.dbid=e.bid LEFT JOIN publisher_tab f ON e.bpublisher=f.pid WHERE (a.dbfrom=".$bid." OR a.dbto=".$bid.")".$approval." AND (from_unixtime(a.ddate,'%Y-%m-%d') >= '".date('Y-m-d',strtotime($dfrom))."' AND from_unixtime(a.ddate,'%Y-%m-%d') <= '".date('Y-m-d',strtotime($dto))."')".$kb." ORDER BY a.did DESC", FALSE);
		$arr = $this -> db -> get() -> result();
		$res = array();
		foreach($arr as  $k => $v) {
			$v -> tnofaktur = ($v -> dtype == 1 ? 'R01' : 'R02').str_pad($v -> did, 4, "0", STR_PAD_LEFT);
			$res[] = $v;
		}
		return $res;
	}
	
	function __get_receiving_record($bid,$dfrom,$dto,$kode_buku,$kode_bukux,$rtype,$approval) {
		if(!$kode_buku || !$kode_bukux) $kb = "";
		else $kb = " AND b.rbid between '$kode_buku' AND '$kode_bukux' ";
		
		if ($approval == 2) $approval = " AND a.rstatus=3";
		else $approval = " AND a.rstatus!=2";
		
		if ($rtype == 2) $rtype = ",'0' as tharga,'0' as bruto,'0' as netto,b.rqty as totalqty";
		else if ($rtype == 1) $rtype = ",d.pname as aname,b.rqty as totalqty,'0' as bruto,'0' as netto,d.pcode as acode";
		else $rtype = '';
		
		$this -> db -> select("a.rdocno as tnofaktur,a.rdesc as ket,from_unixtime(a.rdate,'%Y-%m-%d') as ttanggal,b.rqty as tqty,c.btitle,c.bcode,c.bprice,d.pid,d.pname,'0' as tdisc,'0','0' as ttotal,'0' as ttharga".$rtype." FROM receiving_tab a LEFT JOIN receiving_books_tab b ON a.rid=b.rrid LEFT JOIN books_tab c ON b.rbid=c.bid LEFT JOIN publisher_tab d ON c.bpublisher=d.pid WHERE a.rtype=2".$approval." AND b.rstatus=1".$kb, FALSE);
		return $this -> db -> get() -> result();
	}
}
