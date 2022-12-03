@extends('layouts.teacher')
@section('content')
<section class="section profile">
    <div class="row">
      <div class="col-xl-4">

        <div class="card">
          <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
              @if ($student->user->avatar)

              <img src="{{url($student->user->avatar)}}" alt="Profile" class="rounded-circle">

              @else
              <img src="{{url('icons/Account-Avatar.png')}}" alt="Profile" class="rounded-circle">

              @endif

            <h2> {{$student->lastname}} {{$student->firstname}} </h2>
            <h3>{{$student->academic_levelname->level}}</h3>
            <div class="social-links mt-2 mb-3">
                @if ($student->user->status=="Active")
                <span class="badge border-success border-1 text-success">{{$student->user->status}}</span>

                @else
                <span class="badge border-danger border-1 text-danger">{{$student->user->status}}</span>

                @endif

            </div>
            <div class="form-check form-switch mb-4">
                <input  data-id="{{$student->user->id}}" data-onstyle="success"  data-offstyle="danger" class="form-check-input toggle-class" data-toggle="toggle" data-on="Active" type="checkbox" id="switchstatu"  name="switchstatu" data-off="InActive" {{ $student->user->status== 'Active'? 'checked' : '' }}>
                <label class="form-check-label" for="flexSwitchCheckChecked">change the statue</label>
              </div>
              <script>
                $(function() {
                  $('.toggle-class').change(function() {
                      var status = $(this).prop('checked') == true ? 1 : 0;
                      var user_id = $(this).data('id');

                      $.ajax({
                          type: "GET",
                          dataType: "json",
                          url: '/changeStatus',
                          data: {'status': status, 'user_id': user_id},
                          success: function(data){
                            console.log(data.success)
                          }
                      });
                  })
                })
              </script>
            <a href="{{route('student.state.update',$student)}}" class="btn btn-success"> <i class="bi bi-bar-chart-fill"></i> View Insights</a>
          </div>
        </div>

      </div>

      <div class="col-xl-8">

        <div class="card">
          <div class="card-body pt-3">
            <!-- Bordered Tabs -->
            <ul class="nav nav-tabs nav-tabs-bordered">

              <li class="nav-item">
                <button class="nav-link {{Route::is('students.view') ? 'active' : '' }} " data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
              </li>

              <li class="nav-item">
                <button class="nav-link  {{Route::is('students.edit.profile') ? 'active' : '' }}" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Information</button>
              </li>



            </ul>
            <div class="tab-content pt-2">

              <div class="tab-pane fade {{Route::is('students.view') ? 'show active' : '' }}  profile-overview" id="profile-overview">

                <div class="row mt-4">
                    <div class="col-lg-3 col-md-4 label ">ID Number:
                    </div>
                    <div class="col-lg-9 col-md-8">{{$student->student_id}} </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-3 col-md-4 label ">Last Name:
                    </div>
                    <div class="col-lg-9 col-md-8"> {{$student->lastname}}</div>
                  </div>
                <div class="row">
                  <div class="col-lg-3 col-md-4 label ">First Name:
                </div>
                  <div class="col-lg-9 col-md-8">{{$student->firstname}} </div>
                </div>


                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Birthdate:

                </div>
                  <div class="col-lg-9 col-md-8">{{$student->birth_date}}</div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Gender:
                </div>
                  <div class="col-lg-9 col-md-8">{{$student->sex}}</div>
                </div>



                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Home Address:</div>
                  <div class="col-lg-9 col-md-8">{{$student->address}}</div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Nationality:
                </div>
                  <div class="col-lg-9 col-md-8">{{$student->nationality}}</div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Email</div>
                  <div class="col-lg-9 col-md-8">{{$student->user->email}}</div>
                </div>

              </div>

              <div class="tab-pane fade      {{Route::is('students.edit.profile') ? 'show active' : '' }}
              profile-edit pt-3" id="profile-edit">

                <!-- Profile Edit Form -->
                <form action="{{route('admin.student.profile.update')}}" method="POST"enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <input type="hidden" name="stud_id" value="{{$student->id}}">
                    <div class="row mb-3 ">
                        <label for="fullName" class="col-md-4 col-lg-3 col-form-label">ID Number:
                        </label>
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
                    <label for="fullName" class="col-md-4 col-lg-3 col-form-label">First Name:</label>
                    <div class="col-md-8 col-lg-9">
                      <input  type="text" class="form-control @error('firstname') is-invalid @enderror" value="{{$student->firstname}}" name="firstname" required>
                      @error('firstname')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror </div>
                  </div>
                  <div class="row mb-3">
                    <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Last Name:</label>
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
                    <label for="about" class="col-md-4 col-lg-3 col-form-label">Birthdate:</label>
                    <div class="col-md-8 col-lg-9">
                    <input type="date" class="form-control" name="birth_date" id="" value="{{$student->birth_date}}" required>                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="company" class="col-md-4 col-lg-3 col-form-label">Gender:</label>
                    <div class="col-md-8 col-lg-9"><div class="col-6">                        <input type="radio" name="sex" id="" name="sex" value="male" {{$student->sex=="male" ? 'checked='.'"'.'checked'.'"' : '' }}>
                    <label for="">Male</label>
                    </div>
                    <div class="col-6">                        <input type="radio" name="sex" id="" name="sex" value="female" {{$student->sex=="female" ? 'checked='.'"'.'checked'.'"' : '' }}>
                        <label for="">Female</label>
                    </div>
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label for="Address" class="col-md-4 col-lg-3 col-form-label">Home Address:
                    </label>
                    <div class="col-md-8 col-lg-9">
                      <input name="address" type="text" class="form-control" id="Address" value="{{$student->address}}">
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label for="Country" class="col-md-4 col-lg-3 col-form-label">Nationality:</label>
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
                  <div class="row mb-3">
                    <label for="Job" class="col-md-4 col-lg-3 col-form-label">Academic Level:</label>
                    <div class="col-md-8 col-lg-9">
                        <select id="academic_level" name="academic_level" class="form-select" aria-label="Default select example">
                            @foreach ($academic_level as $item)
                            <option value="{{$item->id}}" {{$student->academic_level==$item->id ? "selected":"" }}>{{$item->school_grade}} {{$item->level}} year</option>

                            @endforeach


                          </select>                    </div>
                  </div>





                  <div class="row mb-3">
                    <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Email:</label>
                    <div class="col-md-8 col-lg-9">
                      <input  type="text" class="form-control @error('email') is-invalid @enderror" value="{{$student->user->email}}" name="email" required>
                      @error('email')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
                    </div>
                  </div>




                  <div class="text-center">
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                  </div>
                </form><!-- End Profile Edit Form -->

              </div>

              <div class="tab-pane fade pt-3" id="profile-settings">



              </div>
            </div><!-- End Bordered Tabs -->

        </div>
      </div>

    </div>
  </div>

@endsection
