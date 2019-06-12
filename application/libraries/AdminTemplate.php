<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminTemplate {

    private static $CI;
    
    public function __construct()
    {
        self::$CI = & get_instance();
        if(!@self::$CI->session->userdata('id')){
            redirect(base_url('login'));
        }
        
    }

    public function templateAll($data){
        
        ?>
<!DOCTYPE html>
<html>
<head>
    <?=$data['head']?>
    <link rel="stylesheet" type="text/css" href="<?=base_url('public/template/')?>src/plugins/datatables/media/css/jquery.dataTables.css">
	<link rel="stylesheet" type="text/css" href="<?=base_url('public/template/')?>src/plugins/datatables/media/css/dataTables.bootstrap4.css">
	<link rel="stylesheet" type="text/css" href="<?=base_url('public/template/')?>src/plugins/datatables/media/css/responsive.dataTables.css">
</head>
<body>
    <?=$data['header']?>
    <?=$data['sidebar']?>
	<div class="main-container">
		<div class="pd-ltr-20 customscroll customscroll-10-p height-100-p xs-pd-20-10">
			<div class="min-height-200px">
            <?php if(@self::$CI->session->flashdata('pesan')){ 
            $pesan = self::$CI->session->flashdata('pesan');    
            ?>
                <div class="alert alert-<?=$pesan['class']?> alert-dismissible fade show" role="alert">
                    <?=$pesan['isi']?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
            <?php } ?>
            <?=$data['isi']?>
            </div>
			<?=$data['footer']?>
		</div>
	</div>
	<?=$data['script']?>
    <script src="<?=base_url('public/template/')?>src/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
	<script src="<?=base_url('public/template/')?>src/plugins/datatables/media/js/dataTables.bootstrap4.js"></script>
	<script src="<?=base_url('public/template/')?>src/plugins/datatables/media/js/dataTables.responsive.js"></script>
	<script src="<?=base_url('public/template/')?>src/plugins/datatables/media/js/responsive.bootstrap4.js"></script>
	<!-- buttons for Export datatable -->
	<script src="<?=base_url('public/template/')?>src/plugins/datatables/media/js/button/dataTables.buttons.js"></script>
	<script src="<?=base_url('public/template/')?>src/plugins/datatables/media/js/button/buttons.bootstrap4.js"></script>
	<script src="<?=base_url('public/template/')?>src/plugins/datatables/media/js/button/buttons.print.js"></script>
	<script src="<?=base_url('public/template/')?>src/plugins/datatables/media/js/button/buttons.html5.js"></script>
	<script src="<?=base_url('public/template/')?>src/plugins/datatables/media/js/button/buttons.flash.js"></script>
	<script src="<?=base_url('public/template/')?>src/plugins/datatables/media/js/button/pdfmake.min.js"></script>
	<script src="<?=base_url('public/template/')?>src/plugins/datatables/media/js/button/vfs_fonts.js"></script>
	<script>
		

		function viewTable(obj){
			let table = $(obj).attr("data-table");
			let isi = $(obj).text();
			
			if($("#"+table).hasClass("set-hide")){
				isi = isi.replace('Lihat', 'Sembunykan');
				$(obj).html('<i class="fa fi-arrow-up"></i> '+isi);
				$("#"+table).removeClass("set-hide");
			}else{
				isi = isi.replace('Sembunykan', 'Lihat');
				$(obj).html('<i class="fa fi-arrow-down"></i> '+isi);
				$("#"+table).addClass("set-hide");
			}
			
			console.log(isi);
		}

		$('document').ready(function(){
			$('.data-table').DataTable({
				scrollCollapse: true,
				autoWidth: false,
				responsive: true,
				columnDefs: [{
					targets: "datatable-nosort",
					orderable: false,
				}],
				"lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
				"language": {
					"info": "_START_-_END_ of _TOTAL_ entries",
					searchPlaceholder: "Search"
				},
			});
			$('.data-table-export').DataTable({
				scrollCollapse: true,
				autoWidth: false,
				responsive: true,
				columnDefs: [{
					targets: "datatable-nosort",
					orderable: false,
				}],
				"lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
				"language": {
					"info": "_START_-_END_ of _TOTAL_ entries",
					searchPlaceholder: "Search"
				},
				dom: 'Bfrtip',
				buttons: [
				'copy', 'csv', 'pdf', 'print'
				]
			});
			var table = $('.select-row').DataTable();
			$('.select-row tbody').on('click', 'tr', function () {
				if ($(this).hasClass('selected')) {
					$(this).removeClass('selected');
				}
				else {
					table.$('tr.selected').removeClass('selected');
					$(this).addClass('selected');
				}
			});
			var multipletable = $('.multiple-select-row').DataTable();
			$('.multiple-select-row tbody').on('click', 'tr', function () {
				$(this).toggleClass('selected');
			});
		});

		var globalLink = '<?=base_url()?>';
	</script>
    <?=$data['myscript']?>
</body>
</html>

        <?php
    }

}