<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminController extends CI_Controller {

    private $baseTemplate, $baseUrl;

    public function __construct()
    {
        parent::__construct();
        $this->baseTemplate = base_url('public/template/');
        $this->baseUrl = base_url();
        
        $this->load->library('AdminTemplate');
        // $this->load->library('Myconofig');
        $this->load->model('prediksi/PenggunaModel');

		// $this->admintemplate->cekLevel('admin');
    }

    public function penggunaShow(){
        $config['baseTemplate'] = $this->baseTemplate;
        $data['baseTemplate'] = $this->baseTemplate;

        $config['baseUrl'] = $this->baseUrl;
        $data['baseUrl'] = $this->baseUrl;

        $data['head'] = $this->load->view('include/head', $config, true);
        $data['header'] = $this->load->view('include/header', $config, true);
        $data['sidebar'] = $this->load->view('include/sidebar', $config, true);
        $data['footer'] = $this->load->view('include/footer', $config, true);
        $data['script'] = $this->load->view('include/script', $config, true);
        $data['myscript'] = $this->load->view('prediksi/pengguna/script', $config, true);
        
        if(@$this->input->get('id') && @$this->input->get('tombol') == 'edit'){
            $data['dataPilih'] = $this->PenggunaModel->selectOne($this->input->get('id'));
        }else{
            $data['data'] = $this->PenggunaModel->selectAll();
    
        }

        $data['isi'] = $this->load->view('prediksi/pengguna/data', $data, true);
        $this->admintemplate->templateAll($data);
    }

    public function penggunaInsert(){
        $post = $this->input->post();
        $result = $this->PenggunaModel->insert($post);

        $this->pesan($result, 'Berhasil Memasukkan Data', 'Gagal Memasukkan Data');

        redirect(base_url('prediksi/pengguna'),'refresh');
    }

    public function penggunaUpdate(){
        $post = $this->input->post();
        $result = $this->PenggunaModel->update($post);

        $this->pesan($result, 'Berhasil Mengubah Data', 'Gagal Mengubah Data');

        redirect(base_url('prediksi/pengguna'),'refresh');
    }

    public function penggunaDelete($id){
        $post = $this->input->post();
        $post['id'] = $id;
        $result = $this->PenggunaModel->delete($id);
        
        $this->pesan($result, 'Berhasil Menghapus Data', 'Gagal Menghapus Data');

        redirect(base_url('prediksi/pengguna'));
    }

    public function pesan($result, $pesanBerhasil, $pesanGagal){
        if($result){
            $message = array('isi' => $pesanBerhasil,'class' => 'success');
            
        }else{
            $message = array('isi' => $pesanGagal,'class' => 'warning');
        }
        $this->session->set_flashdata('pesan', $message);
        $this->session->keep_flashdata('pesan', $message);
    }

}