@extends('layouts.teacher')
@section('content')
<section class="section profile">
    <div class="row">
      <div class="col-xl-4">

        <div class="card">
          <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
              @if ($parent->user->avatar)

              <img src="{{url($parent->user->avatar)}}" alt="Profile" class="rounded-circle">

              @else
              <img src="{{url('icons/Account-Avatar.png')}}" alt="Profile" class="rounded-circle">

              @endif

            <h2>{{$parent->full_name}}</h2>
            <h3></h3>
            <div class="social-links mt-2 mb-3">
                @if ($parent->user->status=="Active")
                <span class="badge border-success border-1 text-success">{{$parent->user->status}}</span>

                @else
                <span class="badge border-danger border-1 text-danger">{{$parent->user->status}}</span>

                @endif
            </div>
          </div>
        </div>

      </div>

      <div class="col-xl-8">

        <div class="card">
          <div class="card-body pt-3">
            <!-- Bordered Tabs -->
            <ul class="nav nav-tabs nav-tabs-bordered">

              <li class="nav-item">
                <button class="nav-link {{Route::is('parents.view') ? 'active' : '' }} " data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
              </li>





            </ul>
            <div class="tab-content pt-2">

              <div class="tab-pane fade {{Route::is('parents.view') ? 'show active' : '' }}  profile-overview" id="profile-overview">

                <div class="row">
                    <div class="col-lg-3 col-md-4 label ">fullname</div>
                    <div class="col-lg-9 col-md-8">{{$parent->full_name}} </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Email</div>
                    <div class="col-lg-9 col-md-8">{{$parent->user->email}}</div>
                  </div>
                <div class="row">
                  <div class="col-lg-3 col-md-4 label ">Phone</div>
                  <div class="col-lg-9 col-md-8">{{$parent->phone_number}} </div>
                </div>
@php
    $i=1;
@endphp
                @foreach ($parent->students as $item)


                <div class="row">
                    <div class="col-lg-4 col-md-4 label ">student {{$i}} and relation :</div>
                    <div class="col-lg-5 col-md-8"> {{$item->firstname}}
                        {{$item->lastname}} </div>
                    <div class="col-lg-3 col-md-4">{{$item->pivot->relationship}} </div>

                  </div>

@php
    $i++;
@endphp
                @endforeach














              </div>

              {{-- <div class="tab-pane fade      {{Route::is('students.edit.profile') ? 'show active' : '' }}
              profile-edit pt-3" id="profile-edit">

                <!-- Profile Edit Form -->
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
                    <input type="date" class="form-control" name="birth_date" id="" value="{{$student->birth_date}}" required>                    </div>
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
                    {{-- </div>
                  </div> --}}






                  {{-- <div class="text-center">
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                  </div>
                </form><!-- End Profile Edit Form -->

              </div>

              <div class="tab-pane fade pt-3" id="profile-settings">



              </div> --}}
            </div><!-- End Bordered Tabs -->

        </div>
      </div>

    </div>
  </div>

@endsection
