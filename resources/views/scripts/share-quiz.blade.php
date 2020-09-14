
<script type="text/javascript">
$('.share').click(function(e){
    var id=e.target.id;
    var text  = document.getElementById("quizLink"+id).innerHTML;
    copyText(text);
    swal("Quiz Link copied","");

    function copyText(text) {
    navigator.clipboard.writeText(text);
    }
  });


</script>