<script>


    $(function() {
        
        var quizTable = $('#quizzes_table');
        var resultsContainer = $('#search_results');
        var searchform = $('#search_quizzes');
        var searchformInput = $('#quiz_search_box');
        var searchSubmit = $('#search_trigger');
        
        searchform.submit(function(e) {
           
            e.preventDefault();
            resultsContainer.html('');
            let noResulsHtml = '<tr>' +
                                '<td>{!! trans("usersmanagement.search.no-results") !!}</td>' +
                                '<td></td>' +
                                '<td></td>'+
                                '<td></td>'+
                                '</tr>';
                           
            $.ajax({
                type:'POST',
                url: "{{ route('search-quizzes') }}",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: searchform.serialize(),
                success: function (quizzes) {
                    let jsonData = JSON.parse(quizzes);
                    if (jsonData.length != 0) {
                        quizTable.hide();
                       
                        $.each(jsonData, function(index, val) {

                            var block=val.is_blocked;
                            if(block===0){
                                let viewCellHtml = '<div class=" d-flex flex-column" ><i class="far fa-eye"></i><span ><a href="/admin/home/view/'+val.id+'">View Qs</a></span></div>';
                            let shareCellHtml =  '<div class="d-flex flex-column"><i class="fas fa-share-alt"></i><span class="share" id="'+val.id+'">Share</span></div>';
                            let blockCellHtml =  '<form method="POST" action="/admin/home/block/'+val.id+'" class="p-0"><input type="hidden" name="_token" value="{{csrf_token()}}"><div class="d-flex flex-column"><i class="fas fa-times-circle"></i><span class="block" id="block'+val.id+'">Block</span></div></form>';

                            resultsContainer.append('<tr>' +
                                '<td>' + val.quiz__name + '</td>' +
                                '<td class="d-none">' + val.quiz_link + '</td>' +
                                '<td>'+val.username+'</td>'+
                                '<td class="text-lg-center">'+val.roundcount+'</td>'+
                                '<td class="text-lg-center">'+val.questioncount+'</td>'+
                                '<td class="quiz_actions d-flex flex-row justify-content-lg-center">' + viewCellHtml + shareCellHtml +blockCellHtml +  '</td>' +
                            '</tr>');
                            }else{
                                let viewCellHtml = '<div class=" d-flex flex-column" style="pointer-events: none;opacity: 0.4;"><i class="far fa-eye"></i><span ><a href="/admin/home/view/'+val.id+'">View Qs</a></span></div>';
                                let shareCellHtml =  '<div class="d-flex flex-column" style="pointer-events: none;opacity: 0.4;"><i class="fas fa-share-alt"></i><span class="share" id="'+val.id+'">Share</span></div>';
                                let blockCellHtml =  '<form method="POST" action="/admin/home/un-block/'+val.id+'" class="p-0"><input type="hidden" name="_token" value="{{csrf_token()}}"><div class="d-flex flex-column"><i class="fas fa-times-circle"></i><span class="block" id="block'+val.id+'">un-block</span></div></form>';

                            resultsContainer.append('<tr>' +
                                '<td>' + val.quiz__name + '</td>' +
                                '<td class="d-none">' + val.quiz_link + '</td>' +
                                '<td>'+val.username+'</td>'+
                                '<td class="text-lg-center">'+val.roundcount+'</td>'+
                                '<td class="text-lg-center">'+val.questioncount+'</td>'+
                                '<td class="quiz_actions d-flex flex-row justify-content-lg-center">' + viewCellHtml + shareCellHtml +blockCellHtml +  '</td>' +
                            '</tr>');
                            }
                        });
                            
											
                            
                            
                           
                    } else {
                        resultsContainer.append(noResulsHtml);
                    };
                    
                },
                error: function (response, status, error) {
                    if (response.status === 422) {
                        resultsContainer.append(noResulsHtml);
                    };
                },
            });
        });
        searchSubmit.click(function(event) {
            event.preventDefault();
            searchform.submit();
        });
        searchformInput.keyup(function(event) {
            if ($('#quiz_search_box').val() != '') {
                quizTable.hide();
            } else {
                
                resultsContainer.html('');
                quizTable.show();
                
            };
        });
        
    });
</script>
