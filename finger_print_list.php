<?php 
include("include/include.php");
include("header.php");    


$qry="select * from finger_print_attadance where status='ACTIVE' and uid!=0";
$sttr=mysqli_query($conn,$qry);

if(isset($_GET["action"])){
    $delete="update finger_print_attadance set status='DELETE' where id='".$_GET["id"]."'";
    $sttr_d=mysqli_query($conn,$delete);
}


?>
<div class="container-fluid">
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Finger Print List
            <!--<small>Secondary Text</small>-->
        </h1>
    </div>

    <!-- <form action="finger_print_list.php" method="post">
    <div class="col-lg-12">
        <div class="col-md-4">
            <div class="form-group">
                <label>Student Name</label><br>
				<select class="selectpicker" name="uid" id="name" data-live-search="true" required>
				<option value="">Choose</option>
				<?php
				$s_qty = "SELECT DISTINCT uid,s_id FROM finger_print_attadance WHERE status= 'ACTIVE'";	
				$s_result = mysqli_query($conn, $s_qty);
				while($s_row = mysqli_fetch_array($s_result)){
				?>
				<option value="<?=$s_row['uid']?>"><?=$s_row['s_id']?></option>
				<?php }?>
				</select>
                
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label>Date</label>
                <div class="input-group date form_date" data-date="" data-date-format="dd/mm/yyyy" data-link-field="dtp_input2" data-link-format="dd/mm/yyyy">
                    <input class="form-control" name="date" size="16" type="text" value="" required>
                    <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
				</div>
				
            </div>
        </div>
        <div class="col-md-2">
                <div class="form-group">
                <br>
                <input type="submit" value="Delete" name="delete" class="btn btn-danger" />
                </div>
        </div>
    </div>
    </form> -->
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
                    <form action="finger_print_list.php" method="get" >
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
                                // for($i=0;$i<count($cor);$i++){
                                // if($cor[$i]=="0"){
                                //    $query=mysqli_query($conn,"select * from mou"); 
                                // }
                                // else{
                                //    $query=mysqli_query($conn,"select * from mou where c_id='".$cor[$i]."'"); 
                                // }
                                
                                // $cal=mysqli_num_rows($query);
                                ?>
                                <!-- <button type="submit" style="margin-right:20px;"  name="btn_<?php echo $cor[$i];?>" value="<?php echo $cor_name[$i];?>" class="btn btn-danger <?php if($_GET['btn_'.$cor[$i]]==$cor_name[$i]){echo 'clicked';} ?>"><?php echo $cor_name[$i].'( '.$cal.' )'; ?></button> -->
                                
                            </div>
                        </div>
                        <br />
                    
                    <div style="padding: 19px 20px 20px;margin-top: 20px;   margin-bottom: 20px;background-color: #f5f5f5;border-top: 1px solid #e5e5e5;" class="form-group">
                      <div class="row">
                            <!-- <div class="col-lg-12">
                           
                            <button type="button" style='width:20px;height:20px;background-color:red'></button>
                            PROGRAMMING
                            <button type="button" style='width:20px;height:20px;background-color:yellow'></button>
                            MULTIMEDIA
                            <button type="button" style='width:20px;height:20px;background-color:green'></button>
                            ELECTRONIC 
                            <button type="button" style='width:20px;height:20px;background-color:blue'></button>
                            NETWORKING  
                            <button type="button" style='width:20px;height:20px;background-color:purple'></button>
                            ACCOUNTING -->
                            <!-- <a href="print_mou.php" target="_blank" style="margin-left:10px;" class="btn btn-primary pull-right">Print</a> -->
                            <button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#excel">add excel file</button>
                            </div>
                      </div>
                    </div>
                    </form>
                </div>
            </div>
            <div class="row">
        	<div class="col-md-12">
                <!--<div class="table-responsive">-->
                
                    <table id="example1" class="table table-bordred table-striped" style="width:100%">
                    
                        <thead>
                            <th>UID</th>
                            <th>Student</th>
                            <th>tongue time</th>
                            <th>Delete</th>
                            
                            
                          <!-- <th>Action</th>   -->
                            
                                
                        
                        </thead>
                        <tbody>
                          <style>
                            .bg-danger {
                                background-color: #dc3545 !important;
                            }	  
                          </style>
							<?php while($result = mysqli_fetch_array($sttr)){
                            $qry1="select s_time from finger_print_attadance where date='$result[date]'";
                            $sttr1=mysqli_query($conn,$qry1);
                            $i=0;
                            $time;
                            while($result1=mysqli_fetch_array($sttr1)){
                                $time[$i]=$result1[0];
                                $i++;
                            }    
                                
                            ?>
                            
                            <tr>
                              
                              <td><?=$result['uid']?></td>
                              <td><?=$result['s_id']?></td>
                              <td><?=$result['s_time']?></td>
                              <td><a class="btn btn-danger" href="finger_print_list.php?action=delete&id=<?=$result['id']?>" onclick="return confirm('Are you sure?')">Delete</a></td>
                                  
                                      
                              <!-- <td><div class="dropdown">
                                  <button class="btn btn-warning dropdown-toggle " type="button" data-toggle="dropdown">Action<span class="caret"></span></button>
                                  <ul class="dropdown-menu dropdown-menu-right">
                                    <li><a href="edit_mou.php?id=<?=$result[0]?>">Edit</a></li>
                                    
                                    <li><a href="finger_print_list.php?action=delete&id=<?=$result['id']?>" onclick="return confirm('Are you sure?')">Delete</a></li>

                                    <!--<li class="divider"></li>
                                    <li><a href="internal_exam_fee_list.php?id=<?=$row[0]?>&name=<?=$row['s_name']?>&ic=<?=$row['ic']?>">Internal Exam Fees</a></li>
                                    <li><a href="tuition_fee_list.php?id=<?=$row[0]?>&name=<?=$row['s_name']?>&ic=<?=$row['ic']?>">Tuition Fees</a></li>
                                    <li><a href="hostel_fee_list.php?id=<?=$row[0]?>&name=<?=$row['s_name']?>&ic=<?=$row['ic']?>">Hostel Fees</a></li>-->
                                    
                                    
                                    <!--<li><a href="dateregister.php?&id=<?=$row[0]?>">Date Register</a></li>
                                    <li><a href="personal_form.php?&id=<?=$row[0]?>">Personal File</a></li>
                                    <li><a href="#">Offer Letter</a></li>
                                    <li><a href="#">Rapid Bus Letter</a></li>
                                    <li class="divider"></li>
                                  
                                  </ul>
                                </div></td>   -->
                                 
                                  
                            </tr>
                            <?php }?>
                        </tbody>
                    </table>
                <!--</div>-->
            </div>
        </div>
</div>
<div class="modal fade" id="excel" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
      <div class="modal-dialog" style="width:1000px">
    <div class="modal-content">
          <form method="post" action="load_excel.php" enctype="multipart/form-data">
          <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
        <h4 class="modal-title custom_align" id="Heading">Add Excel file</h4>
      </div>
          <div class="modal-body">

  <div class="row">
        <div class="col-md-12">
                <div class="form-group">
                    <label>Excel File</label>
                    <input type="file" name="filename" id="filename" required  />
                </div>
            
        </div>
      
  </div>
          </div>
          <div class="modal-footer ">
			<button type="submit" name="add_excel" class="btn btn-success btn-lg" style="width: 100%;"><span class="glyphicon glyphicon-ok-sign"></span>Upload</button>
      </div>
      		</form>
        </div>
    <!-- /.modal-content --> 
  </div>
      <!-- /.modal-dialog --> 
    </div>

    


<?php include("footer.php"); ?>