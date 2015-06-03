<?php
header('Content-type: application/javascript');
$mysql_server = $hostname;
$mysql_login = $username;
$mysql_password = $password;
$mysql_database = $database;
if(!isset($_REQUEST['term'])){$_REQUEST['term']="";}

$get_suggest = $this -> memcachedlib -> get('__trans_suggeest_3', true);
if (!$get_suggest) {
	mysql_connect($mysql_server, $mysql_login, $mysql_password);
	mysql_select_db($mysql_database);

	$req = "SELECT pid,pcode,pname,paddr,pphone,pemail,pnpwp "
		."FROM publisher_tab "
		."WHERE  pstatus='1'"; 
	$query = mysql_query($req);

	while($row = mysql_fetch_array($query))
	{

		$results[] = array('label' => $row['pname'],'pid' => $row['pid'],
		'pcode' => $row['pcode'],'paddr' => $row['paddr'],'pphone' => $row['pphone'],
		'pnpwp' => $row['pnpwp'],'pemail' => $row['pemail'] );
	}
	$this -> memcachedlib -> set('__trans_suggeest_3', json_encode($results), 3600,true);
	$get_suggest = $this -> memcachedlib -> get('__trans_suggeest_3', true);
}

$a = json_decode($get_suggest,true);
$q = $_REQUEST['term'];
$res = array();

for($i=0; $i<count($a); $i++) {
	$a[$i]['label'] = trim($a[$i]['label']);
	$a[$i]['pcode'] = trim($a[$i]['pcode']);
	$num_words = substr_count($a[$i]['label'],' ')+1;
	$num_words2 = substr_count($a[$i]['pcode'],' ')+1;
	$pos = array();
	$pos2 = array();
	$is_suggestion_added = false;
	$is_suggestion_added2 = false;
	
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
			$pos2[$cnt_pos2] = strpos($a[$i]['pcode'],' ', $pos2[$cnt_pos2-1])+1;
	}
	
	if (strtolower($q)==strtolower(substr($a[$i]['label'],0,strlen($q))) || strtolower($q)==strtolower(substr($a[$i]['pcode'],0,strlen($q)))) {
		$res[] = $a[$i];
		$is_suggestion_added = true;
		$is_suggestion_added2 = true;
	}
	for ($j=0;$j<$num_words && !$is_suggestion_added;$j++) {
		if(strtolower($q)==strtolower(substr($a[$i]['label'],$pos[$j],strlen($q)))){
			$res[] = $a[$i];
			$is_suggestion_added = true;
		}
	}
	
	for ($j=0;$j<$num_words2 && !$is_suggestion_added2;$j++) {
		if(strtolower($q)==strtolower(substr($a[$i]['pcode'],$pos2[$j],strlen($q)))){
			$res[] = $a[$i];
			$is_suggestion_added2 = true;
		}
	}
}

echo json_encode($res);
flush();
?>
