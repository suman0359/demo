<?php

class Commons extends CI_Model {

    public function getEncrytedUrl($back_track) {
        $bc = str_replace("/", "-", $back_track);
        $bcl = strrev($bc);

        return $bcl;
    }

    public function revEncrytedUrl($back_track) {
        $bc = strrev($back_track);

        $bcl = str_replace("-", "/", $bc);


        return $bcl;
    }

    //Selector Column Name || Where(Column Name) || Where Passed value || From(Table Name) 
    // $SCN = Selector Column Name
    // $WCN = Where Column Name 
    // $WPV = Where Passed Value 
    
    public function getIdWhere($SCN, $WCN, $WPV, $table_name) {
        $this->db->select($SCN);
        $this->db->where($WCN, $WPV);
        $this->db->from($table_name);

        $query_result = $this->db->get();
        $result = $query_result->row();
        return $result;
    }
    
    /*
     * (First Where, Second Where, Table Name)
     */
    public function getAllAndWhere($first, $second, $table_name){
        $this->db->select('*');
        $this->db->where($first);
        $this->db->where($second);
        $this->db->from($table_name);
        
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }
    
    


    public function words_count($text, $no) {
        $text = strip_tags($text);
        $text = trim(preg_replace("/\s+/", " ", $text));
        $word_array = explode(" ", $text);
        if (count($word_array) <= $no)
            return implode(" ", $word_array);
        else {
            $text = '';
            foreach ($word_array as $length => $word) {
                $text.=$word;
                if ($length == $no)
                    break;
                else
                    $text.=" ";
            }
        }
        return $text;
    }

    public function getMaxID($table) {
        $this->db->select_max('id');
        $query = $this->db->get($table)->row();

        if (!$query->id) {
            $id = '1';
        } else {
            $id = $query->id + 1;
        }

        return $id;
    }

    public function dateconvert($date, $chk) {
        //$chk=1 means for save datebase formet,
        // $chk=2 means for view in view page formet

        if ($chk == 1) {//for data base formet("Y-M-D")
            $tempdate = strtotime($date);
            return date('Y-m-d', $tempdate);
        }
        if ($chk == 2) {//for view page formet ("D-M-Y")
            $tempdate = strtotime($date);
            return date('d-m-Y', $tempdate);
        }
    }

    public function getAll($table, $order = NULL) {
        $this->db->where('status !=', 13);
        if (!($order == NULL)) {
            $this->db->order_by($order);
        }
        $query = $this->db->get($table)->result_array();
        return $query;
    }

    public function getwhere($table, $where, $order = NULL) {
        $this->db->where('status !=', 13);
        if (!($order == NULL)) {
            $this->db->order_by($order);
        }
        $this->db->where($where);
        $query = $this->db->get($table)->row();
        return $query;
    }

    public function getAllWhere($table, $where, $from = NULL, $limit = NULL, $order = NULL) {
        $this->db->where('status !=', 13);
        if (!($order == NULL)) {
            $this->db->order_by($order);
        }
        $this->db->where($where);
        $query = $this->db->get($table)->result_array();
        return $query;
    }



    public function getInfo($table, $id) {
        $this->db->from($table);
        $this->db->where('status !=', 13);
        $this->db->where('id', $id);
        $query = $this->db->get()->row();
        return $query;
    }

    public function insert($table, $data) {
        $this->db->insert($table, $data);
        return $this->db->insert_id();
    }

    public function update($table, $data, $id) {
        $this->db->where('id', $id);
        return $this->db->update($table, $data);
    }

    public function updatewhere($table, $data, $where) {
        $this->db->where($where);
        return $this->db->update($table, $data);
    }

    public function delete($table, $where) {

        $this->db->where($where);
        return $this->db->delete($table);
    }

    public function delete_db($table, $id) {
        $data = array('status' => 13);

        $this->db->where('id', $id);
        return $this->db->update($table, $data);
    }

    public function delete_where($table, $where) {
        $data = array('status' => 13);

        $this->db->where($where);
        return $this->db->update($table, $data);
    }

    public function getData($table, $data, $order = NULL) {
        $this->db->where('status !=', 13);
        $this->db->from($table);

        if (!empty($order)) {
            $this->db->order_by($order);
        }

        $this->db->like('name', $data, 'both');
        return $this->db->get()->result_array();
    }

    public function getDatasupplier($table, $data, $order = NULL) {
        $this->db->where('status !=', 13);
        $this->db->from($table);

        if (!empty($order)) {
            $this->db->order_by($order);
        }

        $this->db->like('cname', $data, 'both');
        return $this->db->get()->result_array();
    }

    public function getDatacustomer($table, $data, $order = NULL) {
        $this->db->where('status !=', 13);
        $this->db->from($table);

        if (!empty($order)) {
            $this->db->order_by($order);
        }

        $this->db->like('company_name', $data, 'both');
        return $this->db->get()->result_array();
    }

    public function checkpermission($module, $m_action, $uid) {

        $where = array('uid' => $uid, 'module' => $module);
        $this->db->where('status !=', 13);
        $this->db->from('user_permission');
        $this->db->where($where);
        $dataps = $this->db->get()->row();

        if ($dataps) {
            $act = unserialize($dataps->m_action);
            if ($act) {
                if (in_array($m_action, $act)) {
                    return TRUE;
                } else {
                    return FALSE;
                }
            }
            return FALSE;
        }
        return FALSE;
    }
    
    public function checkpermissiontype($module, $m_action, $user_type) {

        $where = array('user_type' => $user_type, 'module' => $module);
        $this->db->where('status !=', 13);
        $this->db->from('user_permission');
        $this->db->where($where);
        $dataps = $this->db->get()->row();

        if ($dataps) {
            $act = unserialize($dataps->m_action);
            if ($act) {
                if (in_array($m_action, $act)) {
                    return TRUE;
                } else {
                    return FALSE;
                }
            }
            return FALSE;
        }
        return FALSE;
    }

    function getTotalALL($table, $from = NULL, $limit = NULL) {

        $sql = "SELECT * FROM $table  WHERE  status  = 1 ORDER BY  id DESC";

        if (empty($from)) {
            $sql .= " LIMIT 0, 15 ";
        } else {
            $sql .= " LIMIT $from,$limit ";
        }

        $query = $this->db->query($sql);

        // $query = $this->db->get() ; 

        return $query->result_array();
    }

    function getTotalWhere($table, $from = NULL, $limit = NULL, $department = NULL, $pid = NULL) {

        $sql = "SELECT * FROM $table  WHERE  status  = 1 ";
        if (!empty($department)) {
            $sql.=" AND department_id='$department'";
        }
        if (!empty($pid)) {
            $sql.="AND product_id='$pid'";
        }

        if (empty($from)) {
            $sql .= " LIMIT 0, 15 ";
        } else {
            $sql .= " LIMIT $from,$limit ";
        }


        $query = $this->db->query($sql);

        // $query = $this->db->get() ; 

        return $query->result_array();
    }

    function getTotalRow($table) {

        $sql = "SELECT * FROM $table WHERE status  = 1 ";
        $query = $this->db->query($sql);
        return $query->num_rows();
    }

    function getTotalRowdepartment($table, $department_id) {

        $sql = "SELECT * FROM $table WHERE status  = 1 ";
        $sql.="AND department_id='$department_id' ";
        $query = $this->db->query($sql);
        return $query->num_rows();
    }

    function getcollegebooks($cid) {

        $sql = "
                 SELECT b.id, b.book_code, b.book_name, cb.college_id, cb.book_id, cb.quantity
                 FROM books b, inventory_college cb 
                 WHERE 
                 cb.college_id = '{$cid}' 
                 AND cb.book_id = b.id 
                 ORDER BY b.book_name ASC
                ";

        $query = $this->db->query($sql);

        return $query->result_array();
    }

    /*
      public function active_update($table,$id)
      {
      $this->db->set('status'='1')
      $this->db->where('id', $id);
      return $this->db->update($table);
      } */
}
