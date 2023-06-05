<script>
 //alert("jooosss");

(function( $ ) {

	'use strict';

	var datatableInit = function() {

		var $table = $('#datatable-ajax');
		$table.dataTable({
			"processing": true,
         	"serverSide": true,
        	"ajax": "apps/master/user/data.php",
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
	function kate(id){
		alert(id);
		$.get('apps/transaction/request/subcat.php?id='+id, function(data) {
				$('#subkategori').html(data);    
		});
		
	}
	function hapuscat(id){
		//alert(id);
		var getp = $('#getp').val();
		javascript: window.location.href="content.php?p="+getp+"_s&j="+id;	
		
	}
	function cekpas(id){
		if(id == $('#password').val()){
			$('#feedback').text('');
		} else {
			swal({
			  type: 'warning',
			  title: 'Confirm Failed',
			  text: 'Please Try Again',
			  ConfirmButtonText: 'OK',
			},)
			$('#password2').val('');
			$('#password2').focus();
		}
	}
	// function inactive(id){
	// 	$('#kode').val(id);
	// 	$('#aksi').val('hapus');
	// 	javascript: document.getElementById('form_index').submit();
		
	// }
	function detagent(id){
		$('#id').val(id);
		//javascript: document.getElementById('form_index').submit();
		javascript: window.location.href="index.php?x=berita_e&id="+id;
		//alert(id);
		
	}
		
</script>