<?php
class Purchase_model extends CI_Model{
    
    public function product_suggation($term)
    {
        $this->db->from("books") ;
        $this->db->where('status !=', 13);
        $this->db->like('book_name',$term, 'both') ; 
        $result = $this->db->get()->result_array() ; 
        return $result ;
    }
    
    public function product_suggation_custom($term)
    {
      @$sql="SELECT product . * ,depertment_product . *
        FROM product, depertment_product
        WHERE product.name LIKE '%$term%'
        AND product.id = depertment_product.product_id
        AND depertment_product.quantity >0
        AND depertment_product.department_id =1 AND product.status!=13 AND depertment_product.status!=13" ;
      
        $result=$this->db->query($sql) ; 
        return $result->result_array() ; 
        
    }
    

    
        
}
