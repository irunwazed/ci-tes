<?php

class AhpModel extends CI_Model
{

    private $table, $tableRespon;

    public function __construct()
    {
        parent::__construct();
        $this->table = 'ahp';
        $this->tableRespon = 'ahp_respon';
    }

    public function selectAll($post = array()){
        // print_r($post);
    	// $this->db->where('username', $post['user']);
        $hasil = $this->db->get($this->table)->result_array();
        
		return $hasil;
    }

    public function selectOneAhp($id){
        // print_r($post);
    	$this->db->where('id', $id);
        $hasil = $this->db->get($this->table)->result_array();
        
		return $hasil;
    }

    public function selectRespon($ahp_id){
        
        // $this->db->join('ahp', 'ahp.id= '.$this->tableRespon.'.ahp_id', 'left');
        $this->db->where($this->tableRespon.'.ahp_id', $ahp_id);
        $hasil = $this->db->get($this->tableRespon)->result_array();
        
		return $hasil;
    }

    public function selectOneRespon($id){
        
        $this->db->where($this->tableRespon.'.id', $id);
        $hasil = $this->db->get($this->tableRespon)->result_array();
        
		return $hasil;
    }

    public function insertAhp($post){
        $post = $this->security->xss_clean($post);
        $result = false;
        $result = $this->db->insert($this->table, array(
            'nama_ahp' => $post['nama'],
            'kriteria' => json_encode($post['kriteria']),
        ));
        return $result;
    }

    public function deleteAhp($post){
        $post = $this->security->xss_clean($post);
        $result = false;
        $this->db->where('id', $post['id']);
        $result = $this->db->delete($this->table);
        return $result;
    }

    

    public function editRespon($post){
        $post = $this->security->xss_clean($post);
        $result = false;
        $this->db->where('id', $post['idRespon']);
        $result = $this->db->update($this->tableRespon, array(
            'nama' => $post['nama'],
            'respon' => json_encode($post['kriteria']),
        ));
        return $result;
    }

    public function deleteRespon($id){
        $result = false;
        $this->db->where('id', $id);
        $result = $this->db->delete($this->tableRespon);
        return $result;
    }

    public function insertRespon($post){
        $result = false;
        $result = $this->db->insert($this->tableRespon, array(
            'ahp_id' => $post['id'],
            'nama' => $post['nama'],
            'respon' => json_encode($post['kriteria']),
        ));
        return $result;
    }


    
}