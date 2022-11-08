<?php

class Login extends CI_Model{
//=========check user for login==============
    function check($username, $password){
        $query = $this->db->get_where('tb_user', array('NAMA_USER' => $username, 'PASSWORD' => $password), 1);
        if ($query->num_rows()==1) {
           return $query->result();
        } else{
            return false;
        }
    }

    function check2($table, $where){
        $query = $this->db->get_where($table, $where, 1);
        if ($query->num_rows()==1) {
           return true;
        } else{
            return false;
        }
    }
//==========end check user for login==============
    function create($table, $data){
        $exe = $this->db->insert($table,$data);
        return $exe;

    }

//==========insert data to table============
    public function insert_data($table, $data){
        $exe = $this->db->insert($table,$data);
        return $exe;
    }
//==========end insert data to table============

//==========delete data from user==============

    public function hapus_data($table, $data){
    $exe = $this->db->delete($table,$data);
    return $exe;
}

//==========end delete data from table============

//==========update data from table==============

public function update_data($table,$id, $data){
    $exe = $this->db->set($data);
            $this->db->where($id);
            $this->db->update($table);
    return $exe;
}

//==========end update data from table============

//===========count all row on table================
    public function count_all($table)
    {
        $this->db->from($table);
        return $this->db->count_all_results();
    }
//===========end count all row on table================



    public function get_alldata($table,$perpage,$offset){
        if ($perpage != -1) {
            $this->db->limit(10,$offset);
            $result = $this->db->get('tb_user')->result();
            return $result;
        }
    }

    public function search_alldata($table,$perpage,$offset,$search){
        $this->db->select('*');
        $this->db->from($table);
        $this->db->like('NAMA_USER',$search,'both');
        
        
        $this->db->limit(10,$offset);
        $result = $this->db->get()->result();
        return $result;
    }

    public function count_search($table, $cari){
        $this->db->select('*');
        $this->db->from($table);
        $this->db->like('NAMA_USER',$cari,'both');
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function gen_uuid()
    {
        return sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
            mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),
            mt_rand( 0, 0xffff ),
            mt_rand( 0, 0x0fff ) | 0x4000,
            mt_rand( 0, 0x3fff ) | 0x8000,
            mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff )
        );
    }
}