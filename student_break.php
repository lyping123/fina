<?php 
include("include/sinclude.php");
include("header_student.php");


/*function getHolidays($country){
//Url of Site with list
 $url='https://publicholidays.com.my/'.$country.'/2018-dates/';
//Use curl to get the page
$ch = curl_init();
$timeout = 5;
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
$html = curl_exec($ch);
curl_close($ch);
$dom = new DOMDocument();
# The @ before the method call suppresses any warnings that
# loadHTML might throw because of invalid HTML in the page.
    @$dom->loadHTML($html);
    $holidays=array();
    $items = $dom->getElementsByTagName('tr');
    print_r($items);
    function tdrows($elements)
    {
        $str = "";
        foreach ($elements as $element)
        {
            echo $str .= $element->nodeValue . ", ";
        }
        //This pplaces the items into an array 
        $tempArray=explode(',',$str);
        //This gets rid of empty array elements
        unset($tempArray[4]);
        unset($tempArray[5]);
        return $tempArray;
    }
    foreach ($items as $node)
    {
         $holidays[]=tdrows($node->childNodes);
    }
//The first and secone items in the array were the titles of the table and a blank row 
//so we unset them
unset($holidays[0]);
unset($holidays[1]);
//then reindex the array
$holidays = array_values($holidays);
return $holidays;
}
print_r(getHolidays("penang"));*/

?>
<style>
    table{
        border-collapse: collapse
    }
    thead th{
        background-color: #7F7F7F;
        color: white;
        font-weight: 700;
        vertical-align: middle;
    }
</style>
<div class="container">
    <div class="rows">
        <div class="col-md-12">
            <div class="page-header">
                <h2>Public Holidays</h2>
            </div>
        </div>
        <div class="col-md-12">
            <div class="rows">
                
                    <table class="col-md-12 table">
                    <thead>
                        <th>Date</th>
                        <th>Holidays</th>
                    </thead>
                        <tbody id="holiday">
                            <?php 
                            $query="select * from public_holiday";
                            $sttr=mysqli_query($conn,$query);
                            while($result=mysqli_fetch_array($sttr)){
                                if(!empty($result['date1'])){
                                    $date = $result['date1'].'('.$result['days1'].') - '.$result['date'].'('.$result['days'].')';
                                }else{
                                    $date = $result['date'].'('.$result['days'].')';
                                }
                                echo "<tr>";
                                echo "<td>".$date."</td>";
                                echo "<td>".$result['holidays']."</td>";
                                echo "<tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                
                
            </div>
        </div>
    </div>
    
    <div class="rows">
        <div class="col-md-12">
            <div class="page-header">
                <h2>Semester Break</h2>
            </div>
        </div>
        <div class="col-md-12">
            <div class="rows">
                
                    <table class="col-md-12 table">
                    <thead>
                        <th>Level</th>
                        <th>S.B Doc</th>
                        <th>Download</th>
                    </thead>
                        <tbody>
                            <?php 
                            $query1="SELECT * FROM student_group_list AS sgl
                                    INNER JOIN student_group AS sg ON sg.id = sgl.g_id
                                    WHERE sgl.s_id = '".$_SESSION['id']."' AND sgl.status = 'ACTIVE' AND sg.g_status = 'ACTIVE'
                                    ORDER BY sg.g_level ASC";
                            $sttr1=mysqli_query($conn,$query1);
                            while($result1=mysqli_fetch_array($sttr1)){?>
                                <tr>
                                    <td><?=$result1['g_level']?></td>
                                    <td><?php if(!empty($result1['sb_doc'])){?><a class="btn btn-success" href="https://docs.google.com/viewer?url=http://registration.synergy-college.org/<?=$result1['sb_doc']?>" target="_blank"> View </a><?php }else{ echo 'Find your teacher for this semester break holiday.';}?></td>
                                    <td><?php if(!empty($result1['sb_doc'])){?><a class="btn btn-success" href="download.php?name=<?=$result1['sb_doc']?>" target="_blank">Download</a><?php }?></td>
                                </tr>
                            <?php }?>
                        </tbody>
                    </table>
                
                
            </div>
        </div>
    </div>

    <script>
     
  function fetchholiday(year){
    let a=year.toString();
    
    fetch('https://www.qppstudio.net/publicholidays2024/malaysia-pulau-pinang-penang.htm')
    .then(response => response.text())
    .then(html => {
      const tempElement = document.createElement('div');
      tempElement.innerHTML = html;

      
      const tableContent = tempElement.querySelectorAll('table tbody');

      
      if (tableContent) {
        for(let i=0;i<tableContent.length;i++){
          document.getElementById("holiday").innerHTML=tableContent[i].innerHTML;
        }
      
      } else {
        document.getElementById("holiday").innerHTML="<tr><td colspan='3'>Celender record are of "+a+" are not valid yet</td></tr>";
      }
      
    })
    .catch(error => {
      console.error(error);
      hideLoader();
    });
    }

    fetchholiday(2023);
    </script>
    
<?php include("footer.php");?>