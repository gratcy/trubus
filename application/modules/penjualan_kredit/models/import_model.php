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
//echo "rrrrr";die;	
	for($i = 1; $i < count($excel_data); $i++)
        {            
            // if( ! $this->is_exist($excel_data[$i]['tid']) == TRUE)
            // {
		$sqlk = $this -> db -> query("SELECT bid  FROM books_tab where bcode='".$excel_data[$i]['tbid']."'");
		$zk= $sqlk -> result_array();
		$bid=$zk[0]['bid'];					
				
				
                $data = array(
                        'ttid'    => $excel_data[$i]['ttid'],
                        'tbid'   => $bid,
                        'tqty' => $excel_data[$i]['tqty'], 
						'tharga' => $excel_data[$i]['tharga'],
						'tdisc' => $excel_data[$i]['tdisc'],
						'ttharga' => $excel_data[$i]['ttharga'],
						'ttotal' => $excel_data[$i]['ttotal'],
						'gd_from' => '',
						'gd_to' => '',
						'tstatus' => 1,
						'approval' => 1
                        );
		//print_r($data);				
                $this->db->insert('transaction_detail_tab', $data);
				
	$sql = $this -> db -> query("SELECT sum(tqty) as tqty,sum(tharga*tqty) as tharga,sum(ttotal)as ttotal,(sum(tharga*tqty) -  sum(ttotal)) as ttotaldisc FROM transaction_detail_tab a, transaction_tab b WHERE a.ttid=b.tid AND a.ttid='".$excel_data[$i]['ttid']."' group by ttid");
	$dt=$sql-> result();
	foreach($dt as $k => $v){
	$tqtyx=$v->tqty;
	$thargax=$v->tharga ;
	$ttotal=$v->ttotal;
	$tdiscx=$thargax-$ttotal;
	$ttx=$ttotal;
	
	echo "$tqtyx $thargax $tdiscx $ttx";//die;
	}

	return $this -> db-> query("UPDATE transaction_tab set ttotalqty='$tqtyx',ttotalharga='$thargax', ttotaldisc='$tdiscx',tgrandtotal='$ttx' WHERE tid='".$excel_data[$i]['ttid']."' ");
				
			
        }
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