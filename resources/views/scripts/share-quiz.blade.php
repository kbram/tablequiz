
<script type="text/javascript">
$('button').click(function(e){
    var id=e.target.id;
    var text  = document.getElementById("quizLink"+id).innerHTML;
    copyText(text);
    alert("Quiz Link copied");

    function copyText(text) {
    navigator.clipboard.writeText(text);
    }
  });


</script>