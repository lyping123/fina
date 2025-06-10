<?php 
include("header_student.php");


if(isset($_POST["submit"])){
    $file=$_FILES["offer"]["name"];
    $path="offerletter/".$file;
    $id=$_SESSION["id"];
    $imageFileType = strtolower(pathinfo($file,PATHINFO_EXTENSION));

    // Allow certain file formats
    $uploadOk=1;
    if($imageFileType !="pdf" ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    if($uploadOk==0){
        echo "<script>alert('Sry, your file was not uploaded, please try again')</script>";
    }else{
        if(move_uploaded_file($_FILES["offer"]["tmp_name"],$path)){
            $insert="insert into offerletter(s_id,path) value('$id','$path')";
            if(mysqli_query($conn,$insert)){
                echo "<script>
                    alert('submit success');
                    window.location.href='upload_offerletter.php'
                </script>";
            }else{
                echo "<script>
                    alert('submit fail');
                    window.location.href='upload_offerletter.php'
                </script>";
            }
        }
    }

}

$qry="SELECT * FROM offerletter WHERE s_id=$_SESSION[id]";
$sttr=mysqli_query($conn,$qry);
$num=mysqli_num_rows($sttr);
$result=mysqli_fetch_array($sttr);
// if($num>0){
//     $path=$result[""];
// }else{
//     $path="";
// }

?>

<div class="container">
    <form action="upload_offerletter.php" method="post" enctype="multipart/form-data">
    <div class="row">
        <div class="col-md-12">
            <div class="col-md-6">
                <label>Upload Your offer letter</label>
                <input type="file" name="offer" class="form-control" />
                <button style="margin-top: 20px;" type="submit" name="submit" class="btn btn-primary">upload</button>
            </div>
        </div>
        <div class="col-md-12">
            <div class="pdf-viewer">
                    <embed src="<?=$result["path"]?>" width="100%" height="1000px" type="application/pdf" disposition="inline" download="none download" />
            </div>
        </div>
    </div>
    </form>
</div>
<?php include("footer.php") ?>