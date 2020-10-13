<script type="text/javascript">
$(document).ready(function() {
    
    $('.publish-quiz').click(function(e){
        e.preventDefault();

var quiz_id = "";
var formdata = new FormData($("#add_round")[0]);

  $.ajax({


    data: formdata,
    processData: false,
    contentType: false,
    cache: false,
    enctype: 'multipart/form-data',

    type: "post",
    url: $("#add_round").attr("action"),
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
    success: function (response) {
        console.log("success");
        //$("#publishQuizModal").modal("show");
    },
    error: function (result, error) {
        console.log("errror");
        //$("#publishQuizModal").modal("show");
        //$("#modal__payment").modal("show");
    },
});
    
        $.ajax({
        type: "POST",
        url: "/payment",
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        data:{
            count : sessionStorage.count
        },
        success: function(data) {


            var participants=data.participants.no_of_participants;
            var participants_cost=data.participants_cost[0].cost;
            quiz_id = data.quiz_id;
             var questions_cost=0;
            $('#modal__payment').find('.no-participants td:nth-child(2)').text(participants);
            $('#modal__payment').find('.no-participants td:nth-child(3)').text(participants_cost);

            $('#modal__payment').find('.suggested-questions td:nth-child(2)').text(sessionStorage.count)

            if(data.question_cost != null){
                $('#modal__payment').find('.suggested-questions td:nth-child(3)').text(data.question_cost.cost);
                questions_cost=data.question_cost.cost
            }
            else{
                $('#modal__payment').find('.suggested-questions td:nth-child(3)').text(0);
                 questions_cost=0;
            }
                  
    var customised_backgrounds_details=$('#modal__payment').find('.customised-backgrounds td:nth-child(2)').text(data.bg_image);
    console.log(data.bg_image_cost.cost);
    var customised_backgrounds_price=$('#modal__payment').find('.customised-backgrounds td:nth-child(3)').text(data.bg_image_cost);
  
    $('#modal__payment').find('.total-cost td:nth-child(2)>strong').text(Number(participants_cost)+Number(questions_cost)+Number(data.bg_image_cost));
   
    var total_card = Number(participants_cost)+Number(questions_cost)+Number(data.bg_image_cost ); 
    $('#card_total').val(total_card);
    $('#quiz_id').val(quiz_id);
    console.log(quiz_id);


        },
        error: function(result,error) {
            
       
        
        },

      });



      //card fill

      $.getJSON('/card',function (data){
        
        $('#modal__payment').find('#card-holder-name').val(data.name);
        $('#modal__payment').find('#cardholder_street').val(data.street);
        $('#modal__payment').find('#cardholder_city').val(data.city);
        $('#modal__payment').find('#cardholder_country').val(data.country);
        $('#modal__payment').find('#cardholder_number').val(data.card_number);
        $('#modal__payment').find('#cardholder_expiry_month').val(data.exp_month);
        $('#modal__payment').find('#cardholder_expiry_year').val(data.exp_year);
        $('#modal__payment').find('#card-cvc').val(data.cvv);

});




    

   
    });
   
})
</script>