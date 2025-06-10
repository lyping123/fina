<?php 
include("include/include.php");
include("header.php");

if(isset($_POST["upload"])){
    if(!empty($_FILES['img']['name']))
	{
		$ext1 = explode(".", $_FILES['img']['name']);
		$ext = strtolower(array_pop($ext1));
		$file = "img/ptpk/".$ext1[0].date('YmdHis').'.'.$ext;
		/*$file = $_FILES['image']['name'];*/

		if(($ext == "jpg" || $ext == "jpeg" || $ext == "png")){ 
			$target_path = $file;
		}else{
			$error_ext = 1;
		}

		//if(file_exists('img/'.$_FILES['image1']['name'])){
		if(file_exists($file)){
			$file_exists = 1;
		}
    }
    if(isset($error_ext)){
        echo "<script>alert('Please upload .jpg, .png file only.')</script>"; 
    }elseif(isset($file_exists)){
        echo "<script>alert('image already exists, please choose another photo.')</script>"; 
    }elseif(isset($target_path) && !move_uploaded_file($_FILES['img']['tmp_name'], $target_path)){
        echo "<script>alert('Image failed to upload.')</script>";  
    }else{
        
        $insert="insert into ptpk_image(ver_id,path,date)values('".$_GET["id"]."','".$file."','".date("d-m-Y")."')";
        $sttr_insert=mysqli_query($conn,$insert);
        echo "<script>alert('Upload success')</script>";

    }
    
}
if(isset($_POST["submit"])){
    $inset=mysqli_query($conn,"update ptpk_issue set issue='".$_POST["issue"]."' where id='".$_GET['id']."'");
    
}

$qry="select * from ptpk_issue where id='".$_GET["id"]."'";
$sttr=mysqli_query($conn,$qry);
$result=mysqli_fetch_array($sttr);

$i=0;
$image=mysqli_query($conn,"select * from ptpk_image where ver_id='".$_GET["id"]."'");

if(isset($_POST["submit"])){
    $inset=mysqli_query($conn,"update ptpk_issue set issue='".$_POST["issue"]."' where id='".$_GET['id']."'");
    
}


?>

<div class="container">
<form class="form-horizontal" method="post" action="issue_information.php?id=<?=$_GET["id"]?>" enctype="multipart/form-data">
    <div class="panel panel-info">
    <button type="button" class="btn btn-primary pull-right" style="margin:2px" onclick="window.location.href='issue.php'">Back</button>
    <input type="submit" class="btn btn-primary pull-right" style="margin:2px" name="submit" value="submit" />
        <header class="panel-heading">
        
        <h3 class="panel-title">PTPK issue</h3>
        
        </header>
        
    <div class="panel-body">
        
            <div class="col-md-5">
                <div class="form-group">
                    <label>PTPK Issue</label>
                    <textarea class="form-control" name="issue" style="height:80px;"><?php echo $result["issue"];?></textarea>
                </div>
            </div>
            <div class="col-md-5">
                <div class="form-group">
                    
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Issue Information
                        <!--<small>Secondary Text</small>-->
                        
                    </h1>
                    <input type="file" name="img"  />  
                    <br>
                    <button type="submit" name="upload" class="btn btn-primary">Upload</button>
                </div>
                <div class="col-md-12">
                    <table id="example1" class="table table-bordred table-striped" style="width:100%">
                        <thead><th colspan='5'>Image</th></thead>
                        <tbody>
                        
                        <?php while($r_image=mysqli_fetch_array($image)){ 
                            
                            
                            if($i==5){
                                $i=0;
                                $tr1="<tr>";
                                $tr2="</tr>";
                                
                            }else{
                                $tr1="";
                                $tr2="";
                                $i++;
                            }
                            
                            echo $tr1;
                            ?>
                            
                            <td><img width="200px;" height="150px;" src="<?php echo $r_image["path"];?>" /></td>
                            <?php echo $tr2; ?>
                        <?php } ?>
                        
                        </tbody>
                    </table>
                <div>
            </div>
            
        
    </div>
    </div>
    </form>
   
</div>
</div>
<?php include("footer.php"); ?>
