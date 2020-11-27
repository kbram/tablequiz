

<script type="text/javascript">
$('div.message').click(function(e){
  var id=$(this).attr('id');
    var text  = document.getElementById("emailLink"+id).innerHTML;
    copyText(text);
    swal("Quiz Creator email copied","","success");

    function copyText(text) {
    navigator.clipboard.writeText(text);
    }
  });


</script>