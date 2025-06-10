<?php 
require('include/include.php');
require('header.php');
$system_msg='';
if(isset($_GET['action']) && $_GET['action'] == 'msg_fail_add'){
	$system_msg .= systemMsg('alert-danger','Fail!','Fail to add new student.');
}
?>
<?php 
	if(isset($system_msg)){echo $system_msg;}
	
mysqli_set_charset($conn, 'utf8');	
$qry = "SELECT * FROM school WHERE s_id='". $_GET['id'] ."' AND status='ACTIVE'";
$result = mysqli_query($conn, $qry);
  
mysqli_set_charset($conn, 'utf8');	
$qry_r = "SELECT * FROM result WHERE s_id='". $_GET['id'] ."' ";
$result_r = mysqli_query($conn, $qry_r);
	
//$result = mysqli_query($conn,$qry.$limit);
?>
    <!-- Page Content -->
    <div class="container">
<?php if(isset($system_msg)){echo $system_msg;}?>
        <!-- Page Header -->
        <div class="row">
            <div class="col-md-12">
                <?php 
                include("switch_list.php");
                ?>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">QUALIFICATION STATUS
                    <!--<small>Secondary Text</small>-->
                </h1>
            </div>
        </div>
        <!-- /.row -->

        <!-- Projects Row -->
        <div class="row">
        
<div class="panel panel-info">
    <header class="panel-heading">
    <h3 class="panel-title">SCHOOL DETAILS</h3>
    </header>
    <div class="panel-body">
        <form class="form-horizontal" method="POST" action="add_qualification.php?id=<?=$_GET['id']?>" enctype="multipart/form-data">    
        <div class="col-md-12 ">
           <div class="form-group">
            <label>Former School</label>
            <select name="former" class="form-control" required>
                <option value="SECONDARY SCHOOL">SECONDARY SCHOOL</option>
                <option value="COLLEGE">COLLEGE</option>
                <option value="OTHERS">OTHERS</option>
            </select>
            </div>
            <div class="form-group ">
            <label>Name of School</label>
            <!-- <input type="checkbox" />check if need add new school name -->
            <!-- <div id="s_name">
                <select name="schoolList" class="form-control" id="schoolList" required>
                    <option value="">Choose</option>
                    <?php
                        $qry1 = "SELECT * FROM school_list WHERE status = 'ACTIVE'";
                        $result1 = mysqli_query($conn,$qry1);
                        while($row1 = mysqli_fetch_array($result1)){
                    ?>
                    <option ><?=$row1['name_school']?></option>
                    <?php }?>
                </select>
            </div> -->
            <input type="text" class="form-control" name="schoolList"  value="" />

            </div>
            <div class="form-group">
            <label>Location</label>
            <input type="text" class="form-control" name="location" value="" required>
            </div>
            <div class="form-group">
            <label>Qualification</label>
            <input type="text" class="form-control" name="qualification" value="" required>
            </div>
            <div class="form-group">
            <label>Year</label>
            <input type="text" class="form-control" name="year" value="" required>
            </div>
           
        <div class="col-md-12 col-md-offset-4">
            <div class="form-group">
            	<button type="submit" class="btn btn-primary" name="submit" value="save_school" style="width:320px;"><i class=""></i> Add </button>
            </div>
        </div>	
        
        
            <div class="col-md-12">
            <div class="row">
            <div class="col-lg-12">
                <div style="overflow-x:auto;"> 
                <table id="mytable" class="table table-bordred table-striped" style="width:100%">
                    <thead>
                        <th>Former School</th>
                        <th>Name of School</th>
                        <th>Location</th>
                        <th>Qualification</th>
                        <th>Year</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                    <?php while($row = mysqli_fetch_array($result)){?>
                    
                        <tr>
                            <td><?=$row['former']?></td>
                            <td><?=$row['name_school']?></td>
                            <td><?=$row['location']?></td>
                            <td><?=$row['qualification']?></td>
                            <td><?=$row['year']?></td>
                            <td><div class="dropdown">
                  <button class="btn btn-primary dropdown-toggle " type="button" data-toggle="dropdown">Action<span class="caret"></span></button>
                      <ul class="dropdown-menu dropdown-menu-right">
                        <li><a href="school_edit.php?action=edit_school&id=<?=$_GET['id']?>&sid=<?=$row['id']?>">Edit</a></li>
                        <li><a href="add_qualification.php?action=delete_school&id=<?=$_GET['id']?>&sid=<?=$row['id']?>">Delete</a></li>
                      </ul>
                    </div></td>
                        </tr>
                    <?php }?>
                    </tbody>
                
                </table>
                </div>
            </div>
        </div>
        </div>
        	
        
       </form>
    </div>  
</div>
</div>

<div class="panel panel-info">
    <header class="panel-heading">
    <h3 class="panel-title">RESULT</h3>
    </header>
    <div class="panel-body">
        <form class="form-horizontal" method="post" action="add_qualification.php?id=<?=$_GET['id']?>" enctype="multipart/form-data">    
        <div class="col-md-12 ">               	
            <div class="form-group">
            <label>Syllabus</label>
            <select name="syllabus" class="form-control" required>
                <option value="-">-</option>
                <option value="BAHASA MELAYU">BAHASA MELAYU</option>
                <option value="BAHASA INGGERIS/ENGLISH">BAHASA INGGERIS/ENGLISH</option>
                <option value="BAHASA CINA/CHINESE">BAHASA CINA/CHINESE</option>
                <option value="BAHASA TAMIL">BAHASA TAMIL</option>
                <option value="PENDIDIKAN ISLAM/ISLAMIC STUDIES">PENDIDIKAN ISLAM/ISLAMIC STUDIES</option>
                <option value="PENDIDIKAN MORAL/MORAL EDUCATION">PENDIDIKAN MORAL/MORAL EDUCATION</option>
                <option value="MATEMATIK">MATEMATIK</option>
                <option value="SAINS/SCIENCE">SAINS/SCIENCE</option>
                <option value="SAINS PERTANIAN">SAINS PERTANIAN</option>
                <option value="SEJARAH/HISTORY">SEJARAH/HISTORY</option>
                <option value="PENDIDIKAN SENI VISUAL/VISUAL ARTS EDUCATION">PENDIDIKAN SENI VISUAL/VISUAL ARTS EDUCATION</option>
                <option value="PENDAGANGAN/BUSINESS">PENDAGANGAN/BUSINESS</option>
                <option value="PRINSIP PERAKAUNAN/PRINCIPLES OF ACCOUNTING">PRINSIP PERAKAUNAN/PRINCIPLES OF ACCOUNTING</option>
                <option value="EKONOMI ASAS/BASIC ECONOMICS">EKONOMI ASAS/BASIC ECONOMICS</option>
                <option value="ADDITIONAL MATHEMATICS">ADDITIONAL MATHEMATICS</option>
                <option value="PHYSICS">PHYSICS</option>
                <option value="CHEMISTRY">CHEMISTRY</option>
                <option value="GEOGRAFI">GEOGRAFI</option>
                <option value="BIOLOGY">BIOLOGY</option>
                <option value="INFORMATION AND COMMUNICATION TECHNOLOGY">INFORMATION AND COMMUNICATION TECHNOLOGY</option>
                <option value="KESUSASTERAAN CINA/CHINESE LITERATURE">KESUSASTERAAN CINA/CHINESE LITERATURE</option>
                <option value="KESUSASTERAAN MELAYU/MALAY LITERATURE">KESUSASTERAAN MELAYU/MALAY LITERATURE</option>
                <option value="KESUSASTERAAN INGGERIS/ENGLISH LITERATURE">KESUSASTERAAN INGGERIS/ENGLISH LITERATURE</option>
                <option value="ENGLISH FOR SCIENCE & TECHNOLOGY">ENGLISH FOR SCIENCE & TECHNOLOGY</option>
                <option value="REKA CIPTA">REKA CIPTA</option>
                <option value="PENGETAHUAN SAINS SUKAN">PENGETAHUAN SAINS SUKAN</option>
                <option value="KHB-PERDAGANGAN DAN KEUSAHAWANAN">KHB-PERDAGANGAN DAN KEUSAHAWANAN</option>
                <option value="BUSINESS STUDIES">BUSINESS STUDIES</option>
                <option value="BOOK KEEPING">BOOK KEEPING</option>
                <option value="PHYSICAL EDUACATION">PHYSICAL EDUACATION</option>
                <option value="COMPUTER STUDIES">COMPUTER STUDIES</option>
                <option value="CO-CURRICULUM">CO-CURRICULUM</option>
                <option value="PERNIAGAAN">PERNIAGAAN</option>
            </select>
            </div>
            
          <div class="form-group">
            <label>Result</label>
            <input type="text" class="form-control" name="result" value="" required>
          </div>
               
        </div>
        <div class="col-md-12 col-md-offset-4">
            <div class="form-group">
            	<button type="submit" class="btn btn-primary" name="submit" value="save_result" style="width:320px;"><i class=""></i> Add </button>
            </div>
        </div>	
      
        <div class="col-md-12">
            <div class="row">
            <div class="col-lg-12">
                <div style="overflow-x:auto;"> 
                <table id="mytable" class="table table-bordred table-striped" style="width:100%">
                    <thead>
                        <th>Syllabus</th>
                        <th>Result</th> 
                        <th>Action</th>           
                    </thead>
                    <tbody>
                    <?php while($row = mysqli_fetch_array($result_r)){?>
                        <tr>
                            <td><?=$row['syllabus']?></td>
                            <td><?=$row['result']?></td>
                            <td><div class="dropdown">
                  <button class="btn btn-primary dropdown-toggle " type="button" data-toggle="dropdown">Action<span class="caret"></span></button>
                      <ul class="dropdown-menu dropdown-menu-right">
                        <li><a href="result_edit.php?action=result_edit&id=<?=$_GET['id']?>&sid=<?=$row['id']?>">Edit</a></li>
                        <li><a href="add_qualification.php?action=delete_result&id=<?=$_GET['id']?>&sid=<?=$row['id']?>">Delete</a></li>
                      </ul>
                    </div></td>
                        </tr>
                    <?php }?>
                    </tbody>
                
                </table>
                </div>
            </div>
        </div>
        </div>
        
        
        </form>
    </div>  
</div>
        </div>
     </div>
        <!-- /.row -->
<?php require('footer.php');?>