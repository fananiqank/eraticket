<div class="col-sm-2" style="vertical-align: middle;">
	<strong>NoPeg</strong>
</div>
<div class="col-sm-7"  id="coldepas">
	<div class="input-group input-group-icon" id="nogmshow" style="display:block">
		<input name="nogm" id="nogm" type="text" class="form-control nonogm input-sm" style="text-transform: uppercase;" onblur="cecep(this.value)" placeholder="Search No Peg / Name" required/>
		
		<span style="font-size:8px;">* No.Peg sesuai dengan Payroll</span>
	</div>
	
</div>
<div class="col-sm-1"><span class="btn btn-primary btn-sm" onclick="resetgm()"><i class="fa fa-refresh"></i></span></div>

<script type="text/javascript">

$(function() {
    $( ".nonogm" ).autocomplete({
     	source: function(request, response) {
		    $.getJSON(
		        "sourcedata.php",
		        { d:'2', term:request.term}, 
		        response
		    );
		},
       minLength:2, 
       select: function (event, ui) {
        	if (ui.item != undefined) {
                $(this).val(ui.item.nogmid);
                document.getElementById("nogm").readOnly = true; 
                if(($('#typereq').val()==1 && $('#trep').val()==2) || $('#typereq').val()==2 || $('#typereq').val()==4){
	                $( "#namepeople" ).val( ui.item.name );
	                document.getElementById("namepeople").readOnly = true;
			        $( "#jabatan" ).val( ui.item.jabatan );
			        $( "#mobile" ).val( ui.item.mobile );
			       	$('#depnew').val(ui.item.dept).trigger('change');
		       }
		       //	$('#locationid').val(ui.item.locid).trigger('change');     
				if(($('#typereq').val()==1 && $('#trep').val()==2) || $('#typereq').val()==4){
					$('#akunygdiminta').load("sourceakunminta.php?reload=1&d="+ui.item.peopleid+"&typereq="+$('#typereq').val());}
				if($('#typereq').val()==4){	
					$('#assetlist').load("sourceassetlist.php?reload=1&pp="+ui.item.peopleid); }
				if($('#typereq').val()==2){	
					$('#assetlist2').load("sourceassetlist.php?reload=1&pp="+ui.item.peopleid); }
				if($('#typereq').val()==1 && $('#trep').val()==1){	
					$('#assetlistreplace').load("sourceassetlist.php?reload=1&pp="+ui.item.peopleid);
					$('#detailreplace').load("sourceformdetailreplace.php?reload=1&name="+encodeURI(ui.item.name)+"&loc="+ui.item.dept); }
				$( "#peopleid" ).val( ui.item.peopleid );
				$( "#approvetype" ).val( ui.item.apptype );
        		if($('#typereq').val()==1 && ui.item.name != ''){
        			$('#jenispermin').val(1);
        		} else if($('#typereq').val()==4 && ui.item.name != ''){
		            $('#jenispermin').val(4);
        		} else if($('#typereq').val()==2 && ui.item.name != ''){
		            $('#jenispermin').val(2);
        		} else {
        			$('#jenispermin').val(0);
        		}

        		if($( "#peopleidreference" ).val() == ui.item.peopleid) {
					alert("no pegawai master sama dengan referensi!!");
					resetgm();
				}
        	}
        	
        	return false;
		} 
    });
    // $('#hwid').click({
    // 	$('#report_name').focus();
    // });
    
});

function cecep(id){
	if($('#trep').val() == 1 && $("#peopleid").val()==''){
		alert("No Pegawai tidak terdaftar!\n Silahkan hubungi IT");
		$('#nogm').val("");
		$('#nogm').focus();
	}
}

</script>