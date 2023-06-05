<script type="text/javascript" src="apps/dashboard/jqueryhc.js"></script>
<script src="apps/dashboard/highcharts.js"></script>
<script src="apps/dashboard/exporting.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
		//==========================================================================================================================
        $('#container2').highcharts({
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false
            },
            title: {
                text: '10 Besar Pinjaman Anggota'
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
                	
				$cb=$db->select("transaksi_dtl a 
				inner join transaksi b on a.ID_TRANSAKSI = b.ID_TRANSAKSI
				inner join anggota c on c.ID_ANGGOTA = b.ID_ANGGOTA
				inner join jenis_simpanan d on d.ID_SIMPANAN = a.ID_SIMPANAN",
				"b.ID_ANGGOTA,c.NAMA_ANGGOTA,ifnull(sum(a.DEBET)-sum(a.KREDIT),0) as saldo",
				"c.NAMA_ANGGOTA like '%' and d.TYPE_SIMPANAN = '2'
				group by c.ID_ANGGOTA order by sum(a.DEBET)-sum(a.KREDIT) desc limit 0,10");


				$jum=count($cb);
				if($jum>0){
						foreach($cb as $pros){
							echo"{name:'$pros[NAMA_ANGGOTA]', y:$pros[saldo],id:'$pros[ID_ANGGOTA]'},";	
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
	
	<div class="col-lg-6">
		<div id="container2" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>
    </div>





