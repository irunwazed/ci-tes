
				<div class="page-header">
					<div class="row">
						<div class="col-md-6 col-sm-12">
							<!-- <div class="title">
								<h4>Form</h4>
							</div> -->
							<nav aria-label="breadcrumb" role="navigation">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="<?=$baseUrl?>">Home</a></li>
									<li class="breadcrumb-item active" aria-current="page"><?=@$status?'Penetapan Bahan Baku Finansial':'Kelayakan Finansial'?></li>
								</ol>
							</nav>
						</div>
					</div>
				</div>
                <?php if(@$_GET['tombol']){ ?>
				<?php
                    if($_GET['tombol'] == 'edit'){
						$link = "edit";
						
                    }else{
                        $link = "tambah";
					}    
					// print_r($dataPilih);
                ?>
                <!-- Default Basic Forms Start -->
                <div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
					<div class="clearfix">
						<div class="pull-left">
							<h4 class="text-blue"><?=@$status?'Penetapan Bahan Baku Finansial':'Kelayakan Finansial'?></h4>
							<p class="mb-30 font-14">Tambah <?=@$status?'Penetapan Bahan Baku Finansial':'Kelayakan Finansial'?></p>
						</div>
						<div class="pull-right">
							<a href="?" class="btn btn-primary btn-sm scroll-click" ><i class="fi-arrow-left"></i> Kembali</a>
						</div>
					</div>
                    <form action="<?=$baseUrl."prediksi/finansial/".$link?>" method="POST">
						<input type="hidden" name="id" value="<?=@$_GET['id']?>">
                        <div class="form-group row">
							<label class="col-sm-12 col-md-2 col-form-label">Nama</label>
							<div class="col-sm-12 col-md-10">
								<input class="form-control" type="text" placeholder="Masukkan Nama" name="nama" value="<?=@$dataPilih['finansial_nama']?>">
							</div>
						</div>
                        <div class="form-group row">
							<label class="col-sm-12 col-md-2 col-form-label">Umur Investasi (Tahun)</label>
							<div class="col-sm-12 col-md-10">
								<input class="form-control" type="number" placeholder="Masukkan Umur Investasi" name="lama" value="<?=@$dataPilih['finansial_waktu']?>">
							</div>
                        </div>
                        <div class="form-group row">
							<label class="col-sm-12 col-md-2 col-form-label">Produk Per Hari (Kg)</label>
							<div class="col-sm-12 col-md-10">
								<input class="form-control" type="number" placeholder="Masukkan Jumlah Produk Harian" name="produk" value="<?=@$dataPilih['finansial_penerimaan_produk']?>">
							</div>
                        </div>
                        <div class="form-group row">
							<label class="col-sm-12 col-md-2 col-form-label">Harga Produk</label>
							<div class="col-sm-12 col-md-10">
								<input class="form-control" type="number" placeholder="Masukkan Harga Produk" name="harga" value="<?=@$dataPilih['finansial_penerimaan_harga']?>">
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
							<h4 class="text-blue"><?=@$status?'Penetapan Bahan Baku Finansial':'Kelayakan Finansial'?></h4>
							<p class="mb-30 font-14">Daftar <?=@$status?'Penetapan Bahan Baku Finansial':'Kelayakan Finansial'?></p>
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
                                <th scope="col">Lama Pengerjaan</th>
                                <th scope="col">Produksi (Tahun)</th>
                                <th scope="col">Harga Produk</th>
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
                                <td scope="row"><?=$rowData['finansial_nama']?></td>
                                <td scope="row"><?=$rowData['finansial_waktu']?></td>
                                <td scope="row"><?=$rowData['finansial_penerimaan_produk']*12*24?></td>
                                <td scope="row"><?=$rowData['finansial_penerimaan_harga']*12*24?></td>
                                <td scope="row">
                                    <a href="<?=$baseUrl."prediksi/finansial/".(@$status?$status.'/':'').$rowData['finansial_id']?>" class="btn btn-success"><i class="fi-magnifying-glass"></i></a>
                                    <a href="?tombol=edit&id=<?=$rowData['finansial_id']?>" class="btn btn-primary"><i class="fi-pencil"></i></a>
									<a href="#" data-pesan='Apakah anda yakin menghapus data "<?=$rowData['finansial_nama']?>"?' data-link="<?=$baseUrl."prediksi/finansial/hapus/".$rowData['finansial_id']?>" class="btn btn-danger" data-toggle="modal" data-target="#Medium-modal" onclick="setDelete(this)" ><i class="fa fa-trash"></i></a>
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
