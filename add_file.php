<?php 
include("include/db.php");
if(isset($_POST["add_file"])){
    if(!empty($_FILES['filename']['name']))
{
    $ext = explode(".", $_FILES['filename']['name']);
    $ext1 = strtolower(array_pop($ext));
    $filename=$ext[0];
    $file = "document/P".date('YmdHis').'.'.$ext1;
    /*$file = $_FILES['image']['name'];*/

    if(($ext1 == "pdf")){ 
        $target_path = $file;
    }else{
        $error_ext = 1;
    }

    //if(file_exists('img/'.$_FILES['image1']['name'])){
    if(file_exists($file)){
        $file_exists = 1;
    }
}else{
    $file = '';
}
if(isset($error_ext)){
    echo "<script>alert('Please upload .pdf file only.')</script>"; 
}elseif(isset($file_exists)){
    echo "<script>alert('file already exists, please choose another file.')</script>"; 
}elseif(isset($target_path) && !move_uploaded_file($_FILES['filename']['tmp_name'], $target_path)){
    echo "<script>alert('file failed to upload.')</script>";  
}else{
    $qry="insert into document(c_id,document,path,date) values('".$_POST["course"]."','".$filename."','".$target_path."','".date("Y-m-d")."')";
    
    if($sttr=mysqli_query($conn,$qry)){
        echo "<script>
            window.location.href='file_list.php?action=msg_success_add&&btn_0=ALL'
        </script>";
    }else{
        echo "<script>
            window.location.href='file_list.php?action=msg_success_fail&&btn_0=ALL'
        </script>";
    }
    
}
}

if(isset($_GET['action']) && $_GET['action']=="delete"){
    $qry_delete="delete from document where id='".$_GET['id']."'";
    if($result=mysqli_query($conn,$qry_delete)){
         echo "<script>
            window.location.href='file_list.php?action=msg_success_del&&btn_0=ALL'
        </script>";
        
    }
    else{
       echo "<script>
            window.location.href='file_list.php?action=msg_fail_del&&btn_0=ALL'
        </script>"; 
    }
}
?>