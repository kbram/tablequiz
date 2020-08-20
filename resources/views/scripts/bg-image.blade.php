<script type="text/javascript">
 //Image zoom size
var slider = document.getElementById("formControlRange");

slider.oninput = function() {

  var image = document.getElementById('blah');
      image.style.width = 20*(this.value)+'px';
      image.style.height = 20*(this.value)+'px';
     
      if(this.value < 20){ image.style.marginTop = (100-this.value)+'px';}
      else{
        image.style.marginTop ='auto';
      }
    
}


//Image Rotate
var angle = 0,
  img = document.getElementById('blah');
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
