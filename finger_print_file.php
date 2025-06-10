<?php 
include("include/include.php");
include("header.php");    

$qry="select * from finger_print_file";
$sttr=mysqli_query($conn,$qry);



?>
<div class="container-fluid">
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Manage finger print file
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
                    
                    <!-- <div style="padding: 19px 20px 20px;margin-top: 20px;   margin-bottom: 20px;background-color: #f5f5f5;border-top: 1px solid #e5e5e5;" class="form-group">
                      <div class="row">
                            <div class="col-lg-12">
                           
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
                            <!-- <a href="print_mou.php" target="_blank" style="margin-left:10px;" class="btn btn-primary pull-right">Print</a> 
                            <button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#excel">add excel file</button>
                            </div>
                      </div>
                    </div> -->
                    </form>
                </div>
            </div>
            <form action="" method=>                         
            <div class="row">
        	<div class="col-md-12">
                <!--<div class="table-responsive">-->
                
                    <table id="example1" class="table table-bordred table-striped" style="width:100%">
                    
                        <thead>
                            <th>File path</th>
                            <th>Date</th>
                            <th>Action</th>
                            
                            
                            
                            
                          <!-- <th>Action</th>   -->
                            
                                
                        
                        </thead>
                        <tbody>
                          <style>
                            .bg-danger {
                                background-color: #dc3545 !important;
                            }	  
                          </style>
							<?php while($result = mysqli_fetch_array($sttr)){  
                            ?>
                            
                            <tr>
                              
                              <td><?=$result['path']?></td>
                              <td><?=$result['date']?></td>
                              
                                
                                  
                                      
                              <td><div class="dropdown">
                                  <button class="btn btn-warning dropdown-toggle " type="button" data-toggle="dropdown">Action<span class="caret"></span></button>
                                  <ul class="dropdown-menu dropdown-menu-right">        
                                    <li><a href="load_excel.php?action=delete&id=<?=$result[0]?>" onclick="return confirm('Are you sure?')">Delete</a></li>
<!-- 
                                    <li class="divider"></li>
                                    <li><a href="internal_exam_fee_list.php?id=<?=$row[0]?>&name=<?=$row['s_name']?>&ic=<?=$row['ic']?>">Internal Exam Fees</a></li>
                                    <li><a href="tuition_fee_list.php?id=<?=$row[0]?>&name=<?=$row['s_name']?>&ic=<?=$row['ic']?>">Tuition Fees</a></li>
                                    <li><a href="hostel_fee_list.php?id=<?=$row[0]?>&name=<?=$row['s_name']?>&ic=<?=$row['ic']?>">Hostel Fees</a></li>-->
                                    
                                    
                                    <!--<li><a href="dateregister.php?&id=<?=$row[0]?>">Date Register</a></li>
                                    <li><a href="personal_form.php?&id=<?=$row[0]?>">Personal File</a></li>
                                    <li><a href="#">Offer Letter</a></li>
                                    <li><a href="#">Rapid Bus Letter</a></li>
                                    <li class="divider"></li>-->
                                  
                                  </ul>
                                </div></td> 
                                 
                                  
                            </tr>
                            <?php }?>
                        </tbody>
                    </table>
                </div>
            </div>
            </form>
        </div>
</div>


    


<?php include("footer.php"); ?>