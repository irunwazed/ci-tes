<?php

class PendukungModel extends CI_Model
{

    private $table, $tableRespon;

    public function __construct()
    {
        parent::__construct();
        // $this->table = 'satuan';
    }

    public function selectOneSatuan($id){
        $this->db->where('satuan_id', $id);
        $hasil = $this->db->get('satuan')->result_array();
		return $hasil;
    }

    public function satuanInput($post){
        $hasil = $this->db->insert('satuan', array(
            'satuan_nama' => $post['satuan'],
        ));
		return $hasil;
    }

    public function satuanEdit($post){
        $this->db->where('satuan_id', $post['id']);
        $hasil = $this->db->update('satuan', array(
            'satuan_nama' => $post['satuan'],
        ));
		return $hasil;
    }

    public function satuanHapus($post){
        $this->db->where('satuan_id', $post['id']);
        $hasil = $this->db->delete('satuan');
		return $hasil;
    }

}