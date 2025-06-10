<?php
require('include/include.php');
require('header.php');
$system_msg='';
if(isset($_GET['action']) && $_GET['action'] == 'msg_receipt_success_add'){
	$system_msg .= systemMsg('alert-success','Success!','Successfully add receipt.');	
}elseif(isset($_GET['action']) && $_GET['action'] == 'msg_receipt_fail_add'){
	$system_msg .= systemMsg('alert-danger','Fail!','Fail to add receipt.');	
}elseif(isset($_GET['action']) && $_GET['action'] == 'msg_receipt_success_del'){
	$system_msg .= systemMsg('alert-success','Success!','Successfully delete receipt.');	
}elseif(isset($_GET['action']) && $_GET['action'] == 'msg_receipt_fail_del'){
	$system_msg .= systemMsg('alert-danger','Fail!','Fail to delete receipt.');	
}elseif(isset($_GET['action']) && $_GET['action'] == 'msg_receipt_success_clear'){
	$system_msg .= systemMsg('alert-success','Success!','Successfully clear all receipt.');	
}elseif(isset($_GET['action']) && $_GET['action'] == 'msg_receipt_fail_clear'){
	$system_msg .= systemMsg('alert-danger','Fail!','Fail to clear all receipt.');	
}

$c_type = '';
if(isset($_GET['search']) && $_GET['search'] == 'search'){
	if(isset($_GET['c_type']) && !empty($_GET['c_type'])){
		$c_type = " AND f.receipt_type = '".$_GET['c_type']."'";
	}
}
?>
    <!-- Page Content -->
    <div class="container">
<?php 
	if(isset($system_msg)){echo $system_msg;}
	//$qry_rcp = "SELECT * FROM f_receipt WHERE r_status = 'ACTIVE'".$s_name." AND receipt_type = '1' ORDER BY id DESC";
	$qry_rcp = "SELECT *,f.s_name AS old_name FROM f_receipt AS f
				LEFT JOIN student AS s ON s.id = f.s_id
                INNER JOIN login AS l ON l.id = f.createby
				WHERE f.r_status = 'ACTIVE' ".$c_type."ORDER BY f.id DESC";
	$result_rcp = mysqli_query($conn,$qry_rcp);
	$total = '';
?>

		<div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                <p>Receipt List</p>
                </h1>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">	
                <div class="form-group">
                    <form action="f_receipt_list1.php" method="get">
                        <div class="row">
                            <div class="col-lg-3">
                                <label>Search By Cash Bill Type</label>
                                <div id="basic-example">
									<select name="c_type" class="form-control" id="c_type" required>
										<option value="">Choose</option>
										<option value="1">Pusat Kemahiran</option>
										<option value="2">Synergy Central</option>
									</select>
                                </div>
                            </div>
                        </div>
                        <br />
                    
                    <div style="padding: 19px 20px 20px;margin-top: 20px;    margin-bottom: 20px;background-color: #f5f5f5;border-top: 1px solid #e5e5e5;" class="form-group">
                      <div class="row">
                            <div class="col-lg-6">
                            <button type="submit" name="search" value="search" class="btn btn-primary" name="submit">Search</button>
                            </div>
                      </div>
                    </div>
                    </form>
                </div>
            </div>
            
            <!--<div style="overflow-x:auto;"> -->
            <table id="employee-grid" class="table table-bordred table-striped" style="width:100%">
            	<thead>
                	<th>Receipt No.</th>
                	<th style="width: 90px;">Date</th>
                	<th>Name</th>
                	<th>IC</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Create By</th>
                </thead>
            </table>
            <!--</div>-->
            
        </div>
<?php require('footer.php');?>
<script>
 
$(document).ready(function() {
    var dataTable = $('#employee-grid').DataTable( {
        "processing": true,
        "serverSide": true,
        "ajax":{
            url :"receipt_serverside.php", // json datasource
            type: "post",  // method  , by default get
            error: function(){  // error handling
                $(".employee-grid-error").html("");
                $("#employee-grid").append('<tbody class="employee-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
                $("#employee-grid_processing").css("display","none");

            }
        }
    } );
} );

function actionlinks(data, type, full) {

    return '<form method="post" action=""><input type="hidden" id="idcontrib" name="idcontrib" value="' + full[0] + '"><button type="submit" class="btn btn-warning btn-xs" name="edit_contrib">Editar</button>&nbsp;&nbsp;<button type="submit" class="btn btn-danger btn-xs" name="exc_contrib">Excluir</button>&nbsp;&nbsp;<button type="submit" class="btn btn-info btn-xs" name="ativa_contrib">Reativar</button></form> ';

}
</script>