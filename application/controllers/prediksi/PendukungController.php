<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PendukungController extends CI_Controller {

    private $baseTemplate, $baseUrl;

    public function __construct()
    {
        parent::__construct();
        $this->baseTemplate = base_url('public/template/');
        $this->baseUrl = base_url();
        
        $this->load->library('AdminTemplate');
        $this->load->library('MPE');
        $this->load->model('prediksi/FinansialModel');
        $this->load->model('prediksi/PendukungModel');

		// $this->admintemplate->cekLevel('admin');
    }

    public function satuan(){
        $config['baseTemplate'] = $this->baseTemplate;
        $data['baseTemplate'] = $this->baseTemplate;

        $config['baseUrl'] = $this->baseUrl;
        $data['baseUrl'] = $this->baseUrl;

        $data['head'] = $this->load->view('include/head', $config, true);
        $data['header'] = $this->load->view('include/header', $config, true);
        $data['sidebar'] = $this->load->view('include/sidebar', $config, true);
        $data['footer'] = $this->load->view('include/footer', $config, true);
        $data['script'] = $this->load->view('include/script', $config, true);
        $data['myscript'] = $this->load->view('prediksi/satuan/script', $config, true);
        
        if(@$this->input->get('id') && @$this->input->get('tombol') == 'edit'){
            $data['dataPilih'] = $this->PendukungModel->selectOneSatuan($this->input->get('id'));
        }else{
            $data['data'] = $this->FinansialModel->selectAllSatuan();
    
        }

        $data['isi'] = $this->load->view('prediksi/satuan/table', $data, true);
        $this->admintemplate->templateAll($data);
    }

    public function satuanInput(){
        $post = $this->input->post();
        $result = $this->PendukungModel->satuanInput($post);

        $this->pesan($result, 'Berhasil Memasukkan Data', 'Gagal Memasukkan Data');

        redirect(base_url('prediksi/pendukung/satuan'),'refresh');
    }

    public function satuanEdit(){
        $post = $this->input->post();
        $result = $this->PendukungModel->satuanEdit($post);

        $this->pesan($result, 'Berhasil Mengubah Data', 'Gagal Mengubah Data');

        redirect(base_url('prediksi/pendukung/satuan'),'refresh');
    }

    public function satuanHapus($id){
        $post = $this->input->post();
        $post['id'] = $id;
        $result = $this->PendukungModel->satuanHapus($post);
        
        $this->pesan($result, 'Berhasil Menghapus Data', 'Gagal Menghapus Data');

        redirect(base_url('prediksi/pendukung/satuan'));
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