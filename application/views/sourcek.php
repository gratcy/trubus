<?php
header('Content-type: application/javascript');
$mysql_server = $hostname;
$mysql_login = $username;
$mysql_password = $password;
$mysql_database = $database;
if(!isset($_REQUEST['term'])){$_REQUEST['term']="";}

if(!isset($_REQUEST['branch'])){$_REQUEST['branch']="";}

$get_suggest = $this -> memcachedlib -> get('__trans_suggeest_1', true);
if (!$get_suggest) {
	$conn = mysql_connect($mysql_server, $mysql_login, $mysql_password);
	$db = mysql_select_db($mysql_database, $conn);


	$req = "SELECT cid,
	cbid,ccode,cname,caddr,cphone,cemail,cnpwp,cdisc,ctax,bcode "
		."FROM customer_tab a,branch_tab b "
		."WHERE a.cbid=b.bid  AND a.cbid =".$_REQUEST['branch'].""; 

	$query = mysql_query($req);

	while($row = mysql_fetch_array($query))
	{
	if($row['ctax']==0){$ctx="InTaxable";}
	else if($row['ctax']==1){$ctx="Taxable";}

		$results[] = array('label' => $row['cname'],'cid' => $row['cid'],'cbid' => $row['cbid'],
		'ccode' => $row['ccode'],'caddr' => $row['caddr'],'cphone' => $row['cphone'],
		'cnpwp' => $row['cnpwp'],'cemail' => $row['cemail'],'cdisc' => $row['cdisc'],'ctax' => $row['ctax'],
		'ctx' => $ctx ,'bcode'=>$row['bcode'] );
	}
	$this -> memcachedlib -> set('__trans_suggeest_1', json_encode($results), 3600,true);
	$get_suggest = $this -> memcachedlib -> get('__trans_suggeest_1_'. $_REQUEST['branch'], true);
}
$a = json_decode($get_suggest,true);
$q = $_REQUEST['term'];
$res = array();

for($i=0; $i<count($a); $i++) {
	$a[$i]['label'] = trim($a[$i]['label']);
	$a[$i]['ccode'] = trim($a[$i]['ccode']);
	$num_words = substr_count($a[$i]['label'],' ')+1;
	$num_words2 = substr_count($a[$i]['ccode'],' ')+1;
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
			$pos2[$cnt_pos2] = strpos($a[$i]['ccode'],' ', $pos2[$cnt_pos2-1])+1;
	}
	
	if (strtolower($q)==strtolower(substr($a[$i]['label'],0,strlen($q))) || strtolower($q)==strtolower(substr($a[$i]['ccode'],0,strlen($q)))) {
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
		if(strtolower($q)==strtolower(substr($a[$i]['ccode'],$pos2[$j],strlen($q)))){
			$res[] = $a[$i];
			$is_suggestion_added2 = true;
		}
	}
}
$res = array_slice($res,0,15);

echo json_encode($res);
flush();
