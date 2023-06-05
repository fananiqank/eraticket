
<?php

// $namakecil='Media Nusa Mandiri';
// $namabesar='MEDIA NUSA MANDIRI';
header("Content-type: application/octet-stream");
header("Pragma: no-cache");
header("Expires: 0");
header("Content-type: application/vnd.ms-excel");
        ob_start();
		if($_GET['page']=="lapwo"){
		header("Content-Disposition: attachment; filename=Ticket_Report.xls");
        include('apps/report/wo/lap.php');
		}
		if($_GET['page']=="lapta"){
		header("Content-Disposition: attachment; filename=Tasks_Report.xls");
        include('apps/report/tasks/lap.php');
		}
		if($_GET['page']=="lapreq"){
		header("Content-Disposition: attachment; filename=Request_order_Report.xls");
        include('apps/report/request/lap.php');
		}
		

    ?>
