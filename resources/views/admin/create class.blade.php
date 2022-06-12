@extends('layouts.teacher')
@section('content')
<div class="col-lg-6">

    <div class="card">
      <div class="card-body">
        <h5 class="card-title">General Form Elements</h5>

        <!-- General Form Elements -->


        <form action="{{route('create.class')}}" method="post">
            @csrf
            @method('POST')          <div class="row mb-3">
            <label for="inputText" class="col-sm-2 col-form-label">class</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="class_name">
            </div>
          </div>
          <div class="row mb-3">
            <label for="inputText" class="col-sm-2 col-form-label">level</label>
            <div class="col-sm-10">
              <input type="text" class="form-control">
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
