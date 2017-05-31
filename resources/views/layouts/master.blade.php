<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>@yield('title') | Learning Laravel</title>
	<link rel="stylesheet" href="{{ URL::to('css/app.css') }}">
	@yield('style')
</head>
<body>
	@include('includes.header')
	<div class="main">
		@yield('content')
	</div>
</body>
</html>