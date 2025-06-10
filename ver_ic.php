<?php 
include("include/db.php");
if(isset($_POST["submit"])){
    $qry="select * from student where ic='".$_POST['ic']."'";
    $sttr=mysqli_query($conn,$qry);
    $num=mysqli_num_rows($sttr);
    $row=mysqli_fetch_array($sttr);
    if($num>0){

        echo "<script>
            window.location.href='get_cer.php?id=$row[0]'
        </script>";
    }else{
        echo "<script>
        alert('Ic is not correct');
        //window.location.href='get_cer.php?id=$row[0]'
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
        <div class="row">
        <form action="ver_ic.php" method="post" >
            <div class="form-group">
                <div class="col-md-7">
                    <label>IC</label>
                    <input type="text" class="form-control" name="ic" value=""  />
                </div>
            </div>
            
            <div class="form-group">
                <div class="col-md-6">
                <button type="submit" class="btn btn-primary" name="submit" >Enter</button>
                </div>
            </div>
        </div>
        </form>
    </div>

</body>
