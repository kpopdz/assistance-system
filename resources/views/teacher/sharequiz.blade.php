@extends('layouts.teacher')

@section('content')

<div class="col-lg-8 m-auto ">

    <div class="card">
      <div class="card-body">
        <h5 class="card-title text-center">Create a new quiz</h5>

        <!-- General Form Elements -->
        <form action="{{route('teacher.share.quiz')}}" class="form" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="quiz_id" value="{{$quiz->id}}">
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Choose a type</label>
            <div class="col-sm-9">
              <select class="form-select" aria-label="Default select example" name="type_share">
                <option selected="">Share with </option>
                <option value="teacher">teacher</option>
                <option value="collaboration">Two</option>
              </select>
            </div>
          </div>
          <div class="row mb-3">
            <label for="tags" class="col-sm-3 col-form-label">Select the teachers</label>
            <div class="col-sm-9">
                <select class="form-select"name="teacher_id[]" multiple="true" aria-label="multiple select example">



                    @foreach ($teachers as $teacher)

                    <option value="{{$teacher->id }}">{{$teacher->name }}</option>

                {{-- {{$class->users->count() }} --}}
                @endforeach
                </select>            </div>
          </div>










          <div class="row mb-3  text-center">
            <div class="col-sm-12">
              <button type="submit" class="btn btn-primary ">Next</button>
              <a href="{{route('quizs.index')}}" class="btn btn-danger ">cancel</a>

            </div>
          </div>

        </form><!-- End General Form Elements -->

      </div>
    </div>

  </div>

@endsection
