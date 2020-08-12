<script type="text/javascript">
  $(document).ready(function() {

    $("#btn1").click(function(e) {
      
    e.preventDefault();
    $.ajax({
        type: "POST",
        url: "/financial",
        dataType: 'json',
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        data:{
             get_cost1 : $('#cost1').val(),
             get_cost2 : $('#cost2').val(),
             get_cost3 : $('#cost3').val(),
        },
        success: function(results) {
            alert('ok');
        },
        error: function(result) {
          alert('erro');
        },
        
    });
});

  });
</script>