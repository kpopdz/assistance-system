@extends('layouts.app')

@section('content')
<div class="container" >


<div class="container">
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">{{ __('add question') }}</div>

            <div class="card-body">

    <form action="{{route('quizs.posts',$quiz->id)}}" method="POST">
        @csrf
        <div class="row mb-3"  >
          <label for="exampleFormControlInput1" class="col-md-4 col-form-label text-md-end">question {{$quiz->quiz_name}}</label>
          <div class="col-md-6">
<input type="hidden" name="quiz_id" value="{{$quiz->id}}">
               <input type="text" class="form-control" name="question_content"  placeholder=" " height="10" placeholder="content">
            <input type="number" name="question_point" placeholder="point">
          </div>
        </div>
        <div class="row mb-3">
            <label for="exampleFormControlInput1" class="col-md-4 col-form-label text-md-end">option 1</label>
            <div class="col-md-6">
            <input type="text" class="form-control" name="option_content[]"  placeholder="first option ">

              <select name="IsCorrect[]" class="form-select" aria-label="Default select example">
                <option selected >Select your ROLE</option>
                <option value="1">true</option>
                <option value="0">false</option>
              </select>
            </div>
            </div>
          <div class="row mb-3">
            <label for="exampleFormControlInput1" class="col-md-4 col-form-label text-md-end">option 2</label>
            <div class="col-md-6">

            <input type="text" class="form-control" name="option_content[]"  placeholder="second option">

            <select name="IsCorrect[]" class="form-select" aria-label="Default select example">
                <option selected >Select your ROLE</option>
                <option value="1">true</option>
                <option value="0">false</option>
              </select>
            </div>


        </div>
        <div class="row mb-3">
            <label for="exampleFormControlInput1" class="col-md-4 col-form-label text-md-end">option 3</label>
            <div class="col-md-6">
            <input type="text" class="form-control" name="option_content[]"  placeholder="third option ">


              <select name="IsCorrect[]" class="form-select" aria-label="Default select example">
                <option selected >Select your ROLE</option>
                <option value="1">true</option>
                <option value="0">false</option>
              </select>
            </div>
        </div>

            <div class="row mb-3">
                <label for="exampleFormControlInput1" class="col-md-4 col-form-label text-md-end">option 4</label>
                <div class="col-md-6">

            <input type="text" class="form-control" name="option_content[]"  placeholder="fourth option">

              <select name="IsCorrect[]" class="form-select" aria-label="Default select example">
                <option selected >Select your ROLE</option>
                <option value="1">true</option>
                <option value="0">false</option>
              </select>
            </div>

        </div>

        <div class="row mb-0">
            <div class="col-md-6 offset-md-4">
            <button type="submit" class="btn btn-primary">Save</button>

            <button type="button" class="btn btn-success" id="btnAdd">+</button>
        </div>
    </div>




      </form>
    </div>

    </div>
    </div>
</div>
</div>

    </div>
    </div>
    <script type="text/javascript">
    $(document).ready(function () {
        $('#btnAdd'.on('click',function () {
            var html="";
html=+'<button type="submit" class="btn btn-primary">Save</button>';
$('div').append(html);
        })


    })
    </script>
    @endsection
