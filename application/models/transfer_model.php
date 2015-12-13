<?php
class Transfer_model extends CI_Model{
    
    public function product_suggation($term)
    {
        $this->db->from("books") ;
        $this->db->where('status !=', 13);
        $this->db->like('book_name',$term, 'both') ; 
        $result = $this->db->get()->result_array() ; 
        return $result ;
    }
    
    public function division_book_suggation($term, $did)
    {
      @$sql="SELECT books. * ,  inventory_division. *
        FROM books, inventory_division
        WHERE books.book_name LIKE '%$term%'
        AND books.id = inventory_division.book_id
        AND inventory_division.division_id = '{$did}'
        AND inventory_division.quantity >0
        " ;
      
        $result=$this->db->query($sql) ; 
        return $result->result_array() ; 
        
    }
    
    
    public function getDivBook($bookid, $did)
    {
      @$sql="SELECT books. * ,  inventory_division. *
        FROM books, inventory_division
        WHERE books.id = '{$bookid}'
        AND books.id = inventory_division.book_id
        AND inventory_division.division_id = '{$did}'
        AND inventory_division.quantity >0
        " ;
      
        $result=$this->db->query($sql) ; 
        return $result->row() ; 
        
    }
    

    
    public function jonal_book_suggation($term, $jid)
    {
      @$sql="SELECT books. * ,  inventory_jonal. *
        FROM books, inventory_jonal
        WHERE books.book_name LIKE '%$term%'
        AND books.id = inventory_jonal.book_id
        AND inventory_jonal.jonal_id = '{$jid}'
        AND inventory_jonal.quantity >0
        " ;
      
        $result=$this->db->query($sql) ; 
        return $result->result_array() ; 
        
    }
    
    
    public function getJonalBook($bookid, $jid)
    {
      @$sql="SELECT books. * ,  inventory_jonal. *
        FROM books, inventory_jonal
        WHERE books.id = '{$bookid}'
        AND books.id = inventory_jonal.book_id
        AND inventory_jonal.jonal_id = '{$jid}'
        AND inventory_jonal.quantity >0
        " ;
        $result=$this->db->query($sql) ; 
        return $result->row() ; 
        
    }
    
    
    public function getCollegeBook( $cid, $bookid )
    {
      @$sql="SELECT books. * ,   inventory_college. *
        FROM books,  inventory_college
        WHERE books.id = '{$bookid}'
        AND books.id =  inventory_college.book_id
        AND  inventory_college.college_id = '{$cid}'
        AND  inventory_college.quantity >0
        " ;
        $result=$this->db->query($sql) ; 
        return $result->row() ; 
        
    }
    

    
        
}
