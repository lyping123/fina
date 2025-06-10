<?php 
include("include/include.php");
include("header.php");



if(isset($_POST["upload"])){
    if(!empty($_FILES['file']['name']))
	{
        //echo $_FILES['file']['name'];
		$ext1 = explode(".", $_FILES['file']['name']);
		$ext = strtolower(array_pop($ext1));
		$file = "ptpk_document/".$ext1[0].date('YmdHis').'.'.$ext;
		/*$file = $_FILES['image']['name'];*/

		if(($ext == "pdf" || $ext == "doc")){ 
			$target_path = $file;
		}else{
			//$error_ext = 1;
		}

		//if(file_exists('img/'.$_FILES['image1']['name'])){
		if(file_exists($file)){
			$file_exists = 1;
		}
    }
    if(isset($error_ext)){
        echo "<script>alert('Please upload pdf,doc file only.')</script>"; 
    }elseif(isset($file_exists)){
        echo "<script>alert('image already exists, please choose another photo.')</script>"; 
    }elseif(isset($target_path) && !move_uploaded_file($_FILES['file']['tmp_name'], $file)){
        echo "<script>alert('Image failed to upload.')</script>";  
    }else{
        
        $insert="insert into ptpk_document(document,date,d_id)values('".$file."','".date("d-m-Y")."','".$_POST["upload"]."')";

       
        if($sttr_insert=mysqli_query($conn,$insert)){
            echo "<script>alert('Upload success')</script>";
        }else{
            echo "<script>alert('Upload Fail')</script>";
        }
       

    }
    
}

if(isset($_POST["delete"])){
    $delete="delete from ptpk_document where id='".$_POST["delete"]."'";
    if($sttr=mysqli_query($conn,$delete)){
        echo "<script>alert('delete success')</script>";
    }else{
        echo "<script>alert('delete fail')</script>";
    }
    
}

$sql="select * from ptpk_document where d_id='".$_GET["id"]."'";
$result=mysqli_query($conn,$sql);


?>


<div class="container">
    <div class="row">
        <form class="form-horizontal" method="post" action="document.php?id=<?=$_GET["id"]?>" enctype="multipart/form-data">
            <div class="panel panel-info">
            <button type="submit" name="upload" class="btn btn-primary pull-right" value="<?=$_GET["id"]?>"  >Submit</button>
                <header class="panel-heading">
                
                <h3 class="panel-title">PTPK ISSUE Document</h3>
               
                </header>
                
                <div class="panel-body">
                    <!-- <div class="col-md-5">
                         <div class="form-group">
                            <input type="file" class="form-control" name="file" />
                            
                        </div>
                        
                    </div> -->
                    <div class="well" data-bind="fileDrag: fileData">
                        <div class="form-group row">
                            <div class="col-md-6">
                                <img style="height: 125px;" class="img-rounded  thumb" data-bind="attr: { src: fileData().dataURL }, visible: fileData().dataURL">
                                <div data-bind="ifnot: fileData().dataURL">
                                    <!-- <label class="drag-label">Drag file here</label> -->
                                </div>
                            </div>
                            <div class="col-md-6">
                                <input type="file" name="file" data-bind="fileInput: fileData, customFileInput: {
                                buttonClass: 'btn btn-success',
                                fileNameClass: 'disabled form-control',
                                onClear: onClear,
                                }" accept="/*">

                            </div>
                            
                        </div>
                        
                    </div>
                    <!-- <div class="well" data-bind="fileDrag: multiFileData">
                        <div class="form-group row">
                            <div class="col-md-6">
                                     ko foreach: {data: multiFileData().dataURLArray, as: 'dataURL'}
                                    <img style="height: 100px; margin: 5px;" class="img-rounded  thumb" data-bind="attr: { src: dataURL }, visible: dataURL">
                                    /ko 
                                <div data-bind="ifnot: fileData().dataURL">
                                    <label class="drag-label">Drag files here</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <input type="file" multiple data-bind="fileInput: multiFileData, customFileInput: {
                                buttonClass: 'btn btn-success',
                                fileNameClass: 'disabled form-control',
                                onClear: onClear,
                                }" accept="image/*">
                            </div>
                        </div>
                </div> -->
                </div>
            </div>
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-12">
                        <table id="example1" class="table table-bordred table-striped">
                            <thead>
                                <th>File Name</th>
                                <th>Download</th>
                                <th>Delete</th>
                            </thead>
                            <tbody>
                                <?php while($row=mysqli_fetch_array($result)){ ?>
                                    <tr>
                                        <td><?php echo $row["document"]; ?></td>
                                        <td><span class=""></span><a href="download2.php?file=<?php echo urldecode($row["document"]); ?>" name="download" class="btn btn-primary">Download</a></td>
                                        <td><button type="submit" name="delete" class="btn btn-danger" value="<?=$row["id"]?>" >Delete</button></td>
                                    </tr>
                                <?php } ?> 
                            </tbody>
                        </table>
                    </div>
                    
                </div>
            </div>
        
        </form>
    </div>
    <?php include("footer.php"); ?>
</div>

