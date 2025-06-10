<?php 
include("include/db.php");
$sql=mysqli_query($conn,"select path from document where id='".$_GET['id']."'");
$result=mysqli_fetch_array($sql);

$str=explode("/",$result['path']);

?>
<title>Synergy College Student Document</title>
<link rel="shortcut icon" href="../logo.png" type="image/x-icon">
<object data="<?=$result['path']?>" type="application/pdf" width="100%" height="100%">
  <a href="<?=$result['path']?>"><?=$str[1]?></a>
</object>