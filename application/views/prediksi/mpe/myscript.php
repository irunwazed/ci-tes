

<?php
    $tampil = 1;
    if(@$_GET['tampil']){
        $tampil = $_GET['tampil'];
    }
?>
<script>
    function changeInsert(obj){

    }

    tampilHasil(<?=$tampil?>);

    function changeOutput(obj){
        tampilHasil($(obj).val());
    }

    function tampilHasil(no = null){
        console.log(no);
        $("#tombol-pdf").removeClass("set-hide");
        $("#tampilGrafikHasilRekap").addClass("set-hide");
        $("#tampilGrafikKriteria").addClass("set-hide");
        if(no == 1){
            $("#tampilHasilRekap").html($("#hasil-bobot").html());
        }else if(no == 2){
            $("#tampilHasilRekap").html($("#hasil-rekap").html());
        }else if(no == 3){
            let jumlah = $(".hasil-kriteria").length;
            console.log(jumlah);
            let temp = '';
            for(let i = 0; i<jumlah;i++){
                temp += $("#hasil-kriteria-"+i).html();
            }
            $("#tampilHasilRekap").html(temp);
        }else if(no == 4){
            $("#tombol-pdf").addClass("set-hide");
            $("#tampilHasilRekap").html("");
            $("#tampilGrafikHasilRekap").removeClass("set-hide");
            $("#tampilGrafikKriteria").removeClass("set-hide");
        }else{
            // $("#tampilHasilRekap").html($("#hasilRekap").html());
        }
    }
    
</script>