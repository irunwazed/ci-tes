<?php

class MpeModel extends CI_Model
{

    private $table, $tableRespon;

    public function __construct()
    {
        parent::__construct();
        $this->table = 'mpe';
    }

    public function selectAll($post = array()){
        // print_r($post);
    	// $this->db->where('username', $post['user']);
        $hasil = $this->db->get($this->table)->result_array();
        
		return $hasil;
    }

    public function selectMenu($menu = 0){
        // print_r($post);
        if($menu != 0){
            $this->db->where('menu', $menu);
        }
        $hasil = $this->db->get($this->table)->result_array();
        
		return $hasil;
    }

    public function selectOne($id){
        
        $this->db->where('mpe_id', $id);
        $hasil = $this->db->get($this->table)->result_array();
        return $hasil;
    }

    public function selectOneKriteriaRespon($id){
        $this->db->where('mpe_respon_id', $id);
        $this->db->order_by("mpe_kriteria_id", "asc");
        $hasil = $this->db->get('mpe_respon_kriteria')->result_array();
		return $hasil;
    }

    public function selectOneWilayahKriteria($id){
        $this->db->where('mpe_respon_id', $id);
        $this->db->order_by("mpe_wilayah_id", "asc");
        $this->db->order_by("mpe_kriteria_id", "asc");
        $hasil = $this->db->get('mpe_wilayah_kriteria')->result_array();
		return $hasil;
    }

    public function selectMpe($id){
        $this->db->where('mpe_id', $id);
        $hasil = $this->db->get('mpe')->result_array();
		return $hasil;
    }

    public function selectKriteria($id){
        $this->db->where('mpe_id', $id);
        $this->db->order_by("mpe_kriteria_id", "asc");
        $hasil = $this->db->get('mpe_kriteria')->result_array();
		return $hasil;
    }

    public function selectRespon($id){
        $this->db->where('mpe_id', $id);
        $this->db->order_by("mpe_respon_id", "asc");
        $hasil = $this->db->get('mpe_respon')->result_array();
		return $hasil;
    }

    public function selectWilayah($id){
        // $this->db->select('wilayah');
        $this->db->where('mpe_id', $id);
        $this->db->order_by("mpe_wilayah_id", "asc");
        $hasil = $this->db->get('mpe_wilayah')->result_array();
		return $hasil;
    }

    public function selectKriteriaRespon($id){

        $this->db->select('mpe_respon_kriteria.*');
        $this->db->join('mpe_respon', 'mpe_respon.mpe_respon_id = mpe_respon_kriteria.mpe_respon_id', 'left');
        $this->db->join('mpe', 'mpe.mpe_id = mpe_respon.mpe_id', 'left');
        $this->db->where('mpe.mpe_id', $id);
        $this->db->order_by("mpe_respon_kriteria.mpe_kriteria_id", "asc");
        $this->db->order_by("mpe_respon_kriteria.mpe_respon_id", "asc");

        $hasil = $this->db->get('mpe_respon_kriteria')->result_array();
		return $hasil;
    }

    public function selectWilayahKriteria($id){

        $this->db->select('mpe_wilayah_kriteria.*');
        $this->db->join('mpe_kriteria', 'mpe_kriteria.mpe_kriteria_id = mpe_wilayah_kriteria.mpe_kriteria_id', 'left');
        $this->db->join('mpe', 'mpe.mpe_id = mpe_kriteria.mpe_id', 'left');
        $this->db->where('mpe.mpe_id', $id);
        $this->db->order_by("mpe_wilayah_kriteria.mpe_respon_id", "asc");
        $this->db->order_by("mpe_wilayah_kriteria.mpe_wilayah_id", "asc");
        $this->db->order_by("mpe_wilayah_kriteria.mpe_kriteria_id", "asc");

        $hasil = $this->db->get('mpe_wilayah_kriteria')->result_array();
		return $hasil;
    }

    // edit respon
    public function editRespon($post){
        $post = $this->security->xss_clean($post);
        $result = false;

        $post['responId'] = $post['idRespon'];
        $post['edit'] = true;
        for($i = 0; $i < count($post['kriteriaRespon']); $i++){
            $post['kriteriaId'] = $post['mpe_kriteria_id'][$i];
            $post['nilai'] = $post['kriteriaRespon'][$i];
            $result = $this->setKriteriaRespon($post);
        }

        for($i = 0; $i < count($post['wilayahKriteria']); $i++){
            $post['wilayahId'] = $post['mpe_wilayah_id'][$i];
            for($j = 0; $j < count($post['mpe_kriteria_id']); $j++){
                $post['kriteriaId'] = $post['mpe_kriteria_id'][$j];
                $post['nilai'] = $post['wilayahKriteria'][$i][$j];
                $result = $this->setWilayahKriteria($post);
            }
        }

        return $result;
    }
    // . edit respon

    // insert all respon
    public function insertRespon($post){
        $post = $this->security->xss_clean($post);
        $result = false;

        $post['responId'] = $this->setRespon($post);

        for($i = 0; $i < count($post['kriteriaRespon']); $i++){
            $post['kriteriaId'] = $post['mpe_kriteria_id'][$i];
            $post['nilai'] = $post['kriteriaRespon'][$i];
            $result = $this->setKriteriaRespon($post);
        }

        for($i = 0; $i < count($post['wilayahKriteria']); $i++){
            $post['wilayahId'] = $post['mpe_wilayah_id'][$i];
            for($j = 0; $j < count($post['mpe_kriteria_id']); $j++){
                $post['kriteriaId'] = $post['mpe_kriteria_id'][$j];
                $post['nilai'] = $post['wilayahKriteria'][$i][$j];
                $result = $this->setWilayahKriteria($post);
            }
        }

        return $result;

    }

    public function setWilayahKriteria($post){
        $result = false;

        if(@$post['edit']){
            $this->db->where('mpe_respon_id', $post['responId']);
            $this->db->where('mpe_kriteria_id', $post['kriteriaId']);
            $this->db->where('mpe_wilayah_id', $post['wilayahId']);
            $result = $this->db->update('mpe_wilayah_kriteria', array(
                'mpe_wilayah_kriteria_nilai' => $post['nilai'],
            ));
        }else{
            $result = $this->db->insert('mpe_wilayah_kriteria', array(
                'mpe_respon_id' => $post['responId'],
                'mpe_kriteria_id' => $post['kriteriaId'],
                'mpe_wilayah_id' => $post['wilayahId'],
                'mpe_wilayah_kriteria_nilai' => $post['nilai'],
            ));
        }
       
        return $result;
    }

    public function setKriteriaRespon($post){
        $result = false;

        if(@$post['edit']){
            $this->db->where('mpe_respon_id', $post['responId']);
            $this->db->where('mpe_kriteria_id', $post['kriteriaId']);
            $result = $this->db->update('mpe_respon_kriteria', array(
                'mpe_respon_kriteria_nilai' => $post['nilai'],
            ));
        }else{
            $result = $this->db->insert('mpe_respon_kriteria', array(
                'mpe_respon_id' => $post['responId'],
                'mpe_kriteria_id' => $post['kriteriaId'],
                'mpe_respon_kriteria_nilai' => $post['nilai'],
            ));
        }
        
        return $result;
    }

    public function setRespon($post){
        $result = false;
        $result = $this->db->insert('mpe_respon', array(
            'mpe_id' => $post['id'],
            'respon_nama' => $post['nama'],
        ));
        return $this->db->insert_id();
    }
    // . insert all respon

    // delete respon
    
    public function deleteRespon($id){
        $result = false;
        $this->db->where('mpe_respon_id', $id);
        $result = $this->db->delete('mpe_respon');
        return $result;
    }

    //. delete respon

    
    // masukkan data mpe
    public function insertMpe($post){
        $post = $this->security->xss_clean($post);
        $result = false;

        $post['mpeId'] = $this->setMpe($post);

        foreach($post['kriteria'] as $kriteria){
            $post['nilaiKriteria'] = $kriteria;
            $result = $this->setKriteria($post);
        }

        foreach($post['wilayah'] as $row){
            $post['nilaiWilayah'] = $row;
            $result = $this->setWilayah($post);
        }

        return $result;
    }

    public function setMpe($post){
        $result = false;
        $result = $this->db->insert('mpe', array(
            'nama' => $post['nama'],
            'menu' => $post['menu'],
        ));
        return $this->db->insert_id();
    }

    public function setKriteria($post){
        $result = false;
        $result = $this->db->insert('mpe_kriteria', array(
            'mpe_id' => $post['mpeId'],
            'kriteria' => $post['nilaiKriteria'],
        ));
        return $this->db->insert_id();
    }

    public function setWilayah($post){
        $result = false;
        $result = $this->db->insert('mpe_wilayah', array(
            'mpe_id' => $post['mpeId'],
            'wilayah' => $post['nilaiWilayah'],
        ));
        return $this->db->insert_id();
    }

    // . masukkan data mpe

    // edit Mpe

    public function updateMpe($post){
        $result = false;
        // mpe
        $this->db->where('mpe_id', $post['id']);
        $result = $this->db->update('mpe', array(
            'nama' => $post['nama'],
            'menu' => $post['menu'],
        ));

        //kriteria
        $dataKriteria = $this->selectKriteria($post['id']);
        $no = 0;
        foreach($dataKriteria as $row){
            $this->db->where('mpe_kriteria_id', $row['mpe_kriteria_id']);
            $result = $this->db->update('mpe_kriteria', array(
                'kriteria' => @$post['kriteria'][$no],
            ));
            $no++;
        }

        //wilayah
        $dataWilayah = $this->selectWilayah($post['id']);
        $no = 0;
        foreach($dataWilayah as $row){
            $this->db->where('mpe_wilayah_id', $row['mpe_wilayah_id']);
            $result = $this->db->update('mpe_wilayah', array(
                'wilayah' => @$post['wilayah'][$no],
            ));
            $no++;
        }

        return $result;

    }

    // . edit Mpe

    // delete Mpe
    public function deleteMpe($id){
        $result = false;
        $this->db->where('mpe_id', $id);
        $result = $this->db->delete('mpe');
        return $result;
    }

    // . delete Mpe

    public function inputRandomWilayahKriteria($data){
        $this->db->insert('mpe_wilayah_kriteria', array(
            'mpe_respon_id' => $data['mpe_respon_id'],
            'mpe_kriteria_id' => $data['mpe_kriteria_id'],
            'mpe_wilayah_id' => $data['mpe_wilayah_id'],
            'mpe_wilayah_kriteria_nilai' => rand(1,5),
        ));
    }
    
}