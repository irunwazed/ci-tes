<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FinansialController extends CI_Controller {

    private $baseTemplate, $baseUrl;

    public function __construct()
    {
        parent::__construct();
        $this->baseTemplate = base_url('public/template/');
        $this->baseUrl = base_url();
        
        $this->load->library('AdminTemplate');
        $this->load->library('MPE');
        $this->load->model('prediksi/FinansialModel');
		// $this->admintemplate->cekLevel('admin');
    }

    public function daftar($page = 1){

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
        
        $data['data'] = $this->FinansialModel->selectAll();

        // for($i =0; $i < count($data['data']); $i++){
        //     $id = $data['data'][$i]['mpe_id'];
        //     $data['data'][$i]['dataKriteria'] = $this->MpeModel->selectKriteria($id);
        //     $data['data'][$i]['dataRespon'] = $this->MpeModel->selectRespon($id);
        //     $data['data'][$i]['dataWilayah'] = $this->MpeModel->selectWilayah($id);
        // }

        $data['isi'] = $this->load->view('prediksi/finansial/table', $data, true);
        $this->admintemplate->templateAll($data);
    }

    public function finansialInput(){
        $post = $this->input->post();
        $result = $this->FinansialModel->finansialInput($post);

        $this->pesan($result, 'Berhasil Memasukkan Data', 'Gagal Memasukkan Data');

        redirect(base_url('prediksi/finansial'),'refresh');
    }

    public function finansialHapus($id){
        $post = $this->input->post();
        $result = $this->FinansialModel->finansialHapus($id);

        $this->pesan($result, 'Berhasil Menghapus Data', 'Gagal Menghapus Data');

        redirect(base_url('prediksi/finansial'),'refresh');
    }

    public function perhitungan($id = 1)
	{
        $config['baseTemplate'] = $this->baseTemplate;
        $data['baseTemplate'] = $this->baseTemplate;

        $config['baseUrl'] = $this->baseUrl;
        $data['baseUrl'] = $this->baseUrl;

        $data['head'] = $this->load->view('include/head', $config, true);
        $data['header'] = $this->load->view('include/header', $config, true);
        $data['sidebar'] = $this->load->view('include/sidebar', $config, true);
        $data['footer'] = $this->load->view('include/footer', $config, true);
        $data['script'] = $this->load->view('include/script', $config, true);
        

        $data['id'] = $id;
        
        $data['dataFinansial'] = $this->FinansialModel->selectFinansial($id);
        $data['dataBiaya'] = $this->FinansialModel->selectBiaya($id);
        $data['dataPenerimaan'] = $this->FinansialModel->selectPenerimaan($id);
        $data['dataBahanBaku'] = $this->FinansialModel->selectBahanBaku($id);
        
        $data['dataOperasional'] = $this->FinansialModel->selectOperasional($id);
        // $data['dataKriteria'] = $this->MpeModel->selectKriteria($id);
        // $data['dataRespon'] = $this->MpeModel->selectRespon($id);
        // $data['dataWilayah'] = $this->MpeModel->selectWilayah($id);
        // $data['dataKriteriaRespon'] = $this->MpeModel->selectKriteriaRespon($id);
        // $data['dataWilayahKriteria'] = $this->MpeModel->selectWilayahKriteria($id);
        
        $post = $this->input->post();

        if(@$this->input->get('tombol')){
            $data['dataKategori'] = $this->FinansialModel->selectBahanKategori();
            $data['dataSatuan'] = $this->FinansialModel->selectAllSatuan();
            if(@$this->input->get('id') && @$this->input->get('tombol') == 'edit'){
                $data['dataPilih'] = $this->FinansialModel->selectOneBarang($this->input->get('id'));
                $config['dataPilih'] = $data['dataPilih'];
            }
            // $data['dataOneKriteriaRespon'] = $this->MpeModel->selectOneKriteriaRespon($this->input->get('id'));
            // $data['dataOneWilayahKriteria'] = $this->MpeModel->selectOneWilayahKriteria($this->input->get('id'));
        }
        $data['myscript'] = $this->load->view('prediksi/finansial-perhitungan/script', $config, true);
        $data['isi'] = $this->load->view('prediksi/finansial-perhitungan/table', $data, true);
        $this->admintemplate->templateAll($data);
    }

    // penetapan

    public function daftarPenetapan($page = 1){

        $config['baseTemplate'] = $this->baseTemplate;
        $data['baseTemplate'] = $this->baseTemplate;

        $config['baseUrl'] = $this->baseUrl;
        $data['baseUrl'] = $this->baseUrl;

        $config['status'] = 'penetapan';
        $data['status'] = 'penetapan';


        $data['head'] = $this->load->view('include/head', $config, true);
        $data['header'] = $this->load->view('include/header', $config, true);
        $data['sidebar'] = $this->load->view('include/sidebar', $config, true);
        $data['footer'] = $this->load->view('include/footer', $config, true);
        $data['script'] = $this->load->view('include/script', $config, true);
        $data['myscript'] = $this->load->view('prediksi/finansial/script', $config, true);
        
        $data['data'] = $this->FinansialModel->selectAll();

        

        $data['isi'] = $this->load->view('prediksi/finansial/table', $data, true);
        $this->admintemplate->templateAll($data);
    }

    public function perhitunganPenetapan($id = 1)
	{
        $config['baseTemplate'] = $this->baseTemplate;
        $data['baseTemplate'] = $this->baseTemplate;

        $config['baseUrl'] = $this->baseUrl;
        $data['baseUrl'] = $this->baseUrl;

        $config['status'] = 'penetapan';
        $data['status'] = 'penetapan';

        $data['head'] = $this->load->view('include/head', $config, true);
        $data['header'] = $this->load->view('include/header', $config, true);
        $data['sidebar'] = $this->load->view('include/sidebar', $config, true);
        $data['footer'] = $this->load->view('include/footer', $config, true);
        $data['script'] = $this->load->view('include/script', $config, true);
        

        $data['id'] = $id;
        
        $data['dataFinansial'] = $this->FinansialModel->selectFinansial($id);
        $data['dataBiaya'] = $this->FinansialModel->selectBiaya($id);
        $data['dataPenerimaan'] = $this->FinansialModel->selectPenerimaan($id);
        $data['dataBahanBaku'] = $this->FinansialModel->selectBahanBaku($id);
        
        $data['dataOperasional'] = $this->FinansialModel->selectOperasional($id);
        
        $data['status'] = 'penetapan';
        
        $post = $this->input->post();

        if(@$this->input->get('tombol')){
            $data['dataKategori'] = $this->FinansialModel->selectBahanKategori();
            $data['dataSatuan'] = $this->FinansialModel->selectAllSatuan();
            if(@$this->input->get('id') && @$this->input->get('tombol') == 'edit'){
                $data['dataPilih'] = $this->FinansialModel->selectOneBarang($this->input->get('id'));
                $config['dataPilih'] = $data['dataPilih'];
            }
            // $data['dataOneKriteriaRespon'] = $this->MpeModel->selectOneKriteriaRespon($this->input->get('id'));
            // $data['dataOneWilayahKriteria'] = $this->MpeModel->selectOneWilayahKriteria($this->input->get('id'));
        }
        $data['myscript'] = $this->load->view('prediksi/finansial-perhitungan/script', $config, true);
        $data['isi'] = $this->load->view('prediksi/finansial-perhitungan/table', $data, true);
        $this->admintemplate->templateAll($data);
    }

    // .penetapan

    public function bahan($page = 1){
        $config['baseTemplate'] = $this->baseTemplate;
        $data['baseTemplate'] = $this->baseTemplate;

        $config['baseUrl'] = $this->baseUrl;
        $data['baseUrl'] = $this->baseUrl;

        $data['head'] = $this->load->view('include/head', $config, true);
        $data['header'] = $this->load->view('include/header', $config, true);
        $data['sidebar'] = $this->load->view('include/sidebar', $config, true);
        $data['footer'] = $this->load->view('include/footer', $config, true);
        $data['script'] = $this->load->view('include/script', $config, true);
        $data['myscript'] = $this->load->view('prediksi/finansial-bahan/script', $config, true);
        
        $data['dataKategori'] = $this->FinansialModel->selectBahanKategori();
        
        if(@$this->input->get('id') && @$this->input->get('tombol') == 'edit'){
            $data['dataPilih'] = $this->FinansialModel->selectOneBahan($this->input->get('id'));
        }else{
            $data['data'] = $this->FinansialModel->selectAllBahan();
    
        }

        $data['isi'] = $this->load->view('prediksi/finansial-bahan/table', $data, true);
        $this->admintemplate->templateAll($data);
    }

    public function bahanInput(){
        $post = $this->input->post();
        $result = $this->FinansialModel->bahanInput($post);

        $this->pesan($result, 'Berhasil Memasukkan Data', 'Gagal Memasukkan Data');

        redirect(base_url('prediksi/finansial/bahan'),'refresh');
    }

    public function bahanEdit(){
        $post = $this->input->post();
        $result = $this->FinansialModel->bahanEdit($post);

        $this->pesan($result, 'Berhasil Mengubah Data', 'Gagal Mengubah Data');

        redirect(base_url('prediksi/finansial/bahan'),'refresh');
    }

    public function bahanHapus($id){
        $post = $this->input->post();
        $post['id'] = $id;
        $result = $this->FinansialModel->bahanHapus($post);
        
        $this->pesan($result, 'Berhasil Menghapus Data', 'Gagal Menghapus Data');

        redirect(base_url('prediksi/finansial/bahan'));
    }

    public function barangInput(){
        $post = $this->input->post();
        $result = $this->FinansialModel->barangInput($post);

        $this->pesan($result, 'Berhasil Memasukkan Data', 'Gagal Memasukkan Data');

        redirect(base_url('prediksi/finansial/'.$post['id']),'refresh');
    }

    public function barangEdit(){
        $post = $this->input->post();
        $result = $this->FinansialModel->barangEdit($post);

        $this->pesan($result, 'Berhasil Mengubah Data', 'Gagal Mengubah Data');

        redirect(base_url('prediksi/finansial/'.$post['id']),'refresh');
    }

    public function barangHapus($id, $finansial_id){
        $post = $this->input->post();
        $post['id'] = $id;
        $result = $this->FinansialModel->barangHapus($post);
        
        $this->pesan($result, 'Berhasil Menghapus Data', 'Gagal Menghapus Data');

        redirect(base_url('prediksi/finansial/'.$finansial_id),'refresh');
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

    public function apiGetBahan($kategori){
        $result = $this->FinansialModel->getBahan($kategori);

        $kirim = array(
            'data' => $result,
            'status' => true
        );

        echo json_encode($kirim);
    }

}