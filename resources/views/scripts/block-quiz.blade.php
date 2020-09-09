<script type="text/javascript">
  $(document).ready(function() {
    
    $(".block").click(function(e) {
        e.preventDefault();
        var id=e.target.id;
        var text=$('#'+id).text();
           
        if(text=='block'){
          swal({
                    title: "Are you sure?",
                    text: "Once un-blocked, you can able to block this Quiz!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                    })
                    .then((willDelete) => {
                    if (willDelete) {
                                 $(e.target).closest('form').submit();
                        swal("Poof! Your imaginary file has been un-blocked!", {
                        icon: "success",
                        
                        });
                        console.log(text);
                    } else {
                        swal("Your imaginary file is safe!");
                        
                    }
                 
                    });
                       }


                       else if(text=='un-block'){
                       swal({
                    title: "Are you sure?",
                    text: "Once blocked, you can able to un-block this Quiz!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                    })
                    .then((willDelete) => {
                    if (willDelete) {
                                 $(e.target).closest('form').submit();
                        swal("Poof! Your imaginary file has been blocked!", {
                        icon: "success",
                        
                        });
                        console.log(text);
                    } else {
                        swal("Your imaginary file is safe!");
                        
                    }
                 
                    });
                       }
  
  
   
    });
  });
</script>