@extends('layouts.master')

@section('title')
  Nice
@endsection

@section('content')
  <div class="container">
    <div class="h1">
      Learning Laravel
    </div>
    @foreach($actions as $action)
      <a href="{{ route('niceaction', ['action'=>lcfirst($action->name)]) }}" class="pills">{{$action->name}}</a>
    @endforeach
    
		<br><br>
		<h1>I {{ $act }} {{ $name }}!</h1>
  </div>
@endsection

