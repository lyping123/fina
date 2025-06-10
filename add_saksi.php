<?php 
include("include/db.php");
if(isset($_POST["btn_sub"])){
    $qry="INSERT INTO `saksi`(`p_name`,`school_name`,`area`, `position`, `phone`, `ic`) VALUES ('$_POST[name]','$_POST[s_name]','$_POST[area]','$_POST[jawatan]','$_POST[phone]','$_POST[ic]')";
    if($sttr=mysqli_query($conn,$qry)){
        echo "<script>
            alert('add saksi information successfully');
            window.location.href='saksi_form.php'
        </script>";
    }else{
        echo "<script>
        alert('add saksi information fail');
        window.location.href='saksi_form.php'
    </script>";
    }
}

if(isset($_POST["btn_edit"])){
    $qry="UPDATE `saksi` SET `p_name`='$_POST[name]',`school_name`='$_POST[s_name]',`area`='$_POST[area]',`position`='$_POST[jawatan]',`phone`='$_POST[phone]',`ic`='$_POST[ic]' WHERE id='$_GET[id]'";
    if($sttr=mysqli_query($conn,$qry)){
        echo "<script>
            alert('update successfully');
            window.location.href='saksi_list.php'
        </script>";
    }else{
        echo "<script>
        alert('update fail');
        window.location.href='saksi_list.php'
    </script>";
    }
}

if(isset($_GET["action"]) && $_GET["action"]="del"){
    $qry="delete from saksi where id='$_GET[id]'";
    if($sttr=mysqli_query($conn,$qry)){
        echo "<script>
            alert('delete successfully');
            window.location.href='saksi_list.php'
        </script>";
    }else{
        echo "<script>
        alert('delete fail');
        window.location.href='saksi_list.php'
    </script>";
    }
}
?>