<input type="text" id="textbox1" value="" />

<script>
  document.addEventListener('keydown', function (event) {

    if (event.key === '1') {
      document.getElementById("textbox1").value+=1;
    }

    if (event.key === '2') {
      document.getElementById("textbox1").value+=2;
    }
    if (event.key === '3') {
      document.getElementById("textbox1").value+=3;
    }
});

</script>