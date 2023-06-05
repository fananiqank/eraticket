<script>
 //alert("jooosss");

<?php if($_GET['sub']) {?>
(function( $ ) {

	'use strict';

	var datatableInit = function() {

		var $table = $('#datatable-ajax');
		$table.dataTable({
			"processing": true,
         	"serverSide": true,
        	"ajax": "apps/master/category/data2.php?su=<?=$_GET[sub]?>",
        	"fnRowCallback": function (nRow, aData, iDisplayIndex) {
				     var info = $(this).DataTable().page.info();
				     $("td:nth-child(1)", nRow).html(info.start + iDisplayIndex + 1);
				     return nRow;
				 }
        },
        );
	};
	
	$(function() {
		datatableInit();
	});

 }).apply( this, [ jQuery ]);

<?php } else { ?>

(function( $ ) {

	'use strict';

	var datatableInit = function() {

		var $table = $('#datatable-ajax');
		$table.dataTable({
			"processing": true,
         	"serverSide": true,
        	"ajax": "apps/master/category/data.php",
        	"fnRowCallback": function (nRow, aData, iDisplayIndex) {
				     var info = $(this).DataTable().page.info();
				     $("td:nth-child(1)", nRow).html(info.start + iDisplayIndex + 1);
				     return nRow;
				 }
        },
        );
	};
	
	$(function() {
		datatableInit();
	});

 }).apply( this, [ jQuery ]);
<?php } ?>
// // Call template init (optional, but faster if called manually)
// 		$.template.init();

// 		// Table sort - DataTables
// 		var table = $('#datatable-ajax');
// 		//alert(table);
// 		table.dataTable({
// 				"processing": true,
//         		"serverSide": true,
//         		"ajax": "apps/master/agent/data.php",
// 				"pagingType": "full_numbers",
// 				"order": [[ 0, "desc" ]],
// 				"fnRowCallback": function (nRow, aData, iDisplayIndex) {
// 					 var info = $(this).DataTable().page.info();
// 					 $("td:nth-child(1)", nRow).html(info.start + iDisplayIndex + 1);
// 					 return nRow;
// 				 }
			
// 		});
	function edit(id){
		var getp = $('#getp').val();
		$('#kode').val(id);
		//javascript: document.getElementById('form_index').submit();
		javascript: window.location.href="content.php?p="+getp+"&d="+id;
		//alert(id);
		
	}
	function editsub(id){
		var getp = $('#getp').val();
		var sub = $('#sub').val();
		$('#kode').val(id);
		//javascript: document.getElementById('form_index').submit();
		javascript: window.location.href="content.php?p="+getp+"&sub="+sub+"&d="+id;
	}
	function detail(id){
		var getp = $('#getp').val();
		//javascript: document.getElementById('form_index').submit();
		javascript: window.location.href="content.php?p="+getp+"&sub="+id;
		//alert(id);
		
	}
	
	function hapus(id){
		//alert(id);
		var getp = $('#getp').val();
		var sub = $('#sub').val();
		javascript: window.location.href="content.php?p="+getp+"_s&j="+id+"&s="+sub;	
		
	}
	function hapuscat(id){
		//alert(id);
		var getp = $('#getp').val();
		javascript: window.location.href="content.php?p="+getp+"_s&j="+id;	
		
	}

	function hapus1(id){
		$('#id').val(id);
		$('#aksi').val('hapus');
		javascript: document.getElementById('form_index').submit();
		
	}
	function detagent(id){
		$('#id').val(id);
		//javascript: document.getElementById('form_index').submit();
		javascript: window.location.href="index.php?x=berita_e&id="+id;
		//alert(id);
		
	}
		
</script>