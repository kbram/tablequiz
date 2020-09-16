<script type="text/javascript">
$(document).ready(function() { 
   $('#push-submit').click(function(e){
       e.preventDefault();
      $('.quiz__slider .quiz__single_question__container').each(function(){
      
       var answer="";
       var answer_id="";

       var media_type="";
       var media_path="";
       var media_link="";


       var current=$(this);
         var hidden=current.attr('aria-hidden');
         if(hidden=="false"){
            var question =current.find('.question > span:nth-child(2)').text();
            
            var time =current.find('.question-timer').val();
            var round =current.find('.question-round').val();
            var type =current.find('.question-type').val();
            var user =current.find('.question-user').val();
            var id =current.find('.question-id').val();
            var quiz_id =current.find('.quiz-id').val();
            var time =current.find('.question-timer').val();

             current.find('.answer > span:nth-child(2)').each(function(){
                answer+=$(this).text()+"/";
           });
           current.find('.answer-id').each(function(){
                answer_id+=$(this).val()+"/";
           });
           current.find('.question-media-type').each(function(){
                media_type+=$(this).val()+"/";
           });

           current.find('.question-media-path').each(function(){
                media_path+=$(this).val()+"**";
           });


           current.find('.question-media-ink').each(function(){
                media_link+=$(this).val()+"**";
            });
// console.log('hi'+question);
//             $('#push-submit-form-question').val(question);
//             $('#push-submit-form-answer').val( answer);
//             $('#push-submit-form-time').val(time);
//             $('#push-submit-form-media').val(media_type);
//             $('#push-submit-form-media_link').val(media_link);
//             $('#push-submit-form-media_path').val(media_path);

//             $('#push-submit-form-answerId').val(answer_id);
//             $('#push-submit-form-questionId').val(id);
//             $('#push-submit-form-roundId').val(round);
//             $('#push-submit-form-quizId').val(time);

//             $('#push-submit-form-type').val(time);
           
           
             
           
            $.ajax({
        type: "POST",
        url: "/quiz/run_quiz",
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        data:{
           question:question,
           answer:answer,
           media_type:media_type,
           media_link:media_link,
           media_path:media_path,

           answerId:answer_id,
           questionId:id,
           roundId:round,
           quizId:quiz_id,
           
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