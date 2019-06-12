<?php

class LoginModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function cekLogin($post){
        // print_r($post);
    	$this->db->where('username', $post['user']);
    	$user = $this->db->get('users')->row();
    	$hasil = false;
    	if (password_verify($post['pass'], @$user->password)) {
		    $hasil = true;
		    $newdata = array(
               'username'  => $user->username,
               'id'     => $user->id,
               'level'     => $user->level,
               'logged_in' => TRUE
           	);
			$this->session->set_userdata($newdata);
		}
		return $hasil;
    }

}