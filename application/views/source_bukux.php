<?php
header('Content-type: application/javascript');
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");

if(!isset($_REQUEST['term'])){$_REQUEST['term']="";}
if(!isset($_REQUEST['branch'])){$_REQUEST['branch']="";}

$get_suggest = $this -> memcachedlib -> get('__trans_suggeest_3_'.$_REQUEST['branch'], true);

 if (!$get_suggest || count($get_suggest) < 2) {
	// function __get_sum_transaction($bid) {
		// $sql = mysql_query("SELECT SUM(tqty) as tqty FROM transaction_detail_tab WHERE tstatus=1 AND approval<2 AND tbid=".$bid);
		// $r = mysql_fetch_array($sql);
		// return ($r['tqty'] ? $r['tqty'] : 0);
	// }
	
	$query = mysql_query("SELECT a.bid,a.bcode,a.btitle,a.bisbn,a.bprice,a.bdisc,a.bpublisher,b.pname,b.pcategory FROM books_tab a JOIN publisher_tab b ON a.bpublisher=b.pid and a.bstatus=1");
	while($row = mysql_fetch_array($query))
		$results[] = array('label' => $row['bcode'] .' | '.$row['btitle'] .' | '.$row['bprice'] .' | '.$row['pname'],'bid' => $row['bid'],'bcode' => $row['bcode'],'pcategory'=>$row['pcategory'],'ibcid'=>$_REQUEST['branch'],'bisbn' => $row['bisbn'],'bprice' => $row['bprice'],'bdisc' => $row['bdisc'],'bpublisher' => $row['bpublisher'],'pname' => $row['pname']);
	
	//~ $results2 = array();
	//~ foreach($results as $k => $v) {
		//~ $res = array_merge($v,array('tqty' => __get_sum_transaction($v['bid'])));
		//~ $results2[] = $res;
		//~ $res = array();
	//~ }
	
	$this -> memcachedlib -> set('__trans_suggeest_3_'.$_REQUEST['branch'], json_encode($results), 7200,true);
	$get_suggest = $this -> memcachedlib -> get('__trans_suggeest_3_'.$_REQUEST['branch'], true);
}

if (!is_array($get_suggest)) $a = json_decode($get_suggest,true);
else $a = $get_suggest;

$q = strtoupper($_REQUEST['term']);
$res = array();

for($i=0; $i<count($a); $i++) {
	$a[$i]['label'] = trim($a[$i]['label']);
	$a[$i]['bcode'] = trim($a[$i]['bcode']);
	$a[$i]['bisbn'] = trim($a[$i]['bisbn']);
	
	$num_words = substr_count($a[$i]['label'],' ')+1;
	$num_words2 = substr_count($a[$i]['bcode'],' ')+1;
	$num_words3 = substr_count($a[$i]['bisbn'],' ')+1;
	
	$pos = array();
	$pos2 = array();
	$pos3 = array();
	
	$is_suggestion_added = false;
	$is_suggestion_added2 = false;
	$is_suggestion_added3 = false;
	
	for ($cnt_pos=0; $cnt_pos<$num_words; $cnt_pos++) {
		if ($cnt_pos==0) $pos[$cnt_pos] = 0;
		else $pos[$cnt_pos] = strpos($a[$i]['label'],' ', $pos[$cnt_pos-1])+1;
	}
	
	for ($cnt_pos2=0; $cnt_pos2<$num_words2; $cnt_pos2++) {
		if ($cnt_pos2==0) $pos2[$cnt_pos2] = 0;
		else $pos2[$cnt_pos2] = strpos($a[$i]['bcode'],' ', $pos2[$cnt_pos2-1])+1;
	}
	
	for ($cnt_pos3=0; $cnt_pos3<$num_words3; $cnt_pos3++) {
		if ($cnt_pos3==0) $pos2[$cnt_pos3] = 0;
		else $pos2[$cnt_pos3] = strpos($a[$i]['bcode'],' ', $pos3[$cnt_pos3-1])+1;
	}

	if ($q==substr($a[$i]['label'],0,strlen($q)) || $q==substr($a[$i]['bcode'],0,strlen($q)) || $q==substr($a[$i]['bisbn'],0,strlen($q))) {
		$res[] = $a[$i];
		$is_suggestion_added = true;
		$is_suggestion_added2 = true;
		$is_suggestion_added3 = true;
	}
	for ($j=0;$j<$num_words && !$is_suggestion_added;$j++) {
		if($q==substr($a[$i]['label'],$pos[$j],strlen($q))){
			$res[] = $a[$i];
			$is_suggestion_added = true;
		}
	}
	
	for ($j=0;$j<$num_words2 && !$is_suggestion_added2;$j++) {
		if($q==substr($a[$i]['bcode'],$pos2[$j],strlen($q))){
			$res[] = $a[$i];
			$is_suggestion_added2 = true;
		}
	}
	
	// for ($j=0;$j<$num_words3 && !$is_suggestion_added3;$j++) {
		// if($q==substr($a[$i]['bisbn'],$pos3[$j],strlen($q))){
			// $res[] = $a[$i];
			// $is_suggestion_added3 = true;
		// }
	// }
}

$res = array_slice($res,0,15);
echo json_encode($res);
exit;
