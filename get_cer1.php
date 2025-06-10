<?php 
include("include/db.php");



if(isset($_POST["submit"])){
    $array=array();
    $count=count($_POST['cel_no']);
    $a=$_POST["cel_no"];
    //$b=$_POST["exam_date"];
    $c=$_POST["c_date"];
    $d=$_POST["lvl"];
    for($i=0;$i<$count;$i++){
        $array[]="('$a[$i]','$c[$i]','$d[$i]','$_POST[name]')";
    }
    $newsql=implode(",",$array);
    $insert="insert into certificate(cel_no,certificate_date,level,s_id) values".$newsql;
    if(mysqli_query($conn,$insert)){
        echo "<script>
            alert('submit success');
        </script>";
    }else{
        echo "<script>
            alert('submit fail');
        </script>";
    }
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
    <div class="container">
    <a href='view_cercollection.php' >View collection list</a>
        <div class="row">
        <form action="" method="post">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3>certificate collection form</h3>
                    </div>
                    <div class="panel-body">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Student Name:</label>
                                <select class="selectpicker" name="name" id="name" data-live-search="true" required>
								<option value="">Choose</option>
								<?php
								$s_qty = "SELECT id,s_name FROM student WHERE s_status <> 'DELETE'";	
								$s_result = mysqli_query($conn, $s_qty);
								while($s_row = mysqli_fetch_array($s_result)){
								?>
								<option value="<?=$s_row['id']?>"><?=$s_row['s_name']?></option>
								<?php
								}
								?>
								</select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <!-- <div class="form-group">
                                <label>File NO:</label>
                                <input type="text" name="file_no" class="form-control" placeholder="file NO" value="" />
                            </div> -->
                            <div class="form-group">
                                <fieldset>
                                    <legend>Certificated information</legend>
                                    <input type="checkbox" id='ck2' value="2" /> Level 2 <input type="checkbox" id='ck3' value='3' /> Level 3 <input type="checkbox" id='ck4' value='4' /> Level 4 <input type="checkbox" id='ck1' value='Singer_tier' /> Singer Tier
                                    <button type="button" id="ckbtn" onclick="checklvl();" class="btn btn-success"><span class="	glyphicon glyphicon-plus"></span></button>
                                    <div id="cel">

                                    </div>


                                    <!-- <label>Cel No</label>
                                    <input type="text" name="cel_no" id="cel_no" class="form-control" placeholder="cel NO"  />
                                    <label>Exam date:<label>
                                    <div class="input-group date form_date" data-date="" data-date-format="dd-mm-yyyy" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
                                    <input class="form-control" size="16" type="text" value="" >
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                    </div>
                                    <input type="hidden" name="birthday" id="dtp_input2" value="" />
                                            <label>Certificate receive date:<label>
                                            <div class="input-group date form_date" data-date="" data-date-format="dd-mm-yyyy" data-link-field="dtp_input3" data-link-format="yyyy-mm-dd">
                                    <input class="form-control" size="16" type="text" value="" >
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                    </div>
                                    <input type="hidden" name="birthday" id="dtp_input3" value="" />
                                    <label>Level</label>
                                    <select name="lvl" id="lvl" class="form-control">
                                        <option value="2">Level 2</option>
                                        <option value="3">Level 3</option>
                                        <option value="4">Level 4</option>
                                        <option value="Singer_tier">Singer tier</option>
                                    </select> -->
                                
                                    <br>
                                </fieldset>
                            </div>
                            <?php 
                                // $div="
                                // <div class='col-md-4'>
                                //     <div class='form-group'>
                                //     <label>Cel No</label>
                                //     <input type='text' name='cel_no[]' id='cel_no' class='form-control' placeholder='cel NO'  />
                                //     </div>
                                //     <div class='form-group'>
                                //     <label>Level </label>
                                //     <input type='text' name='lvl[]'  class='form-control' placeholder='Level' readonly  />
                                //     </div>
                                //     <div class='form-group'>
                                //     <label>certificated receive date</label>
                                //     <input type='date' name='c_date[]'  class='form-control' placeholder=''  />
                                //     </div>
                                // </div>";
                            
                            ?>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                    </div>
                </div>
            </div>
        </div>
        </form>
    </div>

<script>
    function checklvl(){
        document.getElementById("cel").innerHTML="";
        var ck2=document.getElementById("ck2");
        var ck3=document.getElementById("ck3");
        var ck4=document.getElementById("ck4");
        var ck1=document.getElementById("ck1");
        var num=2;
        var i;

        if(ck2.checked==true){
            num+=1;
        }
        if(ck3.checked==true){
            num+=1;
            
        }
        if(ck4.checked==true){
            num+=1;
        }
        //console.log(num);
        if(ck1.checked==true){
            document.getElementById("cel").innerHTML="<div class='col-md-4'><div class='form-group'><label>Cel No</label><input type='text' name='cel_no[]' id='cel_no' class='form-control' placeholder='cel NO'  /></div><div class='form-group'><label>Level </label><input type='text' name='lvl[]'  class='form-control' placeholder='Level' value='"+ck1.value+"'   /></div><div class='form-group'><label>certificated collection date</label><input type='date' name='c_date[]'  class='form-control' placeholder=''  /></div></div>";
        }else{
            for(i=2;i<num;i++){
            document.getElementById("cel").innerHTML+="<div class='col-md-4'><div class='form-group'><label>Cel No</label><input type='text' name='cel_no[]' id='cel_no' class='form-control' placeholder='cel NO'  /></div><div class='form-group'><label>Level </label><input type='text' name='lvl[]'  class='form-control' placeholder='Level' value=''   /></div><div class='form-group'><label>certificated collection date</label><input type='date' name='c_date[]'  class='form-control' placeholder=''  /></div></div>";
        }
        }
       
    }
</script>
</body>
<?php include("footer.php"); ?>