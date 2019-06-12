
				<div class="page-header">
					<div class="row">
						<div class="col-md-6 col-sm-12">
							<div class="title">
								<h4>Form</h4>
							</div>
							<nav aria-label="breadcrumb" role="navigation">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="<?=$baseUrl?>">Home</a></li>
									<li class="breadcrumb-item active" aria-current="page"><?=$namaMenu?></li>
								</ol>
							</nav>
						</div>
					</div>
				</div>
                <?php if(@$_GET['tombol']){ ?>
                <!-- Default Basic Forms Start -->
                <div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
					<div class="clearfix">
						<div class="pull-left">
							<h4 class="text-blue"><?=$namaMenu?></h4>
							<p class="mb-30 font-14">Tambah <?=$namaMenu?></p>
						</div>
						<div class="pull-right">
							<a href="?" class="btn btn-primary btn-sm scroll-click" ><i class="fi-arrow-left"></i> Kembali</a>
						</div>
					</div>
                    <form action="<?=$baseUrl."prediksi/mpe/tambah"?>" method="POST">
                        <input type="hidden" value="<?=@$menu?>" name="menu">
                        <input type="hidden" name="menu" value="<?=$menu?>">
                        <div class="form-group row">
							<label class="col-sm-12 col-md-2 col-form-label">Nama MPE</label>
							<div class="col-sm-12 col-md-10">
								<input class="form-control" type="text" placeholder="Masukkan Nama MPE" name="nama">
							</div>
						</div>
                        <div class="form-group row">
							<label class="col-sm-12 col-md-2 col-form-label">Kriteria</label>
							<div class="col-sm-12 col-md-10" id="daftar-kriteria">
                                <div class="kriteria-1 row">
                                    <div class="col-10">
                                        <input class="form-control" type="text" placeholder="Masukkan Kriteria" name="kriteria[]">
                                    </div>
                                    <div class="col-2">
                                        <a href="javascript:void(0);" onclick="deleteKriteria(1)"><i class="fa fa-trash"></i></a>
                                    </div>
                                </div>
							</div>
                            <div class="col-sm-2 col-md-2 col-2">
                                <a href="javascript:void(0);" onclick="addKriteria()"><i class="fa fa-plus-square"> Tambah Kriteria</i></a>
                            </div>
                        </div>
                        <div class="form-group row">
							<label class="col-sm-12 col-md-2 col-form-label">Alternatif</label>
							<div class="col-sm-12 col-md-10" id="daftar-wilayah">
                                <div class="wilayah-1 row">
                                    <div class="col-10">
                                        <input class="form-control" type="text" placeholder="Masukkan Alternatif" name="wilayah[]">
                                    </div>
                                    <div class="col-2">
                                        <a href="javascript:void(0);" onclick="deleteWilayah(1)"><i class="fa fa-trash"></i></a>
                                    </div>
                                </div>
							</div>
                            <div class="col-sm-2 col-md-2 col-2">
                                <a href="javascript:void(0);" onclick="addWilayah()"><i class="fa fa-plus-square"> Tambah Alternatif</i></a>
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
							<h4 class="text-blue"><?=$namaMenu?></h4>
							<p class="mb-30 font-14">Daftar <?=$namaMenu?></p>
						</div>
						<div class="pull-right">
							<a href="?tombol=tambah" class="btn btn-primary btn-sm scroll-click" ><i class="fa fa-plus-circle"></i> Tambah Data</a>
						</div>
					</div>
                    <table class="data-table stripe hover nowrap">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama <?=$namaMenu?></th>
                                <th scope="col">Kriteria</th>
                                <th scope="col">Alternatif</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $no = 0; 
                                foreach($data as $rowData){ 
                                
                                // $kriteria = json_decode($rowData['kriteria'], true);
                            ?>
                            <tr>
                                <td scope="row"><?=$no+1?></td>
                                <td scope="row"><?=$rowData['nama']?></td>
                                <td scope="row">
                                <?php
                                    foreach($rowData['dataKriteria'] as $rowKriteria){
                                        echo "- ".$rowKriteria['kriteria']."<br>";
                                    }
                                ?>
                                </td>
                                <td scope="row">
                                <?php
                                    foreach($rowData['dataWilayah'] as $rowWilayah){
                                        echo "- ".$rowWilayah['wilayah']."<br>";
                                    }
                                ?>
                                </td>
                                <td scope="row">
                                    <a href="<?=$baseUrl."prediksi/mpe/".$rowData['mpe_id']?>" class="btn btn-success"><i class="fi-magnifying-glass"></i></a>
                                    <!-- <a href="" class="btn btn-primary"><i class="fi-pencil"></i></a> -->
                                    <a href="<?=$baseUrl."prediksi/mpe/hapus/".$rowData['mpe_id']?>?menu=<?=$menu?>" class="btn btn-danger"><i class="fa fa-trash"></i></a>
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
