@extends('layouts.master')

@section('title')
	Trending Quotes
@endsection

@section('style')

@endsection

@section('content')
<div class="container">
	<!-- Author Page Check -->
	@if(!empty(Request::segment(1)))
		<section class="alert alert-info text-center lead" role="alert" style="min-height: 78px">
			<a href="{{ route('index') }}" class="btn btn-primary pull-left">
				<i class="fa fa-chevron-left" aria-hidden="true"></i>
			</a>
			<strong>Author :</strong> {{$quotes[0]->author->name}}
		</section>
	@endif
	<!-- Errors Alert -->
	@if(count($errors) > 0)
		<section class="alert alert-danger" role="alert">
			<ul>
				@foreach($errors->all() as $error)
					<li>
						{{$error}}
					</li>
				@endforeach
				
			</ul>
		</section>
	@endif
	<!-- Success Alert -->
	@if(Session::has('success'))
		<section class="alert alert-success" role="alert">
			{{Session::get('success')}}
		</section>
	@endif
	<section class="quotes">
		<h1 class="text-center">Latest Quotes</h1>
		<div class="row">
			@foreach($quotes as $quote)
				<div class="col-6">
					<article class="quote card card-inverse card-primary">
						<div class="card-block">
							<div class="delete pull-right">
								<a href=" {{ route('delete', ['quote_id'=> $quote->id]) }} ">
									<i class="fa fa-times" aria-hidden="true"></i>
								</a>
							</div>
							<blockquote class="card-blockquote">
					      <p class="quote_text"> {{ $quote->quote }} </p>
					      <footer class="info">
					      	Created by 
					      	<a href="{{ route('index', ['author' => $quote->author->name ]) }}">
					      		<cite class="author" title="{{ $quote->author->name }}"> {{ $quote->author->name }} </cite>	
					      	</a> 
					      	on 
					      	<span class="date">{{ date('d M Y', $quote->created_at->getTimestamp() ) }}</footer>
					    </blockquote>
						</div>
					</article>
					
				</div>
			@endforeach
		</div>
		<div class="pagination btn-group text-center">
			@if($quotes->currentPage() !== 1)
				<a href="{{ $quotes->previousPageUrl() }}" class="btn btn-secondary"> 
					<i class="fa fa-chevron-left" aria-hidden="true"></i> 
				</a>
			@endif
			@if($quotes->currentPage() !== $quotes->lastPage() && $quotes->hasPages())
				<a href="{{ $quotes->nextPageUrl() }}" class="btn btn-secondary"> 
					<i class="fa fa-chevron-right" aria-hidden="true"></i> 
				</a>
			@endif
		</div>
	</section>
	<section class="edit_quotes">
		<div class="row">
			<div class="col-6 offset-3">
				<div class="card card-outline-primary">
					<div class="card-header card-inverse card-primary">
						<div class="lead text-center ">Add a Quote</div>
					</div>
					<div class="card-block">
						<form method="post" action=" {{ route('create') }} ">
							<div class="form-group row">
						    <label for="author" class="col-2 col-form-label">Author</label>
						    <input type="text" class="form-control col-9" id="author" name="author" placeholder="Your Name">
						  </div>
						  <div class="form-group row">
						    <label for="author" class="col-2 col-form-label">Email</label>
						    <input type="email" class="form-control col-9" id="email" name="email" placeholder="Your Email">
						  </div>
							<div class="form-group row">
						    <label for="quote" class="col-2 col-form-label">Quote</label>
						    <textarea type="text" class="form-control col-9" id="quote" name="quote" placeholder="Your Quote"></textarea>
						  </div>
						  <button type="submit" class="btn btn-primary btn-block">Submit Quote</button>
						  <input type="hidden" name="_token" value="{{ Session::token() }}">
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
@endsection