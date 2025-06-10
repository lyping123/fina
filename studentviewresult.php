<?php 
include("include/sinclude.php");
include("header_student.php");


$qry="SELECT * FROM student_result where s_id='$_SESSION[id]'";
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
        <div class="switch-panel">
        <div class="switch-panel__tabs">
            <?php 
            $ii=1;
            for($i=0;$i<$num;$i++){
              if($i==0){
                $active="active";
              }else{
                $active="";
              }
              
            ?>
            <button class="switch-panel__tab <?=$active?>" onclick="switchContent(<?=$i?>)">SEM <?=$ii?></button>
            <?php $ii++;} ?>
            
        </div>
        <div class="switch-panel__content">
        <?php 
            $i=1;
            if($num==0){
              echo "<h2>Exam result not release yet</h2>";
            }else{
              while($row=mysqli_fetch_array($sttr)){
              if($i==1){
                $active="active";
              }else{
                $active="";
              }
            ?>
              <div class="switch-panel__tab-content <?=$active?>">
              <h2>Semester <?=$row["semester"]?> result</h2>
                  <div class="pdf-viewer">
                      <embed src="<?=$row["img"]?>" width="100%" height="100%" type="application/pdf" disposition="inline" download="none download" />
                  </div>
              </div>
            <?php $i++; } ?>
            <?php } ?>
        </div>
        </div>
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
