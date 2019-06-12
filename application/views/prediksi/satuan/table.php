
				
				<div class="page-header">
					<div class="row">
						<div class="col-md-6 col-sm-12">
							<!-- <div class="title">
								<h4>Form</h4>
							</div> -->
							<nav aria-label="breadcrumb" role="navigation">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="<?=$baseUrl?>">Home</a></li>
									<li class="breadcrumb-item active" aria-current="page">Bahan Finansial</li>
								</ol>
							</nav>
						</div>
					</div>
				</div>
				<?php if(@$_GET['tombol']){ 
					
					
					// print_r(@$dataPilih); 
					if(@$dataPilih){
						$link = 'edit';
						$namaStatus = 'Edit';
					}else{
						$link = 'tambah';
						$namaStatus = 'Tambah';
					}
				?>
                <!-- Default Basic Forms Start -->
                <div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
					<div class="clearfix">
						<div class="pull-left">
							<h4 class="text-blue">Bahan Finansial</h4>
							<p class="mb-30 font-14"><?=$namaStatus?> Bahan Finansial</p>
						</div>
						<div class="pull-right">
							<a href="?" class="btn btn-primary btn-sm scroll-click" ><i class="fi-arrow-left"></i> Kembali</a>
						</div>
					</div>
                    <form action="<?=$baseUrl."prediksi/pendukung/satuan/".$link?>" method="POST">
						<input type="hidden" name="id" value="<?=@$_GET['id']?>">
                        <div class="form-group row">
							<label class="col-sm-12 col-md-2 col-form-label">Satuan</label>
							<div class="col-sm-12 col-md-10">
								<input class="form-control" type="text" placeholder="Masukkan Nama Satuan" name="satuan"  value="<?=@$dataPilih[0]['satuan_nama']?>">
							</div>
						</div>
                        <button class="btn btn-primary"><?=$namaStatus?> Data</button>
                    </form>
				</div>
				<!-- Default Basic Forms End -->
                <?php }else{ ?>
                <!-- Default Basic Forms Start -->
				<div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
					<div class="clearfix">
						<div class="pull-left">
							<h4 class="text-blue">Bahan Finansial</h4>
							<p class="mb-30 font-14">Daftar Bahan Finansial</p>
						</div>
						<div class="pull-right">
							<a href="?tombol=tambah" class="btn btn-primary btn-sm scroll-click" ><i class="fa fa-plus-circle"></i> Tambah Data</a>
						</div>
					</div>
					<!-- class="table table-bordered" -->
                    <table class="data-table stripe hover nowrap" >
                        <thead>
                            <tr>
								<th scope="col">No</th>
								<th scope="col">Id</th>
								<th scope="col">Satuan</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $no = 0; 
                                foreach($data as $rowData){ 
                            ?>
                            <tr>
                                <td scope="row"><?=$no+1?></td>
								<td scope="row"><?=$rowData['satuan_id']?></td>
								<td scope="row"><?=$rowData['satuan_nama']?></td>
                                <td scope="row">
                                    <a href="?tombol=edit&id=<?=$rowData['satuan_id']?>" class="btn btn-primary"><i class="fi-pencil"></i></a>
                                    <a href="<?=$baseUrl."prediksi/pendukung/satuan/hapus/".$rowData['satuan_id']?>" class="btn btn-danger"><i class="fa fa-trash"></i></a>
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
