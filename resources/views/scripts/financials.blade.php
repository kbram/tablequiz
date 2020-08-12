<script type="text/javascript">
  $(document).ready(function() {
    
    $("button").click(function(e) {
      var id=e.target.id;
    e.preventDefault();
    $.ajax({
        type: "POST",
        url: "{{route('update')}}",
        dataType: 'json',
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        data:{
             id   : id,
             get_from : $('#from'+id).val(), 
             get_to : $('#to'+id).val(), 
             get_cost : $('#cost'+id).val(), 
        },
        success: function(results) {
           
        },
        error: function(result) {
         
        },
        
    });
});

  });
</script>