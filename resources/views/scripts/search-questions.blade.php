<script>

    $(function() {
        
        var questionsTable = $('#questions_table');
        var resultsContainer = $('#search_results');
        var searchform = $('#search_questions');
        var searchformInput = $('#question_search_box');
        var searchSubmit = $('#search_trigger');
        
        searchform.submit(function(e) {
           
            e.preventDefault();
            resultsContainer.html('');
            let noResulsHtml = '<tr>' +
                                '<td>{!! trans("usersmanagement.search.no-results") !!}</td>' +
                                '<td></td>' +
                                '<td class="hidden-xs"></td>' +
                                '<td class="hidden-xs"></td>' +
                                '<td></td>' +
                                '<td></td>' +
                                '</tr>';
                                
            $.ajax({
                type:'POST',
                url: "{{ route('search-questions') }}",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: searchform.serialize(),
                success: function (results) {
                    let jsonData = JSON.parse(results);
                    if (jsonData.length != 0) {
                        questionsTable.hide();
                        $.each(jsonData, function(index, val) {
                            let editCellHtml = '<div class="d-flex flex-column"><i class="fas fa-pencil-alt"></i><span>Edit</span><div>';
                            let deleteCellHtml =  '<div class="d-flex flex-column"><i class="fas fa-times-circle"></i><span>Delete</span></div>';
											
                            
                            
                            resultsContainer.append('<tr>' +
                                
                                '<td>' + val.question + '</td>' +
                                '<td class="hidden-xs">' + val.category + '</td>' +
                               '<td class="quiz_actions  justify-content-lg-center">' + editCellHtml + '</td>' +
                                '<td class="quiz_actions   justify-content-lg-center" >' + deleteCellHtml + '</td>' +

                                
                            '</tr>');
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
            if ($('#question_search_box').val() != '') {
                questionsTable.hide();
            } else {
                
                resultsContainer.html('');
                questionsTable.show();
                
            };
        });
        
    });
</script>
