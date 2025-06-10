<?php 
require('include/include.php');
require('header_student.php');

?>
    <!-- Page Content -->
    <div class="container">

<?php
mysqli_set_charset($conn, 'utf8');	
$qry = "SELECT * FROM student WHERE id = '".$_SESSION["id"]."'";
$result = mysqli_query($conn,$qry);
$row = mysqli_fetch_array($result);
$date=date("Y-m-d",strtotime("2018-10-17"));
$qry2="select *, sum(fl.rp_amount) as amo from f_receipt as f inner join f_receipt_detail as fl on fl.r_id=f.id where f.s_id='".$_GET['id']."' and (f.cash_bill_option='Debtor' or f.cash_bill_option='Tuition Fee' or f.cash_bill_option='Tuition PTPK' or f.cash_bill_option='Deptor PTPK') and Date(r_date)>='".$date."'";
$result2=mysqli_query($conn,$qry2);
$row2=mysqli_fetch_array($result2);

$outstadind=($row["month"]-$row["month_pay"])*$row["cost_per_month"];





$qry3="select sum(fl.rp_amount) as amo from f_receipt as f inner join f_receipt_detail as fl on fl.r_id=f.id where f.s_id='".$row[0]."' and (f.cash_bill_option='Debtor' or f.cash_bill_option='Tuition Fee' or f.cash_bill_option='Tuition PTPK' or f.cash_bill_option='Deptor PTPK') and Date(r_date)>='".date('2018-12-18')."'";
$result3=mysqli_query($conn,$qry3);
$row3=mysqli_fetch_array($result3);
//$t_l=$row['tuition_fee']-$row['total_pay'];
?>
        <!-- Page Header -->
    
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">My profile
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
        <div class="col-md-12">
        <div class="form-group">
            <label>Photo</label><br>
            <img src="https://registration.synergycollege2u.com/img/<?=$row['photo']?>" style="height: 200px;">
           
            </div>
        </div>
        <div class="col-md-5">
            <div class="form-group">
            <label>Name</label>
            <input type="text" class="form-control" readonly name="name" value="<?=$row['s_name']?>" required>
            </div>
            <div class="form-group">
            <label>NRIC</label>
            <input type="text" class="form-control" readonly id="ic" name="ic" value="<?=$row['ic']?>" required>
            </div>
            <div class="form-group">
            <label>Birth cert</label>
            <input type="text" class="form-control" readonly name="b_sen" value="<?=$row['birth_sen']?>" >
            </div>
            <div class="form-group">
            <label>Nationality</label>
            <input type="text" class="form-control" readonly name="nationality" value="<?=$row['nationality']?>" >
            </div>
            <div class="form-group">
            <label>Race</label>
            <select name="race" disabled class="form-control" >
                <option value="Chinese" <?php if($row['race'] == 'Chinese'){echo "selected=\"selected\"";}?>>Chinese</option>
                <option value="Indian" <?php if($row['race'] == 'Indian'){echo "selected=\"selected\"";}?>>Indian</option>
                <option value="Malay" <?php if($row['race'] == 'Malay'){echo "selected=\"selected\"";}?>>Malay</option>
            </select>
            </div>
            <div class="form-group">
            <label>Permanent Address</label>
            <input type="text" readonly class="form-control" name="r_address" value="<?=$row['r_address']?>" >
            </div>
            <div class="form-group">
            <label>Postcode</label>
            <input type="text" class="form-control" readonly name="r_postcode" value="<?=$row['r_postcode']?>" >
            </div>
            <div class="form-group">
            <label>State</label>
            <select name="r_state" disabled class="form-control" >
                <option value="-">-</option>
                <option value="Johor" <?php if($row['r_state'] == 'Johor'){echo "selected=\"selected\"";}?>>Johor</option>
                <option value="Kedah" <?php if($row['r_state'] == 'Kedah'){echo "selected=\"selected\"";}?>>Kedah</option>
                <option value="Kelantan" <?php if($row['r_state'] == 'Kelantan'){echo "selected=\"selected\"";}?>>Kelantan</option>
                <option value="Melaka" <?php if($row['r_state'] == 'Melaka'){echo "selected=\"selected\"";}?>>Melaka</option>
                <option value="Negeri Sembilan" <?php if($row['r_state'] == 'Negeri Sembilan'){echo "selected=\"selected\"";}?>>Negeri Sembilan</option>
                <option value="Pahang" <?php if($row['r_state'] == 'Pahang'){echo "selected=\"selected\"";}?>>Pahang</option>
                <option value="Penang" <?php if($row['r_state'] == 'Penang'){echo "selected=\"selected\"";}?>>Penang</option>
                <option value="Perak" <?php if($row['r_state'] == 'Perak'){echo "selected=\"selected\"";}?>>Perak</option>
                <option value="Perlis" <?php if($row['r_state'] == 'Perlis'){echo "selected=\"selected\"";}?>>Perlis</option>
                <option value="Sabah" <?php if($row['r_state'] == 'Sabah'){echo "selected=\"selected\"";}?>>Sabah</option>
                <option value="Sarawak" <?php if($row['r_state'] == 'Sarawak'){echo "selected=\"selected\"";}?>>Sarawak</option>
                <option value="Selanggor" <?php if($row['r_state'] == 'Selanggor'){echo "selected=\"selected\"";}?>>Selanggor</option>
                <option value="Terengganu" <?php if($row['r_state'] == 'Terengganu'){echo "selected=\"selected\"";}?>>Terengganu</option>
            </select>
            </div>
            <div class="form-group">
            <label>Home Address</label>
            <input type="text" class="form-control" readonly name="c_address" value="<?=$row['c_address']?>" >
            </div>
            <div class="form-group">
            <label>Postcode</label>
            <input type="text" class="form-control" readonly name="c_postcode" value="<?=$row['c_postcode']?>" >
            </div>
            <div class="form-group">
            <label>State</label>
            <select name="c_state" disabled class="form-control" >
                <option value="-">-</option>
                <option value="Johor" <?php if($row['c_state'] == 'Johor'){echo "selected=\"selected\"";}?>>Johor</option>
                <option value="Kedah" <?php if($row['c_state'] == 'Kedah'){echo "selected=\"selected\"";}?>>Kedah</option>
                <option value="Kelantan" <?php if($row['c_state'] == 'Kelantan'){echo "selected=\"selected\"";}?>>Kelantan</option>
                <option value="Melaka" <?php if($row['c_state'] == 'Melaka'){echo "selected=\"selected\"";}?>>Melaka</option>
                <option value="Negeri Sembilan" <?php if($row['c_state'] == 'Negeri Sembilan'){echo "selected=\"selected\"";}?>>Negeri Sembilan</option>
                <option value="Pahang" <?php if($row['c_state'] == 'Pahang'){echo "selected=\"selected\"";}?>>Pahang</option>
                <option value="Penang" <?php if($row['c_state'] == 'Penang'){echo "selected=\"selected\"";}?>>Penang</option>
                <option value="Perak" <?php if($row['c_state'] == 'Perak'){echo "selected=\"selected\"";}?>>Perak</option>
                <option value="Perlis" <?php if($row['c_state'] == 'Perlis'){echo "selected=\"selected\"";}?>>Perlis</option>
                <option value="Sabah" <?php if($row['c_state'] == 'Sabah'){echo "selected=\"selected\"";}?>>Sabah</option>
                <option value="Sarawak" <?php if($row['c_state'] == 'Sarawak'){echo "selected=\"selected\"";}?>>Sarawak</option>
                <option value="Selanggor" <?php if($row['c_state'] == 'Selanggor'){echo "selected=\"selected\"";}?>>Selanggor</option>
                <option value="Terengganu" <?php if($row['c_state'] == 'Terengganu'){echo "selected=\"selected\"";}?>>Terengganu</option>
            </select>
            </div>
            
            <!--<div class="form-group">
            <label>Outstanding Left</label>
            <input type="text" readonly class="form-control" name="o_l" value="<?php echo $left=$row['outstanding']-$row2['amo']; //if($left<=0){echo 0;}else{ echo $left;}?>" >
            </div>-->
            <!-- <div class="form-group">
                <div class="col-md-4">
                <label>Payment Method</label>
                <select name="p_mothod" id="pay" class="form-control" >
                    <option value="ptpk" <?php if($row['p_method'] == 'ptpk'){echo "selected=\"selected\"";}?>>PTPK</option>
                    <option value="cash" <?php if($row['p_method'] == 'cash'){echo "selected=\"selected\"";}?>>Cash</option>
                    <option value="semester" <?php if($row['p_method'] == 'semester'){echo "selected=\"selected\"";}?>>Semester</option>
                    <option value="l_payment" <?php if($row['p_method'] == 'l_payment'){echo "selected=\"selected\"";}?>>Last Payment</option>
                    
                </select>
                </div>
                <div class="col-md-8">
                <label>Payment Permonth RM</label>
                <input type="text" class="form-control" name="cost" value="<?=$row['cost_per_month']?>" >
                </div>
                <div class="col-md-12">
                <input id="c_se" type="checkbox" name="c_se" />Check if the semester need to edit
                </div>
                
            </div> -->
            <?php if($row['h_status'] == 'YES'){?>
            <div class="panel panel-info">
                <header class="panel-heading">
                    <!-- <h3 class="panel-title"><input type="checkbox" id="hostel" name="hostel" value="hostel" checked> Check if stay hostel</h3> -->
                    <h3 class="panel-title"><input type="checkbox" id="hostel" name="hostel" value="hostel" onclick="validate()" checked> Check if stay hostel</h3>
                </header>
                <div class="panel-body" id="panel" style="display:none">
                    <?php 
                    $query="select * from student_detail where s_id='".$_GET['id']."'";
                    $sttr=mysqli_query($conn,$query);
                    $result=mysqli_fetch_array($sttr);
        
                    ?>
                    <div class="col-md-12">
                        <div class="form-group">
                        <label>Parent Name</label>
                        <input type="text" class="form-control" name="p_name" id="p_name" value="<?php echo $result['p_name']; ?>" >
                        </div>
                        <div class="form-group">
                        <label>Parent Contact</label>
                        <input type="text" class="form-control" name="p_con" id="p_con" value="<?php echo $result['p_phone'] ?>">
                        </div>
                        <div class="form-group">
                        <label>PP Name</label>
                        <select name="pp_name" class="form-control">
                            <option>Choose</option>
                            <?php 
                            $query="select * from login where l_status='ACTIVE' and level='pp'";
                            $sttr=mysqli_query($conn,$query);
                            while($result=mysqli_fetch_array($sttr)){
                                
                            
                            ?>
                            <option <?php if($result['l_name']==$row['l_name']){echo "selected='selected'";} ?> value="<?php echo $result['l_name']?>"><?php echo $result['l_name']?></option>
                            <?php } ?>
                        </select>
                        </div>
                        <div class="form-group">
                        <label>Check in date</label>
                        <div class="input-group date form_date" data-date="" data-date-format="dd-mm-yyyy" data-link-field="dtp_input4" data-link-format="yyyy-mm-dd">
<input class="form-control" size="16" type="text" value="" >
<span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
</div>
<input type="hidden" name="check_in" id="dtp_input4" value="" />
                        </div>
                        <div class="form-group">
                        <label>Hostel</label>
                        <select name="hostel1" class="form-control">
                            <option>~Hostel~</option>
                             <?php
                                                $c_qry = "SELECT * FROM hostel WHERE h_status = 'ACTIVE'";
                                                $c_result = mysqli_query($conn, $c_qry);
												
												
                                                while ($c_row = mysqli_fetch_array($c_result))
                                                {
													 $spite=explode(" ",$c_row['h_gender']);
													  $count="select count(id) as count from student_detail where h_id='".$c_row['id']."' and s_status='ACTIVE'";
													 $result_c=mysqli_query($conn,$count);
													 $num=mysqli_fetch_array($result_c);
													 $slot=$c_row['slot']-$num['count'];
													 if($spite[0]<>"LECTURER"){
                                                    ?>
                                                    <option value="<?= $c_row['id'] ?>"><?= $c_row['h_address'] ?> (<?= $c_row['h_gender'] ?>)(Slot avaible:<?php if($slot>0){echo $slot;}else{echo "no slot avaible";} ?>)</option>
                                                <?php }} ?>
                        </select>
                        </div>
                        
                    </div>
                </div>
            </div>
            <?php }else{?>
            <div class="panel panel-info">
                <header class="panel-heading">
                    <!-- <h3 class="panel-title"><input type="checkbox" id="hostel" name="hostel" value="hostel"> Check if stay hostel</h3> -->
                    <h3 class="panel-title"><input type="checkbox" id="hostel" name="hostel" value="hostel" onclick="validate()"> Check if stay hostel</h3>
                </header>
                <!--<div class="panel-body" id="panel" style="display:none">  
                    <div class="col-md-12">
                        <div class="form-group">
                        <label>Parent Name</label>
                        <input type="text" class="form-control" name="p_name" id="p_name" value="" >
                        </div>
                        <div class="form-group">
                        <label>Parent Contact</label>
                        <input type="text" class="form-control" name="p_con" id="p_con" value="">
                        </div>
                        <div class="form-group">
                        <label>PP Name</label>
                        <select name="pp_name" class="form-control">
                            <option>Choose</option>
                            <?php 
                            $query="select * from login where l_status='ACTIVE' and level='pp'";
                            $sttr=mysqli_query($conn,$query);
                            while($result=mysqli_fetch_array($sttr)){
                                
                            
                            ?>
                            <option value="<?php echo $result['l_name']?>"><?php echo $result['l_name']?></option>
                            <?php } ?>
                        </select>
                        </div>
                        <div class="form-group">
                        <label>Check in date</label>
                        <div class="input-group date form_date" data-date="" data-date-format="dd-mm-yyyy" data-link-field="dtp_input4" data-link-format="yyyy-mm-dd">
<input class="form-control" size="16" type="text" value="" >
<span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
</div>
<input type="hidden" name="check_in" id="dtp_input4" value="" />
                        </div>
                        <div class="form-group">
                        <label>Hostel</label>
                        <select name="hostel" class="form-control">
                            <option>~Hostel~</option>
                             <?php
                                                $c_qry = "SELECT * FROM hostel WHERE h_status = 'ACTIVE'";
                                                $c_result = mysqli_query($conn, $c_qry);
												
												
                                                while ($c_row = mysqli_fetch_array($c_result))
                                                {
													 $spite=explode(" ",$c_row['h_gender']);
													  $count="select count(id) as count from student_detail where h_id='".$c_row['id']."' and s_status='ACTIVE'";
													 $result_c=mysqli_query($conn,$count);
													 $num=mysqli_fetch_array($result_c);
													 $slot=$c_row['slot']-$num['count'];
													 if($spite[0]<>"LECTURER"){
                                                    ?>
                                                    <option if($row['h_id']==$c_result['id']){echo "selected='selected'";} value="<?= $c_row['id'] ?>"><?= $c_row['h_address'] ?> (<?= $c_row['h_gender'] ?>)(Slot avaible:<?php if($slot>0){echo $slot;}else{echo "no slot avaible";} ?>)</option>
                                                <?php }} ?>
                        </select>
                        </div>
                        
                    </div>
                </div>-->
            </div>
            <?php }?>
        </div>
        
        <div class="col-md-2"></div>
        
        <div class="col-md-5">
            
            <div class="form-group">
            <label>Chinese Name</label>
            <input type="text" readonly class="form-control" name="c_name" value="<?=$row['chinese_name']?>" >
            </div>
            <div class="form-group">
            <label>Email</label>
            <input type="text" readonly class="form-control" name="email" value="<?=$row['s_email']?>" >
            </div>
            <div class="form-group">
            <label>Student ID No.</label>
            <input type="text" readonly class="form-control" name="s_id" value="<?=$row['s_id']?>" >
            </div>
            <div class="form-group">
            <label>Contact(Home)</label>
            <input type="text" readonly class="form-control" name="h_contact" value="<?=$row['h_contact']?>" >
            </div>
            <div class="form-group">
            <label>Contact(H/P)</label>
            <input type="text" readonly class="form-control" name="hp_contact" value="<?=$row['hp_contact']?>" >
            </div>
            <div class="form-group">
            <label>Contact(Guardian)</label>
            <input type="text" readonly class="form-control" name="guardian" value="<?=$row['guardian']?>" >
            </div>
            <!--<div class="form-group">
            <label>School</label>
            <input type="text" class="form-control" name="school" value="<?=$row['school']?>" >
            </div>-->
            <div class="form-group">
            <label>Birthday</label>
            <input type="text" readonly class="form-control" value="" name="birthday" id="birthday" />
            </div>
            <div class="form-group">
            <label>Age</label>
            <input type="text" readonly class="form-control" name="age" value="<?=$row['age']?>" >
            </div>
            <div class="form-group">
            <label>Gender</label>
            <select name="gender" disabled class="form-control" >
                <option value="Male" <?php if($row['gender'] == 'Male'){echo "selected=\"selected\"";}?>>Male</option>
                <option value="Female" <?php if($row['gender'] == 'Female'){echo "selected=\"selected\"";}?>>Female</option>
            </select>
            </div>
            <div class="form-group">
            <label>Marital Status</label>
            <select name="m_status" disabled class="form-control" >
                <option value="Single" <?php if($row['m_status'] == 'Single'){echo "selected=\"selected\"";}?>>Single</option>
                <option value="Married" <?php if($row['m_status'] == 'Married'){echo "selected=\"selected\"";}?>>Married</option>
            </select>
            </div>
            <div class="form-group">
                <label>Religion</label>
                <select name="religion" disabled class="form-control" >
                    <option value="Buddhism" <?php if($row['religion'] == 'Buddhism'){echo "selected=\"selected\"";}?>>Buddhism</option>
                    <option value="Christianity" <?php if($row['religion'] == 'Christianity'){echo "selected=\"selected\"";}?>>Christianity</option>
                    <option value="Daoism" <?php if($row['religion'] == 'Daoism'){echo "selected=\"selected\"";}?>>Daoism</option>
                    <option value="Hinduism" <?php if($row['religion'] == 'Hinduism'){echo "selected=\"selected\"";}?>>Hinduism</option>
                    <option value="Islam" <?php if($row['religion'] == 'Islam'){echo "selected=\"selected\"";}?>>Islam</option>
                </select>
            </div>
            <div class="form-group">
                <label>Date Join</label>
                <input type="text" class="form-control" readonly name="join_date" id="dtp_input3" value="<?=$row['date_join']?>" />
            </div>
            <div class="form-group">
            <label>Course</label>
            <select name="course" disabled class="form-control" >
                <option value="">Choose</option>
                <option value="Testing" <?php if($row['course'] == 'Testing'){echo "selected=\"selected\"";}?>>Testing</option>
                <option value="Networking" <?php if($row['course'] == 'Networking'){echo "selected=\"selected\"";}?>>Networking</option>
                <option value="Multimedia" <?php if($row['course'] == 'Multimedia'){echo "selected=\"selected\"";}?>>Multimedia</option>
                <option value="Electronic" <?php if($row['course'] == 'Electronic'){echo "selected=\"selected\"";}?>>Electronic</option>
                <option value="Programming" <?php if($row['course'] == 'Programming'){echo "selected=\"selected\"";}?>>Programming</option>
                <option value="Accounting" <?php if($row['course'] == 'Accounting'){echo "selected=\"selected\"";}?>>Accounting</option>
            </select>
            </div>
    </div>  
</div>
        </div>
        <!-- /.row -->
<?php require('footer.php');?>
<script>
    $("#create").on("click", function(){
        var e_date=$("#dtp_input2").val();
        var cer_date=$("#dtp_input3").val();
        var lvl=$("#lvl").val();
        var cel=$("#cel_no").val();
        $.post('create.php',{exam:e_date,cer:cer_date,level:lvl,no:cel,sid:<?=$_GET["id"]?>},
		function(result){
			$("#label").html(result);
            location.reload();
		});
    });
    $(".delete").on("click", function(){
        var id=$(this).val();
        //alert(id);
        $.post("create.php",{delete:id},
            function(result){
                //alert(result);
                $("#label").html(result);
                location.reload();
                
        });
    });
    $(document).on("change","#semester_month",function(){
    var a=$("#dtp_input5").val();
    var from = a.split("-")
    
    var b=new Date();
    var c=b.getMonth()+1;
    var d=b.getFullYear();
    var month= parseInt(from[0]);
    /*var milliseconds  = Date.parse(1,from[1]-1, from[0]);
    var miliseconds_now=Date.parse(b);
    var total=milliseconds-miliseconds_now;*/
    var year=from[1]-d;
    var t_month=0;
    if(year>0){
       t_month=month+12;
    }
    else{
        t_month=month;
    }
    
    var month_left=t_month-c;
          
    if(month_left<=6 && month_left>=0){
        $("#semester").val(month_left);
    }else{
         $("#semester").val("Not valid month");
    }
});
function validate(){
	
}

/*$(document).ready(function () {
    $("#pp").change(function () {
		$("#group").empty();
		$("#group").append('<option value="">Choose</option>');
        var val = $(this).val();
		<?php
			$c_qry = "SELECT * FROM student_group WHERE g_status = 'ACTIVE'";
			$c_result = mysqli_query($conn,$c_qry);
			while($c_row = mysqli_fetch_array($c_result)){
				
		?>
		
		if (val == "<?=$c_row['p_id']?>") {
			$("#group").append('<option value="<?=$c_row['id']?>"><?=$c_row['g_name']?></option>');
}
		<?php }?>
    });
});

$(document).ready(function () {
		$("#group").empty();
		$("#group").append('<option value="">Choose</option>');
        var val = $('select[name=pp]').val();
        var val1 = $('#sg').val();
		<?php
			$c_qry = "SELECT * FROM student_group WHERE g_status = 'ACTIVE'";
			$c_result = mysqli_query($conn,$c_qry);
			while($c_row = mysqli_fetch_array($c_result)){
				
		?>
		
		if(val1 == <?=$c_row['id']?>){ var val2 = "selected=\"selected\"";}else { var val2 = '';}
		if (val == "<?=$c_row['p_id']?>") {
			$("#group").append('<option value="<?=$c_row['id']?>"' + val2 + '><?=$c_row['g_name']?></option>');
}
		<?php }?>
});*/
$(document).ready(function () {
    
        var a=$("#ic").val();
        //console.log(a);
        var year=a.slice(0,2);
        var month=a.slice(2,4);
        var day=a.slice(4,6);
        

        if(year>=90){
          var birthday="19"+year+"-"+month+"-"+day;
        }else{
          var birthday="20"+year+"-"+month+"-"+day;
        }

        $("#birthday").val(birthday);


    
    $("#pp").change(function () {
		$("#group").empty();
        var val = $(this).val();
		$("#group").empty();
		$("#group").append('<option value="">Choose</option><option value="Testing" <?php if($row['p_id'] == 'Testing'){echo "selected=\"selected\"";}?>>Testing</option>');

		<?php
			$c_qry = "SELECT * FROM student_group WHERE g_status = 'ACTIVE'";
			$c_result = mysqli_query($conn,$c_qry);
			while($c_row = mysqli_fetch_array($c_result)){

		?>

		if (val == "<?=$c_row['p_id']?>") {
			$("#group").append('<option value="<?=$c_row['id']?>"><?=$c_row['g_name']?></option>');
		}
		<?php }?>
    });
});

$(document).ready(function () {
		$("#group").empty();
		$("#group").append('<option value="">Choose</option><option value="Testing" <?php if($row['g_id'] == 'Testing'){echo "selected=\"selected\"";}?>>Testing</option>');
        var val = $('select[name=pp]').val()
		<?php
			$c_qry = "SELECT * FROM student_group WHERE g_status = 'ACTIVE'";
			$c_result = mysqli_query($conn,$c_qry);
			while($c_row = mysqli_fetch_array($c_result)){
				
		?>
		
		if (val == "<?=$c_row['p_id']?>") {
			$("#group").append('<option value="<?=$c_row['id']?>" <?php if($row['g_id'] == $c_row['id']){echo "selected=\"selected\"";}?>><?=$c_row['g_name']?></option>');
}
		<?php }?>
});
</script>
<script>
	$(document).on("change","#c_se",function(){
		
		if(this.checked){
			$("#smr").attr("style","display:block;")
		}
		else{
			$("#smr").attr("style","display:none;")
		}
	});
</script>
