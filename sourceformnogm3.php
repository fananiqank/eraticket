<?php if($_GET['typereq'] == 4){ ?>
<div class="col-sm-2" style="vertical-align: middle;">
	<strong>NoPeg</strong>
</div>
<div class="col-sm-7"  id="coldepas">
	<div class="input-group input-group-icon" id="nogmshow" style="display:block">
		<input name="nogm3" id="nogm3" type="text" class="form-control nonogm2 input-sm" style="text-transform: uppercase;" onblur="cecep2(this.value)" placeholder="Search No Peg / Name"/>
		<input type="hidden" name="peopleidreference" id="peopleidreference">
		<span style="font-size:8px;">* No.Peg sesuai dengan Payroll</span>
	</div>
	
</div>
<div class="col-sm-1"><span class="btn btn-primary btn-sm" onclick="resetgm2()"><i class="fa fa-refresh"></i></span></div>
<?php } ?>
<script type="text/javascript">

$(function() {
    $( ".nonogm2" ).autocomplete({
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
                document.getElementById("nogm3").readOnly = true; 
                $('#detailreplace2').show();
				$('#detailreplace2').load("sourceformdetailreplace2.php?reload=1&name="+encodeURI(ui.item.name)+"&loc="+ui.item.dept); 
				$( "#peopleidreference" ).val( ui.item.peopleid );
				if($( "#peopleid" ).val() == ui.item.peopleid) {
					alert("no pegawai referensi sama dengan master!!");
					resetgm2();
				}
        	}
        	
        	return false;
		} 
    });
    // $('#hwid').click({
    // 	$('#report_name').focus();
    // });
    
});

function resetgm2(){
			document.getElementById("nogm3").readOnly = false;
			$( "#nogm3" ).val('');
			$( "#peopleidreference" ).val('');
	   		$('#detailreplace2').load("sourceformdetailreplace2.php");
		}

function cecep2(id){
	if($('#trep').val() == 1 && $("#peopleidreference").val()==''){
		alert("No Pegawai tidak terdaftar!\n Silahkan hubungi IT");
		$('#nogm3').val("");
		$('#nogm3').focus();
	}
}
</script>