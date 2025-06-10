<?php 
include("include/include.php");
include("header.php");


if(isset($_POST["submit"])){
    $inset=mysqli_query($conn,"insert into ptpk_issue(issue) values('".$_POST["issue"]."')");
    
}
if(isset($_POST["del"])){
    $del=mysqli_query($conn,"delete from ptpk_issue where id='".$_POST['del']."'");
    
}
$qry="select * from ptpk_issue";
$sttr=mysqli_query($conn,$qry);
//$result=mysqli_fetch_array($sttr);
?>
<div class="container">
<form class="form-horizontal" method="post" action="issue.php" enctype="multipart/form-data">
    <div class="panel panel-info">
    <input type="submit" class="btn btn-primary pull-right" style="margin:2px" name="submit" value="submit" />
        <header class="panel-heading">
        
        <h3 class="panel-title">PTPK issue</h3>
        
        </header>
        
    <div class="panel-body">
        
            <div class="col-md-5">
                <div class="form-group">
                    <label>PTPK Issue</label>
                    <textarea class="form-control" name="issue"  style="height:80px;"></textarea>
                </div>
            </div>
            <div class="col-md-5">
                <div class="form-group">
                    
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Issue list
                        <!--<small>Secondary Text</small>-->
                    </h1>
                </div>
                <div class="col-md-12">
                    <table id="example1" class="table table-bordred table-striped" style="width:100%">
                        <thead><th>Issue</th></thead>
                        <tbody>
                            <?php 
                                while($result=mysqli_fetch_array($sttr)){
                                    $id=$result["id"];
                            ?>
                                <tr>
                                    <td><button type="button" onclick="window.location.href='issue_information.php?id=<?php echo $id; ?>'" class="btn btn-primary" ><span class="glyphicon glyphicon-cog"></span></button></td>
                                    <td><?php echo $result["issue"]; ?><button value="<?=$result["id"]?>" class="btn btn-danger pull-right" type="submit" name="del" ><span class="glyphicon glyphicon-trash"></span></button></td>

                                </tr>

                                <?php } ?>
                        </tbody>
                    </table>
                <div>
            </div>
            
        
    </div>
    </div>
    </form>
    
</div>

<?php include("footer.php"); ?>
