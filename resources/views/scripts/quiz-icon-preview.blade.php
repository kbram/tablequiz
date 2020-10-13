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

    $(".imagePreviewInput").change(function() {
    readURL(this);
});

</script>
<script>
    var get_zoom=1;
    var zoomer = document.getElementById('zoomer');
var hubblepic = document.getElementById('image_preview_container');

function deepdive(){ 
	zoomlevel = zoomer.valueAsNumber;
  get_zoom=zoomlevel;
  hubblepic.style.webkitTransform = "scale("+zoomlevel+")";
	hubblepic.style.transform = "scale("+zoomlevel+")";
  $('#crop_y1').val((18*(get_zoom-1))+40);
  $('#crop_x1').val((13*(get_zoom-1))+65);
  $('#crop_height').val(100/get_zoom);
  $('#crop_width').val(100/get_zoom);
}
</script>

<style>
     #image-container {
  width: 100%;
  font-size: 0;
  border: 1px solid #111;
 /* overflow: hidden;*/
  margin: 0 auto;
 /* margin-top: 2rem;*/
}

#image_preview_container{
  width: 100%;
  height: 100%;
  position: absolute;
}

/* #zoomer {
  display: block;
  width: 50%;
  margin: 2rem auto;
} */
@media all and (max-width: 500px) {
  #zoomer, #image-container {
    width: 85%;
  }
}
 </style>
<script type="text/javascript">
//Image zoom size

// $(document).on('input change', '.formControlRange', function() {
    
//    var image = document.getElementById('image_preview_container');
//    image.style.width = 20*($(this).val())+'px';
//     image.style.height = 20*($(this).val())+'px';
   
//     if(this.value < 20){ image.style.marginTop = (100-this.value)+'px';}
//     else{
//       image.style.marginTop ='auto';
//     }

// });


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
	
	



<style>
	/* .container {
  margin-top: 50px;
  cursor: move;

  
} */
/* 
#screen {
  overflow: hidden;
  width: 200px;
  height: 200px;
  clear: both;
  border: 1px solid black;
} */

</style>
