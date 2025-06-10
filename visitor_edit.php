<?php 
require('include/include.php');
require('header.php');
$system_msg='';
if(isset($_GET['action']) && $_GET['action'] == 'msg_fail_edit'){
	$system_msg .= systemMsg('alert-danger','Fail!','Fail to edit Visitor Log.');
}elseif(isset($_GET['action']) && $_GET['action'] == 'msg_success_edit'){
	$system_msg .= systemMsg('alert-success','Success!','Successfully edit Visitor Log.');	
}


$qry = "SELECT * FROM visitor WHERE id = '$_GET[id]' ORDER BY id DESC";
$result = mysqli_query($conn,$qry);
$row = mysqli_fetch_array($result);
?>
    <!-- Page Content -->
    <div class="container">
<?php if(isset($system_msg)){echo $system_msg;}?>
        <!-- Page Header -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Edit Visitor Log
                    <!--<small>Secondary Text</small>-->
                </h1>
            </div>
        </div>
        <!-- /.row -->

        <!-- Projects Row -->
        <div class="row">
        
<div class="panel panel-info">
    <header class="panel-heading">
    <h3 class="panel-title">Visitor Information</h3>
    </header>
    <div class="panel-body">
        <form class="form-horizontal" method="post" action="visitor.php?id=<?=$_GET['id']?>" enctype="multipart/form-data">    
        <div class="col-md-5">
            <div class="form-group">
            <label>Date</label>
            <div class="input-group date form_date" data-date="" data-date-format="dd-mm-yyyy" data-link-field="dtp_input1" data-link-format="yyyy-mm-dd">
            <input class="form-control" size="16" type="text" value="<?=$row['v_date']?>" >
            <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
            </div>
            <input type="hidden" name="v_date" id="dtp_input1" value="<?=$row['v_date']?>" />
            </div>
            <div class="form-group">
            <label>Student Name</label>
            <input type="text" class="form-control" name="s_name" value="<?=$row['s_name']?>" required>
            </div>
            <div class="form-group">
                <label>Student IC</label>
                <input type="text" class="form-control" name="s_ic" value="<?=$row['s_ic']?>" required>
            </div>
            
            <div class="form-group">
            <label>Middle School</label>
            <input type="text" class="form-control" name="m_school" value="<?=$row['school_name']?>" required>
            </div>
            <div class="form-group">
            <label>Chinese Name</label>
            <input type="text" class="form-control" name="c_name" value="<?=$row['c_name']?>" required>
            </div>
            <div class="form-group">
            <label>Date of birth</label>
            <div class="input-group date form_date" data-date="" data-date-format="dd-mm-yyyy" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
            <input class="form-control" size="16" type="text" value="<?=$row["b_date"]?>" >
            <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
            </div>
            <input type="hidden" name="b_date" id="dtp_input2" value="<?=$row["b_date"]?>" /><br/>
            </div>
            <div class="form-group">
            <label>Nationality</label>
            <input type="text" class="form-control" name="nationality" value="<?=$row['nationality']?>" required>
            </div>
            <div class="form-group">
            <label>Gender</label>
            <select name="gender" class="form-control" >
                <option <?php if($row["gender"]=="Male"){echo "selected=\"selected\"";}?> value="Male">Male</option>
                <option <?php if($row["gender"]=="Female"){echo "selected=\"selected\"";}?> value="Female">Female</option>
            </select>
            </div>
            <div class="form-group">
            <label>Marital status</label>
            <select name="m_status" class="form-control" >
                <option <?php if($row["gender"]=="Single"){echo "selected=\"selected\"";}?> value="Single">Single</option>
                <option <?php if($row["gender"]=="Married"){echo "selected=\"selected\"";}?>   value="Married">Married</option>
            </select>
            </div>
            <div class="form-group">
            <label>Race</label>
            <select name="race" class="form-control" >
                <option <?php if($row['race'] == 'Chinese'){echo "selected=\"selected\"";}?>   value="Chinese">Chinese</option>
                <option <?php if($row['race'] == 'Indian'){echo "selected=\"selected\"";}?>  value="Indian">Indian</option>
                <option <?php if($row['race'] == 'Malay'){echo "selected=\"selected\"";}?>  value="Malay">Malay</option>
            </select>
            </div>
            <div class="form-group">
            <label>Religion</label>
            <select name="religion" class="form-control" >
                <option <?php if($row["religion"]=="Buddhism"){echo "selected=\"selected\"";}?> value="Buddhism">Buddhism</option>
                <option <?php if($row["religion"]=="Christianity"){echo "selected=\"selected\"";}?> value="Christianity">Christianity</option>
                <option <?php if($row["religion"]=="Daoism"){echo "selected=\"selected\"";}?> value="Daoism">Daoism</option>
                <option <?php if($row["religion"]=="Hinduism"){echo "selected=\"selected\"";}?> value="Hinduism">Hinduism</option>
                <option <?php if($row["religion"]=="Islam"){echo "selected=\"selected\"";}?> value="Islam">Islam</option>
            </select>
            </div>
            <div class="form-group">
            <label>Postcode</label>
            <input type="text" class="form-control" name="postcode" value="<?=$row['postcode']?>" required>
            </div>
            <div class="form-group">
            <label>State</label>
            <select name="state" class="form-control" >
                <option value="-">-</option>
                <option value="Johor" <?php if($row['state'] == 'Johor'){echo "selected=\"selected\"";}?>>Johor</option>
                <option value="Kedah" <?php if($row['state'] == 'Kedah'){echo "selected=\"selected\"";}?>>Kedah</option>
                <option value="Kelantan" <?php if($row['state'] == 'Kelantan'){echo "selected=\"selected\"";}?>>Kelantan</option>
                <option value="Melaka" <?php if($row['state'] == 'Melaka'){echo "selected=\"selected\"";}?>>Melaka</option>
                <option value="Negeri Sembilan" <?php if($row['state'] == 'Negeri Sembilan'){echo "selected=\"selected\"";}?>>Negeri Sembilan</option>
                <option value="Pahang" <?php if($row['state'] == 'Pahang'){echo "selected=\"selected\"";}?>>Pahang</option>
                <option value="Penang" <?php if($row['state'] == 'Penang'){echo "selected=\"selected\"";}?>>Penang</option>
                <option value="Perak" <?php if($row['state'] == 'Perak'){echo "selected=\"selected\"";}?>>Perak</option>
                <option value="Perlis" <?php if($row['state'] == 'Perlis'){echo "selected=\"selected\"";}?>>Perlis</option>
                <option value="Sabah" <?php if($row['state'] == 'Sabah'){echo "selected=\"selected\"";}?>>Sabah</option>
                <option value="Sarawak" <?php if($row['state'] == 'Sarawak'){echo "selected=\"selected\"";}?>>Sarawak</option>
                <option value="Selanggor" <?php if($row['state'] == 'Selanggor'){echo "selected=\"selected\"";}?>>Selanggor</option>
                <option value="Terengganu" <?php if($row['state'] == 'Terengganu'){echo "selected=\"selected\"";}?>>Terengganu</option>
            </select>
            </div>
            <div class="form-group">
            <label>Email</label>
            <input type="email" class="form-control" name="email" value="<?=$row['email']?>" required>
            </div>
            <div class="form-group">
            <label>Student Contact</label>
            <input type="tel" class="form-control" name="s_contact" value="<?=$row['s_contact']?>" pattern="^\d{3}-\d{7,8}$" required>e.g 012-3456789
            </div>
            <div class="form-group">
            <label>Parent Contact</label>
            <input type="tel" class="form-control" name="p_contact" value="<?=$row['p_contact']?>" pattern="^\d{3}-\d{7,8}$" required>e.g 012-3456789
            </div>
            <div class="form-group">
            <label>Student Age</label>
            <input type="text" class="form-control" name="s_age" value="<?=$row['s_age']?>" required>
            </div>
            <div class="form-group">
            <label>Address / Location</label>
            <input type="text" class="form-control" name="location" value="<?=$row['v_location']?>" required>
            </div>
            <div class="form-group">
            <label>Status</label>
            <textarea name="desc" class="form-control"><?=$row['v_desc']?></textarea>
            </div>
            <!--<div class="form-group">
            <label>Registered Date</label>
            <div class="input-group date form_date" data-date="" data-date-format="dd-mm-yyyy" data-link-field="dtp_input3" data-link-format="yyyy-mm-dd">
            <input class="form-control" size="16" type="text" value="<?=$row['v_register_date']?>" >
            <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
            </div>
            <input type="hidden" name="r_date" id="dtp_input3" value="" />
            </div>-->
        
        <div class="col-md-12">
            <div class="form-group">
            	<button type="submit" class="btn btn-primary" name="submit" value="edit"><i class=""></i> Save </button>
            </div>
        </div>
        </form>
     
	</div>
</div>
        </div>
        <!-- /.row -->
<?php require('footer.php');?>