<script type="text/javascript">

  $(document).ready(function() {

$('#save_answer_button').on('click', function(e){
 e.preventDefault();  

 $.ajax({
            type: "POST",
            url: "/playquiz/save/answer",
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            data: $('#answer_submit_form').serialize(),
            
            success: function(data) {
                swal("Answers Saved !",'answers updated ', "success");
                
            },

            });


});




  });
</script>