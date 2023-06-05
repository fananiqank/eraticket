<script>
//alert("jooosss");

c = $('#kategori').val();
s = $('#subkategori').val();
a = $('#laset').val();
y = $('#priority').val();
t = $('#lstatus').val();
j = $('#ljenis').val();
g = $('#ass').val();
if($('#tgl').val() == '' ){
	tgsatu = 'A';
} else {
	tgsatu = $('#tglsatu').val();
}

if($('#tgl2').val() == '' ){
	tgdua = 'A';
} else {
	tgdua = $('#tgldua').val();
}

(function( $ ) {

	'use strict';

	var datatableInit = function() {

		var $table = $('#datatable-ajax');
		$table.dataTable({
			"processing": true,
         	"serverSide": true,
         	"scrollX" : false,
        	"ajax": "apps/report/wo/data.php?c="+c+"&s="+s+"&a="+a+"&y="+y+"&t="+t+"&j="+j+"&g="+g+"&tg="+tgsatu+"&tg2="+tgdua,
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

 	function pindahData2(c,s,y,t,j,g,tg,tg2){
 		if (tg != ''){
 			var tga = tg.split('/');
 			var istga = tga[2]+"-"+tga[0]+"-"+tga[1];
 		} else {
 			var istga = 'A';
 		}
 		if (tg2 != ''){
 			var tgb = tg2.split('/');
 			var istgb = tgb[2]+"-"+tgb[0]+"-"+tgb[1];
 		} else {
 			var istgb = 'A';
 		}
 		var hal = $('#hal').val();
		window.location="content.php?p="+hal+"&c="+c+"&s="+s+"&y="+y+"&t="+t+"&j="+j+"&g="+g+"&tg="+istga+"&tg2="+istgb;
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