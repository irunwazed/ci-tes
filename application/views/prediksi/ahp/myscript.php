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
    // console.log(globalHasil);
    if(parseInt(globalHasil) > 10){
        $('#hasil').removeClass( "bg-success" );
        $('#hasil').addClass( "bg-warning" );
    }
    $('#hasil').html(globalHasil);
    $("#tampilHasilAll").html($("#hasilAll").html());
</script>