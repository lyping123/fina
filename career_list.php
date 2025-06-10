<?php 
include('include/include.php');
include('header.php');

// $servername = "sv94.ifastnet.com";
// $username = "synergyc";
// $password = "synergy@central";
// $database = "synergyc_synergyedu";
// $conn = new mysqli($servername, $username, $password, $database);
	
// mysqli_set_charset($conn, 'utf8');	



// $qry="SELECT * FROM careers WHERE e_status='' order by id desc";
// $sttr=mysqli_query($conn,$qry);

function fetch_api_data(string $url, string $method = 'GET', array $headers = [], $body = null): array {
    $ch = curl_init();

    $default_headers = [
        'Accept: application/json',
    ];

    curl_setopt_array($ch, [
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_CUSTOMREQUEST => strtoupper($method),
        CURLOPT_HTTPHEADER => array_merge($default_headers, $headers),
    ]);

    if ($body !== null) {
        if (is_array($body)) {
            $body = json_encode($body);
        }
        curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
        $default_headers[] = 'Content-Type: application/json';
    }

    $response = curl_exec($ch);
    $error = curl_error($ch);
    $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($error) {
        return [
            'success' => false,
            'error' => $error,
            'status' => $status_code,
        ];
    }

    return [
        'success' => true,
        'status' => $status_code,
        'data' => json_decode($response, true) ?? $response,
    ];
}

$career=fetch_api_data('https://synergyedu-preview.synergycollege2u.com/api/career', 'GET', [], null);
$career_data=[];
if($career['success']) {
    $career_data = $career['data'];
} else {
    // Handle error
    echo "Error fetching data: " . $career['error'];

}

// print_r($career_data);



?>
<div class="container">


<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Career List
            <!--<small>Secondary Text</small>-->
        </h1>
    </div>
   
    
            
</div>
<div class="row">
        	<div class="col-md-12">
                <!--<div class="table-responsive">-->
                
                    <table id="example1" class="table table-bordred table-striped" style="width:100%">
                    
                        <thead>
                            <th>Name</th>
                            <th>Ic</th>
                            <th>Gender</th>
                            <th>Marial Status</th>
                            <th>Contact</th>
                            <th>Email</th>
                            <th>Position</th>
                             <th>Attachment</th> 
                            <th>Course</th>
                            <th>Date Apply</th>
                            <th>Address</th>
                            
                            <th>Action</th>  
                        </thead>
                        <tbody>
                          <style>
                            .bg-danger {
                                background-color: #dc3545 !important;
                            }	  
                          </style>

                            <?php 
                             foreach($career_data as $row) {
                                $attachment="";
                                foreach(json_decode($row['e_attachment']) as $result) {
                                    $attachment.="<a href='https://synergycollege.edu.my/$result' target='_blank'>$result</a><br>";
                                }

                            ?>
                            <tr>
                            <td><?=$row['e_name']?></td>
                              <td><?=$row['e_ic']?></td>
                              <td><?=$row['e_gender']?></td>
                              <td><?=$row['e_mstatus']?></td>
                              <td><?=$row['e_contact']?></td>     
                              <td><?=$row['e_email']?></td>     
                              <td><?=$row['e_position']?></td>
                              <td><?=$attachment?></td>  
                              <td><?=$row['e_course']?></td> 
                              <td><?=(new DateTime($row['created_at']))->format('d M Y, H:i') ?></td> 
                              
                              <td><?=$row['e_address']?></td>
                              <td><div class="dropdown">
                                  <button class="btn btn-warning dropdown-toggle " type="button" data-toggle="dropdown">Action<span class="caret"></span></button>
                                  <ul class="dropdown-menu dropdown-menu-right">
                                    <li><a href="https://wa.me/phone=<?=$row["e_contact"]?>" target="_blank">Whatsapp Contact</a></li>
                                    
                                    <li ><a  data-toggle="modal" data-target="#exampleModal" onclick="showmail(this)" data-id="<?=$row["id"]?>" data-email="<?=$row["e_email"]?>" >Mail reply</a></li>

                                    
                                  
                                  </ul>
                                </div></td>  
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                <!--</div>-->
            </div>
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            
                <div class="modal-dialog">
                    <div class="modal-content">
                    <form action="career_mail.php" method="post">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h5 class="modal-title">MailBox</h5>
                      
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>User Mail</label>
                            <input type="text" class="form-control" name="email" readonly id="email" />
                            <input type="hidden" class="form-control" name="eid" readonly id="eid" />
                        </div>
                        <div class="form-group">
                            <label>Mail Content</label>
                            <textarea class="form-control" name="mail_content"  style="height: 200px;"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="sendmail" >Send Mail</button>
                    </div>
                    </form>
                </div>
            </div>
            
        </div>

</div>
</div>
<script>
    function showmail(e){
       
        var a=e.getAttribute("data-email");
        var id=e.getAttribute("data-id");
        document.getElementById("email").value=a;
        document.getElementById("eid").value=id;
    }

</script>

<?php include("footer.php"); ?>