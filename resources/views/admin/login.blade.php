@extends('layouts.master')

@section('content')
<div class="container" style="margin-top: 50px">
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
	@if(Session::has('fail'))
		<section class="alert alert-danger" role="alert">
			{{Session::get('fail')}}
		</section>
	@endif
	<div class="row">
		<div class="col-8 offset-2">
			<div class="card card-outline-primary">
				<div class="card-header card-inverse card-primary">
					<div class="lead text-center ">Login</div>
				</div>
				<div class="card-block">
					<form method="post" action=" {{ route('admin_login') }} ">
						<div class="form-group row">
					    <label for="name" class="col-2 col-form-label">Name</label>
					    <input type="text" class="form-control col-9" id="name" name="name" placeholder="Your Name">
					  </div>
					  <div class="form-group row">
					    <label for="password" class="col-2 col-form-label">Password</label>
					    <input type="password" class="form-control col-9" id="password" name="password" placeholder="Password">
					  </div>
					  <button type="submit" class="btn btn-primary btn-block">Submit</button>
					  <input type="hidden" name="_token" value="{{ Session::token() }}">
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection