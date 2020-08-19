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
                                '</tr>';
                           
            $.ajax({
                type:'POST',
                url: "{{ route('search-quizzes') }}",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: searchform.serialize(),
                success: function (results) {
                    let jsonData = JSON.parse(results);
                    if (jsonData.length != 0) {
                        quizTable.hide();
                        $.each(jsonData, function(index, val) {
                            let editCellHtml = '<div class="d-flex flex-column"><i class="fas fa-pencil-alt"></i><span>Edit</span><div>';
                            let deleteCellHtml =  '<div class="d-flex flex-column"><i class="fas fa-times-circle"></i><span>Delete</span></div>';
											
                            
                            
                            resultsContainer.append('<tr>' +
                                '<td>' + val.quiz__name + '</td>' +
                                '<td>' + val.quiz_link + '</td>' +
                                '<td>'+val.no_of_participants+'</td>'+
                                '<td>' + editCellHtml + '</td>' +
                                '<td>' + deleteCellHtml + '</td>' +
                                '</td>'+
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
            if ($('#quiz_search_box').val() != '') {
                quizTable.hide();
            } else {
                
                resultsContainer.html('');
                quizTable.show();
                
            };
        });
        
    });
</script>
