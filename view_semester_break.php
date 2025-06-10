<?php 
include("include/include.php");
include("header.php");

if(isset($_SESSION['level']) && $_SESSION['level'] == 'admin' || $_SESSION['level'] == 'superadmin'){
	$qry = "SELECT *,COUNT(sgl.s_id) AS total_student FROM student_group AS s
			INNER JOIN course AS c ON c.id = s.c_id
            left join (SELECT * FROM student_group_list WHERE status = 'ACTIVE') as sgl on sgl.g_id=s.id
            INNER JOIN student as a on a.id=sgl.s_id
            LEFT JOIN semester_break as sb on sb.g_id=s.id
			WHERE s.g_status = 'ACTIVE' GROUP BY s.id ORDER BY s.end_date DESC";
}elseif($_SESSION['dp'] == 'Department Head'){
	$qry = "SELECT *,COUNT(sgl.s_id) AS total_student FROM student_group AS s
			INNER JOIN course AS c ON c.id = s.c_id
			INNER JOIN course AS c ON c.id = s.c_id
            left join (SELECT * FROM student_group_list WHERE status = 'ACTIVE') as sgl on sgl.g_id=s.id
            INNER JOIN student as a on a.id=sgl.s_id
            LEFT JOIN semester_break as sb on sb.g_id=s.id
			WHERE s.g_status = 'ACTIVE' AND c.id = '".$_SESSION['course']."' GROUP BY s.id ORDER BY s.end_date DESC";
}else{
	$qry = "SELECT *,COUNT(sgl.s_id) AS total_student FROM student_group AS s
			INNER JOIN course AS c ON c.id = s.c_id
            left join (SELECT * FROM student_group_list WHERE status = 'ACTIVE') as sgl on sgl.g_id=s.id
            INNER JOIN student as a on a.id=sgl.s_id
            LEFT JOIN semester_break as sb on sb.g_id=s.id
			WHERE s.g_status = 'ACTIVE' AND c.id = '".$_SESSION['course']."' AND s.p_id = '".$_SESSION['id']."' GROUP BY s.id ORDER BY s.end_date DESC";
}
$result = mysqli_query($conn,$qry);

?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Semester List
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
</div>
<div class="row">
        	<div class="col-md-12">
                <!--<div class="table-responsive">-->
                
                    <table id="example1" class="table table-bordred table-striped" style="width:100%">
                    
                        <thead>
                            <th>Group Name</th>
                            <th>Student Name</th>
                            <th>Semester break start</th>
                            <th>Semester break end</th>
                            <th>Course</th>
                            <th>Level</th>
                        </thead>
                        <tbody>
							<?php while($row = mysqli_fetch_array($result)){?>
                            <tr>
                            <td><?=$row['g_name']?></td>
                            <td><?=$row['s_name']?></td>
                            <td><?=$row['break_date']?></td>
                            <td><?=$row["break_date_to"]?></td>
                            <td><?=$row['course']?></td>
                            <td><?php if($row['g_level'] == 'Single Tier'){ echo 'Level 4 ST';}else{ echo 'Level'.$row['g_level'];}?></td>
                            <!-- <td>
                            <div class="btn-group">
                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Action <span class="caret"></span>
                        </button>
                            <ul class="dropdown-menu  dropdown-menu-right">
                                <li><a href="edit_group.php?id=<?=$row[0]?>"> Edit </a></li>
                                <li><a href="add_group.php?id=<?=$row[0]?>&action=delete" onclick="return confirm('Confirm to Delete this Record?')"> Delete </a></li>
                                <li class="divider"></li>
                                <li><a href="g_signin_list.php?id=<?=$row[0]?>"> View </a></li>
                                <li class="divider"></li>
                                <li><a href="#" data-title="Upload" data-toggle="modal" data-target="#Upload<?=$row[0]?>"> Upload Semester Break </a></li>
                            </ul>
                        </div>
                            </td> -->
                            </tr>                      


<div class="modal fade" id="Upload<?=$row[0]?>" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
      <div class="modal-dialog" style="width:1000px">
    <div class="modal-content">
          <form name="theForm" method="post" action="add_group.php?action=upload&id=<?=$row[0]?>" onSubmit="return(ValidateRequiredFields())" enctype="multipart/form-data" >
          <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
        <h4 class="modal-title custom_align" id="Heading">Bulk Upload</h4>
      </div>
          <div class="modal-body">

            <div class="row">
                <div class="col-xs-6">
                    <div class="form-group">
                        <label>Semester Break Document</label>
                        <input type="file" name="file" required>
                    </div>
                </div>
                
                <!--<div class="col-xs-2">
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary" name="submit_upload">
                            <span class="glyphicon glyphicon-ok"></span> Upload
                        </button>
                    </div>
                </div>-->
            </div>
          </div>
          <div class="modal-footer ">
			<button type="submit" class="btn btn-success btn-lg" style="width: 100%;" name="submit_upload"><span class="glyphicon glyphicon-ok-sign"></span> Add </button>
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
