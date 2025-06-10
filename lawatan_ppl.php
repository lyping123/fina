<?php 
require('include/include.php');
require('header.php');
$system_msg='';
$course = '';
$course1 = '';
if(isset($_GET['action']) && $_GET['action'] == 'msg_fail_add'){
	$system_msg .= systemMsg('alert-danger','Fail!','Fail to add Lawatan PPL.');
}elseif(isset($_GET['action']) && $_GET['action'] == 'msg_success_add'){
	$system_msg .= systemMsg('alert-success','Success!','Successfully add Lawatan PPL .');	
}

if(isset($_SESSION['dp']) && $_SESSION['dp'] == 'Department Head'){
	$course .= " AND c_id = '".$_SESSION['course']."'";
	$course1 .= " AND id = '".$_SESSION['course']."'";
}else{
	$course = '';
	$course1 = '';
}
?>

<style>
.poiter:hover{
    background-color: blue;
    color:white;
}

</style>
    <!-- Page Content -->
    <div class="container">
<?php if(isset($system_msg)){echo $system_msg;}?>
        <!-- Page Header -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Lawatan PPL
                    <!--<small>Secondary Text</small>-->
                </h1>
            </div>
        </div>
        <!-- /.row -->

        <!-- Projects Row -->
        <div class="row">
        
<div class="panel panel-info">
    <header class="panel-heading">
    <h3 class="panel-title">PPL Information</h3>
    </header>
    <div class="panel-body">
        <form class="form-horizontal" method="post" action="add_ppl.php" enctype="multipart/form-data">    
        <div class="col-md-5">
            <div class="form-group">
            <label>PPL name:</label>
            <input type="text" class="form-control" name="pname" onchange="loadDoc(this.value);" id="pname" value="" required>
            <div id="space" >
            </div>
            </div>
			
			<div class="form-group">
            <label>Contact Number</label>
            <input type="text" name="cnum" class="form-control" id="cnum"  value="" />
            </div>
			
			<div class="form-group">
            <label>IC:</label>
            <input type="text" name="ic" class="form-control" id="ic" value="" />
            </div>
            <div class="form-group">
            <label>Email</label>
            <input type="text" name="email" class="form-control" id="email" value="" />
            </div>
            <div class="form-group">
            <label>Address</label>
            <textarea class="form-control" name="address" type="text" id="address" rows="3"></textarea>
            </div>
            
            
		</div>
		<div class="col-md-2"></div>
        <div class="col-md-5">
            <div class="form-group">
            <label>Course</label>
            <select name="course" class="form-control" id="course" required>
                <option value="">Choose</option>
                <?php
					$c_qry = "SELECT * FROM course WHERE status = 'ACTIVE'".$course1;
					$c_result = mysqli_query($conn,$c_qry);
					while($c_row = mysqli_fetch_array($c_result)){
				?>
                <option value="<?=$c_row['id']?>"><?=$c_row['course']?></option>
                <?php }?>
            </select>
            </div>
            <div class="form-group">
            <label>Start Date</label>
            <div class="input-group date form_date" data-date="" data-date-format="dd-mm-yyyy" data-link-field="sd" data-link-format="yyyy-mm-dd">
            <input class="form-control" size="16" type="text" value="" required >
            <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
            </div>
            <input type="hidden" name="sd" id="sd" value="" />
            </div>
			
            <div class="form-group">
            <label>End date</label><br>
            <div class="input-group date form_date" data-date="" data-date-format="dd-mm-yyyy" data-link-field="ed" data-link-format="yyyy-mm-dd">
            <input class="form-control" size="16" type="text" value="" required >
            <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
            </div>
            <input type="hidden" name="ed" id="ed" value="" />
            </div>
            <div class="form-group">
                <label>Verification date</label>
                <input type="text" name="daterange" value="" class="form-control" required/>
            </div>
            <div class="form-group">
                <label>Comment:</label>
                <textarea class="form-control" name="comment" type="text" rows="5"></textarea>
            </div>
            <div class="form-group">
                <label>PPL Information:</label>
                <textarea class="form-control" name="ppl_info" type="text" rows="5"></textarea>
            </div>
     
		</div>
        
        <div class="col-md-12">
            <div class="form-group">
            	<button type="submit" class="btn btn-primary" name="submit" value="save"><i class=""></i> Save </button>
            </div>
        </div>
        </form>
</div>
        </div>
        <!-- /.row -->
<?php require('footer.php');?>

<script>
    function choose(doc){
        var cpname=doc.innerText;
        //alert(pname);
        var textbox=document.getElementById("pname");
        textbox.value=cpname;
        var a=document.getElementById("space");
        a.innerHTML="";
        loadDoc(cpname);
    }
    function loadDoc(str) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            let json=JSON.parse(this.responseText);
            document.getElementById("ic").value = json["ic"];
            document.getElementById("cnum").value = json["cnum"];
            document.getElementById("email").value = json["email"];
            document.getElementById("address").value = json["address"];
            $("option[value='"+json["course"]+"']").attr("selected","selected");
        }
    };
    xhttp.open("GET", "ppl.php?value="+str, true);
    xhttp.send();
}
</script>
<script>
$(document).ready(function () {
    $("#course").change(function () {
		$("#jpkpp").empty();
		$("#pp").empty();
		$("#jpkpp").append('<option value="">Choose</option>');
		$("#pp").append('<option value="">Choose</option>');
        var val = $(this).val();
        $.post("pp.php", { value: val },  
            function(result){  
        		$("#jpkpp").append(result);
        		$("#pp").append(result);
				$('.selectpicker').selectpicker('refresh');
            }); 
    });
    $("#pname").on("keypress", function(){
        var pname=$(this).val();
        //console.log(pname);
        $.post("checkppl.php",{ppname:pname},
        function(result){
            let json=JSON.parse(result);
            let count=json.length;
            //alert(count);
            $("#space").html("");
            for(let i=0;i<count;i++){
                $("#space").append("<span class='poiter' onclick='choose(this)' style='cursor:pointer'>"+json[i]+"</span><br>");
            }
            //alert(result["address"]);
        });
    });
    $(function() {
			$('input[name="daterange"]').daterangepicker({
				opens: 'left'
			}, function(start, end, label) {
				console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
			});
			});
   
    
});

// $("#pname").on("change", function(){
//         var pname=$(this).val();
//         //console.log(pname);
//         $.post("ppl.php",{value:pname},
//         function(result){
//             let json=JSON.parse(result);
//             $("#ic").val(json["ic"]);
//             $("#cnum").val(json["cnum"]);
//             $("#email").val(json["email"]);
//             $("#address").val(json["address"]);
//             $("option[value='"+json["course"]+"']").attr("selected","selected");
//             //alert(result["address"]);
//         });
//     });
</script>

