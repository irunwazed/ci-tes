<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AHP {

    private static $CI;
    private $kriteria, $name, $dataAhp, $kriteriaJumlah, $normalisasi, $bobot, $arrHasil, $lamdaMax, $cIndex, $index, $hasil, $ri;

    public function __construct()
    {
        self::$CI = & get_instance();
    }

    public function getAhp($dataAhp, $kriteria, $name){
        $this->dataAhp = $dataAhp;
        $this->kriteria = $kriteria;
        $this->name = $name;

        $this->rekapitulasi();
        echo "<h2>OPERASI</h2>";
        $this->jumlahSetiapElemen();
        $this->membagiSetiapElemen();
        $this->normalisasi();
        $this->prioritas();
        $this->ci();
        $this->hasilAll();
        
        return $this->hasil;

    }

    public function rekapitulasi(){
        $dataAhp = $this->dataAhp;
        $kriteria = $this->kriteria;
        $name = $this->name;
        
        ?>
        <div class="form-group row">
            <label class="col-sm-12 col-form-label">REKAPITULASI</label>
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
                    <?php for($i = 0; $i < count($dataAhp); $i++){ 
                        if(@$kriteriaJumlah[$i]){
                            $kriteriaJumlah[$i] += $dataAhp[$no][$i];
                        }else{
                            $kriteriaJumlah[$i] = $dataAhp[$no][$i];
                        }
                        
                        ?>
                        <td scope="row"><div><?=number_format($dataAhp[$no][$i],4,",",".")?></div></td>
                    <?php } ?>
                </tr>
                <?php $no++; } ?>
            </tbody>
        </table>
        <br>
        <hr>
    <?php
    
        $this->kriteriaJumlah = @$kriteriaJumlah; 
    }

    public function jumlahSetiapElemen(){
        $kriteriaJumlah = $this->kriteriaJumlah;
        $kriteria = $this->kriteria;
        ?>
        <div class="form-group row">
            <label class="col-sm-12 col-form-label">1. Menjumlahkan Setiap Element</label>
        </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                <?php foreach($kriteria as $rowKriteria){ ?>
                    <th scope="col"><?=$rowKriteria?></th>
                <?php } ?>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <?php for($i = 0; $i < count($kriteriaJumlah); $i++){ 
                        ?>
                        <td scope="row"><div><?=number_format($kriteriaJumlah[$i],4,",",".")?></div></td>
                    <?php } ?>
                </tr>
            </tbody>
        </table>
        <br>
        <hr>
        <?php
    }

    public function membagiSetiapElemen(){
        $kriteriaJumlah = $this->kriteriaJumlah;
        $dataAhp = $this->dataAhp;
        $kriteria = $this->kriteria;
        $name = $this->name;
        ?>
        <div class="form-group row">
            <label class="col-sm-12 col-form-label">2. Membagi Setiap Element</label>
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
                    <?php for($i = 0; $i < count($dataAhp); $i++){ 
                        $dataAhp[$no][$i] = $dataAhp[$no][$i] / $kriteriaJumlah[$i];
                        ?>
                        <td scope="row"><div><?=number_format($dataAhp[$no][$i],4,",",".")?></div></td>
                    <?php } ?>
                </tr>
                <?php $no++; } ?>
            </tbody>
        </table>
        <br>
        <hr>
        <?php
        $this->dataAhp = @$dataAhp;
    }

    public function normalisasi(){
        $kriteriaJumlah = $this->kriteriaJumlah;
        $dataAhp = $this->dataAhp;
        $kriteria = $this->kriteria;
        $name = $this->name;
        ?>
        <div class="form-group row">
            <label class="col-sm-12 col-form-label">3. NORMALISASI</label>
        </div>
        <div class="row ">
            <table class="table table-bordered  col-md-5">
                <tbody>
                    <?php $no = 0; $lamdaMax = 0; foreach($kriteria as $rowKriteria){ 
                        $normalisasi[$no] = array_sum($dataAhp[$no]);
                        $arrHasil[$no] = array(
                            'no' => $no,
                            'kriteria' => $rowKriteria,
                            'nilai' =>$normalisasi[$no]
                        );
                        $lamdaMax += $normalisasi[$no]*$kriteriaJumlah[$no];
                        ?>
                    <tr>
                        <th scope="row"><?=$rowKriteria?></th>
                        <td scope="row"><div><?=number_format($normalisasi[$no],4,",",".")?></div></td>
                    </tr>
                    <?php $no++; } ?>
                </tbody>
            </table>
            <div class="col-md-2"></div>
            <table class="table table-bordered  col-md-5">
                <tbody>
                    <tr>
                        <th scope="row">Jumlah Kriteria</th>
                        <td scope="row"><div><?=count($kriteria)?></div></td>
                    </tr>
                </tbody>
            </table>
        </div>
        
        <br>
        <hr>
        <?php
        $n = count($kriteria);
        $this->normalisasi = @$normalisasi;
        $this->lamdaMax = @$lamdaMax;
        $this->cIndex = (@$lamdaMax-$n)/$n-1;

        $this->ri = array(
            0,0,0,0.58,0.9,1.12,1.24,1.32,1.41,1.45,1.51,1.52,1.54,1.56,1.58,1.59
        );

        // $this->hasil = $this->cIndex/$this->ri[rand(3,15)];
        $this->arrHasil = $this->bubble_sort(@$arrHasil);
        
    }

    public function prioritas(){
        $kriteriaJumlah = $this->kriteriaJumlah;
        $dataAhp = $this->dataAhp;
        $kriteria = $this->kriteria;
        $normalisasi = $this->normalisasi;
        $arrHasil = $this->arrHasil;
        ?>
        <div class="form-group row">
            <label class="col-sm-12 col-form-label">4. PRIORITAS</label>
        </div>
        <div class="row ">
            <table class="table table-bordered  col-md-5">
                <thead>
                    <tr>
                        <th scope="col">KRITERIA</th>
                        <th scope="col">BOBOT</th>
                        <th scope="col">PRESENTASI</th>
                        <th scope="col">PRIORITAS</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 0; $jumBobot = 0; $jumPersentasi = 0; foreach($arrHasil as $row){ 
                        $bobot[$no] = $row['nilai']/count($kriteria);
                        $jumBobot += $bobot[$no];
                        ?>
                    <tr>
                        <th scope="row"><?=$row['kriteria']?></th>
                        <td scope="row"><div><?=number_format($bobot[$no],4,",",".")?></div></td>
                        <td scope="row"><div><?=number_format($bobot[$no]*100,4,",",".")?></div></td>
                        <td scope="row"><div><?=$no+1?></div></td>
                    </tr>
                    <?php $no++; } ?>
                    <tr>
                        <th scope="row">Jumlah</th>
                        <td scope="row"><div><?=number_format($jumBobot,4,",",".")?></div></td>
                        <td scope="row"><div><?=number_format($jumBobot*100,4,",",".")?></div></td>
                        <td scope="row"></td>
                    </tr>
                </tbody>
            </table>
        </div>
        
        <br>
        <hr>
        <?php


        // $this->rank = $rank;
    }

    public function ci(){
        // $n = count($this->$kriteria);
        // $this->normalisasi;
        // $this->lamdaMax = @$lamdaMax;
        // $this->cIndex = (@$lamdaMax-$n)/$n-1;
        ?>
        <div class="form-group row">
            <label class="col-sm-12 col-form-label">5. Consistency Ratio</label>
        </div>
        <div class="row ">
            <table class="table table-bordered  col-md-6">
                <thead>
                    <th>Index</th>
                    <th>Random Index (RI)</th>
                    <th>Consistency Index (CI)</th>
                    <th>CR = CI/RI</th>
                </thead>
                <tbody>
                    <?php for($i = 3; $i < count($this->ri); $i++){ ?>
                    <tr>
                        <td scope="row"><?=$i?></td>
                        <td scope="row"><?=$this->ri[$i]?></td>
                        <td scope="row"><?=number_format($this->cIndex,4,",",".")?></td>
                        <td scope="row"><?=number_format($this->cIndex/$this->ri[$i],4,",",".")?></td>
                    </tr>
                    <?php } 
                    $index = rand(3,15);
                    $this->index = $index;
                    $this->hasil = $this->cIndex/$this->ri[$index];
                    ?>
                </tbody>
            </table>
            <div class="col-1"></div>
            <table class="table table-bordered  col-md-5">
                <thead>
                    <tr>
                        <th colspan="2">Hasil</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">Lamda Maximum</th>
                        <td scope="row"><div><?=number_format($this->lamdaMax,4,",",".")?></div></td>
                    </tr>
                    <tr>
                        <th scope="row">Consistency Index</th>
                        <td scope="row"><div><?=number_format($this->cIndex,4,",",".")?></div></td>
                    </tr>
                    <tr>
                        <th scope="row">Random Index</th>
                        <td scope="row"><div><?=$index." => ".$this->ri[$index]?></div></td>
                    </tr>
                    <tr>
                        <th scope="row">Consistency Ratio</th>
                        <td scope="row"><div><?=number_format($this->hasil,4,",",".")?></div></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <br>
        <hr>
        <?php
    }

    public function hasilAll(){
        $kriteriaJumlah = $this->kriteriaJumlah;
        $dataAhp = $this->dataAhp;
        $kriteria = $this->kriteria;
        $normalisasi = $this->normalisasi;
        $arrHasil = $this->arrHasil;
        $index = $this->index;
        ?>
        <!-- <div class="form-group row">
            <label class="col-sm-12 col-form-label">5. Consistency Ratio</label>
        </div> -->
        <div id="hasilAll" class="set-hide">
            <div class="row">
                <table class="table table-bordered col-md-5">
                    <thead>
                        <tr>
                            <th scope="col">KRITERIA</th>
                            <th scope="col">BOBOT</th>
                            <th scope="col">PRIORITAS</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 0; $jumBobot = 0; $jumPersentasi = 0; foreach($arrHasil as $row){ 
                            $bobot[$no] = $row['nilai']/count($kriteria);
                            $jumBobot += $bobot[$no];
                            ?>
                        <tr>
                            <th scope="row"><?=$row['kriteria']?></th>
                            <td scope="row"><div><?=number_format($bobot[$no],4,",",".")?></div></td>
                            <td scope="row"><div><?=$no+1?></div></td>
                        </tr>
                        <?php $no++; } ?>
                        <tr>
                            <th scope="row">Jumlah</th>
                            <td scope="row"><div><?=number_format($jumBobot,4,",",".")?></div></td>
                            <td scope="row"></td>
                        </tr>
                    </tbody>
                </table>
                <div class="col-1"></div>
                <table class="table table-bordered  col-md-5">
                    <thead>
                        <tr>
                            <th colspan="2">Hasil</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">Lamda Maximum</th>
                            <td scope="row"><div><?=number_format($this->lamdaMax,4,",",".")?></div></td>
                        </tr>
                        <tr>
                            <th scope="row">Consistency Index</th>
                            <td scope="row"><div><?=number_format($this->cIndex,4,",",".")?></div></td>
                        </tr>
                        <tr>
                            <th scope="row">Random Index</th>
                            <td scope="row"><div><?=$index." => ".$this->ri[$index]?></div></td>
                        </tr>
                        <tr>
                            <th scope="row">Consistency Ratio</th>
                            <td scope="row"><div><?=number_format($this->hasil,4,",",".")?></div></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <br>
        <hr>
        <?php
    }

    function bubble_sort($arr) {
        // echo "<pre>";
        // print_r($arr);
        // echo "</pre>";
        $size = count($arr)-1;
        for ($i=0; $i<$size; $i++) {
            for ($j=0; $j<$size-$i; $j++) {
                $k = $j+1;
                if ($arr[$k]['nilai'] > $arr[$j]['nilai']) {
                    list($arr[$j], $arr[$k]) = array($arr[$k], $arr[$j]);
                }
            }
        }
        // echo "<pre>";
        // print_r($arr);
        // echo "</pre>";
        return $arr;
    }

}