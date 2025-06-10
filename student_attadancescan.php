<?php 
require('include/include.php');
//require("header.php");

$system_msg='';
if(isset($_GET['action']) && $_GET['action'] == 'msg_success_add'){
	$system_msg .= systemMsg('alert-success','Success!','Successfully Submit.');	
}elseif(isset($_GET['action']) && $_GET['action'] == 'msg_fail_add'){
	$system_msg .= systemMsg('alert-success','Fail','Token code is uncorrect');	
}elseif(isset($_GET['action']) && $_GET['action'] == 'msg_success_del'){
	$system_msg .= systemMsg('alert-success','Success!','Successfully delete Group.');	
}elseif(isset($_GET['action']) && $_GET['action'] == 'msg_fail_del'){
	$system_msg .= systemMsg('alert-danger','Fail!','Fail to delete Group.');
}



?>
<head>

<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">

<title>Synergy College</title>

<!-- Bootstrap Core CSS -->
<link href="css/bootstrap.min.css" rel="stylesheet">

<!-- Custom CSS -->
<link href="css/3-col-portfolio.css" rel="stylesheet">

<link rel="stylesheet" href="css/styles.css">

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css'>
<link rel='stylesheet' href='https://rawgit.com/adrotec/knockout-file-bindings/master/knockout-file-bindings.css'>

<link href="css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
<link href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css" rel="stylesheet" media="screen">
<link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet" media="screen">

<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/css/bootstrap-select.min.css" />
</head>

<body>
<style>.dropdown-submenu{ position: relative; }

.dropdown-submenu>.dropdown-menu{
top:0;
left:100%;
margin-top:-6px;
margin-left:-1px;
-webkit-border-radius:0 6px 6px 6px;
-moz-border-radius:0 6px 6px 6px;
border-radius:0 6px 6px 6px;
}

.dropdown-submenu>a:after{
display:block;
content:" ";
float:right;
width:0;
height:0;
border-color:transparent;
border-style:solid;
border-width:5px 0 5px 5px;
border-left-color:#cccccc;
margin-top:5px;margin-right:-10px;
}
.dropdown-submenu:hover>a:after{
border-left-color:#555;
}
.dropdown-submenu.pull-left{ float: none; }
.dropdown-submenu.pull-left>.dropdown-menu{
left: -100%;
margin-left: 10px;
-webkit-border-radius: 6px 0 6px 6px;
-moz-border-radius: 6px 0 6px 6px;
border-radius: 6px 0 6px 6px;
}

@media (min-width: 768px) { 

}
@media (min-width: 992px) { 

}
@media (min-width: 1200px) { 

}
</style>
<div class="container">
<?php if(isset($system_msg)){echo $system_msg;} ?>
    <div class="row">
        <div class="col-md-12">
        
            <div class="panel panel-info">
                <header class="panel-heading">
                    <h3 class="panel-title">MY Synergy Student Check In </h3>
                </header>
                <div class="panel-body">
                    <form class="form-horizontal" method="post" action="add_att.php" enctype="multipart/form-data">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Student Ic</label><br>
								<!-- <select class="selectpicker"  name="name" id="name" data-live-search="true" required>
								<option value="">Choose</option>
								<?php
								$s_qty = "SELECT id,s_name FROM student WHERE s_status ='ACTIVE'";	
								$s_result = mysqli_query($conn, $s_qty);
								while($s_row = mysqli_fetch_array($s_result)){
								?>
								<option value="<?=$s_row['id']?>"><?=$s_row['s_name']?></option>
								<?php
								}
								?>
								</select> -->
                                <input type="text" onchange="searchphone(this.value);" name="s_ic" class="form-control" value="" />
                            </div>
                            <div class="form-group">
                                <label>Phone Number</label>
                                <input type="text" class="form-control" name="p_num" id="p_num"  />
                            </div>
                            <div class="form-group">
                                <label>Token code</label>
                                <input type="text" class="form-control" name="tk_code"   />
                            </div>

                        </div>
                        <div class="panel-footer">
                            <div class="col-md-12">
                                <button type="submit" name="add" value="add" class="btn btn-primary" >Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        
        </div>
        <?php 
            $qry="select * from student_tem as st
            inner join student as s on s.id=st.s_id
            where s.s_status='ACTIVE' order by st.s_date desc";
            $sttr=mysqli_query($conn,$qry);
        ?>
        
    </div>
   
</div>
   
</div>

<script>
    function searchphone(str){
        
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
            document.getElementById("p_num").value = this.responseText;
            }
        };
        xhttp.open("GET", "searchphone.php?q="+str, true);
        xhttp.send();
    }

</script>

<?php require("footer.php"); ?>