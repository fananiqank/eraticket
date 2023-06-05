<script>
//alert("jooosss");

(function( $ ) {

	'use strict';

	var datatableInit = function() {
		var ass = $('#isiass').val();
		var $table = $('#datatable-ajax');
		$table.dataTable({
			"processing": true,
         	"serverSide": true,
        	"ajax": "apps/transaction/request/data.php?d="+ass,
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

 (function( $ ) {

	'use strict';

	/*
	Basic
	*/
	$('.modal-basic').magnificPopup({
		type: 'inline',
		preloader: false,
		modal: true
	});

	/*
	Sizes
	*/
	$('.modal-sizes').magnificPopup({
		type: 'inline',
		preloader: false,
		modal: true
	});

	/*
	Modal with CSS animation
	*/
	$('.modal-with-zoom-anim').magnificPopup({
		type: 'inline',

		fixedContentPos: false,
		fixedBgPos: true,

		overflowY: 'auto',

		closeBtnInside: true,
		preloader: false,
		
		midClick: true,
		removalDelay: 300,
		mainClass: 'my-mfp-zoom-in',
		modal: true
	});

	$('.modal-with-move-anim').magnificPopup({
		type: 'inline',

		fixedContentPos: false,
		fixedBgPos: true,

		overflowY: 'auto',

		closeBtnInside: true,
		preloader: false,
		
		midClick: true,
		removalDelay: 300,
		mainClass: 'my-mfp-slide-bottom',
		modal: true
	});

	/*
	Modal Dismiss
	*/
	$(document).on('click', '.modal-dismiss', function (e) {
		e.preventDefault();
		$.magnificPopup.close();
	});

	/*
	Modal Confirm
	*/
	$(document).on('click', '.modal-confirm', function (e) {
		e.preventDefault();
		$.magnificPopup.close();

		new PNotify({
			title: 'Success!',
			text: 'Modal Confirm Message.',
			type: 'success'
		});
	});

	/*
	Form
	*/
	$('.modal-with-form').magnificPopup({
		type: 'inline',
		preloader: false,
		focus: '#name',
		modal: true,

		// When elemened is focused, some mobile browsers in some cases zoom in
		// It looks not nice, so we disable it:
		callbacks: {
			beforeOpen: function() {
				if($(window).width() < 700) {
					this.st.focus = false;
				} else {
					this.st.focus = '#name';
				}
			}
		}
	});

	/*
	Ajax
	*/
	$('.simple-ajax-modal').magnificPopup({
		type: 'ajax',
		modal: true
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

	function simpan(a){
		alert(a);
		var confirmText = "Are you sure Save Data?";
    	if(confirm(confirmText)) {

    		if ($('#jmlappwo').val() == '' && $('#idm').val() == ''){
    			alert('Data Not Complete!!\nCek CMT on Plan or Sequence Process');
    			return false;
    		} else if ($('#role_grup_m_id').val() == '' && $('#idm').val() == ''){
    			alert('Sequence Process Not Found!!');
    			return false;
    		} else {
    			if($('#idm').val() == ''){
					$('#simpanan').val('simpanall');
					
				}
					var data = $('.form-user').serialize();
						$.ajax({
							type: 'POST',
							url:  "apps/Transaction/Sequence/simpan.php",
							data: data,
							success: function() {
								alert("Saved Success");
								$('#tampildata').load("apps/Transaction/Sequence/tampil.php");
								$('#tampil').load("apps/Transaction/Sequence/tampil.php");
								$('#tampilwo').load("apps/Transaction/Sequence/tampilwo.php");
								$('#tampilapp').load("apps/Transaction/Sequence/tampilapp.php");
								$('#tampilwip').load("apps/Transaction/Sequence/tampilwip.php");
								$('#simpanan').val('');
									if($('#getlast').val() != ''){
										document.location='content.php?p='+$('#getp').val()+'_'+$('#getlast').val();
									} else {
										document.location='content.php?p='+$('#getp').val();
									}
							}
						});
				
			}
		} else {
			return false;
		}
	}
</script>