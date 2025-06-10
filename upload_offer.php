<?php 
include_once("include/db.php");

if(isset($_POST["upload"])){
    $file=$_FILES["file"]["name"];
    $path="offerletter/".$file;
    $id=$_GET["id"];
    $imageFileType = strtolower(pathinfo($file,PATHINFO_EXTENSION));

    // Allow certain file formats
    $uploadOk=1;
    if($imageFileType !="pdf" ) {
        echo "Sorry, only PDF files are allowed.";
        $uploadOk = 0;
    }

    if($uploadOk==0){
        echo "<script>alert('Sry, your file was not uploaded, please try again')</script>";
    }else{
        if(move_uploaded_file($_FILES["file"]["tmp_name"],$path)){
            $insert="insert into offerletter(s_id,path) value('$id','$file')";
            if(mysqli_query($conn,$insert)){
                echo "<script>
                    alert('submit success');
                    window.location.href='student_offer.php?id=$id'
                </script>";
            }else{
                echo "<script>
                    alert('submit fail');
                    window.location.href='student_offer.php?id=$id'
                </script>";
            }
        }
    }

}

if(isset($_GET["action"]) && $_GET["action"]=="delete"){
    $qry="delete from offerletter where id='$_GET[id]'";
    if($sttr=mysqli_query($conn,$qry)){
        echo "<script>
            alert('delete success');
                window.location.href='student_offer.php?id=$_GET[sid]'
            </script>";
    }else{
        echo "<script>
        alert('delete fail');
            window.location.href='student_offer.php?id=$_GET[sid]'
        </script>";
    }
}

?>