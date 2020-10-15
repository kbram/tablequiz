
<script type="text/javascript">
$("body").delegate('.share', 'click',function(e){
    var id=e.target.id;
    var text  = document.getElementById("quizLink"+id).innerHTML;
    copyText(text);
    swal("Quiz Link copied","","success");

    function copyText(text) {
      var get_url=$('#get_url').val();
    navigator.clipboard.writeText(get_url+"play/"+text);
    }
  });


</script>