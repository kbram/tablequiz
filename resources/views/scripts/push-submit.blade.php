<script type="text/javascript">
$(document).ready(function() { 
   //git check
   //var time=JSON.parse(sessionStorage.getItem("nowstarttimeon"));
   var pl=true;
   var time=JSON.parse(sessionStorage.getItem("nowtimeon"));
   var p=JSON.parse(sessionStorage.getItem("play"));
   var timeon=0;
//    $('.bespoke-slide').each(function () {
   
//     if($(this).hasClass('bespoke-active')){
//       var x=$(this);
//       alert($(x).find(".question-timer").val());
//     }
//   });
   $('#push-submit').click(function(e){
      e.preventDefault();

      $('.bespoke-slide').each(function () {
         time=JSON.parse(sessionStorage.getItem("nowtimeon"));
         timeon=0;
         if(time!=null){
            var splity=time.split(":");
            timeon=parseInt(splity[0])*60+parseInt(splity[1]);
         }
         p=JSON.parse(sessionStorage.getItem("play"));
         
         if(p==null){
            pl= true;
         }else{
            pl=p;
         }

         var answer="";
         var answer_id="";
         var type="";
         var media_type="";
         var media_path="";
         var media_link="";
         var time=0;

          var current=$(this);
         // var hidden=current.attr('aria-hidden');
         if(current.hasClass('bespoke-active')){
            
            var ti =$("#timer").text();
            
            if(ti!="Finished"){
               var question =current.find('.question > span:nth-child(2)').text();
               
               time =current.find('.question-timer').val();
               var round =current.find('.question-round').val();
               var type =current.find('.question-type').val();
               var user =current.find('.question-user').val();
               var id =current.find('.question-id').val();
               var quiz_id =current.find('.quiz-id').val();
               if(pl==true){
                  var time =current.find('.question-timer').val();
               }else{
                  var time=timeon;
               }
               //sessionStorage.setItem("play", false);
               
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
         }
         
         
            
      });    
   });

      //kopi round
      var progress=0;
      var round_count=-1;
      var progress_divide=100;
      $('.progress_round_label').each(function(){
          round_count++;
      });
      progress_divide/=round_count;
      progress_add= progress_divide;

     
      $('#issue').click(function(e){
         

      e.preventDefault();
      $('.bespoke-slide').each(function () {
      time=JSON.parse(sessionStorage.getItem("nowtimeon"));
      timeon=0;
      if(time!=null){
         var splity=time.split(":");
         timeon=parseInt(splity[0])*60+parseInt(splity[1]);
      }
      p=JSON.parse(sessionStorage.getItem("play"));
      
      if(p==null){
         pl= true;
      }else{
         pl=p;
      }
      
       var answer="";
       var answer_id="";
       var type="";
       var media_type="";
       var media_path="";
       var media_link="";
       var time=0;
    
       var current=$(this);
      // var hidden=current.attr('aria-hidden');
      if(current.hasClass('bespoke-active')){
         var ti =$("#timer").text();
         
         if(ti!="Finished"){
            var question =current.find('.question > span:nth-child(2)').text();
            
            time =current.find('.question-timer').val();

            var issue =current.find('.question-issue').val();
            

            current.find('.question-issue').val("1");
            
            var round =current.find('.question-round').val();
            var type =current.find('.question-type').val();
            var user =current.find('.question-user').val();
            var id =current.find('.question-id').val();
            var quiz_id =current.find('.quiz-id').val();
            if(pl==false){
               var time =current.find('.question-timer').val();
            }else{
               var time=timeon;
            }
            //sessionStorage.setItem("play", false);
           
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


            var x=time;
           if(issue=="0"){
             
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
      }
      else{
         
      }
         }
         
         
            
         });
      });
      $('.bespoke-slide').each(function () {
      
       var current=$(this);
      //    var hidden=current.attr('aria-hidden');
         if(current.hasClass('bespoke-active')){
            var que_no=current.find('.question_number').text();
             $('.question_number2').text(que_no);
            var round_val=current.find('.question-round').val();
            var question_id=current.find('.question-id').val();
             $('#edit_question').attr('href','/round_question/edit/'+question_id);
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
            $('.bespoke-slide').each(function () {
                var current=$(this);
               // var hidden=current.attr('aria-hidden');
               if(current.hasClass('bespoke-active')){
                  var issue =current.find('.question-issue').val();
                  if(issue=="1"){
                     $('.countdown__time').text("Finished");
                  }else{
                     $('.countdown__time').text(min + ":" + remSec);
                  }
               }
            });
         }

   });
   
    
   $('.slick-btns0').click(function(){ 
      var current_btn=$(this);
      $('.bespoke-slide').each(function () {
      var current=$(this);
      //    var hidden=current.attr('aria-hidden');
      if(current.hasClass('bespoke-active')){
             var que_no=current.find('.question_number').text();
             $('.question_number2').text(que_no);
            var round_val=current.find('.question-round').val();
            $('.progress_round_label').removeClass('round_2');
             $('#round'+round_val).addClass('round_2');
             var question_id=current.find('.question-id').val();
             $('#edit_question').attr('href','/round_question/edit/'+question_id);
            
                 if(progress!=Number(round_val)){
                    if(current_btn.hasClass('slick-next')){
                     $('#round-progress').css("width",progress_add+'%');
                     progress_add+=progress_divide;
                     progress=Number(round_val);
                    }else{
                    
                     progress_add-=progress_divide;
                     $('#round-progress').css("width",progress_add+'%');
                     progress=Number(round_val);
                    }
                    
                   
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
            $('.bespoke-slide').each(function () {
                var current=$(this);
               // var hidden=current.attr('aria-hidden');
               if(current.hasClass('bespoke-active')){
                  var issue =current.find('.question-issue').val();
                  if(issue=="1"){
                     $('.countdown__time').text("Finished");
                  }else{
                     $('.countdown__time').text(min + ":" + remSec);
                  }
               }
            });
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
       sessionStorage.setItem("play", true);
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
      sessionStorage.setItem("play", true);
       $.ajax({
        type: "POST",
        url: "/quiz/stop_quiz",
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        data: $(this).closest('.push-submit-stop-form').serialize(),
        
        success: function(data) {
         
         },

         });
});
$('#share_question').click(function(e){
         e.preventDefault();
         $('.bespoke-slide').each(function () {
            var current=$(this);
            var hidden=current.attr('aria-hidden');
            if(current.hasClass('bespoke-active')){
               
               var answerright =current.find('.answer-right').val();
               
               if(answerright==null){
                  
                  swal("You are not submit answer !",'please update correct answer...', "danger");
               }else{
                  
                  var question =current.find('.question > span:nth-child(2)').text();
               
                  var time =current.find('.question-timer').val();
                  var round =current.find('.question-round').val();
                  var type =current.find('.question-type').val();
                  var user =current.find('.question-user').val();
                  var id =current.find('.question-id').val();
                  var quiz_id =current.find('.quiz-id').val();
                  var answer="";
                  var answer_id="";
               
                  var media_type="";
                  var media_path="";
                  var media_link="";

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
                     url: "/quiz/issue_answer",
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
                        correct_ans:answerright,
                     },
                     success: function(data) {
                        
                     },
                  });
               }
            }
         });
      });
});



</script>