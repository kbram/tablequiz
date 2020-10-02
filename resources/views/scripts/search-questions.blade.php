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
                                '<td></td>'+
                                '</tr>';
                                
            $.ajax({
                type:'POST',
                url: "{{ route('search-questions') }}",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: searchform.serialize(),
                success: function (data) {
                    let jsonData = JSON.parse(data[0]);

                    if (jsonData[0].length != 0) {
                        questionsTable.hide();
                        $.each(jsonData[0], function(index, val) {
                            console.log(val);
                            console.log(jsonData[1]);
                            let editCellHtml = '<div class="d-flex flex-column"><i class="fas fa-pencil-alt"></i><span><a href="/questions/'+val.id+'/edit" data-toggle="tooltip" title="edit">Edit</a></span></div> ';
                            let deleteCellHtml = '<form method="POST" action="/admin/questions/'+val.id+'" class="p-0"><input type="hidden" name="_token" value="{{csrf_token()}}"><div class="d-flex flex-column"><i class="fas fa-times-circle"></i><span class="delete">Delete</span></div></form>';
											
                            
                           
                            resultsContainer.append('<tr>' +
                                '<td>' + val.question + '</td>' +
                                '<td >' +jsonData[1][val.category_id] + '</td>' +
                               '<td class="quiz_actions d-flex flex-row justify-content-lg-center">' + editCellHtml + deleteCellHtml + '</td>' +
                               
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
