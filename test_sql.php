<?php 
include("sql_query.php");

//include("header.php");

if(isset($_POST["btn"])){
    insert("user",$_POST["ck"]);
}
?>

<html>
<table id="example1" class="table table-bordred table-striped" style="width:100%">
<?php 
    echo select("user","",array('password'));
    
    
?>
</table>
<form action="test_sql.php" method="post">
    <label>Username</label>
    <input type="text" name="ck[]" value="" />
    <label>Password</label>
    <input type="text" name="ck[]" value="" />
    <label>Name</label>
    <input type="text" name="ck[]" value="" />
    <button type="submit" name="btn" >Submit</button>
</form>


</html>