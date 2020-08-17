<script type="text/javascript">

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
   console.log('clickeddd');
  readURL(this);
  
});

  });
</script>