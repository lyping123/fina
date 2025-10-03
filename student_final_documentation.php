<?php 
include("include/include.php");
include("header.php");

if(isset($_POST["upload"])){
    $dir="finalPorject_documentation/";
    if(!is_dir($dir)){
        mkdir($dir, 0777, true);

    }
    $document_type = $_POST['document_type'];
    $document = $_FILES['document']['name'];
    $target =$dir . basename($document);
    $id=$_GET["id"];
    // Check if file is uploaded
    if(file_exists($target)){
        echo "<script>alert('File already exists. Please choose a different file.');</script>";
        exit;
    }
    if(move_uploaded_file($_FILES['document']['tmp_name'], $target)){
        $qry = "INSERT INTO student_final_document (project_id, document_type, document_link) VALUES ($id, '$document_type', '$document')";
        if(mysqli_query($conn, $qry)){
            echo "<script>alert('Document uploaded successfully');</script>";
        } else {
            echo "<script>alert('Error uploading document');</script>";
        }
    } else {
        echo "<script>alert('Failed to upload file');</script>";
    }
}

if(isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id_doc'])){
    $id_doc = $_GET['id_doc'];
    $qry = "SELECT * FROM student_final_document WHERE id='$id_doc'";
    $sttr = mysqli_query($conn, $qry);
    if(mysqli_num_rows($sttr) > 0){
        $row = mysqli_fetch_assoc($sttr);
        $file_path = "finalPorject_documentation/" . $row['document_link'];
        if(unlink($file_path)){
            $qry = "DELETE FROM student_final_document WHERE id='$id_doc'";
            mysqli_query($conn, $qry);
            echo "<script>alert('Document deleted successfully');</script>";
        } else {
            echo "<script>alert('Error deleting file');</script>";
        }
    } else {
        echo "<script>alert('Document not found');</script>";
    }

}

$qry = "SELECT * FROM student_final_document WHERE project_id='$_GET[id]'";
$sttr = mysqli_query($conn, $qry);
$num = mysqli_num_rows($sttr);

?>

<div class="container">
    <div class="row">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Student Final Documentation</h3>
            </div>
            <div class="panel-body">
                <form action="student_final_documentation.php?id=<?=$_GET["id"]?>" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="">Document type</label>
                        <select class="form-control" name="document_type" id="document_type">
                            <option value="">choose</option>
                            <option value="Presentation slide">Presentation slide</option>
                            <option value="Thesis report">Thesis report</option>
                            <option value="Proposal">Proposal</option>
                            <option value="Book log">Book log</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Document</label>
                        <input type="file" name="document" id="document" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary" name="upload" value="upload">upload</button>
                        <a href="student_final_form.php" class="btn btn-warning">back</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <table id="example1" class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Document Type</th>
                        <th>Document Link</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    if($num > 0){
                        $no=0;
                        while($row = mysqli_fetch_assoc($sttr)){
                            $no++;
                            echo "<tr>
                                    <td>$no</td>
                                    <td>".$row['document_type']."</td>
                                    <td><a href='finalPorject_documentation/".$row['document_link']."' target='_blank'>".$row['document_link']."</a></td>
                                    <td><a href='student_final_documentation.php?id=$_GET[id]&action=delete&id_doc=".$row['id']."' class='btn btn-danger'>Delete</a></td>
                                  </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='3'>No documents uploaded yet.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php include("footer.php"); ?>
</div>