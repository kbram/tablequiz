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
            $('#push-submit-form-question').val(question);
            $('#push-submit-form-answer').val( answer);
            $('#push-submit-form-time').val(time);

           
            console.log(time);
            
         }
       
      
      });
     
       $('#push-submit-form').submit();
   });
});

</script>