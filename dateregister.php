<?php 
require('include/include.php');
require('header.php');
$system_msg='';
if(isset($_GET['action']) && $_GET['action'] == 'msg_fail_add'){
	$system_msg .= systemMsg('alert-danger','Fail!','Fail to add new student.');
}
?>
<?php 
	if(isset($system_msg)){echo $system_msg;}
	
mysqli_set_charset($conn, 'utf8');	
$qry = "SELECT * FROM date_register WHERE s_id='". $_GET['id'] ."' AND status='ACTIVE'";
$result = mysqli_query($conn, $qry);
	
//$result = mysqli_query($conn,$qry.$limit);
?>
    <!-- Page Content -->
    <div class="container">
<?php if(isset($system_msg)){echo $system_msg;}?>
        <!-- Page Header -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">DATE REGISTER
                    <!--<small>Secondary Text</small>-->
                </h1>
            </div>
        </div>
        <!-- /.row -->

        <!-- Projects Row -->
        <div class="row">
        
<div class="panel panel-info">
    <header class="panel-heading">
    <h3 class="panel-title">Date Register</h3>
    </header>
    <div class="panel-body">
        <form class="form-horizontal" method="post" action="add_dateregister.php?id=<?=$_GET['id']?>" enctype="multipart/form-data">    
        <div class="col-md-12 ">
           <div class="form-group">
            <label>Level</label>
            <select name="level" class="form-control" required>
                <option value="2">Level 2</option>
                <option value="3">Level 3</option>
                <option value="4">Level 4</option>
                <option value="Single Tier">Single Tier</option>
            </select>
            </div>
            <div class="form-group ">
            <label>Register Date</label>
            <div class="input-group date form_date" data-date="" data-date-format="dd-mm-yyyy" data-link-field="dtp_input1" data-link-format="yyyy-mm-dd">
            <input class="form-control" size="16" type="text" value="" >
            <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
            </div>
            <input type="hidden" name="r_date" id="dtp_input1" value="" /><br/>
            </div>
            
            <div class="form-group">
            <label>Exam Date</label>
            <div class="input-group date form_date" data-date="" data-date-format="dd-mm-yyyy" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
            <input class="form-control" size="16" type="text" value="" >
            <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
            </div>
            <input type="hidden" name="exam_date" id="dtp_input2" value="" /><br/>
            </div>
           
        <div class="col-md-12 col-md-offset-4">
            <div class="form-group">
            	<button type="submit" class="btn btn-primary" name="submit" value="save_date" style="width:320px;"><i class=""></i> Add </button>
            </div>
        </div>	
        
        
            <div class="col-md-12">
            <div class="row">
            <div class="col-lg-12">
                <div style="overflow-x:auto;"> 
                <table id="mytable" class="table table-bordred table-striped" style="width:100%">
                    <thead>
                        <th>Level</th>
                        <th>Date Register</th>
                        <th>Date Exam</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                    <?php while($row = mysqli_fetch_array($result)){?>
                        <tr>
                            <td><?=$row['level']?></td>
                            <td><?=$row['register_date']?></td>
                            <td><?=$row['exam_date']?></td>
                            <td><div class="dropdown">
                  <button class="btn btn-primary dropdown-toggle " type="button" data-toggle="dropdown">Action<span class="caret"></span></button>
                      <ul class="dropdown-menu dropdown-menu-right">
                        <li><a href="dataregister_edit.php?action=edit_school&id=<?=$_GET['id']?>&sid=<?=$row['id']?>">Edit</a></li>
                        <li><a href="add_dateregister.php?action=delete_date&id=<?=$_GET['id']?>&sid=<?=$row['id']?>">Delete</a></li>
                      </ul>
                    </div></td>
                        </tr>
                    <?php }?>
                    </tbody>
                
                </table>
                </div>
            </div>
        </div>
        </div>
        	
        
       </form>
    </div>  
</div>
</div>
        </div>
     </div>
        <!-- /.row -->
<?php require('footer.php');?>