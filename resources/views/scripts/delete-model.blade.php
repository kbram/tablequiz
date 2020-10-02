<script>

$("body").delegate('span.delete', 'click',function(e){
         
        e.preventDefault() // Don't post the form, unless confirmed
        
        
                swal({
                    title: "Are you sure?",
                    text: "Once you delete, you can't get it back",
                    buttons: true,
                    dangerMode: true,
                    })
                    .then((willDelete) => {
                    if (willDelete) {
                            $(e.target).closest('form').submit();
                           
                        swal(" Your data has been deleted!", {
                        icon: "success",
                        
                        });
                    } else {
                        swal("Your data is safe!");
                    }
                    // $(e.target).closest('form').submit();
                    });
            
                    // $(e.target.id).closest('form').submit();
    });
</script>