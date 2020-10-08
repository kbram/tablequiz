jQuery(document).ready(function ($) {
    $(".quiz__slider").slick({
        prevArrow:
            '<button type="button" class="slick-btns slick-prev"><i class="fa fa-angle-left"</button>',
        nextArrow:
            '<button type="button" class="slick-btns slick-next"><i class="fa fa-angle-right"</button>',
    });

    $('[data-toggle="tooltip"]').tooltip({
        template:
            '<div class="tooltip" role="tooltip"><div class="arrow"></div><div class="tooltip-inner"></div></div>',
        animation: false,
    });

    $("#menu__btn").click(function () {
        $("nav.main__navigation").toggleClass("menuOpen");
    });

    /// Forms - Hide & Show ////

    //thushapan

    // $('a.back_to__login').click(function(e) {
    //     e.preventDefault();
    //     $('#modal__login').removeClass('d-none');
    //     $('#modal__signup, #modal__payment').addClass('d-none');
    // })

    // $('.to__checkout').click(function(e) {
    //     e.preventDefault();
    //     $('#modal__login').addClass('d-none');
    //     $('#modal__signup').addClass('d-none');
    //     $('#modal__payment').removeClass('d-none');
    // })

    // Forms - add another multiple choice Q //

    //$('.multiple__choice__row').each(function() {
    var i = 0;
    //var newRow ='<div class="row multiple__choice__row pb-3 align-items-center"><div class="col-7"><input name="multiple__choice__answer__1[]" class="form-control" type="text"></div><div class="col-1 justify-content-center p-0 d-flex"><span class="minus">-</span></div><div class="col-1 justify-content-center"><span class="plus">+</span></div><div class="col-3 text-center form-check"><input type="radio" id="rdd" name="multiple__choice__correct__answer" value="'+i+'"></div></div>';

    // var parent = $(this);
    $("body")
        .on("click", "span.plus", function () {
            i += 1;

            var gtname = $(this)
                .closest("article")
                .find(".multiple-choice-answer")
                .attr("name");
            console.log(gtname);

            var gtname_correct = $(this)
                .closest("article")
                .find(".multiple-choice-correct-answer")
                .attr("name");
            console.log(gtname_correct);

            var gtname_correct_val = $(this)
                .closest(".multiple__choice__row")
                .find(".multiple-choice-answer")
                .val();

            var newRow =
                '<div class="row multiple__choice__row  pb-3 align-items-center"><div class="col-7 multi"><input name="' +
                gtname +
                '" class="form-control multiple-choice-answer" type="text" required></div><div class="col-1 justify-content-center p-0 d-flex"><span class="minus">-</span></div><div class="col-1 justify-content-center"><span class="plus">+</span></div><div class="col-3 text-center form-check"><input class="multiple-choice-correct-answer" type="radio" id="rdd" name="' +
                gtname_correct +
                '"  ></div></div>';

            $(this).parents(".multiple__choice__row").after(newRow);
        })
        .on("click", "span.minus", function () {
            $(this).parents(".multiple__choice__row").detach();
        });

    // });

    //kopi
    // Forms - add another multiple choice Q //
    // $('.multiple__choice__row').each(function(){

    var i = 0;
    //var newRow ='<div class="row multiple__choice__row pb-3 align-items-center"><div class="col-7"><input name="multiple__choice__answer__1[]" class="form-control" type="text"></div><div class="col-1 justify-content-center p-0 d-flex"><span class="minus">-</span></div><div class="col-1 justify-content-center"><span class="plus">+</span></div><div class="col-3 text-center form-check"><input type="radio" id="rdd" name="multiple__choice__correct__answer" value="'+i+'"></div></div>';

    // 	var parent = $(this);
    // 	$('body').on('click','span.plus',function(){
    // 		 i+=1;
    // 		 var gtname=$(this).closest('article').find('.multiple-choice-answer').attr("name");
    // 		var newRow ='<div class="row multiple__choice__row pb-3 align-items-center"><div class="col-7"><input name="'+gtname+'" class="form-control" type="text"></div><div class="col-1 justify-content-center p-0 d-flex"><span class="minus">-</span></div><div class="col-1 justify-content-center"><span class="plus">+</span></div><div class="col-3 text-center form-check"><input type="radio" id="rdd" name="multiple__choice__correct__answer" value="'+i+'"></div></div>';

    // 		$(this).parents('.multiple__choice__row').after(newRow);
    // 	}).on('click','span.minus',function(){
    // 		$(this).parents('.multiple__choice__row').detach();
    // 	})

    // two function for appending multiple choice locating a one class

    $("body").delegate(
        "input:radio.multiple-choice-correct-answer",
        "click",
        function () {
            var gtname_correct_val = $(this)
                .closest(".multiple__choice__row")
                .find(".multiple-choice-answer")
                .val();
            // console.log(gtname_correct_val);

            $(this).val(gtname_correct_val);
            console.log("radio value" + gtname_correct_val);
        }
    );

    /// Forms - Hide & Show ////

    $("input.form-check-input").click(function () {
        if ($("#quiz_charge__yes").is(":checked")) {
            $(".entry__fee").removeClass("d-none");
        } else {
            $(".entry__fee").addClass("d-none");
        }
    });

    $("#modal__payment__table tr").each(function () {
        var parent = $(this);
        $(".checkout__remove", parent).click(function () {
            parent.detach();
        });
    });

    $(".sign_up__from__modal").click(function () {
        //console.log("hi");
        $("#modal__login").addClass("d-none");
        $("#modal__signup").animate({ scrollTop: 0 }, "slow");
        $("#modal__signup").removeClass("d-none");
    });

    $(".login__from__modal").click(function () {
        console.log("hi");
        $("#modal__login").removeClass("d-none");
        $("#modal__signup, #modal__payment").addClass("d-none");
    });

    $("a.back_to__login").click(function (e) {
        e.preventDefault();
        $("#modal__login").removeClass("d-none");
        $("#modal__signup, #modal__payment").addClass("d-none");
    });

    /**kopi ajax login  */

    $("#login-btn").click(function (e) {
        e.preventDefault();
        console.log("iiiiiiiiiiiiiiiiiiiiiiiii" + sessionStorage.count);

        
        reload = function () {
            location.href = location.href;
        };
        $.ajax({
            data: $(this).closest(".popupLogIn").serialize(),
            type: "post",
            url: $(this).closest(".popupLogIn").attr("action"),
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },

            success: function (response) {
                $("#modal__login").addClass("d-none");
                $("#modal__signup").addClass("d-none");
                $.ajax({
                    type: "POST",
                    url: "/payment",
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                            "content"
                        ),
                    },
                    data: {
                        count: sessionStorage.count,
                    },
                    success: function (data) {
                        var participants = data.participants.no_of_participants;
                        var participants_cost = data.participants_cost[0].cost;
                        var questions_cost = 0;
                        console.log(typeof participants_cost);
                        $("#modal__payment")
                            .find(".no-participants td:nth-child(2)")
                            .text(participants);
                        $("#modal__payment")
                            .find(".no-participants td:nth-child(3)")
                            .text(participants_cost);

                        $("#modal__payment")
                            .find(".suggested-questions td:nth-child(2)")
                            .text(sessionStorage.count);

                        if (data.question_cost != null) {
                            $("#modal__payment")
                                .find(".suggested-questions td:nth-child(3)")
                                .text(data.question_cost.cost);
                            questions_cost = data.question_cost.cost;
                        } else {
                            $("#modal__payment")
                                .find(".suggested-questions td:nth-child(3)")
                                .text(0);
                            questions_cost = 0;
                        }

                        var customised_backgrounds_details = $(
                            "#modal__payment"
                        )
                            .find(".customised-backgrounds td:nth-child(2)")
                            .text(data.bg_image);
                        var customised_backgrounds_price = $("#modal__payment")
                            .find(".customised-backgrounds td:nth-child(3)")
                            .text(data.bg_image_cost.cost);

                        $("#modal__payment")
                            .find(".total-cost td:nth-child(2)>strong")
                            .text(
                                Number(participants_cost) +
                                    Number(questions_cost) +
                                    Number(data.bg_image_cost.cost)
                            );
                        var total_card =
                            Number(participants_cost) +
                            Number(questions_cost) +
                            Number(data.bg_image_cost.cost);
                        $("#card_total").val(total_card);
                    },
                    error: function (result, error) {},
                });
                //card fill
                $.getJSON("/card", function (data) {
                    $("#modal__payment")
                        .find("#card-holder-name")
                        .val(data.name);
                    $("#modal__payment")
                        .find("#cardholder_street")
                        .val(data.street);
                    $("#modal__payment")
                        .find("#cardholder_city")
                        .val(data.city);
                    $("#modal__payment")
                        .find("#cardholder_country")
                        .val(data.country);
                    $("#modal__payment")
                        .find("#cardholder_number")
                        .val(data.card_number);
                    $("#modal__payment")
                        .find("#cardholder_expiry_month")
                        .val(data.exp_month);
                    $("#modal__payment")
                        .find("#cardholder_expiry_year")
                        .val(data.exp_year);
                    $("#modal__payment").find("#card-cvc").val(data.cvv);
                });
                $("#modal__payment").removeClass("d-none");
            },
            error: function (result, error) {
                console.log(result);
                var validate = result.responseJSON.errors;
                console.log("gfgdfgdfgggggggggggg" + validate);
                $(".text-danger").html("");
                if (validate.email) {
                    $("#login_email").after(
                        '<span class="text-danger"><strong>' +
                            validate.email +
                            "</strong></span>"
                    );
                }

                if (validate.password) {
                    $("#password").after(
                        '<span class="text-danger"><strong>' +
                            validate.password +
                            "</strong></span>"
                    );
                }
            },
        });

        return false;
    });

    /**kopi ajax sign Up */
    $("#signup-btn").click(function (e) {
        e.preventDefault();

        reload = function () {
            location.href = location.href;
        };

        $.ajax({
            data: $(this).closest(".popupLogIn").serialize(),
            type: "post",
            url: $(this).closest(".popupLogIn").attr("action"),
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (response) {
                console.log("signup success");
                $("#modal__login").addClass("d-none");
                $("#modal__signup").addClass("d-none");
                $.ajax({
                    
                    type: "POST",
                    url: "/payment",
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                            "content"
                        ),
                    },
                    data: {
                        count: sessionStorage.count,
                    },
                    success: function (data) {
                        console.log("eeeeeeeeeeeeeee"+data);
                        var participants = data.participants.no_of_participants;
                        var participants_cost = data.participants_cost[0].cost;
                        var questions_cost = 0;
                        console.log(typeof participants_cost);
                        $("#modal__payment")
                            .find(".no-participants td:nth-child(2)")
                            .text(participants);
                        $("#modal__payment")
                            .find(".no-participants td:nth-child(3)")
                            .text(participants_cost);

                        $("#modal__payment")
                            .find(".suggested-questions td:nth-child(2)")
                            .text(sessionStorage.count);

                        if (data.question_cost != null) {
                            $("#modal__payment")
                                .find(".suggested-questions td:nth-child(3)")
                                .text(data.question_cost.cost);
                            questions_cost = data.question_cost.cost;
                        } else {
                            $("#modal__payment")
                                .find(".suggested-questions td:nth-child(3)")
                                .text(0);
                            questions_cost = 0;
                        }

                        var customised_backgrounds_details = $(
                            "#modal__payment"
                        )
                            .find(".customised-backgrounds td:nth-child(2)")
                            .text(data.bg_image);
                        var customised_backgrounds_price = $("#modal__payment")
                            .find(".customised-backgrounds td:nth-child(3)")
                            .text(data.bg_image_cost.cost);

                        $("#modal__payment")
                            .find(".total-cost td:nth-child(2)>strong")
                            .text(
                                Number(participants_cost) +
                                    Number(questions_cost) +
                                    Number(data.bg_image_cost.cost)
                            );
                        var total_card =
                            Number(participants_cost) +
                            Number(questions_cost) +
                            Number(data.bg_image_cost.cost);
                        $("#card_total").val(total_card);
                    },
                    error: function (result, error) {
                        console.log("uuuuuuu");
                    },
                });
                //card fill
                $.getJSON("/card", function (data) {
                    $("#modal__payment")
                        .find("#card-holder-name")
                        .val(data.name);
                    $("#modal__payment")
                        .find("#cardholder_street")
                        .val(data.street);
                    $("#modal__payment")
                        .find("#cardholder_city")
                        .val(data.city);
                    $("#modal__payment")
                        .find("#cardholder_country")
                        .val(data.country);
                    $("#modal__payment")
                        .find("#cardholder_number")
                        .val(data.card_number);
                    $("#modal__payment")
                        .find("#cardholder_expiry_month")
                        .val(data.exp_month);
                    $("#modal__payment")
                        .find("#cardholder_expiry_year")
                        .val(data.exp_year);
                    $("#modal__payment").find("#card-cvc").val(data.cvv);
                });
                $("#modal__payment").removeClass("d-none");
            },
            error: function (result, error) {
                var validate = result.responseJSON.errors;

                $(".text-danger").html("");
                if (validate.first_name) {
                    $("#first_name").after(
                        '<span class="text-danger"><strong>' +
                            validate.first_name +
                            "</strong></span>"
                    );
                }
                if (validate.last_name) {
                    $("#last_name").after(
                        '<span class="text-danger"><strong>' +
                            validate.last_name +
                            "</strong></span>"
                    );
                }

                if (validate.name) {
                    $("#name").after(
                        '<span class="text-danger"><strong>' +
                            validate.name +
                            "</strong></span>"
                    );
                }

                if (validate.email) {
                    $("#email").after(
                        '<span class="text-danger"><strong>' +
                            validate.email +
                            "</strong></span>"
                    );
                }

                if (validate.password) {
                    $("#password_signup").after(
                        '<span class="text-danger"><strong>' +
                            validate.email +
                            "</strong></span>"
                    );
                }

                if (validate.password_confirmation) {
                    $("#password_signup_confirm").after(
                        '<span class="text-danger"><strong>' +
                            validate.password_confirmation +
                            "</strong></span>"
                    );
                }
            },
        });
        return false;
    });

    $("body").on("click", ".multiple__choice__row__in_modal span", function () {
        var button = $(this);
        $(this)
            .closest(".multiple__choice__row__in_modal")
            .each(function () {
                var newRow =
                    '<div class="form-row multiple__choice__row__in_modal pb-0 mb-2 align-items-center"><div class="col-7"><input name="multiple__choice__answer[]" class="readonly form-control" type="text" ></div><div class="col-1 justify-content-center tempVis"><span class="minus">-</span></div><div class="col-1 justify-content-center tempVis"><span class="plus">+</span></div><div class="col-3 text-center form-check hidd"><input type="radio" class="" name="multiple__choice__correct__answer"></div></div></div>';
                var parent = $(this);

                if (button.hasClass("plus")) {
                    button
                        .closest(".multiple__choice__row__in_modal")
                        .after(newRow);
                }
                if (button.hasClass("minus")) {
                    button.closest(".multiple__choice__row__in_modal").detach();
                }
            });
    });
    $("select#question__type").on("change", function () {
        if ($(this).val() == "numeric__question") {
            $("#standard__answer").removeClass("d-flex").addClass("d-none");
            $("#multiple__choice__legend")
                .removeClass("d-flex")
                .addClass("d-none");
            $("#multiple__choice__answer")
                .removeClass("d-flex")
                .addClass("d-none");
            $("#numeric__answer").addClass("d-flex").removeClass("d-none");
        }
        if ($(this).val() == "standard__question") {
            $("#standard__answer").addClass("d-flex").removeClass("d-none");
            $("#multiple__choice__legend")
                .removeClass("d-flex")
                .addClass("d-none");
            $("#multiple__choice__answer")
                .removeClass("d-flex")
                .addClass("d-none");
            $("#numeric__answer").removeClass("d-flex").addClass("d-none");
        }
        if ($(this).val() == "multiple__choice__question") {
            console.log("man_mul");
            $("#standard__answer").removeClass("d-flex").addClass("d-none");
            $("#multiple__choice__legend")
                .addClass("d-flex")
                .removeClass("d-none");
            $("#multiple__choice__answer")
                .addClass("d-flex")
                .removeClass("d-none");
            $("#numeric__answer").removeClass("d-flex").addClass("d-none");
        }
    });
    $("body").delegate("select.question__type", "change", function () {
        if ($(this).val() == "numeric__question") {
            $(this)
                .parents(".article_question")
                .children(".standard__answer")
                .removeClass("d-flex")
                .addClass("d-none");
            $(this)
                .parents(".article_question")
                .children(".multiple__choice__legend")
                .removeClass("d-flex")
                .addClass("d-none");
            $(this)
                .parents(".article_question")
                .children(".multiple__choice__answer")
                .removeClass("d-flex")
                .addClass("d-none");
            $(this)
                .parents(".article_question")
                .children(".numeric__answer")
                .addClass("d-flex")
                .removeClass("d-none");
            $(this)
                .parents(".article_question")
                .children(".numeric__answer")
                .find(".form-control")
                .attr("required", true);
            $(this)
                .parents(".article_question")
                .children(".standard__answer")
                .find(".answer")
                .attr("required", false);
            $(this)
                .parents(".article_question")
                .children(".multiple__choice__answer")
                .find(".multiple-choice-answer")
                .attr("required", false);
        }
        if ($(this).val() == "standard__question") {
            console.log("standad select");

            $(this)
                .parents(".article_question")
                .children(".standard__answer")
                .removeClass("d-none");
            $(this)
                .parents(".article_question")
                .children(".standard__answer")
                .find(".answer")
                .attr("required", true);
            $(this)
                .parents(".article_question")
                .children(".numeric__answer")
                .find(".form-control")
                .attr("required", false);
            $(this)
                .parents(".article_question")
                .children(".multiple__choice__answer")
                .find(".multiple-choice-answer")
                .attr("required", false);

            $(this)
                .parents(".article_question")
                .children(".multiple__choice__legend")
                .removeClass("d-flex")
                .addClass("d-none");
            $(this)
                .parents(".article_question")
                .children(".multiple__choice__answer")
                .removeClass("d-flex")
                .addClass("d-none");
            $(this)
                .parents(".article_question")
                .children(".numeric__answer")
                .removeClass("d-flex")
                .addClass("d-none");
        }
        if ($(this).val() == "multiple__choice__question") {
            console.log("multi select");
            $(this)
                .parents(".article_question")
                .children(".standard__answer")
                .removeClass("d-flex")
                .addClass("d-none");
            $(this)
                .parents(".article_question")
                .children(".multiple__choice__legend")
                .addClass("d-flex")
                .removeClass("d-none");
            $(this)
                .parents(".article_question")
                .children(".multiple__choice__answer")
                .addClass("d-flex")
                .removeClass("d-none");
            $(this)
                .parents(".article_question")
                .children(".multiple__choice__answer")
                .find(".multiple-choice-answer")
                .attr("required", true);

            $(this)
                .parents(".article_question")
                .children(".numeric__answer")
                .removeClass("d-flex")
                .addClass("d-none");
            $(this)
                .parents(".article_question")
                .children(".standard__answer")
                .find(".answer")
                .attr("required", false);
            $(this)
                .parents(".article_question")
                .children(".numeric__answer")
                .find(".form-control")
                .attr("required", false);
        }
    });

    // Forms - add media to question modal //
    $("#add__media").on("show.bs.modal", function (event) {
        var button = $(event.relatedTarget);
        var title = button.data("title");
        var text = button.data("add-text");
        var modal = $(this);
        modal.find(".modal-title").text("Upload " + title);
        modal.find("#add__media__text").text(text);
    });

    //Forms - choose number of participants //

    $(".participants").each(function () {
        var parent = $(this);

        $(".participants__choice").each(function () {
            var self = $(this);
            self.click(function () {
                self.addClass("selected");
                $(".participants__choice", parent)
                    .not(self)
                    .each(function () {
                        if ($(this).hasClass("selected")) {
                            $(this).removeClass("selected");
                        }
                    });
            });
        });
    });

    //Bring up modal when number of participants is changed //

    $("select#quiz__participants").on("change", function () {
        console.log("hi modal");
        $("#select_participants__modal").modal();
    });

    // Click to Copy //

    $(".copy__icon.quiz__link").click(function () {
        console.log("copy");
        $("input#full__uri").select();

        document.execCommand("copy");
        $(this).addClass("animate");
    });

    function generate_quiz_name() {
        var userInput = $('input[name="quiz__name"]').val();
        var noSpaces = userInput.replace(/\s+/g, "");
        var noPunc = noSpaces.replace(/[^\w\s]/gi, "");
        $('input[name="quiz__link"]').val(noPunc);
        $('input[id="full__uri"]').val("https://tablequiz.app/" + noPunc);
    }

    function removeSpacesFromQuizName() {
        var userInput = $('input[name="quiz__link"]').val();
        var noSpaces = userInput.replace(/\s+/g, "");
        var noPunc = noSpaces.replace(/[^\w\s]/gi, "");
        $('input[name="quiz__link"]').val(noPunc);
        $('input[id="full__uri"]').val("https://tablequiz.app/" + noPunc);
    }

    function removeSpacesFromPassword() {
        var userInput = $('input[name="quiz__password"]').val();
        var noSpaces = userInput.replace(/\s+/g, "");
        $('input[name="quiz__password"]').val(noSpaces);
    }

    $('input[name="quiz__name"]').keyup(function () {
        console.log("hi");
        generate_quiz_name();
    });
    $('input[name="quiz__link"]').on("focusout", function () {
        removeSpacesFromQuizName();
    });
    $('input[name="quiz__password"]').on("keyup", function () {
        removeSpacesFromPassword();
    });

    $(".suggested__categories").each(function () {
        var parent = $(this);

        $(".suggested_category__icon").each(function () {
            var self = $(this);
            self.click(function () {
                $(".participants__choice", self).addClass("selected");
                $(".suggested_category__icon", parent)
                    .not(self)
                    .each(function () {
                        if (
                            $(".participants__choice", this).hasClass(
                                "selected"
                            )
                        ) {
                            $(".participants__choice", this).removeClass(
                                "selected"
                            );
                        }
                    });
            });
        });
    });

    var clicked = 0;
    $("#cll").click(function () {
        clicked = 0;
    });
    $("#category__chosen__next, .suggested_category__icon").click(function () {
        setTimeout(function () {
            clicked += 1;
            $(this).attr("data-clicked", clicked);
            if (clicked >= 0) {
                $(".modal-footer").removeClass("d-none");
                $("#suggested__modal__back")
                    .addClass("d-flex")
                    .removeClass("d-none");
            }
            if (clicked == 1) {
                $(".modal-body.categories")
                    .addClass("d-none")
                    .removeClass("d-flex");
                $(".modal-body.question_types")
                    .removeClass("d-none")
                    .addClass("d-flex");
            }
            if (clicked == 2) {
                $(".modal-body.categories")
                    .addClass("d-none")
                    .removeClass("d-flex");
                $(".modal-body.question_types")
                    .addClass("d-none")
                    .removeClass("d-flex");
                $(".modal-body.questions")
                    .removeClass("d-none")
                    .addClass("d-flex");
                $(this).addClass("d-none");
            }
        }, 300);
    });
    $("#suggested__modal__back").click(function () {
        clicked -= 1;
        $("#category__chosen__next").attr("data-clicked", clicked);
        if (clicked == 0) {
            $("#suggested__modal__back")
                .addClass("d-none")
                .removeClass("d-flex");
            $(".modal-body.categories")
                .removeClass("d-none")
                .addClass("d-flex");
            $(".modal-body.question_types")
                .addClass("d-none")
                .removeClass("d-flex");
            $(".modal-body.questions").addClass("d-none").removeClass("d-flex");
            $("#category__chosen__next")
                .addClass("d-flex")
                .removeClass("d-none");
        }
        if (clicked == 1) {
            $(".modal-body.categories")
                .addClass("d-none")
                .removeClass("d-flex");
            $(".modal-body.question_types")
                .removeClass("d-none")
                .addClass("d-flex");
            $(".modal-body.questions").addClass("d-none").removeClass("d-flex");
            $("#category__chosen__next")
                .addClass("d-flex")
                .removeClass("d-none");
        }
    });

    // Duplicate the Questions when "Add Question" is clicked
    var count = 1;
    var arcount = 0;
    $("#addQuestion").click(function () {
        count += 1;
        arcount += 1;
        //var new_question = '<article class="col-12 article"><div class="article__heading"><h1>Question '+count+'</h1></div><div class="form-row mt-md-5 align-items-start align-items-lg-center"><div class="col-md-4"><label for="question__type">Question type</label></div><div class="col-md-8"><div class="row align-items-center"><div class="col-lg-6"><select id="question__type" class="question-type form-control"><option value="standard__question">Standard</option><option value="multiple__choice__question">Multiple choice</option><option value="numeric__question">Numeric</option></select></div><div class="col-lg-2 d-flex align-items-center justify-content-center"><p class="my-2 m-lg-0">OR</p></div><div class="col-lg-4"><a class="d-block btn btn-outline-primary suggested_q_link" href="#" data-toggle="modal" data-target="#suggestedQuestion"><span style="color:var(--orange)">Use a suggested question</span></a></div></div></div></div><div class="form-row"><div class="col-md-4"><label for="question">Question</label></div><div class="col-md-8"><input name="question" type="text" class="question form-control"></div></div><div class="form-row"><div class="col-md-4"><label>Add media</label></div><div class="col-md-8"><div class="row "><div class="col-md-4 pr-0"><a href="#" class="btn btn-outline-secondary d-block hasPlus" data-toggle="modal" data-target="#add__media" data-title="Image" data-add-text="an image">Image</a></div><div class="col-md-4 pr-0"><a href="#" class="btn btn-outline-secondary d-block hasPlus" data-toggle="modal" data-target="#add__media" data-title="Audio" data-add-text="any audio file">Audio</a></div><div class="col-md-4"><a href="#" class="btn btn-outline-secondary d-block hasPlus" data-toggle="modal" data-target="#add__media" data-title="Video" data-add-text="any video file">Video</a></div></div></div><div class="modal" id="add__media" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true"> <div class="modal-dialog" role="document"><div class="modal-content"> <div class="modal-header justify-content-center"><h1 class="modal-title" id="add__media__modal__heading"></h1><button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span></button> </div><div class="modal-body"><p class="text-center py-2">Add <span id="add__media__text"></span> to reference in your question</p><div class="form-row"><div class="col-md-4"><label>Add link</label></div><div class="col-md-8"><input type="url" name="add_link_to_media" class="form-control"></div></div><div class="text-center w-100"> <span>OR</span></div><div class="form-row justify-content-center pt-3"><div class="col-md-3"> <label class="d-block" for="upload__media__file">Upload<input type="file" class="form-control-file" id="upload__media__file" value="Upload"></label></div></div></div><div class="modal-footer justify-content-center"> <div class="col-sm-4"><button type="button" class="d-block btn btn-primary">Save</button> </div></div></div></div></div></div><div class="form-row d-flex" id="standard__answer"><div class="col-md-4"><label for="standard__question__answer">Answer</label></div><div class="col-md-8"><input class="form-control answer" name="standard__question__answer" type="text"></div></div><div class="form-row d-none" id="numeric__answer"><div class="col-md-4"><label for="numeric__question__answer">Answer</label></div><div class="col-md-8"><input class="form-control" name="numeric__question__answer" type="number"></div></div><div class="form-row d-none" style="min-height:0;" id="multiple__choice__legend"><div class="offset-md-10 col-2"><small class="d-block text-center pl-4">Correct answer</small></div></div><div class="form-row d-none" id="multiple__choice__answer"><div class="col-md-4 align-self-start"><label for="multiple__choice__answer">Answer</label></div><div class="col-md-8"><div class="row multiple__choice__row pb-3 align-items-center"><div class="col-7"><input name="multiple__choice__answer__1" class="form-control" type="text"> </div><div class="col-1 justify-content-center">&nbsp;</div><div class="col-1 justify-content-center"><span class="plus">+</span></div><div class="col-3 text-center form-check"><input type="radio" class="" name="multiple__choice__correct__answer"></div></div></div></div><div class="form-row"><div class="col-md-4"><label for="time__limit">Time limit</label></div><div class="col-md-4"><input class="form-control time-limit" type="number" name="time__limit"></div><div class="col"><small class="form-text text-muted">Seconds</small></div></div></article>';
        var new_question =
            '<article class="col-12 article"><div class="article_question"> <div class="article__heading"> <h1>Question ' +
            count +
            '</h1> <button type="button" class="close question-close" aria-lable="Close"><span aria-hidden="true">&times;</span></button></div> <div class="form-row mt-md-5 align-items-start align-items-lg-center"> <div class="col-md-4"> <label for="question__type">Question type</label> </div> <div class="col-md-8"> <div class="row align-items-center"> <div class="col-lg-6"> <select name="question__type[]" id="question__type" class="form-control question__type"> <option value="standard__question">Standard</option> <option value="multiple__choice__question">Multiple choice</option> <option value="numeric__question">Numeric</option> </select> </div> <div class="col-lg-2 d-flex align-items-center justify-content-center"> <p class="my-2 m-lg-0">OR</p> </div> <div class="col-lg-4"> <a class="d-block btn btn-outline-primary suggested_q_link" href="#" data-toggle="modal" data-target="#suggestedQuestion"> <span style="color:var(--orange)">Use a suggested question</span> </a> </div> </div> </div> </div> <div class="form-row"> <div class="col-md-4"> <label for="question">Question</label> </div> <div class="col-md-8"> <input name="question[]" type="text" class="question form-control"> </div> </div> <div class="form-row"> <div class="col-md-4"> <label>Add media</label> </div> <div class="col-md-8"> <div class="row mt-3"> <div class="col-md-4 pr-md-0 mb-3 mb-lg-0"><input type="hidden"  name="hidden-media-image' +
            arcount +
            '" class="hidden-media-image" value=""><a href="#" class="btn btn-outline-secondary d-block " data-toggle="modal" data-target="#add__image__media' +
            count +
            '" data-title="Image" data-add-text="an image"><span class="pr-2 icon_"><i class="far fa-image"></i></span>Image</a> </div> <div class="col-md-4 pr-md-0 mb-3 mb-lg-0"><input type="hidden"  name="hidden-media-audio' +
            arcount +
            '" class="hidden-media-audio" value=""><a href="#" class="btn btn-outline-secondary d-block" data-toggle="modal" data-target="#add__audio__media' +
            count +
            '" data-title="Audio" data-add-text="any audio file"><span class="pr-2 icon_"><i class="fas fa-music"></i></span>Audio</a> </div> <div class="col-md-4 pr-md-0 pr-md-3"><input type="hidden"  name="hidden-media-video' +
            arcount +
            '" class="hidden-media-video" value=""><a href="#" class="btn btn-outline-secondary d-block " data-toggle="modal" data-target="#add__video__media' +
            count +
            '" data-title="Video" data-add-text="any video file"><span class="pr-2 icon_"><i class="fas fa-video"></i></span>Video</a> </div> </div> </div> <div class="modal" id="add__image__media' +
            count +
            '" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true"><div class="modal-dialog" role="document"> <div class="modal-content"> <div class="modal-header "> <h1 class="modal-title" id="add__image__media__modal__heading"></h1> <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button> </div> <div class="modal-body"> <p class="text-center py-2">Add <span id="add__image__media__text"></span> to reference in your question</p> <div class="form-row"> <div class="col-md-4"> <label>Add link image ' +
            count +
            '</label> </div> <div class="col-md-8"> <input type="url" name="add_link_to_image__media__' +
            arcount +
            '" class="form-control add-image-media-link" id="add__image__media__text"> </div> </div> <div class="text-center w-100"> <span>OR</span> </div> <div class="form-row justify-content-center pt-3"> <div class="col-md-3"> <label class="d-block" for="upload__image__media__file__' +
            arcount +
            '">Upload <input type="file" class="form-control-file" id="upload__image__media__file__' +
            arcount +
            '" value="Upload" name="image_media_' +
            arcount +
            '"> </label> </div> </div> </div> <div class="modal-footer justify-content-center"> <div class="col-sm-4"> <button type="button" class="d-block btn btn-primary" data-dismiss="modal">Save</button> </div> </div> </div> </div> </div> <div class="modal" id="add__audio__media' +
            count +
            '" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true"> <div class="modal-dialog" role="document"> <div class="modal-content"> <div class="modal-header"> <h1 class="modal-title" id="add__audio__media__modal__heading"></h1> <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button> </div> <div class="modal-body"> <p class="text-center py-2">Add <span id="add__audio__media__text"></span> to reference in your question</p> <div class="form-row"> <div class="col-md-4"> <label>Add link audio ' +
            count +
            '</label> </div> <div class="col-md-8"> <input type="url" name="add_link_to_audio__media__' +
            arcount +
            '" class="form-control add-audio-media-link" id="add__audio__media__text"> </div> </div> <div class="text-center w-100"> <span>OR</span> </div> <div class="form-row justify-content-center pt-3"> <div class="col-md-3"> <label class="d-block" for="upload__audio__media__file">Upload <input type="file" class="form-control-file" id="upload__audio__media__file__' +
            arcount +
            '" value="Upload" name="audio_media_' +
            arcount +
            '"> </label> </div> </div> </div> <div class="modal-footer justify-content-center"> <div class="col-sm-4"> <button type="button" class="d-block btn btn-primary" data-dismiss="modal">Save</button> </div> </div> </div> </div> </div> <div class="modal" id="add__video__media' +
            count +
            '" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true"> <div class="modal-dialog" role="document"> <div class="modal-content"> <div class="modal-header"> <h1 class="modal-title" id="add__video__media__modal__heading"></h1> <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button> </div> <div class="modal-body"> <p class="text-center py-2">Add <span id="add__video__media__text"></span>to reference in your question</p> <div class="form-row"> <div class="col-md-4"> <label>Add link video' +
            count +
            '</label> </div> <div class="col-md-8"> <input type="url" name="add_link_to_video__media__' +
            arcount +
            '" class="form-control add-video-media-link" id="add__video__media__text"> </div> </div> <div class="text-center w-100"> <span>OR</span> </div> <div class="form-row justify-content-center pt-3"> <div class="col-md-3"> <label class="d-block" for="upload__video__media__file">Upload <input type="file" class="form-control-file" id="upload__video__media__file__' +
            arcount +
            '" value="Upload" name="video_media_' +
            arcount +
            '"> </label> </div> </div> </div> <div class="modal-footer justify-content-center"> <div class="col-sm-4"> <button type="button" class="d-block btn btn-primary" data-dismiss="modal">Save</button> </div> </div> </div> </div> </div> </div> <div class="form-row d-flex standard__answer" id="standard__answer"> <div class="col-md-4"><label for="standard__question__answer">Answer</label> </div> <div class="col-md-8"> <input class="form-control answer" name="standard__question__answer__' +
            arcount +
            '" type="text" required> </div> </div> <div class="form-row d-none numeric__answer" id="numeric__answer"> <div class="col-md-4"> <label for="numeric__question__answer">Answer</label> </div> <div class="col-md-8"> <input class="form-control" name="numeric__question__answer__' +
            arcount +
            '" type="number"> </div> </div> <div class="form-row d-none multiple__choice__legend" style="min-height:0;" id="multiple__choice__legend"> <div class="offset-md-10 col-2"><small class="d-block text-center pl-4">Correct answer</small> </div> </div> <div class="form-row d-none multiple__choice__answer" id="multiple__choice__answer"> <div class="col-md-4 align-self-start"> <label for="multiple__choice__answer">Answer</label> </div> <div class="col-md-8 multi-choice"> <div class="row multiple__choice__row pb-3 align-items-center"> <div class="col-7"><input name="multiple__choice__answer__' +
            arcount +
            '[]" class="multiple-choice-answer first-multi-answer form-control" type="text"> </div> <div class="col-1 justify-content-center">&nbsp; </div> <div class="col-1 justify-content-center"> <span class="plus">+</span> </div> <div class="col-3 text-center form-check"> <input type="radio" class="multiple-choice-correct-answer" name="multiple__choice__correct__answer__' +
            arcount +
            '" value=0 > </div> </div> </div> </div> <div class="form-row"> <div class="col-md-4"> <label for="time__limit">Time limit</label> </div> <div class="col-md-4"><input class="form-control time-limit" type="number" name="time__limit[]"> </div> <div class="col"> <small class="form-text text-muted">Seconds</small> </div> </div> </div> </div> </div> </div> </article>';
        $("#add-new-question").before(new_question);

        //sam backup
        // 	       var new_question ='<article class="col-12 article"><div class="article_question"> <div class="article__heading"> <h1>Question ' + count + '</h1> </div> <div class="form-row mt-md-5 align-items-start align-items-lg-center"> <div class="col-md-4"> <label for="question__type">Question type</label> </div> <div class="col-md-8"> <div class="row align-items-center"> <div class="col-lg-6"> <select name="question__type[]" id="question__type" class="form-control question__type"> <option value="standard__question">Standard</option> <option value="multiple__choice__question">Multiple choice</option> <option value="numeric__question">Numeric</option> </select> </div> <div class="col-lg-2 d-flex align-items-center justify-content-center"> <p class="my-2 m-lg-0">OR</p> </div> <div class="col-lg-4"> <a class="d-block btn btn-outline-primary suggested_q_link" href="#" data-toggle="modal" data-target="#suggestedQuestion"> <span style="color:var(--orange)">Use a suggested question</span> </a> </div> </div> </div> </div> <div class="form-row"> <div class="col-md-4"> <label for="question">Question</label> </div> <div class="col-md-8"> <input name="question[]" type="text" class="question form-control"> </div> </div> <div class="form-row"> <div class="col-md-4"> <label>Add media</label> </div> <div class="col-md-8"> <div class="row mt-3"> <div class="col-md-4 pr-md-0 mb-3 mb-lg-0"><input type="hidden"  name="hidden-media-image' +arcount+ '" class="hidden-media-image" value=""><a href="#" class="btn btn-outline-secondary d-block " data-toggle="modal" data-target="#add__image__media' + count + '" data-title="Image" data-add-text="an image"><span class="pr-2 icon_"><i class="far fa-image"></i></span>Image</a> </div> <div class="col-md-4 pr-md-0 mb-3 mb-lg-0"><input type="hidden"  name="hidden-media-audio' +arcount+ '" class="hidden-media-audio" value=""><a href="#" class="btn btn-outline-secondary d-block" data-toggle="modal" data-target="#add__audio__media' + count + '" data-title="Audio" data-add-text="any audio file"><span class="pr-2 icon_"><i class="fas fa-music"></i></span>Audio</a> </div> <div class="col-md-4 pr-md-0 pr-md-3"><input type="hidden"  name="hidden-media-video' +arcount+ '" class="hidden-media-video" value=""><a href="#" class="btn btn-outline-secondary d-block " data-toggle="modal" data-target="#add__video__media' + count + '" data-title="Video" data-add-text="any video file"><span class="pr-2 icon_"><i class="fas fa-video"></i></span>Video</a> </div> </div> </div> <div class="modal" id="add__image__media' + count + '" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true"><div class="modal-dialog" role="document"> <div class="modal-content"> <div class="modal-header justify-content-center"> <h1 class="modal-title" id="add__image__media__modal__heading"></h1> <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button> </div> <div class="modal-body"> <p class="text-center py-2">Add <span id="add__image__media__text"></span> to reference in your question</p> <div class="form-row"> <div class="col-md-4"> <label>Add link image ' + count + '</label> </div> <div class="col-md-8"> <input type="url" name="add_link_to_image__media__'+arcount+'" class="form-control add-image-media-link" id="add__image__media__text"> </div> </div> <div class="text-center w-100"> <span>OR</span> </div> <div class="form-row justify-content-center pt-3"> <div class="col-md-3"> <label class="d-block" for="upload__image__media__file__'+arcount+'">Upload <input type="file" class="form-control-file" id="upload__image__media__file__'+arcount+'" value="Upload" name="image_media_'+arcount+'"> </label> </div> </div> </div> <div class="modal-footer justify-content-center"> <div class="col-sm-4"> <button type="button" class="d-block btn btn-primary" data-dismiss="modal">Save</button> </div> </div> </div> </div> </div> <div class="modal" id="add__audio__media' + count + '" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true"> <div class="modal-dialog" role="document"> <div class="modal-content"> <div class="modal-header justify-content-center"> <h1 class="modal-title" id="add__audio__media__modal__heading"></h1> <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button> </div> <div class="modal-body"> <p class="text-center py-2">Add <span id="add__audio__media__text"></span> to reference in your question</p> <div class="form-row"> <div class="col-md-4"> <label>Add link audio ' + count + '</label> </div> <div class="col-md-8"> <input type="url" name="add_link_to_audio__media__'+arcount+'" class="form-control add-audio-media-link" id="add__audio__media__text"> </div> </div> <div class="text-center w-100"> <span>OR</span> </div> <div class="form-row justify-content-center pt-3"> <div class="col-md-3"> <label class="d-block" for="upload__audio__media__file">Upload <input type="file" class="form-control-file" id="upload__audio__media__file__'+arcount+'" value="Upload" name="audio_media_'+arcount+'"> </label> </div> </div> </div> <div class="modal-footer justify-content-center"> <div class="col-sm-4"> <button type="button" class="d-block btn btn-primary" data-dismiss="modal">Save</button> </div> </div> </div> </div> </div> <div class="modal" id="add__video__media' + count + '" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true"> <div class="modal-dialog" role="document"> <div class="modal-content"> <div class="modal-header justify-content-center"> <h1 class="modal-title" id="add__video__media__modal__heading"></h1> <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button> </div> <div class="modal-body"> <p class="text-center py-2">Add <span id="add__video__media__text"></span>to reference in your question</p> <div class="form-row"> <div class="col-md-4"> <label>Add link video' + count + '</label> </div> <div class="col-md-8"> <input type="url" name="add_link_to_video__media__'+arcount+'" class="form-control add-video-media-link" id="add__video__media__text"> </div> </div> <div class="text-center w-100"> <span>OR</span> </div> <div class="form-row justify-content-center pt-3"> <div class="col-md-3"> <label class="d-block" for="upload__video__media__file">Upload <input type="file" class="form-control-file" id="upload__video__media__file__'+arcount+'" value="Upload" name="video_media_'+arcount+'"> </label> </div> </div> </div> <div class="modal-footer justify-content-center"> <div class="col-sm-4"> <button type="button" class="d-block btn btn-primary" data-dismiss="modal">Save</button> </div> </div> </div> </div> </div> </div> <div class="form-row d-flex standard__answer" id="standard__answer"> <div class="col-md-4"><label for="standard__question__answer">Answer</label> </div> <div class="col-md-8"> <input class="form-control answer" name="standard__question__answer__'+arcount+'" type="text"> </div> </div> <div class="form-row d-none numeric__answer" id="numeric__answer"> <div class="col-md-4"> <label for="numeric__question__answer">Answer</label> </div> <div class="col-md-8"> <input class="form-control" name="numeric__question__answer__'+arcount+'" type="number"> </div> </div> <div class="form-row d-none multiple__choice__legend" style="min-height:0;" id="multiple__choice__legend"> <div class="offset-md-10 col-2"><small class="d-block text-center pl-4">Correct answer</small> </div> </div> <div class="form-row d-none multiple__choice__answer" id="multiple__choice__answer"> <div class="col-md-4 align-self-start"> <label for="multiple__choice__answer">Answer</label> </div> <div class="col-md-8 multi-choice"> <div class="row multiple__choice__row pb-3 align-items-center"> <div class="col-7"><input name="multiple__choice__answer__'+arcount+'[]" class="multiple-choice-answer first-multi-answer form-control" type="text"> </div> <div class="col-1 justify-content-center">&nbsp; </div> <div class="col-1 justify-content-center"> <span class="plus">+</span> </div> <div class="col-3 text-center form-check"> <input type="radio" class="multiple-choice-correct-answer" name="multiple__choice__correct__answer__'+arcount+'" value=0 > </div> </div> </div> </div> <div class="form-row"> <div class="col-md-4"> <label for="time__limit">Time limit</label> </div> <div class="col-md-4"><input class="form-control time-limit" type="number" name="time__limit[]"> </div> <div class="col"> <small class="form-text text-muted">Seconds</small> </div> </div> </div> </div> </div> </div> </article>';

        //thushapan
        //      var new_question ='<article class="col-12 article"><div class="article_question"> <div class="article__heading"> <h1>Question ' + count + '</h1> </div> <div class="form-row mt-md-5 align-items-start align-items-lg-center"> <div class="col-md-4"> <label for="question__type">Question type</label> </div> <div class="col-md-8"> <div class="row align-items-center"> <div class="col-lg-6"> <select name="question__type[]" id="question__type" class="form-control question__type"> <option value="standard__question">Standard</option> <option value="multiple__choice__question">Multiple choice</option> <option value="numeric__question">Numeric</option> </select> </div> <div class="col-lg-2 d-flex align-items-center justify-content-center"> <p class="my-2 m-lg-0">OR</p> </div> <div class="col-lg-4"> <a class="d-block btn btn-outline-primary suggested_q_link" href="#" data-toggle="modal" data-target="#suggestedQuestion"> <span style="color:var(--orange)">Use a suggested question</span> </a> </div> </div> </div> </div> <div class="form-row"> <div class="col-md-4"> <label for="question">Question</label> </div> <div class="col-md-8"> <input name="question[]" type="text" class="question form-control"> </div> </div> <div class="form-row"> <div class="col-md-4"> <label>Add media</label> </div> <div class="col-md-8"> <div class="row mt-3"> <div class="col-md-4 pr-md-0 mb-3 mb-lg-0"> <a href="#" class="btn btn-outline-secondary d-block hasPlus" data-toggle="modal" data-target="#add__image__media' + count + '" data-title="Image" data-add-text="an image">Image</a> </div> <div class="col-md-4 pr-md-0 mb-3 mb-lg-0"> <a href="#" class="btn btn-outline-secondary d-block hasPlus" data-toggle="modal" data-target="#add__audio__media' + count + '" data-title="Audio" data-add-text="any audio file">Audio</a> </div> <div class="col-md-4 pr-md-0 pr-md-3"> <a href="#" class="btn btn-outline-secondary d-block hasPlus" data-toggle="modal" data-target="#add__video__media' + count + '" data-title="Video" data-add-text="any video file">Video</a> </div> </div> </div> <div class="modal" id="add__image__media' + count + '" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true"><div class="modal-dialog" role="document"> <div class="modal-content"> <div class="modal-header justify-content-center"> <h1 class="modal-title" id="add__image__media__modal__heading"></h1> <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button> </div> <div class="modal-body"> <p class="text-center py-2">Add <span id="add__image__media__text"></span> to reference in your question</p> <div class="form-row"> <div class="col-md-4"> <label>Add link image ' + count + '</label> </div> <div class="col-md-8"> <input type="url" name="add_link_to_image__media__'+arcount+'" class="form-control" id="add__image__media__text"> </div> </div> <div class="text-center w-100"> <span>OR</span> </div> <div class="form-row justify-content-center pt-3"> <div class="col-md-3"> <label class="d-block" for="upload__image__media__file__'+arcount+'">Upload <input type="file" class="form-control-file" id="upload__image__media__file__'+arcount+'" value="Upload" name="image_media_'+arcount+'"> </label> </div> </div> </div> <div class="modal-footer justify-content-center"> <div class="col-sm-4"> <button type="button" class="d-block btn btn-primary" data-dismiss="modal">Save</button> </div> </div> </div> </div> </div> <div class="modal" id="add__audio__media' + count + '" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true"> <div class="modal-dialog" role="document"> <div class="modal-content"> <div class="modal-header justify-content-center"> <h1 class="modal-title" id="add__audio__media__modal__heading"></h1> <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button> </div> <div class="modal-body"> <p class="text-center py-2">Add <span id="add__audio__media__text"></span> to reference in your question</p> <div class="form-row"> <div class="col-md-4"> <label>Add link audio ' + count + '</label> </div> <div class="col-md-8"> <input type="url" name="add_link_to_audio__media__'+arcount+'" class="form-control" id="add__audio__media__text"> </div> </div> <div class="text-center w-100"> <span>OR</span> </div> <div class="form-row justify-content-center pt-3"> <div class="col-md-3"> <label class="d-block" for="upload__audio__media__file__'+arcount+'">Upload <input type="file" class="form-control-file" id="upload__audio__media__file__'+arcount+'" value="Upload" name="audio_media_'+arcount+'"> </label> </div> </div> </div> <div class="modal-footer justify-content-center"> <div class="col-sm-4"> <button type="button" class="d-block btn btn-primary" data-dismiss="modal">Save</button> </div> </div> </div> </div> </div> <div class="modal" id="add__video__media' + count + '" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true"> <div class="modal-dialog" role="document"> <div class="modal-content"> <div class="modal-header justify-content-center"> <h1 class="modal-title" id="add__video__media__modal__heading"></h1> <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button> </div> <div class="modal-body"> <p class="text-center py-2">Add <span id="add__video__media__text"></span>to reference in your question</p> <div class="form-row"> <div class="col-md-4"> <label>Add link video' + count + '</label> </div> <div class="col-md-8"> <input type="url" name="add_link_to_video__media__'+arcount+'" class="form-control" id="add__video__media__text"> </div> </div> <div class="text-center w-100"> <span>OR</span> </div> <div class="form-row justify-content-center pt-3"> <div class="col-md-3"> <label class="d-block" for="upload__video__media__file__'+arcount+'">Upload <input type="file" class="form-control-file" id="upload__video__media__file__'+arcount+'" value="Upload" name="video_media_'+arcount+'"> </label> </div> </div> </div> <div class="modal-footer justify-content-center"> <div class="col-sm-4"> <button type="button" class="d-block btn btn-primary" data-dismiss="modal">Save</button> </div> </div> </div> </div> </div> </div> <div class="form-row d-flex standard__answer" id="standard__answer"> <div class="col-md-4"><label for="standard__question__answer">Answer</label> </div> <div class="col-md-8"> <input class="form-control answer" name="standard__question__answer__'+arcount+'" type="text"> </div> </div> <div class="form-row d-none numeric__answer" id="numeric__answer"> <div class="col-md-4"> <label for="numeric__question__answer">Answer</label> </div> <div class="col-md-8"> <input class="form-control" name="numeric__question__answer__'+arcount+'" type="number"> </div> </div> <div class="form-row d-none multiple__choice__legend" style="min-height:0;" id="multiple__choice__legend"> <div class="offset-md-10 col-2"><small class="d-block text-center pl-4">Correct answer</small> </div> </div> <div class="form-row d-none multiple__choice__answer" id="multiple__choice__answer"> <div class="col-md-4 align-self-start"> <label for="multiple__choice__answer">Answer</label> </div> <div class="col-md-8 multi-choice"> <div class="row multiple__choice__row pb-3 align-items-center"> <div class="col-7"><input name="multiple__choice__answer__'+arcount+'[]" class="multiple-choice-answer first-multi-answer form-control" type="text"> </div> <div class="col-1 justify-content-center">&nbsp; </div> <div class="col-1 justify-content-center"> <span class="plus">+</span> </div> <div class="col-3 text-center form-check"> <input type="radio" class="multiple-choice-correct-answer" name="multiple__choice__correct__answer__'+arcount+'" value=0 > </div> </div> </div> </div> <div class="form-row"> <div class="col-md-4"> <label for="time__limit">Time limit</label> </div> <div class="col-md-4"><input class="form-control time-limit" type="number" name="time__limit[]"> </div> <div class="col"> <small class="form-text text-muted">Seconds</small> </div> </div> </div> </div> </div> </div> </article>';
        // $('#add-new-question').before(new_question);
    });

    /***delete method */
    $("body").on("click", ".question-close", function (e) {
        e.preventDefault();
        var id = $(this)
            .closest(".article")
            .find(".article_question")
            .attr("id");
        if (id == null) {
            count--;
            arcount--;

            $(this).closest(".article").remove();
        }
    });

    // When the user clicks "Edit Question" while viewing the Suggested Questions...
    $(".single__suggested__question").each(function () {
        var parent = $(this);
        $("body").delegate(".edit__question", "click", parent, function (e) {
            e.preventDefault();

            $(".readonly", parent).removeAttr("readonly");
            $(".disabled", parent).removeAttr("disabled");
            $("p.the_question input", parent).focus();
            $(".d-none", parent).addClass("hidd").removeClass("d-none");
            $(".invisible", parent)
                .addClass("tempVis")
                .removeClass("invisible");
            if ($(this).text() == "Done editing") {
                $(this).text("Edit question");
                $(".readonly", parent).attr("readonly", "readonly");
                $(".disabled", parent).attr("disabled", "disabled");
                $(".hidd").addClass("d-none").removeClass("hidd");
                $(".tempVis").addClass("invisible").removeClass("tempVis");
            } else {
                $(this).text("Done editing");
            }
        });

        $("#suggested__question__type", parent).on("change", function () {
            if ($(this).val() !== "multiple") {
                $(".answers__label", parent).text("Answer: ");
                $(".hidd", parent).addClass("d-none").removeClass("hidd");
                $(".tempVis", parent)
                    .addClass("invisible")
                    .removeClass("tempVis");
                $(
                    ".multiple__choice__row__in_modal:not(:first-child)",
                    parent
                ).hide();
            } else {
                $(".answers__label", parent).text("Answers: ");
                $(".d-none", parent).removeClass("d-none").addClass("hidd");
                $(".invisible", parent)
                    .removeClass("invisible")
                    .addClass("tempVis");
                $(
                    ".multiple__choice__row__in_modal:not(:first-child)",
                    parent
                ).show();
            }
        });
    });

        $('.view-card').click(function(e){ console.log('hi round');

        //    e.preventDefault();
        // $.ajax({
        //     data: $('#add_round').serialize(),
        //     type: 'post',
        //     url: $('#add_round').attr('action'),
        //     headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        //     success: function(response) {
        //         $('#publishQuizModal').modal("show");

    	// 	},
    	// 	error: function(result,error) {
        //         console.log('errror');
    	// 	   //$('#publishQuizModal').modal("show");
    	// 	   },
        // });

        $.ajax({
            type: "POST",
            url: "/payment",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                    "content"
                ),
            },
            data: {
                count: sessionStorage.count,
            },
            success: function (data) {
                $('#publishQuizModal').modal("show");
                var participants = data.participants.no_of_participants;
                var participants_cost = data.participants_cost[0].cost;
                var questions_cost = 0;
                console.log(typeof participants_cost);
                $("#modal__payment")
                    .find(".no-participants td:nth-child(2)")
                    .text(participants);
                $("#modal__payment")
                    .find(".no-participants td:nth-child(3)")
                    .text(participants_cost);

                $("#modal__payment")
                    .find(".suggested-questions td:nth-child(2)")
                    .text(sessionStorage.count);

                if (data.question_cost != null) {
                    $("#modal__payment")
                        .find(".suggested-questions td:nth-child(3)")
                        .text(data.question_cost.cost);
                    questions_cost = data.question_cost.cost;
                } else {
                    $("#modal__payment")
                        .find(".suggested-questions td:nth-child(3)")
                        .text(0);
                    questions_cost = 0;
                }

                var customised_backgrounds_details = $(
                    "#modal__payment"
                )
                    .find(".customised-backgrounds td:nth-child(2)")
                    .text(data.bg_image);
                var customised_backgrounds_price = $("#modal__payment")
                    .find(".customised-backgrounds td:nth-child(3)")
                    .text(data.bg_image_cost.cost);

                $("#modal__payment")
                    .find(".total-cost td:nth-child(2)>strong")
                    .text(
                        Number(participants_cost) +
                            Number(questions_cost) +
                            Number(data.bg_image_cost.cost)
                    );
                var total_card =
                    Number(participants_cost) +
                    Number(questions_cost) +
                    Number(data.bg_image_cost.cost);
                $("#card_total").val(total_card);
            },
            error: function (result, error) {},
        });
        return false;

       });

       
});
