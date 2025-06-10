<?php 
require('include/include.php');
require('header.php');
$system_msg='';
if(isset($_GET['action']) && $_GET['action'] == 'msg_fail_add'){
	$system_msg .= systemMsg('alert-danger','Fail!','Fail to add Visitor Log.');
}elseif(isset($_GET['action']) && $_GET['action'] == 'msg_success_add'){
	$system_msg .= systemMsg('alert-success','Success!','Successfully add Visitor Log.');	
}
?>
    <!-- Page Content -->
    <div class="container">
<?php if(isset($system_msg)){echo $system_msg;}?>
        <!-- Page Header -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Add Visitor Log
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
        <form class="form-horizontal" method="post" action="visitor.php" enctype="multipart/form-data">    
        <div class="col-md-5">
            <div class="form-group">
            <label>Date</label>
            <div class="input-group date form_date" data-date="" data-date-format="dd-mm-yyyy" data-link-field="dtp_input1" data-link-format="yyyy-mm-dd">
            <input class="form-control" size="16" type="text" value="" >
            <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
            </div>
            <input type="hidden" name="v_date" id="dtp_input1" value="" />
            </div>
            <div class="form-group">
            <label>Student Name</label>
            <input type="text" class="form-control" name="s_name" value="" required>
            </div>
            <div class="form-group">
            <label>Student IC</label>
            <input type="text" class="form-control" name="s_ic" value="" required>
            </div>
            <div class="form-group">
            <label>Middle School</label>
            <input type="text" class="form-control" name="m_school" value="" required>
            </div>
            <div class="form-group">
            <label>Chinese Name</label>
            <input type="text" class="form-control" name="c_name" value="" required>
            </div>
            <div class="form-group">
            <label>Date of birth</label>
            <div class="input-group date form_date" data-date="" data-date-format="dd-mm-yyyy" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
            <input class="form-control" size="16" type="text" value="" >
            <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
            </div>
            <input type="hidden" name="b_date" id="dtp_input2" value="" /><br/>
            </div>
            <div class="form-group">
            <label>Nationality</label>
            <input type="text" class="form-control" name="nationality" value="" required>
            </div>
            <div class="form-group">
            <label>Gender</label>
                <select name="gender" class="form-control" >
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
            </div>
            <div class="form-group">
            <label>Marital status</label>
            <select name="m_status" class="form-control" >
                <option value="Single">Single</option>
                <option value="Married">Married</option>
            </select>
            </div>
            <div class="form-group">
            <label>Race</label>
                <select name="race" class="form-control" >
                    <option  value="Chinese">Chinese</option>
                    <option value="Indian">Indian</option>
                    <option value="Malay">Malay</option>
                </select>
            </div>
            <div class="form-group">
            <label>Religion</label>
                <select name="religion" class="form-control" >
                    <option value="Buddhism">Buddhism</option>
                    <option value="Christianity">Christianity</option>
                    <option value="Daoism">Daoism</option>
                    <option value="Hinduism">Hinduism</option>
                    <option value="Islam">Islam</option>
                </select>
            </div>
            <div class="form-group">
            <label>Postcode</label>
            <input type="text" class="form-control" name="postcode" value="" required>
            </div>
            <div class="form-group">
            <label>State</label>
            <select name="state" class="form-control" >
                <option value="-">-</option>
                <option value="Johor" >Johor</option>
                <option value="Kedah" >Kedah</option>
                <option value="Kelantan" >Kelantan</option>
                <option value="Melaka">>Melaka</option>
                <option value="Negeri Sembilan" >Negeri Sembilan</option>
                <option value="Pahang">Pahang</option>
                <option value="Penang">Penang</option>
                <option value="Perak" >Perak</option>
                <option value="Perlis">Perlis</option>
                <option value="Sabah" >Sabah</option>
                <option value="Sarawak" >Sarawak</option>
                <option value="Selanggor" >Selanggor</option>
                <option value="Terengganu">Terengganu</option>
            </select>
            </div>
            <div class="form-group">
            <label>Email</label>
            <input type="email" class="form-control" name="email" value="" required>
            </div>
            <div class="form-group">
            <label>Student Contact</label>
            <input type="tel" class="form-control" name="s_contact" value="" pattern="^\d{3}-\d{7,8}$" required>e.g 012-3456789
            </div>
            <div class="form-group">
            <label>Parent Contact</label>
            <input type="tel" class="form-control" name="p_contact" value="" pattern="^\d{3}-\d{7,8}$" required>e.g 012-3456789
            </div>
            <div class="form-group">
            <label>Student Age</label>
            <input type="text" class="form-control" name="s_age" value="" required>
            </div>
            <div class="form-group">
            <label>Address / Location</label>
            <input type="text" class="form-control" name="location" value="" required>
            </div>
            <div class="form-group">
            <label>Status</label>
            <textarea name="desc" class="form-control"></textarea>
            </div>
            <!--<div class="form-group">
            <label>Registered Date</label>
            <div class="input-group date form_date" data-date="" data-date-format="dd-mm-yyyy" data-link-field="dtp_input3" data-link-format="yyyy-mm-dd">
            <input class="form-control" size="16" type="text" value="" >
            <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
            </div>
            <input type="hidden" name="r_date" id="dtp_input3" value="" />
            </div>-->
        
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