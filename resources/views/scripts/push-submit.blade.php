<script type="text/javascript">
$(document).ready(function() { 

   $('#push-submit').click(function(e){
       e.preventDefault();
      $('.quiz__slider .quiz__single_question__container').each(function(){
      
         var answer="";
          var current=$(this);
         var hidden=current.attr('aria-hidden');
         if(hidden=="false"){
            var question =current.find('.question > span:nth-child(2)').text();
            var time =current.find('.question-timer').val();
             current.find('.answer > span:nth-child(2)').each(function(){
                answer+=$(this).text()+"/";
           
             });
           
            $.ajax({
        type: "POST",
        url: "/quiz/run_quiz",
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        data:{
           questionno:'',
           question:question,
           answer:answer,
           media:'',
           answerId:'',
           questionId:'',
           roundId:'',
           quizId:'',
           type:'',
           time:time,

        },
        success: function(data) {
         
        },
        error: function(result,error) {
      
        },

      });
            
         }
       
      
      });
     
   });


   $('.quiz__slider .quiz__single_question__container').each(function(){
      var current=$(this);
         var hidden=current.attr('aria-hidden');
         if(hidden=="false"){
            var time =current.find('.question-timer').val();
            $('.countdown__time').text(time);
         }

   });

   $('.slick-btns').click(function(){
   $('.quiz__slider .quiz__single_question__container').each(function(){
      var current=$(this);
         var hidden=current.attr('aria-hidden');
         if(hidden=="false"){
            var time =current.find('.question-timer').val();
            $('.countdown__time').text(time);
         }

   });
});

   

});

</script>