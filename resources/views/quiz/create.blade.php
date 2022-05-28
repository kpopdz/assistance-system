@extends('layouts.app')

@section('content')
<div class="container" style="padding-top: 12%">

<div class="card" >
    <div class="card-body">
      This is some text within a card body.
    </div>
  </div>
  </div>
<div class="container">
    <form action="{{route('quizs.store')}}" method="POST">
        @csrf
        <div class="form-group" style="padding-top: 2%">
          <label for="exampleFormControlInput1">Quiz name</label>
          <input type="text" class="form-control" name="title"  placeholder=" ">
        </div>
        <div class="form-group" style="padding-top: 2%">
            <label for="exampleFormControlInput1">chapter name</label>
            <textarea class="form-control" name="description"  placeholder="like name of chapter "></textarea>
          </div>
        <div class="form-group" style="padding-top: 2%">
            <label for="exampleFormControlInput1">Start time</label>
            <input type="datetime-local" class="form-control" name="start_date"  id="start_date">
          </div>
          <div class="form-group" style="padding-top: 2%">
            <label for="exampleFormControlInput1">duration</label>
            <input type="time" class="form-control" name="duration" >
          </div>
          <div class="form-group">
            <button type="submit" class="btn btn-primary">Save</button>



          </div>


      </form>

    </div>
    @endsection
