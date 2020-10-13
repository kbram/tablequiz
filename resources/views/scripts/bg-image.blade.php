<script type="text/javascript">
 //Image zoom size
// var slider = document.getElementById("formControlRange");

// slider.oninput = function() { 

//   var image = document.getElementById('round_image');
//       image.style.width = 20*(this.value)+'px';
//       image.style.height = 20*(this.value)+'px';
     
//       if(this.value < 20){ image.style.marginTop = (100-this.value)+'px';}
//       else{
//         image.style.marginTop ='auto';
//       }
    
// }


//Image Rotate
var angle = 360;
  //img = document.getElementById('image');

document.getElementById('rotate').onclick = function() { 
  var img = document.getElementsByClassName('cropper-hide');
     $('.cropper-hide').css('transform','rotate('+angle+'deg)');
  angle = (angle - 90) % 360;
 img.style.transform = 'rotate('+angle+'deg)';
}




  $(document).ready(function() { 
    function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    
    reader.onload = function(e) {
      $("#round_image").attr('src', e.target.result);

    }
    
    reader.readAsDataURL(input.files[0]); // convert to base64 string
  }
}


$("#upload__quiz__icon").change(function() {
  
  readURL(this);
  
});





  });

  
</script>

<script>
    var zoomer = document.getElementById('zoomer');
var hubblepic = document.getElementById('image');

function deepdive(){   hubblepic =$('.cropper-hide');
  zoomlevel = zoomer.valueAsNumber;
  $('.cropper-hide').css('transform','scale('+zoomlevel+')');
  // hubblepic.style.webkitTransform = "scale("+zoomlevel+")";
	// hubblepic.style.transform = "scale("+zoomlevel+")";
}
</script>
<style>
     #image-container {
  width: 100%;
  font-size: 0;
  overflow: hidden;
  margin: 0 auto;
 /* margin-top: 2rem;*/
}

#round_image{
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
<!-- 
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script>
	$(function() {
  $(".draggable").draggable();
});
</script> -->






<style>
	/* .container {
  margin-top: 50px;
  cursor: move;

  
}

#screen {
  overflow: hidden;
  width: 200px;
  height: 200px;
  clear: both;
  border: 1px solid black;
} */

</style>