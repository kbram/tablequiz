<script type="text/javascript">
  $(document).ready(function() {

    $('#check1').on('change', function() {
  
      if (this.checked) {
        console.log('checked');
        var get_cost = $('#check1cost').val();
        console.log(get_cost);
        $.ajax({
         
          type: "POST",
          url: "/financials/check1",
          data: $(this).serialize(),
          dataType: 'json',
          success: function(data) {
            console.log('it workkkk');
            alert('it worked');
            
          },
          error: function() {
            console.log('wont workkkk');
            alert('it broke');
          },
          complete: function() {
            alert('it completed');
          }
        });

      }
    });
    console.log('after ajax');
    $('#subscribe').click(function(e) {
      e.preventDefault(); // this prevents the form from submitting
      $.ajax({
        url: '/subscribe',
        type: "post",
        data: {
          'subscribe_email': $('input[name=subscribe_email]').val(),
          '_token': $('input[name=_token]').val()
        },
        dataType: 'JSON',
        success: function(data) {
          console.log(data); // this is good
        }
      });
    });
  });
</script>