<script type="text/javascript">
  $(document).ready(function() {
    
    $("body").delegate('.blockuser', 'click',function(e) {
        e.preventDefault();
        var id=$(this).attr('id');
        var text=$('#'+id).text();
           
        if(text=='block'){
          swal({
                    title: "Are you sure?",
                    text: "You are blocking this User! You can unblock it at any time!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                    })
                    .then((willDelete) => {
                    if (willDelete) {
                                 $(e.target).closest('form').submit();
                        swal("Poof! This User has been blocked!", {
                        icon: "success",
                        
                        });
                    } else {
                        swal("Poof! This User is unblocked!");
                        
                    }
                 
                    });
                       }


                       else if(text=='un-block'){
                       swal({
                    title: "Are you sure?",
                    text: "You are un-blocking this User!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                    })
                    .then((willDelete) => {
                    if (willDelete) {
                                 $(e.target).closest('form').submit();
                        swal("Poof! This User has been unblocked!", {
                        icon: "success",
                        
                        });
                    } else {
                        swal("Poof! This User is unblocked!");
                        
                    }
                 
                    });
                       }
  
  
   
    });
  });
</script>



