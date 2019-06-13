
                <?php 
                $name = '';
                $kriteria = array();
                $jumlahRespon = count($dataAhpRespon);
                // echo $jumlahRespon;
                if(@$dataAhp[0]){
                    $kriteria = json_decode($dataAhp[0]['kriteria'], true);
                    $name = @$dataAhp[0]['nama_ahp'];
                }

                function cekNilai($nilai1, $nilai2){
                    if($nilai1 == $nilai2) return true;
                }

                function perbandingan($i, $A = "A", $B = "B"){
                    if($i == 1){
                        $pesan = $A." sama penting dengan ".$B;
                    }else if($i == 3){
                        $pesan = $A." sedikit lebih penting ".$B;
                    }else if($i == 5){
                        $pesan = $A." jelas lebih penting dari ".$B;
                    }else if($i == 7){
                        $pesan = $A." sangat jelas lebih penting dari ".$B;
                    }else if($i == 9){
                        $pesan = $A." Mutlat lebih penting dari ".$B;
                    }else{
                        $pesan = "Ragu-ragu antara ".($i-1)." dan ".($i+1);
                    }
                    $pesan = '<span style="font-size:8px"> '.$pesan.' </span>';
                    return $pesan;
                }
                
                $kriteriaJumlah = array();
                $dataJumlah = array();
                ?>
				<div class="page-header">
					<div class="row">
						<div class="col-md-6 col-sm-12">
							<div class="title">
								<h4>Form</h4>
							</div>
							<nav aria-label="breadcrumb" role="navigation">
								<ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?=$baseUrl?>">Home</a></li>
                                <li class="breadcrumb-item"><a href="<?=$baseUrl."prediksi/ahp"?>">AHP</a></li>
									<li class="breadcrumb-item active" aria-current="page"><?=$name?></li>
								</ol>
							</nav>
						</div>
					</div>
				</div>
                <?php if(@$_GET['tombol']){ 
                for($j=9;$j>=1;$j--){
                    $arrPilih[$j-1] = 1/$j;
                } 
                
                if($_GET['tombol'] == 'edit'){
                    $link = 'editrespon';
                    $dataOneResponNama = $dataOneRespon[0]['nama'];
                    $dataOneRespon = json_decode($dataOneRespon[0]['respon'], true);
                }else{
                    $link = 'insertrespon';
                }    
                ?>
				<!-- Default Basic Forms Start -->
				<div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
					<div class="clearfix">
						<div class="pull-left">
							<h4 class="text-blue">AHP Forms</h4>
							<p class="mb-30 font-14">Masukkan Perbandingan pada Setiap Kriteria</p>
						</div>
                        <div class="pull-right">
							<a href="?" class="btn btn-primary btn-sm scroll-click" ><i class="fi-arrow-left"></i> Kembali</a>
						</div>
					</div>
					<form method="POST" action="<?=$baseUrl?>prediksi/ahp/<?=$link?>">

                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Masukkan Nama</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control" type="text" name="nama" placeholder="Masukkan Nama" value="<?=@$dataOneResponNama?>" required autofocus />
                            <input type="hidden" name="id" value="<?=@$ahp_id?>" />
                            <input type="hidden" name="idRespon" value="<?=@$_GET['id']?>" />
                        </div>
                    </div>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col"><?=$name?></th>
                            <?php foreach($kriteria as $row){ ?>
                                <th scope="col"><?=$row?></th>
                            <?php } ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 0; foreach($kriteria as $row){ ?>
                            <tr>
                                <th scope="row"><?=$row?></th>
                            <?php 
                            
                            for($i = 0; $i < count($kriteria); $i++){ 
                                if($no > $i){
                            ?>
                                <td scope="row">
                                    <input class="form-control" name="kriteria[<?=$no?>][]" id="insert-<?=$no.'-'.$i?>" value="<?=@$dataOneRespon[$no][$i]?>" type="hidden" >
                                    <div class="form-control" id="view-<?=$no.'-'.$i?>" ><?=@number_format($dataOneRespon[$no][$i],4,",",".")?></div>
                                </td>
                            <?php
                            }else if($no == $i){
                                ?>
                                <td scope="row">
                                    <input name="kriteria[<?=$no?>][]" value="1" type="hidden">
                                    <div class="form-control">1</div>
                                </td>
                            <?php
                            }else{
                                $NoValue = 0;
                            ?>
                                <td scope="row">
                                
                                    <select class="custom-select col-12" name="kriteria[<?=$no?>][]" value="<?=@$dataOneRespon[$no][$i]?>"  id="insert-<?=$no.'-'.$i?>" onchange="changeInsert(this)"  required autofocus>
                                        <option selected value="">Pilih Nilai</option>
                                        <?php for($j=9;$j>=1;$j--){ ?>
                                        <option <?php echo @$arrPilih[$j-1]==@$dataOneRespon[$no][$i]?'selected':''; ?> data-no="<?=$j?>" value="<?=1/$j?>"><?='1/'.$j?> - <?=perbandingan($j, $kriteria[$i], $row)?></option>
                                        <?php $NoValue++; } ?>
                                        <?php for($j=1;$j<=9;$j++){ ?>
                                        <option <?php echo $j==@$dataOneRespon[$no][$i]?  'selected':  ''; ?> data-no="<?='1/'.$j?>" value="<?=$j?>"><?=$j?> - <?=perbandingan($j, $row, $kriteria[$i])?></option>
                                        <?php $NoValue++; } ?>
                                    </select>
                                </td>
                            <?php }
                            } ?>
                            </tr>
                            <?php $no++; } ?>
                        </tbody>
                    </table>
                        <button class="btn btn-primary">Submit Responden</button>
					</form>
				</div>
				<!-- Default Basic Forms End -->
                <?php }else{ ?>
                
                <div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
                    <div class="clearfix">
						<div class="pull-left">
							<h4 class="text-blue"><?=$name?></h4>
							<!-- <p class="mb-30 font-14">Hasil responden</p> -->
						</div>
                        <div class="pull-right">
                            <!-- <a href="?tombol=tambah" class="btn btn-primary btn-sm scroll-click" ><i class="fa fa-plus-circle"></i> Tambah Data</a> -->
						</div>
					</div>
                    <a href="<?=base_url()."prediksi/ahp/".@$id."/save"?>" class="btn btn-warning">PDF</a>
                    <div class="col-12 row" style="padding:10px">
                        <div class="col-5"></div>
                        <div class="bg-success col-2 text-white" style="text-align: center;" id="hasil"></div>
                        <div class="col-5"></div>
                    </div>
                    <div id="tampilHasilAll"></div>
                    <br>
                    <hr>
                    <div class="clearfix">
                        <div class="pull-right">
                            <a href="?tombol=tambah" class="btn btn-primary btn-sm scroll-click" ><i class="fa fa-plus-circle"></i> Tambah Responen</a>
                            <?php if($jumlahRespon > 0){ ?>
                            <a href="#" class="btn btn-info btn-sm scroll-click" data-table="penjelasan" onclick="viewTable(this)"><i class="fa fi-arrow-down"></i> Lihat Penjelasan</a>
                            <?php } ?>
                        </div>
                    </div>
                </div>

                <div id="penjelasan" class="set-hide">
                    <!-- Default Basic Forms Start -->
                    <div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
                        <div class="clearfix">
                            <div class="pull-left">
                                <h4 class="text-blue">Responden</h4>
                                <p class="mb-30 font-14">Daftar responden</p>
                            </div>
                            <div class="pull-right">
                                <a href="?tombol=tambah" class="btn btn-primary btn-sm scroll-click" ><i class="fa fa-plus-circle"></i> Tambah Responen</a>
                            </div>
                        </div>
                        
                        <?php $index = 0; foreach($dataAhpRespon as $row){ 
                            $rowRespon = json_decode($row['respon'], true);
                            if($index == 0){
                                $dataJumlah = $rowRespon;
                            }
                        ?>
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label">Responden <?=$index+1?></label>
                            <div class="col-sm-10 col-md-8">
                                <div class="form-control" ><?=$row['nama']?></div>
                            </div>
                            <div class="col-sm-2 col-md-2">
                                <a href="<?=$baseUrl."prediksi/ahp/".$ahp_id."?tombol=edit&id=".$row['id']?>" class="btn btn-primary"><i class="fi-pencil"></i></a>
                                <a href="#" data-pesan='Apakah anda yakin menghapus respon "<?=$row['nama']?>"?' data-link="<?=$baseUrl."prediksi/ahp/".$ahp_id."/hapus/".$row['id']?>" class="btn btn-danger" data-toggle="modal" data-target="#Medium-modal" onclick="setDelete(this)" ><i class="fa fa-trash"></i></a>
                            </div>
                        </div>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col"><?=$name?></th>
                                <?php foreach($kriteria as $rowKriteria){ ?>
                                    <th scope="col"><?=$rowKriteria?></th>
                                <?php } ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 0; foreach($kriteria as $rowKriteria){ ?>
                                <tr>
                                    <th scope="row"><?=$rowKriteria?></th>
                                    <?php for($i = 0; $i < count($rowRespon); $i++){ 
                                        if($index != 0){
                                            $dataJumlah[$no][$i] += $rowRespon[$no][$i];
                                        }
                                        if($index +1 == count($dataAhpRespon)){
                                            $dataJumlah[$no][$i] = $dataJumlah[$no][$i]/count($dataAhpRespon);
                                        }
                                        ?>
                                        <td scope="row"><div><?=number_format($rowRespon[$no][$i],4,",",".")?></div></td>
                                    <?php } ?>
                                </tr>
                                <?php $no++; } ?>
                            </tbody>
                        </table>
                        <br>
                        <hr>
                        <?php $index++; } ?>
                        <?php 
                        $hasil = 0;
                            if(@$dataAhpRespon[0]){
                                $hasil =  $this->ahp->getAhp($dataJumlah, $kriteria, $name); 
                            }
                        ?>
                    </div>
                    <!-- Default Basic Forms End -->
                </div>
                <?php } ?>
                
                <script>
                    var globalHasil = '<?=number_format($hasil,4,",",".")?>';
                </script>

			