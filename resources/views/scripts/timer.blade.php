<script type="text/javascript">
//bavaram

$(document).ready(function() { 
    /**after refresh start*/
    $(".timer").html("Wait.....");
    $("#pre").hide();
    $("#next").hide();

    var issueq=JSON.parse(sessionStorage.getItem("issuequestion"));
    var putanswer=JSON.parse(sessionStorage.getItem("putanswer"));
    var time=JSON.parse(sessionStorage.getItem("nowtimeon"));
    var timeon=0;

    if(time!=null){
        var splity=time.split(":");
	    timeon=parseInt(splity[0])*60+parseInt(splity[1]);
    }
    var all = $(".single__answer");
    var countDown;
    var quseee=1;
    var qustno=1;
    
    if(issueq!=null){
        
        qustno=issueq.length-1;
        quseee=issueq.length-1;
        if(quseee>0){
            $("#pre").show();
        }
        var an=issueq[quseee][1];
	    
		an=an.slice(0, -1);
		var answer=an.split("/");
		var answerId=issueq[quseee][3].split("/");
		var questionId=issueq[quseee][4];
		var roundId=issueq[quseee][5];
        var quizId=issueq[quseee][6];
        
        var type=issueq[quseee][7];
        var ti=issueq[quseee][8];

        var text0 ='';
        var textq="<div id='resub3' class='col-12 media__container p-0 mb-5'>"+
			"<img class='q-img' src='{{asset('site_design/images/homepage__logo.png')}}' height='170px'>"+
			"</div>"+
			"<div class='col-12 text-center'>"+
			"<h4 class='bernhard notification'>Not submitted</h4>" +
			"</div>"+
			"<div  class='col-12 the__question text-center mB-2'>"+
			"<h4 class='questionno' id='' style='min-width:50vw !important;'>  </h4>"+
            "</div>";

        if(type == "multiple__choice__question"){
            for (var i = 0; i < answer.length; i++) {
                text0 += "<form action='/playquiz/answer' method='post' name='form' id='"+answerId[i]+"' class='col-md-3 single__answer bg-white  mb-md-3 px-3 py-4 text-center mx-2 answers '>"+
                "<input name='_token' value='{{ csrf_token() }}' type='hidden'>"+
                "<input type='text' name='type' hidden value=1 />"+

                "<input type='text' name='answer' hidden value='"+answer[i]+"'/>"+
                "<input type='text' name='answer_id' hidden value='"+answerId[i]+"'/>"+
                "<input type='text' name='question' hidden value='"+questionId+"'/>"+
                "<input type='text' name='round' hidden value='"+roundId+"'/>"+
                "<input type='text' name='quiz' hidden value='"+quizId+"'/>"+
                "<input type='text' name='teamname' hidden value='{{ Session::get('teamname')}}'/>"+
                "<p>"+answer[i]+"</p>"+ 
                "</form>";	
            } 
        }

        else if(type == "standard__question"){
            text0 += "<form action='/playquiz/answer' method='post' name='form' id='"+answerId[i]+"' class='col-md-3 single__answer bg-white  mb-md-3 px-3 py-4 text-center mx-2 answers '>"+
                "<div class='form-group'>"+
                "<input type='text' name='type' hidden value=2 />"+
                "<input type='text' name='answer_id' hidden value='"+answerId[0]+"'/>"+

                "<input name='_token' value='{{ csrf_token() }}' type='hidden'>"+
                "<input type='text' name='question' hidden value='"+questionId+"'/>"+
                "<input type='text' name='round' hidden value='"+roundId+"'/>"+
                "<input type='text' name='quiz' hidden value='"+quizId+"'/>"+
                "<input type='text' name='teamname' hidden value='{{ Session::get('teamname')}}'/>"+
                "<input type='text' class='form-control' name='answer' placeholder='Enter answer'/>"+
                "</div>"+
                "</form>";	
        }
        
        else if(type == "numeric__question"){
            text0 += "<form action='/playquiz/answer' method='post' name='form' id='"+answerId[i]+"' class='col-md-3 single__answer bg-white  mb-md-3 px-3 py-4 text-center mx-2 answers '>"+
                "<div class='form-group'>"+
                "<input type='text' name='type' hidden value=3 />"+
                "<input type='text' name='answer_id' hidden value='"+answerId[0]+"'/>"+

                "<input name='_token' value='{{ csrf_token() }}' type='hidden'>"+
                "<input type='text' name='question' hidden value='"+questionId+"'/>"+
                "<input type='text' name='round' hidden value='"+roundId+"'/>"+
                "<input type='text' name='quiz' hidden value='"+quizId+"'/>"+
                "<input type='text' name='teamname' hidden value='{{ Session::get('teamname')}}'/>"+
                "<input type='number' class='form-control' name='answer' placeholder='Enter answer'/>"+
                "</div>"+
                "</form>"; 
        }

        
        text0 += "</div> <div class='break'></div>";
        
        if((time!=null || ti==0 || ti==null) && quseee==qustno){
            text0 += "<div id='resub1' class='justify-content-center row'>"+
                "<div class='' id='resub' >"+
                    "<br><a class='answer_submit btn btn-primary d-block d-lg-inline-block card__from__modal'>Submit Answer</a>"+
                "</div>"+
            "</div>";
            $('#all-answer').empty();
            $('#all-answer').append(text0);
            $('#ques').empty();
            $('#ques').append(textq);
            $('h4.questionno').text(issueq[quseee][0]);
            $('h4.notification').text('');
            var $box=null;
           
            $('.single__answer')
                .click(function() {
             
                if ($box == null) {
                    $box = $(this);
                    $box.css("box-shadow","3px 3px 15px #7343C1, -1px -1px 5px rgba(0, 0, 0, 0.045)");
                    $box.attr('id', 'answer');

                } 
                else  {
                    $box.css("box-shadow","");
                    $box.attr('id', 'disable');

                if($box != $(this))
                {
                    $box = $(this);
                    $box.css("box-shadow","3px 3px 15px #7343C1, -1px -1px 5px rgba(0, 0, 0, 0.045)");
                    $box.attr('id', 'answer');

                }
                else
                    $box = null;
                }
            });

            //send answer

            $('.answer_submit').on('click',function(e){ 
                e.preventDefault();  
                var answer = $('#answer');
                var aa=$('#answer').serializeArray();
                sessionStorage.setItem("stop", null);
                if(answer.length == 0){
                    swal('please select answer');
                }
                else{
                    putanswer=JSON.parse(sessionStorage.getItem("putanswer"));
                    var len=putanswer.length;
                    if(type == "multiple__choice__question"){
                        putanswer[len-1][1]=aa[3].value;
                    }else{
                        putanswer[len-1][1]=aa[6].value;
                    }
                    sessionStorage.setItem("putanswer", JSON.stringify(putanswer));
                    $('#resub').css('cursor','not-allowed');
                    $("#resub").css("pointer-events", "none");
                    $('#resub').css('opacity','0.4');
                    $('.single__answer').css('cursor','not-allowed');
                    $('.single__answer').css('pointer-events','none');

                    //answer media add start
                    /*after refresh */
                    var formdata = new FormData($("#answer")[0]);
                   
                    $.ajax({
                        type: "POST",
                        url: "/playquiz/answer",
                        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                        data: formdata,
                        processData: false,
                        contentType: false,
                        cache: false,
                        enctype: 'multipart/form-data',
                        
                        success: function(data) {
                            swal("Answer Submited!",'wait for the next ...', "success");
                        },
                    });
                }
            });
        }
        
        if(ti==0 || ti==null){
            $(".timer").html("Not set");
            if(sessionStorage.getItem("stop")=="null"){
                $('#resub1').empty();
                $('.single__answer').css('cursor','not-allowed');
                $('.single__answer').css('pointer-events','none');
            }else{
                
            }
        }else{
            var y=timeon;
            var sec= y,
            countDiv    = document.getElementById("timer"),
            secpass;
            countDown   = setInterval(function () {
                'use strict';
                secpass0();
            }, 1000);
        }
        function secpass0() {
            'use strict';
                
            var min     = Math.floor(sec / 60),
            remSec  = sec % 60;
                
            if (remSec < 10) {
                remSec = '0' + remSec;
            }
            if (min < 10) {
                min = '0' + min;
            }
                
            $(".timer").html(min + ":" + remSec);
            sessionStorage.setItem("nowtimeon", JSON.stringify(min + ":" + remSec));
                
            if (sec > 0) {
                
                sec = sec - 1;
                
            } else {
                clearInterval(countDown);
                $(".timer").html("Time Out");
                sessionStorage.setItem("nowtimeon", null);
                $('.single__answer').css('cursor','not-allowed');
                $('.single__answer').css('pointer-events','none');

                $('#resub').css('cursor','not-allowed');
                $("#resub").css("pointer-events", "none");
                $('#resub').css('opacity','0.4');
            }
        }

    }
    
	$("#pre").click(function(){
        $("#next").show();
        var time=JSON.parse(sessionStorage.getItem("nowtimeon"));
        quseee=quseee-1;
        var an=issueq[quseee][1];
        if(quseee==0){
            $("#pre").hide();
        }

		an=an.slice(0, -1);
		var answer=an.split("/");
		var answerId=issueq[quseee][3].split("/");
		var questionId=issueq[quseee][4];
		var roundId=issueq[quseee][5];
		var quizId=issueq[quseee][6];
	
        var type=issueq[quseee][7];
        
        var text0='';
        var textq="<div id='resub3' class='col-12 media__container p-0 mb-5'>"+
			"<img class='q-img' src='{{asset('site_design/images/homepage__logo.png')}}' height='170px'>"+
			"</div>"+
			"<div class='col-12 text-center'>"+
			"<h4 class='bernhard notification'>Not submitted</h4>" +
			"</div>"+
			"<div  class='col-12 the__question text-center mB-2'>"+
			"<h4 class='questionno' id='' style='min-width:50vw !important;'>  </h4>"+
            "</div>";
            
        if(type == "multiple__choice__question"){
            for (var i = 0; i < answer.length; i++) {
                var x="single__answer_white";
                
                if(putanswer[quseee][1]==""){
                    if(putanswer[quseee][2]==answerId[i]){
                        x="single__answer_warning";
                    }else{
                        x="single__answer_white";
                    }
                }else{                
                    if(putanswer[quseee][2]==""){
                        if(answerId[i]==putanswer[quseee][1]){
                            x="bg-primary";
                        }else{
                            x="single__answer_white";
                        }
                    }else{
                        if(putanswer[quseee][1]==putanswer[quseee][2]){
                            if(answerId[i]==putanswer[quseee][1]){
                                x="single__answer_correct";
                            }else{
                                x="single__answer_white";
                            }
                        }else{
                            if(answerId[i]==putanswer[quseee][1]){
                                x="single__answer_wrong";
                            }else if(answerId[i]==putanswer[quseee][2]){
                                x="single__answer_correct";
                            }else{
                                x="single__answer_white";
                            }
                        }
                    }
                }
                text0 += "<form action='/playquiz/answer' method='post' name='form' id='"+answerId[i]+"' class='col-md-3 single__answer "+x+" mb-md-3 px-3 py-4 text-center mx-2 answers '>"+
                "<input name='_token' value='{{ csrf_token() }}' type='hidden'>"+
                "<input type='text' name='type' hidden value=1 />"+

                "<input type='text' name='answer' hidden value='"+answer[i]+"'/>"+
                "<input type='text' name='answer_id' hidden value='"+answerId[i]+"'/>"+
                "<input type='text' name='question' hidden value='"+questionId+"'/>"+
                "<input type='text' name='round' hidden value='"+roundId+"'/>"+
                "<input type='text' name='quiz' hidden value='"+quizId+"'/>"+
                "<input type='text' name='teamname' hidden value='{{ Session::get('teamname')}}'/>"+
                "<p>"+answer[i]+"</p>"+ 
                "</form>";	
            } 
        }else if(type == "standard__question"){
            var x="single__answer_white";
            var coans=Object.values(issueq[quseee][12][0]);
            
            
            var teamname = '{{ Session::get('teamname')}}';
            var len=issueq[quseee][12].length;
            
            var correct=0;
            var ttt="";
            var an0="";
            for(var i=0;i<len;i++){
                if(Object.values(issueq[quseee][12][i])[3]==teamname){
                    correct=Object.values(issueq[quseee][12][i])[5];
                    an0=Object.values(issueq[quseee][12][i])[4];
                }
            }
            var answer="non";
            
            if(correct==1){
                answer=an0;
                x="single__answer_correct";
            }else if(correct==0){
                answer=an0;
                x="single__answer_wrong";
                ttt = "<div class='col-md-3 single__answer single__answer_correct  mb-md-3 px-3 py-4 text-center mx-2' style='color:black;font-weight: bold;'>"+an+" </div>";
            }else{
                answer="non";
                x="single__answer_white";
            }
           
            text0 += "<form  method='post' name='form'  class='col-md-3 single__answer "+x+"  mb-md-3 px-3 py-4 text-center mx-2 answers '>"+
                            "<div class='form-group'>"+
                            "<input name='_token' value='{{ csrf_token() }}' type='hidden'>"+
                            "<input type='text' name='answer_id' hidden value='"+answerId[0]+"'/>"+

                            "<input type='text' name='type' hidden value=3 />"+

                            "<input type='text' name='question' hidden value='"+questionId+"'/>"+
                            "<input type='text' name='round' hidden value='"+roundId+"'/>"+
                            "<input type='text' name='quiz' hidden value='"+quizId+"'/>"+
                            "<input type='text' name='teamname' hidden value='{{ Session::get('teamname')}}'/>"+
                            "<input type='number' class='form-control' name='answer' value='"+answer+"' placeholder='Enter answer'/>"+
                            "</div>"+
                            "</form>"+ttt;	
        }else if(type == "numeric__question"){
            var x="single__answer_white";
            var coans=Object.values(issueq[quseee][12][0]);
            var teamname = '{{ Session::get('teamname')}}';
            var len=issueq[quseee][12].length;
            
            var correct=0;
            var ttt="";
            var an0="";
            for(var i=0;i<len;i++){
                if(Object.values(issueq[quseee][12][i])[3]==teamname){
                    correct=Object.values(issueq[quseee][12][i])[5];
                    an0=Object.values(issueq[quseee][12][i])[4];
                }
            }
            var answer="non";
            
            if(correct==1){
                answer=an0;
                x="single__answer_correct";
            }else if(correct==0){
                answer=an0;
                x="single__answer_wrong";
                ttt = "<p class='col-md-3 single__answer single__answer_correct  mb-md-3 px-3 py-4 text-center mx-2' style='color:black;font-weight: bold;'>"+an+"</p>";
            }else{
                answer="non";
                x="single__answer_white";
            }
            
            text0 += "<form  method='post' name='form'  class='col-md-3 single__answer "+x+"  mb-md-3 px-3 py-4 text-center mx-2 answers '>"+
                            "<div class='form-group'>"+
                            "<input name='_token' value='{{ csrf_token() }}' type='hidden'>"+
                            "<input type='text' name='answer_id' hidden value='"+answerId[0]+"'/>"+

                            "<input type='text' name='type' hidden value=3 />"+

                            "<input type='text' name='question' hidden value='"+questionId+"'/>"+
                            "<input type='text' name='round' hidden value='"+roundId+"'/>"+
                            "<input type='text' name='quiz' hidden value='"+quizId+"'/>"+
                            "<input type='text' name='teamname' hidden value='{{ Session::get('teamname')}}'/>"+
                            "<input type='number' class='form-control' name='answer' value='"+answer+"' placeholder='Enter answer'/>"+
                            "</div>"+
                            "</form>"+ttt;	
    
        }

        text0 += "</div> <div class='break'></div>";
        if((time!=null || ti==0 || ti==null)&& quseee==qustno){
            text0 += "<div id='resub1' class='justify-content-center row'>"+
                "<div class='' id='resub' >"+
                    "<br><a class='btn btn-primary d-block d-lg-inline-block card__from__modal' onclick='document.getElementById("+answerId[i]+").submit()'>Submit Answer</a>"+
                "</div>"+
            "</div>"+
            "</div>"+
        "</div>";
        }
        $('#all-answer').empty();
        $('#all-answer').append(text0);
        
        $('#ques').empty();
        $('#ques').append(textq);
        
        $('h4.questionno').text(issueq[quseee][0]);
        $('h4.notification').text('');
	});

    $("#next").click(function(){
        $("#pre").show();
        var time=JSON.parse(sessionStorage.getItem("nowtimeon"));
        var issueq=JSON.parse(sessionStorage.getItem("issuequestion"));
        var putanswer=JSON.parse(sessionStorage.getItem("putanswer"));
        quseee=quseee+1;
        var an=issueq[quseee][1];
		if(quseee==issueq.length-1){
            $("#next").hide();
        }

		an=an.slice(0, -1);
		var answer=an.split("/");
		var answerId=issueq[quseee][3].split("/");
		var questionId=issueq[quseee][4];
		var roundId=issueq[quseee][5];
		var quizId=issueq[quseee][6];

        var type=issueq[quseee][7];
        var text0 = '';
        var textq="<div id='resub3' class='col-12 media__container p-0 mb-5'>"+
			"<img class='q-img' src='{{asset('site_design/images/homepage__logo.png')}}' height='170px'>"+
			"</div>"+
			"<div class='col-12 text-center'>"+
			"<h4 class='bernhard notification'>Not submitted</h4>" +
			"</div>"+
			"<div  class='col-12 the__question text-center mB-2'>"+
			"<h4 class='questionno' id='' style='min-width:50vw !important;'>  </h4>"+
            "</div>";
            
        if(type == "multiple__choice__question"){
            for (var i = 0; i < answer.length; i++) {
                var x="single__answer_white";
                if(putanswer[quseee][1]==""){
                    if(putanswer[quseee][2]==answerId[i]){
                        x="single__answer_warning";
                    }else{
                        x="single__answer_white";
                    }
                }else{                
                    if(putanswer[quseee][2]==""){
                        if(answerId[i]==putanswer[quseee][1]){
                            x="bg-primary";
                        }else{
                            x="single__answer_white";
                        }
                    }else{
                        if(putanswer[quseee][1]==putanswer[quseee][2]){
                            if(answerId[i]==putanswer[quseee][1]){
                                x="single__answer_correct";
                            }else{
                                x="single__answer_white";
                            }
                        }else{
                            if(answerId[i]==putanswer[quseee][1]){
                                x="single__answer_wrong";
                            }else if(answerId[i]==putanswer[quseee][2]){
                                x="single__answer_correct";
                            }else{
                                x="single__answer_white";
                            }
                        }
                    }
                }
                text0 += "<form action='/playquiz/answer' method='post' name='form' id='"+answerId[i]+"' class='col-md-3 single__answer "+x+"  mb-md-3 px-3 py-4 text-center mx-2 answers '>"+
                "<input name='_token' value='{{ csrf_token() }}' type='hidden'>"+
                "<input type='text' name='type' hidden value=1 />"+

                "<input type='text' name='answer' hidden value='"+answer[i]+"'/>"+
                "<input type='text' name='answer_id' hidden value='"+answerId[i]+"'/>"+
                "<input type='text' name='question' hidden value='"+questionId+"'/>"+
                "<input type='text' name='round' hidden value='"+roundId+"'/>"+
                "<input type='text' name='quiz' hidden value='"+quizId+"'/>"+
                "<input type='text' name='teamname' hidden value='{{ Session::get('teamname')}}'/>"+
                "<p>"+answer[i]+"</p>"+ 
                "</form>";	   
            } 
        }else if(type == "standard__question"){
            var x="single__answer_white";
            var coans=Object.values(issueq[quseee][12][0]);
            var teamname = '{{ Session::get('teamname')}}';
            var len=issueq[quseee][12].length;
            
            var correct=0;
            var ttt="";
            var an0="";
            for(var i=0;i<len;i++){
                if(Object.values(issueq[quseee][12][i])[3]==teamname){
                    correct=Object.values(issueq[quseee][12][i])[5];
                    an0=Object.values(issueq[quseee][12][i])[4];
                }
            }
            var answer="non";
            
            if(correct==1){
                answer=an0;
                x="single__answer_correct";
            }else if(correct==0){
                answer=an0;
                x="single__answer_wrong";
                ttt = "<p class='col-md-3 single__answer single__answer_correct  mb-md-3 px-3 py-4 text-center mx-2' style='color:black;font-weight: bold;'>"+an+"</p>";
            }else{
                answer="non";
                x="single__answer_white";
            }
            
            text0 += "<form  method='post' name='form'  class='col-md-3 single__answer "+x+"  mb-md-3 px-3 py-4 text-center mx-2 answers '>"+
                    "<div class='form-group'>"+
                    "<input name='_token' value='{{ csrf_token() }}' type='hidden'>"+
                    "<input type='text' name='answer_id' hidden value='"+answerId[0]+"'/>"+

                    "<input type='text' name='type' hidden value=3 />"+

                    "<input type='text' name='question' hidden value='"+questionId+"'/>"+
                    "<input type='text' name='round' hidden value='"+roundId+"'/>"+
                    "<input type='text' name='quiz' hidden value='"+quizId+"'/>"+
                    "<input type='text' name='teamname' hidden value='{{ Session::get('teamname')}}'/>"+
                    "<input type='number' class='form-control' name='answer' value='"+answer+"' placeholder='Enter answer'/>"+
                    "</div>"+
                            "</form>"+ttt;	
        }else if(type == "numeric__question"){
            var x="single__answer_white";
            var coans=Object.values(issueq[quseee][12][0]);
            var teamname = '{{ Session::get('teamname')}}';
            var len=issueq[quseee][12].length;
            
            var correct=0;
            var ttt="";
            var an0="";
            for(var i=0;i<len;i++){
                if(Object.values(issueq[quseee][12][i])[3]==teamname){
                    correct=Object.values(issueq[quseee][12][i])[5];
                    an0=Object.values(issueq[quseee][12][i])[4];
                }
            }
            var answer="non";
            
            if(correct==1){
                answer=Object.values(issueq[quseee][12][i])[4];
                x="single__answer_correct";
            }else if(correct==0){
                answer=Object.values(issueq[quseee][12][i])[4];
                x="single__answer_wrong";
                ttt = "<p class='col-md-3 single__answer single__answer_correct  mb-md-3 px-3 py-4 text-center mx-2' style='color:black;font-weight: bold;'>"+an+"</p>";
            }else{
                answer="non";
                x="single__answer_white";
            }
            
            text0 += "<form  method='post' name='form'  class='col-md-3 single__answer "+x+"  mb-md-3 px-3 py-4 text-center mx-2 answers '>"+
                    "<div class='form-group'>"+
                    "<input name='_token' value='{{ csrf_token() }}' type='hidden'>"+
                    "<input type='text' name='answer_id' hidden value='"+answerId[0]+"'/>"+

                    "<input type='text' name='type' hidden value=3 />"+

                    "<input type='text' name='question' hidden value='"+questionId+"'/>"+
                    "<input type='text' name='round' hidden value='"+roundId+"'/>"+
                    "<input type='text' name='quiz' hidden value='"+quizId+"'/>"+
                    "<input type='text' name='teamname' hidden value='{{ Session::get('teamname')}}'/>"+
                    "<input type='number' class='form-control' name='answer' value='"+answer+"' placeholder='Enter answer'/>"+
                    "</div>"+
                    "</form>"+ttt;	
        }
    
        text0 += "</div> <div class='break'></div>";
        if(time!=null && quseee==qustno){
            text0 += "<div id='resub1' class='justify-content-center row'>"+
                "<div class='' id='resub' >"+
                    "<br><a class='btn btn-primary d-block d-lg-inline-block card__from__modal' onclick='document.getElementById("+answerId[i]+").submit()'>Submit Answer</a>"+
                "</div>"+
            "</div>"+
            "</div>"+
            "</div>";
        }
		$('#all-answer').empty();
        $('#all-answer').append(text0);
        $('#ques').empty();
        $('#ques').append(textq);
        $('h4.questionno').text(issueq[quseee][0]);
        $('h4.notification').text('');
	});

	Pusher.logToConsole = false;

	var pusher = new Pusher('87436df86baf66b2192a', {
		cluster: 'ap2'
	});
    var channel1 = pusher.subscribe('my-channel1');
    channel1.bind('form-submitted1', function(data) {
        var quizId = data.text;
        var qid=$('#quizid').text();
        if(parseInt(quizId)===parseInt(qid)){
            swal("Teacher Stoped your Submition !",'you can not submit answer...', "danger")
            $('#resub').css('cursor','not-allowed');
            $("#resub").css("pointer-events", "none");
            $('#resub').css('opacity','0.4');
            $(".timer").html("Teacher Stoped");
            sessionStorage.setItem("stop", null);
            sessionStorage.setItem("nowtimeon", null);
            clearInterval(countDown);
        }
    });
    var channel2 = pusher.subscribe('my-channel2');
    channel2.bind('form-submitted2', function(data) {
        var quizId = data.text;
        var qid=$('#quizid').text();
        if(parseInt(quizId)===parseInt(qid)){
            swal("Teacher Paused Timer !",'you will get more seconds...', "info")
            $(".timer").html("Teacher Paused");
            sessionStorage.setItem("nowtimeon", null);
            clearInterval(countDown);
        }
    });
    
    var channel3 = pusher.subscribe('my-channel3');
    channel3.bind('form-submitted3', function(data) {       
        qustno=issueq.length-1;
        quseee=issueq.length-1;
        $("#next").hide();
        if(quseee!=0){
            $("#pre").show();
        }
        
        swal("Teacher share your Answer !",'you can get your results...', "info")
        var qid=$('#quizid').text();
        var message = data;
        var questionId=message.text[4];
		var an=message.text[1];
		
		an=an.slice(0, -1);
		var answer=an.split("/");
		var answerId=message.text[3].split("/");
		
		var roundId=message.text[5];
		var quizId=message.text[6];
        var type=message.text[7];

        if(message.text[9]){
		    var media_type=message.text[9].split("/");
        }
        if(message.text[10]){
            var media_link=message.text[10].split("**");
        }
        if(message.text[11]){
            var media_path=message.text[11].split("**");
        }
        
        
        var correctanswer=message.text[8];
        var pan=[questionId,"",""];
        putanswer=JSON.parse(sessionStorage.getItem("putanswer"));
        var len=putanswer.length;
        var x=0;
        for(var i=0;i<len;i++){
            if(parseInt(putanswer[i][0])==parseInt(questionId)){
                putanswer[i][2]=correctanswer;
            }
        }
        sessionStorage.setItem("putanswer", JSON.stringify(putanswer));

        
        if(parseInt(quizId)===parseInt(qid)){
            var text0 ='';
            if(!media_type){
                var textq="<div id='resub3' class='col-12 media__container p-0 mb-5'>"+
                    "<img class='q-img' src='{{asset('site_design/images/homepage__logo.png')}}' height='170px'>"+
                    "</div>"+
                    "<div class='col-12 text-center'>"+
                    "<h4 class='bernhard notification'>Not submitted</h4>" +
                    "</div>"+
                    "<div  class='col-12 the__question text-center mB-2'>"+
                    "<h4 class='questionno' id='' style='min-width:50vw !important;'>  </h4>"+
                    "</div>";
            }
            else if(media_type[0] == 'image'){

                if(!media_path[0]){
                    var textq="<div id='resub3' class='col-12 media__container p-0 mb-5'>"+
                    "<img class='q-img' src='"+media_link[0]+"' >"+
                    "</div>"+
                    "<div class='col-12 text-center'>"+
                    "<h4 class='bernhard notification'>Not submitted</h4>" +
                    "</div>"+
                    "<div  class='col-12 the__question text-center mB-2'>"+
                    "<h4 class='questionno' id='' style='min-width:50vw !important;'>  </h4>"+
                    "</div>";                }

else{

                var textq="<div id='resub3' class='col-12 media__container p-0 mb-5'>"+
                    "<img class='q-img' src='{{asset('')}}"+media_path[0]+"' >"+
                    "</div>"+
                    "<div class='col-12 text-center'>"+
                    "<h4 class='bernhard notification'>Not submitted</h4>" +
                    "</div>"+
                    "<div  class='col-12 the__question text-center mB-2'>"+
                    "<h4 class='questionno' id='' style='min-width:50vw !important;'>  </h4>"+
                    "</div>";
}
            }else if(media_type[0] == 'audio'){
                if(!media_path[0]){
                var textq="<div id='resub3' class='col-12 media__container p-0 mb-5'>"+
                "<iframe height='225px' src='"+media_link[0]+"'> </iframe>"+
                    "</div>"+
                    "<div class='col-12 text-center'>"+
                    "<h4 class='bernhard notification'>Not submitted</h4>" +
                    "</div>"+
                    "<div  class='col-12 the__question text-center mB-2'>"+
                    "<h4 class='questionno' id='' style='min-width:50vw !important;'>  </h4>"+
                    "</div>";
                }
                else{
                    var textq="<div id='resub3' class='col-12 media__container p-0 mb-5'>"+
                    "<audio class='q-img' controls> <source src='{{asset('')}}"+media_path[0]+"' type='audio/mpeg'> </audio>"+
                    "</div>"+
                    "<div class='col-12 text-center'>"+
                    "<h4 class='bernhard notification'>Not submitted</h4>" +
                    "</div>"+
                    "<div  class='col-12 the__question text-center mB-2'>"+
                    "<h4 class='questionno' id='' style='min-width:50vw !important;'>  </h4>"+
                    "</div>";
                }
            }else if(media_type[0] == 'video'){
                if(!media_path[0]){
                var textq="<div id='resub3' class='col-12 media__container p-0 mb-5 text-center position-relative'>"+
                   "<iframe height='300px' width='600px'  src='"+media_link[0]+"'> </iframe>"+
                    "</div>"+
                    "<div class='col-12 text-center'>"+
                    "<h4 class='bernhard notification'>Not submitted</h4>" +
                    "</div>"+
                    "<div  class='col-12 the__question text-center mB-2'>"+
                    "<h4 class='questionno' id='' style='min-width:50vw !important;'>  </h4>"+
                    "</div>";
                }
                else{
                    var textq="<div id='resub3' class='col-12 media__container p-0 mb-5 text-center position-relative'>"+
                    "<video class='justify-content-center align-self-center' controls> <source src='{{asset('')}}"+media_path[0]+"' type='audio/mpeg' > </video>"+
                    "</div>"+
                    "<div class='col-12 text-center'>"+
                    "<h4 class='bernhard notification'>Not submitted</h4>" +
                    "</div>"+
                    "<div  class='col-12 the__question text-center mB-2'>"+
                    "<h4 class='questionno' id='' style='min-width:50vw !important;'>  </h4>"+
                    "</div>";
                }
            }
    
            if(type == "multiple__choice__question"){
                for (var i = 0; i < answer.length; i++) {
                    var x="single__answer_white";
                    if(putanswer[quseee][1]==""){
                        if(putanswer[quseee][2]==answerId[i]){
                            x="single__answer_warning";
                        }else{
                            x="single__answer_white";
                        }
                    }else{
                        if(putanswer[quseee][1]==putanswer[quseee][2]){
                            if(answerId[i]==putanswer[quseee][1]){
                                x="single__answer_correct";
                            }else{
                                x="single__answer_white";
                            }
                        }else{
                            if(answerId[i]==putanswer[quseee][1]){
                                x="single__answer_wrong";
                            }else if(answerId[i]==putanswer[quseee][2]){
                                x="single__answer_correct";
                            }else{
                                x="single__answer_white";
                            }
                        }
                    }
                
                    text0 += "<form action='/playquiz/answer' method='post' name='form' id='"+answerId[i]+"' class='col-md-3 single__answer "+x+"  mb-md-3 px-3 py-4 text-center mx-2 answers '>"+
                    "<input name='_token' value='{{ csrf_token() }}' type='hidden'>"+
                    "<input type='text' name='type' hidden value=1 />"+

                    "<input type='text' name='answer' hidden value='"+answer[i]+"'/>"+
                    "<input type='text' name='answer_id' hidden value='"+answerId[i]+"'/>"+

                    "<input type='text' name='question' hidden value='"+questionId+"'/>"+
                    "<input type='text' name='round' hidden value='"+roundId+"'/>"+
                    "<input type='text' name='quiz' hidden value='"+quizId+"'/>"+
                    "<input type='text' name='teamname' hidden value='{{ Session::get('teamname')}}'/>"+
                    "<p>"+answer[i]+"</p>"+ 
                    "</form>";
                } 
            }else if(type == "standard__question"){
                var x="single__answer_white";
                var coans=Object.values(message.text[12][0]);
                var teamname = '{{ Session::get('teamname')}}';
                var len=message.text[12].length;
                
                var correct=0;
                var ttt="";
                var an0="";
                for(var i=0;i<len;i++){
                    if(Object.values(message.text[12][i])[3]==teamname){
                        correct=Object.values(message.text[12][i])[5];
                        an0=Object.values(message.text[12][i])[4];
                    }
                }
                var answer="non";
                if(correct==1){
                    answer=an0;
                    x="single__answer_correct";
                }else if(correct==0){
                    answer=an0;
                    x="single__answer_wrong";
                   
                    ttt = "<p class='col-md-3 single__answer single__answer_correct  mb-md-3 px-3 py-4 text-center mx-2' style='color:black;font-weight: bold;'>"+an+"</p>";
                }else{
                    answer="non";
                    x="single__answer_white";
                }
                
                text0 += "<form  method='post' name='form'  class='col-md-3 single__answer "+x+"  mb-md-3 px-3 py-4 text-center mx-2 answers '>"+
                    "<div class='form-group'>"+
                    "<input name='_token' value='{{ csrf_token() }}' type='hidden'>"+
                    "<input type='text' name='answer_id' hidden value='"+answerId[0]+"'/>"+

                    "<input type='text' name='type' hidden value=3 />"+

                    "<input type='text' name='question' hidden value='"+questionId+"'/>"+
                    "<input type='text' name='round' hidden value='"+roundId+"'/>"+
                    "<input type='text' name='quiz' hidden value='"+quizId+"'/>"+
                    "<input type='text' name='teamname' hidden value='{{ Session::get('teamname')}}'/>"+
                    "<input type='number' class='form-control' name='answer' value='"+answer+"' placeholder='Enter answer'/>"+
                    "</div>"+
                    "</form>"+ttt;	
            }else if(type == "numeric__question"){
                var x="single__answer_white";
                var coans=Object.values(message.text[12][0]);
                var teamname = '{{ Session::get('teamname')}}';
                var len=message.text[12].length;
                
                var correct=0;
                var ttt="";
                var an0="";
                for(var i=0;i<len;i++){
                    if(Object.values(message.text[12][i])[3]==teamname){
                        correct=Object.values(message.text[12][i])[5];
                        an0=Object.values(message.text[12][i])[4];
                    }
                }
                var answer="non";
                if(correct==1){
                    answer=an0;
                    x="single__answer_correct";
                }else if(correct==0){
                    answer=an0;
                    x="single__answer_wrong";
                    ttt = "<p class='col-md-3 single__answer single__answer_correct  mb-md-3 px-3 py-4 text-center mx-2' style='color:black;font-weight: bold;'>"+an+"</p>";
                }else{
                    answer="non";
                    x="single__answer_white";
                }
                
                text0 += "<form  method='post' name='form'  class='col-md-3 single__answer "+x+"  mb-md-3 px-3 py-4 text-center mx-2 answers '>"+
                    "<div class='form-group'>"+
                    "<input name='_token' value='{{ csrf_token() }}' type='hidden'>"+
                    "<input type='text' name='answer_id' hidden value='"+answerId[0]+"'/>"+

                    "<input type='text' name='type' hidden value=3 />"+

                    "<input type='text' name='question' hidden value='"+questionId+"'/>"+
                    "<input type='text' name='round' hidden value='"+roundId+"'/>"+
                    "<input type='text' name='quiz' hidden value='"+quizId+"'/>"+
                    "<input type='text' name='teamname' hidden value='{{ Session::get('teamname')}}'/>"+
                    "<input type='number' class='form-control' name='answer' value='"+answer+"' placeholder='Enter answer'/>"+
                    "</div>"+
                    "</form>"+ttt;	    	
            }
            $('#all-answer').empty();
            $('#all-answer').append(text0);
            $('#ques').empty();
            $('#ques').append(textq);
            $('h4.questionno').text(message.text[0]);
            $('h4.notification').text('');
        }
    });
/**after play push */
	var channel = pusher.subscribe('my-channel');
	channel.bind('form-submitted', function(data) {
        var qid=$('#quizid').text();
        var message = data;
		qustno=qustno+1;
		quseee=qustno;
		issueq=JSON.parse(sessionStorage.getItem("issuequestion"));
		putanswer=JSON.parse(sessionStorage.getItem("putanswer"));

		if(issueq==null){
			var x=[[]];
			issueq=x;
		}
        else{
            if(issueq.length>1){
                $("#pre").show();
            }
        }
        if(putanswer==null){
			var x=[[]];
			putanswer=x;
		}
        var questionId=message.text[4];

        var pan=[questionId,"",""];

		issueq.push(message.text);
		putanswer.push(pan);

		sessionStorage.setItem("issuequestion", JSON.stringify(issueq));
		sessionStorage.setItem("putanswer", JSON.stringify(putanswer));

		
		var an=message.text[1];
		
		an=an.slice(0, -1);
		var answer=an.split("/");
		var answerId=message.text[3].split("/");
		
		var roundId=message.text[5];
		var quizId=message.text[6];
        var type=message.text[7];

        if(message.text[9]){
		var media_type=message.text[9].split("/");}
        if(message.text[10]){
        var media_link=message.text[10].split("**");}
        if(message.text[11]){
        var media_path=message.text[11].split("**");}


        timeon=message.text[8];

        if(parseInt(quizId)===parseInt(qid)){
            var text0 ='';
            if(!media_type){
                var textq="<div id='resub3' class='col-12 media__container p-0 mb-5'>"+
                    "<img class='q-img' src='{{asset('site_design/images/homepage__logo.png')}}' height='170px'>"+
                    "</div>"+
                    "<div class='col-12 text-center'>"+
                    "<h4 class='bernhard notification'>Not submitted</h4>" +
                    "</div>"+
                    "<div  class='col-12 the__question text-center mB-2'>"+
                    "<h4 class='questionno' id='' style='min-width:50vw !important;'>  </h4>"+
                    "</div>";
            }
            else if(media_type[0] == 'image'){

                if(!media_path[0]){
                    var textq="<div id='resub3' class='col-12 media__container p-0 mb-5'>"+
                    "<img class='q-img' src='"+media_link[0]+"' >"+
                    "</div>"+
                    "<div class='col-12 text-center'>"+
                    "<h4 class='bernhard notification'>Not submitted</h4>" +
                    "</div>"+
                    "<div  class='col-12 the__question text-center mB-2'>"+
                    "<h4 class='questionno' id='' style='min-width:50vw !important;'>  </h4>"+
                    "</div>";                }

else{

                var textq="<div id='resub3' class='col-12 media__container p-0 mb-5'>"+
                    "<img class='q-img' src='{{asset('')}}"+media_path[0]+"' >"+
                    "</div>"+
                    "<div class='col-12 text-center'>"+
                    "<h4 class='bernhard notification'>Not submitted</h4>" +
                    "</div>"+
                    "<div  class='col-12 the__question text-center mB-2'>"+
                    "<h4 class='questionno' id='' style='min-width:50vw !important;'>  </h4>"+
                    "</div>";
}
            }else if(media_type[0] == 'audio'){
                if(!media_path[0]){
                var textq="<div id='resub3' class='col-12 media__container p-0 mb-5'>"+
                "<iframe height='225px' src='"+media_link[0]+"'> </iframe>"+
                    "</div>"+
                    "<div class='col-12 text-center'>"+
                    "<h4 class='bernhard notification'>Not submitted</h4>" +
                    "</div>"+
                    "<div  class='col-12 the__question text-center mB-2'>"+
                    "<h4 class='questionno' id='' style='min-width:50vw !important;'>  </h4>"+
                    "</div>";
                }
                else{
                    var textq="<div id='resub3' class='col-12 media__container p-0 mb-5'>"+
                    "<audio class='q-img' controls> <source src='{{asset('')}}"+media_path[0]+"' type='audio/mpeg'> </audio>"+
                    "</div>"+
                    "<div class='col-12 text-center'>"+
                    "<h4 class='bernhard notification'>Not submitted</h4>" +
                    "</div>"+
                    "<div  class='col-12 the__question text-center mB-2'>"+
                    "<h4 class='questionno' id='' style='min-width:50vw !important;'>  </h4>"+
                    "</div>";
                }
            }else if(media_type[0] == 'video'){
                if(!media_path[0]){
                var textq="<div id='resub3' class='col-12 media__container p-0 mb-5 text-center position-relative'>"+
                   "<iframe height='300px' width='600px'  src='"+media_link[0]+"'> </iframe>"+
                    "</div>"+
                    "<div class='col-12 text-center'>"+
                    "<h4 class='bernhard notification'>Not submitted</h4>" +
                    "</div>"+
                    "<div  class='col-12 the__question text-center mB-2'>"+
                    "<h4 class='questionno' id='' style='min-width:50vw !important;'>  </h4>"+
                    "</div>";
                }
                else{
                    var textq="<div id='resub3' class='col-12 media__container p-0 mb-5 text-center position-relative'>"+
                    "<video class='justify-content-center align-self-center' controls> <source src='{{asset('')}}"+media_path[0]+"' type='audio/mpeg' > </video>"+
                    "</div>"+
                    "<div class='col-12 text-center'>"+
                    "<h4 class='bernhard notification'>Not submitted</h4>" +
                    "</div>"+
                    "<div  class='col-12 the__question text-center mB-2'>"+
                    "<h4 class='questionno' id='' style='min-width:50vw !important;'>  </h4>"+
                    "</div>";
                }
            }
            if(type == "multiple__choice__question"){
                for (var i = 0; i < answer.length; i++) {
                    text0 += "<form action='/playquiz/answer' method='post' name='form' id='"+answerId[i]+"' class='col-md-3 single__answer bg-white  mb-md-3 px-3 py-4 text-center mx-2 answers '>"+
                    "<input name='_token' value='{{ csrf_token() }}' type='hidden'>"+
                    "<input type='text' name='type' hidden value=1 />"+

                    "<input type='text' name='answer' hidden value='"+answer[i]+"'/>"+
                    "<input type='text' name='answer_id' hidden value='"+answerId[i]+"'/>"+

                    "<input type='text' name='question' hidden value='"+questionId+"'/>"+
                    "<input type='text' name='round' hidden value='"+roundId+"'/>"+
                    "<input type='text' name='quiz' hidden value='"+quizId+"'/>"+
                    "<input type='text' name='teamname' hidden value='{{ Session::get('teamname')}}'/>"+
                    "<p>"+answer[i]+"</p>"+ 
                    "</form>";	
                } 
            }else if(type == "standard__question"){
                text0 += "<form action='/playquiz/answer' method='post' id='"+answerId[i]+"' enctype='multipart/form-data' role='main' class='col-md-6 col-3 single__answer bg-white  mb-md-3 px-3 py-4 text-center mx-2 answers '>"+
                "<div class='d-block'>"+    
                "<div class='form-group'>"+
                    "<input name='_token' value='{{ csrf_token() }}' type='hidden'>"+
                    "<input type='text' name='answer_id' hidden value='"+answerId[0]+"'/>"+
                    "<input type='text' name='type' hidden value=2 />"+
                    "<input type='text' name='question' hidden value='"+questionId+"'/>"+
                    "<input type='text' name='round' hidden value='"+roundId+"'/>"+
                    "<input type='text' name='quiz' hidden value='"+quizId+"'/>"+
                    "<input type='text' name='teamname' hidden value='{{ Session::get('teamname')}}'/>"+
                    "<input type='text' class='form-control' name='answer' placeholder='Enter answer'/>"+
                    "</div>"+
                   "<p>OR</p>"+
                    /*add media file start*/
                    "<div class='form-group'>"+
                    "<div class='form-row justify-content-center pt-3'>"+
						"<div class='col-md-8'>"+
								"<label class='d-block' for='upload__image__media__file'>Upload Media Answer"+
									"<input type='file' class='form-control-file' id='upload__image__media__file' value='Upload Media Answer ' name='media_file'>"+
                                "</label>"+
						"</div>"+
					"</div>"+
                      "</div>"+
                      "</div>"+

                        "</form>";
                    /*add media file end*/	 
            }else if(type == "numeric__question"){
                text0 += "<form action='/playquiz/answer' method='post' name='form' id='"+answerId[i]+"' class='col-md-3 single__answer bg-white  mb-md-3 px-3 py-4 text-center mx-2 answers '>"+
                    "<div class='form-group'>"+
                    "<input name='_token' value='{{ csrf_token() }}' type='hidden'>"+
                    "<input type='text' name='answer_id' hidden value='"+answerId[0]+"'/>"+

                    "<input type='text' name='type' hidden value=3 />"+

                    "<input type='text' name='question' hidden value='"+questionId+"'/>"+
                    "<input type='text' name='round' hidden value='"+roundId+"'/>"+
                    "<input type='text' name='quiz' hidden value='"+quizId+"'/>"+
                    "<input type='text' name='teamname' hidden value='{{ Session::get('teamname')}}'/>"+
                    "<input type='number' class='form-control' name='answer' placeholder='Enter answer'/>"+
                    "</div>"+
                    "</form>";	
            }


            text0 += "</div> <div class='break'></div>"+
                "<div id='resub1' class='justify-content-center row'>"+
                    "<div class='' id='resub' >"+
                        "<br><a class='answer_submit btn btn-primary d-block d-lg-inline-block card__from__modal'>Submit Answer</a>"+
                    "</div>"+
                "</div>";

            $('#all-answer').empty();
            $('#all-answer').append(text0);
            $('#ques').empty();
            $('#ques').append(textq);
            $('h4.questionno').text(message.text[0]);
            $('h4.notification').text('');

            if(timeon==0 || timeon==null){
                $(".timer").html("Not set");
                sessionStorage.setItem("stop", "stop");
            }else{
                var y=timeon;
                var sec= y,
                countDiv    = document.getElementById("timer"),
                secpass;
                countDown   = setInterval(function () {
                    'use strict';
                    secpass();
                }, 1000);
            }

            var channel2 = pusher.subscribe('my-channel1');
            channel2.bind('form-submitted1', function(data) {
                var quizId = data.text;
                var qid=$('#quizid').text();
                if(parseInt(quizId)===parseInt(qid)){
                    swal("Teacher Stoped your Submition !",'you can not submit answer...', "danger")
                    $('#resub').css('cursor','not-allowed');
                    $("#resub").css("pointer-events", "none");
                    $('#resub').css('opacity','0.4');
                    $(".timer").html("Teacher Stoped");
                    sessionStorage.setItem("stop", null);
                    sessionStorage.setItem("nowtimeon", null);
                    clearInterval(countDown);
                }
            });
            var channel3 = pusher.subscribe('my-channel2');
            channel3.bind('form-submitted2', function(data) {
                var quizId = data.text;
                var qid=$('#quizid').text();
                if(parseInt(quizId)===parseInt(qid)){
                    swal("Teacher Paused Timer !",'you will get more seconds...', "info")
                    $(".timer").html("Teacher Paused");
                    sessionStorage.setItem("nowtimeon", null);
                    clearInterval(countDown);
                }
            });
    
            var channel4 = pusher.subscribe('my-channel3');
            channel4.bind('form-submitted3', function(data) {
                swal("Teacher share your Answer !",'you can get your results...', "info");
                qustno=issueq.length-1;
                quseee=issueq.length-1;
                $("#next").hide();
                if(quseee!=0){
                    $("#pre").show();
                }
                var qid=$('#quizid').text();
                var message = data;
                var questionId=message.text[4]; 
                var an=message.text[1];
                an=an.slice(0, -1);
                var answer=an.split("/");
                var answerId=message.text[3].split("/");
                var roundId=message.text[5];
                var quizId=message.text[6];
                var type=message.text[7];

                if(message.text[9]){
                    var media_type=message.text[9].split("/");}
                if(message.text[10]){
                    var media_link=message.text[10].split("**");}
                if(message.text[11]){
                    var media_path=message.text[11].split("**");}

                //var coans=issueq[quseee][12];
                var correctanswer=message.text[8];
                var pan=[questionId,"",""];
                putanswer=JSON.parse(sessionStorage.getItem("putanswer"));
                var len=putanswer.length;
                var x=0;
                for(var i=0;i<len;i++){
                    if(parseInt(putanswer[i][0])==parseInt(questionId)){
                        putanswer[i][2]=correctanswer;
                    }
                }
                sessionStorage.setItem("putanswer", JSON.stringify(putanswer));
              
                if(parseInt(quizId)===parseInt(qid)){
                    var text0 ='';
                    if(!media_type){
                var textq="<div id='resub3' class='col-12 media__container p-0 mb-5'>"+
                    "<img class='q-img' src='{{asset('site_design/images/homepage__logo.png')}}' height='170px'>"+
                    "</div>"+
                    "<div class='col-12 text-center'>"+
                    "<h4 class='bernhard notification'>Not submitted</h4>" +
                    "</div>"+
                    "<div  class='col-12 the__question text-center mB-2'>"+
                    "<h4 class='questionno' id='' style='min-width:50vw !important;'>  </h4>"+
                    "</div>";
            }
            else if(media_type[0] == 'image'){

                if(!media_path[0]){
                    var textq="<div id='resub3' class='col-12 media__container p-0 mb-5'>"+
                    "<img class='q-img' src='"+media_link[0]+"' >"+
                    "</div>"+
                    "<div class='col-12 text-center'>"+
                    "<h4 class='bernhard notification'>Not submitted</h4>" +
                    "</div>"+
                    "<div  class='col-12 the__question text-center mB-2'>"+
                    "<h4 class='questionno' id='' style='min-width:50vw !important;'>  </h4>"+
                    "</div>";                }

else{

                var textq="<div id='resub3' class='col-12 media__container p-0 mb-5'>"+
                    "<img class='q-img' src='{{asset('')}}"+media_path[0]+"' >"+
                    "</div>"+
                    "<div class='col-12 text-center'>"+
                    "<h4 class='bernhard notification'>Not submitted</h4>" +
                    "</div>"+
                    "<div  class='col-12 the__question text-center mB-2'>"+
                    "<h4 class='questionno' id='' style='min-width:50vw !important;'>  </h4>"+
                    "</div>";
}
            }else if(media_type[0] == 'audio'){
                if(!media_path[0]){
                var textq="<div id='resub3' class='col-12 media__container p-0 mb-5'>"+
                "<iframe height='225px' src='"+media_link[0]+"'> </iframe>"+
                    "</div>"+
                    "<div class='col-12 text-center'>"+
                    "<h4 class='bernhard notification'>Not submitted</h4>" +
                    "</div>"+
                    "<div  class='col-12 the__question text-center mB-2'>"+
                    "<h4 class='questionno' id='' style='min-width:50vw !important;'>  </h4>"+
                    "</div>";
                }
                else{
                    var textq="<div id='resub3' class='col-12 media__container p-0 mb-5'>"+
                    "<audio class='q-img' controls> <source src='{{asset('')}}"+media_path[0]+"' type='audio/mpeg'> </audio>"+
                    "</div>"+
                    "<div class='col-12 text-center'>"+
                    "<h4 class='bernhard notification'>Not submitted</h4>" +
                    "</div>"+
                    "<div  class='col-12 the__question text-center mB-2'>"+
                    "<h4 class='questionno' id='' style='min-width:50vw !important;'>  </h4>"+
                    "</div>";
                }
            }else if(media_type[0] == 'video'){
                if(!media_path[0]){
                var textq="<div id='resub3' class='col-12 media__container p-0 mb-5 text-center position-relative'>"+
                   "<iframe height='300px' width='600px'  src='"+media_link[0]+"'> </iframe>"+
                    "</div>"+
                    "<div class='col-12 text-center'>"+
                    "<h4 class='bernhard notification'>Not submitted</h4>" +
                    "</div>"+
                    "<div  class='col-12 the__question text-center mB-2'>"+
                    "<h4 class='questionno' id='' style='min-width:50vw !important;'>  </h4>"+
                    "</div>";
                }
                else{
                    var textq="<div id='resub3' class='col-12 media__container p-0 mb-5 text-center position-relative'>"+
                    "<video class='justify-content-center align-self-center' controls> <source src='{{asset('')}}"+media_path[0]+"' type='audio/mpeg' > </video>"+
                    "</div>"+
                    "<div class='col-12 text-center'>"+
                    "<h4 class='bernhard notification'>Not submitted</h4>" +
                    "</div>"+
                    "<div  class='col-12 the__question text-center mB-2'>"+
                    "<h4 class='questionno' id='' style='min-width:50vw !important;'>  </h4>"+
                    "</div>";
                }
            }
                    if(type == "multiple__choice__question"){
                        for (var i = 0; i < answer.length; i++) {
                            var x="single__answer_white";
                            if(putanswer[quseee][1]==""){
                                if(putanswer[quseee][2]==answerId[i]){
                                    x="single__answer_warning";
                                }else{
                                    x="single__answer_white";
                                }
                            }else{
                                if(putanswer[quseee][1]==putanswer[quseee][2]){
                                    if(answerId[i]==putanswer[quseee][1]){
                                        x="single__answer_correct";
                                    }else{
                                        x="single__answer_white";
                                    }
                                }else{
                                    if(answerId[i]==putanswer[quseee][1]){
                                        x="single__answer_wrong";
                                    }else if(answerId[i]==putanswer[quseee][2]){
                                        x="single__answer_correct";
                                    }else{
                                        x="single__answer_white";
                                    }
                                }
                            }
                        
                            text0 += "<form action='/playquiz/answer' method='post' name='form' id='"+answerId[i]+"' class='col-md-3 single__answer "+x+"  mb-md-3 px-3 py-4 text-center mx-2 answers '>"+
                            "<input name='_token' value='{{ csrf_token() }}' type='hidden'>"+
                            "<input type='text' name='type' hidden value=1 />"+

                            "<input type='text' name='answer' hidden value='"+answer[i]+"'/>"+
                            "<input type='text' name='answer_id' hidden value='"+answerId[i]+"'/>"+

                            "<input type='text' name='question' hidden value='"+questionId+"'/>"+
                            "<input type='text' name='round' hidden value='"+roundId+"'/>"+
                            "<input type='text' name='quiz' hidden value='"+quizId+"'/>"+
                            "<input type='text' name='teamname' hidden value='{{ Session::get('teamname')}}'/>"+
                            "<p>"+answer[i]+"</p>"+ 
                            "</form>";	
                                
                        } 
                    }else if(type == "standard__question"){
                        var x="single__answer_white";
                        var coans=Object.values(message.text[12][0]);
                        var teamname = '{{ Session::get('teamname')}}';
                        var len=message.text[12].length;
                        
                        var correct=0;
                        var ttt="";
                        var an0="";
                         
                        for(var i=0;i<len;i++){
                            if(Object.values(message.text[12][i])[3]==teamname){
                                correct=Object.values(message.text[12][i])[5];
                                an0=Object.values(message.text[12][i])[4];
                            }
                        }
                        var answer="non";
                        
                        if(correct==1){
                            answer=an0;
                            x="single__answer_correct";
                        }else if(correct==0){
                            answer=an0;
                            x="single__answer_wrong";
                            ttt = "<p class='col-md-3 single__answer single__answer_correct  mb-md-3 px-3 py-4 text-center mx-2' style='color:black;font-weight: bold;'>"+an+"</p>";
                        }else{
                            answer="non";
                            x="single__answer_white";
                        }
                        
                        text0 += "<form  method='post' name='form'  class='col-md-3 single__answer "+x+"  mb-md-3 px-3 py-4 text-center mx-2 answers '>"+
                            "<div class='form-group'>"+
                            "<input name='_token' value='{{ csrf_token() }}' type='hidden'>"+
                            "<input type='text' name='answer_id' hidden value='"+answerId[0]+"'/>"+

                            "<input type='text' name='type' hidden value=3 />"+

                            "<input type='text' name='question' hidden value='"+questionId+"'/>"+
                            "<input type='text' name='round' hidden value='"+roundId+"'/>"+
                            "<input type='text' name='quiz' hidden value='"+quizId+"'/>"+
                            "<input type='text' name='teamname' hidden value='{{ Session::get('teamname')}}'/>"+
                            "<input type='number' class='form-control' name='answer' value='"+answer+"' placeholder='Enter answer'/>"+
                            "</div>"+
                            "</form>"+ttt;	
                    
                    }else if(type == "numeric__question"){
                        var x="single__answer_white";
                        var coans=Object.values(message.text[12][0]);
                        var teamname = '{{ Session::get('teamname')}}';
                        var len=message.text[12].length;
                        
                        var correct=0;
                        var ttt="";
                        var an0="";
                        for(var i=0;i<len;i++){
                            if(Object.values(message.text[12][i])[3]==teamname){
                                correct=Object.values(message.text[12][i])[5];
                                an0=Object.values(message.text[12][i])[4];
                            }
                        }
                        var answer="non";
                        
                        if(correct==1){
                            answer=Object.values(message.text[12][i])[4];
                            x="single__answer_correct";
                        }else if(correct==0){
                            answer=Object.values(message.text[12][i])[4];
                            x="single__answer_wrong";
                            ttt = "<p class='col-md-3 single__answer single__answer_correct  mb-md-3 px-3 py-4 text-center mx-2' style='color:black;font-weight: bold;'>"+an+"</p>";
                        }else{
                            answer="non";
                            x="single__answer_white";
                        }
                        
                        text0 += "<form  method='post' name='form'  class='col-md-3 single__answer "+x+"  mb-md-3 px-3 py-4 text-center mx-2 answers '>"+
                            "<div class='form-group'>"+
                            "<input name='_token' value='{{ csrf_token() }}' type='hidden'>"+
                            "<input type='text' name='answer_id' hidden value='"+answerId[0]+"'/>"+

                            "<input type='text' name='type' hidden value=3 />"+

                            "<input type='text' name='question' hidden value='"+questionId+"'/>"+
                            "<input type='text' name='round' hidden value='"+roundId+"'/>"+
                            "<input type='text' name='quiz' hidden value='"+quizId+"'/>"+
                            "<input type='text' name='teamname' hidden value='{{ Session::get('teamname')}}'/>"+
                            "<input type='number' class='form-control' name='answer' value='"+answer+"' placeholder='Enter answer'/>"+
                            "</div>"+
                            "</form>"+ttt;
                        
                        
                    }
                    $('#all-answer').empty();
                    $('#all-answer').append(text0);
                    
                    $('#ques').empty();
                    $('#ques').append(textq);
                    
                    $('h4.questionno').text(message.text[0]);
                    $('h4.notification').text('');
                }

            });
            
        var $box=null;
        $('.single__answer').click(function() {
            if ($box == null) {
                $box = $(this);
                $box.css("box-shadow","3px 3px 15px #7343C1, -1px -1px 5px rgba(0, 0, 0, 0.045)");
                $box.attr('id', 'answer');

            } 
            else  {
                $box.css("box-shadow","");
                $box.attr('id', 'disable');

            if($box != $(this))
            {
                $box = $(this);
                $box.css("box-shadow","3px 3px 15px #7343C1, -1px -1px 5px rgba(0, 0, 0, 0.045)");
                $box.attr('id', 'answer');

            }
            else
                $box = null;
            }
        });

        $('.answer_submit').on('click',function(e){
            e.preventDefault();  
            
            var answer = $('#answer');
            var aa=$('#answer').serializeArray();
            sessionStorage.setItem("stop", null);

            if(answer.length == 0){
                swal("Please select answer !",'select or submit answer', "danger")
            }else{
                putanswer=JSON.parse(sessionStorage.getItem("putanswer"));
                var len=putanswer.length;
                if(type == "multiple__choice__question"){
                    putanswer[len-1][1]=aa[3].value;
                }else{
                    putanswer[len-1][1]=aa[6].value;
                }
                sessionStorage.setItem("putanswer", JSON.stringify(putanswer));
                $('#resub').css('cursor','not-allowed');
                $("#resub").css("pointer-events", "none");
                $('#resub').css('opacity','0.4');
                $('.single__answer').css('cursor','not-allowed');
                $('.single__answer').css('pointer-events','none');
                 
                 /*before refresh */
                 
                 var formdata = new FormData($("#answer")[0]);

                $.ajax({
                    type: "POST",
                    url: "/playquiz/answer",
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                    data: formdata,
                        processData: false,
                        contentType: false,
                        cache: false,
                        enctype: 'multipart/form-data',
                    
                    success: function(data) {
                        swal("Answer Submited!",'wait for the next ...', "success")

                        ;
                    },

                });
            } 
        });
    }
            

    function secpass() {
        'use strict';
       
        var min     = Math.floor(sec / 60),
            remSec  = sec % 60;
        
        if (remSec < 10) {
            
            remSec = '0' + remSec;
        
        }
        if (min < 10) {
            
            min = '0' + min;
        
        }
        
        $(".timer").html(min + ":" + remSec);
        sessionStorage.setItem("nowtimeon", JSON.stringify(min + ":" + remSec));
        if (sec > 0) {
            
            sec = sec - 1;
            
        } else {
            all.addClass('cursor_not');
            clearInterval(countDown);
            $(".timer").html("Time Out");
            sessionStorage.setItem("nowtimeon", null);
            //$("#resub").css("display", "none");
            //tyle="opacity: 0.4;
            //
            $('.single__answer').css('cursor','not-allowed');
            $('.single__answer').css('pointer-events','none');


            $('#resub').css('cursor','not-allowed');
            $("#resub").css("pointer-events", "none");
            $('#resub').css('opacity','0.4');
        
        }
    }
  
    });
});
$("#exit").click(function() {
    
    window.location.replace("/exitquiz");
});
</script>