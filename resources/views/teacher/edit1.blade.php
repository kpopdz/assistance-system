@extends('layouts.app')

@section('content')
<div class="container" style="padding-top: 12%">

<div class="card" >
    <div class="card-body">
quiz topic : {{$quiz->start_date}}    </div>
  </div>
  </div>
<div class="container">
    <form action="{{route('quizs.update',$quiz->id)}}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group" style="padding-top: 2%">
          <label for="exampleFormControlInput1">Quiz name</label>
          <input type="text" class="form-control" name="quiz_name"  value="{{$quiz->quiz_name}}">
        </div>
        <div class="form-group" style="padding-top: 2%">
            <label for="exampleFormControlInput1">Start time</label>
            <input type="datetime-local" class="form-control" name="start_date"  id="start_date" value="{{$quiz->start_date}}">
          </div>
          <div class="form-group" style="padding-top: 2%">
            <label for="exampleFormControlInput1">duration</label>
            <input type="time" class="form-control" name="duration" value="{{$quiz->duration}}">
          </div>
          <div class="form-group">
            <button type="submit" class="btn btn-primary">Update</button>



          </div>


      </form>

    </div>
    @endsection
