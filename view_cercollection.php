<?php 
include("include/db.php");

$qry="select cr.*,s.s_name, s.course,s.ic  from certificate  as cr 
inner join student as s on s.id=cr.s_id 
group by cr.s_id";
$sttr=mysqli_query($conn,$qry);

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
            <div class="col-lg-12">
                <h1 class="page-header">Certificate collection list
                    <!--<small>Secondary Text</small>-->
                </h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table id="example1" class="table table-bordred table-striped" style="width:100%">
                    <thead>
                        <th>Student Name</th>
                        <th>IC</th>
                        <th>Course</th>
                        <th>Cel No</th>
                        <th>Collected Date</th>
                        <th>Level</th>
                        <th></th>
                    </thead>
                    <tbody>
                        <?php 
                        while($result=mysqli_fetch_array($sttr)){ 
                        $select="select * from certificate where s_id='$result[s_id]'";
                        $sttr1=mysqli_query($conn,$select);
                        $num=mysqli_num_rows($sttr1);
                        $lvl="";
                        $cel="";
                        $date="";
                        if($num>1){
                            while($row=mysqli_fetch_array($sttr1)){
                                $lvl.=','.$row["level"];
                                $cel.=','.$row["cel_no"];
                                $date.=','.$row["certificate_date"];
                            }
                            $lvl=ltrim($lvl, ',');
                            $cel=ltrim($cel,",");
                            $date=ltrim($date,",");
                            
                        }else{
                            $row=mysqli_fetch_array($sttr1);
                            $lvl=$row["level"];
                            $cel=$row["cel_no"];
                            $date=$row["certificate_date"];
                            
                        }

                       
                        ?>
                        <tr>
                            <td><?=$result["s_name"]?></td>
                            <td><?=$result["ic"]?></td>
                            <td><?=$result["course"]?></td>
                            <td><?=$result["cel_no"]?></td>
                            <td><?=$result["certificate_date"]?></td>
                            <td><?=$lvl?></td>
                            <td><a href="edit_cer1.php?id=<?=$row["s_id"]?>" class="btn btn-primary">Edit</a></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php include("footer.php"); ?>
</body>

