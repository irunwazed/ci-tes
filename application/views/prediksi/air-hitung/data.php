
                <?php 
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
				<div class="page-header">
					<div class="row">
						<div class="col-md-6 col-sm-12">
							<!-- <div class="title">
								<h4>Perhitungan</h4>
							</div> -->
							<nav aria-label="breadcrumb" role="navigation">
								<ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?=$baseUrl?>">Home</a></li>
                                <li class="breadcrumb-item"><a href="<?=$baseUrl."prediksi/kebutuhan-air"?>">Kebutuhan Air</a></li>
									<li class="breadcrumb-item active" aria-current="page"><?=$name?></li>
								</ol>
							</nav>
						</div>
					</div>
				</div>
                
                <!-- Default Basic Forms Start -->
				<div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
                    <div class="clearfix">
						<div class="pull-left">
							<h4 class="text-blue"><?=$name?></h4>
							<p class="mb-30 font-14">Hasil <?=$name?></p>
						</div>
                        <div class="pull-right">
                            <a href="<?=$baseUrl."prediksi/kebutuhan-air"?>" class="btn btn-primary btn-sm scroll-click" ><i class="fa fi-arrow-left"></i> Kembali</a>
						</div>
					</div>
                    <div id="tampilHasilRekap"></div>
                    <div class="clearfix">
                        <div class="pull-right">
                        <a href="#" class="btn btn-info btn-sm scroll-click" data-table="penjelasan" onclick="viewTable(this)"><i class="fa fi-arrow-down"></i> Lihat Penjelasan</a>
						</div>
					</div>
                </div>

                <div id="penjelasan" class="set-hide">
                    <!-- Default Basic Forms Start -->
                    <div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
                        <div class="clearfix">
                            <div class="pull-left">
                                <h4 class="text-blue"><?=$name?></h4>
                                <p class="mb-30 font-14">Perhitungan <?=$name?></p>
                            </div>
                        </div>
                        <!-- <div class="col-12 row" style="padding:10px">
                            <div class="col-5"></div>
                            <div class="bg-success col-2 text-white" style="text-align: center;" id="hasil"></div>
                            <div class="col-5"></div>
                        </div> -->
                        <!-- Tampil BOBOT -->
                        <div id="hasilRekap">
                            <?php if($pesan != ''){ ?>
                                <?=$pesan?>
                            <?php }else{ ?>
                                <?=$pesan?>
                                <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">Nama</th>
                                        <th scope="col">Keterangan</th>
                                        <th scope="col">Nilai</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">JPP</th>
                                        <th scope="row">Jumlah Bahan Baku (∑JBB)*10</th>
                                        <th scope="row"><?=$jpp?></th>
                                    </tr>
                                    <tr>
                                        <th scope="row">JPN1</th>
                                        <th scope="row">Jumlah Bahan Baku (∑JBB)*10</th>
                                        <th scope="row"><?=$jpn1?></th>
                                    </tr>
                                    <tr>
                                        <th scope="row">JPN2</th>
                                        <th scope="row">Jumlah Bahan Baku (∑JBB)*50</th>
                                        <th scope="row"><?=$jpn2?></th>
                                    </tr>
                                    <tr>
                                        <th scope="row">JP</th>
                                        <th scope="row">Jumlah proses per hari (proses)</th>
                                        <th scope="row"><?=$jp?></th>
                                    </tr>
                                    <tr>
                                        <th scope="row">JDU</th>
                                        <th scope="row">Jumlah daur ulang air (kali)</th>
                                        <th scope="row"><?=$jdu?></th>
                                    </tr>
                                    <tr>
                                        <th scope="row">PA</th>
                                        <th scope="row">Jumlah Penambahan Air  Daur Ulang (15%/Proses)</th>
                                        <th scope="row"><?=$pa?></th>
                                    </tr>
                                    <tr>
                                        <th scope="row">JDHU</th>
                                        <th scope="row">Jumlah hari ulang (hari)</th>
                                        <th scope="row"><?=$jdhu?></th>
                                    </tr>
                                    <tr>
                                        <th scope="row">KAP</th>
                                        <th scope="row">(PP+PN1+PN2+PADU)*JDU</th>
                                        <th scope="row"><?=$KAPAwal?></th>
                                    </tr>
                                    <tr>
                                        <th scope="row"></th>
                                        <th scope="row">(JDU/JP)</th>
                                        <th scope="row"><?=$jduPerJp?></th>
                                    </tr>
                                    <tr>
                                        <th scope="row" rowspan="3">KAP</th>
                                        <th scope="row">Kebutuhan Air Per Hari</th>
                                        <th scope="row"><?=$KPAHari?></th>
                                    </tr>
                                    <tr>
                                        <th scope="row">Kebutuhan Air Per Bulan</th>
                                        <th scope="row"><?=$KPABulan?></th>
                                    </tr>
                                    <tr>
                                        <th scope="row">Kebutuhan Air Per Tahun</th>
                                        <th scope="row"><?=$KPATahun?></th>
                                    </tr>
                                </tbody>
                            </table>
                            <?php } ?>
                        </div>
                        
                        <br>
                        <hr>
                        <!-- .Tampil Bobot -->
                        
                        <!-- . Tampil All Respon -->
                        <script>
                        
                            var data= [];
                        </script>
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
                                // $hasil =  $this->mpe->getMpe($kirim); 
                            }
                        ?>
                    </div>
                    <!-- Default Basic Forms End -->
                </div>
                
                
                <script>
                   
                </script>

			