<?php

class Incoming extends CI_Model{
    public function count_all($table)
    {
        $this->db->from($table);
        return $this->db->count_all_results();
    }

    public function get_alldata($table,$perpage,$offset){
       
        if ($perpage != -1) {
            $this->db->select('*');
            $this->db->from($table);
            $this->db->join('tb_order','tb_order.ID_ORDER = tb_penerimaan.ID_ORDER');
            $this->db->join('tb_permintaan','tb_permintaan.ID_PERMINTAAN = tb_order.ID_PERMINTAAN');
            $this->db->join('tb_barang','tb_barang.ID_BARANG = tb_permintaan.ID_BARANG');
            $this->db->join('tb_vendor','tb_vendor.ID_VENDOR = tb_barang.ID_VENDOR');
            
            $this->db->limit($perpage,$offset);
        $result = $this->db->get()->result();
        return $result;
        }
        
    }

    public function search_alldata($table,$perpage,$offset,$search){
        
        $this->db->select('*');
        $this->db->from($table);
        $this->db->join('tb_order','tb_order.ID_ORDER = tb_penerimaan.ID_ORDER');
        $this->db->join('tb_permintaan','tb_permintaan.ID_PERMINTAAN = tb_order.ID_PERMINTAAN');
        $this->db->join('tb_barang','tb_barang.ID_BARANG = tb_permintaan.ID_BARANG');
        $this->db->join('tb_vendor','tb_vendor.ID_VENDOR = tb_barang.ID_VENDOR');
        $this->db->like('tb_barang.NAMA_BARANG',$search,'both');
        
        
        $this->db->limit($perpage,$offset);
        $result = $this->db->get()->result();
        return $result;
    }

    public function count_search($table, $cari){
        $this->db->select('*');
        $this->db->from($table);
        $this->db->join('tb_order','tb_order.ID_ORDER = tb_penerimaan.ID_ORDER');
        $this->db->join('tb_permintaan','tb_permintaan.ID_PERMINTAAN = tb_order.ID_PERMINTAAN');
        $this->db->join('tb_barang','tb_barang.ID_BARANG = tb_permintaan.ID_BARANG');
        $this->db->join('tb_vendor','tb_vendor.ID_VENDOR = tb_barang.ID_VENDOR');
        $this->db->like('tb_barang.NAMA_BARANG',$cari,'both');
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function simpan($table, $data){
        $exe = $this->db->insert($table,$data);
        return $exe;
    }

    public function update($table, $id, $data){
        $exe = $this->db->set($data);
        $this->db->where($id);
        $this->db->update($table);
        return $exe;
    }
}