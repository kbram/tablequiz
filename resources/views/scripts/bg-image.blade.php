<script type="text/javascript">
 //Image zoom size
var slider = document.getElementById("formControlRange");
slider.oninput = function() {

  var image = document.getElementById('img-wrapper'),
      ranger = document.getElementById('formControlRange');
      image.style.width = 20*(this.value / 1)+'px';
}


//Image Rotate
var angle = 0,
  img = document.getElementById('img-wrapper');
document.getElementById('rotate').onclick = function() {
  angle = (angle + 90) % 360;
  img.className = "rotate" + angle;
}




  $(document).ready(function() {
    function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    
    reader.onload = function(e) {
      $("#blah").attr('src', e.target.result);

    }
    
    reader.readAsDataURL(input.files[0]); // convert to base64 string
  }
}


$("#upload__quiz__icon").change(function() {
  
  readURL(this);
  
});



  });
</script>
