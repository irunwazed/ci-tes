
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

   
    <?php if(@$status == 'penetapan'){ ?>
        $("#hasilFinansial").addClass("set-hide");
        $("#tampilPenetapan").html($("#penentuanHarga").html());
    <?php }else{ ?>
        $("#hasilPenetapan").addClass("set-hide");
    $("#tampilHasil").html($("#hasilAkhir").html());
    <?php } ?>
</script>