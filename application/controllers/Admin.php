<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->model('verif');
        $this->verif->cek_session('admin');
        $this->load->model('login');
        $this->load->model('logktp');
    }

    public function index(){
        $this->load->view('admin/home');
    }

    public function pengguna()
    {
        $this->load->view('admin/pengguna');
    }
    public function blankoktp()
    {
        $this->load->view('admin/blankoktp');
    }
    public function blankokia()
    {
        $this->load->view('admin/blankokia');
    }
    public function pengajuan()
    {
        $atasan_1 = $this->getPihakAtasan();
        $atasan_2 = $this->getPihakAtasan();
        $status_pengajuan = $this->getStatusPengajuan();

        $this->load->view('admin/pengajuan', [
            'atasan_1' => $atasan_1,
            'atasan_2' => $atasan_2,
            'status_pengajuan' => $status_pengajuan
        ]);
    }

    public function getPihakAtasan()
    {
        return $this->db->get('atasan')->result();
    }

    public function getStatusPengajuan()
    {
        return $this->db->get('status_pengajuan')->result();
    }

    // USER ---------------------------------------------------------
    public function add_user()
    {
        $user = $this->input->post('user_name');
        $pass = sha1($this->input->post('pass'));
        $level = $this->input->post('level');

        $data_user = array(
            'NAMA_USER'=> $user,
            'PASSWORD' => $pass,
            'LEVEL_USER' => $level
        );

        $hasil = $this->login->insert_data('tb_user', $data_user);
        if ($hasil) {
            echo "success";
        }else{
            echo "gagal";
        }
    }

    public function hapus_user()
    {
        $id = $this->input->post('id');
        
        $data_user= array(
            'ID_USER'=> $id
        );

        $hasil = $this->login->hapus_data('tb_user', $data_user);
        if ($hasil) {
          echo "success";
        } else {
            echo "gagal";
        }
    }

    public function edit_user()
    {
        $id = array('ID_USER' => $this->input->post('id')
            );
        $data = array(
            'LEVEL_USER'=> $this->input->post('level')
        );

        $hasil = $this->login->update_data('tb_user',$id, $data);

        if ($hasil) {
           echo "success";
        }else{
            echo "gagal";
        }
    }

    public function datatable_user()
    {
        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        
        $record = $this->login->count_all('tb_user');
        $totalFiltered = $record;
        
        if(empty($this->input->post('search')['value'])){
            $posts = $this->login->get_alldata('tb_user',$limit,$start);
        }else {
            $search = $this->input->post('search')['value']; 
            $posts =  $this->login->search_alldata('tb_user',$limit,$start,$search);
            $totalFiltered = $this->login->count_search('tb_user',$search);
        }

        $no = $start;
        $data = array();
        if(!empty($posts)){
            foreach ($posts as $post){
                $no++;
                
                $nestedData['no'] = "";
                $nestedData['ID_USER'] = $post->ID_USER;
                $nestedData['NAMA_USER'] = $post->NAMA_USER;
                $nestedData['PASSWORD'] = $post->PASSWORD;
                $nestedData['LEVEL_USER'] = $post->LEVEL_USER;
               
                $data[] = $nestedData;

            } 
        }

        $json_data = array(
            'draw'            => intval($this->input->post('draw')),  
            'recordsTotal'    => intval($record),  
            'recordsFiltered' => intval($totalFiltered), 
            'data'            => $data   
        );
    
        echo json_encode($json_data); 
    }

    // END USER ------------------------------------------------------

    // KTP -----------------------------------------------------------

    public function add_ktp()
    {
        $tanggal = $this->input->post('tanggal');
        $terima = $this->input->post('terima');
        $terpakai = $this->input->post('terpakai');
        $return = $this->input->post('return');
        $total_cetak = $this->input->post('total_cetak');
        $sisa = $this->input->post('sisa');
        $keterangan = $this->input->post('keterangan');

        $data = array(
            'log_ktp_id' => $this->login->gen_uuid(),
            'tanggal' => $tanggal,
            'terima' => $terima,
            'terpakai' => $terpakai,
            'return' => $return,
            'total_cetak' => $total_cetak,
            'sisa' => $sisa,
            'keterangan' => $keterangan,
        );

        $cek = $this->login->check2('log_ktp', ['tanggal' => $tanggal]);

        if($cek){
            unset($data['log_ktp_id']);
            $hasil = $this->login->update_data('log_ktp', ['tanggal' => $tanggal], $data);
        }else{
            $hasil = $this->login->insert_data('log_ktp', $data);
        }

        if ($hasil) {
            echo "success";
        }else{
            echo "gagal";
        }
    }

    public function hapus_ktp()
    {
        $tanggal = $this->input->post('tanggal');
        
        $data= array(
            'tanggal'=> $tanggal
        );

        $hasil = $this->login->hapus_data('log_ktp', $data);
        if ($hasil) {
          echo "success";
        } else {
            echo "gagal";
        }
    }

    public function datatable_blank_ktp()
    {
        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        
        $record = $this->logktp->count_all('log_ktp');
        $totalFiltered = $record;
        
        if(empty($this->input->post('search')['value'])){            
            $posts = $this->logktp->get_alldata('log_ktp',$limit,$start);
        }else{
            $search = $this->input->post('search')['value']; 
            $posts =  $this->logktp->search_alldata('log_ktp',$limit,$start,$search);
            $totalFiltered = $this->logktp->count_search('log_ktp',$search);
        }

        $no = $start;
        $data = array();

        if(!empty($posts)){
            foreach ($posts as $post){            
                $no++;
                $nestedData['log_ktp_id'] = $post->log_ktp_id;
                $nestedData['tanggal'] = $post->tanggal;
                $nestedData['terima'] = $post->terima;
                $nestedData['terpakai'] = $post->terpakai;
                $nestedData['return'] = $post->return;
                $nestedData['total_cetak'] = $post->total_cetak;
                $nestedData['sisa'] = $post->sisa;
                $nestedData['keterangan'] = $post->keterangan;
                $nestedData['create_date'] = $post->create_date;
                $nestedData['last_update'] = $post->last_update;

                $data[] = $nestedData;
            } 
        }

        $json_data = array(
            'draw'            => intval($this->input->post('draw')),  
            'recordsTotal'    => intval($record),  
            'recordsFiltered' => intval($totalFiltered), 
            'data'            => $data   
        );

        echo json_encode($json_data);
    }

    // END KTP --------------------------------------------------------------------------------------

    // KIA ------------------------------------------------------------------------------------------

    public function add_kia()
    {
        $tanggal = $this->input->post('tanggal');
        $terima = $this->input->post('terima');
        $terpakai = $this->input->post('terpakai');
        $return = $this->input->post('return');
        $total_cetak = $this->input->post('total_cetak');
        $sisa = $this->input->post('sisa');
        $keterangan = $this->input->post('keterangan');

        $data = array(
            'log_kia_id' => $this->login->gen_uuid(),
            'tanggal' => $tanggal,
            'terima' => $terima,
            'terpakai' => $terpakai,
            'return' => $return,
            'total_cetak' => $total_cetak,
            'sisa' => $sisa,
            'keterangan' => $keterangan,
        );

        $cek = $this->login->check2('log_kia', ['tanggal' => $tanggal]);

        if($cek){
            unset($data['log_kia_id']);
            $hasil = $this->login->update_data('log_kia', ['tanggal' => $tanggal], $data);
        }else{
            $hasil = $this->login->insert_data('log_kia', $data);
        }

        if ($hasil) {
            echo "success";
        }else{
            echo "gagal";
        }
    }

    public function hapus_kia()
    {
        $tanggal = $this->input->post('tanggal');
        
        $data= array(
            'tanggal'=> $tanggal
        );

        $hasil = $this->login->hapus_data('log_kia', $data);
        if ($hasil) {
          echo "success";
        } else {
            echo "gagal";
        }
    }


    public function datatable_blank_kia()
    {
        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        
        $record = $this->logktp->count_all('log_kia');
        $totalFiltered = $record;
        
        if(empty($this->input->post('search')['value'])){            
            $posts = $this->logktp->get_alldata('log_kia',$limit,$start);
        }else{
            $search = $this->input->post('search')['value']; 
            $posts =  $this->logktp->search_alldata('log_kia',$limit,$start,$search);
            $totalFiltered = $this->logktp->count_search('log_kia',$search);
        }

        $no = $start;
        $data = array();

        if(!empty($posts)){
            foreach ($posts as $post){            
                $no++;
                $nestedData['log_kia_id'] = $post->log_kia_id;
                $nestedData['tanggal'] = $post->tanggal;
                $nestedData['terima'] = $post->terima;
                $nestedData['terpakai'] = $post->terpakai;
                $nestedData['return'] = $post->return;
                $nestedData['total_cetak'] = $post->total_cetak;
                $nestedData['sisa'] = $post->sisa;
                $nestedData['keterangan'] = $post->keterangan;
                $nestedData['create_date'] = $post->create_date;
                $nestedData['last_update'] = $post->last_update;

                $data[] = $nestedData;
            } 
        }

        $json_data = array(
            'draw'            => intval($this->input->post('draw')),  
            'recordsTotal'    => intval($record),  
            'recordsFiltered' => intval($totalFiltered), 
            'data'            => $data   
        );

        echo json_encode($json_data);
    }

    // END KIA --------------------------------------------------------------------------------------------------

    // PENGAJUAN ------------------------------------------------------------------------------------------------

    public function add_pengajuan()
    {   
        $tanggal = $this->input->post('tanggal');
        $nomor = $this->input->post('nomor');
        $pihak_1 = $this->input->post('pihak_1');
        $pihak_2 = $this->input->post('pihak_2');
        $jumlah_ktp = $this->input->post('jumlah_ktp');
        $jumlah_kia = $this->input->post('jumlah_kia');
        $status_pengajuan = $this->input->post('status_pengajuan');

        $data = array(
            'tanggal' => $tanggal,
            'nomor' => $nomor,
            'pihak_1' => $pihak_1,
            'pihak_2' => $pihak_2,
            'jumlah_ktp' => $jumlah_ktp,
            'jumlah_kia' => $jumlah_kia,
            'status_pengajuan' => $status_pengajuan,
        );

        $cek = $this->login->check2('pengajuan', ['tanggal' => $tanggal]);

        if($cek){
            unset($data['pengajuan_id']);
            $hasil = $this->login->update_data('pengajuan', ['tanggal' => $tanggal], $data);
        }else{
            $hasil = $this->login->insert_data('pengajuan', $data);
        }

        if ($hasil) {
            echo "success";
        }else{
            echo "gagal";
        }
    }

    public function hapus_pengajuan()
    {
        $tanggal = $this->input->post('tanggal');
        
        $data= array(
            'tanggal'=> $tanggal
        );

        $hasil = $this->login->hapus_data('pengajuan', $data);
        if ($hasil) {
          echo "success";
        } else {
            echo "gagal";
        }
    }


    public function datatable_blank_pengajuan()
    {
        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        
        $record = $this->logktp->count_all('pengajuan');
        $totalFiltered = $record;
        
        if(empty($this->input->post('search')['value'])){            
            $posts = $this->logktp->get_alldata('pengajuan',$limit,$start);
        }else{
            $search = $this->input->post('search')['value']; 
            $posts =  $this->logktp->search_alldata('pengajuan',$limit,$start,$search);
            $totalFiltered = $this->logktp->count_search('pengajuan',$search);
        }

        $no = $start;
        $data = array();

        if(!empty($posts)){
            foreach ($posts as $post){            
                $no++;
                $nestedData['pengajuan_id'] = $post->pengajuan_id;
                $nestedData['tanggal'] = $post->tanggal;
                $nestedData['pihak_1'] = $post->pihak_1;
                $nestedData['pihak_2'] = $post->pihak_2;
                $nestedData['jumlah_ktp'] = $post->jumlah_ktp;
                $nestedData['jumlah_kia'] = $post->jumlah_kia;
                $nestedData['status_pengajuan'] = $post->status_pengajuan;
                $nestedData['create_date'] = $post->create_date;
                $nestedData['last_update'] = $post->last_update;
                $nestedData['nomor'] = $post->nomor;

                $data[] = $nestedData;
            } 
        }

        $json_data = array(
            'draw'            => intval($this->input->post('draw')),  
            'recordsTotal'    => intval($record),  
            'recordsFiltered' => intval($totalFiltered), 
            'data'            => $data   
        );

        echo json_encode($json_data);
    }

    // END PENGAJUAN ------------------------------------------------------------------------------------------------

}