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
						<a href="#">
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
				<a href="/quiz/setup" class="btn btn-primary hasPlus d-block">New Quiz</a>
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
						<h3>Add new category</h3>
						<form action="/admin/categories" enctype="multipart/form-data" method="post" class="pt-3">
						@csrf
							<div class="form-row w-100">
								<div class="col-12 col-md-3 text-left">
									<label for="category__name"class="justify-content-start"><small>Category name</small></label>
								</div>
								<div class="col-12 col-md-4 pr-md-2 mb-2 mb-md-0">
									<input type="text" name="category_name" class="w-100 form-control mx-lg-2 flex-grow-1 d-block" required>
								</div>
							


								<div class="col-6 col-md-3 text-left">
										<label class="mx-lg-2 justify-content-start"><small>Category image</small></label>
								</div>
								<div class="col-6 col-md-2">
									<label for="upload__category__image" class="orange_text d-block d-md-inline">Upload
									<input type="file" class="orange_text form-control-file" id="upload__category__image" name="upload__category__image" value="Upload"></label>
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
												
												<form method="POST" action="/admin/categories/{{$category->id}}" class="p-0">
												{{ csrf_field() }}	
												<div class="d-flex flex-column">
												<i class="fas fa-times-circle" ></i><span class="delete">Delete</span>
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
</section>
@endsection

@section('footer_scripts')
@include('scripts.delete-model')
@endsection