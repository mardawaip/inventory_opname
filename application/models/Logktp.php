<?php

class Logktp extends CI_Model{
    public function count_all($table)
    {
        $this->db->from($table);

        return $this->db->count_all_results();
    }

    public function simpan($table, $data){
        $exe = $this->db->insert($table,$data);

        return $exe;
    }

    public function edit($table, $id, $data){
        $exe = $this->db->set($data);
        $this->db->where($id);
        $this->db->update($table);

        return $exe;
    }

    public function hapus($table, $data){
        $exe = $this->db->delete($table,$data);

        return $exe;
    }

    public function get_alldata($table,$perpage,$offset){
        if ($perpage != -1) {
            $this->db->select('*');
            $this->db->from($table);
            $this->db->limit($perpage,$offset);
            $this->db->order_by('tanggal', 'ASC');
            $result = $this->db->get()->result();

            return $result;
        }
    }

    public function search_alldata($table,$perpage,$offset,$search){
        
        $this->db->select('*');
        $this->db->from($table);
        $this->db->like('NAMA_BARANG',$search,'both');
        $this->db->limit($perpage,$offset);
        $result = $this->db->get()->result();

        return $result;
    }

    public function count_search($table, $cari){
        $this->db->select('*');
        $this->db->from($table);
        $this->db->like('NAMA_BARANG',$cari,'both');
        $query = $this->db->get();

        return $query->num_rows();
    }
}