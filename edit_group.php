<?php 
require('include/include.php');
require('header.php');
$system_msg='';
$course = '';
$course1 = '';
if(isset($_GET['action']) && $_GET['action'] == 'msg_fail_edit'){
	$system_msg .= systemMsg('alert-danger','Fail!','Fail to Edit Group.');
}elseif(isset($_GET['action']) && $_GET['action'] == 'msg_success_edit'){
	$system_msg .= systemMsg('alert-success','Success!','Successfully Edit Group.');	
}

if(isset($_SESSION['dp']) && $_SESSION['dp'] == 'Department Head'){
	$course .= " AND c_id = '".$_SESSION['course']."'";
	$course1 .= " AND id = '".$_SESSION['course']."'";
}else{
	$course = '';
	$course1 = '';
}

$qry = "SELECT * FROM student_group WHERE g_status = 'ACTIVE' AND id = '".$_GET['id']."'";
$result = mysqli_query($conn, $qry);
$row = mysqli_fetch_array($result);

$sql2=mysqli_query($conn,"select * from semester_break where g_id='".$_GET["id"]."'");
$num=mysqli_num_rows($sql2);

?>
    <!-- Page Content -->
    <div class="container">
<?php if(isset($system_msg)){echo $system_msg;}?>
        <!-- Page Header -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Edit Group
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
        <form class="form-horizontal" method="post" action="add_group.php?action=edit&id=<?=$row[0]?>" enctype="multipart/form-data">    
        <div class="col-md-5">
            <div class="form-group">
            <label>Group Name</label>
            <input type="text" class="form-control" name="gname" value="<?=$row['g_name']?>" required>
            </div>
			
			<div class="form-group">
            <label>JPK Start Date</label>
            <div class="input-group date form_date" data-date="" data-date-format="dd-mm-yyyy" data-link-field="sd" data-link-format="yyyy-mm-dd">
            <input class="form-control" size="16" type="text" value="<?=$row['start_date']?>" required >
            <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
            </div>
            <input type="hidden" name="sd" id="sd" value="<?=$row['start_date']?>" />
            </div>
			
			<div class="form-group">
            <label>JPK End Date</label>
            <div class="input-group date form_date" data-date="" data-date-format="dd-mm-yyyy" data-link-field="ed" data-link-format="yyyy-mm-dd">
            <input class="form-control" size="16" type="text" value="<?=$row['end_date']?>" required >
            <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
            </div>
            <input type="hidden" name="ed" id="ed" value="<?=$row['end_date']?>" />
            </div>
            <div class="form-group">
            <label>Level</label>
            <select name="level" class="form-control" required>
                <option value="">Choose</option>
                <option value="2" <?php if($row['g_level'] == '2'){ echo 'selected';}?>>2</option>
                <option value="3" <?php if($row['g_level'] == '3'){ echo 'selected';}?>>3</option>
                <option value="4" <?php if($row['g_level'] == '4'){ echo 'selected';}?>>4</option>
                <option value="Single Tier" <?php if($row['g_level'] == 'Single Tier'){ echo 'selected';}?>>Single Tier</option>
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
                <option value="<?=$c_row['id']?>" <?php if($row['c_id'] == $c_row['id']){ echo 'selected';}?>><?=$c_row['course']?></option>
                <?php } ?>
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
            <?php if($row['g_level'] == '2'){?>
            <div class="form-group">
                <label>Exam Date</label>
                <input type="text" name="daterange" value="" class="form-control" value="123" required/>
            </div> 
            <?php }elseif($row['g_level'] == '3'){?>
            <div class="form-group">
                <label>Exam Date</label>
                <input type="text" name="daterange1" value="" class="form-control" value="123" required/>
            </div> 
            <?php }elseif($row['g_level'] == 'Single Tier'){?>
            <div class="form-group">
                <label>Level 3 Exam Date</label>
                <input type="text" name="daterange" value="" class="form-control" value="<?$row["exam2_sdate"]?> - <?$row["exam2_edate"]?>" required/>
            </div>
            
            <div class="form-group">
                <label>Level 4 Exam Date</label>
                <input type="text" name="daterange1" value="" class="form-control" value="<?$row["exam3_sdate"]?> - <?$row["exam3_edate"]?>" required/>
            </div> 
            <?php }?>
     
		</div>
        <div class="col-md-12">
        <div class="form-group">
        <?php if($num<=0){ ?>
            <div class="col-md-12"><label>semester break</label><button type="button" id="btn"  class="btn btn-success"><span class="glyphicon glyphicon-plus"></span></button></div>
            <div id="ses">
                <div class="col-lg-4">
                    <select class="form-control" name="semester_type[]">
                        <option value="">Choose</option>
                        <option value="Internal exam break">Internal exam</option>
                        <option value="Semester Exam">semester exam</option>
                        <option value="Final exam date">Final exam date</option>
                    </select>
                </div>
                <div class="col-lg-4">
                   
                    <input type="date" class="form-control" size="16" type="text" name="startdate[]" value="<?=$row['start_date']?>" required >
                    
                </div>
                <div class="col-lg-4">
                    <input type="date" class="form-control" size="16" type="text" name="enddate[]" value="<?=$row['start_date']?>" required >
                    
                </div>
                <br><br>
                
            </div>
            
         </div>
         <div id="semester" class="form-group">
        </div>
        <?php }else{ 
        while($result=mysqli_fetch_array($sql2)){    
        ?>
            <div class="col-md-4">      
            <label>holiday type:</label>
            
            <input type="text" class="form-control" name="break_type[]" value='<?=$result["break_type"]?>' />
            </div>
            <div class="col-md-4">      
            <label> Holiday Start:</label>
            <input type="date" class="form-control" name="break_type[]" value='<?=$result["break_date"]?>' />
            </div>
            <div class="col-md-4">      
            <label> Holiday end:</label>
            <input type="date" class="form-control" name="break_type[]" value='<?=$result["break_date_to"]?>' />
            </div>
        <?php }} ?>
        </div>
        <div class="col-md-12">
            <div class="form-group">
            	<button type="submit" class="btn btn-primary" name="submit" value="update"><i class=""></i> Save </button>
            </div>
        </div>
        </form>
</div>
        </div>
        <!-- /.row -->
<?php require('footer.php');?>
<script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />
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
	$("#jpkpp").empty();
	$("#pp").empty();
	$("#jpkpp").append('<option value="">Choose</option>');
	$("#pp").append('<option value="">Choose</option>');
	var val = $("#course").val();
	$.post("pp.php", { value: val },  
		function(result){  
			$("#jpkpp").append(result);
			$("#pp").append(result);
			$('.selectpicker').selectpicker('refresh');
			$('#jpkpp').selectpicker('val', <?=$row['jpk_pp_id']?>);
			$('#pp').selectpicker('val', <?=$row['p_id']?>);
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

<script type="text/javascript">
    $(document).ready(function() {
        $('input[name="daterange"]').daterangepicker({
            //minDate: moment().add('days', 7)
                    //minDate: moment().add('days', 7)
                    <?php if(!empty($row['exam2_sdate']) && !empty($row['exam2_edate'])){
                            $date = new DateTime(str_replace("/","-",$row['exam2_sdate']));
                            
                            $date1 = new DateTime(str_replace("/","-",$row['exam2_edate']));
                            $date1->format('d/m/Y');
                    ?>
                    startDate: '<?=$date->format('d/m/Y');;?>',
                    endDate: '<?=$date1->format('d/m/Y');;?>',
                    <?php }?>
                    isInvalidDate: function(date) {
                        return (date.day() == 0 || date.day() == 6);
                    },
                    locale: {
                        format: 'YYYY/MM/DD'
                    }
        });
    });
    $(document).ready(function() {
        $('input[name="daterange1"]').daterangepicker({
            //minDate: moment().add('days', 7)
                    //minDate: moment().add('days', 7)
                    <?php if(!empty($row['exam3_sdate']) && !empty($row['exam3_edate'])){
                            $date = new DateTime(str_replace("/","-",$row['exam3_sdate']));
                            
                            $date1 = new DateTime(str_replace("/","-",$row['exam3_edate']));
                            $date1->format('d/m/Y');
                    ?>
                    startDate: '<?=$date->format('d/m/Y');;?>',
                    endDate: '<?=$date1->format('d/m/Y');;?>',
                    <?php }?>
                    isInvalidDate: function(date) {
                        return (date.day() == 0 || date.day() == 6);
                    },
                    locale: {
                        format: 'YYYY/MM/DD'
                    }
        });
    });
    $("#btn").on("click", function(){
        
        var a=$("#ses").html();
        $("#semester").append(a);

    });
    
</script>