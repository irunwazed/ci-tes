<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->view('welcome_message');
	}

	public function coba()
	{
		$this->load->library('FungsiMatrix');
		$this->load->library('FungsiMatrixSVD');
		$a = array();
		$a[] = array(1, 2, 3);
		$a[] = array(4, 5, 6);
		$a[] = array(7, 8, 9);
		$a[] = array(10, 11, 12);
		// Matriks B
		$b = array();
		$b[] = array(1, 2, 3, 4);
		$b[] = array(5, 6, 7, 8);
		$b[] = array(9, 10, 11, 12);
		
		$data['data'] = $this->fungsimatrix->perkalianMatriks($a, $b);
		$this->load->view('pages/coba', $data);
	}

	public function coba2()
	{
		$data = array();
		$this->load->view('pages/coba2', $data);
	}
}
