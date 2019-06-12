
                <?php 
                $name = "Penetapan Bahan Baku";



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
									<li class="breadcrumb-item active" aria-current="page"><?=$name?></li>
								</ol>
							</nav>
						</div>
					</div>
				</div>
                <?php if(@$_GET['tombol']){ 
                        if(@$_GET['tombol'] == 'edit'){
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
					<form method="POST" action="<?=base_url()?>prediksi/bahan/penyedia/<?=$link?>">
                    <!-- <form method="POST" action=""> -->
                        <input type="hidden" name="bahan_penyedia_id" value="<?=@$dataPilih[0]['bahan_penyedia_id']?>" />
                        <div class="form-group row">
							<label class="col-sm-12 col-md-2 col-form-label">Nama</label>
							<div class="col-sm-12 col-md-10">
								<input class="form-control" type="text" placeholder="Masukkan Nama" value="<?=@$dataPilih[0]['bahan_penyedia_nama']?>" name="bahan_penyedia_nama">
							</div>
						</div>
                        <div class="form-group row">
							<label class="col-sm-12 col-md-2 col-form-label">Produksi</label>
							<div class="col-sm-12 col-md-10">
								<input class="form-control" type="number" placeholder="Masukkan Produksi Harian" name="bahan_penyedia_produksi" value="<?=@$dataPilih[0]['bahan_penyedia_produksi']?>">
							</div>
						</div>
                        <div class="form-group row">
							<label class="col-sm-12 col-md-2 col-form-label">Produksi Keinginan</label>
							<div class="col-sm-12 col-md-10">
								<input class="form-control" type="number" placeholder="Masukkan Produksi Keinginan Harian" name="bahan_penyedia_produksi_keinginan" value="<?=@$dataPilih[0]['bahan_penyedia_produksi_keinginan']?>">
							</div>
						</div>
                        <div class="form-group row">
							<label class="col-sm-12 col-md-2 col-form-label">Randemen</label>
							<div class="col-sm-12 col-md-10">
								<input class="form-control" type="number" placeholder="Masukkan Randemen" name="bahan_penyedia_randemen" value="<?=@$dataPilih[0]['bahan_penyedia_randemen']?>">
							</div>
						</div>
                        <div class="form-group row">
							<label class="col-sm-12 col-md-2 col-form-label">Konversi (kg basah /1 kg kering)</label>
							<div class="col-sm-12 col-md-10">
								<input class="form-control" type="number" placeholder="Masukkan Konversi (kg basah /1 kg kering)" name="bahan_penyedia_konversi" value="<?=@$dataPilih[0]['bahan_penyedia_konversi']?>">
							</div>
						</div>
                        <div class="form-group row">
							<label class="col-sm-12 col-md-2 col-form-label">Produktifitas (Kg/Ha)</label>
							<div class="col-sm-12 col-md-10">
								<input class="form-control" type="number" placeholder="Masukkan Produktifitas (Kg/Ha)" name="bahan_penyedia_produktifitas" value="<?=@$dataPilih[0]['bahan_penyedia_produktifitas']?>">
							</div>
						</div>
                        <div class="form-group row">
							<label class="col-sm-12 col-md-2 col-form-label">Panen Per Tahun</label>
							<div class="col-sm-12 col-md-10">
								<input class="form-control" type="number" placeholder="Masukkan Panen Per Tahun" name="bahan_penyedia_panen" value="<?=@$dataPilih[0]['bahan_penyedia_panen']?>">
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
							<h4 class="text-blue"><?=@$name?></h4>
							<p class="mb-30 font-14">Data <?=@$name?></p>
						</div>
                        <div class="pull-right">
                            <a href="?tombol=tambah" class="btn btn-primary btn-sm scroll-click" ><i class="fa fa-plus-circle"></i> Tambah Data</a>
						</div>
					</div>
                    <!-- Tampil bahan baku -->
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-12 col-form-label">kebutuhan bahan baru (rumput laut kering)</label>
                    </div>
                    <table class="data-table stripe hover nowrap">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama</th>
                                <?php  if($jenis == "kll"){ ?>
                                <th scope="col">Kebutuhan Bahan Baku (KBB)</th>
                                <th scope="col">Kebutuhan Luas Lahan (KLL)</th>
                                <?php }else if($jenis == "rop"){ ?>
                                <th scope="col">Jumlah Pembelian Bahan Baku yang Ekonomis (EOQ)</th>
                                <th scope="col">Titik Pemesanan Kembali (ROP)</th>
                                <?php }else{ ?>
                                <th scope="col">Kebutuhan Bahan Baku (KBB)</th>
                                <th scope="col">Kebutuhan Luas Lahan (KLL)</th>
                                <?php } ?>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                        
                            for($i = 0; $i < count($bahan); $i++){ 
                            
                                $produksi = $bahan[$i]['bahan_penyedia_produksi'];
                                $produksiKeinginan = $bahan[$i]['bahan_penyedia_produksi_keinginan'];
                                $randemen = $bahan[$i]['bahan_penyedia_randemen'];
                                $konversi = $bahan[$i]['bahan_penyedia_konversi']; //kg basah /1 kg kering
                                $produktifitas = $bahan[$i]['bahan_penyedia_produktifitas'];
                                $panenPerTahun = $bahan[$i]['bahan_penyedia_panen'];
                            
                            //(EOQ)
                            $D = 100*24*$produksiKeinginan/$randemen;
                            $S = $D*100;
                            $H = 100;

                            $KBB = number_format(100*24*12*@$produksiKeinginan/@$randemen,4,",",".");
                            $KLL = number_format((100*24*12*@$produksiKeinginan/@$randemen)/@$konversi/@$produktifitas/@$panenPerTahun,4,",",".");
            
                            $EOQ = sqrt(2*$D*$S/$H);
            
                            // ROP
                            $d = 100*$produksiKeinginan/$randemen;
                            $L = 15;
                            $SS = $D*3;
                            $ROP = ($d*$L)+$SS;
                        ?>
                        <tr>
                            <td><?=($i+1)?></td>
                            <td><?=$bahan[$i]['bahan_penyedia_nama']?></td>
                            <?php  if($jenis == "kll"){ ?>
                            <td><?=$KBB?></td>
                            <td><?=$KLL?></td>
                            <td>
                                <a href="<?=$baseUrl."bahan/penyedia/kll/".$bahan[$i]['bahan_penyedia_id']?>" class="btn btn-success"><i class="fi-magnifying-glass"></i></a>
                                
                                <a href="?tombol=edit&id=<?=$bahan[$i]['bahan_penyedia_id']?>" class="btn btn-primary"><i class="fi-pencil"></i></a>
                                <a href="<?=$baseUrl."prediksi/bahan/penyedia/hapus/".$bahan[$i]['bahan_penyedia_id']?>" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                            </td>
                            <?php }else if($jenis == "rop"){ ?>
                            <td><?=$EOQ?></td>
                            <td><?=$ROP?></td>
                            <td>
                                <a href="<?=$baseUrl."bahan/penyedia/rop/".$bahan[$i]['bahan_penyedia_id']?>" class="btn btn-success"><i class="fi-magnifying-glass"></i></a>
                                
                                <a href="?tombol=edit&id=<?=$bahan[$i]['bahan_penyedia_id']?>" class="btn btn-primary"><i class="fi-pencil"></i></a>
                                <a href="<?=$baseUrl."prediksi/bahan/penyedia/hapus/".$bahan[$i]['bahan_penyedia_id']?>" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                            </td>
                            <?php }else{ ?>
                            <td><?=$KBB?></td>
                            <td><?=$KLL?></td>
                            <td>
                                <a href="<?=$baseUrl."prediksi/bahan/penyedia/".$bahan[$i]['bahan_penyedia_id']?>" class="btn btn-success"><i class="fi-magnifying-glass"></i></a>
                                <a href="?tombol=edit&id=<?=$bahan[$i]['bahan_penyedia_id']?>" class="btn btn-primary"><i class="fi-pencil"></i></a>
                                <a href="<?=$baseUrl."prediksi/bahan/penyedia/hapus/".$bahan[$i]['bahan_penyedia_id']?>" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                            </td>
                            <?php } ?>
                        </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                    <br>
                    <hr>
                    <!-- .Tampil bahan baku -->

                    
				</div>
				<!-- ./ Data Inputan -->
                
                <?php } ?>
                
                

			