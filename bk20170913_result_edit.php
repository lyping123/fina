<?php 
require('include/include.php');
require('header.php');
$system_msg='';
if(isset($_GET['action']) && $_GET['action'] == 'msg_fail_add'){
	$system_msg .= systemMsg('alert-danger','Fail!','Fail to add new student.');
}
?>
    <!-- Page Content -->
    <div class="container">
<?php if(isset($system_msg)){echo $system_msg;}?>
<?php
mysqli_set_charset($conn, 'utf8');	
$qry = "SELECT * FROM result WHERE id = '".$_GET['sid']."'";
$result = mysqli_query($conn,$qry);
$row = mysqli_fetch_array($result);
?>
        <!-- Page Header -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Edit Student Information
                    <!--<small>Secondary Text</small>-->
                </h1>
            </div>
        </div>
        <!-- /.row -->

        <!-- Projects Row -->
        <div class="row">
        
<div class="panel panel-info">
    <header class="panel-heading">
    <h3 class="panel-title">Student Information</h3>
    </header>
    <div class="panel-body">
        <form class="form-horizontal" method="post" action="add_qualification.php?action=edit_result&id=<?=$_GET['id']?>&sid=<?=$_GET['sid']?>" enctype="multipart/form-data">    
        <div class="col-md-5">
            <div class="form-group">
            <label>Syllabus</label>
            <select name="syllabus" class="form-control" required>
                <option value="-">-</option>
                <option value="BAHASA MELAYU" <?php if($row['syllabus'] == 'BAHASA MELAYU'){echo "selected=\"selected\"";}?>>BAHASA MELAYU</option>
                <option value="BAHASA INGGERIS/ENGLISH" <?php if($row['syllabus'] == 'BAHASA INGGERIS/ENGLISH'){echo "selected=\"selected\"";}?>>BAHASA INGGERIS/ENGLISH</option>
                <option value="BAHASA CINA/CHINESE" <?php if($row['syllabus'] == 'BAHASA CINA/CHINESE'){echo "selected=\"selected\"";}?>>BAHASA CINA/CHINESE</option>
                <option value="PENDIDIKAN ISLAM/ISLAMIC STUDIES" <?php if($row['syllabus'] == 'INFORMATION AND COMMUNICATION TECHNOLOG'){echo "selected=\"selected\"";}?>>PENDIDIKAN ISLAM/ISLAMIC STUDIES</option>
                <option value="PENDIDIKAN MORAL/MORAL EDUCATION" <?php if($row['syllabus'] == 'PENDIDIKAN MORAL/MORAL EDUCATION'){echo "selected=\"selected\"";}?>>PENDIDIKAN MORAL/MORAL EDUCATION</option>
                <option value="MATEMATIK" <?php if($row['syllabus'] == 'MATEMATIK'){echo "selected=\"selected\"";}?>>MATEMATIK</option>
                <option value="SAINS/SCIENCE" <?php if($row['syllabus'] == 'SAINS/SCIENC'){echo "selected=\"selected\"";}?>>SAINS/SCIENCE</option>
                <option value="SEJARAH/HISTORY" <?php if($row['syllabus'] == 'INFORMATION AND COMMUNICATION TECHNOLOG'){echo "selected=\"selected\"";}?>>SEJARAH/HISTORY</option>
                <option value="PENDIDIKAN SENI VISUAL/VISUAL ARTS EDUCATION" <?php if($row['syllabus'] == 'PENDIDIKAN SENI VISUAL/VISUAL ARTS EDUCATION'){echo "selected=\"selected\"";}?>>PENDIDIKAN SENI VISUAL/VISUAL ARTS EDUCATION</option>
                <option value="PENDAGANGAN/BUSINESS" <?php if($row['syllabus'] == 'PENDAGANGAN/BUSINESS'){echo "selected=\"selected\"";}?>>PENDAGANGAN/BUSINESS</option>
                <option value="PRINSIP PERAKAUNAN/PRINCIPLES OF ACCOUNTING" <?php if($row['syllabus'] == 'PRINSIP PERAKAUNAN/PRINCIPLES OF ACCOUNTING'){echo "selected=\"selected\"";}?>>PRINSIP PERAKAUNAN/PRINCIPLES OF ACCOUNTING</option>
                <option value="EKONOMI ASAS/BASIC ECONOMICS" <?php if($row['syllabus'] == 'EKONOMI ASAS/BASIC ECONOMICS'){echo "selected=\"selected\"";}?>>EKONOMI ASAS/BASIC ECONOMICS</option>
                <option value="ADDITIONAL MATHEMATICS" <?php if($row['syllabus'] == 'ADDITIONAL MATHEMATICS'){echo "selected=\"selected\"";}?>>ADDITIONAL MATHEMATICS</option>
                <option value="PHYSICS" <?php if($row['syllabus'] == 'PHYSICS'){echo "selected=\"selected\"";}?>>PHYSICS</option>
                <option value="CHEMISTRY" <?php if($row['syllabus'] == 'CHEMISTRY'){echo "selected=\"selected\"";}?>>CHEMISTRY</option>
                <option value="BIOLOGY" <?php if($row['syllabus'] == 'BIOLOGY'){echo "selected=\"selected\"";}?>>BIOLOGY</option>
                <option value="INFORMATION AND COMMUNICATION TECHNOLOGY" <?php if($row['syllabus'] == 'INFORMATION AND COMMUNICATION TECHNOLOGY'){echo "selected=\"selected\"";}?>>INFORMATION AND COMMUNICATION TECHNOLOGY</option>
                <option value="KESUSASTERAAN CINA/CHINESE LITERATURE" <?php if($row['syllabus'] == 'INFORMATION AND COMMUNICATION TECHNOLOG'){echo "selected=\"selected\"";}?>>KESUSASTERAAN CINA/CHINESE LITERATURE</option>
                <option value="KESUSASTERAAN MELAYU/MALAY LITERATURE" <?php if($row['syllabus'] == 'INFORMATION AND COMMUNICATION TECHNOLOG'){echo "selected=\"selected\"";}?>>KESUSASTERAAN MELAYU/MALAY LITERATURE</option>
                <option value="KESUSASTERAAN INGGERIS/ENGLISH LITERATURE" <?php if($row['syllabus'] == 'KESUSASTERAAN INGGERIS/ENGLISH LITERATURE'){echo "selected=\"selected\"";}?>>KESUSASTERAAN INGGERIS/ENGLISH LITERATURE</option>
                <option value="ENGLISH FOR SCIENCE & TECHNOLOGY"<?php if($row['syllabus'] == 'KESUSASTERAAN INGGERIS/ENGLISH LITERATURE'){echo "selected=\"selected\"";}?>>ENGLISH FOR SCIENCE & TECHNOLOGY</option>
            </select>
            </div>
            <div class="form-group">
            <label>result</label>
            <input type="text" class="form-control" name="result" value="<?=$row['result']?>" required>
            </div>
            
        </div>
        
        <div class="col-md-1"></div>
        
        
        
        
       
        
        <div class="col-md-12">
            <div class="form-group">
            	<button type="submit" class="btn btn-primary" name="submit" value="edit_result"><i class=""></i> Save </button>
        		<button type="button" class="btn btn-warning" onclick="window.location.href='student_list.php'"> Cancel </button>
            </div>
        </div>
        </form>
    </div>  
</div>
        </div>
        <!-- /.row -->
<?php require('footer.php');?>