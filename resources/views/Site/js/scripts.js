jQuery(document).ready(function($){
	
	$('.quiz__slider').slick({
		  prevArrow:'<button type="button" class="slick-btns slick-prev"><i class="fa fa-angle-left"</button>',
		  nextArrow:'<button type="button" class="slick-btns slick-next"><i class="fa fa-angle-right"</button>',
		});
	
    $('[data-toggle="tooltip"]').tooltip({
		template: '<div class="tooltip" role="tooltip"><div class="arrow"></div><div class="tooltip-inner"></div></div>',
		animation: false
	});
	
    $('#menu__btn').click(function(){
        
        $('nav.main__navigation').toggleClass('menuOpen');
    })
	
	
	
	
	/// Forms - Hide & Show ////
	
	$('input.form-check-input').click(function(){
		
		if($('#quiz_charge__yes').is(':checked')){
			$('.entry__fee').removeClass('d-none');
		} else {
			$('.entry__fee').addClass('d-none');
		}
		
	})
	
	
	$('#modal__payment__table tr').each(function(){
		var parent = $(this);
		$('.checkout__remove', parent).click(function(){
			parent.detach();
		})
			
	})
	
	
	$('.sign_up__from__modal').click(function(){
		
		$('#modal__login').addClass('d-none');
		$('#modal__signup').removeClass('d-none')
		
	})
	$('a.back_to__login').click(function(e){
		e.preventDefault();
		$('#modal__login').removeClass('d-none');
		$('#modal__signup, #modal__payment').addClass('d-none');
	})
	
	$('.to__checkout').click(function(e){
		e.preventDefault();
		$('#modal__login').addClass('d-none');
		$('#modal__signup').addClass('d-none');
		$('#modal__payment').removeClass('d-none');
	})
	
	// Forms - add another multiple choice Q //
	$('.multiple__choice__row').each(function(){
		var newRow ='<div class="row multiple__choice__row pb-3 align-items-center"><div class="col-7"><input name="multiple__choice__answer__1" class="form-control" type="text"></div><div class="col-1 justify-content-center p-0 d-flex"><span class="minus">-</span></div><div class="col-1 justify-content-center"><span class="plus">+</span></div><div class="col-3 text-center form-check"><input type="radio" class="" name="multiple__choice__correct__answer"></div></div>';
		var parent = $(this);
		$('body').on('click','span.plus',function(){
			$(this).parents('.multiple__choice__row').after(newRow);
		}).on('click','span.minus',function(){
			$(this).parents('.multiple__choice__row').detach();
		})
		
	})
    
    $('body').on('click','.multiple__choice__row__in_modal span',function(){
        var button = $(this);
        $(this).closest('.multiple__choice__row__in_modal').each(function(){
            
		      var newRow ='<div class="form-row multiple__choice__row__in_modal pb-0 mb-2 align-items-center"><div class="col-7"><input name="multiple__choice__answer__1" class="readonly form-control" type="text"></div><div class="col-1 justify-content-center tempVis"><span class="minus">-</span></div><div class="col-1 justify-content-center tempVis"><span class="plus">+</span></div><div class="col-3 text-center form-check hidd"><input type="radio" class="" name="multiple__choice__correct__answer"></div></div>';
		      var parent = $(this);
                
              if(button.hasClass('plus')){
                 button.closest('.multiple__choice__row__in_modal').after(newRow);
              }
              if(button.hasClass('minus')){
                 button.closest('.multiple__choice__row__in_modal').detach();
              }

        })
        
    })
    
	$('select#question__type').on('change',function(){
		if($(this).val() == "numeric__question"){
			$('#standard__answer').removeClass('d-flex').addClass('d-none');
			$('#multiple__choice__legend').removeClass('d-flex').addClass('d-none');
			$('#multiple__choice__answer').removeClass('d-flex').addClass('d-none');
			$('#numeric__answer').addClass('d-flex').removeClass('d-none');
		}
		if($(this).val() == "standard__question"){
			$('#standard__answer').addClass('d-flex').removeClass('d-none');
			$('#multiple__choice__legend').removeClass('d-flex').addClass('d-none');
			$('#multiple__choice__answer').removeClass('d-flex').addClass('d-none');
			$('#numeric__answer').removeClass('d-flex').addClass('d-none');
		}
		if($(this).val() == "multiple__choice__question"){
			$('#standard__answer').removeClass('d-flex').addClass('d-none');
			$('#multiple__choice__legend').addClass('d-flex').removeClass('d-none');
			$('#multiple__choice__answer').addClass('d-flex').removeClass('d-none');
			$('#numeric__answer').removeClass('d-flex').addClass('d-none');
		}
	})
	
	
	
	
	// Forms - add media to question modal //
	$('#add__media').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        var title = button.data('title')
        var text = button.data('add-text')
        var modal = $(this)
        modal.find('.modal-title').text('Upload ' + title)
        modal.find('#add__media__text').text(text)
	})
	
	//Forms - choose number of participants //
	
	$('.participants').each(function(){
		var parent = $(this);
		
		$('.participants__choice').each(function(){
			var self = $(this);
			self.click(function(){
				self.addClass('selected');
				$('.participants__choice',parent).not(self).each(function(){
					if($(this).hasClass('selected')){
						$(this).removeClass('selected');
					}
				})
				
			})
		})
	});
	
    
    
    //Bring up modal when number of participants is changed //
    
	$('select#quiz__participants').on('change',function(){
		$('#select_participants__modal').modal();
	})
	
	
	// Click to Copy //
	
	$('.copy__icon.quiz__link').click(function(){
		$('input#full__uri').select();
		
		document.execCommand('copy');
		$(this).addClass('animate');
	})

	
	function generate_quiz_name(){
		var userInput = $('input[name="quiz__name"]').val();
		var noSpaces = userInput.replace(/\s+/g, '');
		var noPunc = noSpaces.replace(/[^\w\s]/gi, '');
		$('input[name="quiz__link"]').val(noPunc);
		$('input[id="full__uri"]').val("https://tablequiz.app/"+noPunc);
	}
	
	function removeSpacesFromQuizName(){
		var userInput = $('input[name="quiz__link"]').val();
		var noSpaces = userInput.replace(/\s+/g, '');
		var noPunc = noSpaces.replace(/[^\w\s]/gi, '');
		$('input[name="quiz__link"]').val(noPunc);
		$('input[id="full__uri"]').val("https://tablequiz.app/"+noPunc);
		
	}
	
	function removeSpacesFromPassword() {
		var userInput = $('input[name="quiz__password"]').val();
		var noSpaces = userInput.replace(/\s+/g, '');
		$('input[name="quiz__password"]').val(noSpaces);
	}
	
	$('input[name="quiz__name"]').keyup(function(){
		generate_quiz_name();
	})
	$('input[name="quiz__link"]').on('focusout',function(){
		removeSpacesFromQuizName();
	})
	$('input[name="quiz__password"]').on('keyup',function(){
		removeSpacesFromPassword();
	})
    
    
    $('.suggested__categories').each(function(){
		var parent = $(this);
		
		$('.suggested_category__icon').each(function(){
			var self = $(this);
			self.click(function(){
				$('.participants__choice',self).addClass('selected');
				$('.suggested_category__icon',parent).not(self).each(function(){
					if($('.participants__choice',this).hasClass('selected')){
						$('.participants__choice',this).removeClass('selected');
					}
				})
				
				
			})
		})
	});
    
    var clicked = 0;
    $('#category__chosen__next, .suggested_category__icon').click(function(){
		setTimeout(function(){
			clicked += 1;
			$(this).attr('data-clicked', clicked);
			if (clicked >= 0){
				$('.modal-footer').removeClass('d-none');
				$('#suggested__modal__back').addClass('d-flex').removeClass('d-none');
			}
			if(clicked == 1){
				$('.modal-body.categories').addClass('d-none').removeClass('d-flex');
				$('.modal-body.question_types').removeClass('d-none').addClass('d-flex');
			}
			if(clicked == 2){
				$('.modal-body.categories').addClass('d-none').removeClass('d-flex');
				$('.modal-body.question_types').addClass('d-none').removeClass('d-flex');
				$('.modal-body.questions').removeClass('d-none').addClass('d-flex');
				$(this).addClass('d-none');
			}
		},600);
    })
    $('#suggested__modal__back').click(function(){
        clicked -= 1;
        $('#category__chosen__next').attr('data-clicked',clicked);
        if (clicked == 0){
           $('#suggested__modal__back').addClass('d-none').removeClass('d-flex');
            $('.modal-body.categories').removeClass('d-none').addClass('d-flex');
            $('.modal-body.question_types').addClass('d-none').removeClass('d-flex');
            $('.modal-body.questions').addClass('d-none').removeClass('d-flex');
            $('#category__chosen__next').addClass('d-flex').removeClass('d-none');
        }
        if(clicked == 1){
            $('.modal-body.categories').addClass('d-none').removeClass('d-flex');
            $('.modal-body.question_types').removeClass('d-none').addClass('d-flex');
            $('.modal-body.questions').addClass('d-none').removeClass('d-flex');
            $('#category__chosen__next').addClass('d-flex').removeClass('d-none');
        }
        
    })
    
    
    // Duplicate the Questions when "Add Question" is clicked
   /* var count = 1;
    $('#addQuestion').click(function(){
        count += 1;
         var new_question = '<article class="col-12"><div class="article__heading"><h1>Question '+count+'</h1><a class="suggested__question__link" href="#" data-toggle="modal" data-target="#suggestedQuestion">Use a suggested question</a></div><div class="form-row mt-md-5"><div class="col-md-4"><label for="question__type">Question type</label></div><div class="col-md-4"><select id="question__type" class="form-control"><option value="standard__question">Standard</option><option value="multiple__choice__question">Multiple choice</option><option value="numeric__question">Numeric</option></select></div></div><div class="form-row"><div class="col-md-4"><label for="question">Question</label></div><div class="col-md-8"><input name="question" type="text" class="form-control"></div></div><div class="form-row"><div class="col-md-4"><label>Add media</label></div><div class="col-md-8"><div class="row "><div class="col-md-4 pr-0"><a href="#" class="btn btn-outline-secondary d-block hasPlus" data-toggle="modal" data-target="#add__media" data-title="Image" data-add-text="an image">Image</a></div><div class="col-md-4 pr-0"><a href="#" class="btn btn-outline-secondary d-block hasPlus" data-toggle="modal" data-target="#add__media" data-title="Audio" data-add-text="any audio file">Audio</a></div><div class="col-md-4"><a href="#" class="btn btn-outline-secondary d-block hasPlus" data-toggle="modal" data-target="#add__media" data-title="Video" data-add-text="any video file">Video</a></div></div></div><div class="modal" id="add__media" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true"> <div class="modal-dialog" role="document"><div class="modal-content"> <div class="modal-header justify-content-center"><h1 class="modal-title" id="add__media__modal__heading"></h1><button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span></button> </div><div class="modal-body"><p class="text-center py-2">Add <span id="add__media__text"></span> to reference in your question</p><div class="form-row"><div class="col-md-4"><label>Add link</label></div><div class="col-md-8"><input type="url" name="add_link_to_media" class="form-control"></div></div><div class="text-center w-100"> <span>OR</span></div><div class="form-row justify-content-center pt-3"><div class="col-md-3"> <label class="d-block" for="upload__media__file">Upload<input type="file" class="form-control-file" id="upload__media__file" value="Upload"></label></div></div></div><div class="modal-footer justify-content-center"> <div class="col-sm-4"><button type="button" class="d-block btn btn-primary">Save</button> </div></div></div></div></div></div><div class="form-row d-flex" id="standard__answer"><div class="col-md-4"><label for="standard__question__answer">Answer</label></div><div class="col-md-8"><input class="form-control" name="standard__question__answer" type="text"></div></div><div class="form-row d-none" id="numeric__answer"><div class="col-md-4"><label for="numeric__question__answer">Answer</label></div><div class="col-md-8"><input class="form-control" name="numeric__question__answer" type="number"></div></div><div class="form-row d-none" style="min-height:0;" id="multiple__choice__legend"><div class="offset-md-10 col-2"><small class="d-block text-center pl-4">Correct answer</small></div></div><div class="form-row d-none" id="multiple__choice__answer"><div class="col-md-4 align-self-start"><label for="multiple__choice__answer">Answer</label></div><div class="col-md-8"><div class="row multiple__choice__row pb-3 align-items-center"><div class="col-7"><input name="multiple__choice__answer__1" class="form-control" type="text"> </div><div class="col-1 justify-content-center">&nbsp;</div><div class="col-1 justify-content-center"><span class="plus">+</span></div><div class="col-3 text-center form-check"><input type="radio" class="" name="multiple__choice__correct__answer"></div></div></div></div><div class="form-row"><div class="col-md-4"><label for="time__limit">Time limit</label></div><div class="col-md-4"><input class="form-control" type="number" name="time__limit"></div><div class="col"><small class="form-text text-muted">Seconds</small></div></div></article>';
        $('#add-new-question').before(new_question);
       
    })
*/
    
    // When the user clicks "Edit Question" while viewing the Suggested Questions...
    $('.single__suggested__question').each(function(){
        var parent = $(this);
        $('.edit__question', parent).click(function(e){
            e.preventDefault();
            $('.readonly',parent).removeAttr('readonly');
            $('.disabled',parent).removeAttr('disabled');
            $('p.the_question input',parent).focus();
            $('.d-none', parent).addClass('hidd').removeClass('d-none');
            $('.invisible', parent).addClass('tempVis').removeClass('invisible');
            if($(this).text() == "Done editing"){
                $(this).text("Edit question");
                $('.readonly', parent).attr('readonly','readonly');
                $('.disabled',parent).attr('disabled','disabled');
                $('.hidd').addClass('d-none').removeClass('hidd');
                $('.tempVis').addClass('invisible').removeClass('tempVis');
            } else {
                $(this).text("Done editing");
            }
        })
        
        $('#suggested__question__type',parent).on('change',function(){
        if($(this).val() !== "multiple") {
            $('.answers__label',parent).text("Answer: ");
            $('.hidd',parent).addClass('d-none').removeClass('hidd');
            $('.tempVis',parent).addClass('invisible').removeClass('tempVis');
            $('.multiple__choice__row__in_modal:not(:first-child)',parent).hide();
        } else {
            $('.answers__label',parent).text("Answers: ");
            $('.d-none',parent).removeClass('d-none').addClass('hidd');
            $('.invisible',parent).removeClass('invisible').addClass('tempVis');
            $('.multiple__choice__row__in_modal:not(:first-child)',parent).show();
        }
        
    })
        
        
    })
    
    

})