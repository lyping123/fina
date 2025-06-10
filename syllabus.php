<?php 
include("include/sinclude.php");
include("header_student.php");

$qry="SELECT course FROM student WHERE id='$_SESSION[id]'";
$sttr=mysqli_query($conn,$qry);
$result=mysqli_fetch_array($sttr);

$course=$result["course"];
switch($course){
    case "Programming":
        $pdf="pdf/PROGRAMMING SYALLBUS (17.2.23).pdf";
        break;
    case "Accounting":
        $pdf="pdf/ACCOUNTING SYLLABUS (16.2.2.23).pdf";
        break;
    case "Electronic":
        $pdf="pdf/syllabus electronic cc dan ee.pdf";
    case "Multimedia":
        $pdf="pdf/SYLLYBAS MULTIMEDIA.pdf";
    case "Networking":
        $pdf="pdf/SYLLABUS NETWORKING 2023 (1).pdf";
    default:
        $pdf="";
}



?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1 class="page-header">Syllabus
                <!--<small>Secondary Text</small>-->
            </h1>
        </div>

        <div class="col-md-12">
            <div class="pdf-viewer">
                    <embed src="<?=$pdf?>" width="100%" height="1000px" type="application/pdf" disposition="inline" download="none download" />
            </div>
        </div>
    </div>
    
</div>


<?php 
include("footer.php");
?>
