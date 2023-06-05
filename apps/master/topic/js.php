<script>
 //alert("jooosss");

<?php if($_GET['sub']) {?>
(function( $ ) {
	var vsub = $('#sub').val();
	'use strict';

	var datatableInit = function() {

		var $table = $('#datatable-ajax');
		$table.dataTable({
			"processing": true,
         	"serverSide": true,
        	"ajax": "apps/master/topic/data2.php?sub="+vsub,
        	"columnDefs": [
				    {
				        targets: (4),
				        className: 'dt-body-center'
				    }
				  ],
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
        	"ajax": "apps/master/topic/data.php",
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
	function hapuscat(id){
		//alert(id);
		var getp = $('#getp').val();
		javascript: window.location.href="content.php?p="+getp+"_s&j="+id;	
		
	}
	function hapuscatsub(sub,id){
		//alert(sub);
		var getp = $('#getp').val();
		javascript: window.location.href="content.php?p="+getp+"_s&sub="+sub+"&j="+id;	
		
	}

	function hapus(id){
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

	function mode(id){
	$("#funModal").show();
	su = $("#sub").val();
	$.get('apps/master/topic/modtopic.php?id='+id+'&sb='+su, function(data) {
				$('#modalagent').html(data);    
		});
	}
		
</script>