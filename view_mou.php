<?php 
include("include/db.php");
$qry="select * from mou where pro='yes' or net='yes'";
$result=mysqli_query($conn,$qry);
?>
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

    <link href="css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
    <link href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet" media="screen">
    
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/css/bootstrap-select.min.css" />
<div class="row">
        	<div class="col-md-12">
                <!--<div class="table-responsive">-->
                
                    <table id="example1" class="table table-bordred table-striped" style="width:100%">
                    
                        <thead>
                            <th>Company Name</th>
                            <th>Company Address</th>
                            <th>Company Tel</th>
                            <th>Name</th>
                            <th>Position</th>
                            <th>Tel</th>
                            <th>Email</th>
                            <th>Company website</th>
                          <th>Action</th> 
                        </thead>
                        <tbody>
                          <style>
                            .bg-danger {
                                background-color: #dc3545 !important;
                            }	  
                          </style>
							<?php while($row = mysqli_fetch_array($result)){?>
                            <?php
                           
                            ?>
                            <tr>
                              
                              <td><?=$row['c_name']?></td>
                              <td><?=$row['c_address']?></td>
                              <td><?=$row['c_tel']?></td>
                              <td><?=$row['name']?></td>     
                              <td><?=$row['position']?></td>     
                              <td><?=$row['tel']?></td>     
                              <td><?=$row['email']?></td>       
                              <td><a class="cus" onclick="window.open('<?=$row['link']?>', '_blank')" ><?=$row['link']?></a></td>
                               
                                  
                                  
                            </tr>
                            <?php }?>
                        </tbody>
                    </table>
                <!--</div>-->
            </div>
</div>
<?php include("footer.php") ?>