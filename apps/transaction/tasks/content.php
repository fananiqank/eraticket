
<form class="form-user" id="formku" method="post" action="content.php?p=<?=$_GET[p]?>_s" enctype="multipart/form-data">
    <?php 
        if($_GET[d]) { 
            include "input.php"; 
        } else if($_GET[st]) {
            include "tambah.php"; 
        } else { 
    ?>

            <div align="right"><a href="content.php?p=ta2&st=1" type="button" class="simple-ajax-modal btn btn-warning" >Add New Tasks</a></div><br>
            <table class="table table-bordered table-hover pre-scrollable" id="datatable-ajax" width="100%">
                                <thead>
                                    <tr>
                                        <th width="5%">No</th>
                                        <th width="20%">Tasks</th>
                                        <th width="15%">Category</th>
                                        <th width="15%">Agent</th>
                                        <th width="10%">Priority</th>
                                        <th width="10%">Status</th> 
                                    </tr>
                                </thead>
                                
                                <tbody>
                                </tbody>
                                <input type="hidden" name="hal" id="hal" value="<?=$_GET[p]?>">
            </table>
    <?php } ?>
</form>