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
    function addKriteria(){


        let isi = '<div class="kriteria-'+(jumKriteria+1)+' row">'+
                        '<div class="col-10">'+
                            '<input class="form-control" type="text" placeholder="Masukkan Kriteria" name="kriteria[]">'+
                        '</div>'+
                        '<div class="col-2">'+
                            '<a href="javascript:void(0);"  onclick="deleteKriteria('+(jumKriteria+1)+')"><i class="fa fa-trash"></i></a>'+
                        '</div>'+
                    '</div>';
        
        $('#daftar-kriteria').append(isi);
        
        jumKriteria++;
    }

    function deleteKriteria(id){
        alert(id);
        console.log($("#daftar-kriteria"));
        $(".kriteria-"+id).remove(".kriteria-"+id);
    }
    
</script>