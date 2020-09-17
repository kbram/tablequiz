
<script type="text/javascript">
//bavaram

$(document).ready(function() { 
    $(".timer").html("Wait.....");
    

    //with session refresh

    var issueq=JSON.parse(sessionStorage.getItem("issuequestion"));
    var time=JSON.parse(sessionStorage.getItem("nowtimeon"));
    var timeon=0;
    if(time!=null){
        var splity=time.split(":");
	    timeon=parseInt(splity[0])*60+parseInt(splity[1]);
    }
    var all = $(".single__answer");


    //alert(timeon);
    var countDown;
    var quseee=1;
    var qustno=1;
    
    if(issueq!=null){
        qustno=issueq.length-1;
        quseee=issueq.length-1;

        var an=issueq[quseee][1];
	    
		an=an.slice(0, -1);
		var answer=an.split("/");
		var answerId=issueq[quseee][3].split("/");
		var questionId=issueq[quseee][4];
		var roundId=issueq[quseee][5];
        var quizId=issueq[quseee][6];
        
        var type=issueq[quseee][7];

        var text0 ='';
        var textq="<div id='resub3' class='col-12 media__container p-0 mb-5'>"+
			"<img class='q-img' src='{{asset('site_design/images/homepage__logo.png')}}' height='170px'>"+
			"</div>"+
			"<div class='col-12 text-center'>"+
			"<h4 class='bernhard notification'>Not submitted</h4>" +
			"</div>"+
			"<div  class='col-12 the__question text-center mB-2'>"+
			"<h4 class='questionno' style='min-width:50vw !important;'>  </h4>"+
            "</div>";

        if(type == "multiple__choice__question"){
            for (var i = 0; i < answer.length; i++) {
                text0 += "<form action='/playquiz/answer' method='post' name='form' id='"+answerId[i]+"' class='col-md-3 single__answer bg-white  mb-md-3 px-3 py-4 text-center mx-2 answers '>"+
                "<input name='_token' value='{{ csrf_token() }}' type='hidden'>"+
                "<input type='text' name='answer' hidden value='"+answerId+"'/>"+
                "<input type='text' name='question' hidden value='"+questionId+"'/>"+
                "<input type='text' name='round' hidden value='"+roundId+"'/>"+
                "<input type='text' name='quiz' hidden value='"+quizId+"'/>"+
                "<p>"+answer[i]+"</p>"+ 
                "</form>";	
            } 
        }else if(type == "standard__question"){
            text0 += "<form action='/playquiz/answer' method='post' name='form' id='"+answerId[i]+"' class='col-md-3 single__answer bg-white  mb-md-3 px-3 py-4 text-center mx-2 answers '>"+
                "<div class='form-group'>"+
                "<input name='_token' value='{{ csrf_token() }}' type='hidden'>"+
                "<input type='text' name='question' hidden value='"+questionId+"'/>"+
                "<input type='text' name='round' hidden value='"+roundId+"'/>"+
                "<input type='text' name='quiz' hidden value='"+quizId+"'/>"+
                "<input type='text' class='form-control' name='question' placeholder='Enter answer'/>"+
                "</div>"+
                "</form>";	
        }else if(type == "numeric__question"){
            text0 += "<form action='/playquiz/answer' method='post' name='form' id='"+answerId[i]+"' class='col-md-3 single__answer bg-white  mb-md-3 px-3 py-4 text-center mx-2 answers '>"+
                "<div class='form-group'>"+
                "<input name='_token' value='{{ csrf_token() }}' type='hidden'>"+
                "<input type='text' name='question' hidden value='"+questionId+"'/>"+
                "<input type='text' name='round' hidden value='"+roundId+"'/>"+
                "<input type='text' name='quiz' hidden value='"+quizId+"'/>"+
                "<input type='number' class='form-control' name='question' placeholder='Enter answer'/>"+
                "</div>"+
                "</form>";	
        }

        //console.log(answer);
        text0 += "</div> <div class='break'></div>";
        if(time!=null && quseee==qustno){
            text0 += "<div id='resub1' class='justify-content-center row'>"+
                "<div class='' id='resub' >"+
                    "<br><a class='btn btn-primary d-block d-lg-inline-block card__from__modal' onclick='document.getElementById("+answerId[i]+").submit()'>Submit Answer</a>"+
                "</div>"+
            "</div>";
            $('#all-answer').empty();
            $('#all-answer').append(text0);

            $('#ques').empty();
            $('#ques').append(textq);

            $('h4.questionno').text(issueq[quseee][0]);
            $('h4.notification').text('');
            var $box=null;
            //alert("dfsdfsd")
            $('.single__answer')
                .click(function() {
                console.log("click on single answer");
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
                console.log(answer.length);
                if(answer.length == 0){

                    alert('please select answer');
                }
                else{
                $.ajax({
                    type: "POST",
                    url: "/playquiz/answer",
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                    data: $('#answer').serialize(),
                    
                    success: function(data) {
                        swal("Here's a message!");
                    },

                    });
                }
            });

        }
        
        
       
        

        var y=timeon;
        var sec= y,
        countDiv    = document.getElementById("timer"),
        secpass;
        countDown   = setInterval(function () {
            'use strict';
            secpass0();
        }, 1000);

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

    }
    
    
	$("#pre").click(function(){
        time=JSON.parse(sessionStorage.getItem("nowtimeon"));
        quseee=quseee-1;
        var an=issueq[quseee][1];
		
		an=an.slice(0, -1);
		var answer=an.split("/");
		var answerId=issueq[quseee][3].split("/");
		var questionId=issueq[quseee][4];
		var roundId=issueq[quseee][5];
		var quizId=issueq[quseee][6];
		//alert("dfsdfsdfsdfsdfsddddddddddddd");
        var type=issueq[quseee][7];
        var text0='';
        var textq="<div id='resub3' class='col-12 media__container p-0 mb-5'>"+
			"<img class='q-img' src='{{asset('site_design/images/homepage__logo.png')}}' height='170px'>"+
			"</div>"+
			"<div class='col-12 text-center'>"+
			"<h4 class='bernhard notification'>Not submitted</h4>" +
			"</div>"+
			"<div  class='col-12 the__question text-center mB-2'>"+
			"<h4 class='questionno' style='min-width:50vw !important;'>  </h4>"+
            "</div>";
            
            if(type == "multiple__choice__question"){
                for (var i = 0; i < answer.length; i++) {
                    text0 += "<form action='/playquiz/answer' method='post' name='form' id='"+answerId[i]+"' class='col-md-3 single__answer bg-white  mb-md-3 px-3 py-4 text-center mx-2 answers '>"+
                    "<input name='_token' value='{{ csrf_token() }}' type='hidden'>"+
                    "<input type='text' name='answer' hidden value='"+answerId+"'/>"+
                    "<input type='text' name='question' hidden value='"+questionId+"'/>"+
                    "<input type='text' name='round' hidden value='"+roundId+"'/>"+
                    "<input type='text' name='quiz' hidden value='"+quizId+"'/>"+
                    "<p>"+answer[i]+"</p>"+ 
                    "</form>";	
                } 
            }else if(type == "standard__question"){
                text0 += "<form action='/playquiz/answer' method='post' name='form' id='"+answerId[i]+"' class='col-md-3 single__answer bg-white  mb-md-3 px-3 py-4 text-center mx-2 answers '>"+
                    "<div class='form-group'>"+
                    "<input name='_token' value='{{ csrf_token() }}' type='hidden'>"+
                    "<input type='text' name='question' hidden value='"+questionId+"'/>"+
                    "<input type='text' name='round' hidden value='"+roundId+"'/>"+
                    "<input type='text' name='quiz' hidden value='"+quizId+"'/>"+
                    "<input type='text' class='form-control' name='question' placeholder='Enter answer'/>"+
                    "</div>"+
                    "</form>";	
            }else if(type == "numeric__question"){
                text0 += "<form action='/playquiz/answer' method='post' name='form' id='"+answerId[i]+"' class='col-md-3 single__answer bg-white  mb-md-3 px-3 py-4 text-center mx-2 answers '>"+
                    "<div class='form-group'>"+
                    "<input name='_token' value='{{ csrf_token() }}' type='hidden'>"+
                    "<input type='text' name='question' hidden value='"+questionId+"'/>"+
                    "<input type='text' name='round' hidden value='"+roundId+"'/>"+
                    "<input type='text' name='quiz' hidden value='"+quizId+"'/>"+
                    "<input type='number' class='form-control' name='question' placeholder='Enter answer'/>"+
                    "</div>"+
                    "</form>";	
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
    $("#next").click(function(){
        time=JSON.parse(sessionStorage.getItem("nowtimeon"));
        quseee=quseee+1;
        var an=issueq[quseee][1];
		
		an=an.slice(0, -1);
		var answer=an.split("/");
		var answerId=issueq[quseee][3].split("/");
		var questionId=issueq[quseee][4];
		var roundId=issueq[quseee][5];
		var quizId=issueq[quseee][6];
		//alert("dfsdfsdfsdfsdfsddddddddddddd");
        var type=issueq[quseee][7];
        var text0 = '';
        var textq="<div id='resub3' class='col-12 media__container p-0 mb-5'>"+
			"<img class='q-img' src='{{asset('site_design/images/homepage__logo.png')}}' height='170px'>"+
			"</div>"+
			"<div class='col-12 text-center'>"+
			"<h4 class='bernhard notification'>Not submitted</h4>" +
			"</div>"+
			"<div  class='col-12 the__question text-center mB-2'>"+
			"<h4 class='questionno' style='min-width:50vw !important;'>  </h4>"+
            "</div>";
            
            if(type == "multiple__choice__question"){
                for (var i = 0; i < answer.length; i++) {
                    text0 += "<form action='/playquiz/answer' method='post' name='form' id='"+answerId[i]+"' class='col-md-3 single__answer bg-white  mb-md-3 px-3 py-4 text-center mx-2 answers '>"+
                    "<input name='_token' value='{{ csrf_token() }}' type='hidden'>"+
                    "<input type='text' name='answer' hidden value='"+answerId+"'/>"+
                    "<input type='text' name='question' hidden value='"+questionId+"'/>"+
                    "<input type='text' name='round' hidden value='"+roundId+"'/>"+
                    "<input type='text' name='quiz' hidden value='"+quizId+"'/>"+
                    "<p>"+answer[i]+"</p>"+ 
                    "</form>";	
                } 
            }else if(type == "standard__question"){
                text0 += "<form action='/playquiz/answer' method='post' name='form' id='"+answerId[i]+"' class='col-md-3 single__answer bg-white  mb-md-3 px-3 py-4 text-center mx-2 answers '>"+
                    "<div class='form-group'>"+
                    "<input name='_token' value='{{ csrf_token() }}' type='hidden'>"+
                    "<input type='text' name='question' hidden value='"+questionId+"'/>"+
                    "<input type='text' name='round' hidden value='"+roundId+"'/>"+
                    "<input type='text' name='quiz' hidden value='"+quizId+"'/>"+
                    "<input type='text' class='form-control' name='question' placeholder='Enter answer'/>"+
                    "</div>"+
                    "</form>";	
            }
         
            else if(type == "numeric__question"){
                text0 += "<form action='/playquiz/answer' method='post' name='form' id='"+answerId[i]+"' class='col-md-3 single__answer bg-white  mb-md-3 px-3 py-4 text-center mx-2 answers '>"+
                    "<div class='form-group'>"+
                    "<input name='_token' value='{{ csrf_token() }}' type='hidden'>"+
                    "<input type='text' name='question' hidden value='"+questionId+"'/>"+
                    "<input type='text' name='round' hidden value='"+roundId+"'/>"+
                    "<input type='text' name='quiz' hidden value='"+quizId+"'/>"+
                    "<input type='number' class='form-control' name='question' placeholder='Enter answer'/>"+
                    "</div>"+
                    "</form>";	
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


    //when pusher run

	Pusher.logToConsole = true;

	var pusher = new Pusher('87436df86baf66b2192a', {
		cluster: 'ap2'
	});
    var channel1 = pusher.subscribe('my-channel1');
    channel1.bind('form-submitted1', function(data) {
        alert("Teacher Stoped your Submition");
        $('#resub').css('cursor','not-allowed');
        $("#resub").css("pointer-events", "none");
        $('#resub').css('opacity','0.4');
        $(".timer").html("Teacher Stoped");
        clearInterval(countDown);
    });
    var channel1 = pusher.subscribe('my-channel2');
    channel1.bind('form-submitted2', function(data) {
        alert("Teacher Paused");
        /*$('#resub').css('cursor','not-allowed');
        $("#resub").css("pointer-events", "none");
        $('#resub').css('opacity','0.4');
        $(".timer").html("Teacher Paused");

        $("#resub").css('display','none');
        $("#resub2").css('display','none');
        $("#resub3").css('display','none');*/

        

        $(".timer").html("Teacher Paused");
        sessionStorage.setItem("nowtimeon", null);
        //var text11="<h1>Quiz Time is Paused !!!</h1>";
        //$('#resub1').empty();
        //$('#resub1').append(text11);
        clearInterval(countDown);
    });
    
	var channel = pusher.subscribe('my-channel');
	channel.bind('form-submitted', function(data) {
        var qid=$('#quizid').text();
        
        var message = data;
		qustno=qustno+1;
		quseee=qustno;
		issueq=JSON.parse(sessionStorage.getItem("issuequestion"));
		if(issueq==null){
			var x=[[]];
			issueq=x;
		}

		issueq.push(message.text);
		sessionStorage.setItem("issuequestion", JSON.stringify(issueq));

		
		var an=message.text[1];
		
		an=an.slice(0, -1);
		var answer=an.split("/");
		var answerId=message.text[3].split("/");
		var questionId=message.text[4];
		var roundId=message.text[5];
		var quizId=message.text[6];
        var type=message.text[7];
        timeon=message.text[8];
        //alert("quizid:"+quizId);
        //alert("qid:"+qid);

        // if(parseInt(quizId)==parseInt(qid)){

                
            var text0 ='';
             
        var textq="<div id='resub3' class='col-12 media__container p-0 mb-5'>"+
			"<img class='q-img' src='{{asset('site_design/images/homepage__logo.png')}}' height='170px'>"+
			"</div>"+
			"<div class='col-12 text-center'>"+
			"<h4 class='bernhard notification'>Not submitted</h4>" +
			"</div>"+
			"<div  class='col-12 the__question text-center mB-2'>"+
			"<h4 class='questionno' style='min-width:50vw !important;'>  </h4>"+
            "</div>";

            if(type == "multiple__choice__question"){
                for (var i = 0; i < answer.length; i++) {
                text0 += "<form action='/playquiz/answer' method='post' name='form' id='"+answerId[i]+"' class='col-md-3 single__answer bg-white  mb-md-3 px-3 py-4 text-center mx-2 answers '>"+
                "<input name='_token' value='{{ csrf_token() }}' type='hidden'>"+
                "<input type='text' name='answer' hidden value='"+answerId[i]+"'/>"+
                "<input type='text' name='question' hidden value='"+questionId+"'/>"+
                "<input type='text' name='round' hidden value='"+roundId+"'/>"+
                "<input type='text' name='quiz' hidden value='"+quizId+"'/>"+
                "<p>"+answer[i]+"</p>"+ 
                "</form>";	
                } 
            }
            else if(type == "standard__question"){
                text0 += "<form action='/playquiz/answer' method='post' name='form' id='"+answerId[i]+"' class='col-md-3 single__answer bg-white  mb-md-3 px-3 py-4 text-center mx-2 answers '>"+
                    "<div class='form-group'>"+
                    "<input name='_token' value='{{ csrf_token() }}' type='hidden'>"+
                    "<input type='text' name='question' hidden value='"+questionId+"'/>"+
                    "<input type='text' name='round' hidden value='"+roundId+"'/>"+
                    "<input type='text' name='quiz' hidden value='"+quizId+"'/>"+
                    "<input type='text' class='form-control' name='question' placeholder='Enter answer'/>"+
                    "</div>"+
                    "</form>";	
            }else if(type == "numeric__question"){
                text0 += "<form action='/playquiz/answer' method='post' name='form' id='"+answerId[i]+"' class='col-md-3 single__answer bg-white  mb-md-3 px-3 py-4 text-center mx-2 answers '>"+
                    "<div class='form-group'>"+
                    "<input name='_token' value='{{ csrf_token() }}' type='hidden'>"+
                    "<input type='text' name='question' hidden value='"+questionId+"'/>"+
                    "<input type='text' name='round' hidden value='"+roundId+"'/>"+
                    "<input type='text' name='quiz' hidden value='"+quizId+"'/>"+
                    "<input type='number' class='form-control' name='question' placeholder='Enter answer'/>"+
                    "</div>"+
                    "</form>";	
             }


                text0 += "</div> <div class='break'></div>"+
                "<div id='resub1' class='justify-content-center row'>"+
                    "<div class='' id='resub' >"+
                        "<br><a class='answer_submit btn btn-primary d-block d-lg-inline-block card__from__modal'>Submit Answer</a>"+
                    "</div>"+
                "</div>"+
                "</div>"+
            "</div>";
        
        

            $('#all-answer').empty();
            $('#all-answer').append(text0);
            
            $('#ques').empty();
            $('#ques').append(textq);
            
            $('h4.questionno').text(message.text[0]);
            $('h4.notification').text('');

                //document.getElementById("demo").innerHTML=JSON.parse(sessionStorage.getItem("issuequestion"));


            //var x=1;
            var y=timeon;
            var sec= y,
            countDiv    = document.getElementById("timer"),
            secpass;
            countDown   = setInterval(function () {
                'use strict';
                secpass();
            }, 1000);

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
            
            var channel1 = pusher.subscribe('my-channel1');
            channel1.bind('form-submitted1', function(data) {
                alert("Teacher Stoped your Submition");
                $('#resub').css('cursor','not-allowed');
                $("#resub").css("pointer-events", "none");
                $('#resub').css('opacity','0.4');
                $(".timer").html("Teacher Stoped");
                sessionStorage.setItem("nowtimeon", null);
                clearInterval(countDown);
            });
            var channel1 = pusher.subscribe('my-channel2');
            channel1.bind('form-submitted2', function(data) {
                alert("Teacher Paused");
               // $('#resub').css('cursor','not-allowed');
                //$("#resub").css("pointer-events", "none");
                //$('#resub').css('opacity','0.4');
                

                //$("#resub").css('display','none');
               // $("#resub2").css('display','none');
                //$("#resub3").css('display','none');

                //$('#all-answer').empty();
                $(".timer").html("Teacher Paused");
                sessionStorage.setItem("nowtimeon", null);
                //var text11="<h1>Quiz Time is Paused !!!</h1>";
                //$('#resub1').empty();
                //$('#resub1').append(text11);
                clearInterval(countDown);
            });


            //answer select


        var $box=null;

        $('.single__answer')
            .click(function() {
            console.log("click on single answer");
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
            console.log(answer.length);
            if(answer.length == 0){

                alert('please select answer');
            }
            else{
            $.ajax({
                type: "POST",
                url: "/playquiz/answer",
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                data: $('#answer').serialize(),
                
                success: function(data) {
                    swal("Here's a message!");
                },

                });
            }
        });
     // }
    });
    






});



</script>