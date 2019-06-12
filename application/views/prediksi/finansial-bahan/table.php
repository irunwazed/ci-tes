
				
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
                    <form action="<?=$baseUrl."prediksi/finansial/bahan/".$link?>" method="POST">
						<input type="hidden" name="id" value="<?=@$dataPilih[0]['finansial_bahan_id']?>">
                        <div class="form-group row">
							<label class="col-sm-12 col-md-2 col-form-label">Nama Bahan</label>
							<div class="col-sm-12 col-md-10">
								<input class="form-control" type="text" placeholder="Masukkan Nama Bahan" name="nama"  value="<?=@$dataPilih[0]['finansial_bahan_nama']?>">
							</div>
						</div>
                        <div class="form-group row">
							<label class="col-sm-12 col-md-2 col-form-label">Harga Bahan</label>
							<div class="col-sm-12 col-md-10">
								<input class="form-control" type="number" step="any" placeholder="Masukkan Harga Bahan" name="harga"  value="<?=@$dataPilih[0]['finansial_bahan_harga']?>">
							</div>
						</div>
                        <div class="form-group row">
							<label class="col-sm-12 col-md-2 col-form-label">Kategori Bahan</label>
							<div class="col-sm-12 col-md-10">
								<select class="custom-select col-12" name="kategori">
									<option >Pilih Kategori</option>
                                    <?php foreach($dataKategori as $rowKategori){ ?>
									<option <?=$rowKategori['finansial_kategori_id']==@$dataPilih[0]['finansial_kategori_id']?'selected':''?> value="<?=$rowKategori['finansial_kategori_id']?>"><?=$rowKategori['finansial_kategori_nama']?></option>
                                    <?php } ?>
								</select>
							</div>
						</div>
                        <div class="form-group row">
							<label class="col-sm-12 col-md-2 col-form-label">Umur Bahan</label>
							<div class="col-sm-12 col-md-10">
								<input class="form-control" type="number" placeholder="Masukkan Umur Bahan" name="umur"  value="<?=@$dataPilih[0]['finansial_bahan_umur']?>">
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
								<th scope="col">Kategori</th>
                                <th scope="col">Nama Bahan</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Umur</th>
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
                                <td scope="row"><?=$rowData['finansial_kategori_nama']?></td>
								<td scope="row"><?=$rowData['finansial_bahan_nama']?></td>
                                <td scope="row"><?=$rowData['finansial_bahan_harga']?></td>
                                <td scope="row"><?=$rowData['finansial_bahan_umur']?></td>
                                <td scope="row">
                                    <a href="?tombol=edit&id=<?=$rowData['finansial_bahan_id']?>" class="btn btn-primary"><i class="fi-pencil"></i></a>
                                    <a href="<?=$baseUrl."prediksi/finansial/bahan/hapus/".$rowData['finansial_bahan_id']?>" class="btn btn-danger"><i class="fa fa-trash"></i></a>
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
