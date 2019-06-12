<?php

class AirModel extends CI_Model
{
    private $table;

    public function __construct()
    {
        parent::__construct();
        $this->table = 'kebutuhan_air';
    }

    public function selectOneData($id){
        $this->db->join('finansial', 'finansial.finansial_id = '.$this->table.'.finansial_id', 'left');
        $this->db->join('finansial_barang', 'finansial_barang.finansial_id = finansial.finansial_id', 'left');
        $this->db->join('finansial_kategori', 'finansial_kategori.finansial_kategori_id = finansial_barang.finansial_kategori_id AND finansial_kategori.finansial_kategori_id = 4', 'left');
        
        $this->db->where('finansial.finansial_id', $id);
        // $this->db->where('finansial_kategori.finansial_kategori_id', 4);
        $hasil = $this->db->get($this->table)->result_array();
		return $hasil;
    }

    public function selectOneDataAir($id){
        $this->db->join('finansial', 'finansial.finansial_id = '.$this->table.'.finansial_id', 'left');
        $this->db->where($this->table.'.kebutuhan_air_id', $id);
        // $this->db->where('finansial_kategori.finansial_kategori_id', 4);
        $hasil = $this->db->get($this->table)->result_array();
		return $hasil;
    }

    public function selectData(){
        $this->db->join('finansial', 'finansial.finansial_id = '.$this->table.'.finansial_id', 'left');
        $hasil = $this->db->get($this->table)->result_array();
		return $hasil;
    }

    public function create($post){
        $hasil = $this->db->insert($this->table, array(
            'finansial_id' => $post['finansial'],
            'kebutuhan_air_jp' => $post['jp'],
            'kebutuhan_air_jdu' => $post['jdu'],
            'kebutuhan_air_jdhu' => $post['jhdu'],
        ));
        return $hasil;
    }

    public function update($post){
        $this->db->where('kebutuhan_air_id', $post['id']);
        $hasil = $this->db->update($this->table, array(
            'finansial_id' => $post['finansial'],
            'kebutuhan_air_jp' => $post['jp'],
            'kebutuhan_air_jdu' => $post['jdu'],
            'kebutuhan_air_jdhu' => $post['jhdu'],
        ));
        return $hasil;
    }

    public function delete($post){
        $this->db->where('kebutuhan_air_id', $post['id']);
        $hasil = $this->db->delete($this->table);
        return $hasil;
    }

}