<script type="text/javascript">
  $(document).ready(function() {
    
    $("body").delegate('.block', 'click',function(e) {
        e.preventDefault();
        var id=$(this).attr('id');
        var text=$('#block'+id).text();
        if(text=='Block'){
          swal({
                    title: "Are you sure?",
                    text: "You are blocking this Quiz! You can unblock it at any time!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                    })
                    .then((willDelete) => {
                    if (willDelete) {
                                 $(e.target).closest('form').submit();
                        swal("Poof! Your Quiz has been blocked!", {
                        icon: "success",
                        
                        });
                    } else {
                        swal("Poof! Your Quiz is back again!");
                        
                    }
                 
                    });
                       }


                       else if(text=='Un-Block'){
                       swal({
                    title: "Are you sure?",
                    text: "You are un-blocking this Quiz!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                    })
                    .then((willDelete) => {
                    if (willDelete) {
                                 $(e.target).closest('form').submit();
                        swal("Poof! Your Quiz is back again!", {
                        icon: "success",
                        
                        });
                    } else {
                        swal("Poof! Your Quiz has been blocked!");
                        
                    }
                 
                    });
                       }
  
  
   
    });
  });
</script>

