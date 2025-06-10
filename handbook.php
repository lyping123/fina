<?php 
include("include/db.php");
include("header_student.php");

?>
<html>
<div class="container">
    <div class="row">
    <form method="post" action="add_handbook.php?action=add">
                        
                                <div class="row">
                                    <div class="col-md-12">

                                        <div class="form-group">
                                            <label>Student</label><br>
                                            <input type="hidden" name="id" value="<?=$_SESSION["id"];?>" class="form-control" readonly />
                                            <input type="text" name="name" value="<?=$_SESSION["name"];?>" class="form-control" readonly />
                                        </div>

                                        <div class="form-group">
                                            <label>Agreement: </label>
                                            <a href="agrm_image.php?id=Student Handbook.pdf" target="_blank" class="btn btn-primary">English Version </a>
                                            <!-- <a href="agrm_image.php?id=hostel_ruleschinese_version_.pdf" target="_blank" class="btn btn-primary">Chinese Version </a> -->
                                            <label>I confirm that I have read the contents of this handbook and acknowledge that I agree to abide with the College Rules and Regulations. I fully understand and agree that disciplinary action can be taken against me if I fail to observe the rules and regulations both expressed and implied. </label>
                                        </div>
                                        <div class="form-group">
                                            <input type="radio" name="ck" id="ck" value="1" />Agree
                                            <input type="radio" name="ck" id="ck" value="2" />Disagree
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php 
                            $qry="select * from agreement where s_id='".$_SESSION["id"]."'";
                            $sttr=mysqli_query($conn,$qry);
                            $num=mysqli_num_rows($sttr);
                            if($num==0){
                            ?>
                                <button type="submit" class="btn btn-success btn-lg" name="submit" style="width: 100%;"><span
                                            class="glyphicon glyphicon-ok-sign"></span>Submit
                                </button>
                           <? } ?>
                        </form>
                        <?php include("footer.php"); ?>
    </div>
  
</html>