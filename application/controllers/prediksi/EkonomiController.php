<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class EkonomiController extends CI_Controller {

    private $baseTemplate, $baseUrl;
    public function __construct()
    {
        parent::__construct();
        $this->baseTemplate = base_url('public/template/');
        $this->baseUrl = base_url();
        
        $this->load->library('AdminTemplate');
        $this->load->model('prediksi/EkonomiModel');
		// $this->admintemplate->cekLevel('admin');
    }

    public function perhitungan(){

        $config['baseTemplate'] = $this->baseTemplate;
        $data['baseTemplate'] = $this->baseTemplate;

        $config['baseUrl'] = $this->baseUrl;
        $data['baseUrl'] = $this->baseUrl;

        $data['head'] = $this->load->view('include/head', $config, true);
        $data['header'] = $this->load->view('include/header', $config, true);
        $data['sidebar'] = $this->load->view('include/sidebar', $config, true);
        $data['footer'] = $this->load->view('include/footer', $config, true);
        $data['script'] = $this->load->view('include/script', $config, true);
        $data['myscript'] = $this->load->view('prediksi/finansial/script', $config, true);


        
        $data['dataEkonomi'] = $this->EkonomiModel->selectAllEkonomi();

        for($no = 0; $no < count($data['dataEkonomi']); $no++){
            $dataAll[$no] = $data['dataEkonomi'];
            $dataAll[$no]['dataKriteria'] = $this->EkonomiModel->selectKriteria($data['dataEkonomi'][$no]['ekonomi_id']);
            $dataAll[$no]['dataRespon'] = $this->EkonomiModel->selectRespon($data['dataEkonomi'][$no]['ekonomi_id']);
            $dataAll[$no]['dataKriteriaRespon'] = $this->EkonomiModel->selectKriteriaRespon($data['dataEkonomi'][$no]['ekonomi_id']);
        }
        $data['dataEkonomi'] = $dataAll;
        $data['isi'] = $this->load->view("prediksi/ekonomi-perhitungan/data", $data, true);

        $this->admintemplate->templateAll($data);
    }

    public function bahanPenentuan(){
        $config['baseTemplate'] = $this->baseTemplate;
        $data['baseTemplate'] = $this->baseTemplate;

        $config['baseUrl'] = $this->baseUrl;
        $data['baseUrl'] = $this->baseUrl;

        $data['head'] = $this->load->view('include/head', $config, true);
        $data['header'] = $this->load->view('include/header', $config, true);
        $data['sidebar'] = $this->load->view('include/sidebar', $config, true);
        $data['footer'] = $this->load->view('include/footer', $config, true);
        $data['script'] = $this->load->view('include/script', $config, true);
        $data['myscript'] = $this->load->view('prediksi/bahan-penentuan/script', $config, true);

        $data['isi'] = $this->load->view("prediksi/bahan-penentuan/data", $data, true);

        $this->admintemplate->templateAll($data);
        
    }

    public function bahanAllPenyedia($jenis = NULL){
        $config['baseTemplate'] = $this->baseTemplate;
        $data['baseTemplate'] = $this->baseTemplate;

        $config['baseUrl'] = $this->baseUrl;
        $data['baseUrl'] = $this->baseUrl;

        $data['jenis'] = $jenis;
        // echo $jenis;

        $data['head'] = $this->load->view('include/head', $config, true);
        $data['header'] = $this->load->view('include/header', $config, true);
        $data['sidebar'] = $this->load->view('include/sidebar', $config, true);
        $data['footer'] = $this->load->view('include/footer', $config, true);
        $data['script'] = $this->load->view('include/script', $config, true);
        $data['myscript'] = $this->load->view('prediksi/bahan-penyedia-all/script', $config, true);

        $data['bahan'] = $this->EkonomiModel->selectAllBahanPenyedia();

        if(@$this->input->get('id')){
            $id = $this->input->get('id');
            $data['dataPilih'] = $this->EkonomiModel->selectBahanPenyedia($id);
        }

        $data['isi'] = $this->load->view("prediksi/bahan-penyedia-all/data", $data, true);

        $this->admintemplate->templateAll($data);
    }

    public function bahanPenyedia($id, $jenis = NULL){
        $config['baseTemplate'] = $this->baseTemplate;
        $data['baseTemplate'] = $this->baseTemplate;

        $config['baseUrl'] = $this->baseUrl;
        $data['baseUrl'] = $this->baseUrl;

        $data['jenis'] = $jenis;

        $data['head'] = $this->load->view('include/head', $config, true);
        $data['header'] = $this->load->view('include/header', $config, true);
        $data['sidebar'] = $this->load->view('include/sidebar', $config, true);
        $data['footer'] = $this->load->view('include/footer', $config, true);
        $data['script'] = $this->load->view('include/script', $config, true);
        $data['myscript'] = $this->load->view('prediksi/bahan-penyedia/script', $config, true);

        $data['bahan'] = $this->EkonomiModel->selectBahanPenyedia($id);
        
        $data['isi'] = $this->load->view("prediksi/bahan-penyedia/data", $data, true);

        $this->admintemplate->templateAll($data);
        
    }

    public function bahanPenyediaTambah(){
        $post = $this->input->post();
        $result = $this->EkonomiModel->bahanPenyediaTambah($post);

        $this->pesan($result, 'Berhasil Memasukkan Data', 'Gagal Memasukkan Data');

        redirect(base_url('prediksi/bahan/penyedia'),'refresh');
    }

    public function bahanPenyediaEdit(){
        $post = $this->input->post();
        $result = $this->EkonomiModel->bahanPenyediaEdit($post);

        $this->pesan($result, 'Berhasil Mengedit Data', 'Gagal Mengedit Data');

        redirect(base_url('prediksi/bahan/penyedia'),'refresh');
    }
    
    public function bahanPenyediaHapus($id){
        $post = $this->input->post();
        $post['bahan_penyedia_id'] = $id;
        $result = $this->EkonomiModel->bahanPenyediaHapus($post);

        $this->pesan($result, 'Berhasil Menghapus Data', 'Gagal Menghapus Data');

        redirect(base_url('prediksi/bahan/penyedia'),'refresh');
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