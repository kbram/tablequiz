

<script type="text/javascript">
$('span.message').click(function(e){
    var id=e.target.id;
    var text  = document.getElementById("emailLink"+id).innerHTML;
    copyText(text);
    swal("Quiz Creator email copied","");

    function copyText(text) {
    navigator.clipboard.writeText(text);
    }
  });


</script>