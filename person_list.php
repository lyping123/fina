<?php
include("header.php"); 
$conn=new mysqli("localhost","root","","abx");


if(isset($_POST["sub"])){
    $qry="insert into person_list(p_name,age,email) values('$_POST[p_name]','$_POST[age]','$_POST[email]')";
    if($sttr=mysqli_query($conn,$qry)){
        echo "<script>
            alert('Insert success');
        </script>";

    }else{
        echo "<script>
            alert('Insert fail');
        </script>";
    }
}

?>
<form action="person_list.php" method="post">
<div class="container">
    <div class="row">
        <div class='form-group'>
            <label>person name</label>
            <input type='text' name='p_name' />
        </div>
        <div class='form-group'>
            <label>age</label>
            <input type='text' name='age' />
        </div>
        <div class='form-group'>
            <label>email</label>
            <input type='text' name='email' />
        </div>
        <div class='form-group'>
            <button type='submit' name='sub'>Insert</button>
        </div>
    </div>
</div>
</form>