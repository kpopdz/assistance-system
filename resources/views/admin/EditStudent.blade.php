@extends('layouts.teacher')

@section('content')
<section class="section profile">
    <div class="row">


      <div class="col-xl-8">

        <div class="card">
          <div class="card-body pt-3">
            <!-- Bordered Tabs -->
            <ul class="nav nav-tabs nav-tabs-bordered mb-5" >



              <li class="nav-item">
                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Student</button>
              </li>



            </ul>
            <div class="tab-content pt-2">

              <div class="tab-pane fade show active profile-overview " id="profile-overview">


                <form action="{{route('admin.student.profile.update')}}" method="POST"enctype="multipart/form-data">
                    @csrf
                    @method('POST')
<input type="hidden" name="stud_id" value="{{$student->id}}">
                    <div class="row mb-3">
                        <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Student id</label>
                        <div class="col-md-8 col-lg-9">
                          <input  type="text" class="form-control @error('student_id') is-invalid @enderror" id="fullName" value="{{$student->student_id}}" name="student_id" required>
                          @error('student_id')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                        </div>
                      </div>
                      <div class="row mb-3">
                        <label for="fullName" class="col-md-4 col-lg-3 col-form-label">email</label>
                        <div class="col-md-8 col-lg-9">
                          <input  type="text" class="form-control @error('email') is-invalid @enderror" value="{{$student->user->email}}" name="email" required>
                          @error('email')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                        </div>
                      </div>

                  <div class="row mb-3">
                    <label for="fullName" class="col-md-4 col-lg-3 col-form-label">First Name</label>
                    <div class="col-md-8 col-lg-9">
                      <input  type="text" class="form-control @error('firstname') is-invalid @enderror" value="{{$student->firstname}}" name="firstname" required>
                      @error('firstname')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror </div>
                  </div>
                  <div class="row mb-3">
                    <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Last Name</label>
                    <div class="col-md-8 col-lg-9">
                      <input type="text" class="form-control @error('lastname') is-invalid @enderror" id="fullName" value="{{$student->lastname}}" name="lastname" required>
                      @error('lastname')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="about" class="col-md-4 col-lg-3 col-form-label">Birth date</label>
                    <div class="col-md-8 col-lg-9">
<input type="date" class="form-control  @error('birth_date') is-invalid @enderror" name="birth_date" id="" value="{{$student->birth_date}}" required>                    </div>
@error('birth_date')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
</div>


                  <div class="row mb-3">
                    <label for="company" class="col-md-4 col-lg-3 col-form-label">Sex</label>
                    <div class="col-md-8 col-lg-9"><div class="col-6">                        <input type="radio" name="sex" id="" name="sex" value="male" {{$student->sex=="male" ? 'checked='.'"'.'checked'.'"' : '' }}>
                    <label for="">male</label>
                    </div>
                    <div class="col-6">                        <input type="radio" name="sex" id="" name="sex" value="female" {{$student->sex=="female" ? 'checked='.'"'.'checked'.'"' : '' }}>
                        <label for="">female</label>
                    </div>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="Job" class="col-md-4 col-lg-3 col-form-label">academic_level</label>
                    <div class="col-md-8 col-lg-9">
                        <select id="academic_level" name="academic_level" class="form-select" aria-label="Default select example">
                            @foreach ($academic_level as $item)
                            <option value="{{$item->id}}" {{$student->academic_level==$item->id ? "selected":"" }}>{{$item->school_grade}} {{$item->level}} year</option>

                            @endforeach


                          </select>                    </div>
                  </div>



                  <div class="row mb-3">
                    <label for="Address" class="col-md-4 col-lg-3 col-form-label">Address</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="address" type="text" class="form-control" id="Address" value="{{$student->address}}">
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label for="Country" class="col-md-4 col-lg-3 col-form-label">Nationality</label>
                    <div class="col-md-8 col-lg-9">
                        <select name="nationality"  id="country" class="form-control">
                            <option value="">Select Nationality</option>
                            @foreach ($countries as $country)
                                <option value="{{ $country }}" {{$student->nationality==$country? "selected":"" }}>{{ $country }}</option>
                            @endforeach
                        </select>
                      {{-- <input name="nationality" type="text" class="form-control" id="Country" value="{{$student->nationality}}"> --}}
                    </div>
                  </div>






                  <div class="text-center">
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                  </div>
                </form><!-- End Profile Edit Form -->

              </div>

              <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                <!-- Profile Edit Form -->


              </div>

@endsection
