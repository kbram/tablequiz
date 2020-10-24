
   <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> -->
   <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.min.js"></script>
<script>
$(document).ready(function(){

  $('.quiz-upload').click(function(){
    var imageUrl =$('#get_default_image').val();
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
        url: imageUrl
      }).then(function(){


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




