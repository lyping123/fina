<?php 
include("include/sinclude.php");
include("header_student.php");


$qry="SELECT * FROM transcript where s_id='$_SESSION[id]'";
$sttr=mysqli_query($conn,$qry);
$num=mysqli_num_rows($sttr);

?>

<style>
    .switch-panel {
  width: 100%;
  margin: 20px auto;
  border: 1px solid #ccc;
  padding: 20px;
}

.switch-panel__tabs {
  display: flex;
}

.switch-panel__tab {
  flex: 1;
  padding: 10px;
  border: none;
  background-color: #f1f1f1;
  cursor: pointer;
}

.switch-panel__tab.active {
  background-color: #ccc;
}

.switch-panel__content {
  margin-top: 20px;
}

.switch-panel__tab-content {
  display: none;
}

.switch-panel__tab-content.active {
  display: block;
}
.pdf-viewer {
      width: 100%;
      height: 100vh;
      
}


</style>
<script>
        // window.addEventListener('contextmenu', function (e) {
        //     e.preventDefault(); // Prevent right-click menu
        // });

       
    </script>
<div class="container">
    <div class="col-md-12">
    <table id="example1" class="table table-bordred table-striped" style="width:100%">
                <thead>
                    
                    <th>Attachment</th>
                    <th>cgpa</th>
                    <th>view</th>
                
                </thead>
                <tbody>
                    <?php while($row=mysqli_fetch_array($sttr)){ ?>
                        <tr>
                            <td><?=$row["attachment"]?></td>
                            <td><?=$row["cgpa"]?></td>
                            <td><a class="btn btn-primary" target="_blank" href="./transcript/<?=$row["attachment"]?>">view</a></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
    </div>
</div>
<script>
function switchContent(index) {
  const tabContents = document.getElementsByClassName('switch-panel__tab-content');
  const tabs = document.getElementsByClassName('switch-panel__tab');

  for (let i = 0; i < tabContents.length; i++) {
    tabContents[i].classList.remove('active');
    tabs[i].classList.remove('active');
  }

  tabContents[index].classList.add('active');
  tabs[index].classList.add('active');
}


</script>
<?php 
include("footer.php");

?>
