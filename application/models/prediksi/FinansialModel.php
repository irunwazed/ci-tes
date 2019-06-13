<?php

class FinansialModel extends CI_Model
{

    private $table, $tableRespon;

    public function __construct()
    {
        parent::__construct();
        $this->table = 'finansial';
    }

    public function selectOne($id){
        $this->db->join('finansial_penerimaan', 'finansial_penerimaan.finansial_id = finansial.finansial_id', 'left');
        $this->db->where($this->table.'.finansial_id', $id);
        // echo "sdfs";
        $hasil = $this->db->get($this->table)->result_array();
        return $hasil;
    }

    public function selectAll($post = array()){
        // print_r($post); finansial_penerimaan
        // $this->db->where('username', $post['user']);
        $this->db->join('finansial_penerimaan', 'finansial_penerimaan.finansial_id = finansial.finansial_id', 'left');
        $hasil = $this->db->get($this->table)->result_array();
        
		return $hasil;
    }

    public function selectBiaya($id){
        // $this->db->join('finansial_bahan', 'finansial_bahan.finansial_bahan_id = finansial_barang.finansial_bahan_id', 'left');
        $this->db->join('finansial_kategori', 'finansial_kategori.finansial_kategori_id = finansial_barang.finansial_kategori_id', 'left');
        $this->db->join('satuan', 'satuan.satuan_id = finansial_barang.satuan_id', 'left');
        $this->db->where('finansial_id', $id);
        $this->db->where('finansial_kategori.finansial_kategori_id', 1);
        $this->db->order_by("finansial_kategori.finansial_kategori_id", "asc");
        // $this->db->order_by("finansial_bahan.finansial_bahan_id", "asc");
        $hasil = $this->db->get('finansial_barang')->result_array();
		return $hasil;
    }

    public function selectOperasional($id){
        // $this->db->join('finansial_bahan', 'finansial_bahan.finansial_bahan_id = finansial_barang.finansial_bahan_id', 'left');
        $this->db->join('finansial_kategori', 'finansial_kategori.finansial_kategori_id = finansial_barang.finansial_kategori_id', 'left');
        $this->db->join('satuan', 'satuan.satuan_id = finansial_barang.satuan_id', 'left');
        $this->db->where('finansial_id', $id);
        $this->db->where('finansial_kategori.finansial_kategori_id !=', 1);
        $this->db->where('finansial_kategori.finansial_kategori_id !=', 4);
        $this->db->order_by("finansial_kategori.finansial_kategori_id", "asc");
        // $this->db->order_by("finansial_bahan.finansial_bahan_id", "asc");
        $hasil = $this->db->get('finansial_barang')->result_array();
		return $hasil;
    }

    public function selectBahanBaku($id){
        // $this->db->join('finansial_bahan', 'finansial_bahan.finansial_bahan_id = finansial_barang.finansial_bahan_id', 'left');
        $this->db->join('finansial_kategori', 'finansial_kategori.finansial_kategori_id = finansial_barang.finansial_kategori_id', 'left');
        $this->db->join('satuan', 'satuan.satuan_id = finansial_barang.satuan_id', 'left');
        $this->db->where('finansial_id', $id);
        $this->db->where('finansial_kategori.finansial_kategori_id', 4); // id bahan baku
        $this->db->order_by("finansial_kategori.finansial_kategori_id", "asc");
        // $this->db->order_by("finansial_bahan.finansial_bahan_id", "asc");
        $hasil = $this->db->get('finansial_barang')->result_array();
		return $hasil;
    }

    public function selectFinansial($id){
        $this->db->where('finansial_id', $id);
        // $this->db->where('finansial_kategori.finansial_kategori_id !=', 7);
        // $this->db->order_by("finansial_barang_id", "asc");
        $hasil = $this->db->get('finansial')->result_array();
		return $hasil;
    }

    public function selectPenerimaan($id){
        $this->db->where('finansial_id', $id);
        // $this->db->where('finansial_kategori.finansial_kategori_id !=', 7);
        // $this->db->order_by("finansial_barang_id", "asc");
        $hasil = $this->db->get('finansial_penerimaan')->result_array();
		return $hasil;
    }

    public function selectOneBahan($id){
        $this->db->where('finansial_bahan_id', $id);
        $hasil = $this->db->get('finansial_bahan')->result_array();
		return $hasil;
    }

    public function finansialInput($post){
        $hasil = $this->db->insert('finansial', array(
            'finansial_nama' => $post['nama'],
            'finansial_waktu' => $post['lama'],
        ));

        $hasil = $this->db->insert('finansial_penerimaan', array(
            'finansial_id' => $this->db->insert_id(),
            'finansial_penerimaan_produk' => $post['produk'],
            'finansial_penerimaan_harga' => $post['harga'],
        ));
        
		return $hasil;
    }

    public function finansialUpdate($post){

        $this->db->where('finansial_id', $post['id']);
        $hasil = $this->db->update('finansial', array(
            'finansial_nama' => $post['nama'],
            'finansial_waktu' => $post['lama'],
        ));

        $this->db->where('finansial_id', $post['id']);
        $hasil = $this->db->update('finansial_penerimaan', array(
            'finansial_penerimaan_produk' => $post['produk'],
            'finansial_penerimaan_harga' => $post['harga'],
        ));
        
		return $hasil;
    }

    public function finansialHapus($id){
        $this->db->where('finansial_id', $id);
        $hasil = $this->db->delete('finansial');
		return $hasil;
    }

    public function bahanInput($post){
        $hasil = $this->db->insert('finansial_bahan', array(
            'finansial_bahan_nama' => $post['nama'],
            'finansial_bahan_harga' => $post['harga'],
            'finansial_bahan_umur' => $post['umur'],
            'finansial_kategori_id' => $post['kategori'],
        ));
		return $hasil;
    }

    public function bahanEdit($post){
        $this->db->where('finansial_bahan_id', $post['id']);
        $hasil = $this->db->update('finansial_bahan', array(
            'finansial_bahan_nama' => $post['nama'],
            'finansial_bahan_harga' => $post['harga'],
            'finansial_bahan_umur' => $post['umur'],
            'finansial_kategori_id' => $post['kategori'],
        ));
		return $hasil;
    }

    public function bahanHapus($post){
        $this->db->where('finansial_bahan_id', $post['id']);
        $hasil = $this->db->delete('finansial_bahan');
		return $hasil;
    }

    public function barangInput($post){
        $hasil = $this->db->insert('finansial_barang', array(
            'finansial_id' => $post['id'],
            'finansial_kategori_id' => $post['kategori'],
            'finansial_barang_nama' => $post['nama'],
            'finansial_barang_harga' => $post['harga'],
            'finansial_barang_umur' => $post['umur'],
            'finansial_barang_volume' => $post['volume'],
            'satuan_id' => $post['satuan'],
        ));
		return $hasil;
    }

    public function barangEdit($post){
        $this->db->where('finansial_barang_id', $post['idBarang']);
        $hasil = $this->db->update('finansial_barang', array(
            'finansial_id' => $post['id'],
            'finansial_kategori_id' => $post['kategori'],
            'finansial_barang_nama' => $post['nama'],
            'finansial_barang_harga' => $post['harga'],
            'finansial_barang_umur' => $post['umur'],
            'finansial_barang_volume' => $post['volume'],
            'satuan_id' => $post['satuan'],
        ));
		return $hasil;
    }

    public function barangHapus($post){
        $this->db->where('finansial_barang_id', $post['id']);
        $hasil = $this->db->delete('finansial_barang');
		return $hasil;
    }

    public function selectOneBarang($id){
        $this->db->join('finansial_bahan', 'finansial_bahan.finansial_bahan_id = finansial_barang.finansial_bahan_id', 'left');
        $this->db->where('finansial_barang_id', $id);
        $hasil = $this->db->get('finansial_barang')->result_array();
		return $hasil;
    }
    
    public function selectBahanKategori(){
        $hasil = $this->db->get('finansial_kategori')->result_array();
		return $hasil;
    }

    public function selectAllBahan(){
        // $this->db->join('finansial_kategori', 'finansial_kategori.finansial_kategori_id = finansial_bahan.finansial_kategori_id', 'left');
        $this->db->order_by("finansial_bahan.finansial_kategori_id", "asc");
        $hasil = $this->db->get('finansial_bahan')->result_array();
		return $hasil;
    }

    public function getBahan($kategori){
        
        $this->db->where('finansial_kategori_id', $kategori);
        $hasil = $this->db->get('finansial_bahan')->result_array();
		return $hasil;
    }

    public function selectAllSatuan(){
        $hasil = $this->db->get('satuan')->result_array();
		return $hasil;
    }
}