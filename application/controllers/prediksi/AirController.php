<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AirController extends CI_Controller {

    private $baseTemplate, $baseUrl;
    public function __construct(){

        parent::__construct();
        $this->baseTemplate = base_url('public/template/');
        $this->baseUrl = base_url();
        $this->load->library('AdminTemplate');
        $this->load->library('MPE');
        $this->load->model('prediksi/AirModel');
        $this->load->model('prediksi/FinansialModel');
    }

    public function getData(){
        $config['baseTemplate'] = $this->baseTemplate;
        $data['baseTemplate'] = $this->baseTemplate;

        $config['baseUrl'] = $this->baseUrl;
        $data['baseUrl'] = $this->baseUrl;

        $data['head'] = $this->load->view('include/head', $config, true);
        $data['header'] = $this->load->view('include/header', $config, true);
        $data['sidebar'] = $this->load->view('include/sidebar', $config, true);
        $data['footer'] = $this->load->view('include/footer', $config, true);
        $data['script'] = $this->load->view('include/script', $config, true);
        $data['myscript'] = $this->load->view('prediksi/air/script', $config, true);

        $data['dataAir'] = $this->AirModel->selectData();
        $data['dataFinansial'] = $this->FinansialModel->selectAll();

        if(@$_GET['tombol'] == 'edit'){
            $data['dataPilih'] = @$this->AirModel->selectOneDataAir(@$_GET['id'])[0];
        }
        
        $data['isi'] = $this->load->view("prediksi/air/data", $data, true);

        $this->admintemplate->templateAll($data);
    }

    public function hitung($id = null){
        $config['baseTemplate'] = $this->baseTemplate;
        $data['baseTemplate'] = $this->baseTemplate;

        $config['baseUrl'] = $this->baseUrl;
        $data['baseUrl'] = $this->baseUrl;

        $data['head'] = $this->load->view('include/head', $config, true);
        $data['header'] = $this->load->view('include/header', $config, true);
        $data['sidebar'] = $this->load->view('include/sidebar', $config, true);
        $data['footer'] = $this->load->view('include/footer', $config, true);
        $data['script'] = $this->load->view('include/script', $config, true);
        $data['myscript'] = $this->load->view('prediksi/air-hitung/script', $config, true);
        $data['id'] = $id;
        $data['dataAir'] = $this->AirModel->selectOneData($id);
        
        $data['isi'] = $this->load->view("prediksi/air-hitung/data", $data, true);

        $this->admintemplate->templateAll($data);
    }

    public function create(){
        $post = $this->input->post();
        $result = $this->AirModel->create($post);

        $this->pesan($result, 'Berhasil Memasukkan Data', 'Gagal Memasukkan Data');

        redirect(base_url('prediksi/kebutuhan-air'),'refresh');
    }

    public function update(){
        $post = $this->input->post();
        $result = $this->AirModel->update($post);

        $this->pesan($result, 'Berhasil Mengubah Data', 'Gagal Mengubah Data');

        redirect(base_url('prediksi/kebutuhan-air'),'refresh');
    }

    public function delete($id = null){
        $post = $this->input->post();
        $post['id'] = $id;
        $result = $this->AirModel->delete($post);

        $this->pesan($result, 'Berhasil Menghapus Data', 'Gagal Menghapus Data');

        redirect(base_url('prediksi/kebutuhan-air'),'refresh');
    }

    public function savePdf($id = null, $save = 1){
        $config['baseTemplate'] = $this->baseTemplate;
        $data['baseTemplate'] = $this->baseTemplate;

        $config['baseUrl'] = $this->baseUrl;
        $data['baseUrl'] = $this->baseUrl;

        $data['head'] = $this->load->view('include/head', $config, true);
        $data['header'] = $this->load->view('include/header', $config, true);
        $data['sidebar'] = $this->load->view('include/sidebar', $config, true);
        $data['footer'] = $this->load->view('include/footer', $config, true);
        $data['script'] = $this->load->view('include/script', $config, true);
        $data['myscript'] = $this->load->view('prediksi/air-hitung/script', $config, true);

        $data['dataAir'] = $this->AirModel->selectOneData($id);
        $data['id'] = $id;
        
        $post = $this->input->post();

        $this->load->library('M_pdf');
        if($save){
            $this->m_pdf->getPdf('Air', 'pdf/air', $data, 'miring');
        }else{
            $this->load->view('pdf/air', $data);

        }
        

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