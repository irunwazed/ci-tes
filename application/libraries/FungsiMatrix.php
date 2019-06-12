<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FungsiMatrix {

    private static $CI;

    public function __construct()
    {
        self::$CI = & get_instance();
    }

    public function tampil($matrix){

        ?>
        <table border="1">
        <?php for($i=0; $i<sizeof($matrix); $i++){ ?>
            <tr>
            <?php for ($j=0; $j<sizeof($matrix[0]); $j++){ ?>
                <td style="padding:5px"><?=$matrix[$i][$j]?></td>
            <?php } ?>
            </tr>
        <?php } ?>
        </table>
        <?php
    }

    public function perkalianMatriks($matriks_a, $matriks_b) {
        $hasil = array();
        for ($i=0; $i<sizeof($matriks_a); $i++) {
            for ($j=0; $j<sizeof($matriks_b[0]); $j++) {
                $temp = 0;
                for ($k=0; $k<sizeof($matriks_b); $k++) {
                    $temp += $matriks_a[$i][$k] * $matriks_b[$k][$j];
                }
                $hasil[$i][$j] = $temp;
            }
        }
        return $hasil;
    }

    //invers matrix
    function invertMatrix($A, $debug = FALSE)
    {
        /// @todo check rows = columns
        $n = count($A);
        // get and append identity matrix
        $I = $this->identity_matrix($n);
        for ($i = 0; $i < $n; ++ $i) {
            $A[$i] = array_merge($A[$i], $I[$i]);
        }
        if ($debug) {
            echo "\nStarting matrix: ";
            $this->tampil($A);
        }
        // forward run
        for ($j = 0; $j < $n-1; ++ $j) {
            // for all remaining rows (diagonally)
            for ($i = $j+1; $i < $n; ++ $i) {
                // if the value is not already 0
                if ($A[$i][$j] !== 0) {
                    // adjust scale to pivot row
                    // subtract pivot row from current
                    $scalar = $A[$j][$j] / $A[$i][$j];
                    for ($jj = $j; $jj < $n*2; ++ $jj) {
                        $A[$i][$jj] *= $scalar;
                        $A[$i][$jj] -= $A[$j][$jj];
                    }
                }
            }
            if ($debug) {
                echo "\nForward iteration $j: ";
                $this->tampil($A);
            }
        }
        // reverse run
        for ($j = $n-1; $j > 0; -- $j) {
            for ($i = $j-1; $i >= 0; -- $i) {
                if ($A[$i][$j] !== 0) {
                    $scalar = $A[$j][$j] / $A[$i][$j];
                    for ($jj = $i; $jj < $n*2; ++ $jj) {
                        $A[$i][$jj] *= $scalar;
                        $A[$i][$jj] -= $A[$j][$jj];
                    }
                }
            }
            if ($debug) {
                echo "\nReverse iteration $j: ";
                $this->tampil($A);
            }
        }
        // last run to make all diagonal 1s
        /// @note this can be done in last iteration (i.e. reverse run) too!
        for ($j = 0; $j < $n; ++ $j) {
            if ($A[$j][$j] !== 1) {
                $scalar = 1 / $A[$j][$j];
                for ($jj = $j; $jj < $n*2; ++ $jj) {
                    $A[$j][$jj] *= $scalar;
                }
            }
            if ($debug) {
                echo "\n1-out iteration $j: ";
                $this->tampil($A);
            }
        }
        // take out the matrix inverse to return
        $Inv = array();
        for ($i = 0; $i < $n; ++ $i) {
            $Inv[$i] = array_slice($A[$i], $n);
        }
        return $Inv;
    }
    
    function print_matrix($A, $decimals = 6)
    {
        foreach ($A as $row) {
            echo "\n\t[";
            foreach ($row as $i) {
                echo "\t" . sprintf("%01.{$decimals}f", round($i, $decimals));
            }
            echo "\t]";
        }
    }
    
    function identity_matrix($n)
    {
        $I = array();
        for ($i = 0; $i < $n; ++ $i) {
            for ($j = 0; $j < $n; ++ $j) {
                $I[$i][$j] = ($i == $j) ? 1 : 0;
            }
        }
        return $I;
    }

    //.invers matrix

    public function transpose($array) {
        array_unshift($array, null);
        return call_user_func_array('array_map', $array);
    }

    
    
    // Or if you're using PHP 5.6 or later:
    // public function transpose($array) {
    //     return array_map(null, ...$array);
    // }
}
?>