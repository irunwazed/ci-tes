<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AhpController extends CI_Controller {

    private $baseTemplate, $baseUrl;

    public function __construct()
    {
        parent::__construct();
        $this->baseTemplate = base_url('public/template/');
        $this->baseUrl = base_url();
        
        $this->load->library('AdminTemplate');
        $this->load->library('AHP');
        $this->load->model('prediksi/AhpModel');
		// $this->admintemplate->cekLevel('admin');
    }

	public function formAhp($ahp_id = 1)
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
        $data['myscript'] = $this->load->view('prediksi/ahp/myscript', $config, true);

        $data['ahp_id'] = $ahp_id;
        $data['id'] = $ahp_id;
        

        $data['dataAhpRespon'] = array();


        $post = $this->input->post();
        $data['dataAhp'] = $this->AhpModel->selectOneAhp($ahp_id);
        $data['dataAhpRespon'] = $this->AhpModel->selectRespon($ahp_id);
        
        if(@$this->input->get('id') && @$this->input->get('tombol') == 'edit'){
            $data['dataOneRespon'] = $this->AhpModel->selectOneRespon($this->input->get('id'));
        }

        $data['isi'] = $this->load->view('prediksi/ahp/ahp', $data, true);
        $this->admintemplate->templateAll($data);

		
    }

    public function daftarAhp($page = 1){

        $config['baseTemplate'] = $this->baseTemplate;
        $data['baseTemplate'] = $this->baseTemplate;

        $config['baseUrl'] = $this->baseUrl;
        $data['baseUrl'] = $this->baseUrl;


        $data['head'] = $this->load->view('include/head', $config, true);
        $data['header'] = $this->load->view('include/header', $config, true);
        $data['sidebar'] = $this->load->view('include/sidebar', $config, true);
        $data['footer'] = $this->load->view('include/footer', $config, true);
        $data['script'] = $this->load->view('include/script', $config, true);
        
        $data['data'] = $this->AhpModel->selectAll();

        if(@$_GET['tombol']=="edit"){
            $data['dataPilih'] = $this->AhpModel->selectOneAhp(@$_GET['id']);
            $data['dataPilih'] = @$data['dataPilih'][0];
            $data['dataPilih']['kriteria'] = json_decode(@$data['dataPilih']['kriteria']);
        }
        
        $data['myscript'] = $this->load->view('prediksi/ahp-all/myscript', $data, true);
        $data['isi'] = $this->load->view('prediksi/ahp-all/ahp', $data, true);
        $this->admintemplate->templateAll($data);

    }

    public function addAhp(){
        $post = $this->input->post();
        $result = $this->AhpModel->insertAhp($post);

        $this->pesan($result, 'Berhasil Memasukkan Data', 'Gagal Memasukkan Data');

        redirect(base_url('prediksi/ahp'));

    }

    public function updateAhp(){
        $post = $this->input->post();
        $result = $this->AhpModel->updateAhp($post);

        $this->pesan($result, 'Berhasil Mengubah Data', 'Gagal Mengubah Data');

        redirect(base_url('prediksi/ahp'));

    }

    public function deleteAhp($id){
        $post = $this->input->post();
        $post['id'] = $id;
        $result = $this->AhpModel->deleteAhp($post);

        $this->pesan($result, 'Berhasil Menghapus Data', 'Gagal Menghapus Data');

        redirect(base_url('prediksi/ahp'));

    }

    public function insertResponAhp(){
        $post = $this->input->post();
        $result = $this->AhpModel->insertRespon($post);

        $this->pesan($result, 'Berhasil Memasukkan Data', 'Gagal Memasukkan Data');

        redirect(base_url('prediksi/ahp/'.$post['id']));
    }

    public function editResponAhp(){
        $post = $this->input->post();
        $result = $this->AhpModel->editRespon($post);
        
        $this->pesan($result, 'Berhasil Mengedit Data', 'Gagal Mengedit Data');

        redirect(base_url('prediksi/ahp/'.$post['id']));
    }

    public function deleteResponAhp($id, $ahp_id){
        // $post = $this->input->post();
        $result = $this->AhpModel->deleteRespon($id);

        $this->pesan($result, 'Berhasil Menghapus Data', 'Gagal Menghapus Data');

        redirect(base_url('prediksi/ahp/'.$ahp_id));
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
        $data['myscript'] = $this->load->view('prediksi/ahp/myscript', $config, true);

        $data['ahp_id'] = $id;
        $data['id'] = $id;

        $data['dataAhpRespon'] = array();


        $post = $this->input->post();
        $data['dataAhp'] = $this->AhpModel->selectOneAhp($id);
        $data['dataAhpRespon'] = $this->AhpModel->selectRespon($id);
        
        if(@$this->input->get('id') && @$this->input->get('tombol') == 'edit'){
            $data['dataOneRespon'] = $this->AhpModel->selectOneRespon($this->input->get('id'));
        }
        

        $data['id'] = $id;
        
        $post = $this->input->post();

        $this->load->library('M_pdf');
        if($save){
            $this->m_pdf->getPdf('Air', 'pdf/ahp', $data, 'miring');
        }else{
            $this->load->view('pdf/ahp', $data);

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
