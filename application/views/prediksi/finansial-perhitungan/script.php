
<script>
    <?php

        // if(@$dataPilih[0]['finansial_kategori_id']){
        //     echo "getBahan(".$dataPilih[0]['finansial_kategori_id'].")";
        // }
    
    ?>


    // $("#kategori").change( function() {
    //     var id = $('#kategori').val();
    //     getBahan(id);
        
	// });

    // $("#bahan").change( function() {
    //     var harga = $('#bahan').find(':selected').data('harga');
    //     // console.log(harga);
    //     $('#harga').val(harga);
        
	// });


    // function getBahan(id){
    //     $.ajax({
    //         type:'GET',
    //         url:globalLink+"prediksi/finansial/get-bahan/"+id,
    //         dataType: "JSON",
    //         success:function(data){
    //             console.log(data);
    //             insertBahan(data.data);
    //         },
    //         error:function(data){
    //             console.log(data);
    //         }
    //     });
    // }

    // function insertBahan(data){
    //     $("#bahan").empty().append('<option value="">Pilih Bahan</option>');
    //     data.forEach(function(element) {
    //         // console.log(element);
    //         $("#bahan").append('<option data-harga="'+element.finansial_bahan_harga+'" value="'+element.finansial_bahan_id+'">'+element.finansial_bahan_nama+' => '+element.finansial_bahan_harga+'</option>');
    //     });
    //     // $('#harga').val();
    //     $("#bahan").val("<?=@$dataPilih[0]['finansial_bahan_id']?>").change();
    //     // console.log(data);
    // }
    skenario();
    skenario1();
    function skenario(tampil = false){
        if(tampil){
            $("#form-skenario").removeClass("set-hide");
            $("#tombol-skenario").attr("onclick", "skenario(false)").text("Sembunyikan Skenario");
        }else{
            $("#form-skenario").addClass("set-hide");
            $("#tombol-skenario").attr("onclick", "skenario(true)").text("Tampilkan Skenario");
        }
    }

    function skenario1(tampil = false){
        if(tampil){
            $("#form-skenario-1").removeClass("set-hide");
            $("#tombol-skenario-1").attr("onclick", "skenario1(false)").text("Sembunyikan Skenario");
        }else{
            $("#form-skenario-1").addClass("set-hide");
            $("#tombol-skenario-1").attr("onclick", "skenario1(true)").text("Tampilkan Skenario");
        }
    }

    <?php if(@$status == 'penetapan'){ ?>
        $("#hasilFinansial").addClass("set-hide");
        $("#tampilPenetapan").html($("#penentuanHarga").html());
    <?php }else{ ?>
        $("#hasilPenetapan").addClass("set-hide");
    $("#tampilHasil").html($("#hasilAkhir").html());
    <?php } ?>
</script>