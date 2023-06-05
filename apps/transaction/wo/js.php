
<script>

(function( $ ) {

	'use strict';

	var datatableInit = function() {

		var $table = $('#datatable-ajax');
		$table.dataTable({
			"processing": true,
         	"serverSide": true,
        	"ajax": "apps/transaction/wo/data.php",
        	"fnRowCallback": function (nRow, aData, iDisplayIndex) {
				     var info = $(this).DataTable().page.info();
				     $("td:nth-child(1)", nRow).html(info.start + iDisplayIndex + 1);
				     return nRow;
				 },
			 "order": [[ 0, "desc" ]]
        	
        },

	);
		    

    	
	};
	
	$(function() {
		datatableInit();
	});

 }).apply( this, [ jQuery ]);

 	
 	function sharewo(id){
		if(id == 1){
			$('#agentub').show();
			$('#agentubt').hide();
		} else {
			$('#agentub').hide();
			$('#agentubt').show();
		}
		
	}

	function stclose(id){
		if(id == '4'){
			$('#prog').hide();
			$('#topi').show();
			$('#stsla2').val('');
		} else if (id == '2') {
			if($('#stsla1').val() != id){
				$('#stsla2').val(id);
			} else if($('#stsla1').val() == id){
				$('#stsla2').val('');
			}
			$('#prog').show();
			$('#topi').hide();
		} else if (id == '3' && $('#stsla1').val() != id) {
			if($('#stsla1').val() != id){
				$('#stsla2').val(id);
			} else if($('#stsla1').val() == id){
				$('#stsla2').val('');
			}
			$('#prog').show();
			$('#topi').hide();
		} else {
			$('#prog').show();
			$('#topi').hide();
			$('#stsla2').val('');
		}
		
	}

	function addcat(id){
		if(id == '1'){
			$('#addktp').show();
			$('#ktp').hide();
		} else {
			$('#addktp').hide();
			$('#ktp').show();
		}
		
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
	function detailasetticket(id){
              $.ajax({
                  url:'apps/transaction/request/detailaset.php',
                  type:'post',
                  data:{userid:id},
                  success: function(response){
                      $('#detailasetticket').html(response);   
                  }
              });           
	}
</script>
	