
                <?php 
                $name = @$dataFinansial[0]['finansial_nama'];
                $waktu = @$dataFinansial[0]['finansial_waktu']+0;
                $kriteria = array();
                $kriteriaBobot = array();
                // echo "<pre>";
                // print_r($dataBiaya);

                $jumlahFinansial = count($dataBiaya);
                $jumlahPenerimaan = count($dataPenerimaan);
                $jumlahOperasional = count($dataOperasional);
                // echo "<pre>";
                // echo "<div class='row'>";
                // echo "<div class='col-5'>";
                // print_r(@$dataPilih);
                // echo "</div>";
                // echo "<div class='col-5'>";
                // print_r(@$dataOperasional);
                // echo "</div>";
                // echo "</pre>";
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
                
                ?>
				<div class="page-header">
					<div class="row">
						<div class="col-md-6 col-sm-12">
							<!-- <div class="title">
								<h4>Form</h4>
							</div> -->
							<nav aria-label="breadcrumb" role="navigation">
								<ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?=$baseUrl?>">Home</a></li>
                                <li class="breadcrumb-item"><a href="<?=$baseUrl."prediksi/finansial/".(@$status?$status.'/':'')?>"><?=@$status?'Penetapan Bahan Baku Finansial':'Kelayakan Finansial'?></a></li>
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
					<form method="POST" action="<?=$baseUrl?>prediksi/finansial/barang/<?=$link?>">
                    <!-- <form method="POST" action=""> -->
                        <input type="hidden" name="id" value="<?=@$id?>" />
                        <input type="hidden" name="idBarang" value="<?=@$_GET['id']?>" />
                        <div class="form-group row">
							<label class="col-sm-12 col-md-2 col-form-label">Kategori</label>
							<div class="col-sm-12 col-md-10">
								<select class="custom-select col-12" name="kategori" id="kategori" required autofocus>
									<option >Pilih Kategori</option>
                                    <?php foreach($dataKategori as $rowKategori){ ?>
									<option <?=$rowKategori['finansial_kategori_id']==@$dataPilih[0]['finansial_kategori_id']?'selected':''?> value="<?=$rowKategori['finansial_kategori_id']?>"><?=$rowKategori['finansial_kategori_nama']?></option>
                                    <?php } ?>
								</select>
							</div>
						</div>
                        <div class="form-group row">
							<label class="col-sm-12 col-md-2 col-form-label">Item</label>
							<div class="col-sm-12 col-md-10">
                            <input class="form-control" type="text" placeholder="Nama Item" value="<?=@$dataPilih[0]['finansial_barang_nama']?>" id="nama" name="nama" required autofocus>
							</div>
                        </div>
                        <div class="form-group row">
							<label class="col-sm-12 col-md-2 col-form-label">Harga</label>
							<div class="col-sm-12 col-md-10">
								<input class="form-control" type="number" placeholder="Harga Item" value="<?=@$dataPilih[0]['finansial_barang_harga']?>" id="harga" name="harga" required autofocus>
							</div>
						</div>
                        <div class="form-group row">
							<label class="col-sm-12 col-md-2 col-form-label">Umur</label>
							<div class="col-sm-12 col-md-10">
								<input class="form-control" type="number" placeholder="Umur Item" value="<?=@$dataPilih[0]['finansial_barang_umur']?>" id="umur" name="umur" required autofocus>
							</div>
						</div>
                        <div class="form-group row">
							<label class="col-sm-12 col-md-2 col-form-label">Volume</label>
							<div class="col-sm-12 col-md-10">
								<input class="form-control" type="number" step="0.01" placeholder="Volume Item" name="volume" value="<?=@$dataPilih[0]['finansial_barang_volume']?>" required autofocus>
							</div>
						</div>
                        <div class="form-group row">
							<label class="col-sm-12 col-md-2 col-form-label">Satuan</label>
							<div class="col-sm-12 col-md-10">
								<select class="custom-select col-12" name="satuan" required autofocus>
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
                <!-- Kondisi -->
				<div class="pd-20 bg-white border-radius-4 box-shadow mb-30 " >
					<div class="clearfix">
						<div class="pull-left">
							<h4 class="text-blue"><?=$name?></h4>
							<p class="mb-30 font-14">Prediksi <?=$name?></p>
						</div>
                        <div class="pull-right">
                        <a href="<?=$baseUrl."prediksi/finansial/".(@$status?$status.'/':'')?>" class="btn btn-primary btn-sm scroll-click" ><i class="fi-arrow-left"></i> Kembali</a>
						</div>
                    </div>
                    <div class="row" id="hasilFinansial">
                        <div class="col-sm-6">
                            <form action="">
                                <div class="form-group row">
                                    <label class="col-sm-12 col-md-3 col-form-label">Bahan Baku</label>
                                    <div class="col-sm-12 col-md-6">
                                        <input type="number" step="any" class="form-control" value="<?=@$_GET['bahanbaku']?$_GET['bahanbaku']:0?>" name="bahanbaku">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-12 col-md-3 col-form-label">Inflasi</label>
                                    <div class="col-sm-12 col-md-6">
                                        <input type="number" step="any" class="form-control" name="inflasi" value="<?=@$_GET['inflasi']?$_GET['inflasi']:0?>" >
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-12 col-md-3 col-form-label">Produksi</label>
                                    <div class="col-sm-12 col-md-6">
                                        <input type="number" step="any" class="form-control" name="produksi" value="<?=@$_GET['produksi']?$_GET['produksi']:0?>" >
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-12 col-md-3 col-form-label">Biaya Produksi</label>
                                    <div class="col-sm-12 col-md-6">
                                        <input type="number" step="any" class="form-control" name="harga" value="<?=@$_GET['harga']?$_GET['harga']:0?>" >
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-12 col-md-3 col-form-label">Harga jual ATC</label>
                                    <div class="col-sm-12 col-md-6">
                                        <input type="number" step="any" class="form-control" name="atc" value="<?=@$_GET['atc']?$_GET['atc']:0?>" >
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-12 col-md-3 col-form-label">Lama Biaya Operasianal</label>
                                    <div class="col-sm-12 col-md-6">
                                        <select class="custom-select col-12" name="lama" required autofocus>
                                            <option value="1">Pilih Lama Biaya Operasianal</option>
                                            <option value="1" <?=$lama==1?'selected':''?> >Harian</option>
                                            <option value="24" <?=$lama==24?'selected':''?> >Bulanan</option>
                                            <option value="<?=12*24?>" <?=$lama==(12*24)?'selected':''?> >Tahunan</option>
                                        </select>
                                    </div>
                                </div>
                                <button class="btn btn-primary">submit</button>
                            </form>
                        </div>
                        <div class="col-sm-6" id="tampilHasil">
                        </div>
                        <br>
                        <hr>
                    </div>
                    <div class="row" id="hasilPenetapan">
                        <div class="col-sm-4">
                            <form action="">
                                <div class="form-group row">
                                    <label class="col-sm-12 col-md-12 col-form-label">MARGIN KEUNTUNGAN AGROINDUSTRI (%)</label>
                                    <div class="col-sm-12 col-md-12">
                                        <input type="number" step="any" class="form-control" value="<?=@$_GET['MKA']?$_GET['MKA']:25?>" name="MKA">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-12 col-md-12 col-form-label">HARGA JUAL ATC</label>
                                    <div class="col-sm-12 col-md-12">
                                    <input type="number" step="any" class="form-control" value="<?=@$_GET['HJATC']?$_GET['HJATC']:80000?>" name="HJATC">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-12 col-md-12 col-form-label">Selisih</label>
                                    <div class="col-sm-12 col-md-12">
                                    <input type="number" step="any" class="form-control" value="<?=@$_GET['selisih']?$_GET['selisih']:5000?>" name="selisih">
                                    </div>
                                </div>
                                <button class="btn btn-primary">submit</button>
                            </form>
                        </div>
                        <div class="col-sm-8" id="tampilPenetapan">
                        </div>
                        <br>
                        <hr>
                    </div>
                    <div class="clearfix">
                        <div class="pull-right">
                            <a href="#" class="btn btn-info btn-sm scroll-click" data-table="penjelasan" onclick="viewTable(this)"><i class="fa fa-plus-circle"></i> Lihat Penjelasan</a>
						</div>
                    </div>
				</div>
                <!-- Kondisi -->
                
                <!-- show penjelasan -->
                <div id="penjelasan" class="set-hide">
                
                    <!-- Data Inputan -->
                    <div class="pd-20 bg-white border-radius-4 box-shadow mb-30" id="tableInput">
                        <div class="clearfix">
                            <div class="pull-left">
                                <h4 class="text-blue"><?=$name?></h4>
                                <p class="mb-30 font-14">Data <?=$name?></p>
                            </div>
                            <div class="pull-right">
                                <a href="?tombol=tambah" class="btn btn-primary btn-sm scroll-click" ><i class="fa fa-plus-circle"></i> Tambah Data</a>
                            </div>
                        </div>

                        <?php if($jumlahFinansial > 0){ ?>
                        <!-- Tampil Biaya -->
                        <div class="clearfix">
                            <label class="col-sm-12 col-md-6 col-form-label">Biaya Investasi</label>
                        </div>
                        <div id="data-biaya">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Item</th>
                                        <th scope="col">Volume</th>
                                        <th scope="col">Satuan</th>
                                        <th scope="col">Harga</th>
                                        <th scope="col">Jumlah</th>
                                        <th scope="col">Umur</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $totalAll = 0; 
                                    $totalKategori = 0; 
                                    $no = 0; 
                                    $tempKategori = 0;
                                    foreach($dataBiaya as $rowFinansial){ 
                                        $totalAll += $rowFinansial['finansial_barang_harga']*$rowFinansial['finansial_barang_volume'];
                                        if($tempKategori != $rowFinansial['finansial_kategori_id']){
                                            $no = 0;
                                            
                                            $tempKategori = $rowFinansial['finansial_kategori_id'];
                                    ?>
                                    <tr>
                                        <td scope="row" colspan="8"><?=$rowFinansial['finansial_kategori_nama']?></td>
                                    </tr>
                                    <?php
                                        $totalKategori = $rowFinansial['finansial_barang_harga']*$rowFinansial['finansial_barang_volume'];
                                        }else{
                                            $totalKategori += $rowFinansial['finansial_barang_harga']*$rowFinansial['finansial_barang_volume'];
                                        }
                                    ?>
                                    <tr>
                                        <td scope="row"><?=$no+1?></td>
                                        <td scope="row"><?=$rowFinansial['finansial_barang_nama']?></td>
                                        <td scope="row"><?=$rowFinansial['finansial_barang_volume']?></td>
                                        <td scope="row"><?=$rowFinansial['satuan_nama']?></td>
                                        <td scope="row">Rp. <?=number_format($rowFinansial['finansial_barang_harga'],2,",",".")?></td>
                                        <td scope="row">Rp. <?=number_format($rowFinansial['finansial_barang_harga']*$rowFinansial['finansial_barang_volume'],2,",",".")?></td>
                                        <td scope="row"><?=$rowFinansial['finansial_barang_umur']?></td>
                                        <td scope="row">
                                            <a href="?tombol=edit&id=<?=$rowFinansial['finansial_barang_id']?>" class="btn btn-primary"><i class="fi-pencil"></i></a>
                                            <a href="<?=$baseUrl."prediksi/finansial/".$id."/barang/hapus/".$rowFinansial['finansial_barang_id']?>" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                    <?php $no++; } ?>
                                    <tr>
                                        <td scope="row" colspan="5">TOTAL BIAYA INVESTASI</td>
                                        <td scope="row">Rp. <?=number_format($totalAll,2,",",".")?></td>
                                        <td scope="row"></td>
                                        <td scope="row"></td>
                                    </tr>
                                </tbody>
                            </table>
                            <br>
                            <hr>
                        </div>
                        <!-- .Tampil Biaya -->
                        
                        

                        <?php if($jumlahOperasional > 0){ ?>
                        <!-- Tampil Operasional -->
                        <div class="clearfix">
                            <label class="col-sm-12 col-md-6 col-form-label">Biaya Operasional</label>
                        </div>
                        <div id="data-operasional">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Item</th>
                                        <th scope="col">Satuan</th>
                                        <th scope="col">Volume</th>
                                        <th scope="col">Harga</th>
                                        <th scope="col">Nilai (Per Satuan)</th>
                                        <th scope="col">Nilai Per Bulan</th>
                                        <th scope="col">Nilai Per Tahun</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
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
                                    <tr>
                                        <td scope="row"><?=$no+1?></td>
                                        <td scope="row"><?=$rowFinansial['finansial_barang_nama']?></td>
                                        <td scope="row"><?=$rowFinansial['satuan_nama']?></td>
                                        <td scope="row"><?=$rowFinansial['finansial_barang_volume']?></td>
                                        <td scope="row">Rp. <?=number_format($rowFinansial['finansial_barang_harga'],2,",",".")?></td>
                                        <td scope="row">Rp. <?=number_format($nilai,2,",",".")?></td>
                                        <td scope="row">Rp. <?=number_format($nilai*24,2,",",".")?></td>
                                        <td scope="row">Rp. <?=number_format($nilai*24*12,2,",",".")?></td>
                                        <td scope="row">
                                            <a href="?tombol=edit&id=<?=$rowFinansial['finansial_barang_id']?>" class="btn btn-primary"><i class="fi-pencil"></i></a>
                                            <a href="<?=$baseUrl."prediksi/finansial/".$id."/barang/hapus/".$rowFinansial['finansial_barang_id']?>" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                    <?php $no++; } ?>
                                    <tr>
                                        <td scope="row" colspan="5">TOTAL BIAYA OPERASIONAL</td>
                                        <td scope="row">Rp. <?=number_format($totalHari,2,",",".")?></td>
                                        <td scope="row">Rp. <?=number_format($totalBulan,2,",",".")?></td>
                                        <td scope="row">Rp. <?=number_format($totalTahun,2,",",".")?></td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                            <br>
                            <hr>
                        </div>
                        <!-- .Tampil Operasional -->
                        
                        <?php } ?>

                        <?php if($jumlahPenerimaan > 0){ ?>
                        <!-- Tampil Penerimaan -->
                        <div class="clearfix">
                            <label class="col-sm-12 col-md-6 col-form-label">Penerimaan</label>
                        </div>
                        <div id="data-penerimaan">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">Satuan</th>
                                        <th scope="col">Per Hari</th>
                                        <th scope="col">Per Bulan</th>
                                        <th scope="col">Per Tahun</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $no = 0; 
                                    foreach($dataPenerimaan as $rowPenerimaan){ 
                                        $harga = $rowPenerimaan['finansial_penerimaan_harga'];
                                        $produk = $rowPenerimaan['finansial_penerimaan_produk'];
                                        
                                    ?>
                                    <tr>
                                        <td scope="row"><?=$no+1?></td>
                                        <td scope="row">Produksi (Kg)</td>
                                        <td scope="row"></td>
                                        <td scope="row"><?=$produk?></td>
                                        <td scope="row">Rp. <?=number_format($produk*24,2,",",".")?></td>
                                        <td scope="row">Rp. <?=number_format($produk*24*12,2,",",".")?></td>
                                    </tr>
                                    <?php $no++; ?>
                                    <tr>
                                        <td scope="row"><?=$no+1?></td>
                                        <td scope="row">Harga (Rp/Kg)</td>
                                        <td scope="row"></td>
                                        <td scope="row"><?=$harga?></td>
                                        <td scope="row">Rp. <?=number_format($harga*24,2,",",".")?></td>
                                        <td scope="row">Rp. <?=number_format($harga*24*12,2,",",".")?></td>
                                    </tr>
                                    <?php $no++; ?>
                                    <tr>
                                        <td scope="row"><?=$no+1?></td>
                                        <td scope="row">Penerimaan (Rp)</td>
                                        <td scope="row"></td>
                                        <td scope="row"><?=$harga*$produk?></td>
                                        <td scope="row">Rp. <?=number_format($harga*24*$produk,2,",",".")?></td>
                                        <td scope="row">Rp. <?=number_format($harga*24*12*$produk,2,",",".")?></td>
                                    </tr>
                                    <?php  } ?>
                                </tbody>
                            </table>
                            <br>
                            <hr>
                        </div>
                        <!-- .Tampil Penerimaan -->
                        
                        <?php } ?>
                        <?php } ?>
                    </div>
                    <!-- ./ Data Inputan -->
                    
                    <?php if($jumlahFinansial > 0){ ?>
                    <!-- Pembuatan Tabel Semua -->
                    <div class="pd-20 bg-white border-radius-4 box-shadow mb-30" id="tableAll">
                        <div class="clearfix">
                            <div class="pull-left">
                                <h4 class="text-blue"><?=$name?></h4>
                                <p class="mb-30 font-14">Cash Flow <?=$name?></p>
                            </div>
                            <div class="pull-right">
                                <a href="?tombol=tambah" class="btn btn-primary btn-sm scroll-click" ><i class="fa fa-plus-circle"></i> Tambah Data</a>
                            </div>
                        </div>
                        
                        <?php
                            //deklarasi perubahan data
                            $perawatan = 1/100;
                            $pajak = 15/1000;
                        
                        ?>
                            <table class="table table-bordered table-responsive">
                                <thead>
                                    <tr>
                                        <th scope="col" rowspan="2">No</th>
                                        <th scope="col" rowspan="2"></th>
                                        <th scope="col" rowspan="2" colspan="2">Uraian</th>
                                        <th scope="col" rowspan="2">Volume</th>
                                        <th scope="col" rowspan="2">Satuan</th>
                                        <th scope="col" colspan="<?=@$waktu+1?>">Tahun ke-</th>
                                    </tr>
                                    <tr>
                                        <?php for($i =0; $i <= $waktu; $i++){ ?>
                                            <th scope="col"><?=$i?></th>
                                        <?php } ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td scope="row">I</td>
                                        <td scope="row" colspan="<?=$waktu+6?>">Biaya</td>
                                    </tr>
                                    <tr>
                                        <td scope="row"></td>
                                        <td scope="row" colspan="<?=$waktu+6?>">A. Biaya Investasi</td>
                                    </tr>
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
                                    <tr>
                                        <td scope="row"></td>
                                        <td scope="row"></td>
                                        <td scope="row" colspan="4"><?=$rowFinansial['finansial_kategori_nama']?></td>
                                        <td scope="row" colspan="<?=$waktu+1?>"></td>
                                    </tr>
                                    <?php
                                        $totalKategori = $rowFinansial['finansial_barang_harga']*$rowFinansial['finansial_barang_volume'];
                                        }else{
                                            $totalKategori += $rowFinansial['finansial_barang_harga']*$rowFinansial['finansial_barang_volume'];
                                        }
                                    ?>
                                    <tr>
                                        <td scope="row"></td>
                                        <td scope="row"></td>
                                        <td scope="row"><?=$no+1?></td>
                                        <td scope="row"><?=$rowFinansial['finansial_barang_nama']?></td>
                                        <td scope="row"><?=$rowFinansial['finansial_barang_volume']?></td>
                                        <td scope="row"><?=$rowFinansial['satuan_nama']?></td>
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
                                        <td scope="row">Rp. <?=number_format($totalHargaPerubahan[$tahunKe],2,",",".")?></td>
                                        <?php } ?>
                                    </tr>
                                    <?php $no++;  } ?>
                                    <tr>
                                        <td scope="row"></td>
                                        <td scope="row"></td>
                                        <th scope="row" colspan="4">TOTAL BIAYA INVESTASI</th>
                                        <?php for($tahunKe =0; $tahunKe <= $waktu;$tahunKe++){ ?>
                                        <th scope="row">Rp. <?=number_format($totalAllTahun[$tahunKe],2,",",".")?></th>
                                        <?php } ?>
                                    </tr>
                                    <tr>
                                        <td scope="row"></td>
                                        <td scope="row" colspan="<?=$waktu+6?>">B. Biaya Operasional</td>
                                    </tr>
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
                                    <tr>
                                        <td scope="row"></td>
                                        <td scope="row"></td>
                                        <td scope="row"><?=$no+1?></td>
                                        <td scope="row"><?=$rowFinansial['finansial_barang_nama']?></td>
                                        <td scope="row"><?=$rowFinansial['finansial_barang_volume']?></td>
                                        <td scope="row"><?=$rowFinansial['satuan_nama']?></td>
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
                                        <td scope="row">Rp. <?=number_format($totalBiayaPerubahan[$i],2,",",".")?></td>
                                        <?php } ?>
                                    </tr>
                                    <?php $no++; } ?>
                                    <tr>
                                        <td scope="row"></td>
                                        <td scope="row"></td>
                                        <th scope="row" colspan="4">TOTAL BIAYA OPERASIONAL</th>
                                        <?php for($i = 0; $i <= $waktu; $i++){ ?>
                                        <th scope="row">Rp. <?=number_format($totalBiayaTahun[$i],2,",",".")?></th>
                                        <?php } ?>
                                    </tr>
                                    <tr>
                                        <td colspan="<?=7+$waktu?>"></td>
                                    </tr>
                                    <tr>
                                        <td colspan="<?=7+$waktu?>"></td>
                                    </tr>
                                    <tr>
                                        <td>II</td>
                                        <td colspan="<?=6+$waktu?>">Penerimaan</td>
                                    </tr>
                                    <?php 
                                        $no = 0; 
                                        foreach($dataPenerimaan as $rowPenerimaan){ 
                                        $harga = $rowPenerimaan['finansial_penerimaan_harga'];
                                        $produk = $rowPenerimaan['finansial_penerimaan_produk'];
                                        // echo $harga;
                                    ?>
                                    <tr>
                                        <td scope="row"></td>
                                        <td scope="row"></td>
                                        <td scope="row"><?=$no+1?></td>
                                        <td scope="row">Produksi </td>
                                        <td scope="row"></td>
                                        <td scope="row">Kg</td>
                                        <?php for($i = 0; $i <= $waktu; $i++){ 
                                            $totalPenerimaanProduk[$i] = $produk;
                                            if($i==0){
                                                $totalPenerimaanProduk[$i] = 0;
                                            }
                                        ?>
                                        <td scope="row"><?=number_format($totalPenerimaanProduk[$i]*24*12,0,",",".")?></td>
                                        <?php } ?>
                                    </tr>
                                    <?php $no++; ?>
                                    <tr>
                                        <td scope="row"></td>
                                        <td scope="row"></td>
                                        <td scope="row"><?=$no+1?></td>
                                        <td scope="row">Harga </td>
                                        <td scope="row"></td>
                                        <td scope="row">Rp/Kg</td>
                                        <?php for($i = 0; $i <= $waktu; $i++){ 
                                            $totalPenerimaanHarga[$i] = $harga*@$getHarga;
                                            if($i==0){
                                                $totalPenerimaanHarga[$i] = 0;
                                            }
                                        ?>
                                        <td scope="row">Rp. <?=number_format($totalPenerimaanHarga[$i],2,",",".")?></td>
                                        <?php } ?>
                                    </tr>
                                    <?php $no++; ?>
                                    <tr>
                                        <td scope="row"></td>
                                        <td scope="row"></td>
                                        <td scope="row"><?=$no+1?></td>
                                        <td scope="row">Nilai Sisa Barang Investasi</td>
                                        <td scope="row"></td>
                                        <td scope="row"></td>
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
                                        <td scope="row">Rp. <?=number_format($totalSisa[$i],2,",",".")?></td>
                                        <?php } ?>
                                    </tr>
                                    <?php $no++; ?>
                                    <tr>
                                        <td scope="row"></td>
                                        <td scope="row"></td>
                                        <th scope="row" colspan="4">TOTAL PENERIMAAN</th>
                                        <?php for($i = 0; $i <= $waktu; $i++){ 
                                            $totalPenerimaan[$i] = ($totalPenerimaanHarga[$i]*$totalPenerimaanProduk[$i]*24*12) + $totalSisa[$i];
                                        ?>
                                        <th scope="row">Rp. <?=number_format($totalPenerimaan[$i],2,",",".")?></th>
                                        <?php } ?>
                                    </tr>
                                    <?php  } ?>
                                    <tr>
                                        <td colspan="<?=7+$waktu?>"></td>
                                    </tr>
                                    <tr>
                                        <td>III</td>
                                        <td colspan="4">Pajak Penghasilan</td>
                                        <td scope="row">Rp</td>
                                        <?php for($i = 0; $i <= $waktu; $i++){ 
                                            $totalPajak[$i] = $totalPenerimaan[$i]*$pajak;
                                        ?>
                                        <td scope="row">Rp. <?=number_format($totalPajak[$i],2,",",".")?></td>
                                        <?php } ?>
                                    </tr>
                                    <tr>
                                        <th>IV</th>
                                        <th colspan="4">Laba Bersih</th>
                                        <th scope="row">Rp</th>
                                        <?php for($i = 0; $i <= $waktu; $i++){ 
                                            $totalPenghasilan[$i] = $totalPenerimaan[$i]-$totalPajak[$i];
                                        ?>
                                        <th scope="row">Rp. <?=number_format($totalPenghasilan[$i],2,",",".")?></th>
                                        <?php } ?>
                                    </tr>
                                </tbody>
                            </table>
                                
                        <br>
                        <hr>
                        <!-- .Tampil Operasional -->
                    </div>
                    <!-- ./ Pembuatan Tabel Semua -->

                    <!-- Pencarian Prediksi -->
                    <div class="pd-20 bg-white border-radius-4 box-shadow mb-30" id="tableResult">
                        <div class="clearfix">
                            <div class="pull-left">
                                <h4 class="text-blue"><?=$name?></h4>
                                <p class="mb-30 font-14">Prediksi <?=$name?></p>
                            </div>
                            <div class="pull-right">
                                <a href="?tombol=tambah" class="btn btn-primary btn-sm scroll-click" ><i class="fa fa-plus-circle"></i> Tambah Data</a>
                            </div>
                        </div>
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
                        <!-- <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label">Biaya Operasional</label>
                        </div> -->
                            <table class="table table-bordered table-responsive">
                                <thead>
                                    <tr>
                                    <th scope="col">Tahun</th>
                                    <th scope="col">Benefit (Rp)</th>
                                    <th scope="col">Cost (Rp)</th>
                                    <th scope="col">Net benefit (Rp)</th>
                                    <th scope="col">Df.<?=$dfAwal*100?>%</th>
                                    <th>NPV (Rp)</th>
                                    <th scope="col">Df.<?=$persenDfPlus*100?>%</th>
                                    <th>NPV (Rp)</th>
                                    <th scope="col">Df.<?=$persenDfMines*100?>%</th>
                                    <th>NPV (Rp)</th>
                                    </tr>
                                </thead>
                                <tbody>
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
                                    <tr>
                                        <td><?=$tahun?></td>
                                        <td><?=$totalPenerimaan[$tahun]?></td>
                                        <td><?=$totalBiayaTahun[$tahun]+$totalAllTahun[$tahun]?></td>
                                        <td><?=$netBenefit[$tahun]?></td>
                                        <td><?=number_format($df10,4,",",".")?></td>
                                        <td><?=number_format($df10*$netBenefit[$tahun],2,",",".")?></td>
                                        <td><?=number_format($dfPlus,4,",",".")?></td>
                                        <td><?=number_format($dfPlus*$netBenefitPositive,2,",",".")?></td>
                                        <td><?=number_format($dfMines,4,",",".")?></td>
                                        <td><?=number_format($dfMines*$netBenefitPositive,2,",",".")?></td>
                                    </tr>
                                    <?php } ?>
                                    <tr>
                                        <th colspan="3">Jumlah</th>
                                        <th><?=number_format($totalNetBenefit,4,",",".")?></th>
                                        <th></th>
                                        <th><?=number_format($totalDfAwal,4,",",".")?></th>
                                        <th></th>
                                        <th><?=number_format($totalNpvPlus,4,",",".")?></th>
                                        <th></th>
                                        <th><?=number_format($totalNpvMines,4,",",".")?></th>
                                    </tr>
                                </tbody>
                            </table>
                            <?php 
                                $totalDfAwalMines = abs($totalDfAwalMines);
                                $nbcr = $totalDfAwalPlus/$totalDfAwalMines;
                                $pbp = ($totalBiayaTahun[0]+$totalAllTahun[0])/$pembagiPbp;
                                $bep = ($totalBiayaTahun[0]+$totalAllTahun[0])/($dataPenerimaan[0]['finansial_penerimaan_harga']-@$totalTahun/($dataPenerimaan[0]['finansial_penerimaan_produk']*12*24));
                            ?>
                            <table class="table table-bordered col-6">
                                <thead>
                                    <tr>
                                        <th>NPV</th>
                                        <th>NPV+</th>
                                        <th>NPV-</th>
                                        <th>NBCR = NPV+ / NPV-</th>
                                        <th>PBP</th>
                                        <th>BEP</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><?=number_format($totalDfAwal,2,",",".")?></td>
                                        <td><?=number_format($totalDfAwalPlus,2,",",".")?></td>
                                        <td><?=number_format($totalDfAwalMines,2,",",".")?></td>
                                        <td><?=number_format($nbcr,2,",",".")?></td>
                                        <td><?=number_format($pbp,2,",",".")?></td>
                                        <td><?=number_format($bep,2,",",".")?></td>
                                    </tr>
                                </tbody>
                            </table>
                            <?php
                            $dfPlus = 100*$persenDfPlus;
                            $dfMines = 100*$persenDfMines;
                            $irr = $dfPlus+(($totalNpvPlus/($totalNpvPlus+$totalNpvMines))*($dfMines-$dfPlus));
                            ?>
                            <table class="table table-bordered col-6">
                                <thead>
                                    <tr>
                                        <th>Df+</th>
                                        <th>NPV+</th>
                                        <th>Df-</th>
                                        <th>NPV-</th>
                                        <th>IRR</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><?=number_format($dfPlus,2,",",".")?></td>
                                        <td><?=number_format(($totalNpvPlus),2,",",".")?></td>
                                        <td><?=number_format($dfMines,2,",",".")?></td>
                                        <td><?=number_format(($totalNpvMines),2,",",".")?></td>
                                        <td><?=number_format($irr,2,",",".")?></td>
                                    </tr>
                                </tbody>
                            </table>
                        <br>
                        <hr>
                        <!-- .Tampil Operasional -->
                    </div>
                    <!-- Pencarian Prediksi -->
                    
                    <!-- Pencarian Penentuan -->
                    <div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
                        <div id="hasilAkhir">
                            <table class="table table-bordered col-6">
                                <thead>
                                    <tr>
                                        <th colspan="2">Hasil</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th>NPV</th>
                                        <td><?=number_format(@$totalDfAwal,2,",",".")?></td>
                                    </tr>
                                    <tr>
                                        <th>NBCR</th>
                                        <td><?=number_format($nbcr,2,",",".")?></td>
                                    </tr>
                                    <tr>
                                        <th>PBP</th>
                                        <td><?=number_format($pbp,2,",",".")?></td>
                                    </tr>
                                    <tr>
                                        <th>BEP</th>
                                        <td><?=number_format($bep,2,",",".")?></td>
                                    </tr>
                                    <tr>
                                        <th>IRR</th>
                                        <td><?=number_format($irr,2,",",".")?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- . Pencarian Penentuan -->

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
                    <div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
                        <div id="penentuanHarga">
                            <table class="table table-bordered col-6">
                                <thead>
                                    <tr>
                                        <th colspan="6">PENETAPAN HARGA</th>
                                    </tr>
                                    <tr>
                                        <th data-toggle="tooltip" data-placement="top" title="HARGA JUAL ATC">HJATC</th>
                                        <th data-toggle="tooltip" data-placement="top" title="JUMLAH PRODUKSI ATC">JPATC</th>
                                        <th data-toggle="tooltip" data-placement="top" title="MARGIN KEUNTUNGAN AGROINDUSTRI">MKA</th>
                                        <th data-toggle="tooltip" data-placement="top" title="BIAYA PEMBELIAN BAHAN BAKU">BPBB</th>
                                        <th data-toggle="tooltip" data-placement="top" title="JUMLAH BAHAN BAKU AGROINDUSTRI">JBBA</th>
                                        <th data-toggle="tooltip" data-placement="top" title="HARGA BELI RUMPUT LAUT DITINGKAT AGROINDUSTRI">HBRLA</th>
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
                                    <tr <?=$HJATC==$_GET['HJATC']?'style="background-color: #cccccc;"':''?> >
                                        <td><?=$HJATC?></td>
                                        <td><?=$JPATC?></td>
                                        <td><?=$MKA?></td>
                                        <td><?=$BPBB?></td>
                                        <td><?=$JBBA?></td>
                                        <td><?=number_format($HBRLA,2,",",".")?></td>
                                    </tr>
                                    <?php 
                                    $HJATC +=$selisih;
                                    $i++;

                                    } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- . Penentuan Harga -->
                </div>
                <!--./ show penjelasan -->
                <?php } ?>
                <?php } ?>
                
                

			