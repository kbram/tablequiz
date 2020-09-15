<script type="text/javascript">
  $(document).ready(function() {
    
    $(".block").click(function(e) {
        e.preventDefault();
        var id=e.target.id;
        var text=$('#'+id).text();
           
        if(text=='block'){
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


                       else if(text=='un-block'){
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

