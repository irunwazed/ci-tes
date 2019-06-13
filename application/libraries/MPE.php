<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MPE {

    private static $CI;
    private $data, $kriteria, $wilayah, $respon, $kriteriaBobot, $name, $rank;

    private $style;
    
    public function __construct()
    {
        self::$CI = & get_instance();
    }

    public function getMpe($kirim, $save = false, $tampil = 2){
        extract($kirim);
        $this->data = $data;
        $this->kriteria = $kriteria;
        $this->wilayah = $wilayah;
        $this->respon = $respon;
        $this->bobot = $bobot;
        
        if($save){
            
            $this->style = ' style="border: 1px solid; padding: 10px; margin: 0px;"';
            $this->kriteriaNilai();
            if($tampil == 1){
                $this->bobot();
            }else if($tampil == 2){
                $this->rekapitulasiNoTampil();
            }else if($tampil == 3){
                $this->dataKriteriaNoTampil();
            }
            

        }else{

            $this->kriteriaNilai();
            $this->rekapitulasi();
            // $this->bobot();
            $this->dataKriteria();
        }
        // echo "<pre>";
        // print_r($data);
        // echo "</pre>";
    }

    public function kriteriaNilai(){
        $data = $this->data;
        $kriteria = $this->kriteria;
        $wilayah = $this->wilayah;
        $bobot = $this->bobot;
        for($j = 0; $j < count($wilayah); $j++){
            for($i = 0; $i < count($data[0]); $i++){
                if(@$kriteriaNilai[$j]){
                    $kriteriaNilai[$j] += pow($data[$j][$i],$bobot[$i]);
                }else{
                    $kriteriaNilai[$j] = pow($data[$j][$i],$bobot[$i]);
                }
            }
        }

        for($i = 0; $i < count($kriteriaNilai); $i++){
            $rank[$i]['no'] = $i;
            $rank[$i]['nilai'] = $kriteriaNilai[$i]; 
        }
        $rank = $this->bubble_sort($rank);

        $this->rank = $rank;

    }

    public function rankBobot($bobot){
        $dataBobot = array();
        for($i = 0; $i < count($bobot); $i++){
            $dataBobot[$i]['no'] = $i;
            $dataBobot[$i]['nilai'] = $bobot[$i];
        }
        $dataBobot = $this->bubble_sort($dataBobot);
        return $dataBobot;
    }

    public function bobot($bobot = null, $kriteria = null){
        if($kriteria == null && $bobot == null){
            $bobot = $this->bobot;
            $kriteria = $this->kriteria;
        }
        $dataBobot = $this->rankBobot($bobot);
        ?>
        <div class="form-group row">
            <label class="col-sm-12 col-form-label">Prioritas Kriteria</label>
        </div>
        <table  style="border-collapse: collapse; width:100%;">
            <thead>
                <tr>
                    <th scope="col" <?=$this->style?> >No</th>
                    <th scope="col" <?=$this->style?> >Kriteria</th>
                    <th scope="col" <?=$this->style?> >Bobot</th>
                    <th scope="col" <?=$this->style?> >Prioritas</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 0; foreach($kriteria as $rowKriteria){ 
                    foreach($dataBobot as $rowBobot){
                        if($rowBobot['no'] == $no){
                    ?>
                <tr>
                    <td scope="row" <?=$this->style?> ><?=$no+1?></td>
                    <td scope="row" <?=$this->style?> ><?=$rowKriteria?></td>
                    <td scope="row" <?=$this->style?> ><div><?=number_format($dataBobot[$no]['nilai'],4,",",".")?></div></td>
                    <td scope="row" <?=$this->style?> ><div><?=$dataBobot[$no]['no']+1?></div></td>
                </tr>
                <?php 
                        }
                    }
                $no++; } ?>
            </tbody>
        </table>
        <br>
        <hr>
    <?php
    }

    public function rekapitulasi(){
        $data = $this->data;
        $kriteria = $this->kriteria;
        $wilayah = $this->wilayah;
        $name = $this->name;
        $rank = $this->rank;
        ?>
        <div class="form-group row">
            <label class="col-sm-12 col-form-label">REKAPITULASI</label>
        </div>
        <div id="hasilRekap">
            
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col" rowspan="2">No</th>
                        <th scope="col" rowspan="2">Alternatif</th>
                        <th scope="col" colspan="<?=count($kriteria)?>">Kriteria</th>
                        <th scope="col" rowspan="2">Nilai</th>
                        <th scope="col" rowspan="2">Prioritas</th>
                    </tr>
                    <tr>
                    <?php $no = 1; foreach($kriteria as $rowKriteria){ ?>
                        <th scope="col" data-toggle="tooltip" data-placement="top" title="<?=$rowKriteria?>"><?=$no?></th>
                    <?php $no++; } ?>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 0; foreach($wilayah as $rowWilayah){ ?>
                    <tr>
                        <td scope="row"><?=$no+1?></td>
                        <td scope="row"><?=$rowWilayah?></td>
                        <?php for($i = 0; $i < count($data[0]); $i++){ ?>
                            <td scope="row"><div><?=number_format($data[$no][$i],4,",",".")?></div></td>
                        <?php } ?>
                        <td scope="row"><div><?=number_format($rank[$no]['nilai'],4,",",".")?></div></td>
                        <td scope="row"><div><?=@$rank[$no]['no']+1?></div></td>
                    </tr>
                    <?php $no++; } ?>
                </tbody>
            </table>
            <!-- hasil rekap -->
            <div class="set-hide">
                <div id="hasil-rekap">
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Prioritas Alternatif</label>
                    </div>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col" rowspan="2">No</th>
                                <th scope="col" rowspan="2">Alternatif</th>
                                <th scope="col" rowspan="2">Nilai</th>
                                <th scope="col" rowspan="2">Prioritas</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 0; foreach($wilayah as $rowWilayah){ ?>
                            <tr>
                                <td scope="row"><?=$no+1?></td>
                                <td scope="row"><?=$rowWilayah?></td>
                                <td scope="row"><div><?=number_format($rank[$no]['nilai'],4,",",".")?></div></td>
                                <td scope="row"><div><?=@$rank[$no]['no']+1?></div></td>
                            </tr>
                            <?php $no++; } ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- . hasil rekap -->
        </div>
        <div class="col-12">
            <div class="bg-white pd-20 box-shadow border-radius-5 height-100-p">
                <div id="rekap"></div>
            </div>
        </div>
        <script>
            var tesData = [{
                name: 'rekap',
                data: [
                    <?php 
                    foreach($rank as $row){
                        echo $row['nilai'].", ";
                    } 
                    ?>
                ]
            }];
            data.push(tesData);
        </script>
        <br>
        <hr>
        <?php
        
    }

    public function dataKriteria(){
        $data = $this->data;
        $kriteria = $this->kriteria;
        $wilayah = $this->wilayah;
        $name = $this->name;
        $bobot = $this->bobot;
        // $rank = $this->rank;

        for($no = 0; $no < count($kriteria); $no++){
            for($i = 0; $i < count($wilayah); $i++){
                $rankKriteria[$no][$i]['nilai'] =  pow($data[$i][$no],$bobot[$no]);
                $rankKriteria[$no][$i]['data'] = $data[$i][$no];
                $rankKriteria[$no][$i]['bobot'] = $bobot[$no];
                $rankKriteria[$no][$i]['no'] = $i;
            }
            $rankKriteria[$no] = $this->bubble_sort($rankKriteria[$no]);
        }
        
        for($no = 0; $no < count($kriteria); $no++){ ?>

            <div class="row">
            
                <div class="col-6 hasil-kriteria"  id="hasil-kriteria-<?=$no?>">
                <label class="col-sm-12 col-form-label"><?="Kriteria ".($no+1)." Ketersediaan ".$kriteria[$no]?></label>
                    <table class="table table-bordered ">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Alternatif</th>
                                <th scope="col">Nilai</th>
                                <th scope="col">Prioritas</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php for($i = 0; $i < count($wilayah); $i++){ ?>
                            <tr>
                                <td scope="row"><?=($i+1)?></td>
                                <td scope="row"><?=$wilayah[$i]?></td>
                                <td scope="row"><div><?=number_format(@$rankKriteria[$no][$i]['nilai'],4,",",".")?></div></td>
                                <td scope="row"><div><?=@$rankKriteria[$no][$i]['no']+1?></div></td>
                            </tr>
                            <?php  } ?>
                        </tbody>
                    </table>
                </div>
                <div class="col-6"  id="hasil-kriteria-grafik-<?=$no?>">
                    <div class="bg-white pd-20 box-shadow border-radius-5 height-100-p">
                        <div class="hasil-chart" id="chart<?=$no?>"></div>
                    </div>
                </div>
                <br>
                <hr>
            </div>
            
            
            <script>
                var tesData = [{
                    name: '<?=$kriteria[$no]?>',
                    data: [
                        <?php foreach($rankKriteria[$no] as $row){
                            echo $row['nilai'].", ";
                        } ?>
                    ]
                }];
                data.push(tesData);
            </script>
        <?php
        }
        ?>
        <script src="<?=base_url()?>public/template/src/plugins/highcharts-6.0.7/code/highcharts.js"></script>
        <!-- <script src="https://code.highcharts.com/highcharts-3d.js"></script> -->
        <!-- <script src="<?=base_url()?>public/template/src/js/highcharts-3d.js"></script> -->
        <script src="<?=base_url()?>public/template/src/plugins/highcharts-6.0.7/code/highcharts-more.js"></script>
        <script>
                    var cate = <?=json_encode($wilayah)?>;
                    console.log(data);
                    <?php for($no = 0; $no < count($kriteria); $no++){
                        if($no == 0){
                            
                            echo "chart('tampilGrafikHasilRekap', cate, data[".$no."], data[".$no."][0]['name'], 'Chart');";
                            echo "chart('rekap', cate, data[".$no."], data[".$no."][0]['name'], 'Chart');";
                            echo "chart('chart".($no)."', cate, data[".($no+1)."], data[".($no+1)."][0]['name'], 'Chart');";
                            echo "chart('hasil-chart".($no)."', cate, data[".($no+1)."], data[".($no+1)."][0]['name'], 'Chart');";
                        }else{
                            echo "chart('chart".($no)."', cate, data[".($no+1)."], data[".($no+1)."][0]['name'], 'Chart');";
                            echo "chart('hasil-chart".($no)."', cate, data[".($no+1)."], data[".($no+1)."][0]['name'], 'Chart');";
                        }
                        

                    } ?>
                    
                    function chart(id = 'chart4', inputCategories = [], data = {}, judul = '', ket){
                        // chart 4
                        // alert(id);
                        // console.log(data);
                        Highcharts.chart(id, {
                            chart: {
                                type: 'column'
                            },
                            title: {
                                text: judul
                            },
                            subtitle: {
                                text: ket
                            },
                            xAxis: {
                                categories: inputCategories,
                                crosshair: true
                            },
                            yAxis: {
                                min: 0,
                                title: {
                                    text: 'Nilai'
                                }
                            },
                            tooltip: {
                                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                                pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                                '<td style="padding:0"><b>{point.y:.4f} </b></td></tr>',
                                footerFormat: '</table>',
                                shared: true,
                                useHTML: true
                            },
                            plotOptions: {
                                column: {
                                    pointPadding: 0.2,
                                    borderWidth: 0
                                }
                            },
                            series: data
                        });
                    }

                </script>
        <?php
    }

    function bubble_sort($arr) {
        $size = count($arr)-1;
        for ($i=0; $i<$size; $i++) {
            for ($j=0; $j<$size-$i; $j++) {
                $k = $j+1;
                if ($arr[$k]['nilai'] > $arr[$j]['nilai']) {
                    list($arr[$j], $arr[$k]) = array($arr[$k], $arr[$j]);
                }
            }
        }

        for($i = 0; $i < count($arr); $i++){
            for($j = 0; $j < count($arr); $j++){
                if($arr[$j]['no'] == $i){
                    $ranking[$i]['no'] = $j;
                    $ranking[$i]['nilai'] = $arr[$j]['nilai'];
                }
            }
            
        }

        return $ranking;
    }

    public function print_r($arr){
        echo "<pre>";
        print_r($arr);
        echo "</pre>";
    }

// sdfsdf """"
    public function rekapitulasiNoTampil(){
        $data = $this->data;
        $kriteria = $this->kriteria;
        $wilayah = $this->wilayah;
        $name = $this->name;
        $rank = $this->rank;
        ?>
        <div class="form-group row">
            <label>Prioritas Alternatif</label>
        </div>
        <div id="hasilRekap">
            <div class="set-hide">
                <div id="hasil-rekap">
                    <table  style="border-collapse: collapse; width:100%;">
                        <thead>
                            <tr>
                                <th scope="col" <?=$this->style?> >No</th>
                                <th scope="col" <?=$this->style?> >Alternatif</th>
                                <th scope="col" <?=$this->style?> >Nilai</th>
                                <th scope="col" <?=$this->style?> >Prioritas</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 0; foreach($wilayah as $rowWilayah){ ?>
                            <tr>
                                <td scope="row" <?=$this->style?> ><?=$no+1?></td>
                                <td scope="row" <?=$this->style?> ><?=$rowWilayah?></td>
                                <td scope="row" <?=$this->style?> ><div><?=number_format($rank[$no]['nilai'],4,",",".")?></div></td>
                                <td scope="row" <?=$this->style?> ><div><?=@$rank[$no]['no']+1?></div></td>
                            </tr>
                            <?php $no++; } ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- . hasil rekap -->
        </div>
        <br>
        <hr>
        <?php
        
    }

    public function dataKriteriaNoTampil(){
        $data = $this->data;
        $kriteria = $this->kriteria;
        $wilayah = $this->wilayah;
        $name = $this->name;
        $bobot = $this->bobot;
        // $rank = $this->rank;

        for($no = 0; $no < count($kriteria); $no++){
            for($i = 0; $i < count($wilayah); $i++){
                $rankKriteria[$no][$i]['nilai'] =  pow($data[$i][$no],$bobot[$no]);
                $rankKriteria[$no][$i]['data'] = $data[$i][$no];
                $rankKriteria[$no][$i]['bobot'] = $bobot[$no];
                $rankKriteria[$no][$i]['no'] = $i;
            }
            $rankKriteria[$no] = $this->bubble_sort($rankKriteria[$no]);
        }
        
        for($no = 0; $no < count($kriteria); $no++){ ?>
            <div class="row">
                <div class="col-6 hasil-kriteria" id="hasil-kriteria-<?=$no?>">
                    <table  style="border-collapse: collapse; width:100%;">
                        <thead>
                            <tr>
                                <th scope="col" <?=$this->style?> >No</th>
                                <th scope="col" <?=$this->style?> >Alternatif</th>
                                <th scope="col" <?=$this->style?> >Nilai</th>
                                <th scope="col" <?=$this->style?> >Prioritas</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php for($i = 0; $i < count($wilayah); $i++){ ?>
                            <tr>
                                <td scope="row" <?=$this->style?> ><?=($i+1)?></td>
                                <td scope="row" <?=$this->style?> ><?=$wilayah[$i]?></td>
                                <td scope="row" <?=$this->style?> ><div><?=number_format(@$rankKriteria[$no][$i]['nilai'],4,",",".")?></div></td>
                                <td scope="row" <?=$this->style?> ><div><?=@$rankKriteria[$no][$i]['no']+1?></div></td>
                            </tr>
                            <?php  } ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <br><br>
        <?php
        }
        ?>
        <?php
    }

}