<?php 
include("include/db.php");
if(isset($_POST["upload"])){        
    $file=$_FILES["file"]["name"];
    $path="transcript/".$file;

    if(move_uploaded_file($_FILES["file"]["tmp_name"],$path)){
        $insert="insert into transcript(s_id,attachment,cgpa) value('$_GET[id]','$file','$_POST[cgpa]')";
        if(mysqli_query($conn,$insert)){
            echo "<script>
                alert('submit success');
                window.location.href='transcript.php?id=$_GET[id]'
            </script>";
        }else{
            echo "<script>
                alert('submit fail');
                window.location.href='transcript.php?id=$_GET[id]'
            </script>";
        }
    }
    
}

if(isset($_GET["action"]) && $_GET["action"]=="delete"){
    $qry="delete from transcript where id='$_GET[id]'";
    if($sttr=mysqli_query($conn,$qry)){
        echo "<script>
            alert('delete success');
                window.location.href='transcript.php?id=$_GET[sid]'
            </script>";
    }else{
        echo "<script>
        alert('delete fail');
            window.location.href='transcript.php?id=$_GET[sid]'
        </script>";
    }
}


?>