
                <?php 
                $style = ' style="border: 1px solid; padding: 10px;"';
                $name = "Kebutuhan Air ".@$dataAir[0]['finansial_nama'];
                $air = array();
                $pesan = '';
                
                foreach($dataAir as $rowAir){
                    if($rowAir['finansial_kategori_id'] == 4){
                        $air = $rowAir;
                    }
                }
                if(!@$air['finansial_barang_volume']){
                    $pesan = 'Tidak Ada Bahan Baku pada Finansial';
                    $air['finansial_barang_volume'] = 0;
                    $air['kebutuhan_air_jp'] = 0;
                    $air['kebutuhan_air_jdu'] = 0;
                    $air['kebutuhan_air_jdhu'] = 0;

                    $jpp = @$air['finansial_barang_volume']/2*10;
                    $jpn1 = @$air['finansial_barang_volume']/2*10;
                    $jpn2 = @$air['finansial_barang_volume']/2*50;
                    $jp = @$air['kebutuhan_air_jp'];
                    $jdu = @$air['kebutuhan_air_jdu'];
                    $pa = ($jpp*0.15) + ($jpn1*0.15) + ($jpn2*0.15);
                    $jdhu = @$air['kebutuhan_air_jdhu'];

                    $KAPAwal = ($jpp+$jpn1+$jpn2+$pa)*6;
                    $jduPerJp = 0;

                    $KPAHari = 0;
                    $KPABulan = $KPAHari * 24;
                    $KPATahun = $KPABulan * 12;
                }else{
                    $jpp = @$air['finansial_barang_volume']/2*10;
                    $jpn1 = @$air['finansial_barang_volume']/2*10;
                    $jpn2 = @$air['finansial_barang_volume']/2*50;
                    $jp = @$air['kebutuhan_air_jp'];
                    $jdu = @$air['kebutuhan_air_jdu'];
                    $pa = ($jpp*0.15) + ($jpn1*0.15) + ($jpn2*0.15);
                    $jdhu = @$air['kebutuhan_air_jdhu'];

                    $KAPAwal = ($jpp+$jpn1+$jpn2+$pa)*6;
                    $jduPerJp = $jdu / $jp;

                    $KPAHari = $KAPAwal / $jduPerJp;
                    $KPABulan = $KPAHari * 24;
                    $KPATahun = $KPABulan * 12;
                }

                
                
                // echo "<pre>";
                // echo "<div class='row'>";
                // echo "<div class='col-5'>";
                // print_r(@$air);
                // echo "</div>";
                // echo "<div class='col-5'>";
                // print_r(@$wilayahKriteria);
                // echo "</div>";
                // echo "</pre>";
                
                ?>
                
                            <?php if($pesan != ''){ ?>
                                <?=$pesan?>
                            <?php }else{ ?>
                                <?=$pesan?>
                                <h3><?=@$name?></h3>
                                <table style="border-collapse: collapse; width:100%;">
                                <thead>
                                    <tr>
                                        <th <?=$style?> >Nama</th>
                                        <th <?=$style?> >Keterangan</th>
                                        <th <?=$style?> >Nilai</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th <?=$style?> >JPP</th>
                                        <th <?=$style?> >Jumlah Bahan Baku (∑JBB)*10</th>
                                        <th <?=$style?> ><?=$jpp?></th>
                                    </tr>
                                    <tr>
                                        <th <?=$style?> >JPN1</th>
                                        <th <?=$style?> >Jumlah Bahan Baku (∑JBB)*10</th>
                                        <th <?=$style?> ><?=$jpn1?></th>
                                    </tr>
                                    <tr>
                                        <th <?=$style?> >JPN2</th>
                                        <th <?=$style?> >Jumlah Bahan Baku (∑JBB)*50</th>
                                        <th <?=$style?> ><?=$jpn2?></th>
                                    </tr>
                                    <tr>
                                        <th <?=$style?> >JP</th>
                                        <th <?=$style?> >Jumlah proses per hari (proses)</th>
                                        <th <?=$style?> ><?=$jp?></th>
                                    </tr>
                                    <tr>
                                        <th <?=$style?> >JDU</th>
                                        <th <?=$style?> >Jumlah daur ulang air (kali)</th>
                                        <th <?=$style?> ><?=$jdu?></th>
                                    </tr>
                                    <tr>
                                        <th <?=$style?> >PA</th>
                                        <th <?=$style?> >Jumlah Penambahan Air  Daur Ulang (15%/Proses)</th>
                                        <th <?=$style?> ><?=$pa?></th>
                                    </tr>
                                    <tr>
                                        <th <?=$style?> >JDHU</th>
                                        <th <?=$style?> >Jumlah hari ulang (hari)</th>
                                        <th <?=$style?> ><?=$jdhu?></th>
                                    </tr>
                                    <tr>
                                        <th <?=$style?> >KAP</th>
                                        <th <?=$style?> >(PP+PN1+PN2+PADU)*JDU</th>
                                        <th <?=$style?> ><?=$KAPAwal?></th>
                                    </tr>
                                    <tr>
                                        <th <?=$style?> ></th>
                                        <th <?=$style?> >(JDU/JP)</th>
                                        <th <?=$style?> ><?=$jduPerJp?></th>
                                    </tr>
                                    <tr>
                                        <th <?=$style?>  rowspan="3">KAP</th>
                                        <th <?=$style?> >Kebutuhan Air Per Hari</th>
                                        <th <?=$style?> ><?=$KPAHari?></th>
                                    </tr>
                                    <tr>
                                        <th <?=$style?> >Kebutuhan Air Per Bulan</th>
                                        <th <?=$style?> ><?=$KPABulan?></th>
                                    </tr>
                                    <tr>
                                        <th <?=$style?> >Kebutuhan Air Per Tahun</th>
                                        <th <?=$style?> ><?=$KPATahun?></th>
                                    </tr>
                                </tbody>
                            </table>
                            <?php } ?>
                        <!-- .Tampil Bobot -->
                        
                        <!-- . Tampil All Respon -->

			