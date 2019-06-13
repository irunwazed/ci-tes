<?php
// echo "<pre>";
// print_r($dataPilih);
// echo "</pre>";
?>
<script>

    function changeInsert(obj){
        var id= $(obj).attr('id');
        // alert(id.split("-")[1]);
        let idChange = id.split("-")[2]+"-"+id.split("-")[1];
        let value = $('option:selected', obj).attr('data-no');
        let valueView = value;
        if (value.split('/')[1]){
            // value = 
            // alert('string');
            value = value.split('/')[0]/value.split('/')[1];
        }
        // alert(value);
        $('#insert-'+idChange).val(value);
        $('#view-'+idChange).html(valueView);

    }
    var jumKriteria = 1;
    var jumWilayah = 1;

    function addKriteria(val = '', hapus = true){


        let isi = '<div class="kriteria-'+(jumKriteria+1)+' row">'+
                        '<div class="col-10">'+
                            '<input class="form-control" type="text" placeholder="Masukkan Kriteria" name="kriteria[]" value="'+val+'">'+
                        '</div>';
        if(hapus){
        isi +=       '<div class="col-2">'+
                        '<a href="javascript:void(0);"  onclick="deleteKriteria('+(jumKriteria+1)+')"><i class="fa fa-trash"></i></a>'+
                    '</div>';
        }
        isi +=       '</div>';
        
        $('#daftar-kriteria').append(isi);
        
        jumKriteria++;
    }

    function deleteKriteria(id){
        // alert(id);
        console.log($("#daftar-kriteria"));
        $(".kriteria-"+id).remove(".kriteria-"+id);
    }

    function addWilayah(val = '', hapus = true){


        let isi =   '<div class="wilayah-'+(jumWilayah+1)+' row">'+
                        '<div class="col-10">'+
                            '<input class="form-control" type="text" placeholder="Masukkan Alternatif" name="wilayah[]" value="'+val+'">'+
                        '</div>';
        if(hapus){
        isi +=       '<div class="col-2">'+
                        '<a href="javascript:void(0);"  onclick="deleteWilayah('+(jumWilayah+1)+')"><i class="fa fa-trash"></i></a>'+
                    '</div>';
        }
        isi +=       '</div>';

        $('#daftar-wilayah').append(isi);

        jumWilayah++;
    }

    function deleteWilayah(id){
        // alert(id);
        console.log($("#daftar-wilayah"));
        $(".wilayah-"+id).remove(".wilayah-"+id);
    }

    <?php
        if(@$_GET['tombol'] == "edit"){
            echo "deleteKriteria(1);";
            echo "deleteWilayah(1);";

            foreach($dataPilih['dataKriteria'] as $rowKriteria){
                echo "addKriteria('".$rowKriteria['kriteria']."', false);";
            }
            foreach($dataPilih['dataWilayah'] as $row){
                echo "addWilayah('".$row['wilayah']."', false);";
            }
        }
    
    ?>
    
</script>