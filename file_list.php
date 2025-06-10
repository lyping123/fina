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
	$system_msg .= systemMsg('alert-success','Success!','Successfully add document.');	
}elseif(isset($_GET['action']) && $_GET['action'] == 'msg_fail_add'){
	$system_msg .= systemMsg('alert-danger','Fail!','Fail to insert document');	
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
$cid="";
if(isset($_GET['btn_5'])){
    $course="where d.c_id='5'";
    $cid=5;
}elseif(isset($_GET['btn_3'])){
     $course="where d.c_id='3'";
     $cid=3;
}elseif(isset($_GET['btn_1'])){
     $course="where d.c_id='1'";
     $cid=1;
}elseif(isset($_GET['btn_2'])){
     $course="where d.c_id='2'";
     $cid=2;
}elseif(isset($_GET['btn_4'])){
     $course="where d.c_id='4'";
     $cid=4;
}
    
$qry="select d.*, c.course from document as d 
inner join course as c on c.id=d.c_id 
".$course." ";
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
        <h1 class="page-header">Student document
           
        </h1>
    </div>
    
            <div class="col-md-12">	
                <div class="form-group">
                    <form action="file_list.php" method="get" enctype="multipart/form-data" >
                       
                        <div class="row">
                            <div class="col-lg-12">
                                <?php 
                                for($i=0;$i<count($cor);$i++){
                                if($cor[$i]=="0"){
                                   $query=mysqli_query($conn,"select * from document"); 
                                }
                                else{
                                   $query=mysqli_query($conn,"select * from document where c_id='".$cor[$i]."'"); 
                                }
                                
                                $cal=mysqli_num_rows($query);
                                ?>
                                <button type="submit" style="margin-right:20px;"  name="btn_<?php echo $cor[$i];?>" value="<?php echo $cor_name[$i];?>" class="btn btn-danger <?php if($_GET['btn_'.$cor[$i]]==$cor_name[$i]){echo 'clicked';} ?>"><?php echo $cor_name[$i].'( '.$cal.' )'; ?></button>
                                <?php } ?>
                            </div>
                        </div>
                        <br />
                    </form>
                    <form class="form-horizontal" action="add_file.php" method="POST" enctype="multipart/form-data" >
                    <div style="padding: 19px 20px 20px; margin-bottom: 20px;background-color: #f5f5f5;border-top: 1px solid #e5e5e5;" class="form-group">
                      <div class="row">
                            <div class="col-lg-12">
                            <div class="col-md-3">
                            <input type="hidden" name="course" value="<?=$cid?>" />
                            <!-- <select class="selectpicker" name="name" id="name" data-live-search="true" required>
                                <option value="">Choose</option>
                                
                            </select> -->
                            </div>
                            <div class="col-md-3">
                            <label>upload file</label>
                            <input type="file" name="filename"  />
                            </div>
                            <div class="col-md-6">
                            <button type="submit" name="add_file" class="btn btn-primary pull-right">Add file</button>
                            </div>
                            </form>
                            
                            <!-- <a href="print_mou.php" target="_blank" style="margin-left:10px;" class="btn btn-primary pull-right">Print</a> -->
                           
                            </div>
                      </div>
                    </div>
                    
                </div>
            </div>
</div>
<div class="row">
        	<div class="col-md-12">
                <!--<div class="table-responsive">-->
                
                    <table id="example1" class="table table-bordred table-striped" style="width:100%">
                    
                        <thead>
                            <th>Course</th>
                            <th>Document</th>
                          <th>Action</th>  
                        </thead>
                        <tbody>
                          <style>
                            .bg-danger {
                                background-color: #dc3545 !important;
                            }	  
                          </style>
							<?php while($row = mysqli_fetch_array($result)){?>
                            <tr>
                            
                              <td><?=$row['course']?></td>     
                               <td><a class="cus" target="_blank" href='view_document.php?id=<?=$row['id']?>' ><?=$row['document']?></a></td>         
                              <td><a class="btn btn-danger" href="add_file.php?action=delete&id=<?=$row[0]?>" onclick="return confirm('Are you sure?')">Delete</a></td>  
                                  
                                  
                            </tr>
                            <?php }?>
                        </tbody>
                    </table>
                <!--</div>-->

            </div>

</div>

<?php require('footer.php');?>