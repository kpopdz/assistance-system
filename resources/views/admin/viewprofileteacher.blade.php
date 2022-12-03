@extends('layouts.teacher')
@section('content')
<section class="section profile">
    @if ($message=Session::get('success'))
<div class="alert alert-success alert-dismissible fade show mt-5" role="alert">
    <i class="bi bi-check-circle me-1"></i>
    {!!$message!!}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
 @endif
    <div class="row">
      <div class="col-xl-4">

        <div class="card">
          <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
              @if ($teacher->user->avatar)

              <img src="{{url($teacher->user->avatar)}}" alt="Profile" class="rounded-circle">

              @else
              <img src="{{url('icons/Account-Avatar.png')}}" alt="Profile" class="rounded-circle">

              @endif

            <h2>{{$teacher->firstname}} {{$teacher->lastname}}</h2>
            <h3>{{$teacher->grade}}</h3>
            <div class="social-links mt-2 mb-3">
                @if ($teacher->user->status=="Active")
                <span class="badge border-success border-1 text-success">{{$teacher->user->status}}</span>

                @else
                <span class="badge border-danger border-1 text-danger">{{$teacher->user->status}}</span>

                @endif
            </div>
                      <div class="form-check form-switch">
                <input  data-id="{{$teacher->user->id}}" data-onstyle="success"  data-offstyle="danger" class="form-check-input toggle-class" data-toggle="toggle" data-on="Active" type="checkbox" id="switchstatu"  name="switchstatu" data-off="InActive" {{ $teacher->user->status== 'Active'? 'checked' : '' }}>
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

          </div>
        </div>

      </div>

      <div class="col-xl-8">

        <div class="card">
          <div class="card-body pt-3">
            <!-- Bordered Tabs -->
            <ul class="nav nav-tabs nav-tabs-bordered">

              <li class="nav-item">
                <button class="nav-link {{Route::is('teachers.view') ? 'active' : '' }} " data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
              </li>

              <li class="nav-item">
                <button class="nav-link  {{Route::is('teachers.edit.profile') ? 'active' : '' }}" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profile</button>
              </li>



            </ul>
            <div class="tab-content pt-2">

              <div class="tab-pane fade {{Route::is('teachers.view') ? 'show active' : '' }}  profile-overview" id="profile-overview">

                <div class="row">
                    <div class="col-lg-3 col-md-4 label ">Teacher id</div>
                    <div class="col-lg-9 col-md-8">{{$teacher->teacher_id}} </div>
                  </div>
                <div class="row">
                  <div class="col-lg-3 col-md-4 label ">First Name</div>
                  <div class="col-lg-9 col-md-8">{{$teacher->firstname}} </div>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-md-4 label ">Last name</div>
                    <div class="col-lg-9 col-md-8"> {{$teacher->lastname}}</div>
                  </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Birth date</div>
                  <div class="col-lg-9 col-md-8">{{$teacher->birth_date}}</div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Sex </div>
                  <div class="col-lg-9 col-md-8">{{$teacher->sex}}</div>
                </div>



                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Address</div>
                  <div class="col-lg-9 col-md-8">{{$teacher->address}}</div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Marital situation</div>
                  <div class="col-lg-9 col-md-8">
                    {{$teacher->marital_situation}}
                    {{-- {{$teacher->nationality}} --}}
                </div>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-md-4 label">Grade</div>
                    <div class="col-lg-9 col-md-8">
                        {{$teacher->grade}}                      {{-- {{$teacher->nationality}} --}}
                  </div>
                  </div>
                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Email</div>
                  <div class="col-lg-9 col-md-8">{{$teacher->user->email}}</div>
                </div>

              </div>

              <div class="tab-pane fade      {{Route::is('teachers.edit.profile') ? 'show active' : '' }}
              profile-edit pt-3" id="profile-edit">

                <!-- Profile Edit Form -->
                <form action="{{route('admin.teacher.profile.update')}}" method="POST"enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <input type="hidden" name="t_id" value="{{$teacher->id}}">
                    <div class="row mb-3">
                        <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Teacher id</label>
                        <div class="col-md-8 col-lg-9">
                          <input  type="text" class="form-control @error('teacher_id') is-invalid @enderror" id="fullName" value="{{$teacher->teacher_id}}" name="teacher_id" required>
                          @error('teacher_id')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                        </div>
                      </div>
                      <div class="row mb-3">
                        <label for="fullName" class="col-md-4 col-lg-3 col-form-label">email</label>
                        <div class="col-md-8 col-lg-9">
                          <input  type="text" class="form-control @error('email') is-invalid @enderror" value="{{$teacher->user->email}}" name="email" required>
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
                      <input  type="text" class="form-control @error('firstname') is-invalid @enderror" value="{{$teacher->firstname}}" name="firstname" required>
                      @error('firstname')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror </div>
                  </div>
                  <div class="row mb-3">
                    <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Last Name</label>
                    <div class="col-md-8 col-lg-9">
                      <input type="text" class="form-control @error('lastname') is-invalid @enderror" id="fullName" value="{{$teacher->lastname}}" name="lastname" required>
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
                    <input type="date" class="form-control" name="birth_date" id="" value="{{$teacher->birth_date}}" required>                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="company" class="col-md-4 col-lg-3 col-form-label">Sex</label>
                    <div class="col-md-8 col-lg-9"><div class="col-6">                        <input type="radio" name="sex" id="" name="sex" value="male" {{$teacher->sex=="male" ? 'checked='.'"'.'checked'.'"' : '' }}>
                    <label for="">male</label>
                    </div>
                    <div class="col-6">                        <input type="radio" name="sex" id="" name="sex" value="female" {{$teacher->sex=="female" ? 'checked='.'"'.'checked'.'"' : '' }}>
                        <label for="">female</label>
                    </div>
                    </div>
                  </div>

                  {{-- <div class="row mb-3">
                    <label for="Job" class="col-md-4 col-lg-3 col-form-label">academic_level</label>
                    <div class="col-md-8 col-lg-9"> --}}
                        {{-- <select id="academic_level" name="academic_level" class="form-select" aria-label="Default select example">
                            @foreach ($academic_level as $item)
                            <option value="{{$item->id}}" {{$student->academic_level==$item->id ? "selected":"" }}>{{$item->school_grade}} {{$item->level}} year</option>

                            @endforeach


                          </select>  --}}
                          {{-- </div>
                  </div> --}}




                  <div class="row mb-3">
                    <label for="Country" class="col-md-4 col-lg-3 col-form-label">Grade</label>
                    <div class="col-md-8 col-lg-9">
                        <select name="grade"  id="country" class="form-control">
                            <option value="">Select Grade</option>
                            <option value="أستاذ اساسي"{{$teacher->grade== "أستاذ اساسي"? "selected":"" }}>أستاذ اساسي</option>
                            <option value="أستاذ متربص"{{$teacher->grade== "أستاذ متربص"? "selected":"" }}>أستاذ متربص</option>
                            <option value="أستاذ مستخلف"{{$teacher->grade== "أستاذ مستخلف"? "selected":"" }}>أستاذ مستخلف</option>
                            {{-- @foreach ($countries as $country)
                                <option value="{{ $country }}" {{$student->nationality==$country? "selected":"" }}>{{ $country }}</option>
                            @endforeach --}}
                        </select>
                      {{-- <input name="nationality" type="text" class="form-control" id="Country" value="{{$student->nationality}}"> --}}
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label for="Address" class="col-md-4 col-lg-3 col-form-label">Address</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="address" type="text" class="form-control" id="Address" value="{{$teacher->address}}">
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label for="Country" class="col-md-4 col-lg-3 col-form-label">Civil status</label>
                    <div class="col-md-8 col-lg-9">
                        <select name="marital_situation"  id="country" class="form-control">
                            <option value="">Select</option>
                            <option value="celibate"{{$teacher->marital_situation== "celibate"? "selected":"" }}>celibate</option>
                            <option value="married"{{$teacher->marital_situation== "married"? "selected":"" }}>married</option>
                            <option value="divorced"{{$teacher->marital_situation== "divorced"? "selected":"" }}>divorced</option>
                        </select>
                      {{-- <input name="nationality" type="text" class="form-control" id="Country" value="{{$student->nationality}}"> --}}
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

  {{-- <script>

    $(".save-data").click(function(event){
        event.preventDefault();

        let statu = $("input[name=switchstatu]").val();

        let _token   = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
          url: "/ajax-request",
          type:"POST",
          data:{
            statu:statu,

            _token: _token
          },
          success:function(response){
            console.log(response);
            if(response) {
              $('.success').text(response.success);
              $("#ajaxform")[0].reset();
            }
          },
          error: function(error) {
           console.log(error);
            $('#nameError').text(response.responseJSON.errors.name);
            $('#emailError').text(response.responseJSON.errors.email);
            $('#mobileError').text(response.responseJSON.errors.mobile);
            $('#messageError').text(response.responseJSON.errors.message);
          }
         });
    });
  </script>
  <script type="text/javascript">
    const form=document.getElementById('add01');
    const switchstatu=document.getElementById('switchstatu');
    const lastInfo=document.getElementById('lastinfo');

    teacher=document.querySelectorAll('.teacher-input');
    student=document.querySelectorAll('.student-input');
    parent=document.querySelectorAll('.parent-input');


    //  teacher ='                        <div class="row mb-3">'+
    //                             '<label for="firstname" class="col-md-4 col-form-label text-md-end">'+{{ __('firstname') }}
    //                                 +'</label>'+

    //                             '<div class="col-md-6">'+
    //                                 '<input id="firstname" type="text" class="form-control" name="firstname" value="'
    //                                 +{{ old('firstname') }}+'" required autocomplete="name" autofocus>'+



    //                             '</div>'+
    //                         '</div>';


    switchstatu.addEventListener('change', (event) => {
    let info_person=document.querySelectorAll('.info-person');
    if (info_person) {
        info_person.forEach(element => {
            element.remove();
    });
    }

      if (event.target.value === '') {
        alert('null');
      } else if (event.target.value === 'teacher') {
          for (let index = teacher.length-1; index >= 0; index--) {
              let temp=teacher[index];
            temp.classList.remove("d-none");
            temp.classList.add("info-person");
            lastInfo.after(temp);

          }
      } else {


            for (let index = student.length-1; index >= 0; index--) {
              temp=student[index];
            temp.classList.remove("d-none");
            temp.classList.add("info-person");
            lastInfo.after(temp);

          }

      }



    });


    // selectRole.addEventListener('change', function handleChange(event) {
    //   if (event.target.value === 'teacher') {
    //     const span = document.createElement("span");

    //     selectRole.after(span);

    //   } else {
    //   });
    </script> --}}

@endsection
