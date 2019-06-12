
                <?php 
                $name = @$dataMpe[0]['nama'];
                $kriteria = array();
                $kriteriaBobot = array();

                $style = ' style="border: 1px solid; padding: 10px;"';
                
                $wilayah = array();
                $wilayahKriteria = array();
                $respon = array();
                
                for($i = 0; $i< count($dataKriteria); $i++){
                    $kriteria[$i] = $dataKriteria[$i]['kriteria'];
                    $kriteriaId[$i] = $dataKriteria[$i]['mpe_kriteria_id'];
                }

                for($i = 0; $i< count($dataRespon); $i++){
                    $respon[$i] = $dataRespon[$i]['respon_nama'];
                    $responId[$i] = $dataRespon[$i]['mpe_respon_id'];
                }

                for($i = 0; $i< count($dataWilayah); $i++){
                    $wilayah[$i] = $dataWilayah[$i]['wilayah'];
                    $wilayahId[$i] = $dataWilayah[$i]['mpe_wilayah_id'];
                }

                $jumlahKriteria = count($dataKriteria);
                $jumlahRespon = count($dataRespon);
                $jumlahWilayah = count($dataWilayah);
                // print_r($dataRespon);
                //deklarasi
                // $kriteriaRespon = array(0,0,0);

                // hitung bobot
                if($jumlahRespon > 0 && count($dataWilayahKriteria) == ($jumlahRespon*$jumlahWilayah*$jumlahKriteria)){
                    $no = 0;
                    for($i = 0; $i < $jumlahKriteria; $i++){
                        for($j = 0; $j < $jumlahRespon; $j++){
                            $kriteriaRespon[$i][$j] =  @$dataKriteriaRespon[$no]['mpe_respon_kriteria_nilai']; //rand(1, $jumlahKriteria);
                            $no++;
                        }
                        $kriteriaBobot[$i] = ($jumlahRespon*$jumlahKriteria)-array_sum($kriteriaRespon[$i]);
                    }
                    $jumlahKriteriaBobot = array_sum($kriteriaBobot);
    
                    for($i = 0; $i < $jumlahKriteria; $i++){
                        if($jumlahKriteriaBobot == 0 && $kriteriaBobot[$i] == 0){
                            $kriteriaBobot[$i] = 0;
                        }else{
                            $kriteriaBobot[$i] = $kriteriaBobot[$i]/$jumlahKriteriaBobot;
                        }
                        
                    }
    
                    // mengisi data semua responden
                    $index = 0;
                    for($no = 0; $no < $jumlahRespon; $no++){
                        for($i = 0; $i < $jumlahWilayah; $i++){
                            for($j = 0; $j < $jumlahKriteria; $j++){
                                $wilayahKriteria[$no]['respon_nama'] = $respon[$no];
                                $wilayahKriteria[$no]['respon_id'] = $dataWilayahKriteria[$index]['mpe_respon_id'];
                                $wilayahKriteria[$no]['wilayah_kriteria_json'][$i][$j] = $dataWilayahKriteria[$index]['mpe_wilayah_kriteria_nilai'];
                                $index++;
                            }
                        }
                    }
                }
                
                // echo "<pre>";
                // echo "<div class='row'>";
                // echo "<div class='col-5'>";
                // print_r(@$dataWilayahKriteria);
                // echo "</div>";
                // echo "<div class='col-5'>";
                // print_r(@$wilayahKriteria);
                // echo "</div>";
                // echo "</pre>";
                
                ?>
                

                <div id="penjelasan" class="set-hide">
                    <!-- Default Basic Forms Start -->
                    <div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
                        <div class="pull-left">
                            <!-- <h4 class="text-blue"><?=$name?></h4> -->
                            <!-- <p class="mb-30 font-14">Perhitungan Metode MPE pada <?=$name?></p> -->
                        </div>
                        <?php if($jumlahRespon > 0){ ?>
                        
                        

                        <!-- Tampil All Respon -->
                        <?php $index = 0; foreach($wilayahKriteria as $row){ 
                            // $rowRespon = json_decode($row['wilayah_kriteria_json'], true);
                            $rowRespon = $row['wilayah_kriteria_json'];
                            if($index == 0){
                                $dataJumlah = $rowRespon;
                            }
                            $no = 0; 
                            foreach($wilayah as $rowWilayah){ 
                                for($i = 0; $i < $jumlahKriteria; $i++){ 
                                        
                                    if($index != 0){
                                        $dataJumlah[$no][$i] += $rowRespon[$no][$i];
                                    }
                                        if($index +1 == $jumlahRespon){
                                            $dataJumlah[$no][$i] = $dataJumlah[$no][$i]/$jumlahRespon;
                                            
                                        }
                                } 
                                $no++; 
                            } 
                            $index++; 
                        } ?>
                        <!-- . Tampil All Respon -->
                        <?php } ?>
                        <?php 
                        $hasil = 0;
                            if(@$wilayahKriteria[0]){
                                $kirim = array(
                                    'data' => $dataJumlah,
                                    'kriteria' => $kriteria,
                                    'respon' => $respon,
                                    'wilayah' => $wilayah,
                                    'bobot' => $kriteriaBobot,
                                );
                                $hasil =  $this->mpe->getMpe($kirim, true, @$_GET['tampil']); 
                            }
                        ?>
                    </div>
                    <!-- Default Basic Forms End -->
                </div>

			