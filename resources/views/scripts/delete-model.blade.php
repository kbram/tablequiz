<script>

    $('span.delete').click(function(e){
         
        e.preventDefault() // Don't post the form, unless confirmed
        
        
                swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this imaginary file!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                    })
                    .then((willDelete) => {
                    if (willDelete) {
                            $(e.target).closest('form').submit();
                           
                        swal("Poof! Your imaginary file has been deleted!", {
                        icon: "success",
                        
                        });
                    } else {
                        swal("Your imaginary file is safe!");
                    }
                    // $(e.target).closest('form').submit();
                    });
            
                    // $(e.target.id).closest('form').submit();
    });
</script>