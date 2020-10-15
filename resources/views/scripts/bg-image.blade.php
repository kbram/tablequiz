<script type="text/javascript">
$(document).ready(function() { 

//Image Rotate
var angle = 360;
document.getElementById('rotate').onclick = function() { 
        cropper.destroy();
        cropper = null;
     var img = document.getElementsByClassName('cropper-hide');
     angle = (angle - 90) % 360;
     cropper = new Cropper(image, {
	  aspectRatio: 3/2,
	  viewMode:1,
    preview: '.preview',
    
	  ready() {
    this.cropper.rotate(angle);
          },
	  
        	});
       }



       
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



