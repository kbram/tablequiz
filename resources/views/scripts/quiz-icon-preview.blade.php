<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script>
	function readURL(input) {
  	if (input.files && input.files[0]) {
    var reader = new FileReader();
    


    reader.onload = function(e) {
      $('.imagePreview').attr('src', e.target.result);
    }
    
    reader.readAsDataURL(input.files[0]); // convert to base64 string
  }
}

    $(".imagePreviewInput").change(function() {
    readURL(this);
});

</script>

<script type="text/javascript">
//Image zoom size

$(document).on('input change', '.formControlRange', function() {
    
   var image = document.getElementById('image_preview_container');
   image.style.width = 20*($(this).val())+'px';
    image.style.height = 20*($(this).val())+'px';
   
    if(this.value < 20){ image.style.marginTop = (100-this.value)+'px';}
    else{
      image.style.marginTop ='auto';
    }

});

// slider.oninput = function() {

// var image = document.getElementById('image_preview_container');
//     image.style.width = 20*(this.value)+'px';
//     image.style.height = 20*(this.value)+'px';
   
//     if(this.value < 20){ image.style.marginTop = (100-this.value)+'px';}
//     else{
//       image.style.marginTop ='auto';
//     }
  
// }
</script>
	
	