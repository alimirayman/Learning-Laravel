@extends('layouts.master')

@section('content')
<div class="container">
	<div class="row" style="margin-top: 50px">
		@foreach($authors as $author)
			<div class="col-4" style="margin-bottom: 20px">
				<div class="card card-outline-primary">
					<div class="card-block">
						<div class="lead">{{ $author->name }}</div>
						<p> {{ $author->email }} </p>
					</div>
				</div>
			</div>
		@endforeach
	</div>
</div>
@endsection