
                <?php
                
                $name = "Metode Pengembangan Agroindustri";
                
                ?>
                
                <div class="page-header">
					<div class="row">
						<div class="col-md-6 col-sm-12">
							<div class="title">
								<h4><?=$name?></h4>
							</div>
							<nav aria-label="breadcrumb" role="navigation">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="<?=$baseUrl?>">Home</a></li>
									<li class="breadcrumb-item active" aria-current="page"><?=$name?></li>
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
							<h4 class="text-blue"><?=$name?></h4>
							<p class="mb-30 font-14">Tambah <?=$name?></p>
						</div>
						<div class="pull-right">
							<a href="?" class="btn btn-primary btn-sm scroll-click" ><i class="fi-arrow-left"></i> Kembali</a>
						</div>
					</div>
                    <form action="<?=$baseUrl."prediksi/ahp/tambah"?>" method="POST">
                        <div class="form-group row">
							<label class="col-sm-12 col-md-2 col-form-label">Nama <?=$name?></label>
							<div class="col-sm-12 col-md-10">
								<input class="form-control" type="text" placeholder="Masukkan Nama AHP" name="nama">
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
                        <button class="btn btn-primary">Tambah Data</button>
                    </form>
				</div>
				<!-- Default Basic Forms End -->
                <?php }else{ ?>
                <!-- Default Basic Forms Start -->
				<div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
					<div class="clearfix">
						<div class="pull-left">
							<h4 class="text-blue"><?=$name?></h4>
							<p class="mb-30 font-14">Daftar <?=$name?></p>
						</div>
						<div class="pull-right">
							<a href="?tombol=tambah" class="btn btn-primary btn-sm scroll-click" ><i class="fa fa-plus-circle"></i> Tambah Data</a>
						</div>
					</div>
                    <table class="data-table stripe hover nowrap">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama <?=$name?></th>
                                <th scope="col">Kriteria</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $no = 0; 
                                foreach($data as $rowData){ 
                                
                                $kriteria = json_decode($rowData['kriteria'], true);
                            ?>
                            <tr>
                                <td scope="row"><?=$no+1?></td>
                                <td scope="row"><?=$rowData['nama_ahp']?></td>
                                <td scope="row">
                                <?php
                                    foreach($kriteria as $rowKriteria){
                                        echo "- ".$rowKriteria."<br>";
                                    }
                                ?>
                                </td>
                                <td scope="row">
                                    <a href="<?=$baseUrl."prediksi/ahp/".$rowData['id']?>" class="btn btn-success"><i class="fi-magnifying-glass"></i></a>
                                    <!-- <a href="" class="btn btn-primary"><i class="fi-pencil"></i></a> -->
                                    <a href="<?=$baseUrl."prediksi/ahp/hapus/".$rowData['id']?>" class="btn btn-danger"><i class="fa fa-trash"></i></a>
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
