<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserController extends CI_Controller {

    private $baseTemplate, $baseUrl;

    public function __construct()
    {
        parent::__construct();
        $this->baseTemplate = base_url('public/template/');
        $this->baseUrl = base_url();
        
		// $this->load->library('AdminTemplate');
		// $this->admintemplate->cekLevel('admin');
    }

	public function beranda()
	{
        if(!@$this->session->userdata('id')){
            redirect(base_url('login'));
        }
        $config['baseTemplate'] = $this->baseTemplate;
        $data['baseTemplate'] = $this->baseTemplate;

        $config['baseUrl'] = $this->baseUrl;
        $data['baseUrl'] = $this->baseUrl;


        $data['head'] = $this->load->view('include/head', $config, true);
        $data['header'] = $this->load->view('include/header', $config, true);
        $data['sidebar'] = $this->load->view('include/sidebar', $config, true);
        $data['footer'] = $this->load->view('include/footer', $config, true);
        $data['script'] = $this->load->view('include/script', $config, true);
        
		$this->load->view('component/beranda', $data);
    }
    


}
