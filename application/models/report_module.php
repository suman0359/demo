<?php
class Report_module extends CI_Model{
    
   
    public function transferReport($sdate, $edate, $did=NULL)
    {
        
      @$sql="
          SELECT 
          t.id as tid, t.transfer_time , t.challan_date , t.memo_no , t.transfer_to , t.entryby , t.comments, 
          d.name dname , d.id, u.name as empname, u.id , 
          (SELECT SUM(quantity) FROM transfer_item WHERE transfer_id = t.id ) as bookqty
          FROM user u, division d, transfer t 
          WHERE 
          t.challan_date <=  '{$edate}' AND   t.challan_date >= '{$sdate}'        "  ; 
          if($did != NULL )
          {
             $sql .= " AND  t.transfer_to = '{$did}'  ";  
          }
          $sql .= " AND t.transfer_to  = d.id AND  t.entryby  = u.id "; 
          ;
      
          
        $result=$this->db->query($sql) ; 
        return $result->result_array() ; 
        
    }
    

    
        
}
