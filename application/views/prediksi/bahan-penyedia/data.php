
                <?php 

    // print_r($bahan);
                $name =  @$bahan[0]['bahan_penyedia_nama'];

                $produksi = @$bahan[0]['bahan_penyedia_produksi'];
                $produksiKeinginan = @$bahan[0]['bahan_penyedia_produksi_keinginan'];
                $randemen = @$bahan[0]['bahan_penyedia_randemen'];
                $konversi = @$bahan[0]['bahan_penyedia_konversi']; //kg basah /1 kg kering
                $produktifitas = @$bahan[0]['bahan_penyedia_produktifitas'];
                $panenPerTahun = @$bahan[0]['bahan_penyedia_panen'];
                
                //(EOQ)
                $D = 100*24*$produksiKeinginan/$randemen;
                $S = $D*100;
                $H = 100;

                $EOQ = sqrt(2*$D*$S/$H);

                // ROP
                $d = 100*$produksiKeinginan/$randemen;
                $L = 15;
                $SS = $D*3;
                $ROP = ($d*$L)+$SS;

                ?>
				<div class="page-header">
					<div class="row">
						<div class="col-md-6 col-sm-12">
							<!-- <div class="title">
								<h4>Form</h4>
							</div> -->
							<nav aria-label="breadcrumb" role="navigation">
								<ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?=base_url()?>">Home</a></li>
                                    <li class="breadcrumb-item"><a href="<?=$baseUrl."prediksi/bahan/penyedia"?>">Penyedia Bahan Baku</a></li>
									<li class="breadcrumb-item active" aria-current="page"><?=$name?></li>
								</ol>
							</nav>
						</div>
					</div>
				</div>
                <?php if(@$_GET['tombol']){ 


                    if($_GET['tombol'] == 'edit'){
                        $link = 'edit';
                    }else{
                        $link = 'tambah';
                    }   
                    
                ?>
                <!-- Default Basic Forms Start -->
				<div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
					<div class="clearfix">
						<div class="pull-left"><?=$name?></h4>
							<p class="mb-30 font-14">Masukkan Bahan</p>
						</div>
                        <div class="pull-right">
							<a href="?" class="btn btn-primary btn-sm scroll-click" ><i class="fi-arrow-left"></i> Kembali</a>
						</div>
					</div>
					<form method="POST" action="<?=base_url()?>prediksi/finansial/barang/<?=$link?>">
                    <!-- <form method="POST" action=""> -->
                        <input type="hidden" name="id" value="<?=@$id?>" />
                        <input type="hidden" name="idBarang" value="<?=@$_GET['id']?>" />
                        <div class="form-group row">
							<label class="col-sm-12 col-md-2 col-form-label">Kategori</label>
							<div class="col-sm-12 col-md-10">
								<select class="custom-select col-12" name="kategori" id="kategori">
									<option >Pilih Kategori</option>
                                    <?php foreach($dataKategori as $rowKategori){ ?>
									<option <?=$rowKategori['finansial_kategori_id']==@$dataPilih[0]['finansial_kategori_id']?'selected':''?> value="<?=$rowKategori['finansial_kategori_id']?>"><?=$rowKategori['finansial_kategori_nama']?></option>
                                    <?php } ?>
								</select>
							</div>
						</div>
                        <div class="form-group row">
							<label class="col-sm-12 col-md-2 col-form-label">Bahan</label>
							<div class="col-sm-12 col-md-10">
								<select class="custom-select col-12" name="bahan" id="bahan">
									<option>Pilih Bahan</option>
								</select>
							</div>
                        </div>
                        <div class="form-group row">
							<label class="col-sm-12 col-md-2 col-form-label">Harga</label>
							<div class="col-sm-12 col-md-10">
								<input class="form-control" type="number" placeholder="Harga Bahan" value="<?=@$dataPilih[0]['finansial_bahan_harga']?>" id="harga" disabled>
							</div>
						</div>
                        <div class="form-group row">
							<label class="col-sm-12 col-md-2 col-form-label">Volume</label>
							<div class="col-sm-12 col-md-10">
								<input class="form-control" type="number" placeholder="Masukkan Volume Bahan" name="volume" value="<?=@$dataPilih[0]['finansial_barang_volume']?>">
							</div>
						</div>
                        <div class="form-group row">
							<label class="col-sm-12 col-md-2 col-form-label">Satuan</label>
							<div class="col-sm-12 col-md-10">
								<select class="custom-select col-12" name="satuan">
									<option >Pilih Satuan</option>
                                    <?php foreach($dataSatuan as $row){ ?>
									<option <?=$row['satuan_id']==@$dataPilih[0]['satuan_id']?'selected':''?> value="<?=$row['satuan_id']?>"><?=$row['satuan_nama']?></option>
                                    <?php } ?>
								</select>
							</div>
						</div>
                    
                        <button class="btn btn-primary">submit</button>
					</form>
				</div>
				<!-- Default Basic Forms End -->
                <?php }else{ ?>

                <div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
                    <div class="clearfix">
						<div class="pull-left">
							<h4 class="text-blue"><?=@$name?></h4>
							<p class="mb-30 font-14">Hasil <?=@$name?></p>
						</div>
                        <div class="pull-right">
                            <a href="<?=$baseUrl."bahan/penyedia/".$jenis?>" class="btn btn-primary btn-sm scroll-click" ><i class="fi-arrow-left"></i> Kembali</a>
						</div>
					</div>
                    <div class="row">
                        <div id="tampilHasilAll"></div>
                    </div>
                    <hr>
                    <div class="clearfix">
                        <div class="pull-right">
                        <a href="#" class="btn btn-info btn-sm scroll-click" data-table="penjelasan" onclick="viewTable(this)"><i class="fa fa-plus-circle"></i> Lihat Penjelasan</a>
						</div>
					</div>
                </div>
                
                <div id="penjelasan" class="set-hide">
                    <!-- Data Inputan -->
                    <div class="pd-20 bg-white border-radius-4 box-shadow mb-30" id="tableInput">
                        <div class="clearfix">
                            <div class="pull-left">
                                <h4 class="text-blue"><?=@$name?></h4>
                                <p class="mb-30 font-14">Data <?=@$name?></p>
                            </div>
                            <!-- <div class="pull-right">
                                <a href="<?=$baseUrl."prediksi/bahan/penyedia"?>" class="btn btn-primary btn-sm scroll-click" ><i class="fi-arrow-left"></i> Kembali</a>
                            </div> -->
                        </div>
                        <!-- Tampil bahan baku -->
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-12 col-form-label">kebutuhan bahan baru (rumput laut kering)</label>
                        </div>
                        <table class="table table-bordered ">
                            <thead>
                                <tr>
                                    <th scope="col"></th>
                                    <th scope="col"></th>
                                    <th scope="col">Per Hari</th>
                                    <th scope="col">Per Bulan</th>
                                    <th scope="col">Per Tahun</th>
                                </tr>
                            </thead>
                            <tbody>
                            <tr>
                                    <th>KP</th>
                                    <th>Kapasitas Produksi (kg)</th>
                                    <td><?=$produksi?></td>
                                    <td><?=$produksi*24?></td>
                                    <td><?=$produksi*24*12?></td>
                                </tr>
                                <tr>
                                    <th>KP</th>
                                    <th>Keinginan produksi/produk ATC (kg)</th>
                                    <td><?=$produksiKeinginan?></td>
                                    <td><?=$produksiKeinginan*24?></td>
                                    <td><?=$produksiKeinginan*24*12?></td>
                                </tr>
                                <tr>
                                    <th>(R-ATC)</th>
                                    <th>Rendemen</th>
                                    <td></td>
                                    <td></td>
                                    <td><?=$randemen?>%</td>
                                </tr>
                                <tr>
                                    <th>KBB</th>
                                    <th>kebutuhan bahan baku (kg)</th>
                                    <td><?=100*$produksiKeinginan/$randemen?></td>
                                    <td><?=100*24*$produksiKeinginan/$randemen?></td>
                                    <td><?=100*24*12*$produksiKeinginan/$randemen?></td>
                                </tr>
                            </tbody>
                        </table>
                        <br>
                        <hr>
                        <!-- .Tampil bahan baku -->

                        <!-- Tampil luas lahan -->
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-12 col-form-label">Kebutuhan luas lahan (KLL)</label>
                        </div>
                        <table class="table table-bordered ">
                            <thead>
                                <tr>
                                    <th scope="col"></th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th>Konversi</th>
                                    <td><?=$konversi?> Kg (Basah)/ Kg (Kering)</td>
                                </tr>
                                <tr>
                                    <th>Produktivitas</th>
                                    <td><?=$produktifitas?> Kg/ha</td>
                                </tr>
                                <tr>
                                    <th>panen/tahun</th>
                                    <td><?=$panenPerTahun?></td>
                                </tr>
                                <tr>
                                    <th>KLL</th>
                                    <td><?=(100*24*12*$produksiKeinginan/$randemen)/$konversi/$produktifitas/$panenPerTahun?> ha</td>
                                </tr>
                            </tbody>
                        </table>
                        <br>
                        <hr>
                        <!-- .Tampil luas lahan -->

                        <!-- Tampil EOQ -->
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-12 col-form-label">Jumlah Pembelian Bahan Baku yang Ekonomis (EOQ)</label>
                        </div>
                        <table class="table table-bordered ">
                            <thead>
                                <tr>
                                    <th scope="col" colspan="2">EOQ</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th>D</th>
                                    <td><?=$D?></td>
                                </tr>
                                <tr>
                                    <th>S</th>
                                    <td><?=$S?></td>
                                </tr>
                                <tr>
                                    <th>H</th>
                                    <td><?=$H?></td>
                                </tr>
                                <tr>
                                    <th>EOQ</th>
                                    <td><?=$EOQ?></td>
                                </tr>
                            </tbody>
                        </table>
                        <br>
                        <hr>
                        <!-- .Tampil EOQ -->

                        <!-- Tampil ROP -->
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-12 col-form-label">Titik Pemesanan Kembali (ROP)</label>
                        </div>
                        <table class="table table-bordered ">
                            <thead>
                                <tr>
                                    <th scope="col" colspan="2">ROP</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th>d</th>
                                    <td><?=$d?></td>
                                </tr>
                                <tr>
                                    <th>L</th>
                                    <td><?=$L?></td>
                                </tr>
                                <tr>
                                    <th>SS</th>
                                    <td><?=$SS?></td>
                                </tr>
                                <tr>
                                    <th>ROP</th>
                                    <td><?=$ROP?></td>
                                </tr>
                            </tbody>
                        </table>
                        <br>
                        <hr>
                        <!-- .Tampil ROP -->
                    </div>
                    <!-- ./ Data Inputan -->

                    
                    <!-- Hasil -->
                    <div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
                        <div class="clearfix">
                            <div class="pull-left">
                                <h4 class="text-blue"><?=@$name?></h4>
                                <p class="mb-30 font-14">Hasil <?=@$name?></p>
                            </div>
                            <!-- <div class="pull-right">
                                <a href="<?=$baseUrl."prediksi/bahan/penyedia"?>" class="btn btn-primary btn-sm scroll-click" ><i class="fi-arrow-left"></i> Kembali</a>
                            </div> -->
                        </div>
                        <!-- <div class="form-group row">
                            <label class="col-sm-12 col-md-12 col-form-label">kebutuhan bahan baru (rumput laut kering)</label>
                        </div> -->
                        <div id="hasilAll">
                            <a href="<?=base_url()."bahan/penyedia/".$jenis."/".@$id."/save"?>" class="btn btn-warning">PFD</a>
                            <hr>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col" colspan="2">Hasil</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php if(!@$jenis) $jenis = NULL; if($jenis == 'kll'){ ?>
                                    <tr>
                                        <th>Kebutuhan bahan baku (KBB)</th>
                                        <td><?=number_format(100*24*12*@$produksiKeinginan/@$randemen,4,",",".")?> kg</td>
                                    </tr>
                                    <tr>
                                        <th>Kebutuhan luas lahan (KLL)</th>
                                        <td><?=number_format((100*24*12*@$produksiKeinginan/@$randemen)/@$konversi/@$produktifitas/@$panenPerTahun,4,",",".")?> ha</td>
                                    </tr>
                                <?php } else if($jenis == 'rop'){ ?>
                                    <tr>
                                        <th>Jumlah Pembelian Bahan Baku yang Ekonomis (EOQ)</th>
                                        <td><?=number_format(@$EOQ,4,",",".")?> Kg</td>
                                    </tr>
                                    <tr>
                                        <th>Titik Pemesanan Kembali (ROP)</th>
                                        <td><?=number_format(@$ROP,4,",",".")?> Kg</td>
                                    </tr>
                                <?php }else if($jenis == NULL){ ?> 
                                    <tr>
                                        <th>Kebutuhan bahan baku (KBB)</th>
                                        <td><?=number_format(100*24*12*@$produksiKeinginan/@$randemen,4,",",".")?> kg</td>
                                    </tr>
                                    <tr>
                                        <th>Kebutuhan luas lahan (KLL)</th>
                                        <td><?=number_format((100*24*12*@$produksiKeinginan/@$randemen)/@$konversi/@$produktifitas/@$panenPerTahun,4,",",".")?> Kg/ha</td>
                                    </tr>
                                    <tr>
                                        <th>Jumlah Pembelian Bahan Baku yang Ekonomis (EOQ)</th>
                                        <td><?=number_format(@$EOQ,4,",",".")?> Kg</td>
                                    </tr>
                                    <tr>
                                        <th>Titik Pemesanan Kembali (ROP)</th>
                                        <td><?=number_format(@$ROP,4,",",".")?> Kg</td>
                                    </tr>
                                <?php } ?>
                                </tbody>
                            </table>
                        </div>
                        
                        <br>
                        <hr>
                    </div>
                    <!-- ./ Hasil -->
                </div>
                
                
                <?php } ?>
                
                

			