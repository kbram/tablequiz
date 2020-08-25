
<script type="text/javascript">
$('.message').click(function(e){
    var id=e.target.id;
    var text  = document.getElementById("quizLink"+id).innerHTML;
    copyText(text);
    alert("Quiz Master email copied");==

    function copyText(text) {
    navigator.clipboard.writeText(text);
    }
  });


</script>