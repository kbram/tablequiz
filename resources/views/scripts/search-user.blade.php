<script>

    $(function() {
        
        var userTable = $('#users_table');
        var resultsContainer = $('#search_results');
        var searchform = $('#search_users');
        var searchformInput = $('#user_search_box');
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
                url: "{{ route('search-users') }}",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: searchform.serialize(),
                success: function (users) {
                    let jsonData = JSON.parse(users);
                    if (jsonData.length != 0) {
                        userTable.hide();
                        $.each(jsonData, function(index, val) {

                            var block = val.is_blocked;
                           if(block == 0){
                            let viewCellHtml = '<div class="d-flex flex-column" ><i class="far fa-eye"></i><span><a href="/admin/'+val.id+'/userquizzes">View Qs</span></div>';
                            let blockCellHtml =  '<form method="POST" action="/admin/home/blockuser/'+val.id+'" class="p-0"><input type="hidden" name="_token" value="{{csrf_token()}}"><div class="d-flex flex-column"><i class="fas fa-times-circle"></i><span class="blockuser" id="block'+val.id+'">Block</span></div></form>';
                            
											
                            
                            
                            resultsContainer.append('<tr>' +
                                '<td>' + val.name + '</td>' +
                                '<td>' + val.quizcount + '</td>' +
                                '<td>'+  val.questioncount  +'</td>'+
                                '<td class="d-none">'+val.email+'</td>'+
                                '<td class="quiz_actions d-flex flex-row justify-content-lg-center">'+ viewCellHtml +blockCellHtml +'</td>'+
                            '</tr>');

                           }else{
                            let viewCellHtml = '<div class="d-flex flex-column" style=" pointer-events: none;opacity: 0.4;"><i class="far fa-eye"></i><span>View Qs</span></div>';
                            let blockCellHtml =  '<form method="POST" action="/admin/home/un-blockuser/'+val.id+'" class="p-0"><input type="hidden" name="_token" value="{{csrf_token()}}"><div class="d-flex flex-column"><i class="fas fa-times-circle"></i><span class="blockuser" id="block'+val.id+'">un-block</span></div></form>';
											
                            
                            
                            resultsContainer.append('<tr>' +
                                '<td>' + val.name + '</td>' +
                                '<td>' + val.quizcount + '</td>' +
                                '<td>'+  val.questioncount  +'</td>'+
                                '<td class="d-none">'+val.email+'</td>'+
                                '<td class="quiz_actions d-flex flex-row justify-content-lg-center">'+ viewCellHtml +blockCellHtml +'</td>'+
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
            if ($('#user_search_box').val() != '') {
                userTable.hide();
            } else {
                
                resultsContainer.html('');
                userTable.show();
                
            };
        });
        
    });
</script>
