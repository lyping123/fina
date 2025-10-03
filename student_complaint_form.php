<?php 
include("include/sinclude.php");
include("header_student.php");


$qry="SELECT * FROM student_complaint WHERE s_id = '".$_SESSION['id']."' order by id desc";
$sttr=mysqli_query($conn,$qry);


?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="page-header">
                <h2>Student Complain Form</h2>
            </div>
        </div>
        <div class="col-md-12">
            <form action="add_student_complaint.php" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" class="form-control" id="name" name="name" value="<?php echo $_SESSION['name']; ?>" readonly>
                </div>
                
                <div class="form-group">
                    <label for="subject">Complaint title:</label>
                    <input type="text" class="form-control" id="complaint" name="complaint_title" required>
                </div>
                <div class="form-group">
                    <label for="message">Complaint Message:</label>
                    <textarea class="form-control" id="message" name="complaint" rows="5" required></textarea>
                </div>
                <button type="submit" name="submit" class="btn btn-info" >Submit</button>
            </form>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-12">
            <div class="table">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Complaint ID</th>
                            <th>Complaint title</th>
                            <th>Complaint Message</th>
                            <th>Complaint Date</th>
                            <th>Status Solve</th>
                            <th colspan="2">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                           
                            while($row = mysqli_fetch_assoc($sttr)){
                                echo "<tr>";
                                echo "<td>".$row['id']."</td>";
                                echo "<td>".$row['complaint_title']."</td>";
                                echo "<td>".$row['complaint']."</td>";
                                echo "<td>".$row['date']."</td>";
                                $status = strtolower($row['complaint_status']);
                                if ($status == 'Resolved') {
                                    echo "<td><span style='color:green;font-weight:bold;'>Solved</span></td>";
                                } elseif ($status == 'in progress') {
                                    echo "<td><span style='color:orange;font-weight:bold;'>In Progress</span></td>";
                                } elseif ($status == 'close') {
                                    echo "<td><span style='color:black;font-weight:bold;'>Closed</span></td>";
                                } else {
                                    echo "<td><span style='color:gray;font-weight:bold;'>Pending</span></td>";
                                }
                                echo "<td><button class='btn btn-info' >View</button></td>";

                                echo "</tr>";
                            }
                        ?>
                    </tbody>
                </table>
            </div>
            <!-- Bootstrap Modal for Complaint Deletion Confirmation -->
            <div class="modal fade" id="complaintModel" tabindex="-1" role="dialog" aria-labelledby="deleteComplaintModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteComplaintModalLabel">Complaint Detail</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                           <div class="form-group">
                                <label for="Complaint">Complaint title</label>
                                <input type="text" class="form-control" id="complaint_title" name="complaint_title" readonly>
                           </div>
                            <div class="form-group">
                                <label for="Complaint">Complaint Message</label>
                                <textarea class="form-control" id="complaint_message" name="complaint_message" rows="5" readonly></textarea>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <a href="add_student_complaint.php?" id="confirmDeleteBtn" class="btn btn-danger">Delete</a>
                        </div>
                    </div>
                </div>
            </div>

            <script>
                // Attach modal to delete buttons
                document.addEventListener('DOMContentLoaded', function() {
                    var viewLink = document.querySelectorAll('.btn-info');
                    console.log(viewLink);
                    
                    viewLink.forEach(function(link) {
                        link.addEventListener('click', function(e) {
                            e.preventDefault();
                            $('#complaintModel').modal('show');
                            var row = this.closest('tr');
                            var complaint_title = row.cells[1].textContent;
                            var complaint_message = row.cells[2].textContent;
                            var complaint_id = row.cells[0].textContent;
                            document.getElementById('complaint_title').value = complaint_title;
                            document.getElementById('complaint_message').value = complaint_message;
                            document.getElementById('confirmDeleteBtn').href = 'student_complain_from.php?action=delete&id=' + complaint_id;
                            
                        });
                    });
                });
            </script>
        </div>
    </div>
    <?php 
        include("footer.php");
    ?>
</div>