<?php 
require('include/include.php');
require('header.php');
$system_msg='';
if(isset($_GET['action']) && $_GET['action'] == 'msg_fail_edit'){
	$system_msg .= systemMsg('alert-danger','Fail!','Fail to edit Visitor Log.');
}elseif(isset($_GET['action']) && $_GET['action'] == 'msg_success_edit'){
	$system_msg .= systemMsg('alert-success','Success!','Successfully edit Visitor Log.');	
}


$qry = "SELECT * FROM visitor WHERE v_status = 'ACTIVE' AND id = '$_GET[id]' ORDER BY id DESC";
$result = mysqli_query($conn,$qry);
$row = mysqli_fetch_array($result);
?>
    <!-- Page Content -->
    <div class="container">
<?php if(isset($system_msg)){echo $system_msg;}?>
        <!-- Page Header -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Edit Visitor Log
                    <!--<small>Secondary Text</small>-->
                </h1>
            </div>
        </div>
        <!-- /.row -->

        <!-- Projects Row -->
        <div class="row">
        
<div class="panel panel-info">
    <header class="panel-heading">
    <h3 class="panel-title">Visitor Information</h3>
    </header>
    <div class="panel-body">
        <form class="form-horizontal" method="post" action="visitor.php?id=<?=$_GET['id']?>" enctype="multipart/form-data">    
        <div class="col-md-5">
            <div class="form-group">
            <label>Date</label>
            <div class="input-group date form_date" data-date="" data-date-format="dd-mm-yyyy" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
            <input class="form-control" size="16" type="text" value="<?=$row['v_date']?>" >
            <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
            </div>
            <input type="hidden" name="v_date" id="dtp_input2" value="" />
            </div>
            <div class="form-group">
            <label>Student Name</label>
            <input type="text" class="form-control" name="s_name" value="<?=$row['s_name']?>" required>
            </div>
            <div class="form-group">
            <label>Middle School</label>
            <input type="text" class="form-control" name="m_school" value="<?=$row['school_name']?>" required>
            </div>
            <div class="form-group">
            <label>Student Contact</label>
            <input type="tel" class="form-control" name="s_contact" value="<?=$row['s_contact']?>" pattern="^\d{3}-\d{7,8}$" required>e.g 012-3456789
            </div>
            <div class="form-group">
            <label>Parent Contact</label>
            <input type="tel" class="form-control" name="p_contact" value="<?=$row['p_contact']?>" pattern="^\d{3}-\d{7,8}$" required>e.g 012-3456789
            </div>
            <div class="form-group">
            <label>Student Age</label>
            <input type="text" class="form-control" name="s_age" value="<?=$row['s_age']?>" required>
            </div>
            <div class="form-group">
            <label>Address / Location</label>
            <input type="text" class="form-control" name="location" value="<?=$row['v_location']?>" required>
            </div>
            <div class="form-group">
            <label>Status</label>
            <textarea name="desc" class="form-control"><?=$row['v_desc']?></textarea>
            </div>
            <!--<div class="form-group">
            <label>Registered Date</label>
            <div class="input-group date form_date" data-date="" data-date-format="dd-mm-yyyy" data-link-field="dtp_input3" data-link-format="yyyy-mm-dd">
            <input class="form-control" size="16" type="text" value="<?=$row['v_register_date']?>" >
            <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
            </div>
            <input type="hidden" name="r_date" id="dtp_input3" value="" />
            </div>-->
        
        <div class="col-md-12">
            <div class="form-group">
            	<button type="submit" class="btn btn-primary" name="submit" value="edit"><i class=""></i> Save </button>
            </div>
        </div>
        </form>
     
	</div>
</div>
        </div>
        <!-- /.row -->
<?php require('footer.php');?>