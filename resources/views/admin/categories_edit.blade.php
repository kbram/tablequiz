@extends('layouts.tablequizapp')

@section('content')
<section class="container page__inner dashboard">
	<div class="row dashboard__wrapper">
		
		<aside class="col-lg-3 dashboard__sidebar d-flex flex-column">
			<h2>Menu</h2>
			<div class="dashboard__container flex-grow-1 d-flex flex-column justify-content-between">
				
				<ul class="list-unstyled m-0 p-0 text-sm-center text-lg-left">
					<li>
						<a href="/admin/home">
							<span><i class="fas fa-home"></i></span>
							Overview
						</a>
					</li>
					<li>
						<a href="/admin/quizzes">
							<span><i class="fas fa-briefcase"></i></span>
							Quizzes
						</a>
					</li>
					<li>
						<a href="/admin/users">
							<span><i class="fas fa-users"></i></span>
							Users
						</a>
					</li>
					<li>
						<a href="/admin/financials">
							<span><i class="fas fa-coins"></i></span>
							Financials
						</a>
					</li>
					<li class="active">
						<a href="/admin/categories">
							<span><i class="fas fa-th-large"></i></span>
							Categories
						</a>
					</li>
					<li>
						<a href="/admin/questions">
							<span><i class="fas fa-question-circle"></i></span>
							Questions
						</a>
					</li>
					
				</ul>
			</div>
		</aside>
		
		<section class="col-lg-9 dashboard__content">
			<div class="row">
				<div class="col-12">
					<div class="row">
						<div class="col-lg-9">
							<h2>Categories</h2>
						</div>
					</div>
					
					
					<div class="dashboard__container flex-grow-0 pt-4 mb-3">
						<h3>Edit category</h3>
						<form action="/admin/categories/update/{{$category->id}}" enctype="multipart/form-data" method="post" class="pt-3">
						@csrf
							<div class="form-row">
								<div class="col-12 col-md-3 text-left">
									<label for="category__name"class="justify-content-start"><small>Category name</small></label>
								</div>
								<div class="col-12 col-md-4 pr-md-2 mb-2 mb-md-0">
									<input type="text" value="{{$category->category_name}}" name="category_name" class="w-100 form-control mx-lg-2 flex-grow-1 d-block" >
								</div>
							
							
								<div class="col-6 col-md-3 text-left">
									<label class="mx-lg-2 justify-content-start"><small>Category image</small></label>
								</div>
								<div class="col-6 col-md-2">
								    
									<label for="upload__category__image" class="orange_text d-block d-md-inline">Upload
									<input type="file" class="orange_text form-control-file" id="upload__category__image" name="upload__category__image" value="Upload"></label>
								</div>
							</div>
							<div class="form-row">
								<div class="col-12 col-md-3 text-left">
									
								</div>
								<div class="col-12 col-md-4 pr-md-2 mb-2 mb-md-0">
									
								</div>
							
							
								<div class="col-6 col-md-3 text-left">
									
								</div>
								<div class="col-6 col-md-2">
										@if(@isset($category->quizCategoryImages()->first()->public_path))
											<img id="image" src="{{asset($category->quizCategoryImages()->first()->public_path)}}" style='border: 3px solid #dee2e6!important;'  class="myImg rounded" width="100px">
										@endif
									
								</div>
							</div>

							<hr>
							<div class="row justify-content-center">
								<div class="col-4">
									<button  class="d-block btn btn-primary" type="submit">Save</button>
								</div>
							</div>						
							
						</form>
						
					</div>

					
					<div class="dashboard__container flex-grow-1">
						<table class="table table-striped table-borderless m-0 h-100 my__quizzes">
							<thead>
								<tr>
									<th>Category name <span><small><i class="fa fa-angle-down"></i></small></span</th>
									<th>Date created <span><small><i class="fa fa-angle-down"></i></small></span</th>
									<th class="text-center">Actions</th>
								</tr>
							</thead>

						
							<tbody>
							  	@foreach($categories as $category)
                                        <tr>
                                            <td>{{$category->category_name}}</td>
											<td>{{date('d/m/Y', strtotime($category->created_at))}}</td>
                                            <td class="quiz_actions d-flex flex-row justify-content-lg-center">
												<div class="d-flex flex-column">
													<i class="fas fa-pencil-alt"></i>
													<a href="{{ URL::to('admin/categories/edit/'.$category->id)}}"><span>Edit</span></a>
												</div>
												<form method="POST" action="/admin/categories/edit/{{$category->id}}" class="p-0">
												{{ csrf_field() }}										
												<div class="d-flex flex-column">
													<i class="fas fa-times-circle"></i>
													<span class="delete">Delete</span>
												</div>
												</form>
											</td>
                                            
                                        </tr>
                                            
                             	@endforeach
								
                            </tbody>
                
							<tfoot>
								<tr>
									<td colspan="6" class="text-center text-muted">
										
									</td>
								</tr>
							</tfoot>
						</table>
						
					</div>
				</div>
			</div>
		</section>
	</div>
	<!-- The Modal -->
<div id="myModal" class="modal">
  <span id="image-close">&times;</span>
  <img class="modal-content" id="img01">
  <div id="caption"></div>
</div>
</section>
@endsection

@section('footer_scripts')
<script>

    $('span.delete').click(function(e){
         
        e.preventDefault() // Don't post the form, unless confirmed
        
        
                swal({
                    title: "Are you sure?",
                    text: "Once you delete a category, all the questions under this category will also be deleted and you can't get it back",
                    buttons: true,
                    dangerMode: true,
                    })
                    .then((willDelete) => {
                    if (willDelete) {
                            $(e.target).closest('form').submit();
                           
                        swal(" Your data has been deleted!", {
                        icon: "success",
                        
                        });
                    } else {
                        swal("Your data is safe!");
                    }
                    // $(e.target).closest('form').submit();
                    });
            
                    // $(e.target.id).closest('form').submit();
    });
</script>
<script>
$(document).ready(function(){
var modal = $("#myModal");

var modalImg = $("#img01");
var captionText = $("#caption");

$("body").delegate(".myImg","click",function(){ 
  modal.css("display","block");
  modalImg.attr('src',this.src);
  captionText.innerHTML = this.alt;
  
});

$('#image-close').click(function(){
	modal.css("display","none");
	
});


});
</script>
<style>
body {font-family: Arial, Helvetica, sans-serif;}

.myImg {
  border-radius: 5px;
  cursor: pointer;
  transition: 0.3s;
}

.myImg:hover {opacity: 0.7;}

/* The Modal (background) */
#myModal{
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 5; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
}

/* Modal Content (image) */
.modal-content {
  margin: auto;
  display: block;
  width: 80%;
  max-width: 700px;
}

/* Caption of Modal Image */
#caption {
  margin: auto;
  display: block;
  width: 80%;
  max-width: 700px;
  text-align: center;
  color: #ccc;
  padding: 10px 0;
  height: 150px;
}

/* Add Animation */
.modal-content, #caption {  
  -webkit-animation-name: zoom;
  -webkit-animation-duration: 0.6s;
  animation-name: zoom;
  animation-duration: 0.6s;
}

@-webkit-keyframes zoom {
  from {-webkit-transform:scale(0)} 
  to {-webkit-transform:scale(1)}
}

@keyframes zoom {
  from {transform:scale(0)} 
  to {transform:scale(1)}
}

/* The Close Button */
#image-close{
  position: absolute;
  top: 15px;
  right: 35px;
  color: #f1f1f1;
  font-size: 40px;
  font-weight: bold;
  transition: 0.3s;
  cursor: pointer;
}

.close:hover,
.close:focus {
  color: #bbb;
  text-decoration: none;
  cursor: pointer;
}

/* 100% Image Width on Smaller Screens */
@media only screen and (max-width: 700px){
  .modal-content {
    width: 100%;
  }
}
</style>
@endsection