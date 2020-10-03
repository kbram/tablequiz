
<script type="text/javascript">
$("body").delegate('.share', 'click',function(e){
    var id=e.target.id;
    var text  = document.getElementById("quizLink"+id).innerHTML;
    copyText(text);
    swal("Quiz Link copied","","success");

    function copyText(text) {
    navigator.clipboard.writeText("https://tablequiz.app/"+text);
    }
  });


</script>