@extends('layouts.teacher')

@section('content')
<div class="row">
    <div class="col-lg-7">

      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Upload course</h5>

          <!-- General Form Elements -->
          <form action="{{route('course.uploade')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row mb-3">
                <label for="inputText" class="col-sm-2 col-form-label">Name : <span style="color: red">*</span> </label>
                <div class="col-sm-10">
                  <input type="text" class="form-control  @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required>
                </div>


              </div>
            <div class="row mb-3">
              <label for="inputNumber" class="col-sm-2 col-form-label"> Upload pdf</label>
              <div class="col-sm-10">
                <input class="form-control" type="file" id="formFile" name="pdf">
              </div>
            </div>
            <div class="row mb-3">
                <label for="inputNumber" class="col-sm-2 col-form-label">Upload video</label>
                <div class="col-sm-10">
                  <input class="form-control" type="file" id="formFile" name="video">
                </div>
              </div>

              <div class="row mb-3">
                <label class="col-sm-2 col-form-label">indicate quiz</label>
                <div class="col-sm-10">
                  <select class="form-select"name="quiz_id[]" multiple="true" aria-label="multiple select example">



            @foreach ($quizs as $quiz)

            <option value="{{$quiz->id }}">{{$quiz->title }}</option>

        {{-- {{$class->users->count() }} --}}
        @endforeach
    </select>
</div>
</div>
<div class="row mb-3">
    <label class="col-sm-2 col-form-label">indicate classroom</label>
    <div class="col-sm-10">
      <select class="form-select"name="class_id">



@foreach ($classes as $class)

<option value="{{$class->class_id }}">{{$class->class_name }}</option>

{{-- {{$class->users->count() }} --}}
@endforeach
</select>
</div>
</div>

            <div class="row mb-3">
              <label class="col-sm-2 col-form-label">Submit Button</label>
              <div class="col-sm-10">
                <button type="submit" class="btn btn-primary">Submit Form</button>
              </div>
            </div>

          </form><!-- End General Form Elements -->

        </div>
      </div>

    </div>


  </div>
@endsection
