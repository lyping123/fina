<?php 
include("include/db.php");

$qry="select * from certificate as cr inner join student as s on s.id=cr.s_id where cr.s_id='".$_GET["id"]."'";
$sttr=mysqli_query($conn,$qry);
$div="";
$name="";

while($result=mysqli_fetch_array($sttr)){
    $name=$result["s_name"];
        $div.="
                                <div class='col-md-4'>
                                    <button type='button' class='btn btn-danger pull-right'  onclick='cleardiv(this);'><span class='glyphicon glyphicon-remove'></span></button>
                                    <div class='form-group'>
                                    <label>Cel No</label>
                                    <input type='text' name='cel_no[]' id='cel_no' class='form-control' placeholder='cel NO' value='$result[cel_no]' />
                                    </div>
                                    <div class='form-group'>
                                    <label>Level </label>
                                    <input type='text' name='lvl[]'  class='form-control' placeholder='Level' value='$result[level]'  />
                                    </div>
                                    <div class='form-group'>
                                    <label>certificated receive date</label>
                                    <input type='date' name='c_date[]'  class='form-control' placeholder='' value='$result[certificate_date]'  />
                                    </div>
                                </div>";
}


if(isset($_POST["submit"])){
    
    $array=array();
    $count=count($_POST['cel_no']);
    $a=$_POST["cel_no"];
    //$b=$_POST["exam_date"];
    $c=$_POST["c_date"];
    $d=$_POST["lvl"];
    if($_POST["name"]!==""){
        $update=mysqli_query($conn,"update certificate_receive set s_id='$_POST[name]' where s_id='$_GET[id]'");
        if($update){
            echo "<script>
                alert('edit success');
                window.location.href='view_cercollection.php';
            </script>";
        }else{
            echo "<script>
            alert('edit fail');
            window.location.href='view_cercollection.php'
        </script>";
        }
    }else{
        for($i=0;$i<$count;$i++){
            $array[]="('$a[$i]','$c[$i]','$d[$i]','$_POST[s_id]')";
        }
        $newsql=implode(",",$array);
        $delete=mysqli_query($conn,"delete from certificate where s_id='$_GET[id]'");
        $insert="insert into certificate(cel_no,certificate_date,level,s_id) values".$newsql;
        if(mysqli_query($conn,$insert)){
            echo "<script>
                alert('submit success');
                window.location.href='view_cercollection.php';
            </script>";
        }else{
            echo "<script>
                alert('submit fail');
                window.location.href='view_cercollection.php';
            </script>";
        }
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
        <div class="row">
        <form action="" method="post">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3>certificate collect form</h3>
                    </div>
                    <div class="panel-body">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Student Name: <?=$name?> </label>
                                <input type="hidden" name="s_id" value="<?=$_GET["id"]?>" />
                                <br>
                                <select class="selectpicker" name="name" id="name" data-live-search="true" >
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
                            <!-- <div class="form-group">
                                <label>Student Ic:</label>
                                <input type="text" name="s_ic" class="form-control" value="<?=$row["ic"]?>" readonly required />
                            </div>
                            <div class="form-group">
                                <label>Student Contact:</label>
                                <input type="text" name="s_contact" class="form-control" value="<?=$row["hp_contact"]?>"  required />
                            </div>
                            <div class="form-group">
                                <label>Course:</label>
                                <input type="text" name="course" class="form-control" value="<?=$row["course"]?>" readonly  />
                            </div> -->

                        </div>
                        <div class="col-md-12">
                            <!-- <div class="form-group">
                                <label>File NO:</label>
                                <input type="text" name="file_no" class="form-control" placeholder="file NO" value="" />
                            </div> -->
                            <div class="form-group">
                                <fieldset>
                                    <legend>Certificated information</legend>
                                    <!-- <input type="checkbox" id='ck2' value="2" /> Level 2 <input type="checkbox" id='ck3' value='3' /> Level 3 <input type="checkbox" id='ck4' value='4' /> Level 4 <input type="checkbox" id='ck1' value='Singer_tier' /> Singer Tier -->
                                    <button type="button" id="ckbtn" onclick="checklvl();" class="btn btn-success"><span class="	glyphicon glyphicon-plus"></span></button>
                                    <div id="cel">
                                        <?=$div;?>
                                    </div>


            
                                
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
                        <button type="submit" class="btn btn-primary" name="submit">Save</button>
                    </div>
                </div>
            </div>
        </div>
        </form>
    </div>

<script>
    // function checklvl(){
    //     document.getElementById("cel").innerHTML="";
    //     var ck2=document.getElementById("ck2");
    //     var ck3=document.getElementById("ck3");
    //     var ck4=document.getElementById("ck4");
    //     var ck1=document.getElementById("ck1");
    //     var num=2;
    //     var i;

    //     if(ck2.checked==true){
    //         num+=1;
    //     }
    //     if(ck3.checked==true){
    //         num+=1;
            
    //     }
    //     if(ck4.checked==true){
    //         num+=1;
    //     }
    //     //console.log(num);
    //     if(ck1.checked==true){
    //         document.getElementById("cel").innerHTML="<div class='col-md-4'><div class='form-group'><label>Cel No</label><input type='text' name='cel_no[]' id='cel_no' class='form-control' placeholder='cel NO'  /></div><div class='form-group'><label>Level </label><input type='text' name='lvl[]'  class='form-control' placeholder='Level' value='"+ck1.value+"'   /></div><div class='form-group'><label>certificated receive date</label><input type='date' name='c_date[]'  class='form-control' placeholder=''  /></div></div>";
    //     }else{
    //         for(i=2;i<num;i++){
    //         document.getElementById("cel").innerHTML+="<div class='col-md-4'><div class='form-group'><label>Cel No</label><input type='text' name='cel_no[]' id='cel_no' class='form-control' placeholder='cel NO'  /></div><div class='form-group'><label>Level </label><input type='text' name='lvl[]'  class='form-control' placeholder='Level' value=''   /></div><div class='form-group'><label>certificated receive date</label><input type='date' name='c_date[]'  class='form-control' placeholder=''  /></div></div>";
    //     }
    //     }
       
    // }

    function checklvl(){
        document.getElementById("cel").innerHTML+="<div class='col-md-4'><div class='form-group'><label>Cel No</label><input type='text' name='cel_no[]' id='cel_no' class='form-control' placeholder='cel NO'  /></div><div class='form-group'><label>Level </label><input type='text' name='lvl[]'  class='form-control' placeholder='Level' value=''   /></div><div class='form-group'><label>certificated receive date</label><input type='date' name='c_date[]'  class='form-control' placeholder=''  /></div></div>";
    }
    function cleardiv(e){
        e.parentNode.parentNode.removeChild(e.parentNode);
    }
</script>
</body>
<?php include("footer.php"); ?>