
                <?php 
                $name = '';
                $kriteria = array();
                $jumlahRespon = count($dataAhpRespon);
                // echo $jumlahRespon;
                if(@$dataAhp[0]){
                    $kriteria = json_decode($dataAhp[0]['kriteria'], true);
                    $name = @$dataAhp[0]['nama_ahp'];
                }

                function cekNilai($nilai1, $nilai2){
                    if($nilai1 == $nilai2) return true;
                }

                function perbandingan($i, $A = "A", $B = "B"){
                    if($i == 1){
                        $pesan = $A." sama penting dengan ".$B;
                    }else if($i == 3){
                        $pesan = $A." sedikit lebih penting ".$B;
                    }else if($i == 5){
                        $pesan = $A." jelas lebih penting dari ".$B;
                    }else if($i == 7){
                        $pesan = $A." sangat jelas lebih penting dari ".$B;
                    }else if($i == 9){
                        $pesan = $A." Mutlat lebih penting dari ".$B;
                    }else{
                        $pesan = "Ragu-ragu antara ".($i-1)." dan ".($i+1);
                    }
                    $pesan = '<span style="font-size:8px"> '.$pesan.' </span>';
                    return $pesan;
                }
                
                $kriteriaJumlah = array();
                $dataJumlah = array();
                ?>
                

                <div id="penjelasan" class="set-hide">
                    <!-- Default Basic Forms Start -->
                    <div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
                        
                        <?php $index = 0; foreach($dataAhpRespon as $row){ 
                            $rowRespon = json_decode($row['respon'], true);
                            if($index == 0){
                                $dataJumlah = $rowRespon;
                            }
                        ?>
                                <?php $no = 0; foreach($kriteria as $rowKriteria){ ?>
                               
                                    <?php for($i = 0; $i < count($rowRespon); $i++){ 
                                        if($index != 0){
                                            $dataJumlah[$no][$i] += $rowRespon[$no][$i];
                                        }
                                        if($index +1 == count($dataAhpRespon)){
                                            $dataJumlah[$no][$i] = $dataJumlah[$no][$i]/count($dataAhpRespon);
                                        }
                                        ?>
                                        
                                    <?php } ?>
                               
                                <?php $no++; } ?>
                        <?php $index++; } ?>
                        <?php 
                        $hasil = 0;
                            if(@$dataAhpRespon[0]){
                                $hasil =  $this->ahp->getAhp($dataJumlah, $kriteria, $name, false); 
                            }
                        ?>
                    </div>
                    <!-- Default Basic Forms End -->
                </div>
                
                <script>
                    var globalHasil = '<?=number_format($hasil,4,",",".")?>';
                </script>

			