<?php
class Report_model extends CI_Model{
    
   
    public function requisitionReport($sdate, $edate, $jid=NULL)
    {
        
      @$sql="
          SELECT 
          r.id as tid, r.requisition_time , r.requisition_date ,   r.college_id , r.requisition_by , r.comments, 
          c.name cname , c.id, u.name as empname, u.id , 
          (SELECT SUM(quantity) FROM requisition_books WHERE requisition_id = r.id ) as bookqty
          FROM user u, college c, requisition r 
          WHERE 
          r.requisition_date <=  '{$edate}' AND   r.requisition_date >= '{$sdate}'        "  ; 
          if($jid != NULL )
          {
             $sql .= " AND  r.jonal_id = '{$jid}'  ";  
          }
          $sql .= " AND r.college_id  = c.id AND  r.requisition_by  = u.id
            GROUP BY tid  
            "; 
          ;
      // echo $sql ; 
          
        $result=$this->db->query($sql) ; 
        return $result->result_array() ; 
        
    }
 
    public function getRequisitionBooks($rid)
    {
        $sql = "SELECT 
                    rb.requisition_id, rb.book_id , rb.quantity, rb.price, rb.line_no  , 
                    b.id as bookid, b.book_code, b.book_name
                    FROM 
                    requisition_books as rb, books as b
                    WHERE 
                    rb.requisition_id = {$rid} 
                    AND rb.book_id =  b.id  
                    ORDER BY rb.line_no ASC
                    "; 
           $result=$this->db->query($sql) ; 
        return $result->result_array() ; 
        
    }




    public function transferReport($sdate, $edate, $did=NULL)
    {
        
      @$sql="
          SELECT 
          t.id as tid, t.transfer_time , t.challan_date , t.memo_no , t.transfer_to , t.entryby , t.comments, 
          c.name cname , c.id, u.name as empname, u.id , t.teacher_id, 
          (SELECT name dep_id FROM teachers WHERE id = t.teacher_id) as teacher_name,
          (SELECT dep_id FROM teachers WHERE id = t.teacher_id) as department_id,
          (SELECT name FROM department WHERE id = department_id) as department_name,
          (SELECT SUM(quantity) FROM transfer_item WHERE transfer_id = t.id ) as bookqty
          FROM user u, college c, transfer t 
          WHERE 
          t.challan_date <=  '{$edate}' AND   t.challan_date >= '{$sdate}'        "  ; 
          if($did != NULL )
          {
             $sql .= " AND  t.transfer_to = '{$did}'  ";  
          }
          $sql .= " AND t.transfer_to  = c.id AND  t.entryby  = u.id "; 
          ;
      
          
        $result=$this->db->query($sql) ; 
        return $result->result_array() ; 
        
    }
    
     public function getTrabsferBooks($tid)
    {
        $sql = "SELECT 
                    tb.transfer_id, tb.book_id , tb.quantity, tb.price, tb.line_no  , 
                    b.id as bookid, b.book_code, b.book_name
                    FROM 
                    transfer_item as tb, books as b
                    WHERE 
                    tb.transfer_id = {$tid} 
                    AND tb.book_id =  b.id  
                    ORDER BY tb.line_no ASC
                    "; 
           $result=$this->db->query($sql) ; 
        return $result->result_array() ; 
        
    }

    
     public function getDistributeBooks($did)
    {
        $sql = "SELECT 
                    db.distribute_id, db.book_id , db.quantity, db.price, db.line_no  , 
                    b.id as bookid, b.book_code, b.book_name
                    FROM 
                    distribute_books as db, books as b
                    WHERE 
                    db.distribute_id = {$did} 
                    AND db.book_id =  b.id  
                    ORDER BY db.line_no ASC
                    "; 
           $result=$this->db->query($sql) ; 
        return $result->result_array() ; 
        
    }


    
    public function jonaltransferReport($sdate, $edate, $jid=NULL)
    {
        
      @$sql="
          SELECT 
          t.id as tid, t.transfer_time , t.to_jonal,  t.challan_date , t.memo_no ,  t.entryby , t.comments, 
          j.name jname , j.id, u.name as empname, u.id , 
          (SELECT SUM(quantity) FROM transfer_item WHERE transfer_id = t.id ) as bookqty
          FROM user u, jonal j, transfer t 
          WHERE 
          t.challan_date <=  '{$edate}' AND   t.challan_date >= '{$sdate}'        "  ; 
          if($jid != NULL )
          {
             $sql .= " AND  t.to_jonal = '{$jid}'  ";  
          }
          $sql .= " AND t.to_jonal  = j.id AND  t.entryby  = u.id "; 
          ;
        $result=$this->db->query($sql) ; 
        return $result->result_array() ; 
        
    }
    
    
    public function distributeReport($sdate, $edate, $cid=NULL)
    {
        
      @$sql="
          SELECT 
          d.id as did, d.distribute_time , d.distribute_date ,  d.entryby , d.comments, d.college_id, d.teacher_id, 
          c.id, c.name as cname, c.address as caddress, t.name as tname, t.id , 
          u.name as empname, u.id , dep.name as depname, d.department_id, 
          (SELECT SUM(quantity) FROM distribute_books WHERE distribute_id = d.id ) as bookqty
          FROM user as u, jonal as  j,  teachers as t , distribute as d, department as dep, college as c
          WHERE 
          d.distribute_date <=  '{$edate}' AND   d.distribute_date >= '{$sdate}'   AND dep.id = d.department_id     "  ; 
          if($cid != NULL )
          {
             $sql .= " AND  d.college_id = '{$cid}'  ";  
          }
          $sql .= " AND d.college_id  = c.id AND  d.entryby  = u.id
                    AND d.college_id = c.id AND d.teacher_id = t.id 
                    GROUP BY d.id
                "; 
          
          // SELECT department.name, distribute.department_id FROM department, distribute WHERE department.id = distribute.department_id
         //echo $sql ;  
        $result=$this->db->query($sql) ; 
        return $result->result_array() ; 
        
    }
    

    
        
}
