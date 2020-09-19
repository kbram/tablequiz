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
            
         }

   });
console.log('id'+question_id);
        $.ajax({
        type: "POST",
        url: "/ajax/team_result/"+question_id,
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        data:{
            
        },
        success: function(data) {
        //        var que=data.msg;
        //   var ans=data.ans;
        $("#all-answer_submit").html('');
        var text ='<hr>'
                   +'<div class="row container h-25 align-items-center justify-content-center">'+
           '<p class="col-md-4 pb-0 text-center">"User"</p> '+
        '<input  type="text" name="team[]" hidden class="col-md-4 pb-0 text-center" value="+m[0]+">'
        +'<input  type="text" name="quiz/"+m[0]+" hidden class="col-md-4 pb-0 text-center" value="+m[4]+">'+
       ' <input  type="text" name="round/"+m[0]+" hidden class="col-md-4 pb-0 text-center" value="+m[6]+">'+
       '<input  type="text" name="question/"+m[0]+" hidden class="col-md-4 pb-0 text-center" value="+m[5]+">'+ 
       '<p class="col-md-4 pb-0 text-center">"+m[1]+"</p>'+
        '<div class="col-md-4 pb-0 text-center"> <div class="row d-flex">'+ 
        '<input type="radio" id="+id_correct+" name="status/"+m[0]+" value=1 class="col-md-6 py-0 text-muted text-center">'+
         '<input type="radio" name="status/"+m[0]+" id="+id_wrong+" value=0 class="col-md-6 py-0 text-muted text-center"> '+
         '</div> </div> </div>';
		$(text).appendTo($("#all-answer_submit"));


        console.log('pk'+data.msg);
        },
        error: function(result,error) {
            
        console.log(error);
        
        },

      });


       
      
		
    });
   
  
    
});
</script>