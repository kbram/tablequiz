<script type="text/javascript">
  $(document).ready(function() {
    
    $("body").on('click','.SavePriceband',function(e) {
     
    e.preventDefault();
    var id=e.target.id;

    swal("Added !!!",'Another Price Band is added', "success");
    $.ajax({
        type: "POST",
        url: "{{route('update')}}",
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        data:{
             id   : id,
             get_from : $('#from'+id).val(), 
             get_to : $('#to'+id).val(), 
             get_cost : $('#cost'+id).val(), 
             type : $('#type'+id).val(),

             new_from : $(this).closest('.price-band-financials').find('.new-from').val(), 
             new_to :   $(this).closest('.price-band-financials').find('.new-to').val(),
             new_cost : $(this).closest('.price-band-financials').find('.new-cost').val(),
             band_type: $(this).closest('.price-band-financials').find('.band-type').val(), 

            
        },
        success: function(results) {

           $('#msg'+id).text('updated sucessfully');
           location.reload();
           setTimeout(function() {

        $("#msg"+id).text('')
    }, 1000);
        },
        error: function(result,error) {
         alert('error');
        
        },
       
      });
    });
    var i=1;

    /***delete method */
    $("body").on('click','.removePriceband',function(e) {     
     e.preventDefault();

    

     swal("Deleted !!!",'Price Band is deleted...', "danger")
     var idb=$(this).attr("id");
    
      if(idb=="question"){
        var x='<div class="row d-flex">'+
							'<span class="col-9">'+
							'<p id="noq"> No Questions Cost created yet! </p>'+
					  	
						
							'</div>	';
              $(this).closest('.dashboard__container').find('.financial-append').append(x);
      }else if(idb=="background"){
        var x='<div class="row d-flex">'+
							'<span class="col-9">'+
							'<p id="nob"> No Background Cost created yet! </p>'+
							
							'</div>';
              $(this).closest('.dashboard__container').find('.financial-append').append(x);
      }else if(idb=="participant"){
        var x='<div class="row d-flex">'+
							'<span class="col-9">'+
							'<p id="nop"> No price </p>'+
							
					
						'</div>';
              $(this).closest('.dashboard__container').find('.financial-append').append(x);
      }

      
      if($(this).closest('.price-band-financials').find(".pl").css("display")=="none"){
        //alert("fe");
        //$(this).closest('.dashboard__container').find('.financial-append').append(x);
         $(this).closest('.dashboard__container').find("#dem1").show();
         $(this).closest('.dashboard__container').find("#dem2").show();
         $(this).closest('.dashboard__container').find("#dem3").show();
         
      }

        var id=$(this).closest('.price-band-financials').find('.SavePriceband').attr("id");
      if(id==null){
        $(this).closest('.price-band-financials').remove();
        
      }
      else{
      $(this).closest('.price-band-financials').remove();
      $.ajax({
         type: "POST",
         url: "{{route('delete')}}",
         headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
         data:{
              id   : id,
             
         },
         success: function(results) {
           console.log("delete");

            $('#msg'+id).text('Deleted sucessfully');
            setTimeout(function() {
         $("#msg"+id).text('');
         

     }, 1000);

         },
         error: function(result,error) {
          alert('error');
         
         },
        
       });
      }
     });
   
     
$("body").delegate('.price-band-questions','click',function(e){
    e.preventDefault();
    var s="#addQuestionPrice"+i;
    var s1="#addQuestionPricesp"+i;
    $(s).hide();
    $('#noq').hide();
    $('#addQuestionPricedem').hide();
    $(this).closest('.dashboard__container').find(".price-band-questions").hide();
    $(s1).show();
    i=i+1;
    var s="addQuestionPrice"+i;
    var s1="addQuestionPricesp"+i;
  var addquestionprice='<form class="form-row pt-4 align-items-center mb-0 price-band-financials"><div class="col-4 col-md-1"> <span>From</span> </div> <div class="col-8 col-md-4 d-flex flex-row align-items-center justify-content-md-center"> <input maxlength="3" class="mr-2 mx-md-2 form-control flex-grow-1 new-from"> <span>to</span> <input maxlength="3" class="ml-2 mx-md-2 form-control flex-grow-1 new-to"> </div> <div class="col-4 col-md-3 pt-2 pt-md-0"><span style="line-height: 1.1" class="d-block">Question Cost</span><input class="band-type"  name="type" hidden type="text" value="questions costs"></div> <div class="col-8 col-md-4 pt-2 pt-md-0"> <div class="input-group"> <div class="input-group-prepend"> <span class="input-group-text">&euro;</span> </div> <input maxlength="10" class="form-control new-cost"> <button type="submit" maxlength="3" class="form-control ml-1 SavePriceband" value="" data-toggle="tooltip" title="Click to save your price band"><i class="fa fa-check-circle" style="color:blue"></i></button><button maxlength="3" class="form-control ml-1 removePriceband" value="" ><i class="fa fa-trash" style="color:grey"></i></button> <i class="fa fa-plus-circle col-2 price-band-questions mt-4 " id="'+s+'"></i><i class="col-2 pl" style="display:none;" id="'+s1+'"></i></div> </div> </form>';
    
  $(this).closest('.dashboard__container').find('.financial-append').append(addquestionprice);
  });  

var j=1;
$("body").delegate('.addBackgroundPrice','click',function(e){
  e.preventDefault();
    var s="#addBackgroundPrice"+j;
    var s1="#addBackgroundPricesp"+j;
    $(s).hide();
    $('#nob').hide();
    $(this).closest('.dashboard__container').find(".addBackgroundPrice").hide();
    $(s1).show();
    j=j+1;
    var s="addBackgroundPrice"+j;
    var s1="addBackgroundPricesp"+j;
  var addbackgroundsprice='<form class="form-row pt-4 align-items-center mb-0 price-band-financials"> <div class="col-4 col-md-1"> <span>From</span> </div> <div class="col-8 col-md-4 d-flex flex-row align-items-center justify-content-md-center"> <input maxlength="3" class="mr-2 mx-md-2 form-control flex-grow-1 new-from" > <span>to</span> <input maxlength="3" class="ml-2 mx-md-2 form-control flex-grow-1 new-to"> </div> <div class="col-4 col-md-3 pt-2 pt-md-0"> <span style="line-height: 1.1" class="d-block">Background Cost</span><input class="band-type" name="type" hidden type="text" value="backgrounds costs"></div> <div class="col-8 col-md-4 pt-2 pt-md-0"> <div class="input-group"> <div class="input-group-prepend"> <span class="input-group-text">&euro;</span> </div> <input maxlength="10" class="form-control new-cost"> <button type="submit" maxlength="3" class="form-control ml-1 SavePriceband" value="" data-toggle="tooltip" title="Click to save your price band"><i class="fa fa-check-circle" style="color:blue"></i></button> <button maxlength="3" class="form-control ml-1 removePriceband" value="" ><i class="fa fa-trash" style="color:grey"></i></button><i class="fa fa-plus-circle col-2 addBackgroundPrice mt-4" id="'+s+'"></i><i class="col-2 pl" style="display:none;" id="'+s1+'"></i> </div> </div> </form>'
  $(this).closest('.dashboard__container').find('.financial-append').append(addbackgroundsprice);
 }); 
  
 var k=1;
$("body").delegate('.addParticipantPrice','click',function(e){
  e.preventDefault();
    var s="#addParticipantPrice"+k;
    var s1="#addParticipantPricesp"+k;
    $(s).hide();
    $('#nop').hide();
    $(this).closest('.dashboard__container').find(".addParticipantPrice").hide();
    $(s1).show();
    k=k+1;
    var s="addParticipantPrice"+k;
    var s1="addParticipantPricesp"+k;
  var addparticipantprice='<form class="form-row pt-4 align-items-center mb-0 price-band-financials"><div class="col-4 col-md-1"> <span>From</span> </div> <div class="col-8 col-md-4 d-flex flex-row align-items-center justify-content-md-center"> <input maxlength="3" class="mr-2 mx-md-2 form-control flex-grow-1 new-from"> <span>to</span> <input maxlength="3" class="ml-2 mx-md-2 form-control flex-grow-1 new-to"> </div> <div class="col-4 col-md-3 pt-2 pt-md-0"> <span style="line-height: 1.1" class="d-block">Participant Cost</span><input class="band-type" name="type" hidden type="text" value="participants costs"></div> <div class="col-8 col-md-4 pt-2 pt-md-0"> <div class="input-group"> <div class="input-group-prepend"> <span class="input-group-text">&euro;</span> </div> <input maxlength="10" class="form-control new-cost"> <button type="submit"  maxlength="3" class="form-control ml-1 SavePriceband" value="" data-toggle="tooltip" title="Click to save your price band"><i class="fa fa-check-circle" style="color:blue"></i></button><button maxlength="3" class="form-control ml-1 removePriceband" value="" ><i class="fa fa-trash" style="color:grey"></i></button><i class="fa fa-plus-circle col-2 addParticipantPrice mt-4" id="'+s+'"></i> <i class="col-2 pl" style="display:none;" id="'+s1+'"></i></div></div></form>'
  $(this).closest('.dashboard__container').find('.financial-append').append(addparticipantprice);
 });


});




  </script>

