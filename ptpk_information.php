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

?>
    <!-- Page Content -->
    <div class="container">
<?php if(isset($system_msg)){echo $system_msg;}?>
        <!-- Page Header -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Add PTPK Information
                    <!--<small>Secondary Text</small>-->
                </h1>
            </div>
        </div>
        <!-- /.row -->

        <!-- Projects Row -->
        <div class="row">
        
<div class="panel panel-info">
    <header class="panel-heading">
    <h3 class="panel-title">PTPK Information</h3>
    </header>
    <div class="panel-body">
        <form class="form-horizontal" method="post" action="add_ptpk.php" enctype="multipart/form-data">    
        <div class="col-md-5">
            <div class="form-group">
            <label>Name</label>
            <input type="text" class="form-control" name="name" value=""  />
            </div>
			<div class="form-group">
            <fieldset>
                <legend>New problem</legend>
                <input disabled='disabled' type="text" id="n_pro" style="width:90%; text-transform:uppercase;" />
                <button type="button" id="btn_pro" class="btn btn-success"><span class="glyphicon glyphicon-plus"></span></button>
            </fieldset>
            <label>Problem</label>
            <!--<input type="text" class="form-control" name="d_icom" value="">-->
            <select name="d_icom" id="d_icom" class='form-control' >
                <option value="">Choose</option>
                <?php $qry_iss=mysqli_query($conn,"select * from ptpk_issue");
                    while($result_iss=mysqli_fetch_array($qry_iss)){

                ?>
                <option value="<?=$result_iss["id"];?>"><?=$result_iss["issue"]?></option>
                <?php }?>
            </select>
            </div>
            <div class="form-group">
            <label>Document complete</label>
            <input type="text" class="form-control" name="d_com" value="" >
            </div>
			<div class="form-group">
            <label>Date</label>
            <div class="input-group date form_date" data-date="" data-date-format="dd-mm-yyyy" data-link-field="sd" data-link-format="yyyy-mm-dd">
            <input class="form-control" size="16" type="text" value="" required >
            <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
            </div>
            <input type="hidden" name="sd" id="sd" value="" />
            </div>
			
            
           
		</div>
		<div class="col-md-2"></div>
        <div class="col-md-5">
        
        <div class="form-group">
            <label>Level</label>
            <select name="level" class="form-control">
                <option value="">Choose</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="Single Tier">Single Tier</option>
            </select>
            </div>
            
            
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
                <label>Attachment</label>
                <input type="file" name="file" class="form-control" id="file"   />
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
$("#btn_pro").on("click",function() {
        var date_select=$('#n_pro').val();
        if($('#n_pro').is('[disabled=disabled]')){
            $('#n_pro').prop("disabled", false);
        }else{
            $.post('ajax.php',{value:date_select},
		function(result){
			$('#d_icom').html(result);
		});
        }

		
});
$("#n_pro").on("click",function(){
    $("n_pro").removeAttr("disabled");
});
	

</script>