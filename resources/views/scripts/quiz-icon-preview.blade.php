<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script>
	function readURL(input) {
  	if (input.files && input.files[0]) {
    var reader = new FileReader();
    
    reader.onload = function(e) {
      $('#image_preview_container').attr('src', e.target.result);
    }
    
    reader.readAsDataURL(input.files[0]); // convert to base64 string
  }
}

    $("#upload__quiz__icon").change(function() {
    readURL(this);
});

</script>

<script type="text/javascript">
//Image zoom size
var slider = document.getElementById("formControlRange");
slider.oninput = function() {
console.log("sam");
  var image = document.getElementById('img-wrapper'),
      ranger = document.getElementById('formControlRange');
      image.style.width = 20*(this.value / 1)+'px';
}
</script>
	
	