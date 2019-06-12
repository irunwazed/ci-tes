
                <?php 
                $name = @$dataMpe[0]['nama'];
                $menu = @$dataMpe[0]['menu'];
                $kriteria = array();
                $kriteriaBobot = array();
                
                $wilayah = array();
                $wilayahKriteria = array();
                $respon = array();
                
                for($i = 0; $i< count($dataKriteria); $i++){
                    $kriteria[$i] = $dataKriteria[$i]['kriteria'];
                    $kriteriaId[$i] = $dataKriteria[$i]['mpe_kriteria_id'];
                }

                for($i = 0; $i< count($dataRespon); $i++){
                    $respon[$i] = $dataRespon[$i]['respon_nama'];
                    $responId[$i] = $dataRespon[$i]['mpe_respon_id'];
                }

                for($i = 0; $i< count($dataWilayah); $i++){
                    $wilayah[$i] = $dataWilayah[$i]['wilayah'];
                    $wilayahId[$i] = $dataWilayah[$i]['mpe_wilayah_id'];
                }

                $jumlahKriteria = count($dataKriteria);
                $jumlahRespon = count($dataRespon);
                $jumlahWilayah = count($dataWilayah);
                // print_r($dataRespon);
                //deklarasi
                // $kriteriaRespon = array(0,0,0);

                // hitung bobot
                if($jumlahRespon > 0 && count($dataWilayahKriteria) == ($jumlahRespon*$jumlahWilayah*$jumlahKriteria)){
                    $no = 0;
                    for($i = 0; $i < $jumlahKriteria; $i++){
                        for($j = 0; $j < $jumlahRespon; $j++){
                            $kriteriaRespon[$i][$j] =  @$dataKriteriaRespon[$no]['mpe_respon_kriteria_nilai']; //rand(1, $jumlahKriteria);
                            $no++;
                        }
                        $kriteriaBobot[$i] = ($jumlahRespon*$jumlahKriteria)-array_sum($kriteriaRespon[$i]);
                    }
                    $jumlahKriteriaBobot = array_sum($kriteriaBobot);
    
                    for($i = 0; $i < $jumlahKriteria; $i++){
                        if($jumlahKriteriaBobot == 0 && $kriteriaBobot[$i] == 0){
                            $kriteriaBobot[$i] = 0;
                        }else{
                            $kriteriaBobot[$i] = $kriteriaBobot[$i]/$jumlahKriteriaBobot;
                        }
                        
                    }
    
                    // mengisi data semua responden
                    $index = 0;
                    for($no = 0; $no < $jumlahRespon; $no++){
                        for($i = 0; $i < $jumlahWilayah; $i++){
                            for($j = 0; $j < $jumlahKriteria; $j++){
                                $wilayahKriteria[$no]['respon_nama'] = $respon[$no];
                                $wilayahKriteria[$no]['respon_id'] = $dataWilayahKriteria[$index]['mpe_respon_id'];
                                $wilayahKriteria[$no]['wilayah_kriteria_json'][$i][$j] = $dataWilayahKriteria[$index]['mpe_wilayah_kriteria_nilai'];
                                $index++;
                            }
                        }
                    }
                }
                
                // echo "<pre>";
                // echo "<div class='row'>";
                // echo "<div class='col-5'>";
                // print_r(@$dataWilayahKriteria);
                // echo "</div>";
                // echo "<div class='col-5'>";
                // print_r(@$wilayahKriteria);
                // echo "</div>";
                // echo "</pre>";
                
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
                                <li class="breadcrumb-item"><a href="<?=$baseUrl."mpe/".$menu?>">MPE</a></li>
									<li class="breadcrumb-item active" aria-current="page"><?=$name?></li>
								</ol>
							</nav>
						</div>
					</div>
				</div>
                <?php if(@$_GET['tombol']){ 
                    // print_r(@$dataOneKriteriaRespon);

                    if($_GET['tombol'] == 'edit'){
                        $link = 'editrespon';
                        // print_r($dataOneKriteriaRespon);
                        // $dataOneKriteriaRespon = $dataOneRespon[0]['nama'];
                        // $dataOneRespon = json_decode($dataOneRespon[0]['respon'], true);
                    }else{
                        $link = 'insertrespon';
                    }   
                    
                ?>
                <!-- Default Basic Forms Start -->
				<div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
					<div class="clearfix">
						<div class="pull-left">
							<h4 class="text-blue"><?=$namaMenu?> Forms</h4>
							<p class="mb-30 font-14">Masukkan Nilai Kriteria pada Setiap Alternatif</p>
						</div>
                        <div class="pull-right">
							<a href="?" class="btn btn-primary btn-sm scroll-click" ><i class="fi-arrow-left"></i> Kembali</a>
						</div>
					</div>
					<form method="POST" action="<?=$baseUrl?>prediksi/mpe/<?=$link?>">
                    <!-- <form method="POST" action=""> -->
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Masukkan Nama</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control" type="text" name="nama" placeholder="Masukkan Nama" value="" required autofocus />
                            <input type="hidden" name="id" value="<?=@$id?>" />
                            <input type="hidden" name="idRespon" value="<?=@$_GET['id']?>" />
                        </div>
                    </div>
                    <div class="col-7 row">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Kriteria</th>
                                    <th scope="col">Nilai</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 0; foreach($dataKriteria as $row){ ?>
                                <tr>
                                    <th scope="row"><?=$no+1?></th>
                                    <th scope="row"><?=$row['kriteria']?></th>
                                    <th scope="row">
                                        <input type="hidden" value="<?=$row['mpe_kriteria_id']?>" name="mpe_kriteria_id[]">
                                        <select class="custom-select col-12" name="kriteriaRespon[<?=$no?>]" value="<?=@$dataOneKriteriaRespon[$no]['mpe_respon_kriteria_nilai']?>" onchange="changeInsert(this)"  data-toggle="tooltip" data-placement="top" title="Nilai 1 merupakan nilai terbaik dan nilai <?=$jumlahKriteria?> merupakan nilai terburuk" required autofocus>
                                            <option selected value="" >Pilih Nilai</option>
                                            <?php for($j=1;$j<=$jumlahKriteria;$j++){ ?>
                                            <option <?=@$dataOneKriteriaRespon[$no]['mpe_respon_kriteria_nilai']==$j?'selected':''?> value="<?=$j?>"><?=$j?></option>
                                            <?php  } ?>
                                        </select>
                                    </th>
                                </tr>
                                <?php $no++; } ?>
                            </tbody>
                        </table>
                    </div>
                    
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col" rowspan="2">No</th>
                                <th scope="col" rowspan="2">Alternatif</th>
                                <th scope="col" colspan="<?=$jumlahKriteria?>">Kriteria</th>
                            </tr>
                            <tr>
                                <?php $no = 1; foreach($kriteria as $row){ ?>
                                    <th scope="col" data-toggle="tooltip" data-placement="top" title="<?=$row?>"><?=$no?></th>
                                <?php $no++; } ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 0; $index = 0; foreach($dataWilayah as $row){ ?>
                            <tr>
                                <th scope="row"><?=$no+1?></th>
                                <th scope="row"><?=$row['wilayah']?><input type="hidden" name="mpe_wilayah_id[]" value="<?=$row['mpe_wilayah_id']?>"></th>
                            <?php 
                            
                            for($i = 0; $i < count($kriteria); $i++){ ?>
                                <td scope="row">
                                    <select class="custom-select col-12" name="wilayahKriteria[<?=$no?>][]" value="<?=@$dataOneRespon[$no][$i]?>"  data-toggle="tooltip" data-placement="top" title="Nilai 5 merupakan nilai terbaik dan nilai 1 merupakan nilai terburuk"  required autofocus>
                                        <option selected value="">Pilih Nilai</option>
                                        <?php for($j=1;$j<=5;$j++){ ?>
                                        <option <?php echo $j==@$dataOneWilayahKriteria[$index]['mpe_wilayah_kriteria_nilai']?  'selected':  ''; ?>  value="<?=$j?>"><?=$j?></option>
                                        <?php  } $index++; ?>
                                    </select>
                                </td>
                            <?php 
                            } ?>
                            </tr>
                            <?php $no++; } ?>
                        </tbody>
                    </table>
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
							<p class="mb-30 font-14">Hasil Metode MPE pada <?=$name?></p>
						</div>
                        <div class="pull-right">
                            <a href="<?=$baseUrl."prediksi/mpe"?>" class="btn btn-primary btn-sm scroll-click" ><i class="fa fi-arrow-left"></i> Kembali</a>
						</div>
					</div>
                    <form action="<?=base_url()?>prediksi/mpe/<?=@$id?>/save">
                        <div class="form-group row">
                            <label class="col-sm-4 col-md-2 col-form-label">Output</label>
                            <div class="col-sm-4 col-md-2">
                                <select class="custom-select col-12" name="tampil" onchange="changeOutput(this)">
                                    <option value="1">Pilih Tampilan</option>
                                    <option value="1" <?=@$_GET['tampil']==1?'selected':''?> >Prioritas Kriteria</option>
                                    <option value="2" <?=@$_GET['tampil']==2?'selected':''?> >Prioritas Alternatif</option>
                                    <option value="3" <?=@$_GET['tampil']==3?'selected':''?> >Alternatif pada setiap kriteria</option>
                                    <option value="4" <?=@$_GET['tampil']==4?'selected':''?> >Grafik</option>
                                </select>
                            </div>
                            <div class="col-sm-4 col-md-2">
                                <input type="submit" class="btn btn-warning" id="tombol-pdf" value="PDF">
                            </div>
                        </div>
                    </form>
                    
                    <div id="tampilHasilRekap"></div>
                    <div id="tampilGrafikHasilRekap"></div>
                    <div id="tampilGrafikKriteria">
                        <?php for($i = 0; $i < $jumlahKriteria; $i++){ ?>
                        <div id="hasil-chart<?=$i?>"></div>
                        <?php } ?>
                    </div>
                    <div class="clearfix">
                        <div class="pull-right">
                        <a href="#" class="btn btn-info btn-sm scroll-click" data-table="penjelasan" onclick="viewTable(this)"><i class="fa fi-arrow-down"></i> Lihat Penjelasan</a>
						</div>
					</div>
                </div>

                <div id="penjelasan" class="set-hide">
                    <!-- Default Basic Forms Start -->
                    <div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
                        <div class="clearfix">
                            <div class="pull-left">
                                <h4 class="text-blue"><?=$name?></h4>
                                <p class="mb-30 font-14">Perhitungan Metode MPE pada <?=$name?></p>
                            </div>
                            <div class="pull-right">
                                <a href="?tombol=tambah" class="btn btn-primary btn-sm scroll-click" ><i class="fa fa-plus-circle"></i> Tambah Responden</a>
                            </div>
                        </div>
                        <!-- <div class="col-12 row" style="padding:10px">
                            <div class="col-5"></div>
                            <div class="bg-success col-2 text-white" style="text-align: center;" id="hasil"></div>
                            <div class="col-5"></div>
                        </div> -->
                        <?php if($jumlahRespon > 0){ ?>
                        <!-- Tampil BOBOT -->
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label">Pembutan Bobot</label>
                        </div>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col" rowspan="2">No</th>
                                    <th scope="col" rowspan="2">Kriteria</th>
                                    <th scope="col" colspan="<?=$jumlahRespon?>">Respon</th>
                                    <th scope="col" rowspan="2">Jumlah</th>
                                    <th scope="col" rowspan="2">Bobot</th>
                                </tr>
                                <tr>
                                    <?php for($i =1; $i <= $jumlahRespon; $i++){ ?>
                                        <th scope="col" data-toggle="tooltip" data-placement="top" title="<?=$respon[$i-1]?>"><?=$i?></th>
                                    <?php } ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 0; foreach($kriteria as $rowKriteria){ ?>
                                <tr>
                                    <th scope="row"><?=$no+1?></th>
                                    <th scope="row"><?=$rowKriteria?></th>
                                    <?php for($i = 0; $i < $jumlahRespon; $i++){ 
                                        ?>
                                        <td scope="row"><div><?=$kriteriaRespon[$no][$i]?></div></td>
                                    <?php } ?>
                                    <td scope="row"><?=array_sum($kriteriaRespon[$no])?></td>
                                    <td scope="row"><?=number_format($kriteriaBobot[$no],4,",",".")?></td>
                                </tr>
                                <?php $no++; } ?>
                            </tbody>
                        </table>
                        <br>
                        <hr>
                        <!-- hasil bobot -->
                        <div class="set-hide">
                            <div id="hasil-bobot">
                                <div class="form-group row">
                                    <label class="col-sm-12 col-md-2 col-form-label">Kriteria</label>
                                </div>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th scope="col" rowspan="2">No</th>
                                            <th scope="col" rowspan="2">Kriteria</th>
                                            <th scope="col" rowspan="2">Bobot</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 0; foreach($kriteria as $rowKriteria){ ?>
                                        <tr>
                                            <th scope="row"><?=$no+1?></th>
                                            <th scope="row"><?=$rowKriteria?></th>
                                            <td scope="row"><?=number_format($kriteriaBobot[$no],4,",",".")?></td>
                                        </tr>
                                        <?php $no++; } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- . hasil bobot -->
                        <!-- .Tampil Bobot -->
                        

                        <!-- Tampil All Respon -->
                        <?php $index = 0; foreach($wilayahKriteria as $row){ 
                            // $rowRespon = json_decode($row['wilayah_kriteria_json'], true);
                            $rowRespon = $row['wilayah_kriteria_json'];
                            if($index == 0){
                                $dataJumlah = $rowRespon;
                            }
                        ?>
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label">Responden <?=$index+1?></label>
                            <div class="col-sm-10 col-md-8">
                                <div class="form-control" ><?=$row['respon_nama']?></div>
                            </div>
                            <div class="col-sm-2 col-md-2">
                                <a href="<?=$baseUrl."prediksi/mpe/".$id."?tombol=edit&id=".$row['respon_id']?>" class="btn btn-primary"><i class="fi-pencil"></i></a>
                                <a href="<?=$baseUrl."prediksi/mpe/".$id."/hapus/".$row['respon_id']?>" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                            </div>
                        </div>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col" rowspan="2">No</th>
                                    <th scope="col" rowspan="2">Alternatif</th>
                                    <th scope="col" colspan="<?=$jumlahKriteria?>">Kriteria</th>
                                    <th scope="col" rowspan="2">Jumlah</th>
                                </tr>
                                <tr>
                                    <?php $i = 1; foreach($kriteria as $row){ ?>
                                        <th scope="col" data-toggle="tooltip" data-placement="top" title="<?=$row?>"><?=$i?></th>
                                    <?php $i++; } ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 0; foreach($wilayah as $rowWilayah){ ?>
                                <tr>
                                    <th scope="row"><?=$no+1?></th>
                                    <th scope="row"><?=$rowWilayah?></th>
                                    <?php for($i = 0; $i < $jumlahKriteria; $i++){ 
                                        
                                        if($index != 0){
                                            $dataJumlah[$no][$i] += $rowRespon[$no][$i];
                                        }
                                        if($index +1 == $jumlahRespon){
                                            $dataJumlah[$no][$i] = $dataJumlah[$no][$i]/$jumlahRespon;
                                            
                                        }
                                        ?>
                                        <td scope="row"><div><?=$rowRespon[$no][$i]?></div></td>
                                    <?php } ?>
                                    <td scope="row"><?=array_sum($rowRespon[$no])?></td>
                                </tr>
                                <?php $no++; } ?>
                            </tbody>
                        </table>
                        <br>
                        <hr>
                        <?php $index++; } ?>
                        <!-- . Tampil All Respon -->
                        <?php } ?>
                        <script>
                        
                            var data= [];
                        </script>
                        <?php 
                        $hasil = 0;
                            if(@$wilayahKriteria[0]){
                                $kirim = array(
                                    'data' => $dataJumlah,
                                    'kriteria' => $kriteria,
                                    'respon' => $respon,
                                    'wilayah' => $wilayah,
                                    'bobot' => $kriteriaBobot,
                                );
                                $hasil =  $this->mpe->getMpe($kirim); 
                            }
                        ?>
                    </div>
                    <!-- Default Basic Forms End -->
                </div>
                
                <?php } ?>
                
                <script>
                   
                </script>

			