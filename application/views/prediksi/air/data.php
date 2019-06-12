<?php

// echo "<pre>";
// print_r($dataPilih);
// echo "</pre>";

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
									<li class="breadcrumb-item active" aria-current="page">Kebutuhan Air</li>
								</ol>
							</nav>
						</div>
					</div>
				</div>
                <?php if(@$_GET['tombol']){ ?>
				
				<?php 
					
					if(@$_GET['tombol'] == 'edit'){
						$link = $baseUrl."prediksi/kebutuhan-air/edit";
					}else{
						$link = $baseUrl."prediksi/kebutuhan-air/tambah";
					}
					
				?>

                <!-- Default Basic Forms Start -->
                <div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
					<div class="clearfix">
						<div class="pull-left">
							<h4 class="text-blue">Kebutuhan Air</h4>
							<p class="mb-30 font-14">Tambah Kebutuhan Air</p>
						</div>
						<div class="pull-right">
							<a href="?" class="btn btn-primary btn-sm scroll-click" ><i class="fi-arrow-left"></i> Kembali</a>
						</div>
					</div>
                    <form action="<?=$link?>" method="POST">
						<input type="hidden" name="id" value="<?=@$dataPilih['kebutuhan_air_id']?>">
                        <div class="form-group row">
							<label class="col-sm-12 col-md-2 col-form-label">Nama</label>
							<div class="col-sm-12 col-md-10">
								<select class="custom-select col-12" name="finansial" id="finansial">
									<option >Pilih Finansial</option>
                                    <?php foreach($dataFinansial as $rowFinansial){ ?>
									<option value="<?=$rowFinansial['finansial_id']?>" <?=$rowFinansial['finansial_id']==@$dataPilih['finansial_id']?'selected':''?> ><?=$rowFinansial['finansial_nama']?></option>
                                    <?php } ?>
								</select>
							</div>
						</div>
                        <div class="form-group row">
							<label class="col-sm-12 col-md-2 col-form-label">Jumlah Proses Per Hari (JP)</label>
							<div class="col-sm-12 col-md-10">
								<input class="form-control" type="number" step placeholder="Masukkan Jumlah Proses Per Hari" name="jp" value="<?=@$dataPilih['kebutuhan_air_jp']?>"> 
							</div>
                        </div>
                        <div class="form-group row">
							<label class="col-sm-12 col-md-2 col-form-label">Jumlah Daur Ulang Air (JDU)</label>
							<div class="col-sm-12 col-md-10">
								<input class="form-control" type="number" step="3" placeholder="Masukkan Jumlah Daur Ulang Air" name="jdu" value="<?=@$dataPilih['kebutuhan_air_jdu']?>">
							</div>
                        </div>
                        <div class="form-group row">
							<label class="col-sm-12 col-md-2 col-form-label">Jumlah Hari Ulang (JHDU)</label>
							<div class="col-sm-12 col-md-10">
								<input class="form-control" type="number" step="3" placeholder="Masukkan Jumlah Hari Ulang" name="jhdu" value="<?=@$dataPilih['kebutuhan_air_jdhu']?>">
							</div>
						</div>
                        <button class="btn btn-primary">Tambah Data</button>
                    </form>
				</div>
				<!-- Default Basic Forms End -->
                <?php }else{ ?>
                <!-- Default Basic Forms Start -->
				<div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
					<div class="clearfix">
						<div class="pull-left">
							<h4 class="text-blue">Kebutuhan Air</h4>
							<p class="mb-30 font-14">Daftar Kebutuhan Air</p>
						</div>
						<div class="pull-right">
							<a href="?tombol=tambah" class="btn btn-primary btn-sm scroll-click" ><i class="fa fa-plus-circle"></i> Tambah Data</a>
						</div>
					</div>
                    <table class="data-table stripe hover nowrap">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama Finansial</th>
                                <th scope="col">Jumlah proses per hari (JP)</th>
                                <th scope="col">Jumlah daur ulang air (JDU)</th>
                                <th scope="col">Jumlah hari ulang (JHDU)</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $no = 0; 
                                foreach($dataAir as $rowData){ 
                                
                                // $kriteria = json_decode($rowData['kriteria'], true);
                            ?>
                            <tr>
                                <td scope="row"><?=$no+1?></td>
                                <td scope="row"><?=$rowData['finansial_nama']?></td>
								<td scope="row"><?=$rowData['kebutuhan_air_jp']?></td>
                                <td scope="row"><?=$rowData['kebutuhan_air_jdu']?></td>
								<td scope="row"><?=$rowData['kebutuhan_air_jdhu']?></td>
                                <td scope="row">
                                    <a href="<?=$baseUrl."prediksi/kebutuhan-air/".$rowData['kebutuhan_air_id']?>" class="btn btn-success"><i class="fi-magnifying-glass"></i></a>
                                    <a href="?tombol=edit&id=<?=$rowData['kebutuhan_air_id']?>" class="btn btn-primary"><i class="fi-pencil"></i></a> 
									<a href="<?=$baseUrl."prediksi/kebutuhan-air/hapus/".$rowData['kebutuhan_air_id']?>" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                            <?php $no++; } ?>
                        </tbody>
                    </table>
                    <br>
                    <hr>
                    <?php 
                    // $hasil =  $this->ahp->getAhp($dataJumlah, $kriteria, $name); 
                    ?>
				</div>
				<!-- Default Basic Forms End -->
                <?php } ?>
