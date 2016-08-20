<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Import_model extends CI_Model {

   /**
    * ---------------------------
    * Method   upload_data()
    * @param   array() 
    * @return  void 
    * @access  public 
    * Fungsi untuk menyimpan data     
    * --------------------------- 
    */  
	public function upload_data($excel_data)
	{	 
	
			// echo '<pre>';
			// print_r($excel_data);die;	
	
//echo "rrrrr";die;	
	for($i = 1; $i < count($excel_data); $i++)
        {            
            // if( ! $this->is_exist($excel_data[$i]['tid']) == TRUE)
            // {
				
				
				
		$sqlk = $this -> db -> query("SELECT bid  FROM books_tab where bstatus='1' AND bcode='".$excel_data[$i]['tbid']."'");
		$zk= $sqlk -> result_array();
		$bid=$zk[0]['bid'];					
		$bidzzz=$excel_data[$i]['tbid'];		
				
                $data = array(
                        'ttid'    => $excel_data[$i]['ttid'],
                        'tbid'   => $bid,
                        'tqty' => $excel_data[$i]['tqty'], 
						'tharga' => $excel_data[$i]['tharga'],
						'ttharga' => $excel_data[$i]['ttharga'],
						'tdisc' => $excel_data[$i]['tdisc'],
						
						'ttotal' => $excel_data[$i]['ttotal'],
						'gd_from' => '',
						'gd_to' => '',
						'tstatus' => 1,
						'approval' => 1
                        );
		// print_r($data);die;

if($bid==""){
echo $bidzzz." tidak valid<br>";
}else{	

$branch=$this -> memcachedlib -> sesresult['ubranchid'];	

	$sqla = $this -> db -> query("SELECT * from inventory_tab where ibid='$bid' and ibcid='$branch'");
	$dta=$sqla-> result();
	foreach($dta as $k => $v){
		$iqty=$excel_data[$i]['tqty'];
		//echo '<pre>';
		//print_r($dta);
		$istock=$dta[0]->istock;
		$itype=$dta[0]->itype;
	}
	//echo $bid .'-'. $iqty.'-'.$istock.'<br>';

/*
if(($iqty < $istock)AND ($itype==1)){
	//echo $bid.'xxxx<br>';
	$this->db->insert('transaction_detail_tab', $data);
}elseif($itype==2){
	$this->db->insert('transaction_detail_tab', $data);
}else{	
	echo 'Id Buku:'.$bid.' gagal diinput karna qty: '.$iqty.'  lebih besar dr qty stok : '.$istock .'<br>';
}
*/

               $this->db->insert('transaction_detail_tab', $data);
//echo $excel_data[$i]['tbid'].'<br>';				
	
	}		
	$ttid=$excel_data[$i]['ttid'];
	
   }
   
   
 $sql = $this -> db -> query("SELECT sum(a.tqty) as tqty,sum(a.tharga*a.tqty) as tharga,sum(a.ttotal)as ttotal,
	(sum(a.tharga*a.tqty) -  sum(a.ttotal)) as ttotaldisc FROM transaction_detail_tab a, transaction_tab b 
	WHERE a.ttid=b.tid AND a.ttid='".$ttid."' AND a.tstatus=1 group by a.ttid");
	$dt=$sql-> result();
	foreach($dt as $k => $v){
	$tqtyx=$v->tqty;
	$thargax=$v->tharga ;
	$ttotal=$v->ttotal;
	$tdiscx=$thargax-$ttotal;
	$ttx=$ttotal;
	
	 //echo "$tqtyx $thargax $tdiscx $ttx";//die;
	}

	$this -> db-> query("UPDATE transaction_tab set ttotalqty='$tqtyx',ttotalharga='$thargax', ttotaldisc='$tdiscx',tgrandtotal='$ttx' WHERE tid='".$excel_data[$i]['ttid']."' ");
				  
   
   
   
   //print_r($excel_data);
   echo "<br><b>Data Sukses di Input</b>";
   die;
 }

 
 
 
 public function upload_dataz($excel_data)
	{	 
//echo "rrrrr";die;	
	for($i = 1; $i < count($excel_data); $i++)
        {            
            // if( ! $this->is_exist($excel_data[$i]['tid']) == TRUE)
            // {
		$sqlk = $this -> db -> query("SELECT bid  FROM books_tab where bcode='".$excel_data[$i]['tbid']."'");
		$zk= $sqlk -> result_array();
		$bid=$zk[0]['bid'];					
		$bidzzz=$excel_data[$i]['tbid'];		
				
                $data = array(                        
                        'tbid'   => $bid,
                        'ishadow' => $excel_data[$i]['tqty']
                        );
		//print_r($data);

if($bid==""){
echo $bidzzz." tidak valid<br>";
}else{	
                
$branch=$this -> memcachedlib -> sesresult['ubranchid'];				
	$sql = $this -> db -> query("SELECT * from inventory_tab where ibid='$bid' and ibcid='$branch'");
	$dt=$sql-> result();
	foreach($dt as $k => $v){
		
		
	$ishadow=$excel_data[$i]['tqty'];
	
	// echo "$tqtyx $thargax $tdiscx $ttx";//die;
	}
//echo "UPDATE inventory_tab set ishadow='$ishadow' WHERE ibid='".$bid."' ";
	$this -> db-> query("UPDATE inventory_tab set ishadow='$ishadow' WHERE ibid='".$bid."' ");
				
	}		
   }
   echo "<br><b>Data Sukses di Input</b>";
   die;
 }

 
 
 
 
 
 
 
 
 
 
 
   /**
    * ------------------------------------------------------------
    * Method   is_exist()
    * @param   string 
    * @return  boolean
    * @access  private 
    * Fungsi untuk mengecek ketersediaan nim dalam tabel mahasiswa
    * ------------------------------------------------------------ 
    */      
    private function is_exist($tid)
    {
        $this->db->where('tid', $tid);
        $result = $this->db->count_all_results('transaction_detail_tab');
        if($result == 1)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }
}

/* End of file import_model.php */
/* Location: ./application/models/import_model.php */
