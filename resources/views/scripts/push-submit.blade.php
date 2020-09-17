<script type="text/javascript">
$(document).ready(function() { 
   //var time=JSON.parse(sessionStorage.getItem("nowstarttimeon"));
   
   $('#push-submit').click(function(e){
      e.preventDefault();
      $('.quiz__slider .quiz__single_question__container').each(function(){
      

       var answer="";
       var answer_id="";
       var type="";
       var media_type="";
       var media_path="";
       var media_link="";
       var time=0;

       var current=$(this);
         var hidden=current.attr('aria-hidden');
         if(hidden=="false"){
            var question =current.find('.question > span:nth-child(2)').text();
            
            time =current.find('.question-timer').val();
            var round =current.find('.question-round').val();
            var type =current.find('.question-type').val();
            var user =current.find('.question-user').val();
            var id =current.find('.question-id').val();
            var quiz_id =current.find('.quiz-id').val();
            var time =current.find('.question-timer').val();
                console.log('type'+type);
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
           type:type,
           time:time,

        },
        success: function(data) {
         
         },

         });
         }
         
         
            
         });
       
      
      });
     
   

      var progress=0;
      var round_count=-1;
      var progress_divide=100;
      $('.progress_round_label').each(function(){
          round_count++;
      });
     
      progress_divide/=round_count;
        
    
   $('.quiz__slider .quiz__single_question__container').each(function(){
      $('#round-progress').css("width",'0%');
      var current=$(this);
         var hidden=current.attr('aria-hidden');
         if(hidden=="false"){
            var round_val=current.find('.question-round').val();
            progress=Number(round_val);
            $('.progress_round_label').removeClass('round_2');
             $('#round'+round_val).addClass('round_2');

            var time =current.find('.question-timer').val();
            
            sec=time;
            var min     = Math.floor(sec / 60),
				remSec  = sec % 60;
			
            if (remSec < 10) {
               
               remSec = '0' + remSec;
            
            }
            if (min < 10) {
               
               min = '0' + min;
            
            }
            
            $('.countdown__time').text(min + ":" + remSec);
         }

   });
   
    
   $('.slick-btns').click(function(){ 
   $('.quiz__slider .quiz__single_question__container').each(function(){
      var current=$(this);
      
         var hidden=current.attr('aria-hidden');
         if(hidden=="false"){
            
            var round_val=current.find('.question-round').val();
            $('.progress_round_label').removeClass('round_2');
             $('#round'+round_val).addClass('round_2');
           
                 if(progress!=Number(round_val)){
                    $('#round-progress').css("width",progress_divide+'%');
                     progress_divide+=progress_divide;
                     progress=Number(round_val);
                  }
                 else{
                    
                 }

            var time =current.find('.question-timer').val();
            sec=time;
            var min     = Math.floor(sec / 60),
				remSec  = sec % 60;
			
            if (remSec < 10) {
               
               remSec = '0' + remSec;
            
            }
            if (min < 10) {
               
               min = '0' + min;
            
            }
            $('.countdown__time').text(min + ":" + remSec);
            /*
            var text=$("#timer").text();
            sessionStorage.setItem("nowstarttimeon", true);
            

            if(text=="Finshed"){
               $('.countdown__time').text(min + ":" + remSec);
               $("#push-submit").css("pointer-events", "auto");
				   $('#push-submit').css('opacity','1');
            }else{
               $("#push-submit").css("pointer-events", "none");
			      $('#push-submit').css('opacity','0.4');
            }*/
            

            //$('.countdown__time').text(time);
         }

   });

  

});



$('#push-submit-pause').click(function(e){
       e.preventDefault();  
      
       $.ajax({
        type: "POST",
        url: "/quiz/pause_quiz",
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        data: $(this).closest('.push-submit-pause-form').serialize(),
        
        success: function(data) {
         
         },

         });
});

$('#push-submit-stop').click(function(e){
       e.preventDefault();  
    
       $.ajax({
        type: "POST",
        url: "/quiz/stop_squiz",
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        data: $(this).closest('.push-submit-stop-form').serialize(),
        
        success: function(data) {
         
         },

         });
});

});



</script>