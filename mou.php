<?php 
include('include/include.php');
include('header.php');

$cor=array("5","3","2","4","1",'0');
$cor_name=array("PROGRAMMING","MULTIMEDIA","ELECTRONIC","NETWORKING","ACCOUNTING","ALL");



if(isset($_GET['sl_name']) && !empty($_GET['sl_name'])){
  $get_sl_name = $_GET['sl_name'];
}else{
  $get_sl_name = '';
}
$system_msg='';
if(isset($_GET['action']) && $_GET['action'] == 'msg_success_add'){
	$system_msg .= systemMsg('alert-success','Success!','Successfully add MOU.');	
}elseif(isset($_GET['action']) && $_GET['action'] == 'msg_fail_add'){
	$system_msg .= systemMsg('alert-danger','Fail!','Fail to insert mou');	
}elseif(isset($_GET['action']) && $_GET['action'] == 'msg_success_edit'){
	$system_msg .= systemMsg('alert-success','success!','success edit mou');	
}elseif(isset($_GET['action']) && $_GET['action'] == 'msg_fail_edit'){
	$system_msg .= systemMsg('alert-danger','Fail!','Fail to edit mou');	
}elseif(isset($_GET['action']) && $_GET['action'] == 'msg_success_del'){
	$system_msg .= systemMsg('alert-success','Fail!','Success delete');	
}elseif(isset($_GET['action']) && $_GET['action'] == 'msg_fail_del'){
	$system_msg .= systemMsg('alert-danger','Fail!','Fail to Delete');	
}
$status = '';

$name_sl = mysqli_real_escape_string($conn,$get_sl_name);

if(isset($_GET['search']) && $_GET['search'] == 'search'){
	if(isset($_GET['status']) && $_GET['status'] == 'active'){
		$status .= " AND stu.s_status = 'ACTIVE' ";
	}elseif(isset($_GET['status']) && $_GET['status'] == 'graduate'){
		$status .= " AND stu.s_status = 'GRADUATE' ";
	}elseif(isset($_GET['status']) && $_GET['status'] == 'quit'){
		$status .= " AND stu.s_status = 'QUIT' ";
	}
		
}else{
    $status .= " AND stu.s_status = 'ACTIVE' ";
}
	
?>
<!-- Page Content -->

<div class="container-fluid">
  <?php 
	if(isset($system_msg)){echo $system_msg;}
	
mysqli_set_charset($conn, 'utf8');	


if(isset($_SESSION['level']) && $_SESSION['level'] == 'admin' || $_SESSION['level'] == 'superadmin'){
	$level = "";
}elseif($_SESSION['dp'] == 'Department Head'){
	$level = "AND c.id = '".$_SESSION['course']."'";
}elseif($_SESSION['dp'] == 'Department Lecturer'){
	$level = "AND stu.p_id = '".$_SESSION['id']."'";
}

/*$qry="SELECT * FROM student AS stu
      LEFT JOIN login AS l ON l.id = stu.p_id
	  LEFT JOIN school AS sch ON stu.id = sch.s_id
	  LEFT JOIN course AS c ON c.course = stu.course
      LEFT JOIN (SELECT *,MAX(id) AS new_id FROM student_group_list WHERE status = 'ACTIVE' GROUP BY s_id) AS sgl ON sgl.s_id = stu.id
      LEFT JOIN student_group AS sg on sg.id = sgl.g_id
	  WHERE stu.s_status != 'DELETE' AND (sch.status = 'ACTIVE' || sch.status is NULL) ".$level.$s_name.$sl_name."
	  ORDER BY stu.s_name ASC";
$qry="SELECT *, stu.course as new_course FROM student AS stu
	  LEFT JOIN school AS sch ON stu.id = sch.s_id
	  LEFT JOIN course AS c ON c.course = stu.course
      LEFT JOIN (SELECT *,MAX(id) AS new_id FROM student_group_list WHERE status = 'ACTIVE' GROUP BY s_id) AS sgl ON sgl.s_id = stu.id
      LEFT JOIN student_group AS sg on sg.id = sgl.g_id
	  WHERE (sch.status = 'ACTIVE' || sch.status is NULL) ".$level.$status."
	  ORDER BY stu.s_name ASC";*/
$course="";
if(isset($_GET['btn_5'])){
    $course="where c_id='5'";
}elseif(isset($_GET['btn_3'])){
     $course="where c_id='3'";
}elseif(isset($_GET['btn_1'])){
     $course="where c_id='1'";
}elseif(isset($_GET['btn_2'])){
     $course="where c_id='2'";
}elseif(isset($_GET['btn_4'])){
     $course="where c_id='4'";
}
    
$qry="select * from mou ".$course." order by s_date";
$result = mysqli_query($conn,$qry);
?>
    <style>
        .clicked{
            background-color: white;
            color:red;
            
        }
        .cus{
            cursor: pointer;
        }
        
    </style>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Mou List
            <!--<small>Secondary Text</small>-->
        </h1>
    </div>
    <!--<div class="col-md-12">	
        <div class="form-group">
            <form action="student_list.php" method="get">
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
    </div>-->
            <div class="col-md-12">	
                <div class="form-group">
                    <form action="mou.php" method="get">
                        <!--<div class="row">
                            <div class="col-lg-3">
                                <label>Search By Status</label>
                                <div id="basic-example">
									<select name="status" class="form-control" id="c_type" required>
										<option value="">Choose</option>
										<option value="active">Current Student</option>
										<option value="graduate">Graduate</option>
										<option value="quit">Quit</option>
									</select>
                                </div>
                            </div>
                        </div>-->
                        <div class="row">
                            <div class="col-lg-12">
                                <?php 
                                for($i=0;$i<count($cor);$i++){
                                if($cor[$i]=="0"){
                                   $query=mysqli_query($conn,"select * from mou"); 
                                }
                                else{
                                   $query=mysqli_query($conn,"select * from mou where c_id='".$cor[$i]."'"); 
                                }
                                
                                $cal=mysqli_num_rows($query);
                                ?>
                                <button type="submit" style="margin-right:20px;"  name="btn_<?php echo $cor[$i];?>" value="<?php echo $cor_name[$i];?>" class="btn btn-danger <?php if($_GET['btn_'.$cor[$i]]==$cor_name[$i]){echo 'clicked';} ?>"><?php echo $cor_name[$i].'( '.$cal.' )'; ?></button>
                                <?php } ?>
                            </div>
                        </div>
                        <br />
                    
                    <div style="padding: 19px 20px 20px;margin-top: 20px;   margin-bottom: 20px;background-color: #f5f5f5;border-top: 1px solid #e5e5e5;" class="form-group">
                      <div class="row">
                            <div class="col-lg-12">
                            <!--<button type="submit" name="search" value="search" class="btn btn-primary" name="submit">Search</button>-->
                            <button type="button" style='width:20px;height:20px;background-color:red'></button>
                            PROGRAMMING
                            <button type="button" style='width:20px;height:20px;background-color:yellow'></button>
                            MULTIMEDIA
                            <button type="button" style='width:20px;height:20px;background-color:green'></button>
                            ELECTRONIC 
                            <button type="button" style='width:20px;height:20px;background-color:blue'></button>
                            NETWORKING  
                            <button type="button" style='width:20px;height:20px;background-color:purple'></button>
                            ACCOUNTING
                            <a href="print_mou.php" target="_blank" style="margin-left:10px;" class="btn btn-primary pull-right">Print</a>
                            <a href="register_mou.php" class="btn btn-primary pull-right">Add Mou</a>
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
                            <th>Company Name</th>
                            <th>Company Address</th>
                            <th>Company Tel</th>
                            <th>Course include</th>
                            <th>Period</th>
                            <th>Name</th>
                            <th>Position</th>
                            <th>Tel</th>
                            <th>Email</th>
                            <th>Company website</th>
                            <th>Action</th>  
                        </thead>
                        <tbody>
                          <style>
                            .bg-danger {
                                background-color: #dc3545 !important;
                            }	  
                          </style>
							<?php while($row = mysqli_fetch_array($result)){?>
                            <?php
                            $c_include="";
                            if($row['pro']=="yes"){
                                $c_include.="<button style='width:20px;height:20px;background-color:red'></button>";
                            }
                            if($row['mul']=="yes"){
                                $c_include.="<button style='width:20px;height:20px;background-color:yellow'></button>";
                            }
                            if($row['elc']=="yes"){
                                $c_include.="<button style='width:20px;height:20px;background-color:green'></button>";
                            }
                            if($row['net']=="yes"){
                                $c_include.="<button style='width:20px;height:20px;background-color:blue'></button>";
                            }
                            if($row['acc']=="yes"){
                                $c_include.="<button style='width:20px;height:20px;background-color:purple'></button>";
                            }
    
                            ?>
                            <tr>
                              
                              <td><?=$row['c_name']?></td>
                              <td><?=$row['c_address']?></td>
                              <td><?=$row['c_tel']?></td>
                               <td><?=$c_include;?></td>
                              <td style="font-weight: bold;"><?=$row["s_date"]."-",$row["e_date"]?></td>
                              <td><?=$row['name']?></td>     
                              <td><?=$row['position']?></td>     
                              <td><?=$row['tel']?></td>     
                              <td><?=$row['email']?></td>       
                               <td><a class="cus" onclick="window.open('<?=$row['link']?>', '_blank')" ><?=$row['link']?></a></td>         
                              <td><div class="dropdown">
                                  <button class="btn btn-warning dropdown-toggle " type="button" data-toggle="dropdown">Action<span class="caret"></span></button>
                                  <ul class="dropdown-menu dropdown-menu-right">
                                    <li><a href="edit_mou.php?id=<?=$row[0]?>">Edit</a></li>
                                    
                                    <li><a href="add_mou.php?action=delete&id=<?=$row[0]?>" onclick="return confirm('Are you sure?')">Delete</a></li>

                                    <!--<li class="divider"></li>
                                    <li><a href="internal_exam_fee_list.php?id=<?=$row[0]?>&name=<?=$row['s_name']?>&ic=<?=$row['ic']?>">Internal Exam Fees</a></li>
                                    <li><a href="tuition_fee_list.php?id=<?=$row[0]?>&name=<?=$row['s_name']?>&ic=<?=$row['ic']?>">Tuition Fees</a></li>
                                    <li><a href="hostel_fee_list.php?id=<?=$row[0]?>&name=<?=$row['s_name']?>&ic=<?=$row['ic']?>">Hostel Fees</a></li>-->
                                    
                                    
                                    <!--<li><a href="dateregister.php?&id=<?=$row[0]?>">Date Register</a></li>
                                    <li><a href="personal_form.php?&id=<?=$row[0]?>">Personal File</a></li>
                                    <li><a href="#">Offer Letter</a></li>
                                    <li><a href="#">Rapid Bus Letter</a></li>-->
                                    <li class="divider"></li>
                                  
                                  </ul>
                                </div></td>  
                                  
                                  
                            </tr>
                            <?php }?>
                        </tbody>
                    </table>
                <!--</div>-->
            </div>
</div>
    
       


  <!-- /.row -->
  <?php require('footer.php');?>
<script>
    
$(document).on('click', '#edit_button', function() {
	var id = $(this).data('id');
	
	$('#editform').attr('action', "add_student.php?action=quit&id="+id).submit();
});
</script>