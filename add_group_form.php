<?php 
require('include/include.php');
require('header.php');
$system_msg='';
$course = '';
$course1 = '';

if(isset($_GET['action']) && $_GET['action'] == 'msg_fail_add'){
	$system_msg .= systemMsg('alert-danger','Fail!','Fail to add Group.');
}elseif(isset($_GET['action']) && $_GET['action'] == 'msg_success_add'){
	$system_msg .= systemMsg('alert-success','Success!','Successfully add Group.');	
}

if(isset($_SESSION['dp']) && $_SESSION['dp'] == 'Department Head'){
	$course .= " AND c_id = '".$_SESSION['course']."'";
	$course1 .= " AND id = '".$_SESSION['course']."'";
}else{
	$course = '';
	$course1 = '';
}

?>
    <!-- Page Content -->
    <div class="container">
<?php if(isset($system_msg)){echo $system_msg;}?>
        <!-- Page Header -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Add Group Form
                    <!--<small>Secondary Text</small>-->
                </h1>
            </div>
        </div>
        <!-- /.row -->

        <!-- Projects Row -->
        <div class="row">
        
<div class="panel panel-info">
    <header class="panel-heading">
    <h3 class="panel-title">Group Information</h3>
    </header>
    <div class="panel-body">
        <form class="form-horizontal" method="post" action="add_group.php" enctype="multipart/form-data">    
        <div class="col-md-5">
            <div class="form-group">
            <label>Group Name</label>
            <input type="text" class="form-control" name="gname" value="" required>
            </div>
			
			<div class="form-group">
            <label>JPK Start Date</label>
            <div class="input-group date form_date" data-date="" data-date-format="dd-mm-yyyy" data-link-field="sd" data-link-format="yyyy-mm-dd">
            <input class="form-control" size="16" type="text" value="" required >
            <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
            </div>
            <input type="hidden" name="sd" id="sd" value="" />
            </div>
			
			<div class="form-group">
            <label>JPK End Date</label>
            <div class="input-group date form_date" data-date="" data-date-format="dd-mm-yyyy" data-link-field="ed" data-link-format="yyyy-mm-dd">
            <input class="form-control" size="16" type="text" value="" required >
            <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
            </div>
            <input type="hidden" name="ed" id="ed" value="" />
            </div>
            
        <div class="form-group">
            <label>Level</label>
            <select name="level" id="level" class="form-control" required>
                <option value="">Choose</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="Single Tier">Single Tier</option>
            </select>
            </div>
            <div class="form-group" id="remind_date1" style="display:none;">
                <label>Reminder Date lv4</label>
                <div class="input-group date form_date" data-date="" data-date-format="dd-mm-yyyy" data-link-field="date_lv1" data-link-format="yyyy-mm-dd">
                <input class="form-control" size="16" type="text" value=""  >
                <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                </div>
                <input type="hidden" name="date_lv1" id="date_lv1" value="" />
            </div>
            <div class="form-group" id="remind_date2" style="display:none;">
                <label>Reminder Date lv2</label>
                <div class="input-group date form_date" data-date="" data-date-format="dd-mm-yyyy" data-link-field="date_lv2" data-link-format="yyyy-mm-dd">
                <input class="form-control" size="16" type="text" value=""  >
                <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                </div>
                <input type="hidden" name="date_lv2" id="date_lv2" value="" />
                <label>Reminder Date lv3</label>
                <div class="input-group date form_date" data-date="" data-date-format="dd-mm-yyyy" data-link-field="date_lv3" data-link-format="yyyy-mm-dd">
                <input class="form-control" size="16" type="text" value=""  >
                <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                </div>
                <input type="hidden" name="date_lv3" id="date_lv3" value="" />
                <label>Reminder Date lv4</label>
                <div class="input-group date form_date" data-date="" data-date-format="dd-mm-yyyy" data-link-field="date_lv4" data-link-format="yyyy-mm-dd">
                <input class="form-control" size="16" type="text" value=""  >
                <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                </div>
                <input type="hidden" name="date_lv4" id="date_lv4" value="" />
            </div>
		</div>
		<div class="col-md-2"></div>
        <div class="col-md-5">
            
            <div class="form-group">
            <label>Course</label>
            <select name="course" class="form-control" id="course" required>
                <option value="">Choose</option>
                <?php
					$c_qry = "SELECT * FROM course WHERE status = 'ACTIVE'".$course1;
					$c_result = mysqli_query($conn,$c_qry);
					while($c_row = mysqli_fetch_array($c_result)){
				?>
                <option value="<?=$c_row['id']?>"><?=$c_row['course']?></option>
                <?php }?>
            </select>
            </div>
			
            <div class="form-group">
            <label>JPK PP</label><br>
            <select class="selectpicker" name="jpkpp" id="jpkpp" data-live-search="true" required>
                <option value="">Choose</option>
                <?php
					$c_qry1 = "SELECT * FROM login WHERE level = 'pp' AND l_status = 'ACTIVE'".$course;
					$c_result1 = mysqli_query($conn,$c_qry1);
					while($c_row1 = mysqli_fetch_array($c_result1)){
				?>
                <option value="<?=$c_row1['id']?>"><?=$c_row1['l_name']?></option>
                <?php }?>
            </select>
            </div>
			
            <div class="form-group">
            <label>College PP</label><br>
            <select class="selectpicker" name="pp" id="pp" data-live-search="true" required>
                <option value="">Choose</option>
                <?php
					$c_qry1 = "SELECT * FROM login WHERE level = 'pp' AND l_status = 'ACTIVE'".$course;
					$c_result1 = mysqli_query($conn,$c_qry1);
					while($c_row1 = mysqli_fetch_array($c_result1)){
				?>
                <option value="<?=$c_row1['id']?>"><?=$c_row1['l_name']?></option>
                <?php }?>
            </select>
            </div>
     
		</div>
        
        <div class="col-md-12">
            <div class="form-group">
            	<button type="submit" class="btn btn-primary" name="submit" value="save"><i class=""></i> Save </button>
            </div>
        </div>
        </form>
</div>
        </div>
        <!-- /.row -->
<?php require('footer.php');?>
<script>
$(document).ready(function () {
    $("#course").change(function () {
		$("#jpkpp").empty();
		$("#pp").empty();
		$("#jpkpp").append('<option value="">Choose</option>');
		$("#pp").append('<option value="">Choose</option>');
        var val = $(this).val();
        $.post("pp.php", { value: val },  
            function(result){  
        		$("#jpkpp").append(result);
        		$("#pp").append(result);
				$('.selectpicker').selectpicker('refresh');
            }); 
    });
});
$(document).ready(function () {
    $("#level").change(function(){
       var a=$("#level").val();
       var div1=$("#remind_date1");
       var div2=$("#remind_date2");
       //var text_date='<div class="input-group date form_date" data-date="" data-date-format="dd-mm-yyyy" data-link-field="text_date1" data-link-format="yyyy-mm-dd"><input class="form-control" size="16" type="text" value="" ><span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span><span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span></div><input type="hidden" name="text_date1" id="text_date1" value="" />';
       if(a=="4"){
            div1.removeAttr("style");
            div2.attr("style","display:none;")
       }else if(a=="Single Tier"){
            div2.removeAttr("style");
            div1.attr("style","display:none;")
       }
    });
});
</script>