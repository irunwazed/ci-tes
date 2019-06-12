
                <?php 
                $name = @$dataFinansial[0]['finansial_nama'];
                $waktu = @$dataFinansial[0]['finansial_waktu']+0;

                // echo "<pre>";
                // echo "<div class='row'>";
                // echo "<div class='col-5'>";
                // print_r(@$dataRespon);
                // echo "</div>";
                // echo "<div class='col-5'>";
                // print_r(@$dataKriteriaRespon);
                // echo "</div>";
                // echo "</pre>";

                $grade = array(
                    "", "SR", "R", "S", "T", "ST"
                );

                function grade($nilai){
                    $grade = array(
                        "", "SR", "R", "S", "T", "ST"
                    );
                    
                    if($nilai >= 4.3){
                        $nilai = 5;
                    }else if($nilai >= 3.5){
                        $nilai = 4;
                    }else if($nilai >= 2.7){
                        $nilai = 3;
                    }else if($nilai >= 1.9){
                        $nilai = 2;
                    }else if($nilai >= 1){
                        $nilai = 1;
                    }else{
                        $nilai = 0;
                    }

                    return $grade[$nilai];
                }
                
                $index = 0;
                $nilaiAll = array();
                
                // $jumlahEkonomi = count($dataEkonomi);
                // for($no = 0; $no < $jumlahEkonomi; $no++){
                //     extract($dataEkonomi[$no]);
                //     $jumlahKriteria[$no] = count($dataKriteria);
                //     $jumlahRespon[$no] = count($dataRespon);
                //     $jumlahKriteriaRespon[$no] = count($dataKriteriaRespon);
                //     for($i = 0; $i < $jumlahKriteria[$no]; $i++){
                //         for($j = 0; $j < $jumlahRespon[$no]; $j++){
                //             $nilaiAll[$no][$i][$j] = @$dataKriteriaRespon[$index]['ekonomi_kriteria_respon_nilai']?$dataKriteriaRespon[$index]['ekonomi_kriteria_respon_nilai']:0;
                //             $index++;
                //         }
                //         if($jumlahRespon[$no] > 0){
                //             $nilaiRata[$no][$i] = array_sum($nilaiAll[$no][$i])/count($nilaiAll[$no][$i]);
                //         }
                //     }
                // }             
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
									<li class="breadcrumb-item active" aria-current="page">Penetapan Bahan Baku</li>
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
                <!-- Data Inputan -->
				<div class="pd-20 bg-white border-radius-4 box-shadow mb-30" id="tableInput">
					<div class="clearfix">
						<div class="pull-left">
							<h4 class="text-blue">PENETAPAN HARGA BAHAN BAKU</h4>
							<p class="mb-30 font-14">SKENARIO PENETAPAN HARGA BAHAN BAKU RUMPUT LAUT DI TINGKAT AGROINDUSTRI </p>
						</div>
                        <div class="pull-right">
                            <a href="?tombol=tambah" class="btn btn-primary btn-sm scroll-click" ><i class="fa fa-plus-circle"></i> Tambah Data</a>
						</div>
					</div>
                    <!-- Tampil Biaya -->
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Biaya Investasi</label>
                    </div>
                    <table class="table table-bordered table-responsive">
                        <thead>
                            <tr>
                                <th scope="col" rowspan="2">No</th>
                                <th scope="col" rowspan="2">Aspek</th>
                                <th scope="col" rowspan="2">Kriteria</th>
                                <th scope="col" colspan="<?=max($jumlahRespon)?>">Penilaian Responden (ST, T, S, R dan SR)</th>
                                <th scope="col" rowspan="2" colspan="2">BOBOT</th>
                            </tr>
                            <tr>
                                <?php for($i = 1; $i<=max($jumlahRespon); $i++){ ?>
                                    <th scope="col"><?=$i?></th>
                                <?php } ?>
                            </tr>
                        </thead>
                        <tbody>
                            
                            <?php for($no = 0; $no < $jumlahEkonomi; $no++){ extract($dataEkonomi[$no]); ?>
                            <tr>
                                <td rowspan="<?=$jumlahKriteria[$no]+1?>"><?=($no+1)?></td>
                                <td rowspan="<?=$jumlahKriteria[$no]+1?>"><?=$dataKriteriaRespon[$no]['ekonomi_aspek']?></td>
                            </tr>
                            <?php for($i = 0; $i < $jumlahKriteria[$no]; $i++){ ?>
                            <tr>
                                <td scope="col"><?=$dataKriteria[$i]['ekonomi_kriteria_nama']?></td>
                                <?php for($j = 0; $j < $jumlahRespon[$no]; $j++){ ?>
                                <td scope="col" ><?=$grade[$nilaiAll[$no][$i][$j]]?></td>
                                <?php } ?>
                                <?php for($j = 0; $j < max($jumlahRespon)-$jumlahRespon[$no]; $j++){ ?>
                                <td scope="col" >-</td>
                                <?php } ?>
                                <?php if($jumlahRespon[$no] > 0){ ?>
                                <td scope="col"><?=grade(@$nilaiRata[$no][$i])?></td>
                                    <?php if($i == 0){ ?>
                                    <td scope="col" rowspan="7"><?=grade(array_sum($nilaiRata[$no])/count($nilaiRata[$no]))?></td>
                                    <?php } ?>
                                <?php } ?>
                                <td>
                                    <a href="<?=$baseUrl."prediksi/finansial/".$dataKriteriaRespon[$no]['ekonomi_id']?>" class="btn btn-success"><i class="fi-magnifying-glass"></i></a>
                                    <a href="<?=$baseUrl."prediksi/finansial/hapus/".$dataKriteriaRespon[$no]['ekonomi_id']?>" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                            <?php } ?>
                            <?php } ?>
                        </tbody>
                    </table>
                    <br>
                    <hr>
                    <!-- .Tampil Biaya -->
				</div>
				<!-- ./ Data Inputan -->
                
                <?php } ?>
                
                

			