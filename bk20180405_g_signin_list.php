<?php
require('include/include.php');
require('header.php');
define('DATE_TODAY1', date('Y-m-d'));

$system_msg='';
if(isset($_GET['action']) && $_GET['action'] == 'msg_success_add'){
	$system_msg .= systemMsg('alert-success','Success!','Successfully Register Student In.');	
}elseif(isset($_GET['action']) && $_GET['action'] == 'msg_login_success'){
	$system_msg .= systemMsg('alert-success','Welcome',$_SESSION['name']);	
}elseif(isset($_GET['action']) && $_GET['action'] == 'msg_success_del'){
	$system_msg .= systemMsg('alert-success','Success!','Successfully delete.');	
}elseif(isset($_GET['action']) && $_GET['action'] == 'msg_fail_del'){
	$system_msg .= systemMsg('alert-danger','Fail!','Fail to delete.');
}elseif(isset($_GET['action']) && $_GET['action'] == 'msg_fail_add'){
	$system_msg .= systemMsg('alert-danger','Fail!','Fail to Register Student In.');
}elseif(isset($_GET['action']) && $_GET['action'] == 'msg_fail_update'){
	$system_msg .= systemMsg('alert-danger','Fail!','Fail to Update Student Info.');
}

$s_name = '';
if(isset($_GET['search']) && $_GET['search'] == 'search'){
	$s_name .= " AND s_name LIKE '%".$_GET['name']."%'";
}else{
	$s_name = '';
}
?>
<!-- Page Content -->

<div class="container-fluid">
  <?php 
	if(isset($system_msg)){echo $system_msg;}
	
mysqli_set_charset($conn, 'utf8');	

$qry = "SELECT * FROM student_group AS s
		INNER JOIN course AS c ON c.id = s.c_id
		WHERE s.id = '".$_GET['id']."'";
$result = mysqli_query($conn,$qry);
$row = mysqli_fetch_array($result);
	
$qry1 = "SELECT * FROM student_group_list AS sgl
		INNER JOIN student AS s ON s.id = sgl.s_id
		WHERE sgl.g_id = '".$_GET['id']."' AND sgl.status = 'ACTIVE'";
$result1 =mysqli_query($conn,$qry1);
?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Group (<?=$row['g_name']?> - <?=$row['course']?>)
            <!--<small>Secondary Text</small>-->
        </h1>
    </div>
    <div class="col-md-12">	
        <div class="form-group">
            <form action="g_signin.php?group=<?=$_GET['id']?>" method="post">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="form-group">
                        <input type="hidden" value="<?=$row['course']?>" id="v1">
                        <input type="hidden" value="<?=$row['g_level']?>" id="v2">
                        <input class="form-check-input" type="checkbox" value="manage" id="checkgroup">
                        <label class="form-check-label" for="defaultCheck1">
                        Tick if want to manage old Group.
                        </label>
                        </div>
                        
                        <div class="form-group">
                        <label>Register Student In</label>
						<select class="selectpicker" name="name" id="name" data-live-search="true" required>
						<option value="">Choose</option>
						<?php
							/*if($row['g_level'] == '2'){
								$level = " AND course = 'Testing'";
							}else{*/
								$level = " AND s.course = '".$row['course']."' AND s.id NOT IN (SELECT sgl.s_id FROM student_group_list AS sgl INNER JOIN student_group AS sg ON sg.id = sgl.g_id WHERE sg.g_level = '".$row['g_level']."' AND status = 'ACTIVE')";
							/*}*/
						echo $s_qty = "SELECT s.id,s_name FROM student AS s WHERE s.s_status = 'ACTIVE'".$level;	
						$s_result = mysqli_query($conn, $s_qty);
						while($s_row = mysqli_fetch_array($s_result)){
							$s_qty1 = "SELECT * FROM student AS s
										LEFT JOIN (SELECT sg.start_date, sg.end_date, sgl.s_id, sg.g_level FROM student_group AS sg
													INNER JOIN student_group_list AS sgl ON sgl.g_id = sg.id
													WHERE sgl.s_id = '".$s_row['id']."' AND sg.g_status = 'ACTIVE' AND sgl.status = 'ACTIVE' 
													ORDER BY sg.g_level DESC LIMIT 1) AS ss ON ss.s_id = s.id
													WHERE s.id = '".$s_row['id']."'";
							$s_result1 = mysqli_query($conn, $s_qty1);
							$s_row1 = mysqli_fetch_array($s_result1);
							if($s_row1['end_date'] < DATE_TODAY1 && ($s_row1['g_level'] != '4' && $s_row1['g_level'] != 'Single Tier')){
						?>
						<option value="<?=$s_row['id']?>"><?=$s_row['s_name']?></option>
						<?php
							}
						}
						?>
						</select>
                        </div>
                        
                        <div class="form-group">
                        <label>File Name</label>
                        <input type="text" name="fname" class="form-control" >
                        </div>
                        
                        <div class="form-group">
                            <label>Payment Type</label>
                            <select name="loan" class="form-control" id="loan" required>
                                <option value="">Choose</option>
                                <option value="None">None</option>
                                <option value="Penanguhan">Penanguhan</option>
                                <option value="Pay Monthly">Pay Monthly</option>
                            </select>
                        </div>
                        
				        <div id="step1"></div>
                    </div>
                </div>
                <br />
            
            <div style="padding: 19px 20px 20px;margin-top: 20px;    margin-bottom: 20px;background-color: #f5f5f5;border-top: 1px solid #e5e5e5;" class="form-group">
              <div class="row">
                    <div class="col-lg-6">
                    <button type="submit" name="submit" value="add" class="btn btn-primary" name="submit">Add</button>
                    </div>
              </div>
            </div>
            </form>
        </div>
    </div>
</div>
<div class="row">
        	<div class="col-md-12">
                <!--<div class="table-responsive">-->
                
                    <table id="example1" class="table table-bordred table-striped" style="width:100%">
                    
                        <thead>
                            <th>Student Name</th>
                            <th>Student IC</th>
                            <th>File Name</th>
                            <th>Payment Type</th>
                            <th>Amount</th>
                            <th>Bank Draf No</th>
                            <th>Bank Draf Date</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
							<?php while($row1 = mysqli_fetch_array($result1)){?>
                            <tr>
                            <td><?=$row1['s_name']?></td>
                            <td><?=$row1['ic']?></td>
                            <!--<td>
                                <form method="post" action="g_signin.php?action=update&id=<?=$row1[0]?>&group=<?=$_GET['id']?>">
                                    <input type="text" name="fname" class="form-control" value="<?=$row1['file_name']?>">
                                    <button type="submit" name="update" class="btn btn-warning">Update</button>
                                </form>
                            </td>-->
                            <td><?=$row1['file_name']?></td>
                            <?php if($row1['payment_type'] == 'Penanguhan'){?>
                            <td><?=$row1['payment_type']?></td>
                            <td><?=$row1['amount']?></td>
                            <td><?=$row1['bank_draf_no']?></td>
                            <td><?=$row1['bank_draf_date']?></td>
                            <?php }else{?>
                            <td colspan="4" style="text-align: center;"><?=$row1['payment_type']?></td>
                            <?php }?>
                            <td>
                            <div class="btn-group">
                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Action <span class="caret"></span>
                        </button>
                            <ul class="dropdown-menu  dropdown-menu-right">
                                <li><a href="#" data-title="Add" data-toggle="modal" data-target="#edit<?=$row1[2]?>" type="button" class="edit_button" id="edit_button"> Edit </a></li>
                                <li><a href="g_signin.php?id=<?=$row1[0]?>&group=<?=$_GET['id']?>&action=delete" onclick="return confirm('Confirm to Delete this Record?')"> Delete </a></li>
                            </ul>
                        </div>
                            </td>
                            </tr>
                            

<div class="modal fade" id="edit<?=$row1[2]?>" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
      <div class="modal-dialog" style="width:1000px">
    <div class="modal-content">
          <form name="theForm" method="post" action="g_signin.php?action=update&id=<?=$row1[0]?>&group=<?=$_GET['id']?>" id="editform">
          <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
        <h4 class="modal-title custom_align" id="Heading">Group (<?=$row['g_name']?> - <?=$row['course']?>)</h4>
      </div>
          <div class="modal-body">

  <div class="row">
        <div class="col-md-12">
            <div class="col-md-6">
                
                <div class="form-group">
                    <label>File Name</label>
                    <input id="esa" class="form-control" name="file_name" type="text" value="<?=$row1['file_name']?>" placeholder="">
                </div>
                
                <div class="form-group">
                    <label>Payment Type</label>
                    <select name="payment_type" class="form-control" id="loan" required>
                        <option value="">Choose</option>
                        <option value="None" <?php if($row1['payment_type'] == 'None'){ echo 'selected';}?>>None</option>
                        <option value="Penanguhan" <?php if($row1['payment_type'] == 'Penanguhan'){ echo 'selected';}?>>Penanguhan</option>
                        <option value="Pay Monthly" <?php if($row1['payment_type'] == 'Pay Monthly'){ echo 'selected';}?>>Pay Monthly</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label>Amount</label>
                    <input id="ess" class="form-control" name="amount" type="text" value="<?=$row1['amount']?>" placeholder="">
                </div>
                
                <div class="form-group">
                    <label>Bank Draf Date</label>
                    <div class="input-group date form_date" data-date="" data-date-format="dd-mm-yyyy" data-link-field="bdd<?=$row1[2]?>" data-link-format="yyyy-mm-dd">
                    <input class="form-control" size="16" type="text" value="<?=$row1['bank_draf_date']?>">
                    <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                    </div>
                    <input type="hidden" name="bank_draf_date" id="bdd<?=$row1[2]?>" value="">
                </div>
                
                <div class="form-group">
                    <label>Bank Draf No</label>
                    <input id="espc" class="form-control" name="bank_draf_no" type="text" value="<?=$row1['bank_draf_no']?>" placeholder="" >
                </div>
            </div>
        </div>
  </div>
          </div>
          <div class="modal-footer ">
			<button type="submit" id="update" class="btn btn-warning btn-lg" style="width: 100%;"><span class="glyphicon glyphicon-ok-sign"></span> update </button>
      </div>
      		</form>
        </div>
    <!-- /.modal-content --> 
  </div>
      <!-- /.modal-dialog --> 
    </div>
                            <?php }?>
                        </tbody>
                    </table>
                <!--</div>-->
            </div>
</div>
       

  <!-- /.row -->
  <?php require('footer.php');?>
    
<script>
$('#checkgroup').on('change', function(){
    var selected = $(this).val();
    var v1 = $('#v1').val();
    var v2 = $('#v2').val();
		$("#name").empty();
		$("#name").append('<option value="">Choose</option>');
    if(this.checked) {
        $.post("manage.php", { value: selected, v1: v1, v2: v2, v3: '1' },  
            function(result){  
        		$("#name").append(result);
				$('.selectpicker').selectpicker('refresh');
            });  
    }else{
        $.post("manage.php", { value: selected, v1: v1, v2: v2, v3: '2' },  
            function(result){  
        		$("#name").append(result);
				$('.selectpicker').selectpicker('refresh');
            });
    }
});
</script>
    
<script>
$('#loan').on('change', function(){
    var selected = $('#loan').val();
    //alert(selected);
        //use ajax to run the check  
    $.post("loan_type.php", { value: selected },  
        function(result){  
            $( "#step1" ).html(result);
        });  
});
</script>
