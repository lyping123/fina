<?php 
require ('include/db.php');
$value=$_POST['value'];

if($value=="Hostel Fee"){
if(isset($_POST['id'])){
    $id=$_POST['id'];
}else{
    $id=0;
}

$qry="select * from f_receipt_detail where r_id='".$id."' and rp_desc like '%hostel fee%'";
$sttr=mysqli_query($conn,$qry);
$rows=mysqli_num_rows($sttr);

if ($rows>0) {
    $selected="selected='selected'";
}else{
    $selected="";
}
?>
                                <div class="form-group">
                                    <label style="color: red;">* Choose yes if need to set next payment date(e.g pay hostel fee), otherwise choose no(e.g pay only pay hostel upgrade, or hostel deposit, or security deposit.).</label>
                                    <select name="h_type" id="h_type" class="form-control" required>
                                        <option value="" >Choose</option>
                                        <option  value="1" <?php if($rows>0){echo "selected='selected'"; }?> >Yes</option>
                                        <option value="2" <?php if($rows==0){echo "selected='selected'"; }?> >No</option>
                                    </select>
                                </div>
								<div id="step5"></div><?php }else if($value=="Tuition Fee"){?>

<!-- <div class="form-group">
    <label>start date</label>
    <div class="input-group date form_date" data-date="" data-date-format="dd-mm-yyyy" data-link-field="dtp_input1" data-link-format="yyyy-mm-dd">
		<input class="form-control" size="16" type="text" value="" required>
		<span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
		<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
	</div>
	<input type="hidden" name="s_date" id="dtp_input1" value="" />
    <label>end date</label>
    <div class="input-group date form_date" data-date="" data-date-format="dd-mm-yyyy" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
		<input class="form-control" size="16" type="text" value="" required>
		<span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
		<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
	</div>
	<input type="hidden" name="e_date" id="dtp_input2" value="" />
</div> -->

<?php } ?>
                               
<script>  
$('#h_type').on('change',function(){   
    var date_select=$('#h_type').val(); 
    var id=<?php echo $id; ?>;
    $.post('hosteltype.php',{value:date_select,id:id},
    function(result){
        $('#step5').html(result);
    });
});
    $(document).ready(function(){  
    var id=<?php echo $id; ?>;
    var date_select=$('#h_type').val();   
    $.post('hosteltype.php',{value:date_select,id:id},
    function(result){
        $('#step5').html(result);
    });
});
</script>

								