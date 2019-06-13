
                <?php 

// print_r($bahan);
            $name =  @$bahan[0]['bahan_penyedia_nama'];
            $style = ' style="border: 1px solid; padding: 10px;"';
            $produksi = @$bahan[0]['bahan_penyedia_produksi'];
            $produksiKeinginan = @$bahan[0]['bahan_penyedia_produksi_keinginan'];
            $randemen = @$bahan[0]['bahan_penyedia_randemen'];
            $konversi = @$bahan[0]['bahan_penyedia_konversi']; //kg basah /1 kg kering
            $produktifitas = @$bahan[0]['bahan_penyedia_produktifitas'];
            $panenPerTahun = @$bahan[0]['bahan_penyedia_panen'];
            
            //(EOQ)
            $D = 100*24*$produksiKeinginan/$randemen;
            $S = $D*100;
            $H = 100;

            $EOQ = sqrt(2*$D*$S/$H);

            // ROP
            $d = 100*$produksiKeinginan/$randemen;
            $L = 15;
            $SS = $D*3;
            $ROP = ($d*$L)+$SS;

            ?>
            <table style="border-collapse: collapse; width:100%;">
                <thead>
                    <tr >
                        <th scope="col" colspan="2" <?=$style?> >Hasil</th>
                    </tr>
                </thead>
                <tbody>
                <?php if(!@$jenis) $jenis = NULL; if($jenis == 'kll'){ ?>
                    <tr>
                        <th <?=$style?> >Kebutuhan bahan baku (KBB)</th>
                        <td <?=$style?> ><?=number_format(100*24*12*@$produksiKeinginan/@$randemen,4,",",".")?> kg</td>
                    </tr>
                    <tr>
                        <th <?=$style?> >Kebutuhan luas lahan (KLL)</th>
                        <td <?=$style?> ><?=number_format((100*24*12*@$produksiKeinginan/@$randemen)/@$konversi/@$produktifitas/@$panenPerTahun,4,",",".")?> ha</td>
                    </tr>
                <?php } else if($jenis == 'rop'){ ?>
                    <tr>
                        <th <?=$style?> >Jumlah Pembelian Bahan Baku yang Ekonomis (EOQ)</th>
                        <td <?=$style?> ><?=number_format(@$EOQ,4,",",".")?> Kg</td>
                    </tr>
                    <tr>
                        <th <?=$style?> >Titik Pemesanan Kembali (ROP)</th>
                        <td <?=$style?> ><?=number_format(@$ROP,4,",",".")?> Kg</td>
                    </tr>
                <?php }else if($jenis == NULL){ ?> 
                    <tr>
                        <th <?=$style?> >Kebutuhan bahan baku (KBB)</th>
                        <td <?=$style?> ><?=number_format(100*24*12*@$produksiKeinginan/@$randemen,4,",",".")?> kg</td>
                    </tr>
                    <tr>
                        <th <?=$style?> >Kebutuhan luas lahan (KLL)</th>
                        <td <?=$style?> ><?=number_format((100*24*12*@$produksiKeinginan/@$randemen)/@$konversi/@$produktifitas/@$panenPerTahun,4,",",".")?> Kg/ha</td>
                    </tr>
                    <tr>
                        <th <?=$style?> >Jumlah Pembelian Bahan Baku yang Ekonomis (EOQ)</th>
                        <td <?=$style?> ><?=number_format(@$EOQ,4,",",".")?> Kg</td>
                    </tr>
                    <tr>
                        <th <?=$style?> >Titik Pemesanan Kembali (ROP)</th>
                        <td <?=$style?> ><?=number_format(@$ROP,4,",",".")?> Kg</td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>