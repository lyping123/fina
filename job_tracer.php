<?php 
require('include/include.php');
require('header.php');


?>
<?php

$system_msg='';
if(isset($_GET['action']) && $_GET['action'] == 'msg_success_add'){
	$system_msg .= systemMsg('alert-success','Success!','Job Tracer Successfully Add.');	
}elseif(isset($_GET['action']) && $_GET['action'] == 'msg_fail_add'){
	$system_msg .= systemMsg('alert-danger','Fail!','Job Tracer Fail To Add.');	
}elseif(isset($_GET['action']) && $_GET['action'] == 'msg_login_success'){
	$system_msg .= systemMsg('alert-success','Success!','Welcome <strong>'.$_SESSION['name'].'</strong>');	
}elseif(isset($_GET['action']) && $_GET['action'] == 'msg_success_del'){
	$system_msg .= systemMsg('alert-success','Success!','Job Tracer Successfully Delete.');	
}elseif(isset($_GET['action']) && $_GET['action'] == 'msg_success_edit'){
	$system_msg .= systemMsg('alert-success','Success!','Job Tracer Successfully Update.');	
}elseif(isset($_GET['action']) && $_GET['action'] == 'msg_fail_del'){
	$system_msg .= systemMsg('alert-danger','Success!','Job Tracer Fail To Delete.');	
}elseif(isset($_GET['action']) && $_GET['action'] == 'msg_success_edit'){
	$system_msg .= systemMsg('alert-danger','Success!','Job Tracer Fail To Update.');	
}

$ic = '';
$name = '';
$contact = '';
$batch = '';
$courses = '';
$cpy_name = '';
$school='';
$date='';
$search_status='';
if(isset($_GET['search']) && $_GET['search'] == 'search'){
	$search_status="true";
	if(isset($_GET['course']) && !empty($_GET['course'])){
		
		$courses .= " AND jt.c_id = '".$_GET['course']."'";
	}else{
		$courses .= "";
	}
	if(isset($_GET['ic']) && !empty($_GET['ic'])){
		$ic .= " AND jt.s_ic LIKE '%".$_GET['ic']."%'";
	}else{
		$ic .= "";
	}
	
	/*if(isset($_GET['name']) && !empty($_GET['name'])){
		$name .= " AND jt.s_name LIKE '%".$_GET['name']."%'";
		$name .= " HAVING new_name LIKE '%".clean($_GET['name'])."%'";
	}else{
		$name .= "";
	}
	
	if(isset($_GET['contact']) && !empty($_GET['contact'])){
		$contact .= " AND jt.s_contact LIKE '%".$_GET['contact']."%'";
	}else{
		$contact .= "";
	}

	if(isset($_GET['batch']) && !empty($_GET['batch'])){
		$batch .= " AND jt.batch = '".$_GET['batch']."'";
	}else{
		$batch .= "";
	}

	if(isset($_GET['cpy_name']) && !empty($_GET['cpy_name'])){
		$cpy_name .= " AND MATCH (company_name) AGAINST ('".$_GET['cpy_name']."' in boolean mode)";
	}else{
		$cpy_name .= "";
	}
	if(isset($_GET['s_school']) && !empty($_GET['s_school'])){
		$School .= " AND jt.secondary_school LIKE '%".$_GET['s_school']."%'";
	}else{
		$School .= "";
	}
	if(isset($_GET['searchtype'])&& !empty($_GET['searchtype'])){
		$type=$_GET['searchtype'];
		$searchname=$_GET['name'];
		
		if($type==1){
			$name.= " AND jt.s_name LIKE '%".$searchname."%'";
			//$name.= " HAVING new_name LIKE '%".$searchname."%'";
		}
		elseif($type==2){
			$name.="AND jt.s_ic='".$searchname."'";
		}
		elseif($type==3){
			$name.= " AND jt.s_contact= '".$searchname."'";
		}
		elseif($type==4){
			
			$name.= " AND jt.batch = '".$searchname."'";
		}
		elseif($type==5){
			//$name .= " AND jt.secondary_school LIKE '%".$searchname."%'";
			$name.= " AND jt.company_name like'%".$searchname."%'";
		}
		elseif($type==6){
			$name.="AND jt.secondary_school LIKE '%".$searchname."%'";
		}
		else{
			$name="";
		}
		
	}
	if((isset($_GET['course']) && !empty($_GET['course']))){
		$courses.=" AND c_id='".$_GET['course']."'";
	}
	else{
		$courses="";
	}
	
	if((isset($_GET['datefrom']) && !empty($_GET['datefrom']))){
		$datefrom=$_GET['datefrom'];
		$dateto=$_GET['dateto'];
		$date.=" and start_working_date>='$datefrom' and start_working_date<='$dateto'";
		 
	}
	else{
		$date="";
	}*/
	
}
?>


        <div id="page-wrapper">

            <div class="container-fluid">
<?php if(isset($system_msg)){echo $system_msg;}?>

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Job Tracer List
                        <button class="btn btn-success pull-right" data-title="Add" data-toggle="modal" data-target="#add" type="button"><span class="glyphicon glyphicon-plus"></span> Add </button>
                        </h1>
<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
      <div class="modal-dialog" style="width:1000px">
    <div class="modal-content">
          <form method="post" action="add_jobtracer.php">
          <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
        <h4 class="modal-title custom_align" id="Heading">Add Job Tracer</h4>
      </div>
          <div class="modal-body">

  <div class="row">
        <div class="col-md-6">
        
            <div class="form-group">
            	<label>Student Name</label><br>
            	<select class="selectpicker" name="s_name" id="name" data-live-search="true" required>
								<option value="">Choose</option>
								<?php
								$s_qty = "SELECT id,s_name FROM student";	
								$s_result = mysqli_query($conn, $s_qty);
								while($s_row = mysqli_fetch_array($s_result)){
								?>
								<option value="<?=$s_row['id']?>"><?=$s_row['s_name']?></option>
								<?php
								}
								?>
								</select>
            </div> 
        
            <div class="form-group">
            	<label>Student Contact</label>
            	<input id="" class="form-control" name="s_contact" type="text" placeholder="e.g. 0123456789" required>
            </div> 
        
            <div class="form-group">
            	<label>Student IC</label>
            	<input id="" class="form-control nric" name="s_ic" type="text" placeholder="e.g. 923052074239" required>
            </div> 
        
            <div class="form-group">
            	<label>Company Name</label>
            	<input id="" class="form-control" name="c_name" type="text" placeholder="" required>
            </div> 
        
            <div class="form-group">
            	<label>Company Address</label>
            	<input id="" class="form-control" name="c_address" type="text" placeholder="" required>
            </div> 
            
        </div>
        
        <div class="col-md-6">
        
            <div class="form-group">
            	<label>Company Contact</label>
            	<input id="" class="form-control" name="c_contact" type="text" placeholder="e.g. 0123456789" required>
            </div> 
        
            <div class="form-group">
            	<label>Position</label>
            	<input id="" class="form-control" name="position" type="text" placeholder="" required>
            </div> 
        
            <div class="form-group">
            	<label>Salary</label>
            	<input id="" class="form-control" name="salary" type="text" placeholder="" required>
            </div>  
            
            <div class="form-group">
            	<label>Start Working Date</label>
                <div class="input-group date form_date" data-date="" data-date-format="yyyy/mm/dd" data-link-field="dtp_input" data-link-format="yyyy-mm-dd">
                    <input class="form-control" size="16" type="text" value="" placeholder="" required="required">
                    <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
					<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                </div>
				<input type="hidden" name="s_w_date" id="dtp_input" value="" />
            </div>
        
            <div class="form-group">
            	<label>Batch</label>
            	<input id="" class="form-control" name="batch" type="text" placeholder="e.g. 1" required>
            </div> 
            
            <div class="form-group">
            	<label>Course</label>
                <select name="course1" class="form-control" required>
                    <option value="">~ Select Course ~</option>
                    <?php 
                        $c_qry = "SELECT * FROM course";
                        $c_result = mysqli_query($conn, $c_qry);
                        while($c_row = mysqli_fetch_array($c_result)){
						
						
                    ?>
                    <option value="<?php echo $c_row['id'];?>"><?=$c_row['course']?></option>
                <?php }?>
                </select>    
            </div>
              
        </div>
  </div>
          </div>
          <div class="modal-footer ">
			<button type="submit" name="add_jobtracer" class="btn btn-success btn-lg" style="width: 100%;"><span class="glyphicon glyphicon-ok-sign"></span> Add </button>
      </div>
      		</form>
        </div>
    <!-- /.modal-content --> 
  </div>
      <!-- /.modal-dialog --> 
    </div>
                        <!--<ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.php">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-table"></i> Job Tracer List
                            </li>
                        </ol>-->
                    </div>
                </div>
                <!-- /.row -->
                
<form action="" method="get">	
  <!--<div class="row">
    
    <div class="col-lg-3">
        <label>Search</label>
        <?php 
			if(!empty($_GET['name'])){
				$text=$_GET['name'];
			}
			else{
				$text="";
			}
		?>
        <br>
       <input class="form-control typeahead" name="name" style="width:275px;" id="my-input3" value="<?php echo $text; ?>" type="text" >
       
    </div>-->
    
    <!--<div class="col-lg-3">
        <label>Search Contact</label>
       <input class="form-control" name="contact" type="text" >
        <label>Search Batch</label>
       <input class="form-control" name="batch" type="text" >
       
    </div>-->
    
    <!--<div class="col-lg-3">
        <label>Search type</label>
        <select name="searchtype"  class="form-control">
            <option value="0">~Please choose the Search type~</option>
            <?php 
                $c_qry = "SELECT * FROM course";
                $c_result = mysqli_query($conn, $c_qry);
               	$c_rows=mysqli_num_rows($c_result);
				$c_row=mysqli_fetch_array($c_result);
				$isSelected_bat="";
				$isSelected_cm="";
				$isSelected_con="";
				$isSelected_ic="";
				$isSelected_name="";
				$isSelected_sc="";
				if($_GET['searchtype']==1){
					$isSelected_name="selected='selected'";
				}
				elseif($_GET['searchtype']==2){
					$isSelected_ic="selected='selected'";
				}
				elseif($_GET['searchtype']==3){
					$isSelected_con="selected='selected'";
				}
				elseif($_GET['searchtype']==4){
					$isSelected_bat="selected='selected'";
				}
				elseif($_GET['searchtype']==5){
					$isSelected_cm="selected='selected'";
				}
				elseif($_GET['searchtype']==6){
					$isSelected_sc="selected='selected'";
				}
				else{
					$isSelected_bat="";
					$isSelected_cm="";
					$isSelected_con="";
					$isSelected_ic="";
					$isSelected_name="";
					$isSelected_sc="";
				}
            ?>
           		<option value="1" <?php echo $isSelected_name; ?> >Name</option>
                <option value="2" <?php echo $isSelected_ic; ?> >Ic</option>
                <option value="3" <?php echo $isSelected_con; ?>>Contact Number</option>
                <option value="4" <?php echo $isSelected_bat; ?>>Batch</option>
                <option value="5" <?php echo $isSelected_cm; ?>>Company Name</option>
                <option value="6" <?php echo $isSelected_sc; ?>>Secondary School</option>
        
        </select>   
    </div>
    <div class="col-lg-3">	
    <label>Course</label>
    	 <select name="course" 	 class="form-control">
         		<option value="">~Please select a course~</option>
         		<?php 
					$c_qry = "SELECT * FROM course";
                	$c_result = mysqli_query($conn, $c_qry);
               		$c_rows=mysqli_num_rows($c_result);
					
					
					while($c_row=mysqli_fetch_array($c_result)){
						if($c_row['id']==$_GET['course']){
							 $isSelected = "selected='selected'";
						}
						else{
							 $isSelected = "";
						}
						echo "<option name='course' value='".$c_row['id']."'  $isSelected >".$c_row['course']."</option>";
					}
				?>
         </select>
    </div>
    <?php 
		if(!empty($_GET['datefrom'])){
			
			$newdate_from=$_GET['datefrom'];
		}
		else{
			$newdate_from="";
		}
		if(!empty($_GET['dateto'])){
			
			$newdate_to=$_GET['dateto'];
		}
		else{
			$newdate_to="";
		}
	
	?>
    <div class="col-lg-3">
    <label>Date Between</label>
                <div class="input-group date form_date" data-date="" data-date-format="yyyy/mm/dd" data-link-field="dtp_input" data-link-format="yyyy-mm-dd">
                    <input class="form-control" size="16" type="text" name="datefrom" value="<?php echo $newdate_from; ?>" placeholder="">
                    <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
					<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
    </div>
    <div class="input-group date form_date" data-date="" data-date-format="yyyy/mm/dd" data-link-field="dtp_input" data-link-format="yyyy-mm-dd">
                    <input class="form-control" size="16" type="text" name="dateto" value="<?php echo $newdate_to; ?>" placeholder="" >
                    <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
					<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
    </div>
    </div>
    <div class="col-lg-3">
    	<label>Search Secondary School</label>
       <input class="form-control" name="s_school" type="text" >
    </div>
  </div>-->
    <br />

<div style="padding: 19px 20px 20px;margin-top: 20px;    margin-bottom: 20px;background-color: #f5f5f5;border-top: 1px solid #e5e5e5;" class="form-group">
  <div class="row">
    	<div class="col-lg-6">
        <button type="submit" name="search" value="search" class="btn btn-primary" name="submit">Search</button>
        </div>
  </div>
</div>
</form>

                <div class="row">
<?php
/*$qry="SELECT * FROM job_tracer AS jt
	  INNER JOIN course AS c ON c.id = jt.c_id
	  WHERE jt.j_status = 'ACTIVE'".$ic.$name.$contact.$batch.$courses."
	  ORDER BY jt.id DESC";*/
	  $course='';
	  if($_SESSION['course']!==''){
	  		$course="and jt.c_id='".$_SESSION['course']."'";
	  }
	  
	   
	   $qry="SELECT *,jt.s_name AS new_name FROM job_tracer AS jt
	  INNER JOIN course AS c ON c.id = jt.c_id
	  INNER JOIN student as s on s.ic=jt.s_ic
	  WHERE jt.j_status = 'ACTIVE' ".$course."
	  ORDER BY jt.id DESC";
	  
$sql_page = mysqli_query($conn,$qry);
$i=0
/*$num_page = mysqli_num_rows($sql_page);
$page_records = $num_page;

$page = new Page();
$links = new Pagination ($page_records,'20');
$limit = $links->limit();

$result=mysqli_query($conn,$qry.$limit);
$count=mysqli_num_rows($sql_page);
if($search_status=="true"){
	$resultofsearch="$count result have been found";
}
else{
	$resultofsearch="";
}
*/

?>

            <div class="col-md-12">
                <div class="table-responsive">
                
                    <table id="example1" class="table table-bordred table-striped" style="width:100%">
                    
                        <thead>
                            <!--<th>Course</th>-->
                            <th>Name</th>
                            <th>Course</th>
                            <th>IC</th>
                            <th>Contact</th>
                            <th>Company Name</th>
                            <th>Company Address</th>
                            <th>Company Contact</th>
                            <th>Position</th>
                            <th>Salary</th>
							<th>Graduation Date</th>
                            <th>Start Working Date</th>
                            <th>Batch</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </thead>
                        <tbody>
							<?php while($row = mysqli_fetch_array($sql_page)){ ?>
                            <?php 
								
							
							?>
                            <tr>
                            <!--<td><?=$row['c_name']?></td>-->
                            <td><?=$row['s_name']?></td>
                            <td><?=$row['course']?></td>
                            <td><?=$row['s_ic']?></td>
                            <td><?=$row['s_contact']?></td>
                            <td><?=$row['company_name']?></td>
                            <td><?=$row['company_address']?></td>
                            <td><?=$row['company_contact']?></td>
                            <td><?=$row['position']?></td>
                            <td><?=$row['salary']?></td>
							<td><?=$row['graduated_date']?></td>
                            <td><?=$row['start_working_date']?></td>
                            <td><?=$row['batch']?></td>
                            <td><a class="btn btn-primary" href="edit_job.php?id=<?=$row[0]?>">Edit</a></td>
                            <td><a class="btn btn-danger" href="add_jobtracer.php?action=delete&id=<?=$row[0]?>" onclick="return confirm('Confirm to Delete this Record?')"> Delete </a></td>
                            </tr>
                            
                            <?php }?>
                        </tbody>
                    </table>
                    
                    

                </div>
            </div>
        </div>
                <!-- /.row -->

  <!-- /.row -->
  <?php require('footer.php');?>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    




    <!-- Bootstrap Core JavaScript -->
  

</body>

</html>
<script>


</script>
