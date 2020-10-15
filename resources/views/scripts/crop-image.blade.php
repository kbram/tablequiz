

   <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> -->
   <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.min.js"></script>
<script>  
$(document).ready(function(){

/**image convert */
var get_image_url;
function convertImgToBase64(url, callback, outputFormat){
	var canvas = document.createElement('CANVAS');
	var ctx = canvas.getContext('2d');
	var img = new Image;
	img.crossOrigin = 'Anonymous';
	img.onload = function(){
		canvas.height = img.height;
		canvas.width = img.width;
	  	ctx.drawImage(img,0,0);
	  	var dataURL = canvas.toDataURL(outputFormat || 'image/png');
	  	callback.call(this, dataURL);
        // Clean up
	  	canvas = null; 
	};
	img.src = url;
}



    var imageUrl =$('#get_default_image').val();
    console.log('imageUrl', imageUrl);
    convertImgToBase64(imageUrl, function(base64Img){
                get_image_url=base64Img;
    });


/**image convert end */

  $('.quiz-upload').click(function(){
    
    $image_crop = $('#image-container').croppie({
    enableExif: true,
    viewport: {
      width:200,
      height:200,
      type:'circle' //circle
    },
    boundary:{
      width:464,
      height:300
    }
  });
   
  $image_crop.croppie('bind', {
        url:get_image_url
      }).then(function(){
        console.log('jQuery bind complete');
        
        

      });

      $('.cr-slider').addClass('slider');
       $('.cr-slider').css('width','100%');
       $('.cr-slider').removeClass('cr-slider');
  });



  $('.edit-quiz-upload').click(function(){
    var get_image_url=$('#get_image_url').val();
    $image_crop = $('#image-container').croppie({
    enableExif: true,
    viewport: {
      width:200,
      height:200,
      type:'circle' //circle
    },
    boundary:{
      width:464,
      height:300
    }
  });
   
  $image_crop.croppie('bind', {
        url:get_image_url
      }).then(function(){
        console.log('jQuery bind complete');
        
        

      });

      $('.cr-slider').addClass('slider');
       $('.cr-slider').css('width','100%');
       $('.cr-slider').removeClass('cr-slider');

  });

  $("#edit__icon__modal").on('hidden.bs.modal', function(){
                   	/**croppie destroy */
		$('#image-container').croppie('destroy');
             });
    
});  
</script>




