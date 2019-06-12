<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MpeController extends CI_Controller {

    private $baseTemplate, $baseUrl;

    public function __construct()
    {
        parent::__construct();
        $this->baseTemplate = base_url('public/template/');
        $this->baseUrl = base_url();
        
        $this->load->library('AdminTemplate');
        $this->load->library('MPE');
        $this->load->model('prediksi/MpeModel');
		// $this->admintemplate->cekLevel('admin');
    }

	public function formMpe($id = 1, $menu = 0)
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
        $data['myscript'] = $this->load->view('prediksi/mpe/myscript', $config, true);

        $data['id'] = $id;
        
        $data['dataMpe'] = $this->MpeModel->selectMpe($id);
        $data['dataKriteria'] = $this->MpeModel->selectKriteria($id);
        $data['dataRespon'] = $this->MpeModel->selectRespon($id);
        $data['dataWilayah'] = $this->MpeModel->selectWilayah($id);
        $data['dataKriteriaRespon'] = $this->MpeModel->selectKriteriaRespon($id);
        $data['dataWilayahKriteria'] = $this->MpeModel->selectWilayahKriteria($id);
        
        
        $post = $this->input->post();
        
        if(@$this->input->get('id') && @$this->input->get('tombol') == 'edit'){
            $data['dataOneKriteriaRespon'] = $this->MpeModel->selectOneKriteriaRespon($this->input->get('id'));
            $data['dataOneWilayahKriteria'] = $this->MpeModel->selectOneWilayahKriteria($this->input->get('id'));
        }
        
        $data['isi'] = $this->load->view('prediksi/mpe/mpe', $data, true);
        $this->admintemplate->templateAll($data);
    }

    public function daftarMpe($page = 1, $menu = 0){

        $config['baseTemplate'] = $this->baseTemplate;
        $data['baseTemplate'] = $this->baseTemplate;

        $config['baseUrl'] = $this->baseUrl;
        $data['baseUrl'] = $this->baseUrl;

        $namaMenu = array(
            "MPE",
            "Metode Pemilihan Produk",
            "Sistem Pengadaan Bahan Baku",
            "Metode Penentuan Lokasi Agroindustri",
            "Dengan Limbah",
        );

        $data['head'] = $this->load->view('include/head', $config, true);
        $data['header'] = $this->load->view('include/header', $config, true);
        $data['sidebar'] = $this->load->view('include/sidebar', $config, true);
        $data['footer'] = $this->load->view('include/footer', $config, true);
        $data['script'] = $this->load->view('include/script', $config, true);
        $data['myscript'] = $this->load->view('prediksi/mpe-all/myscript', $config, true);
        $data['menu'] = $menu;
        $data['data'] = $this->MpeModel->selectMenu($menu);
        $data['namaMenu'] = $namaMenu[$menu];
        

        for($i =0; $i < count($data['data']); $i++){
            $id = $data['data'][$i]['mpe_id'];
            $data['data'][$i]['dataKriteria'] = $this->MpeModel->selectKriteria($id);
            $data['data'][$i]['dataRespon'] = $this->MpeModel->selectRespon($id);
            $data['data'][$i]['dataWilayah'] = $this->MpeModel->selectWilayah($id);
        }

        $data['isi'] = $this->load->view('prediksi/mpe-all/mpe', $data, true);
        $this->admintemplate->templateAll($data);

    }

    public function addMpe(){
        $post = $this->input->post();
        $result = $this->MpeModel->insertMpe($post);

        $this->pesan($result, 'Berhasil Memasukkan Data', 'Gagal Memasukkan Data'); 

        redirect(base_url('mpe/'.$post['menu']));

    }

    public function deleteMpe($id){
        $post = $this->input->post();
        $result = $this->MpeModel->deleteMpe($id);

        $this->pesan($result, 'Berhasil Menghapus Data', 'Gagal Menghapus Data');

        redirect(base_url('mpe/'.@$_GET['menu']));

    }
    public function insertRespon(){
        $post = $this->input->post();
        $result = $this->MpeModel->insertRespon($post);

        $this->pesan($result, 'Berhasil Memasukkan Data', 'Gagal Memasukkan Data');

        redirect(base_url('prediksi/mpe/'.$post['id']));
    }

    public function editRespon(){
        $post = $this->input->post();
        $result = $this->MpeModel->editRespon($post);

        $this->pesan($result, 'Berhasil Mengedit Data', 'Gagal Mengedit Data');

        redirect(base_url('prediksi/mpe/'.$post['id']));
    }

    public function deleteRespon($id, $mpe_id){
        $result = $this->MpeModel->deleteRespon($id);

        $this->pesan($result, 'Berhasil Menghapus Data', 'Gagal Menghapus Data');

        redirect(base_url('prediksi/mpe/'.$mpe_id));
    }
    

    public function dumbInput(){
        $id = 1;
        $dataKriteria = $this->MpeModel->selectKriteria($id);
        $dataRespon = $this->MpeModel->selectRespon($id);
        $dataWilayah = $this->MpeModel->selectWilayah($id);

        for($no =0; $no < count($dataRespon); $no++){
            for($i = 0; $i < count($dataWilayah); $i++){
                for($j=0; $j< count($dataKriteria); $j++){
                    $data = array(
                        'mpe_respon_id' => $dataRespon[$no]['mpe_respon_id'],
                        'mpe_kriteria_id' => $dataKriteria[$j]['mpe_kriteria_id'],
                        'mpe_wilayah_id' => $dataWilayah[$i]['mpe_wilayah_id'],
                    );
                    $this->MpeModel->inputRandomWilayahKriteria($data);
                }
            }
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

    public function savePdf($id = null, $save = 1){
        $data['id'] = $id;
        
        $data['dataMpe'] = $this->MpeModel->selectMpe($id);
        $data['dataKriteria'] = $this->MpeModel->selectKriteria($id);
        $data['dataRespon'] = $this->MpeModel->selectRespon($id);
        $data['dataWilayah'] = $this->MpeModel->selectWilayah($id);
        $data['dataKriteriaRespon'] = $this->MpeModel->selectKriteriaRespon($id);
        $data['dataWilayahKriteria'] = $this->MpeModel->selectWilayahKriteria($id);
        
        $post = $this->input->post();
        
        if(@$this->input->get('id') && @$this->input->get('tombol') == 'edit'){
            $data['dataOneKriteriaRespon'] = $this->MpeModel->selectOneKriteriaRespon($this->input->get('id'));
            $data['dataOneWilayahKriteria'] = $this->MpeModel->selectOneWilayahKriteria($this->input->get('id'));
        }
        $this->load->library('M_pdf');
        if($save){
            $this->m_pdf->getPdf('mpe', 'pdf/mpe', $data, 'miring');
        }else{
            $this->load->view('pdf/mpe', $data);
        }
        


    }

}
