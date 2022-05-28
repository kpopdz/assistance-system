@extends('layouts.app')
@section('content')

<div class="container">
    @if(session()->has('error'))
<div class="alert alert-danger">
    {{ session()->get('error') }}
</div>
@endif
<br><br>
<form action="{{route('create.class')}}" method="post">
    @csrf
    @method('POST')
    <div class="form-group" style="padding-top: 2%">

    <h1>create class</h1>
    <hr width="50%" style="padding-left: 20%*">
    <label for="class_name"> class</label>
<input class="form-input"
name="class_name"
 type="text"
  class="form-control"
   placeholder="write the class that you teaching" style="padding-right: 30%">
<input type="submit" value="create" class="btn btn-success">
</div>
</form>
<br><br>

@if ($message=Session::get('success'))
<div class="container" style="padding-top: 2%">
<div class="alert alert-primary" role="alert">
{{$message}}</div>
 </div>
 @endif
<form action="{{route('classes.assigne.end')}}" method="post">
    @csrf
    @method('POST')
<select name="class_id" id="">
    @foreach ($users->classes as $class)

    <option value="{{$class->id }}">{{$class->class_name }}</option>

{{-- {{$class->users->count() }} --}}
@endforeach
</select>
<select name="quiz_id" id="">

@foreach ($quizs as $quiz )
<option value="{{$quiz->id }}" >
    {{$quiz->title }}</option>
@endforeach
</select>
<input type="datetime-local" name="dead_line" id="">
<input type="submit" value="create" class="btn btn-success">

</form>

{{-- @foreach ($users->classes as $class)
    {{$class->class_name }}
{{$class->users->count() }}
@endforeach --}}

</div>

@endsection
