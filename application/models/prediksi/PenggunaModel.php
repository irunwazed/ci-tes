<?php

class PenggunaModel extends CI_Model
{

    private $table, $tableRespon;

    public function __construct()
    {
        parent::__construct();
        $this->table = 'users';
    }

    public function selectAll(){
        $hasil = $this->db->get($this->table)->result_array();
		return $hasil;
    }

    public function selectOne($id){
        $this->db->where('id', $id);
        $hasil = $this->db->get($this->table)->result_array();
		return $hasil;
    }

    public function insert($post){
        
        $this->load->library('MyConfig');
        $hasil = $this->db->insert($this->table, array(
            'username' => $post['username'],
            'password' => $this->myconfig->password_hash($post['password']),
            'level' => 1
        ));
        
		return $hasil;
    }

    public function update($post){
        
        $this->load->library('MyConfig');
        $this->db->where('id', $post['id']);
        $hasil = $this->db->update($this->table, array(
            'username' => $post['username'],
            'password' => $this->myconfig->password_hash($post['password']),
            'level' => 1
        ));
        
		return $hasil;
    }

    public function delete($id){
        $cek = $this->db->get($this->table)->num_rows();
        $hasil = false;
        // print_r($cek);
        // die();
        if($cek > 1){
            $this->db->where('id', $id);
            $hasil = $this->db->delete($this->table);
        }

        
		return $hasil;
    }

}