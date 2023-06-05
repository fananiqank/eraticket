<div align="right"><!-- <a href="apps/wo/modal2.php?st=tambah" type="button" class="simple-ajax-modal btn btn-warning" ><i class="fa fa-cloud"></i>Tambah Request</a> --></div><br>
<table class="table table-bordered table-hover pre-scrollable" id="datatable-ajax" width="100%">
                                <thead>
                                    <tr>
                                        <th width="5%">No</th>
                                        <th width="15%">No Ticket</th>
                                        <th width="15%">HW ID</th>
                                        <th width="15%">Department</th>
                                        <th width="15%">Name</th>
                                        <th width="20%">Date</th>
                                        <th width="10%">Priority</th>
                                        <th width="10%">Status</th> 
                                    </tr>
                                </thead>
                                
                                <tbody style="overflow-x: auto">
                                </tbody>
                                <input type="hidden" name="hal" id="hal" value="<?=$_GET[p]?>">
                                <input type="hidden" name="isiass" id="isiass" value="<?=$_GET[d]?>">
                            </table>

   <style>
                background-color: #4CAF50; /* Green */
              border: none;
              color: white;
              padding: 20px;
              text-align: center;
              text-decoration: none;
              display: inline-block;
              font-size: 16px;
              margin: 4px 2px;
              cursor: pointer;
        </style>    