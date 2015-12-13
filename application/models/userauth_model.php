<?php
class Userauth_model extends CI_Model{
    
    public $_delete = "13" ; 
    
    
    public function checklogin($email, $password)
    {
         if(!empty ($email) && !empty($password)){
           
            $this->db->where('email', $email);
            $this->db->where('password', md5($password));
            $this->db->where('status', '1');
            $this->db->from('user');
            $query = $this->db->get();
            
            if($query->num_rows() > 0){

				 
               return  $query->row();

            }else{
                return NULL;
            }


        }
        else{
            return NULL;
        }
    }
}