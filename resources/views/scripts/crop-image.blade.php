

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
      width:300,
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

       

});  
</script>




