<?php
header('Content-type: application/javascript');
$mysql_server = $hostname;
$mysql_login = $username;
$mysql_password = $password;
$mysql_database = $database;

// echo "SELECT bid,bcode,btitle,bisbn,bprice,bdisc,bpublisher,pname,istock,
// (select sum(d.tqty)  from transaction_detail_tab d  where d.approval<2 AND d.tbid=a.bid ) as tqty
// FROM books_tab a,publisher_tab b,inventory_tab c
// WHERE c.ibid=a.bid 
// AND c.itype='1' 
// AND a.bpublisher=b.pid 
// AND c.ibcid ='".$_REQUEST['branch']."' AND ( btitle LIKE '%".$_REQUEST['term']."%' OR bcode LIKE '%".$_REQUEST['term']."%'
	// OR bisbn LIKE '%".$_REQUEST['term']."%')";die;
	
	
// echo "xxx";die;
if(!isset($_REQUEST['term'])){$_REQUEST['term']="";}
if(!isset($_REQUEST['branch'])){$_REQUEST['branch']="";}

$get_suggest = $this -> memcachedlib -> get('__trans_suggeest_2', true);
if (!$get_suggest) {
	mysql_connect($mysql_server, $mysql_login, $mysql_password);
	mysql_select_db($mysql_database);

	// $req = "SELECT bid,bcode,btitle,bisbn,bprice,bdisc,bpublisher,pname,istock "
		// ." FROM books_tab a,publisher_tab b,inventory_tab c "
		// ."WHERE c.ibid=a.bid and c.itype='1' AND a.bpublisher=b.pid"; 	



		
	$req = "SELECT bid,bcode,btitle,bisbn,bprice,bdisc,bpublisher,pname,istock,
(select sum(d.tqty)  from transaction_detail_tab d  where d.approval<2 AND d.tbid=a.bid ) as tqty
FROM books_tab a,publisher_tab b,inventory_tab c
WHERE c.ibid=a.bid 
AND c.itype='1' 
AND a.bpublisher=b.pid 
AND c.ibcid ='".$_REQUEST['branch']."' AND ( btitle LIKE '%".$_REQUEST['term']."%' OR bcode LIKE '%".$_REQUEST['term']."%' OR bisbn LIKE '%".$_REQUEST['term']."%')"; 
//echo $req;die;
	$query = mysql_query($req);
	while($row = mysql_fetch_array($query))
	{
		$results[] = array('label' => $row['btitle'],'bid' => $row['bid'],'bcode' => $row['bcode'],
		'bisbn' => $row['bisbn'],'bprice' => $row['bprice'],'bdisc' => $row['bdisc'],'bpublisher' => $row['bpublisher'],'pname' => $row['pname'],'stok'=>$row['istock'],'tqty'=>$row['tqty']);
	}
	$this -> memcachedlib -> set('__trans_suggeest_2', json_encode($results), 3600,true);
	$get_suggest = $this -> memcachedlib -> get('__trans_suggeest_2', true);
}
$a = json_decode($get_suggest,true);
$q = $_REQUEST['term'];
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
		if ($cnt_pos==0)
			$pos[$cnt_pos] = 0;
		else
			$pos[$cnt_pos] = strpos($a[$i]['label'],' ', $pos[$cnt_pos-1])+1;
	}
	
	for ($cnt_pos2=0; $cnt_pos2<$num_words2; $cnt_pos2++) {
		if ($cnt_pos2==0)
			$pos2[$cnt_pos2] = 0;
		else
			$pos2[$cnt_pos2] = strpos($a[$i]['bcode'],' ', $pos2[$cnt_pos2-1])+1;
	}
	
	for ($cnt_pos3=0; $cnt_pos3<$num_words3; $cnt_pos3++) {
		if ($cnt_pos3==0)
			$pos2[$cnt_pos3] = 0;
		else
			$pos2[$cnt_pos3] = strpos($a[$i]['bcode'],' ', $pos3[$cnt_pos3-1])+1;
	}
	
	if (strtolower($q)==strtolower(substr($a[$i]['label'],0,strlen($q))) || strtolower($q)==strtolower(substr($a[$i]['bcode'],0,strlen($q))) || strtolower($q)==strtolower(substr($a[$i]['bisbn'],0,strlen($q)))) {
		$res[] = $a[$i];
		$is_suggestion_added = true;
		$is_suggestion_added2 = true;
		$is_suggestion_added3 = true;
	}
	for ($j=0;$j<$num_words && !$is_suggestion_added;$j++) {
		if(strtolower($q)==strtolower(substr($a[$i]['label'],$pos[$j],strlen($q)))){
			$res[] = $a[$i];
			$is_suggestion_added = true;
		}
	}
	
	for ($j=0;$j<$num_words2 && !$is_suggestion_added2;$j++) {
		if(strtolower($q)==strtolower(substr($a[$i]['bcode'],$pos2[$j],strlen($q)))){
			$res[] = $a[$i];
			$is_suggestion_added2 = true;
		}
	}
	
	for ($j=0;$j<$num_words3 && !$is_suggestion_added3;$j++) {
		if(strtolower($q)==strtolower(substr($a[$i]['bisbn'],$pos3[$j],strlen($q)))){
			$res[] = $a[$i];
			$is_suggestion_added3 = true;
		}
	}
}

$res = array_slice($res,0,15);
echo json_encode($res);

flush();
