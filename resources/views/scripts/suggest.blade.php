<script type="text/javascript">
/**categories */
var category;

/**question types */
var standard=0;
var image_based;
var audio_based;
var video_based;

/**get suggested questions*/
var get_question;
var get_time_limit;
var get_answer;
var question_type;
var get_media;
var get_multi_choice_append;
var get_first_multi_choice_append;
var multiple__choice__legend
var multiple__choice__answer
var standard__answer
var numeric__answer



  $(document).ready(function() {
  
    $("body").on('click','.add-answer','click',function(e) {
      var get_id=$(this).closest('.single__suggested__question').find('.add-question').attr('id');
        $(this).before('<div class="form-row multiple__choice__row__in_modal pb-0 mb-2 align-items-center"><div class="col input-group"><input name="multiple__choice__answer__1" class="answer'+get_id+' form-control readonly" type="text" value=""><div  class="input-group-prepend"><span class="input-group-text text-white border-danger bg-danger rounded-right "><i class="far fa-trash-alt"></i></span></div></div><div class="col-2 text-center form-check"><input type="radio" class="readonly" name="multiple__choice__correct__answer"></div></div>');
       
});

   /****************standard question */

$('body').on('click','.multiple__choice__row__in_modal span',function(){
 $(this).closest('.multiple__choice__row__in_modal').remove();
});

$('body').on('click','.suggested_category__icon',function(event){
  
});

/************  category start ***************/
$(".suggested__category").click(function(e) {
          e.preventDefault();
          category=$(this).attr("id");
    });



   /****************standard question */

$("#standard-q").click(function(e){
      e.preventDefault();
      var st=category;

      if(st)
      {

    $.ajax({
        type: "POST",
        url: "/ajax/standard/"+st,
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        data:{
        },
        success: function(results) {
           
           
           setTimeout(function() {
       
    }, 1000);
        },
        error: function(result,error) {
         alert('error');
        
        },
        dataType: 'JSON',
        success: function(data) {
        
          var que=data.msg;
          var ans=data.ans;
          var img=data.img;
    

         for(var i=0,f=0; i<que.length; i++,f++)
         {   
          var get_que=que[i].question;
          var get_id=que[i].id;
          var time_limit=que[i].time_limit;
          var question_type=que[i].question_type;
                if(img[i].length>=1){
          var img_url=img[i][0].public_path;
         
          var baseUrl = "{{ asset('/') }}";
                }
               else{
            img_url="";
               }
               

            $(".all_suggested_questions").append('<li class="single__suggested__question text-body p-3 border rounded mb-4"><div class="single__suggested__question__image position-relative"><img src='+baseUrl+img_url+' id="image'+get_id+'" class="w-100"><div class="change__image position-absolute px-4 invisible"><label class="d-block m-0 border-0" for="upload__quiz__icon"><i class="fas fa-edit"></i> Change<input type="file" class="form-control-file" id="upload__quiz__icon" value="Upload"> </label></div></div><div class="single__suggested__question__attributes row pt-3"><div class="col-md-3 text-center d-flex align-items-center justify-content-center"><span class="pr-2"><i class="fa fa-clock"></i></span></div><div class="col-md-9 d-flex align-items-center" style="height:48px"><p class="m-0"><span class="pr-2"><small><input id="time-limit'+get_id+'" class="form-control readonly edit__time__limit" readonly type="text" value="'+time_limit+'">s</small></span>Time-limited</p></div><div class="col-2 col-md-3 text-center d-flex align-items-center justify-content-center pt-2"><span class="pr-2"><i class="fas fa-list-ul"></i></span></div><div class="col-10 col-md-9 d-flex align-items-center"><p class="w-50 pr-0 m-0 pt-2"><select class="pr-5 disabled form-control" disabled id="suggested__question__type'+get_id+'"></select></p></div><div class="col-2 col-md-3 text-center d-flex align-items-center justify-content-center pt-2"><span class="pr-2"><i class="far fa-image"></i></span></div><div class="col-10 col-md-9 d-flex align-items-center"><p class="pr-0 w-50 m-0 pt-2"><select class="disabled form-control pr-5" disabled><option>Image based</option><option>Audio based</option><option>Video based</option><option>Standard Q&amp;A</option></select></p></div> </div><div class="single__suggested__question__question pt-4 row"><p class="col-3"><span class="d-inline-block w-25">Question: </span></p> <p class="col-9 the_question"><input type="text" id="question'+get_id+'" class="form-control readonly get-question" readonly value="'+get_que+'"></p></div><div class="single__suggested__question__answer row pb-3"><div class="offset-3 col-9"><div class="form-row" style="min-height:0"><div class="offset-10 col"><small class="form-text text-center d-none correct_answer_heading">Correct:</small></div></div></div><p class="col-3"><span class="d-inline-block w-25 answers__label">Answers: </span></p><div  class="col-9 the_answer"><div  id="ans'+get_id+'" class=" add-answer align-items-center form-row"><div class="col-10 d-none"><a href="#" class="btn btn-primary d-block">Add answer</a></div></div></div></div><div class="single__suggested__question__footer border-top pt-3 d-flex justify-content-center align-items-center"><button id="'+get_id+'" class="btn btn-primary mr-1 add-question" data-dismiss="modal">Add question</button><button id="edit-kopi" class="btn btn-secondary ml-1 edit__question">Edit question</button></div></li>');
              
            if(question_type == 'standard'){
            $("#suggested__question__type"+get_id).append('<option value="text">Text</option><option value="multiple" >Multiple choice</option><option value="numeric">Numeric</option>')
               }

               else if(question_type == 'multiple-choice'){
            $("#suggested__question__type"+get_id).append('<option value="multiple">Multiple choice</option><option value="text" >Text</option><option value="numeric">Numeric</option>')
               }

               else if(question_type == 'numeric'){
            $("#suggested__question__type"+get_id).append('<option value="numeric">Numeric</option><option value="multiple">Multiple choice</option><option value="text" >Text</option>')
               }

            for(var j=0; j<ans[f].length; j++)
            {   
              var get_ans=ans[f][j].answer;
            $("#ans"+get_id).before('<div class="form-row multiple__choice__row__in_modal pb-0 mb-2 align-items-center"><div class="col input-group"><input name="multiple__choice__answer__1" id="answer'+get_id+'"class="form-control readonly" type="text" value="'+get_ans+'"><div  class="input-group-prepend"><span class="input-group-text text-white border-danger bg-danger rounded-right "><i class="far fa-trash-alt"></i></span></div></div><div class="col-2 text-center form-check"><input type="radio" class="readonly" name="multiple__choice__correct__answer"></div></div>');

            }
 
                 
         }
        }


      });
      }

  });

  

$("#image-based-q").click(function(e){
  var img=category;
     

  if(img){
         
            $.ajax({
        type: "POST",
        url: "/ajax/image/"+img,
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        data:{
        },
        success: function(results) {
           
          
           setTimeout(function() {
       
    }, 1000);
        },
        error: function(result,error) {
         alert('error');
        
        },
        dataType: 'JSON',
        success: function(data) {
        
    
          var que=data.msg;
          var ans=data.ans;
          var img=data.img;
    
         
         for(var i=0,f=0; i<que.length; i++,f++ ){ 
          var get_que=que[i].question;
          var get_id=que[i].id;
          var time_limit=que[i].time_limit;
          var question_type=que[i].question_type;

          if(img[i].length>=1){
          var img_url=img[i][0].public_path;
          var baseUrl = "{{ asset('/') }}";
        
            $(".all_suggested_questions").append('<li class="single__suggested__question text-body p-3 border rounded mb-4"><div class="single__suggested__question__image position-relative"><img src='+baseUrl+img_url+' id="image'+get_id+'" class="w-100"><div class="change__image position-absolute px-4 invisible"><label class="d-block m-0 border-0" for="upload__quiz__icon"><i class="fas fa-edit"></i> Change<input type="file" class="form-control-file" id="upload__quiz__icon" value="Upload"> </label></div></div><div class="single__suggested__question__attributes row pt-3"><div class="col-md-3 text-center d-flex align-items-center justify-content-center"><span class="pr-2"><i class="fa fa-clock"></i></span></div><div class="col-md-9 d-flex align-items-center" style="height:48px"><p class="m-0"><span class="pr-2"><small><input id="time-limit'+get_id+'" class="form-control readonly edit__time__limit" readonly type="text" value="'+time_limit+'">s</small></span>Time-limited</p></div><div class="col-2 col-md-3 text-center d-flex align-items-center justify-content-center pt-2"><span class="pr-2"><i class="fas fa-list-ul"></i></span></div><div class="col-10 col-md-9 d-flex align-items-center"><p class="w-50 pr-0 m-0 pt-2"><select class="pr-5 disabled form-control" disabled id="suggested__question__type'+get_id+'"></select></p></div><div class="col-2 col-md-3 text-center d-flex align-items-center justify-content-center pt-2"><span class="pr-2"><i class="far fa-image"></i></span></div><div class="col-10 col-md-9 d-flex align-items-center"><p class="pr-0 w-50 m-0 pt-2"><select class="disabled form-control pr-5" disabled><option>Image based</option><option>Audio based</option><option>Video based</option><option>Standard Q&amp;A</option></select></p></div> </div><div class="single__suggested__question__question pt-4 row"><p class="col-3"><span class="d-inline-block w-25">Question: </span></p> <p class="col-9 the_question"><input type="text" id="question'+get_id+'" class="form-control readonly" readonly value="'+get_que+'"></p></div><div class="single__suggested__question__answer row pb-3"><div class="offset-3 col-9"><div class="form-row" style="min-height:0"><div class="offset-10 col"><small class="form-text text-center d-none correct_answer_heading">Correct:</small></div></div></div><p class="col-3"><span class="d-inline-block w-25 answers__label">Answers: </span></p><div  class="col-9 the_answer"><div  id="ans'+get_id+'" class=" add-answer align-items-center form-row"><div class="col-10 d-none"><a href="#" class="btn btn-primary d-block">Add answer</a></div></div></div></div><div class="single__suggested__question__footer border-top pt-3 d-flex justify-content-center align-items-center"><button id="'+get_id+'" class="btn btn-primary mr-1 add-question" data-dismiss="modal">Add question</button><button  class="btn btn-secondary ml-1 edit__question">Edit question</button></div></li>');
            if(question_type == 'standard'){
            $("#suggested__question__type"+get_id).append('<option value="text">Text</option><option value="multiple" >Multiple choice</option><option value="numeric">Numeric</option>')
               }

               else if(question_type == 'multiple-choice'){
            $("#suggested__question__type"+get_id).append('<option value="multiple">Multiple choice</option><option value="text" >Text</option><option value="numeric">Numeric</option>')
               }

               else if(question_type == 'numeric'){
            $("#suggested__question__type"+get_id).append('<option value="numeric">Numeric</option><option value="multiple">Multiple choice</option><option value="text" >Text</option>')
               }
            
            for(var j=0; j<ans[f].length; j++){
              var get_ans=ans[f][j].answer;
          
            $("#ans"+get_id).before('<div class="form-row multiple__choice__row__in_modal pb-0 mb-2 align-items-center"><div class="col input-group"><input name="multiple__choice__answer__1" id="answer'+get_id+'" class="answer'+get_id+' form-control readonly" type="text" value="'+get_ans+'"><div  class="input-group-prepend"><span class="input-group-text text-white border-danger bg-danger rounded-right "><i class="far fa-trash-alt"></i></span></div></div><div class="col-2 text-center form-check"><input type="radio" class="readonly" name="multiple__choice__correct__answer"></div></div>');

            }
          }
                 
         }
          
        }


      });
      }
      
});

$("#audio-based-q").click(function(e){
  var aud=category;
   

  if(aud){
            $.ajax({
        type: "POST",
        url: "/ajax/audio/"+aud,
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        data:{
        },
        success: function(results) {
           
         
           setTimeout(function() {
       
    }, 1000);
        },
        error: function(result,error) {
         alert('error');
        
        },
        dataType: 'JSON',
        success: function(data) {
        
          var que=data.msg;
          var ans=data.ans;
          var img=data.img;
       

         for(var i=0,f=0; i<que.length; i++,f++ ){ 
          var get_que=que[i].question;
          var get_id=que[i].id;
          var time_limit=que[i].time_limit;
          var question_type=que[i].question_type;

          if(img[i].length>=1){
          var img_url=img[i][0].public_path;
          var baseUrl = "{{ asset('/') }}";

            $(".all_suggested_questions").append('<li class="single__suggested__question text-body p-3 border rounded mb-4"><div class="single__suggested__question__image position-relative"><img id="image'+get_id+'" src='+baseUrl+img_url+' class="w-100"><div class="change__image position-absolute px-4 invisible"><label class="d-block m-0 border-0" for="upload__quiz__icon"><i class="fas fa-edit"></i> Change<input type="file" class="form-control-file" id="upload__quiz__icon" value="Upload"> </label></div></div><div class="single__suggested__question__attributes row pt-3"><div class="col-md-3 text-center d-flex align-items-center justify-content-center"><span class="pr-2"><i class="fa fa-clock"></i></span></div><div class="col-md-9 d-flex align-items-center" style="height:48px"><p class="m-0"><span class="pr-2"><small><input id="time-limit'+get_id+'" class="form-control readonly edit__time__limit" readonly type="text" value="'+time_limit+'">s</small></span>Time-limited</p></div><div class="col-2 col-md-3 text-center d-flex align-items-center justify-content-center pt-2"><span class="pr-2"><i class="fas fa-list-ul"></i></span></div><div class="col-10 col-md-9 d-flex align-items-center"><p class="w-50 pr-0 m-0 pt-2"><select class="pr-5 disabled form-control" disabled id="suggested__question__type'+get_id+'"></select></p></div><div class="col-2 col-md-3 text-center d-flex align-items-center justify-content-center pt-2"><span class="pr-2"><i class="far fa-image"></i></span></div><div class="col-10 col-md-9 d-flex align-items-center"><p class="pr-0 w-50 m-0 pt-2"><select class="disabled form-control pr-5" disabled><option>Image based</option><option>Audio based</option><option>Video based</option><option>Standard Q&amp;A</option></select></p></div> </div><div class="single__suggested__question__question pt-4 row"><p class="col-3"><span class="d-inline-block w-25">Question: </span></p> <p class="col-9 the_question"><input type="text" id="question'+get_id+'" class="form-control readonly" readonly value="'+get_que+'"></p></div><div class="single__suggested__question__answer row pb-3"><div class="offset-3 col-9"><div class="form-row" style="min-height:0"><div class="offset-10 col"><small class="form-text text-center d-none correct_answer_heading">Correct:</small></div></div></div><p class="col-3"><span class="d-inline-block w-25 answers__label">Answers: </span></p><div  class="col-9 the_answer"><div  id="ans'+get_id+'" class=" add-answer align-items-center form-row"><div class="col-10 d-none"><a href="#" class="btn btn-primary d-block">Add answer</a></div></div></div></div><div class="single__suggested__question__footer border-top pt-3 d-flex justify-content-center align-items-center"><button id="'+get_id+'" class="btn btn-primary mr-1 add-question" data-dismiss="modal">Add question</button><button class="btn btn-secondary ml-1 edit__question">Edit question</button></div></li>');
            if(question_type == 'standard'){
            $("#suggested__question__type"+get_id).append('<option value="text">Text</option><option value="multiple" >Multiple choice</option><option value="numeric">Numeric</option>')
               }

               else if(question_type == 'multiple-choice'){
            $("#suggested__question__type"+get_id).append('<option value="multiple">Multiple choice</option><option value="text" >Text</option><option value="numeric">Numeric</option>')
               }

               else if(question_type == 'numeric'){
            $("#suggested__question__type"+get_id).append('<option value="numeric">Numeric</option><option value="multiple">Multiple choice</option><option value="text" >Text</option>')
               }
           
            for(var j=0; j<ans[f].length; j++){
              var get_ans=ans[f][j].answer;
        
            $("#ans"+get_id).before('<div class="form-row multiple__choice__row__in_modal pb-0 mb-2 align-items-center"><div class="col input-group"><input name="multiple__choice__answer__1" class="form-control readonly" type="text" value="'+get_ans+'"><div  class="input-group-prepend"><span class="input-group-text text-white border-danger bg-danger rounded-right "><i class="far fa-trash-alt"></i></span></div></div><div class="col-2 text-center form-check"><input type="radio" class="readonly" name="multiple__choice__correct__answer"></div></div>');

            }
 
          }

         }
        }


      });
      }
});

$("#video-based-q").click(function(e){
  var vid=category;
  

  if(vid){
            
            $.ajax({
        type: "POST",
        url: "/ajax/video/"+vid,
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        data:{
        },
        success: function(results) {
           
           
           setTimeout(function() {
        
    }, 1000);
        },
        error: function(result,error) {
         alert('error');
        
        },
        dataType: 'JSON',
        success: function(data) {
           
          var que=data.msg;
          var ans=data.ans;
          var img=data.img;
          

         for(var i=0,f=0; i<que.length; i++,f++ ){ 
          var get_que=que[i].question;
          var get_id=que[i].id;
          var time_limit=que[i].time_limit;
          var question_type=que[i].question_type;
          
          if(img[i].length>=1){
          var img_url=img[i][0].public_path;
          var baseUrl = "{{ asset('/') }}";
         
            $(".all_suggested_questions").append('<li class="single__suggested__question text-body p-3 border rounded mb-4"><div class="single__suggested__question__image position-relative"><img src='+baseUrl+img_url+' id="image'+get_id+'" class="w-100"><div class="change__image position-absolute px-4 invisible"><label class="d-block m-0 border-0" for="upload__quiz__icon"><i class="fas fa-edit"></i> Change<input type="file" class="form-control-file" id="upload__quiz__icon" value="Upload"> </label></div></div><div class="single__suggested__question__attributes row pt-3"><div class="col-md-3 text-center d-flex align-items-center justify-content-center"><span class="pr-2"><i class="fa fa-clock"></i></span></div><div class="col-md-9 d-flex align-items-center" style="height:48px"><p class="m-0"><span class="pr-2"><small><input id="time-limit'+get_id+'" class="form-control readonly edit__time__limit" readonly type="text" value="'+time_limit+'">s</small></span>Time-limited</p></div><div class="col-2 col-md-3 text-center d-flex align-items-center justify-content-center pt-2"><span class="pr-2"><i class="fas fa-list-ul"></i></span></div><div class="col-10 col-md-9 d-flex align-items-center"><p class="w-50 pr-0 m-0 pt-2"><select class="pr-5 disabled form-control" disabled id="suggested__question__type'+get_id+'"></select></p></div><div class="col-2 col-md-3 text-center d-flex align-items-center justify-content-center pt-2"><span class="pr-2"><i class="far fa-image"></i></span></div><div class="col-10 col-md-9 d-flex align-items-center"><p class="pr-0 w-50 m-0 pt-2"><select class="disabled form-control pr-5" disabled><option>Image based</option><option>Audio based</option><option>Video based</option><option>Standard Q&amp;A</option></select></p></div> </div><div class="single__suggested__question__question pt-4 row"><p class="col-3"><span class="d-inline-block w-25">Question: </span></p> <p class="col-9 the_question"><input type="text" id="question'+get_id+'" class="form-control readonly" readonly value="'+get_que+'"></p></div><div class="single__suggested__question__answer row pb-3"><div class="offset-3 col-9"><div class="form-row" style="min-height:0"><div class="offset-10 col"><small class="form-text text-center d-none correct_answer_heading">Correct:</small></div></div></div><p class="col-3"><span class="d-inline-block w-25 answers__label">Answers: </span></p><div  class="col-9 the_answer"><div  id="ans'+get_id+'" class=" add-answer align-items-center form-row"><div class="col-10 d-none"><a href="#" class="btn btn-primary d-block">Add answer</a></div></div></div></div><div class="single__suggested__question__footer border-top pt-3 d-flex justify-content-center align-items-center"><button id="'+get_id+'" class="btn btn-primary mr-1 add-question" data-dismiss="modal">Add question</button><button class="btn btn-secondary ml-1 edit__question">Edit question</button></div></li>');
            if(question_type == 'standard'){
            $("#suggested__question__type"+get_id).append('<option value="text">Text</option><option value="multiple" >Multiple choice</option><option value="numeric">Numeric</option>')
               }

               else if(question_type == 'multiple-choice'){
            $("#suggested__question__type"+get_id).append('<option value="multiple">Multiple choice</option><option value="text" >Text</option><option value="numeric">Numeric</option>')
               }

               else if(question_type == 'numeric'){
            $("#suggested__question__type"+get_id).append('<option value="numeric">Numeric</option><option value="multiple">Multiple choice</option><option value="text" >Text</option>')
               }

            for(var j=0; j<ans[f].length; j++){
              var get_ans=ans[f][j].answer;
           
            $("#ans"+get_id).before('<div class="form-row multiple__choice__row__in_modal pb-0 mb-2 align-items-center"><div class="col input-group"><input name="multiple__choice__answer__1" class="form-control readonly" type="text" value="'+get_ans+'"><div  class="input-group-prepend"><span class="input-group-text text-white border-danger bg-danger rounded-right "><i class="far fa-trash-alt"></i></span></div></div><div class="col-2 text-center form-check"><input type="radio" class="readonly" name="multiple__choice__correct__answer"></div></div>');

            }
 
          }   
         }
        }


      });
      }
});

// add question 

//when click suggested link button ,store current question blade details 

$("body").on('click','.suggested_q_link',function(){
     get_question=$(this).closest('.article').find('.question');
     get_time_limit=$(this).closest('.article').find('.time-limit');
     get_answer=$(this).closest('.article').find('.answer');
     get_question_type=$(this).closest('.article').find('.question-type');
     get_multi_choice_append=$(this).closest('.article').find('.multi-choice');
     get_first_multi_choice_append=$(this).closest('.article').find('.first-multi-answer');
     multiple__choice__legend=$(this).closest('.article').find('.multiple__choice__legend');
     multiple__choice__answer=$(this).closest('.article').find('.multiple__choice__answer');
     standard__answer=$(this).closest('.article').find('.standard__answer');
     numeric__answer=$(this).closest('.article').find('.numeric__answer');
     hidden_media_image=$(this).closest('.article').find('.hidden-media-image');
  });
 // when click add-question button get all data from specific suggested question
$('body').on('click','button.add-question',function(e){   
    
      var id=e.target.id;
      var question=$("div #question"+id).val();
      var time_limit=$("small #time-limit"+id).val();
      var answer=$("#answer"+id).val();
      var question_type=$('#suggested__question__type'+id).val();

      /**get image name */
      var get_image_src=$("#image"+id).attr("src");
      // var reverse_image_file=get_image_src.split("").reverse().join("")
      // var split_image=reverse_image_file.split("/",1);
      // var convert_string_image=""+split_image+"";
      // var get_image_name=convert_string_image.split("").reverse().join("");
      console.log('hidden value '+ hidden_media_image.val());


     get_question.val(question);
     get_time_limit.val(time_limit);
     get_answer.val(answer);
     get_question_type.val(question_type);

      
     /**finding input field of answer**/
     var values = [];
     $('.answer'+id).each(function(){
      values.push({ value: this.value });
         
         
            });
           
            if(values.length>1){
               standard__answer.removeClass('d-flex').addClass('d-none');
               multiple__choice__legend.addClass('d-flex').removeClass('d-none');
               multiple__choice__answer.addClass('d-flex').removeClass('d-none');
               numeric__answer.removeClass('d-flex').addClass('d-none');  

               get_first_multi_choice_append.val(values[0].value);
            }
            for(var i=1; i<values.length; i++){
                 var value=values[i].value;
               var newRow ='<div class="row multiple__choice__row pb-3 align-items-center"><div class="col-7"><input name="multiple__choice__answer__1[]" class="form-control" type="text" value="'+value+'"></div><div class="col-1 justify-content-center p-0 d-flex"><span class="minus">-</span></div><div class="col-1 justify-content-center"><span class="plus">+</span></div><div class="col-3 text-center form-check"><input type="radio" id="rdd" name="multiple__choice__correct__answer" value="'+i+'"></div></div>';
               get_multi_choice_append.append(newRow);
              
            }
          
          
         // var newRow ='<div class="form-row multiple__choice__row__in_modal pb-0 mb-2 align-items-center"><div class="col-7"><input name="multiple__choice__answer__1[]" class="readonly form-control" type="text"></div><div class="col-1 justify-content-center tempVis"><span class="minus">-</span></div><div class="col-1 justify-content-center tempVis"><span class="plus">+</span></div><div class="col-3 text-center form-check hidd"><input type="radio" class="" name="multiple__choice__correct__answer"></div></div>';
         /// button.closest('.multiple__choice__row__in_modal').after(newRow);

   });
   
   
   // $("#suggestedQuestion").on("hidden.bs.modal", function () {
   //    console.log('i am closed');
   //    $(this).find(".all_suggested_questions").empty();
   //  $(this).removeData('bs.modal');
     
	// });
  
//    $(document).on('hidden.bs.modal', '.modal', function (e) {
//     $(this).find(".all_suggested_questions").empty();
//     $(this).removeData('bs.modal');
// });
  
$("#img-save").click(function(){
   //var save=$("#upload__media__file").attributes.value.textContent;
   var save= document.getElementById("upload__media__file").value.split("\\");
   console.log("input-value"+ save);
});



});

</script>
