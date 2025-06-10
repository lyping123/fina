<?php 
include("include/include.php");
include("header.php");

if(isset($_POST["submit"])){
    $qry="INSERT INTO `announcement`( `announcement`, `a_date`) VALUES ('$_POST[announcement]','$_POST[date]')";
    if($sttr=mysqli_query($conn,$qry)){
        echo "<script>
            alert('announcement is successfully submit');
        </script>";
    }else{
        echo "<script>
        alert('fail to submit');
    </script>";
    }
}

if(isset($_GET["action"]) && $_GET["action"]=="del"){
    $del="DELETE  FROM announcement where id='$_GET[id]'";
    if($sttr=mysqli_query($conn,$del)){
        echo "<script>
            alert('announcement delete successfully');
        </script>";
    }else{
        echo "<script>
        alert('announcement delete fail');
        </script>";
    }
}

$select="SELECT * FROM announcement";
$sttr_se=mysqli_query($conn,$select);

?>

<div class="container">
    <div class="row">
        <form action="" method="post">
        <div class="col-md-12">
          <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3>Add announcement Form</h3>
                </div>
                <div class="panel-body" >
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>announcement</label>
                           <textarea name="announcement" style="height:150px" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Date</label>
                            <div class="input-group date form_date" data-date="" data-date-format="dd-mm-yyyy" data-link-field="dtp_input4" data-link-format="yyyy-mm-dd">
                                <input class="form-control" size="16" type="text" value="" >
                                <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                                <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                </div>
                                <input type="hidden" name="date" id="dtp_input4" value="" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel-footer">
                    <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                </div>
          </div>  
        </div>
        </form>
    </div>
    <br>
    <br>
    <div class="row">
        <div class="col-md-12">
            <table id="example1" class="table table-bordred table-striped" style="width:100%">
                <thead>
                    <th>announcement</th>
                    <th>Date</th>
                    <th>Delete</th>
                </thead>
                <tbody>
                    <?php while($row=mysqli_fetch_array($sttr_se)){ ?>
                    <tr>
                        <td><?=$row["announcement"]?></td>
                        <td><?=$row["a_date"]?></td>
                        <td><a class="btn btn-danger" href="add_announcement.php?action=del&id=<?=$row["id"]?>" >Delete</a></td>
                    </tr>
                    <?php } ?>
                </tbody>
                            
            </table>
        </div>
    </div>
   <?php include("footer.php"); ?>
</div>

