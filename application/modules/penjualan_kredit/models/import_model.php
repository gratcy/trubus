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
                $data = array(
                        'ttid'    => $excel_data[$i]['ttid'],
                        'tbid'   => $excel_data[$i]['tbid'],
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
						
                $this->db->insert('transaction_detail_tab', $data);
				
				
				// $sql = $this -> db -> query("SELECT tid FROM transaction_detail_tab order by tid desc limit 0,1 ");
				// $jum= $sql -> num_rows();
				// $tid=$sql->result();
				
				// print_r($tid);die;
				// if($jum>1){
					
				 // return $this->db->delete('transaction_detail_tab', array('tid' => $tid));	
				// }
				
				
				
				
				
				
				
				
				
            // }
            // else
            // {
                // $data = array(
                        // 'ttid'    => $excel_data[$i]['ttid'],
                        // 'tbid'   => $excel_data[$i]['tbid'],
                        // 'tqty' => $excel_data[$i]['tqty'], 
						// 'tharga' => $excel_data[$i]['tharga'],
						// 'tdisc' => $excel_data[$i]['tdisc'],
						// 'ttharga' => $excel_data[$i]['ttharga'],
						// 'ttotal' => $excel_data[$i]['ttotal'],
						// 'gd_from' => '',
						// 'gd_to' => '',
						// 'tstatus' => 1,
						// 'approval' => 1
                        // );
                // $this->db->where('ttid', $excel_data[$i]['ttid']);
                // $this->db->update('transaction_detail_tab', $data);
            // }
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