<html>
    <head>

    </head>
    <body>
    <?php
    // $this->fungsimatrix->tampil($data);
    // $this->fungsimatrix->tampil($this->fungsimatrix->transpose($data));
    

    class MatrixLibrary
    {
        //Gauss-Jordan elimination method for matrix inverse
        public function inverseMatrix(array $matrix)
        {
            //TODO $matrix validation

            $matrixCount = count($matrix);

            $identityMatrix = $this->identityMatrix($matrixCount);
            $augmentedMatrix = $this->appendIdentityMatrixToMatrix($matrix, $identityMatrix);
            $inverseMatrixWithIdentity = $this->createInverseMatrix($augmentedMatrix);
            $inverseMatrix = $this->removeIdentityMatrix($inverseMatrixWithIdentity);

            return $inverseMatrix;
        }

        private function createInverseMatrix(array $matrix)
        {
            $numberOfRows = count($matrix);

            for($i=0; $i<$numberOfRows; $i++)
            {
                $matrix = $this->oneOperation($matrix, $i, $i);

                for($j=0; $j<$numberOfRows; $j++)
                {
                    if($i !== $j)
                    {
                        $matrix = $this->zeroOperation($matrix, $j, $i, $i);
                    }
                }
            }
            $inverseMatrixWithIdentity = $matrix;

            return $inverseMatrixWithIdentity;
        }

        private function oneOperation(array $matrix, $rowPosition, $zeroPosition)
        {
            if($matrix[$rowPosition][$zeroPosition] !== 1)
            {
                $numberOfCols = count($matrix[$rowPosition]);

                if($matrix[$rowPosition][$zeroPosition] === 0)
                {
                    $divisor = 0.0000000001;
                    $matrix[$rowPosition][$zeroPosition] = 0.0000000001;
                }
                else
                {
                    $divisor = $matrix[$rowPosition][$zeroPosition];
                }

                for($i=0; $i<$numberOfCols; $i++)
                {
                    $matrix[$rowPosition][$i] = $matrix[$rowPosition][$i] / $divisor;
                }
            }

            return $matrix;
        }

        private function zeroOperation(array $matrix, $rowPosition, $zeroPosition, $subjectRow)
        {
            $numberOfCols = count($matrix[$rowPosition]);

            if($matrix[$rowPosition][$zeroPosition] !== 0)
            {
                $numberToSubtract = $matrix[$rowPosition][$zeroPosition];

                for($i=0; $i<$numberOfCols; $i++)
                {
                    $matrix[$rowPosition][$i] = $matrix[$rowPosition][$i] - $numberToSubtract * $matrix[$subjectRow][$i];
                }
            }

            return $matrix;
        }

        private function removeIdentityMatrix(array $matrix)
        {
            $inverseMatrix = array();
            $matrixCount = count($matrix);

            for($i=0; $i<$matrixCount; $i++)
            {
                $inverseMatrix[$i] = array_slice($matrix[$i], $matrixCount);
            }

            return $inverseMatrix;
        }

        private function appendIdentityMatrixToMatrix(array $matrix, array $identityMatrix)
        {
            //TODO $matrix & $identityMatrix compliance validation (same number of rows/columns, etc)

            $augmentedMatrix = array();

            for($i=0; $i<count($matrix); $i++)
            {
                $augmentedMatrix[$i] = array_merge($matrix[$i], $identityMatrix[$i]);
            }

            return $augmentedMatrix;
        }

        public function identityMatrix( $size)
        {
            //TODO validate $size

            $identityMatrix = array();

            for($i=0; $i<$size; $i++)
            {
                for($j=0; $j<$size; $j++)
                {
                    if($i == $j)
                    {
                        $identityMatrix[$i][$j] = 1;
                    }
                    else
                    {
                        $identityMatrix[$i][$j] = 0;
                    }
                }
            }

            return $identityMatrix;
        }
    }

    $matrix = array(
        array(11, 3, 12, 1),
        array(8, 7, 10, 1),
        array(13, 14, 15, 2),
        array(13, 14, 15, 1),
        
    );

    $cMatrix = array(
        array(1, 0, 1),
        array(1, 1, 0),
        array(1, 0, 1),
        array(0, 1, 0),
        array(0, 1, 0),
        array(0, 1, 0),
        array(0, 0, 1),
    );

    $A = array(
        array( 10, -15,  30,   6, -8 ),
        array(  0,  -4,  60,  11, -5 ),
        array(  8,   9,   2,   3,  7 ),
        array( 25,  10,  -9,   9,  0 ),
        array( 13,   3, -12,   5,  120 ),
    );
    // $matrixLibrary = new MatrixLibrary();
    // $inverseMatrix = $matrixLibrary->inverseMatrix($matrix);
    $transpose = $this->fungsimatrix->transpose($cMatrix);

    $transposeKali = $this->fungsimatrix->perkalianMatriks($transpose, $cMatrix);
    $invert = $this->fungsimatrix->invertMatrix($transposeKali);
    $this->fungsimatrix->tampil($invert);
    $this->fungsimatrix->tampil($transpose);
    $this->fungsimatrix->tampil($transposeKali);

    // $SVD = $this->FungsiMatrixSVD->SVD($cMatrix);
    // $this->FungsiMatrixSVD->tampil($SVD);
    // $eigenValue = Lapack::eigenValues($matrix);
    // $this->fungsimatrix->tampil($eigenValue);
    // print_r($inverseMatrix);
    ?>
    </body>
</html>