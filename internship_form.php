<?php 
include("include/sinclude.php");
include("header_student.php");

// $qry="SELECT img,replyslip FROM student_internship WHERE s_id='$_SESSION[id]'";
// $sttr=mysqli_query($conn,$qry);
// $result=mysqli_fetch_array($sttr);

// $pdf=$result["img"];
// $pdf2=$result["replyslip"];

$file="pdf/INTERNSHIP PLACEMENT & LEAVE POLICY .pdf";


?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1 class="page-header">INTERNSHIP PLACEMENT & LEAVE POLICY
                <!--<small>Secondary Text</small>-->
            </h1>
        </div>

        <div class="col-md-12">
            <div class="pdf-viewer">
                    <embed src="<?=$file?>" width="100%" height="1000px" type="application/pdf" disposition="inline" download="none download" />
            </div>
        </div>
        
        
        
        </div>
    </div>
    
</div>


<?php 
include("footer.php");
?>
