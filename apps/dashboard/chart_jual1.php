<script type="text/javascript" src="apps/dashboard/jqueryhc.js"></script>
<script src="apps/dashboard/highcharts.js"></script>
<script src="apps/dashboard/exporting.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
		//==========================================================================================================================
      
        $('#container1').highcharts({
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false
            },
            title: {
                text: '10'
            },
            tooltip: {
        	    pointFormat: '{series.name}: <b>{point.y}</b>'
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                    enabled: false
                    },
                    showInLegend: true
                }
            },
            series: [{
                type: 'pie',
                name: 'Jumlah',
                data: [
				<?php
				$cb=$con->select("trwo a join trdata bon a.id_data=b.id_data
                    join mtagent c on a.id_agent=c.id_agent
                    join mtpegawai d on c.id_pegawai=d.id_pegawai",
				"d.nama_pegawai,b.status_data,a.id_agent",
				"a.id_agent like '%' group by a.id_agent limit 0,10");
                
				$jum=count($cb);
				if($jum>0){
						foreach($cb as $pros){
							echo"{name:'$pros[nama_pegawai]', y:$pros[status_data],id:'$pros[id_agent]'},";	
						}
				}else{
						echo "{name:'kosong',y:0,id:'1'},";	
				}
				?>
                ]
				
            }]
        });
    });
</script>
	


<div class="form-group">
	<div class="col-lg-6">
		<div id="container1" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>
    </div>
	<div class="col-lg-6">
		<div id="container2" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>
    </div>
</div>



