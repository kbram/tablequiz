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
         technology+=4;
             console.log('category one'+music);
             sessionStorage.SessionName;
             sessionStorage.count;
             sessionStorage.count = Number(sessionStorage.count)+5;
            // sessionStorage.count=sessionStorage.count+5;
             //sessionStorage.setItem("count",10+pl);
               console.log(sessionStorage.getItem("SessionName")); 
               console.log(sessionStorage.getItem("count")); 
          //  console.log('i am new'+$(this).find("p span").text());
});

$("#cat5").click(function(e) {
         histpry+=5;
             console.log('category one'+music);
             sessionStorage.SessionName;
             sessionStorage.count;
             sessionStorage.count = Number(sessionStorage.count)+5;
            // sessionStorage.count=sessionStorage.count+5;
             //sessionStorage.setItem("count",10+pl);
               console.log(sessionStorage.getItem("SessionName")); 
               console.log(sessionStorage.getItem("count")); 
          //  console.log('i am new'+$(this).find("p span").text());
});

$("#cat6").click(function(e) {
         popular_culture+=6;
             console.log('category one'+music);
             sessionStorage.SessionName;
             sessionStorage.count;
             sessionStorage.count = Number(sessionStorage.count)+5;
            // sessionStorage.count=sessionStorage.count+5;
             //sessionStorage.setItem("count",10+pl);
               console.log(sessionStorage.getItem("SessionName")); 
               console.log(sessionStorage.getItem("count")); 
          //  console.log('i am new'+$(this).find("p span").text());
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

           
          var img_url=img[i][0].public_path;
          var baseUrl = "{{ asset('/') }}";
                
               

            $(".all_suggested_questions").append('<li class="single__suggested__question text-body p-3 border rounded mb-4"><div class="single__suggested__question__image position-relative"><img src='+baseUrl+img_url+' class="w-100"><div class="change__image position-absolute px-4 invisible"><label class="d-block m-0 border-0" for="upload__quiz__icon"><i class="fas fa-edit"></i> Change<input type="file" class="form-control-file" id="upload__quiz__icon" value="Upload"> </label></div></div><div class="single__suggested__question__attributes row pt-3"><div class="col-md-3 text-center d-flex align-items-center justify-content-center"><span class="pr-2"><i class="fa fa-clock"></i></span></div><div class="col-md-9 d-flex align-items-center" style="height:48px"><p class="m-0"><span class="pr-2"><small><input class="form-control readonly edit__time__limit" readonly type="text" value="15">s</small></span>Time-limited</p></div><div class="col-2 col-md-3 text-center d-flex align-items-center justify-content-center pt-2"><span class="pr-2"><i class="fas fa-list-ul"></i></span></div><div class="col-10 col-md-9 d-flex align-items-center"><p class="w-50 pr-0 m-0 pt-2"><select class="pr-5 disabled form-control" disabled id="suggested__question__type"><option value="multiple">Multiple choice</option><option value="text">Text</option><option value="numeric">Numeric</option></select></p></div><div class="col-2 col-md-3 text-center d-flex align-items-center justify-content-center pt-2"><span class="pr-2"><i class="far fa-image"></i></span></div><div class="col-10 col-md-9 d-flex align-items-center"><p class="pr-0 w-50 m-0 pt-2"><select class="disabled form-control pr-5" disabled><option>Image based</option><option>Audio based</option><option>Video based</option><option>Standard Q&amp;A</option></select></p></div> </div><div class="single__suggested__question__question pt-4 row"><p class="col-3"><span class="d-inline-block w-25">Question: </span></p> <p class="col-9 the_question"><input type="text" class="form-control readonly" readonly value="'+get_que+'"></p></div><div class="single__suggested__question__answer row pb-3"><div class="offset-3 col-9"><div class="form-row" style="min-height:0"><div class="offset-10 col"><small class="form-text text-center d-none correct_answer_heading">Correct:</small></div></div></div><p class="col-3"><span class="d-inline-block w-25 answers__label">Answers: </span></p><div  class="col-9 the_answer"><div  id="ans'+get_id+'" class=" add-answer align-items-center form-row"><div class="col-10 d-none"><a href="#" class="btn btn-primary d-block">Add answer</a></div></div></div></div><div class="single__suggested__question__footer border-top pt-3 d-flex justify-content-center align-items-center"><button class="btn btn-primary mr-1" data-dismiss="modal">Add question</button><button id="edit-kopi" class="btn btn-secondary ml-1 edit__question">Edit question</button></div></li>');
           
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
        
          console.log(data); // this is good
          console.log(data.status); // this is good
          var que=data.msg;
          var ans=data.ans;
          console.log(que[0].question);
          console.log('lenght'+que.length);
          console.log('lenght'+ans.length);
        var question='<li class="single__suggested__question text-body p-3 border rounded mb-4"><div class="single__suggested__question__image position-relative"><img src="../images/moscow__image.jpeg" class="w-100"><div class="change__image position-absolute px-4 invisible"><label class="d-block m-0 border-0" for="upload__quiz__icon"><i class="fas fa-edit"></i> Change<input type="file" class="form-control-file" id="upload__quiz__icon" value="Upload"> </label></div></div><div class="single__suggested__question__attributes row pt-3"><div class="col-md-3 text-center d-flex align-items-center justify-content-center"><span class="pr-2"><i class="fa fa-clock"></i></span></div><div class="col-md-9 d-flex align-items-center" style="height:48px"><p class="m-0"><span class="pr-2"><small><input class="form-control readonly edit__time__limit" readonly type="text" value="15">s</small></span>Time-limited</p></div><div class="col-2 col-md-3 text-center d-flex align-items-center justify-content-center pt-2"><span class="pr-2"><i class="fas fa-list-ul"></i></span></div><div class="col-10 col-md-9 d-flex align-items-center"><p class="w-50 pr-0 m-0 pt-2"><select class="pr-5 disabled form-control" disabled id="suggested__question__type"><option value="multiple">Multiple choice</option><option value="text">Text</option><option value="numeric">Numeric</option></select></p></div><div class="col-2 col-md-3 text-center d-flex align-items-center justify-content-center pt-2"><span class="pr-2"><i class="far fa-image"></i></span></div><div class="col-10 col-md-9 d-flex align-items-center"><p class="pr-0 w-50 m-0 pt-2"><select class="disabled form-control pr-5" disabled><option>Image based</option><option>Audio based</option><option>Video based</option><option>Standard Q&amp;A</option></select></p></div> </div><div class="single__suggested__question__question pt-4 row"><p class="col-3"><span class="d-inline-block w-25">Question: </span></p> <p class="col-9 the_question"><input type="text" class="form-control readonly" readonly value=""></p></div><div class="single__suggested__question__answer row pb-3"><div class="offset-3 col-9"><div class="form-row" style="min-height:0"><div class="offset-10 col"><small class="form-text text-center d-none correct_answer_heading">Correct:</small></div></div></div><p class="col-3"><span class="d-inline-block w-25 answers__label">Answers: </span></p><div  class="col-9 the_answer"><div  class=" add-answer align-items-center form-row"><div class="col-10 d-none"><a href="#" class="btn btn-primary d-block">Add answer</a></div></div></div></div><div class="single__suggested__question__footer border-top pt-3 d-flex justify-content-center align-items-center"><button class="btn btn-primary mr-1" data-dismiss="modal">Add question</button><button id="edit-kopi" class="btn btn-secondary ml-1 edit__question">Edit question</button></div></li>';

         for(var i=0; i<que.length; i++ ){ console.log('question');
          var get_que=que[i].question;
          var get_id=que[i].id;
          console.log('get id '+get_id);
            $(".all_suggested_questions").append('<li class="single__suggested__question text-body p-3 border rounded mb-4"><div class="single__suggested__question__image position-relative"><img src="../images/moscow__image.jpeg" class="w-100"><div class="change__image position-absolute px-4 invisible"><label class="d-block m-0 border-0" for="upload__quiz__icon"><i class="fas fa-edit"></i> Change<input type="file" class="form-control-file" id="upload__quiz__icon" value="Upload"> </label></div></div><div class="single__suggested__question__attributes row pt-3"><div class="col-md-3 text-center d-flex align-items-center justify-content-center"><span class="pr-2"><i class="fa fa-clock"></i></span></div><div class="col-md-9 d-flex align-items-center" style="height:48px"><p class="m-0"><span class="pr-2"><small><input class="form-control readonly edit__time__limit" readonly type="text" value="15">s</small></span>Time-limited</p></div><div class="col-2 col-md-3 text-center d-flex align-items-center justify-content-center pt-2"><span class="pr-2"><i class="fas fa-list-ul"></i></span></div><div class="col-10 col-md-9 d-flex align-items-center"><p class="w-50 pr-0 m-0 pt-2"><select class="pr-5 disabled form-control" disabled id="suggested__question__type"><option value="multiple">Multiple choice</option><option value="text">Text</option><option value="numeric">Numeric</option></select></p></div><div class="col-2 col-md-3 text-center d-flex align-items-center justify-content-center pt-2"><span class="pr-2"><i class="far fa-image"></i></span></div><div class="col-10 col-md-9 d-flex align-items-center"><p class="pr-0 w-50 m-0 pt-2"><select class="disabled form-control pr-5" disabled><option>Image based</option><option>Audio based</option><option>Video based</option><option>Standard Q&amp;A</option></select></p></div> </div><div class="single__suggested__question__question pt-4 row"><p class="col-3"><span class="d-inline-block w-25">Question: </span></p> <p class="col-9 the_question"><input type="text" class="form-control readonly" readonly value="'+get_que+'"></p></div><div class="single__suggested__question__answer row pb-3"><div class="offset-3 col-9"><div class="form-row" style="min-height:0"><div class="offset-10 col"><small class="form-text text-center d-none correct_answer_heading">Correct:</small></div></div></div><p class="col-3"><span class="d-inline-block w-25 answers__label">Answers: </span></p><div  class="col-9 the_answer"><div  id="ans'+get_id+'" class=" add-answer align-items-center form-row"><div class="col-10 d-none"><a href="#" class="btn btn-primary d-block">Add answer</a></div></div></div></div><div class="single__suggested__question__footer border-top pt-3 d-flex justify-content-center align-items-center"><button class="btn btn-primary mr-1" data-dismiss="modal">Add question</button><button id="edit-kopi" class="btn btn-secondary ml-1 edit__question">Edit question</button></div></li>');
            for(var j=0; j<ans.length; j++){
              var get_ans=ans[j].answer;
              console.log('answer');
        
            $("#ans"+get_id).before('<div class="form-row multiple__choice__row__in_modal pb-0 mb-2 align-items-center"><div class="col input-group"><input name="multiple__choice__answer__1" class="form-control readonly" type="text" value="'+get_ans+'"><div  class="input-group-prepend"><span class="input-group-text text-white border-danger bg-danger rounded-right "><i class="far fa-trash-alt"></i></span></div></div><div class="col-2 text-center form-check"><input type="radio" class="readonly" name="multiple__choice__correct__answer"></div></div>');

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
            console.log('music audio hi');
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
        
          console.log(data); // this is good
          console.log(data.status); // this is good
          var que=data.msg;
          var ans=data.ans;
          console.log(que[0].question);
          console.log('lenght'+que.length);
          console.log('lenght'+ans.length);
        var question='<li class="single__suggested__question text-body p-3 border rounded mb-4"><div class="single__suggested__question__image position-relative"><img src="../images/moscow__image.jpeg" class="w-100"><div class="change__image position-absolute px-4 invisible"><label class="d-block m-0 border-0" for="upload__quiz__icon"><i class="fas fa-edit"></i> Change<input type="file" class="form-control-file" id="upload__quiz__icon" value="Upload"> </label></div></div><div class="single__suggested__question__attributes row pt-3"><div class="col-md-3 text-center d-flex align-items-center justify-content-center"><span class="pr-2"><i class="fa fa-clock"></i></span></div><div class="col-md-9 d-flex align-items-center" style="height:48px"><p class="m-0"><span class="pr-2"><small><input class="form-control readonly edit__time__limit" readonly type="text" value="15">s</small></span>Time-limited</p></div><div class="col-2 col-md-3 text-center d-flex align-items-center justify-content-center pt-2"><span class="pr-2"><i class="fas fa-list-ul"></i></span></div><div class="col-10 col-md-9 d-flex align-items-center"><p class="w-50 pr-0 m-0 pt-2"><select class="pr-5 disabled form-control" disabled id="suggested__question__type"><option value="multiple">Multiple choice</option><option value="text">Text</option><option value="numeric">Numeric</option></select></p></div><div class="col-2 col-md-3 text-center d-flex align-items-center justify-content-center pt-2"><span class="pr-2"><i class="far fa-image"></i></span></div><div class="col-10 col-md-9 d-flex align-items-center"><p class="pr-0 w-50 m-0 pt-2"><select class="disabled form-control pr-5" disabled><option>Image based</option><option>Audio based</option><option>Video based</option><option>Standard Q&amp;A</option></select></p></div> </div><div class="single__suggested__question__question pt-4 row"><p class="col-3"><span class="d-inline-block w-25">Question: </span></p> <p class="col-9 the_question"><input type="text" class="form-control readonly" readonly value=""></p></div><div class="single__suggested__question__answer row pb-3"><div class="offset-3 col-9"><div class="form-row" style="min-height:0"><div class="offset-10 col"><small class="form-text text-center d-none correct_answer_heading">Correct:</small></div></div></div><p class="col-3"><span class="d-inline-block w-25 answers__label">Answers: </span></p><div  class="col-9 the_answer"><div  class=" add-answer align-items-center form-row"><div class="col-10 d-none"><a href="#" class="btn btn-primary d-block">Add answer</a></div></div></div></div><div class="single__suggested__question__footer border-top pt-3 d-flex justify-content-center align-items-center"><button class="btn btn-primary mr-1" data-dismiss="modal">Add question</button><button id="edit-kopi" class="btn btn-secondary ml-1 edit__question">Edit question</button></div></li>';

         for(var i=0; i<que.length; i++ ){ console.log('question');
          var get_que=que[i].question;
          var get_id=que[i].id;
          console.log('get id '+get_id);
            $(".all_suggested_questions").append('<li class="single__suggested__question text-body p-3 border rounded mb-4"><div class="single__suggested__question__image position-relative"><img src="../images/moscow__image.jpeg" class="w-100"><div class="change__image position-absolute px-4 invisible"><label class="d-block m-0 border-0" for="upload__quiz__icon"><i class="fas fa-edit"></i> Change<input type="file" class="form-control-file" id="upload__quiz__icon" value="Upload"> </label></div></div><div class="single__suggested__question__attributes row pt-3"><div class="col-md-3 text-center d-flex align-items-center justify-content-center"><span class="pr-2"><i class="fa fa-clock"></i></span></div><div class="col-md-9 d-flex align-items-center" style="height:48px"><p class="m-0"><span class="pr-2"><small><input class="form-control readonly edit__time__limit" readonly type="text" value="15">s</small></span>Time-limited</p></div><div class="col-2 col-md-3 text-center d-flex align-items-center justify-content-center pt-2"><span class="pr-2"><i class="fas fa-list-ul"></i></span></div><div class="col-10 col-md-9 d-flex align-items-center"><p class="w-50 pr-0 m-0 pt-2"><select class="pr-5 disabled form-control" disabled id="suggested__question__type"><option value="multiple">Multiple choice</option><option value="text">Text</option><option value="numeric">Numeric</option></select></p></div><div class="col-2 col-md-3 text-center d-flex align-items-center justify-content-center pt-2"><span class="pr-2"><i class="far fa-image"></i></span></div><div class="col-10 col-md-9 d-flex align-items-center"><p class="pr-0 w-50 m-0 pt-2"><select class="disabled form-control pr-5" disabled><option>Image based</option><option>Audio based</option><option>Video based</option><option>Standard Q&amp;A</option></select></p></div> </div><div class="single__suggested__question__question pt-4 row"><p class="col-3"><span class="d-inline-block w-25">Question: </span></p> <p class="col-9 the_question"><input type="text" class="form-control readonly" readonly value="'+get_que+'"></p></div><div class="single__suggested__question__answer row pb-3"><div class="offset-3 col-9"><div class="form-row" style="min-height:0"><div class="offset-10 col"><small class="form-text text-center d-none correct_answer_heading">Correct:</small></div></div></div><p class="col-3"><span class="d-inline-block w-25 answers__label">Answers: </span></p><div  class="col-9 the_answer"><div  id="ans'+get_id+'" class=" add-answer align-items-center form-row"><div class="col-10 d-none"><a href="#" class="btn btn-primary d-block">Add answer</a></div></div></div></div><div class="single__suggested__question__footer border-top pt-3 d-flex justify-content-center align-items-center"><button class="btn btn-primary mr-1" data-dismiss="modal">Add question</button><button id="edit-kopi" class="btn btn-secondary ml-1 edit__question">Edit question</button></div></li>');
            for(var j=0; j<ans.length; j++){
              var get_ans=ans[j].answer;
              console.log('answer');
        
            $("#ans"+get_id).before('<div class="form-row multiple__choice__row__in_modal pb-0 mb-2 align-items-center"><div class="col input-group"><input name="multiple__choice__answer__1" class="form-control readonly" type="text" value="'+get_ans+'"><div  class="input-group-prepend"><span class="input-group-text text-white border-danger bg-danger rounded-right "><i class="far fa-trash-alt"></i></span></div></div><div class="col-2 text-center form-check"><input type="radio" class="readonly" name="multiple__choice__correct__answer"></div></div>');

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
            console.log('music video hi');
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
        
          console.log(data); // this is good
          console.log(data.status); // this is good
          var que=data.msg;
          var ans=data.ans;
          console.log(que[0].question);
          console.log('lenght'+que.length);
          console.log('lenght'+ans.length);
        var question='<li class="single__suggested__question text-body p-3 border rounded mb-4"><div class="single__suggested__question__image position-relative"><img src="../images/moscow__image.jpeg" class="w-100"><div class="change__image position-absolute px-4 invisible"><label class="d-block m-0 border-0" for="upload__quiz__icon"><i class="fas fa-edit"></i> Change<input type="file" class="form-control-file" id="upload__quiz__icon" value="Upload"> </label></div></div><div class="single__suggested__question__attributes row pt-3"><div class="col-md-3 text-center d-flex align-items-center justify-content-center"><span class="pr-2"><i class="fa fa-clock"></i></span></div><div class="col-md-9 d-flex align-items-center" style="height:48px"><p class="m-0"><span class="pr-2"><small><input class="form-control readonly edit__time__limit" readonly type="text" value="15">s</small></span>Time-limited</p></div><div class="col-2 col-md-3 text-center d-flex align-items-center justify-content-center pt-2"><span class="pr-2"><i class="fas fa-list-ul"></i></span></div><div class="col-10 col-md-9 d-flex align-items-center"><p class="w-50 pr-0 m-0 pt-2"><select class="pr-5 disabled form-control" disabled id="suggested__question__type"><option value="multiple">Multiple choice</option><option value="text">Text</option><option value="numeric">Numeric</option></select></p></div><div class="col-2 col-md-3 text-center d-flex align-items-center justify-content-center pt-2"><span class="pr-2"><i class="far fa-image"></i></span></div><div class="col-10 col-md-9 d-flex align-items-center"><p class="pr-0 w-50 m-0 pt-2"><select class="disabled form-control pr-5" disabled><option>Image based</option><option>Audio based</option><option>Video based</option><option>Standard Q&amp;A</option></select></p></div> </div><div class="single__suggested__question__question pt-4 row"><p class="col-3"><span class="d-inline-block w-25">Question: </span></p> <p class="col-9 the_question"><input type="text" class="form-control readonly" readonly value=""></p></div><div class="single__suggested__question__answer row pb-3"><div class="offset-3 col-9"><div class="form-row" style="min-height:0"><div class="offset-10 col"><small class="form-text text-center d-none correct_answer_heading">Correct:</small></div></div></div><p class="col-3"><span class="d-inline-block w-25 answers__label">Answers: </span></p><div  class="col-9 the_answer"><div  class=" add-answer align-items-center form-row"><div class="col-10 d-none"><a href="#" class="btn btn-primary d-block">Add answer</a></div></div></div></div><div class="single__suggested__question__footer border-top pt-3 d-flex justify-content-center align-items-center"><button class="btn btn-primary mr-1" data-dismiss="modal">Add question</button><button id="edit-kopi" class="btn btn-secondary ml-1 edit__question">Edit question</button></div></li>';

         for(var i=0; i<que.length; i++ ){ console.log('question');
          var get_que=que[i].question;
          var get_id=que[i].id;
          console.log('get id '+get_id);
            $(".all_suggested_questions").append('<li class="single__suggested__question text-body p-3 border rounded mb-4"><div class="single__suggested__question__image position-relative"><img src="../images/moscow__image.jpeg" class="w-100"><div class="change__image position-absolute px-4 invisible"><label class="d-block m-0 border-0" for="upload__quiz__icon"><i class="fas fa-edit"></i> Change<input type="file" class="form-control-file" id="upload__quiz__icon" value="Upload"> </label></div></div><div class="single__suggested__question__attributes row pt-3"><div class="col-md-3 text-center d-flex align-items-center justify-content-center"><span class="pr-2"><i class="fa fa-clock"></i></span></div><div class="col-md-9 d-flex align-items-center" style="height:48px"><p class="m-0"><span class="pr-2"><small><input class="form-control readonly edit__time__limit" readonly type="text" value="15">s</small></span>Time-limited</p></div><div class="col-2 col-md-3 text-center d-flex align-items-center justify-content-center pt-2"><span class="pr-2"><i class="fas fa-list-ul"></i></span></div><div class="col-10 col-md-9 d-flex align-items-center"><p class="w-50 pr-0 m-0 pt-2"><select class="pr-5 disabled form-control" disabled id="suggested__question__type"><option value="multiple">Multiple choice</option><option value="text">Text</option><option value="numeric">Numeric</option></select></p></div><div class="col-2 col-md-3 text-center d-flex align-items-center justify-content-center pt-2"><span class="pr-2"><i class="far fa-image"></i></span></div><div class="col-10 col-md-9 d-flex align-items-center"><p class="pr-0 w-50 m-0 pt-2"><select class="disabled form-control pr-5" disabled><option>Image based</option><option>Audio based</option><option>Video based</option><option>Standard Q&amp;A</option></select></p></div> </div><div class="single__suggested__question__question pt-4 row"><p class="col-3"><span class="d-inline-block w-25">Question: </span></p> <p class="col-9 the_question"><input type="text" class="form-control readonly" readonly value="'+get_que+'"></p></div><div class="single__suggested__question__answer row pb-3"><div class="offset-3 col-9"><div class="form-row" style="min-height:0"><div class="offset-10 col"><small class="form-text text-center d-none correct_answer_heading">Correct:</small></div></div></div><p class="col-3"><span class="d-inline-block w-25 answers__label">Answers: </span></p><div  class="col-9 the_answer"><div  id="ans'+get_id+'" class=" add-answer align-items-center form-row"><div class="col-10 d-none"><a href="#" class="btn btn-primary d-block">Add answer</a></div></div></div></div><div class="single__suggested__question__footer border-top pt-3 d-flex justify-content-center align-items-center"><button class="btn btn-primary mr-1" data-dismiss="modal">Add question</button><button id="edit-kopi" class="btn btn-secondary ml-1 edit__question">Edit question</button></div></li>');
            for(var j=0; j<ans.length; j++){
              var get_ans=ans[j].answer;
              console.log('answer');
        
            $("#ans"+get_id).before('<div class="form-row multiple__choice__row__in_modal pb-0 mb-2 align-items-center"><div class="col input-group"><input name="multiple__choice__answer__1" class="form-control readonly" type="text" value="'+get_ans+'"><div  class="input-group-prepend"><span class="input-group-text text-white border-danger bg-danger rounded-right "><i class="far fa-trash-alt"></i></span></div></div><div class="col-2 text-center form-check"><input type="radio" class="readonly" name="multiple__choice__correct__answer"></div></div>');

            }
 
                 
         }
        }


      });
      }
});



/*$("#cat3").click(function(e) {
             console.log('category 3');
          //  console.log('i am new'+$(this).find("p span").text());
});
*/
var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $("").click(function(){
              console.log('category 3');
                $.ajax({
                    /* the route pointing to the post function */
                    url: '/postajax',
                    type: 'POST',
                    /* send the csrf-token and the input to the controller */
                    data: {_token: CSRF_TOKEN, message:$(".getinfo").val()},
                    dataType: 'JSON',
                    /* remind that 'data' is the response of the AjaxController */
                    success: function (data) { 
                        $(".writeinfo").append(data.msg); 
                    }
                }); 
            });


      



     

  });
</script>
