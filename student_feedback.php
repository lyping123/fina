<?php 
include("include/sinclude.php");
include("header_student.php");

if(isset($_POST["sub_complain"])){
    $issue=implode(",",$_POST["ck"]);
    $qry="INSERT INTO `complain_list`(`main_issue`, `issue_problem`, `i_date`,`s_id`) VALUES ('$issue','$_POST[complain]','".date("Y-m-d H:i:s")."','".$_SESSION["id"]."')";
    if($sttr=mysqli_query($conn,$qry)){
        echo "<script>
            alert('complain submit success');
        </script>";
    }else{
        echo "<script>
            alert('complain submit fail');
        </script>";
    }
}

?>
<div class="container">
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <h1 class="page-header">Complain Form</h1>
        </div>
       
        <div class="col-md-12">
            <form action="" method="post">
                
            
            <div class="form-group">
                <div class="col-md-6">
                    <label>Main issue:</label><br>
                    <input style="margin-left:20px;" type="checkbox" name="ck[]" value="hostel" /><span>  Hostel</span>
                    <input style="margin-left:20px;" type="checkbox" name="ck[]" value="college" /><span>  College</span>
                    <input style="margin-left:20px;" type="checkbox" name="ck[]" value="other" /><span>  Other</span>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-12">
                    <label>Main reason:</label>
                    <textarea class="form-control" name="complain" style="height:280px;" ></textarea>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-12">
                    <br>
                    <button class="btn btn-primary" type="submit" name="sub_complain">Submit Complain</button>
                </div>
                
            </div>
            </form>
        </div>

        

        
    </div>
</div>
<?php include("footer.php"); ?>