<script type="text/javascript">
  $(document).ready(function() {
    
    $("button").click(function(e) {
      var id=e.target.id;
    e.preventDefault();
    $.ajax({
        type: "POST",
        url: "{{route('update')}}",
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        data:{
             id   : id,
             get_from : $('#from'+id).val(), 
             get_to : $('#to'+id).val(), 
             get_cost : $('#cost'+id).val(), 
        },
        success: function(results) {
           
           $('#msg'+id).text('updated sucessfully');
           setTimeout(function() {
        $("#msg"+id).text('')
    }, 1000);
        },
        error: function(result,error) {
         alert('error');
        
        },
        
    });
});

  });
</script>