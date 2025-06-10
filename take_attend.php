<?php 
require('include/include.php');
require('header.php');
$system_msg='';
if(isset($_GET['action']) && $_GET['action'] == 'msg_fail_add'){
	$system_msg .= systemMsg('alert-danger','Fail!','Fail to add Take Attendance.');
}elseif(isset($_GET['action']) && $_GET['action'] == 'msg_success_add'){
	$system_msg .= systemMsg('alert-success','Success!','Successfully Take Attendance.');	
}

if(isset($_SESSION['level']) && $_SESSION['level'] == 'admin' || $_SESSION['level'] == 'superadmin'){
	$level = "";
}elseif($_SESSION['dp'] == 'Department Head'){
	$level = " AND c.id = '".$_SESSION['course']."'";
}elseif($_SESSION['dp'] == 'Department Lecturer'){
	$level = " AND sgll.p_id = '".$_SESSION['id']."'";
}

?>
<link href="//cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/e8bddc60e73c1ec2475f827be36e1957af72e2ea/build/css/bootstrap-datetimepicker.css" rel="stylesheet">
<link rel="stylesheet" href="css/bootstrap-multiselect.css" type="text/css"/>
    <!-- Page Content -->
    <div class="container">
<?php if(isset($system_msg)){echo $system_msg;}?>
        <!-- Page Header -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Take Attendance Form
                    <!--<small>Secondary Text</small>-->
                </h1>
            </div>
        </div>
        <!-- /.row -->

        <!-- Projects Row -->
        <div class="row">
        
<div class="panel panel-info">
    <header class="panel-heading">
    <h3 class="panel-title">Attendance Information</h3>
    </header>
    <div class="panel-body">
        <form class="form-horizontal" method="post" action="add_attend.php" enctype="multipart/form-data">    
        <div class="col-md-5">
            <div class="form-group">
                <label>Attend Time</label>
                <div class='input-group date' id='datetimepicker1'>
                    <input type='text' class="form-control" name="time" required/>
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
            </div>
            <div class="form-group">
            <label>Student</label><br>
            <select class="selectpicker" name="name[]" id="name" data-live-search="true" multiple required>
            <?php
            $s_qry="SELECT *, stu.course as new_course FROM student AS stu
                  LEFT JOIN course AS c ON c.course = stu.course
                  LEFT JOIN (SELECT sg1.g_level, tt.s_id, sg1.g_name, sg1.p_id
                            FROM student_group_list AS tt
                            INNER JOIN student_group AS sg1 on sg1.id = tt.g_id
                            INNER JOIN
                                (SELECT MAX(sg.g_level) AS g_level, sgl.id, sgl.s_id FROM student_group_list AS sgl
                                INNER JOIN student_group AS sg on sg.id = sgl.g_id
                                WHERE sgl.status = 'ACTIVE' GROUP BY sgl.s_id) groupedtt ON tt.s_id = groupedtt.s_id 
                            WHERE sg1.g_level = groupedtt.g_level AND tt.status = 'ACTIVE') AS sgll ON sgll.s_id = stu.id
                  WHERE stu.s_status = 'ACTIVE'".$level."
                  ORDER BY stu.s_name ASC";
            $s_result = mysqli_query($conn,$s_qry);
            while($s_row = mysqli_fetch_array($s_result)){
            ?>
            <option value="<?=$s_row[0]?>"><?=$s_row['s_name']?></option>
            <?php
            }
            ?>
            </select>
            </div>
        <div class="col-md-12">
            <div class="form-group">
            	<button type="submit" class="btn btn-primary" name="submit" value="save"><i class=""></i> Save </button>
            </div>
        </div>
        </form>
     
	</div>
</div>
        </div>
        <!-- /.row -->
<?php require('footer.php');?>
<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.js"></script>
<script src="//cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/e8bddc60e73c1ec2475f827be36e1957af72e2ea/src/js/bootstrap-datetimepicker.js"></script>
    <script type="text/javascript">
    $(function () {
        $('#datetimepicker1').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss'
        });
    });
</script>
<script type="text/javascript" src="js/bootstrap-multiselect.js"></script>
