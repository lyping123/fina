<style>
td.details-control {
    background: url('img/icon/details_open.png') no-repeat center center;
    cursor: pointer;
}
tr.shown td.details-control {
    background: url('img/icon/details_close.png') no-repeat center center;
}
</style>

<?php
require('include/include.php');
require('header.php');
$system_msg='';
if(isset($_GET['action']) && $_GET['action'] == 'msg_success_add'){
	$system_msg .= systemMsg('alert-success','Success!','Successfully add Visitor Log.');	
}elseif(isset($_GET['action']) && $_GET['action'] == 'msg_login_success'){
	$system_msg .= systemMsg('alert-success','Welcome',$_SESSION['name']);	
}elseif(isset($_GET['action']) && $_GET['action'] == 'msg_success_del'){
	$system_msg .= systemMsg('alert-success','Success!','Successfully delete Visitor Log.');	
}elseif(isset($_GET['action']) && $_GET['action'] == 'msg_fail_del'){
	$system_msg .= systemMsg('alert-danger','Fail!','Fail to delete Visitor Log.');
}elseif(isset($_GET['action']) && $_GET['action'] == 'msg_success_unactive'){
	$system_msg .= systemMsg('alert-success','Success!','Successfully unactive Visitor Log.');	
}elseif(isset($_GET['action']) && $_GET['action'] == 'msg_fail_unactive'){
	$system_msg .= systemMsg('alert-danger','Fail!','Fail to unactive Visitor Log.');
}

$status = "ACTIVE";
if(isset($_GET['search']) && $_GET['search'] == 'search'){
	if(isset($_GET['status']) && $_GET['status'] == '1'){
		$status = " v_register_date != '' AND v_status = 'ACTIVE'";
	}elseif(isset($_GET['status']) && $_GET['status'] == '2'){
		$status = " status = 'ACTIVE' AND v_register_date = ''";
	}elseif(isset($_GET['status']) && $_GET['status'] == '3'){
		$status = " status = 'UNACTIVE'";
	}else{
		$status .= '';
	}
}
?>
<!-- Page Content -->

<div class="container-fluid">
  <?php 
	if(isset($system_msg)){echo $system_msg;}
$servername = "sv94.ifastnet.com";
$username = "synergyc";
$password = "synergy@central";
$database = "synergyc_synergyedu";
$conn = new mysqli($servername, $username, $password, $database);
	
mysqli_set_charset($conn, 'utf8');	



$qry = "SELECT * FROM students WHERE `status`='ACTIVE' ORDER BY created_at DESC";
$result = mysqli_query($conn,$qry);

$array = array();
$result1 = mysqli_query($conn,$qry);

while($r = mysqli_fetch_assoc($result1)) {
    $array[] = $r;
}


$file = fopen("ajax/objects.txt","w");
fwrite($file,"{".PHP_EOL);
fwrite($file,'"data":'.PHP_EOL);
fwrite($file,json_encode($array).PHP_EOL);
fwrite($file,"}");
fclose($file);
?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Pre Register List
            <!--<small>Secondary Text</small>-->
            <a class="btn btn-primary pull-right" href="print_prl.php" target="_blank"><span class="glyphicon glyphicon-plus"></span> Print </a>
        </h1>
    </div>
    <!--<div class="col-md-12">	
        <div class="form-group">
            <form action="visitor_list.php" method="get">
                <div class="row">
                    <div class="col-lg-3">
                        <label>Search By Status</label>
                        <div class="form-group">
                            <select class="form-control" name="status">
                            	<option value="">Choose</option>
                            	<option value="1">Registered</option>
                            	<option value="2">Not yet registered</option>
                            	<option value="3">Unactive</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-7">
                    </div>
                    <div class="col-lg-2">
						<div style="background-color:  red;border-radius: 10px;width: 20px;height: 20px;float:  left;"></div>
						<p>Status didn't update after 5 days</p>
						<div style="background-color:  yellow;border-radius: 10px;width: 20px;height: 20px;float:  left;"></div>
						<p>Already update status, but haven't register student yet</p>
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
</div>
    <div class="row">
        <div class="col-md-12">
            <table id="pre_register" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th></th>
                        <th>ID</th>
                        <th>Name</th>
                        <th>IC</th>
                        <th>Nationality</th>
                        <th>Race</th>
                        <th>Address</th>
                        <th>Postcode</th>
                        <th>State</th>
                    
                        <th>Contact(H/P)</th>
                        <th>Contact(Parent)</th>
                        <th>Pre register date</th>
                    </tr>
                </thead>
            
            </table>
        </div>
    </div>

    <div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <form action="add_comment.php" method="post">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Reject comment</h4>
      </div>
      <div class="modal-body">
         
        <textarea id="comment" name="comment" style="width:100%;height:200px;"></textarea>
      </div>
      <div class="modal-footer">

        <button type="submit" class="btn btn-default" name="sub" id="reject" value=""  >Submit</button>
      </div>
    </div>
    </form>
  </div>
</div>
  <!-- /.row -->
  <?php require('footer.php');?>
    
<script>
/* Formatting function for row details - modify as you need */
function format ( d ) {
    var birthday=d.ic_no;
    var str=birthday.substr(0,2);
    var year=new Date().getFullYear();
    var b_year;
    if(str.substr(0,1)==9){
        b_year=19;
    }else{
        b_year=20;
    }
    
    

    let age=parseInt(year)-parseInt(b_year+str);

    // `d` is the original data object for the row
    return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">'+
        '<tr>'+
            '<td>Email:</td>'+
            '<td>'+d.email+'</td>'+
        '</tr>'+
        '<tr>'+
            '<td>Birthday:</td>'+
            '<td>'+birthday+'</td>'+
        '</tr>'+
        '<tr>'+
            '<td>age:</td>'+
            '<td>'+age+'</td>'+
        '</tr>'+
        '<tr>'+
            '<td>Gender:</td>'+
            '<td>'+d.gender+'</td>'+
        '</tr>'+
        '<tr>'+
            '<td>Marital Status:</td>'+
            '<td>'+d.marital_status+'</td>'+
        '</tr>'+
        // '<tr>'+
        //     '<td>Religion:</td>'+
        //     '<td>'+d.religion+'</td>'+
        // '</tr>'+
        '<tr>'+
            '<td>Secondary_School:</td>'+
            '<td>'+d.secondary_school+'</td>'+
        '</tr>'+
        '<tr>'+
            '<td>course:</td>'+
            '<td>'+d.course+'</td>'+
        '</tr>'+
        '<tr>'+
            '<td>Pre Register Date:</td>'+
            '<td>'+d.created_at+'</td>'+
        '</tr>'+
        '<tr>'+
            '<td><button type="button" onclick="register(this)" value="'+d.id+'">register</button></td>'+
        '</tr>'+
        '<tr>'+
            '<td><button type="button" onclick="deleterow(this)" value="'+d.id+'">delete</button></td>'+
        '</tr>'+
        '<tr>'+
            '<td><button type="button" onclick="passid(this);"  data-toggle="modal" data-id="'+d.id+'" data-target="#myModal" >Reject</button>'+
        '</tr>'+
    '</table>';
}
 
$(document).ready(function() {
    
    
    var table = $('#pre_register').DataTable( {
        
        "ajax": "ajax/load_pre.php?status=<?=$status?>",
        "columns": [
            {
                "className":      'details-control',
                "orderable":      false,
                "data":           null,
                "defaultContent": ''
            },
            { "data": "id" },
            { "data": "full_name" },
            { "data": "ic_no" },
            { "data": "nationality" },
            { "data": "race" },
            { "data": "address" },
            { "data": "postcode" },
            { "data": "state" },
            { "data": "contact_no" },
            { "data": "guardian_contact_no" },
            { "data": "created_at" },
        ],
        "order": [[11, 'desc']]
    } );
     
    // Add event listener for opening and closing detail
    $('#pre_register tbody').on('click', 'td.details-control', function () {
        var tr = $(this).closest('tr');
        var row = table.row( tr );
 
        if ( row.child.isShown() ) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
        }
        else {
            // Open this row
            
            row.child( format(row.data()) ).show();
            tr.addClass('shown');
        }
    } );
    $('#pre_register tbody').on('click', 'button', function () {
        var data = table.row($(this).parents('tr')).data();
        //alert(data[5]);
    } );
    
} );

</script>

<script>
    function register(str) {
    var xhttp = new XMLHttpRequest();
    var id=str.value;
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            if(this.responseText=="success"){
                alert("register success");
                location.reload();
            }else if(this.responseText=="remove"){
                alert("this user already been register");
                location.reload();
            }else{
                alert("register fail");
            }

        }
    };
    xhttp.open("GET", "ajax_info.php?q="+id, true);
    xhttp.send();
    }
    function deleterow(str){
    var xhttp = new XMLHttpRequest();
    var id=str.value;
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            if(this.responseText=="success"){
                alert("delete success");
                location.reload();
            }else{
                alert("delete fail");
            }

        }
    };
    xhttp.open("GET", "ajax_info.php?d="+id, true);
    xhttp.send();
    }

    function passid(str){
        var id=str.getAttribute("data-id");
        document.getElementById("reject").value=id;
    }


    
</script>
