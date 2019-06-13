
                <?php 
                
            $style = ' style="border: 1px solid; padding: 10px;"';
                
                $name = @$dataFinansial[0]['finansial_nama'];
                $waktu = @$dataFinansial[0]['finansial_waktu']+0;
                $kriteria = array();
                $kriteriaBobot = array();
                

                $jumlahFinansial = count($dataBiaya);
                $jumlahPenerimaan = count($dataPenerimaan);
                $jumlahOperasional = count($dataOperasional);
                
                $getBahanBaku = (100+@$_GET['bahanbaku'])/100;
                $getHarga = (100+@$_GET['harga'])/100;
                $getProduksi = (100+@$_GET['produksi'])/100;
                $getHargaATC = (100+@$_GET['atc'])/100;
                $getInflasi = (100+@$_GET['inflasi'])/100;
                $lama = @$_GET['lama']?$_GET['lama']:1;

                // penambahan bahan baku ke operasional dan mengubah harga bahan baku
                for($i = 0; $i < count($dataBahanBaku); $i++){
                    $dataBahanBaku[$i]['finansial_barang_harga'] *= $getBahanBaku;
                    array_push($dataOperasional,$dataBahanBaku[$i]);
                }

                // mengubah produksi penerimaan dan atc
                for($i =0; $i < count($dataPenerimaan); $i++){
                    $dataPenerimaan[$i]['finansial_penerimaan_produk'] *= $getProduksi;
                    $dataPenerimaan[$i]['finansial_penerimaan_harga'] *= $getHargaATC;
                }
                
                
                
                // <!-- show penjelasan -->
                if($jumlahFinansial > 0){ 
                        // <!-- Tampil Biaya -->
                                    
                    $totalAll = 0; 
                    $totalKategori = 0; 
                    $no = 0; 
                    $tempKategori = 0;
                    foreach($dataBiaya as $rowFinansial){ 
                        $totalAll += $rowFinansial['finansial_barang_harga']*$rowFinansial['finansial_barang_volume'];
                        if($tempKategori != $rowFinansial['finansial_kategori_id']){
                            $no = 0;
                            
                            $tempKategori = $rowFinansial['finansial_kategori_id'];
                    
                        $totalKategori = $rowFinansial['finansial_barang_harga']*$rowFinansial['finansial_barang_volume'];
                        }else{
                            $totalKategori += $rowFinansial['finansial_barang_harga']*$rowFinansial['finansial_barang_volume'];
                        }
                        $no++; 
                    } ?>
                        <!-- .Tampil Biaya -->
                        
                        <?php if($jumlahOperasional > 0){ ?>
                        <!-- Tampil Operasional -->
                                <tbody>
                                    <?php 
                                    $totalHari = 0; 
                                    $totalBulan = 0; 
                                    $totalTahun = 0; 
                                    $totalKategori = 0; 
                                    $no = 0; 
                                    $tempKategori = 0;
                                    foreach($dataOperasional as $rowFinansial){ 
                                        $nilai = $rowFinansial['finansial_barang_harga']*$rowFinansial['finansial_barang_volume'];
                                        $totalHari += $nilai;
                                        $totalBulan += $nilai*24;
                                        $totalTahun += $nilai*24*12;
                                        
                                    ?>
                                    <?php $no++; } ?>
                        <!-- .Tampil Operasional -->
                        
                        <?php } ?>

                        <?php if($jumlahPenerimaan > 0){ ?>
                        <!-- Tampil Penerimaan -->
                                    <?php 
                                    $no = 0; 
                                    foreach($dataPenerimaan as $rowPenerimaan){ 
                                        $harga = $rowPenerimaan['finansial_penerimaan_harga'];
                                        $produk = $rowPenerimaan['finansial_penerimaan_produk'];
                                        
                                    ?>
                                    <?php  } ?>
                        <!-- .Tampil Penerimaan -->
                        
                        <?php } ?>
                        <?php } ?>
                    <!-- ./ Data Inputan -->
                    
                    <?php if($jumlahFinansial > 0){ ?>
                    <!-- Pembuatan Tabel Semua -->
                        
                        <?php
                            //deklarasi perubahan data
                            $perawatan = 1/100;
                            $pajak = 15/1000;
                        
                        ?>
                                    <?php 
                                $totalAll = 0; 
                                $totalKategori = 0; 
                                $no = 0; 
                                $tempKategori = 0;
                                for($tahunKe =0; $tahunKe <= $waktu;$tahunKe++){
                                    $totalAllTahun[$tahunKe] = 0;
                                }
                                foreach($dataBiaya as $rowFinansial){ 
                                    $totalHarga = $rowFinansial['finansial_barang_harga']*$rowFinansial['finansial_barang_volume'];

                                    
                                    
                                    if($tempKategori != $rowFinansial['finansial_kategori_id']){
                                        $no = 0;
                                        
                                        $tempKategori = $rowFinansial['finansial_kategori_id'];
                                ?>
                                    <?php
                                        $totalKategori = $rowFinansial['finansial_barang_harga']*$rowFinansial['finansial_barang_volume'];
                                        }else{
                                            $totalKategori += $rowFinansial['finansial_barang_harga']*$rowFinansial['finansial_barang_volume'];
                                        }
                                    ?>
                                    
                                        <?php for($tahunKe =0; $tahunKe <= $waktu;$tahunKe++){ 
                                            $totalHargaPerubahan[$tahunKe] = $totalHarga;
                                        if($tahunKe == 0){
                                            $totalHargaPerubahan[$tahunKe] = $totalHarga;
                                        }else if($tahunKe == 1){
                                            $totalHargaPerubahan[$tahunKe] = 0;
                                        }else if(($tahunKe-1)%$rowFinansial['finansial_barang_umur'] != 0){
                                            $totalHargaPerubahan[$tahunKe] = $perawatan*$totalHarga;
                                        }
                                        $totalAllTahun[$tahunKe] += $totalHargaPerubahan[$tahunKe];
                                        ?>
                                        
                                        <?php } ?>
                                    
                                    <?php $no++;  } ?>
                                    <?php 
                                    for($i = 0; $i <= $waktu; $i++){
                                        $totalBiayaTahun[$i] = 0;  
                                    }
                                    
                                    $no = 0; 
                                    $tempKategori = 0;
                                    foreach($dataOperasional as $rowFinansial){ 
                                        // $nilai = $rowFinansial['finansial_barang_harga']*$rowFinansial['finansial_barang_volume']*24*12;
                                        $nilai = $rowFinansial['finansial_barang_harga']*$rowFinansial['finansial_barang_volume'];
                                        $nilai *= $lama;
                                        
                                    ?>
                                        <?php for($i = 0; $i <= $waktu; $i++){ 
                                            if($i == 0){
                                                $totalBiayaPerubahan[$i] = 0;
                                            }else{
                                                if($i == 1){
                                                    $totalBiayaPerubahan[$i] = $nilai;
                                                    
                                                }else{
                                                    $totalBiayaPerubahan[$i] = $totalBiayaPerubahan[$i-1]*@$getInflasi;
                                                }
                                                
                                            }
                                            $totalBiayaTahun[$i] += $totalBiayaPerubahan[$i];
                                            
                                            
                                        ?>
                                        <?php } ?>
                                    <?php $no++; } ?>
                                    <?php 
                                        $no = 0; 
                                        foreach($dataPenerimaan as $rowPenerimaan){ 
                                        $harga = $rowPenerimaan['finansial_penerimaan_harga'];
                                        $produk = $rowPenerimaan['finansial_penerimaan_produk'];
                                        // echo $harga;
                                    ?>
                                        <?php for($i = 0; $i <= $waktu; $i++){ 
                                            $totalPenerimaanProduk[$i] = $produk;
                                            if($i==0){
                                                $totalPenerimaanProduk[$i] = 0;
                                            }
                                        ?>
                                        
                                        <?php } ?>
                                    <?php $no++; ?>
                                    
                                        <?php for($i = 0; $i <= $waktu; $i++){ 
                                            $totalPenerimaanHarga[$i] = $harga*@$getHarga;
                                            if($i==0){
                                                $totalPenerimaanHarga[$i] = 0;
                                            }
                                        ?>
                                        
                                        <?php } ?>
                                    <?php $no++; ?>
                                    
                                        <?php for($i = 0; $i <= $waktu; $i++){ 
                                            $totalSisa[$i] = 0;
                                            // $sisa = $waktu -$dataFinansial;
                                            if($i == $waktu){
                                                
                                                foreach($dataBiaya as $rowBiaya){
                                                    $sisaPertahun = 0;
                                                    $sisaTahun = $rowBiaya['finansial_barang_umur'] - $waktu;
                                                    while($sisaTahun < 0){
                                                        $sisaTahun += $rowBiaya['finansial_barang_umur'];
                                                    }
                                                    $totalSisa[$i] += ($sisaTahun/$rowBiaya['finansial_barang_umur'])*$rowBiaya['finansial_barang_harga'];
                                                }
                                            }
                                            
                                        ?>
                                        
                                        <?php } ?>
                                    <?php $no++; ?>
                                        <?php for($i = 0; $i <= $waktu; $i++){ 
                                            $totalPenerimaan[$i] = ($totalPenerimaanHarga[$i]*$totalPenerimaanProduk[$i]*24*12) + $totalSisa[$i];
                                        ?>
                                        
                                        <?php } ?>
                                    <?php  } ?>
                                    
                                        <?php for($i = 0; $i <= $waktu; $i++){ 
                                            $totalPajak[$i] = $totalPenerimaan[$i]*$pajak;
                                        ?>
                                        
                                        <?php } ?>
                                        <?php for($i = 0; $i <= $waktu; $i++){ 
                                            $totalPenghasilan[$i] = $totalPenerimaan[$i]-$totalPajak[$i];
                                        ?>
                                        
                                        <?php } ?>
                               
                        <!-- .Tampil Operasional -->
                    <!-- ./ Pembuatan Tabel Semua -->

                    <!-- Pencarian Prediksi -->
                        <?php
                        
                        //benefit 
                        // $totalPenerimaan[$i] 

                        //operasional
                        // $totalBiayaTahun[$i]

                        //investasi
                        // $totalAllTahun[$tahunKe]
                        $dfAwal = 0.1;
                        $dfIterasi = 0.01;
                        $langkah = 0;
                        $iterasi = 0;
                        $jalan = true;

                        $persenDfPlus = 0;
                        $persenDfMines = 0;
                        
                        while($jalan){
                            for($tahun = 0; $tahun <= $waktu; $tahun++){
                                $netBenefit[$tahun] = $totalPenerimaan[$tahun]-($totalBiayaTahun[$tahun]+$totalAllTahun[$tahun]);
                                if($langkah == -1){
                                    $df = 0;
                                }else{
                                    $df = 1/pow((1+$langkah), $tahun);
                                }
                                $npv[$tahun] = $netBenefit[$tahun]*$df;
                            }
                            $jumlahNpv = array_sum($npv);
                            
                            // echo $langkah."<br>";
                            // echo $iterasi." => ".$langkah." => ".$jumlahNpv."<br>";
                            //iterasi
                            // if($jumlahNpv  < 0){
                            //     if($jumlahNpv > @$npvMines || !@$npvMines){
                            //         $npvMines = $jumlahNpv;
                            //         $persenDfMines = $langkah;
                            //         $iterasiMines = $iterasi;
                            //     }
                            //     $langkah = round($langkah/2,4);
                            // }else if($jumlahNpv > 0){
                            //     if($jumlahNpv < @$npvPlus || !@$npvPlus){
                            //         $npvPlus = $jumlahNpv;
                            //         $persenDfPlus = $langkah;
                            //         $iterasiPlus = $iterasi;
                            //     }
                            //     $langkah = round($langkah+ ($langkah/2), 4);
                            // }else{
                            //     $jalan = false;
                            // }


                            // $iterasi++;
                            // if($iterasi == 10000){
                            //     $jalan = false;
                            // }
                            // ./iterasi
                            

                            // laju terus
                            if($jumlahNpv  < 0){
                                $npvMines = $jumlahNpv;
                                $persenDfMines = $langkah;
                                $iterasiMines = $iterasi; 
                            }else if($jumlahNpv  > 0){
                                $npvPlus = $jumlahNpv;
                                $persenDfPlus = $langkah;
                                $iterasiPlus = $iterasi;
                            }

                            if(@$npvPlus && @$npvMines){
                                $jalan = false;
                            }
                            $langkah = round($langkah+$dfIterasi, 4);
                            $iterasi++;
                            if($iterasi == 1000){
                                // echo "haha";
                                $jalan = false;
                            }
                            // ./ laju terus

                        }
                        // echo "<br>Mines => "."(".$iterasiMines.") = ".$npvMines." => Df = ".$persenDfMines;
                        // echo "<br>Plus => "."(".$iterasiPlus.") = ".$npvPlus." => Df = ".$persenDfPlus;
                        // echo "<br>Plus => ".$npvPlus;

                        ?>
                        
                        <!-- Tampil Operasional -->
                                    <?php 
                                    $totalDfAwalPlus = 0;
                                    $totalDfAwalMines = 0;
                                    for($tahun = 0; $tahun <= $waktu; $tahun++){ 
                                    $dfMines = 1/pow((1+$persenDfMines), $tahun);    
                                    $dfPlus = 1/pow((1+$persenDfPlus), $tahun);
                                    $df10 = 1/pow((1+$dfAwal), $tahun); 
                                    $totalNetBenefit = $netBenefit[$tahun] + @$totalNetBenefit;
                                    $netBenefitPositive = ($netBenefit[$tahun]);
                                    $totalNpvMines = $dfMines*$netBenefitPositive + @$totalNpvMines;
                                    $totalNpvPlus = $dfPlus*$netBenefitPositive + @$totalNpvPlus;
                                    $totalDfAwal = $df10*$netBenefit[$tahun] + @$totalDfAwal;
                                    if($df10*$netBenefit[$tahun] < 0){
                                        $totalDfAwalMines = $df10*$netBenefit[$tahun] + @$totalDfAwalMines;
                                    }else{
                                        $totalDfAwalPlus = $df10*$netBenefit[$tahun] + @$totalDfAwalPlus;
                                    }
                                    if($tahun == 1){
                                        $pembagiPbp = $df10*$netBenefit[$tahun];
                                    }
                                    ?>
                                    
                                    <?php } ?>
                                    
                            <?php 
                                $totalDfAwalMines = abs($totalDfAwalMines);
                                $nbcr = $totalDfAwalPlus/$totalDfAwalMines;
                                $pbp = ($totalBiayaTahun[0]+$totalAllTahun[0])/$pembagiPbp;
                                $bep = ($totalBiayaTahun[0]+$totalAllTahun[0])/($dataPenerimaan[0]['finansial_penerimaan_harga']-@$totalTahun/($dataPenerimaan[0]['finansial_penerimaan_produk']*12*24));
                            ?>
                            
                            <?php
                            $dfPlus = 100*$persenDfPlus;
                            $dfMines = 100*$persenDfMines;
                            $irr = $dfPlus+(($totalNpvPlus/($totalNpvPlus+$totalNpvMines))*($dfMines-$dfPlus));
                            ?>
                            
                        <!-- .Tampil Operasional -->
                    <!-- Pencarian Prediksi -->
                    <?php if(@$status != 'penetapan'){ ?>
                    <!-- Pencarian Penentuan -->
                            <table style="border-collapse: collapse; width:100%;">
                                <thead>
                                    <tr>
                                        <th colspan="2" <?=$style?> >Hasil</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th <?=$style?> >NPV</th>
                                        <td <?=$style?> ><?=number_format(@$totalDfAwal,2,",",".")?></td>
                                    </tr>
                                    <tr>
                                        <th <?=$style?> >NBCR</th>
                                        <td <?=$style?> ><?=number_format($nbcr,2,",",".")?></td>
                                    </tr>
                                    <tr>
                                        <th <?=$style?> >PBP</th>
                                        <td <?=$style?> ><?=number_format($pbp,2,",",".")?></td>
                                    </tr>
                                    <tr>
                                        <th <?=$style?> >BEP</th>
                                        <td <?=$style?> ><?=number_format($bep,2,",",".")?></td>
                                    </tr>
                                    <tr>
                                        <th <?=$style?> >IRR</th>
                                        <td <?=$style?> ><?=number_format($irr,2,",",".")?></td>
                                    </tr>
                                </tbody>
                            </table>
                    <!-- . Pencarian Penentuan -->
                    <?php }else{ ?>
                    <!-- Penentuan Harga -->
                    <?php
                    $selisih =  @$_GET['selisih']?$_GET['selisih']:5000;
                    $HJATC = @$_GET['HJATC']?$_GET['HJATC']:80000; //HARGA JUAL ATC // 80K sampe 100K dll
                    $JPATC = 0; // JUMLAH PRODUKSI ATC
                    $MKA = @$_GET['MKA']?$_GET['MKA']:25; //persen / MARGIN KEUNTUNGAN AGROINDUSTRI
                    $BPBB = 0; //rumput lau basah pertahun / BIAYA PEMBELIAN BAHAN BAKU
                    $JBBA = 0; //JUMLAH BAHAN BAKU AGROINDUSTRI
                    $HBRLA = 0;
                    foreach($dataPenerimaan as $rowPenerimaan){ 
                        $JPATC = $rowPenerimaan['finansial_penerimaan_produk']*24*12;
                    }
                    $MKA /=100;
                    $BPBB = 24*12*@$dataBahanBaku[0]['finansial_barang_harga']*@$dataBahanBaku[0]['finansial_barang_volume'];
                    $JBBA = 24*12*@$dataBahanBaku[0]['finansial_barang_harga'];
                    ?>
                            <table style="border-collapse: collapse; width:100%;">
                                <thead>
                                    <tr>
                                        <th colspan="6"  <?=$style?> >PENETAPAN HARGA</th>
                                    </tr>
                                    <tr>
                                        <th <?=$style?> >HARGA JUAL ATC (HJATC)</th>
                                        <th <?=$style?> >JUMLAH PRODUKSI ATC (JPATC)</th>
                                        <th <?=$style?> >MARGIN KEUNTUNGAN AGROINDUSTRI (MKA)</th>
                                        <th <?=$style?> >BIAYA PEMBELIAN BAHAN BAKU (BPBB)</th>
                                        <th <?=$style?> >JUMLAH BAHAN BAKU AGROINDUSTRI (JBBA)</th>
                                        <th <?=$style?> >HARGA BELI RUMPUT LAUT DITINGKAT AGROINDUSTRI (HBRLA)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    
                                    $awal = 3*$selisih;
                                    $HJATC = $HJATC - $awal;
                                    $i = 0;
                                    while($i < 10){
                                        
                                        if(@$dataBahanBaku[0]){
                                            $HBRLA = ((($HJATC * $JPATC)*(1-$MKA))-$BPBB)/$JBBA;
                                        }else{
                                            $HBRLA = 0;
                                        }
                                        
                                    ?>
                                    <tr <?=$HJATC==@$_GET['HJATC']?'style="background-color: #cccccc;"':''?> >
                                        <td <?=$style?> ><?=$HJATC?></td>
                                        <td <?=$style?> ><?=$JPATC?></td>
                                        <td <?=$style?> ><?=$MKA?></td>
                                        <td <?=$style?> ><?=$BPBB?></td>
                                        <td <?=$style?> ><?=$JBBA?></td>
                                        <td <?=$style?> ><?=number_format($HBRLA,2,",",".")?></td>
                                    </tr>
                                    <?php 
                                    $HJATC +=$selisih;
                                    $i++;

                                    } ?>
                                </tbody>
                            </table>
                    <!-- . Penentuan Harga -->
                    <?php } ?>
                <!--./ show penjelasan -->
                <?php } ?>
                
                

			