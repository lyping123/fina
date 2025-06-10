<?php 
include("include/db.php");

if(isset($_POST["btn_sub"])){
    $insert="insert into customer_bill(`s_name`, `ic`, `p_type`, `payment`, `date_create`) values('$_POST[s_name]','$_POST[ic]','$_POST[payment_type]','$_POST[payment]','$_POST[c_date]')";
    if(mysqli_query($conn,$insert)){
        echo "<script>
            alert('add bill success');
        </script>";
    }else{
        echo "<script>
        alert('add bill fail');
    </script>";
    }
}

if(isset($_POST["btn_edit"])){
    $insert="update customer_bill set s_name='$_POST[s_name]', ic='$_POST[ic]', p_type='$_POST[payment_type]', payment='$_POST[payment]', date_create='$_POST[c_date]' where id='$_POST[btn_edit]'";
    if(mysqli_query($conn,$insert)){
        echo "<script>
            alert('edit bill success');
        </script>";
    }else{
        echo "<script>
        alert('edit bill fail');
    </script>";
    }
}



if(isset($_GET["action"]) && $_GET["action"]=="delete"){
    $delete="delete from customer_bill where id='$_GET[id]'";
    if(mysqli_query($conn,$delete)){
        echo "<script>
            alert('delete bill success');
        </script>";
    }else{
        echo "<script>
            alert('delete bill fail');
        </script>";
    }
}

$qry="select * from customer_bill";
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

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <form action="customer_bill.php" method="post">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3>Customer Bill</h3>
                    </div>
                    <div class="panel-body">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Student Name</label>
                                <input type="text" class="form-control" name="s_name" id="s_name"/>
                            </div>
                            <div class="form-group">
                                <label>IC</label>
                                <input type="text" class="form-control" name="ic" id="ic" />
                            </div>
                            <div class="form-group">
                                <label>Payment type</label>
                                <input type="text" class="form-control" name="payment_type" id="p_type" />
                            </div>
                            <div class="form-group">
                                <label>payment</label>
                                <input type="text" class="form-control" name="payment" id="payment" />
                            </div>
                            <div class="form-group">
                                <label>date create</label>
                                <input type="date"  name="c_date" id="c_date" value="" />
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <button type="submit" class="btn btn-primary" name="btn_sub" id="btn_sub" >Submit</button>
                        <button type="submit" class="btn btn-success" name="btn_edit" id="btn_edit" value="" disabled='disabled'   >Edit</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-lg-12">
            <table id="mytable" class="table table-bordred table-striped" style="width:100%">
                    <thead>
                        <th>Receipt No.</th>
                        <th>Date</th>
                        <th>Name</th>
                        <th>IC</th>
                        <th>Payment Type</th>
                        <th>Payment</th>
                        <th>Print</th>
                        <th colspan="2">Action</th>
                    </thead>
                    <tbody>
                        <?php while($result=mysqli_fetch_array($sttr)){ ?>
                            <tr>
                                <td><?=10000+$result["id"]?></td>
                                <td><?=$result["date_create"]?></td>
                                <td><?=$result["s_name"]?></td>
                                <td><?=$result["ic"]?></td>
                                <td><?=$result["p_type"]?></td>
                                <td><?=$result["payment"]?></td>
                                <td><a href="print_bill.php?id=<?=$result["id"]?>" class="btn btn-primary" target="_blank">Print</a></td>
                                <td><button type="button" class="btn btn-primary" onclick="selected(this.value)" value="<?=$result["id"]?>" name="edit" >selected</button></td>
                                <td><a class="btn btn-danger" name="delete" href='customer_bill.php?action=delete&id=<?=$result["id"]?>' >delete</a></td>
                            </tr>
                        <?php } ?>
                    </tbody>
            </table>
        </div>
    </div>

    
</div>


<script>
function selected(str){
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var myObj = JSON.parse(this.responseText);
            //alert(myObj.name);
            document.getElementById("s_name").value = myObj.name;
            document.getElementById("ic").value = myObj.ic;
            document.getElementById("p_type").value = myObj.p_type;
            document.getElementById("payment").value = myObj.payment;
            document.getElementById("c_date").value = myObj.c_date;
            document.getElementById("btn_edit").value=myObj.id;

            document.getElementById("btn_sub").setAttribute("disabled", "disabled");
            document.getElementById("btn_edit").removeAttribute("disabled");
        }
    };
    xhttp.open("GET", "selected.php?q="+str, true);
    xhttp.send();
}

</script>

