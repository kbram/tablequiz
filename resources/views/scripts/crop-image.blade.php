

   <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> -->
   <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.min.js"></script>
<script>  
$(document).ready(function(){
  console.log('hi crop image');
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
//    var image_src;
//   $('.imagePreviewInput').on('change', function(){
//     var reader = new FileReader();
//     reader.onload = function (event) {
//       $image_crop.croppie('bind', {
//         url: event.target.result
//       }).then(function(){
//         console.log('jQuery bind complete');
//         image_src=event.target.result;
        

//       });
//     }
//     reader.readAsDataURL(this.files[0]);
//   });

  $('#btn-crop').click(function(event){
    $image_crop.croppie('result', {
      type: 'canvas',
      size: 'viewport'
    }).then(function(response){
        $('#crop-image').val(response);
        console.log(response);
     
    })
  });
  //var get_image_src=$('.cr-image').attr('src');
 // var get_image_url=$('#get_image_url').val();
 var get_image_url=$('#get_image_url').val();
       var find_crop_image=$('.edit-quiz-image-container').find('.cr-image');
       var find_crop_slider=$('.edit-quiz-image-container').find('.cr-slider');
       var find_crop_overlay=$('.edit-quiz-image-container').find('.cr-overlay');
       find_crop_image.attr('src',get_image_url);
       find_crop_image.attr('style','opacity: 1; transform: translate3d(82.5px, 66px, 0px) scale(1.5); transform-origin: 149.5px 84px;');
       find_crop_slider.attr('min','1.0811');
       find_crop_slider.attr('max','1.5000');
       find_crop_slider.attr('aria-valuenow',1.5);
       $('.cr-slider').addClass('slider');
       $('.cr-slider').css('width','100%');
       $('.cr-slider').removeClass('cr-slider');
       find_crop_overlay.attr('style','width: 409.5px; height: 277.5px; top: 11.25px; left: 27.25px;');
  
});  
</script>




