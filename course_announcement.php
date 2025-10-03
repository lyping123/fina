<?php 
include("header.php");
include("include/include.php");

if(isset($_POST['sub'])){
    $title = $_POST['title'];
    $status = $_POST['status'];

    $qry = "UPDATE course_announment SET title='$title', a_status='$status' WHERE id=1";
    if(mysqli_query($conn, $qry)){
        echo "<script>alert('Announcement added successfully');</script>";
    } else {
        echo "<script>alert('Error adding announcement');</script>";
    }
}

$qry = "SELECT * FROM course_announment where id=1";
$sttr = mysqli_query($conn, $qry);
$result = mysqli_fetch_array($sttr);

?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <form action="course_announment.php" method="post">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Course Announcements</h3>
                </div>
                <div class="panel-body">
                    <div class="form-group">    
                        <label for="title">Title</label>
                        <input type="text" name="title" value="<?=$result["title"]?>" class="form-control" placeholder="Enter announcement title" required>
                    </div>
                    <style>
                        /* Custom Switch CSS */
                        .custom-control.custom-switch {
                            position: relative;
                            display: inline-block;
                            width: 60px;
                            height: 25px;
                        }
                        .custom-control-input {
                            opacity: 0;
                            width: 0;
                            height: 0;
                        }
                        .custom-control-label {
                            position: absolute;
                            top: 4;
                            left: 4;
                            width: 30px;
                            height: 15px;
                            cursor: pointer;
                            background-color: #ccc;
                            border-radius: 34px;
                            transition: background-color 0.2s;
                        }
                        .custom-control-label:before {
                            content: "";
                            position: absolute;
                            left: 0px;
                            top: 0px;
                            width: 22px;
                            height: 15px;
                            background-color: white;
                            border-radius: 50%;
                            transition: transform 0.2s;
                        }
                        .custom-control-input:checked + .custom-control-label {
                            background-color: #007bff;
                        }
                        .custom-control-input:checked + .custom-control-label:before {
                            transform: translateX(10px);
                        }
                    </style>
                    <div class="form-group">
                        <label for="statusSwitch">Status</label><br>
                        <div class="custom-control custom-switch">

                            <input type="checkbox" class="custom-control-input" id="statusSwitch" name="<?php echo $result["a_status"] ?>" value="Dibuka" checked>
                            <label class="custom-control-label" for="statusSwitch"></label>
                        </div>
                        <span id="switchLabelText">Dibuka</span>
                    </div>
                    <script>
                        // Change value and label based on toggle state
                        document.addEventListener('DOMContentLoaded', function() {
                            var switchInput = document.getElementById('statusSwitch');
                            var labelText = document.getElementById('switchLabelText');
                            switchInput.checked = <?php echo $result["a_status"] == 'Dibuka' ? 'true' : 'false'; ?>;
                            switchInput.addEventListener('change', function() {
                                if (switchInput.checked) {
                                    switchInput.value = 'Dibuka';
                                    labelText.textContent = 'Dibuka';
                                } else {
                                    switchInput.value = 'Ditutup';
                                    labelText.textContent = 'Ditutup';
                                }
                            });
                        });
                    </script>
                    <button type="submit" class="btn btn-primary" name="sub">Save change</button>
                </div>
            </div>
        </form>
    </div>
</div>
<?php include("footer.php"); ?>