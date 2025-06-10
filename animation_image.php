<script>
document.getElementById("myDIV").addEventListener("wheel", scolldown);

function scolldown(){
    if(e.wheelDelta < 0){
    var newHeight = 
     $("#myImg").height(newHeight);  
  } else if(e.wheelDelta > 0){
    var newHeight = $("#myImg").height() + 10;
     $("#myImg").height(newHeight);  
  }
}

</script>
<div id="myDiv" style="height:1200px;">
    <div style="width:200px;height:200px; background-color:brown; top:10px;" id="img"></div>
</div>