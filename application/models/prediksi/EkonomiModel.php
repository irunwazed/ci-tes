<?php

class EkonomiModel extends CI_Model
{

    private $table;

    public function __construct()
    {
        parent::__construct();
        $this->table = 'ekonomi';
    }

    public function selectKriteria($id){
        $this->db->where('ekonomi_id', $id);
        $hasil = $this->db->get('ekonomi_kriteria')->result_array();
		return $hasil;
    }

    public function selectRespon($id){
        $this->db->where('ekonomi_id', $id);
        $hasil = $this->db->get('ekonomi_respon')->result_array();
		return $hasil;
    }

    public function selectAllEkonomi(){
        $hasil = $this->db->get('ekonomi')->result_array();
		return $hasil;
    }

    public function selectKriteriaRespon($id){
        $this->db->join('ekonomi_kriteria', 'ekonomi_kriteria.ekonomi_kriteria_id = ekonomi_kriteria_respon.ekonomi_kriteria_id', 'left');
        $this->db->join('ekonomi_respon', 'ekonomi_respon.ekonomi_respon_id = ekonomi_kriteria_respon.ekonomi_respon_id', 'left');
        $this->db->join('ekonomi', 'ekonomi.ekonomi_id = ekonomi_kriteria.ekonomi_id', 'left');
        $this->db->order_by("ekonomi_kriteria_respon.ekonomi_kriteria_id", "asc");
        $this->db->order_by("ekonomi_kriteria_respon.ekonomi_respon_id", "asc");
        $hasil = $this->db->get('ekonomi_kriteria_respon')->result_array();
		return $hasil;
    }

    // bahan penyedia
    public function selectBahanPenyedia($id){
        $this->db->where('bahan_penyedia_id', $id);
        $hasil = $this->db->get('bahan_penyedia')->result_array();
		return $hasil;
    }

    public function selectAllBahanPenyedia(){
        $hasil = $this->db->get('bahan_penyedia')->result_array();
		return $hasil;
    }

    public function bahanPenyediaTambah($post){
        $hasil = $this->db->insert('bahan_penyedia', array(
            'bahan_penyedia_nama' => $post['bahan_penyedia_nama'],
            'bahan_penyedia_produksi' => $post['bahan_penyedia_produksi'],
            'bahan_penyedia_produksi_keinginan' => $post['bahan_penyedia_produksi_keinginan'],
            'bahan_penyedia_randemen' => $post['bahan_penyedia_randemen'],
            'bahan_penyedia_konversi' => $post['bahan_penyedia_konversi'],
            'bahan_penyedia_produktifitas' => $post['bahan_penyedia_produktifitas'],
            'bahan_penyedia_panen' => $post['bahan_penyedia_panen'],
        ));
        return $hasil;
    }

    public function bahanPenyediaEdit($post){
        $this->db->where('bahan_penyedia_id', $post['bahan_penyedia_id']);
        $hasil = $this->db->update('bahan_penyedia', array(
            'bahan_penyedia_nama' => $post['bahan_penyedia_nama'],
            'bahan_penyedia_produksi' => $post['bahan_penyedia_produksi'],
            'bahan_penyedia_produksi_keinginan' => $post['bahan_penyedia_produksi_keinginan'],
            'bahan_penyedia_randemen' => $post['bahan_penyedia_randemen'],
            'bahan_penyedia_konversi' => $post['bahan_penyedia_konversi'],
            'bahan_penyedia_produktifitas' => $post['bahan_penyedia_produktifitas'],
            'bahan_penyedia_panen' => $post['bahan_penyedia_panen'],
        ));
        return $hasil;
    }

    public function bahanPenyediaHapus($post){
        $this->db->where('bahan_penyedia_id', $post['bahan_penyedia_id']);
        $hasil = $this->db->delete('bahan_penyedia');
        return $hasil;
    }
}