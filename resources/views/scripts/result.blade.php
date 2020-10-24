<script type="text/javascript">
$(document).ready(function() { 
    $('.slick-btns').click(function(){ 
        var current;
        var question_id=0;
        $('.quiz__slider .quiz__single_question__container').each(function(){
      
      current=$(this);
         var hidden=current.attr('aria-hidden');
         if(hidden=="false"){
            question_id=current.find('.question-id').val();
            round_id=current.find('.question-round').val();
         }

   });
        $.ajax({
        type: "POST",
        url: "/ajax/team_result/"+question_id,
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        data:{
            
        },
        success: function(data) {
           var data = data.team_result;

           
        //        var que=data.msg;
        //   var ans=data.ans;
        $("#all-answer_submit").html('');
        var ct = data.length;

if(ct>1){
        for( var i=0; i<ct; i++){

        var text ='<hr>'
                   +'<div class="row container h-25 align-items-center justify-content-center">'+
           '<p class="col-md-4 pb-0 text-center">"'+data[i].team_name+'"</p> '+
        '<input  type="text" name="team[]" hidden class="col-md-4 pb-0 text-center" value="'+data[i].team_name+'">'
        +'<input  type="text" name="quiz/"+m[0]+" hidden class="col-md-4 pb-0 text-center" value="'+data[i].quiz_id+'">'+
       ' <input  type="text" name="round/"+m[0]+" hidden class="col-md-4 pb-0 text-center" value="'+data[i].round_id+'">'+
       '<input  type="text" name="question/"+m[0]+" hidden class="col-md-4 pb-0 text-center" value="+'+data[i].queston_id+'">'+ 
       '<p class="col-md-4 pb-0 text-center">"'+data[i].answer+'"</p>'+
        '<div class="col-md-4 pb-0 text-center"> <div class="row d-flex">'+ 
        '<input type="radio" id="+id_correct+" name="status/"+m[0]+" value=1 class="col-md-6 py-0 text-muted text-center">'+
         '<input type="radio" name="status/"+m[0]+" id="+id_wrong+" value=0 class="col-md-6 py-0 text-muted text-center"> '+
         '</div> </div> </div>';
		$(text).appendTo($("#all-answer_submit"));
        }

      }

        },
        error: function(result,error) {
            
       
        
        },

      });


       
      
		
    });
   
  
    
});
</script>