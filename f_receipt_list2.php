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

$s_name = '';
if(isset($_GET['search']) && $_GET['search'] == 'search'){
	$s_name .= " AND s_name LIKE '%".mysqli_real_escape_string($conn,$_GET['name'])."%'";
}else{
	$s_name = '';
}
?>
    <!-- Page Content -->
    <div class="container">
<?php 
	if(isset($system_msg)){echo $system_msg;}
	
	$qry_rcp = "SELECT * FROM f_receipt WHERE r_status = 'ACTIVE'".$s_name." AND receipt_type = '2' ORDER BY id DESC";
	
	$sql_page = mysqli_query($conn,$qry_rcp);
	$num_page = mysqli_num_rows($sql_page);
	$page_records = $num_page;
	
	$page = new Page();
	$links = new Pagination ($page_records,'20');
	$limit = $links->limit();
		
	$result_rcp = mysqli_query($conn,$qry_rcp.$limit);
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
                    <form action="f_receipt_list2.php" method="get">
                        <div class="row">
                            <div class="col-lg-3">
                                <label>Search Student</label>
                                <div id="basic-example">
                                    <input id="my-input1" class="form-control typeahead" name="name" type="text" value="" style="width:262.5px;" onfocusout="showHint(this.value);">
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
            <table id="mytable" class="table table-bordred table-striped" style="width:100%">
            	<thead>
                	<th>Receipt No.</th>
                	<th style="width: 90px;">Date</th>
                	<th>Name</th>
                	<th>IC</th>
                    <th>Description</th>
                    <th>Price</th>
                	<th>Print</th>
                    <?php if(isset($_SESSION['level']) && $_SESSION['level'] == 'superadmin'){?>
                	<th>Action</th>
                    <?php }?>
                </thead>
                <tbody>
                <?php while($row_rcp = mysqli_fetch_array($result_rcp)){
						$rd_qry = "SELECT rp_desc,rp_amount FROM f_receipt_detail WHERE r_id = '".$row_rcp['id']."'";
						$rd_result = mysqli_query($conn,$rd_qry);
						while($rd_row = mysqli_fetch_array($rd_result)){
							$total[] = $rd_row['rp_amount'];
							$show_total = array_sum($total);
							$desc[] = $rd_row['rp_desc'];
							$show_desc = implode(',',$desc);
						}
							unset($desc);
							unset($total);
				?>
                	<tr>
                    	<td><?=$row_rcp['r_no']?></td>
                    	<td><?=date('Y-m-d', strtotime($row_rcp['r_date']))?></td>
                    	<td><?=$row_rcp['s_name']?></td>
                    	<td><?=$row_rcp['s_ic']?></td>
                        <td><?=$show_desc?></td>
                        <td>RM<?=$show_total?></td>
                    	
                    	<td>
                        <div class="dropdown">
                          <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"> Print <span class="caret"></span></button>
                          <ul class="dropdown-menu dropdown-menu-right">
                            <li><a href="f_print_receipt.php?&id=<?=$row_rcp['id']?>" target="_blank"><i class="icon-print"></i> Print (Synergy Central Academy)</a></li>
                            <li><a href="f_print_receipt1.php?&id=<?=$row_rcp['id']?>" target="_blank"><i class="icon-print"></i> Print (Pusat Kemahiran Telekomunikasi Mikro)</a></li>
                          </ul>
                        </div>
                        </td>
                    <?php if(isset($_SESSION['level']) && $_SESSION['level'] == 'superadmin'){?>
                        <td><div class="dropdown">
                  <button class="btn btn-warning dropdown-toggle" type="button" data-toggle="dropdown"> Action <span class="caret"></span></button>
                  <ul class="dropdown-menu dropdown-menu-right">
                    <li><a href="f_receipt_edit2.php?&id=<?=$row_rcp['id']?>">Edit</a></li>
                    <li><a href="f_receipt2.php?action=delete_receipt&id=<?=$row_rcp['id']?>">Delete</a></li>
                  </ul>
                </div></td>
                    <?php }?>
                    </tr>
                <? }?>
                </tbody>
            
            </table>
            <!--</div>-->
            
        </div>
<?php include('addon/pagination/pagination_footer.php');?>
<?php require('footer.php');?>