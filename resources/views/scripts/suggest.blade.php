<script type="text/javascript">
var music=0;
var geography=0;
var sport=0;
var histpry=0;
var technology=0;
var popular_culture=0;
var politics=0;
var standard=0;
var image_based;
var audio_based;
var video_based;
var get_question;
var get_time_limit


  $(document).ready(function() {
  
    $("body").on('click','.add-answer','click',function(e) {console.log('i am getting late');
        $(this).before('<div class="form-row multiple__choice__row__in_modal pb-0 mb-2 align-items-center"><div class="col input-group"><input name="multiple__choice__answer__1" class="form-control readonly" type="text" value=""><div  class="input-group-prepend"><span class="input-group-text text-white border-danger bg-danger rounded-right "><i class="far fa-trash-alt"></i></span></div></div><div class="col-2 text-center form-check"><input type="radio" class="readonly" name="multiple__choice__correct__answer"></div></div>');
       
});


$('body').on('click','.multiple__choice__row__in_modal span',function(){
 $(this).closest('.multiple__choice__row__in_modal').remove();
});

$('body').on('click','.suggested_category__icon',function(event){
  
});

/************  category start ***************/
$("#cat1").click(function(e) {
  e.preventDefault();
         music+=1;
      

});

$("#cat2").click(function(e) {
  e.preventDefault();
   sport+=2;
 
});

$("#cat3").click(function(e) {
    e.preventDefault();
    geography+=3;
    
    });

    $("#cat4").click(function(e) {
      e.preventDefault();
         technology+=4;
      
});

$("#cat5").click(function(e) {
   e.preventDefault();
         histpry+=5;
  
});

$("#cat6").click(function(e) {
   e.preventDefault();
         popular_culture+=6;
            
});

$("#cat7").click(function(e) {
         politics+=7;
             console.log('politics'+politics);
             
});

   /****************standard question */

$("#standard-q").click(function(e){
      e.preventDefault();
      //var music_standard;
      var st=0;
      st +=music;
      st+=sport;
      st+=geography;
      st+=histpry;
      st+=technology;
      st+=politics;
      st+=popular_culture;
     
    
      if(st==1 || st==2 || st==3 || st==4 ||st==5 || st==6 || st==7 )
      {

    $.ajax({
        type: "POST",
        url: "/ajax/standard/"+st,
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        data:{
        },
        success: function(results) {
           
           $('#msg'+id).text('updated sucessfully');
           setTimeout(function() {
        $("#msg"+id).text('')
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
               

            $(".all_suggested_questions").append('<li class="single__suggested__question text-body p-3 border rounded mb-4"><div class="single__suggested__question__image position-relative"><img src='+baseUrl+img_url+' class="w-100"><div class="change__image position-absolute px-4 invisible"><label class="d-block m-0 border-0" for="upload__quiz__icon"><i class="fas fa-edit"></i> Change<input type="file" class="form-control-file" id="upload__quiz__icon" value="Upload"> </label></div></div><div class="single__suggested__question__attributes row pt-3"><div class="col-md-3 text-center d-flex align-items-center justify-content-center"><span class="pr-2"><i class="fa fa-clock"></i></span></div><div class="col-md-9 d-flex align-items-center" style="height:48px"><p class="m-0"><span class="pr-2"><small><input id="time-limit'+get_id+'" class="form-control readonly edit__time__limit" readonly type="text" value="'+time_limit+'">s</small></span>Time-limited</p></div><div class="col-2 col-md-3 text-center d-flex align-items-center justify-content-center pt-2"><span class="pr-2"><i class="fas fa-list-ul"></i></span></div><div class="col-10 col-md-9 d-flex align-items-center"><p class="w-50 pr-0 m-0 pt-2"><select class="pr-5 disabled form-control" disabled id="suggested__question__type'+get_id+'"></select></p></div><div class="col-2 col-md-3 text-center d-flex align-items-center justify-content-center pt-2"><span class="pr-2"><i class="far fa-image"></i></span></div><div class="col-10 col-md-9 d-flex align-items-center"><p class="pr-0 w-50 m-0 pt-2"><select class="disabled form-control pr-5" disabled><option>Image based</option><option>Audio based</option><option>Video based</option><option>Standard Q&amp;A</option></select></p></div> </div><div class="single__suggested__question__question pt-4 row"><p class="col-3"><span class="d-inline-block w-25">Question: </span></p> <p class="col-9 the_question"><input type="text" id="question'+get_id+'"class="form-control readonly get-question" readonly value="'+get_que+'"></p></div><div class="single__suggested__question__answer row pb-3"><div class="offset-3 col-9"><div class="form-row" style="min-height:0"><div class="offset-10 col"><small class="form-text text-center d-none correct_answer_heading">Correct:</small></div></div></div><p class="col-3"><span class="d-inline-block w-25 answers__label">Answers: </span></p><div  class="col-9 the_answer"><div  id="ans'+get_id+'" class=" add-answer align-items-center form-row"><div class="col-10 d-none"><a href="#" class="btn btn-primary d-block">Add answer</a></div></div></div></div><div class="single__suggested__question__footer border-top pt-3 d-flex justify-content-center align-items-center"><button id="'+get_id+'" class="btn btn-primary mr-1 add-question" data-dismiss="modal">Add question</button><button id="edit-kopi" class="btn btn-secondary ml-1 edit__question">Edit question</button></div></li>');
              
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
            $("#ans"+get_id).before('<div class="form-row multiple__choice__row__in_modal pb-0 mb-2 align-items-center"><div class="col input-group"><input name="multiple__choice__answer__1" class="form-control readonly" type="text" value="'+get_ans+'"><div  class="input-group-prepend"><span class="input-group-text text-white border-danger bg-danger rounded-right "><i class="far fa-trash-alt"></i></span></div></div><div class="col-2 text-center form-check"><input type="radio" class="readonly" name="multiple__choice__correct__answer"></div></div>');

            }
 
                 
         }
        }


      });
      }

  });

  

$("#image-based-q").click(function(e){
  var img=0;
      img+=music;
      img+=sport;
      img+=geography;
      img+=histpry;
      img+=technology;
      img+=politics;
      img+=popular_culture;
  if(img==1 || img==2 || img==3 || img==4 ||img==5 || img==6 || img==7 ){
            console.log('music image-based hi');
            $.ajax({
        type: "POST",
        url: "/ajax/image/"+img,
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        data:{
        },
        success: function(results) {
           
           $('#msg'+id).text('updated sucessfully');
           setTimeout(function() {
        $("#msg"+id).text('')
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
        
            $(".all_suggested_questions").append('<li class="single__suggested__question text-body p-3 border rounded mb-4"><div class="single__suggested__question__image position-relative"><img src='+baseUrl+img_url+' class="w-100"><div class="change__image position-absolute px-4 invisible"><label class="d-block m-0 border-0" for="upload__quiz__icon"><i class="fas fa-edit"></i> Change<input type="file" class="form-control-file" id="upload__quiz__icon" value="Upload"> </label></div></div><div class="single__suggested__question__attributes row pt-3"><div class="col-md-3 text-center d-flex align-items-center justify-content-center"><span class="pr-2"><i class="fa fa-clock"></i></span></div><div class="col-md-9 d-flex align-items-center" style="height:48px"><p class="m-0"><span class="pr-2"><small><input class="form-control readonly edit__time__limit" readonly type="text" value="'+time_limit+'">s</small></span>Time-limited</p></div><div class="col-2 col-md-3 text-center d-flex align-items-center justify-content-center pt-2"><span class="pr-2"><i class="fas fa-list-ul"></i></span></div><div class="col-10 col-md-9 d-flex align-items-center"><p class="w-50 pr-0 m-0 pt-2"><select class="pr-5 disabled form-control" disabled id="suggested__question__type'+get_id+'"></select></p></div><div class="col-2 col-md-3 text-center d-flex align-items-center justify-content-center pt-2"><span class="pr-2"><i class="far fa-image"></i></span></div><div class="col-10 col-md-9 d-flex align-items-center"><p class="pr-0 w-50 m-0 pt-2"><select class="disabled form-control pr-5" disabled><option>Image based</option><option>Audio based</option><option>Video based</option><option>Standard Q&amp;A</option></select></p></div> </div><div class="single__suggested__question__question pt-4 row"><p class="col-3"><span class="d-inline-block w-25">Question: </span></p> <p class="col-9 the_question"><input type="text" class="form-control readonly" readonly value="'+get_que+'"></p></div><div class="single__suggested__question__answer row pb-3"><div class="offset-3 col-9"><div class="form-row" style="min-height:0"><div class="offset-10 col"><small class="form-text text-center d-none correct_answer_heading">Correct:</small></div></div></div><p class="col-3"><span class="d-inline-block w-25 answers__label">Answers: </span></p><div  class="col-9 the_answer"><div  id="ans'+get_id+'" class=" add-answer align-items-center form-row"><div class="col-10 d-none"><a href="#" class="btn btn-primary d-block">Add answer</a></div></div></div></div><div class="single__suggested__question__footer border-top pt-3 d-flex justify-content-center align-items-center"><button class="btn btn-primary mr-1" data-dismiss="modal">Add question</button><button id="edit-kopi" class="btn btn-secondary ml-1 edit__question">Edit question</button></div></li>');
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

$("#audio-based-q").click(function(e){
  var aud=0;
      aud+=music;
      aud+=sport;
      aud+=geography;
      aud+=histpry;
      aud+=technology;
      aud+=politics;
      aud+=popular_culture;
  if(aud==1 || aud==2 || aud==3 || aud==4 ||aud==5 || aud==6 || aud==7 ){
            $.ajax({
        type: "POST",
        url: "/ajax/audio/"+aud,
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        data:{
        },
        success: function(results) {
           
           $('#msg'+id).text('updated sucessfully');
           setTimeout(function() {
        $("#msg"+id).text('')
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

            $(".all_suggested_questions").append('<li class="single__suggested__question text-body p-3 border rounded mb-4"><div class="single__suggested__question__image position-relative"><img src='+baseUrl+img_url+' class="w-100"><div class="change__image position-absolute px-4 invisible"><label class="d-block m-0 border-0" for="upload__quiz__icon"><i class="fas fa-edit"></i> Change<input type="file" class="form-control-file" id="upload__quiz__icon" value="Upload"> </label></div></div><div class="single__suggested__question__attributes row pt-3"><div class="col-md-3 text-center d-flex align-items-center justify-content-center"><span class="pr-2"><i class="fa fa-clock"></i></span></div><div class="col-md-9 d-flex align-items-center" style="height:48px"><p class="m-0"><span class="pr-2"><small><input class="form-control readonly edit__time__limit" readonly type="text" value="'+time_limit+'">s</small></span>Time-limited</p></div><div class="col-2 col-md-3 text-center d-flex align-items-center justify-content-center pt-2"><span class="pr-2"><i class="fas fa-list-ul"></i></span></div><div class="col-10 col-md-9 d-flex align-items-center"><p class="w-50 pr-0 m-0 pt-2"><select class="pr-5 disabled form-control" disabled id="suggested__question__type'+get_id+'"></select></p></div><div class="col-2 col-md-3 text-center d-flex align-items-center justify-content-center pt-2"><span class="pr-2"><i class="far fa-image"></i></span></div><div class="col-10 col-md-9 d-flex align-items-center"><p class="pr-0 w-50 m-0 pt-2"><select class="disabled form-control pr-5" disabled><option>Image based</option><option>Audio based</option><option>Video based</option><option>Standard Q&amp;A</option></select></p></div> </div><div class="single__suggested__question__question pt-4 row"><p class="col-3"><span class="d-inline-block w-25">Question: </span></p> <p class="col-9 the_question"><input type="text" class="form-control readonly" readonly value="'+get_que+'"></p></div><div class="single__suggested__question__answer row pb-3"><div class="offset-3 col-9"><div class="form-row" style="min-height:0"><div class="offset-10 col"><small class="form-text text-center d-none correct_answer_heading">Correct:</small></div></div></div><p class="col-3"><span class="d-inline-block w-25 answers__label">Answers: </span></p><div  class="col-9 the_answer"><div  id="ans'+get_id+'" class=" add-answer align-items-center form-row"><div class="col-10 d-none"><a href="#" class="btn btn-primary d-block">Add answer</a></div></div></div></div><div class="single__suggested__question__footer border-top pt-3 d-flex justify-content-center align-items-center"><button class="btn btn-primary mr-1" data-dismiss="modal">Add question</button><button id="edit-kopi" class="btn btn-secondary ml-1 edit__question">Edit question</button></div></li>');
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
  var vid=0;
      vid+=music;
      vid+=sport;
      vid+=geography;
      vid+=histpry;
      vid+=technology;
      vid+=politics;
      vid+=popular_culture;
  if(vid==1 || vid==2 || vid==3 || vid==4 ||vid==5 || vid==6 || vid==7 ){
            
            $.ajax({
        type: "POST",
        url: "/ajax/video/"+vid,
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        data:{
        },
        success: function(results) {
           
           $('#msg'+id).text('updated sucessfully');
           setTimeout(function() {
        $("#msg"+id).text('')
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
         
            $(".all_suggested_questions").append('<li class="single__suggested__question text-body p-3 border rounded mb-4"><div class="single__suggested__question__image position-relative"><img src='+baseUrl+img_url+' class="w-100"><div class="change__image position-absolute px-4 invisible"><label class="d-block m-0 border-0" for="upload__quiz__icon"><i class="fas fa-edit"></i> Change<input type="file" class="form-control-file" id="upload__quiz__icon" value="Upload"> </label></div></div><div class="single__suggested__question__attributes row pt-3"><div class="col-md-3 text-center d-flex align-items-center justify-content-center"><span class="pr-2"><i class="fa fa-clock"></i></span></div><div class="col-md-9 d-flex align-items-center" style="height:48px"><p class="m-0"><span class="pr-2"><small><input class="form-control readonly edit__time__limit" readonly type="text" value="'+time_limit+'">s</small></span>Time-limited</p></div><div class="col-2 col-md-3 text-center d-flex align-items-center justify-content-center pt-2"><span class="pr-2"><i class="fas fa-list-ul"></i></span></div><div class="col-10 col-md-9 d-flex align-items-center"><p class="w-50 pr-0 m-0 pt-2"><select class="pr-5 disabled form-control" disabled id="suggested__question__type'+get_id+'"></select></p></div><div class="col-2 col-md-3 text-center d-flex align-items-center justify-content-center pt-2"><span class="pr-2"><i class="far fa-image"></i></span></div><div class="col-10 col-md-9 d-flex align-items-center"><p class="pr-0 w-50 m-0 pt-2"><select class="disabled form-control pr-5" disabled><option>Image based</option><option>Audio based</option><option>Video based</option><option>Standard Q&amp;A</option></select></p></div> </div><div class="single__suggested__question__question pt-4 row"><p class="col-3"><span class="d-inline-block w-25">Question: </span></p> <p class="col-9 the_question"><input type="text" class="form-control readonly" readonly value="'+get_que+'"></p></div><div class="single__suggested__question__answer row pb-3"><div class="offset-3 col-9"><div class="form-row" style="min-height:0"><div class="offset-10 col"><small class="form-text text-center d-none correct_answer_heading">Correct:</small></div></div></div><p class="col-3"><span class="d-inline-block w-25 answers__label">Answers: </span></p><div  class="col-9 the_answer"><div  id="ans'+get_id+'" class=" add-answer align-items-center form-row"><div class="col-10 d-none"><a href="#" class="btn btn-primary d-block">Add answer</a></div></div></div></div><div class="single__suggested__question__footer border-top pt-3 d-flex justify-content-center align-items-center"><button class="btn btn-primary mr-1" data-dismiss="modal">Add question</button><button id="edit-kopi" class="btn btn-secondary ml-1 edit__question">Edit question</button></div></li>');
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

$("body").on('click','.suggested_q_link',function(){
     console.log('use suggested question');
     get_question=$(this).closest('.article').find('.question');
     get_time_limit=$(this).closest('.article').find('.time-limit');
    
  });

$('body').on('click','button.add-question',function(e){   
      console.log(get_question.val());

      var id=e.target.id;
      var question=$("div #question"+id).val();
      var time_limit=$("small #time-limit"+id).val();
      
     
     get_question.val(question);
     get_time_limit.val(time_limit);
     
     $('#question2').val(question); 
     $('#time-limit2').val(time_limit); 


   });


 


  });

</script>
