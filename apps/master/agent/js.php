<script>
	//alert("jooosss");

(function( $ ) {

	'use strict';

	var datatableInit = function() {

		var $table = $('#datatable-ajax');
		$table.dataTable({
			"autoWidth": false,
	        "columnDefs": [{ 
	            orderable: false,
	            targets: [ 1 ]
	        }],
	       	
			"processing": true,
         	"serverSide": true,
        	"ajax": "apps/master/agent/data.php",
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
	function mode(id){
	$("#funModal").show();
	pg = $("#hal").val();
	$.get('apps/master/agent/modagent.php?id='+id+'&p='+pg, function(data) {
				$('#modalagent').html(data);    
		});
	}

	function ubahbulan(id,b){
		$('#id').val(b);
		$.get('apps/master/agent/assign.php?id='+id+'&bul='+b, function(data) {
				$('#isiassign').html(data);    
		});
		
	}

	function ubahbulant(id,b){
		$('#id').val(b);
		$.get('apps/master/agent/tasks.php?id='+id+'&bul='+b, function(data) {
				$('#isitasks').html(data);    
		});
		
	}

	function edit(id){
		$('#id').val(id);
		//javascript: document.getElementById('form_index').submit();
		javascript: window.location.href="index.php?x=berita_e&id="+id;
		//alert(id);
		
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
	function nilai(id){
		alert ($('#gambar').val(id));
		var t = $('#gambar').val(id);
		$('#nilai').val(t);
		}
		
	function call(id){
		var expl=id.split('_');
		call2(expl[1])
	}
	function call2(st){
		//alert(st);
		if(st==1){
			$('#st').show();	
		}
		if(st==0){
			$('#st').hide();	
		}
	}
	function validate_frm()
		{
			
		try{
			x = document.formku;
			
			
			if (x.password2.value != x.password.value)
			{
				alert('Password Tidak sama!');
				x.password2.value='';
				x.password2.focus();
				return(false);
			}
			return(true);
			}catch(e){
				alert('Error '+ e.description);
			}
		}

	
</script>