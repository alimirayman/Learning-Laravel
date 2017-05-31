@extends('layouts.master')

@section('title')
  Home
@endsection

@section('content')
  <script
  src="https://code.jquery.com/jquery-3.2.1.min.js"
  integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
  crossorigin="anonymous"></script>
  <div class="container">
    <div class="h1">
      Learning Laravel
    </div>

    @foreach($actions as $action)
      <a href="{{ route('niceaction', ['action'=>lcfirst($action->name)]) }}" class="pills">{{$action->name}}</a>
    @endforeach
    <br><br>
    @if (count($errors) > 0)
      <div class="alert alert-danger">
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif
    <form class="form-inline" action="{{route('add_action')}}" method="POST">
    
    <label class="custom-control mb-2 mr-sm-3 mb-sm-0" for="name">
      <input type="text" class="form-control" name="name" id="name" placeholder="Name of Action">
    </label>
    <label class="custom-control mb-2 mr-sm-3 mb-sm-0" for="niceness">
      <input type="text" class="form-control" name="niceness" id="niceness" placeholder="niceness">
    </label>
    <button type="submit" class="btn btn-primary" onclick="send(event)" >Add Nice Action</button>
    <input type="hidden" value="{{Session::token()}}" name="_token">
  </form>
  
  <ul>
    @foreach($logged_actions as $lc)
      <li>
        {{$lc->nice_action->name}}
        @foreach($lc->nice_action->categories as $category)
          {{$category->name}}
        @endforeach
      </li>
    @endforeach
  </ul>
  {!! $logged_actions->links() !!}  
  @if($logged_actions->lastPage() > 1)
    @for($i = 1; $i <= $logged_actions->lastPage(); $i++)
      <a href="{{ $logged_actions->url($i) }}">{{$i}}</a>
    @endfor
  @endif

</div>
  
<script type="text/javascript">
  function send(event) {
    event.preventDefault();
    $.ajax({
      type: "POST",
      url: "{{ route('add_action') }}",
      data: {name: $("#name").val() ,niceness: $("#niceness").val(), _token: "{{Session::token()}}" }
    });
    
  }
</script>

@endsection