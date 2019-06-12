<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LoginController extends CI_Controller {

    private $baseTemplate, $baseUrl;

    public function __construct()
    {
        parent::__construct();
        $this->baseTemplate = base_url('public/template/');
        $this->baseUrl = base_url();
        
		// $this->load->library('AdminTemplate');
		// $this->admintemplate->cekLevel('admin');
    }

	public function login()
	{
        $config['baseTemplate'] = $this->baseTemplate;
        $data['baseTemplate'] = $this->baseTemplate;

        $config['baseUrl'] = $this->baseUrl;
        $data['baseUrl'] = $this->baseUrl;


        $data['head'] = $this->load->view('include/head', $config, true);
        $data['footer'] = $this->load->view('include/footer', $config, true);
        $data['script'] = $this->load->view('include/script', $config, true);
        
		$this->load->view('pages/login', $data);
    }
    
    public function cekLogin(){
        $this->load->model('LoginModel');
        
        $post = $this->input->post();
        $result = $this->LoginModel->cekLogin($post);

        if($result){
            redirect(base_url('user'));
        }else{
            redirect(base_url('login'));
        }
    }

    public function logout(){
        session_destroy();
        redirect(base_url('login'));
    }


}
