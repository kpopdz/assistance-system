@extends('layouts.teacher')

@section('content')

<div class="pagetitle">
    <h1>Profile</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>

        <li class="breadcrumb-item active">Profile</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section profile">
    <div class="row">
      <div class="col-xl-4">

        <div class="card">
          <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
              @if (Auth::user()->avatar)

              <img src="{{url(Auth::user()->avatar)}}" alt="Profile" class="rounded-circle">

              @else
              <img src="{{url('icons/Account-Avatar.png')}}" alt="Profile" class="rounded-circle">

              @endif

            <h2>{{Auth::user()->admin->firstname}} {{Auth::user()->admin->lastname}}</h2>
            <h3>{{Auth::user()->role}}</h3>
            <div class="social-links mt-2">

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
                    <button class="nav-link {{Route::is('profile.admin') ? 'active' : '' }} " data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
                  </li>

                  <li class="nav-item">
                    <button class="nav-link  {{Route::is('students.edit.profile') ? 'active' : '' }}" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Information</button>
                  </li>

            </ul>
            <div class="tab-content pt-2">

              <div class="tab-pane fade show active profile-overview" id="profile-overview">

                <h5 class="card-title">Profile Details</h5>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label ">First Name</div>
                  <div class="col-lg-9 col-md-8">{{Auth::user()->admin->firstname}} </div>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-md-4 label ">Last name</div>
                    <div class="col-lg-9 col-md-8"> {{Auth::user()->admin->lastname}}</div>
                  </div>






              </div>

              <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                <!-- Profile Edit Form -->
                <form action="{{route('profile.admin.update')}}" method="POST"enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                  <div class="row mb-3">
                    <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profile Image</label>
                    <div class="col-md-8 col-lg-9">
                        @if (Auth::user()->avatar)

                        <img src="{{url(Auth::user()->avatar)}}" alt="Profile" onclick="defaultBtnActive()" id="new-image">

                        @else
                        <img src="{{url('icons/Account-Avatar.png')}}" alt="Profile" onclick="defaultBtnActive()" id="new-image">


                        @endif
                      <div class="pt-2">
                        <a href="#" class="btn btn-primary btn-sm" title="Upload new profile image" onclick="defaultBtnActive()"><i class="bi bi-upload"></i></a>
                        <a href="#" class="btn btn-danger btn-sm" title="Remove my profile image"><i class="bi bi-trash"></i></a>
                        <input class="form-control d-none" type="file" id="up-quiz-image" name="avatar">

                      </div>
                    </div>
                  </div>
                  <script>

                    const defImg= document.querySelector("#default-image");
                    const defaultBtn = document.querySelector("#up-quiz-image");
                    const img = document.querySelector("#new-image");
                    const backImg = document.querySelector("#back-image");

                    function defaultBtnActive(){
                                    defaultBtn.click();
                                    }

                                    defaultBtn.addEventListener("change", function(){
       const file = this.files[0];
       if(file){
         const reader = new FileReader();
         reader.onload = function(){
           const result = reader.result;
           img.src = result;
        //    wrapper.classList.add("active");
         }
         reader.readAsDataURL(file);
         backImg.style.display='none';
        }});

                </script>

<input type="hidden" name="a_id" value="{{Auth::user()->admin->id}}">
                  <div class="row mb-3">
                    <label for="fullName" class="col-md-4 col-lg-3 col-form-label">First Name</label>
                    <div class="col-md-8 col-lg-9">
                      <input  type="text" class="form-control" id="fullName" value="{{Auth::user()->admin->firstname}}" name="firstname" required>
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Last Name</label>
                    <div class="col-md-8 col-lg-9">
                      <input type="text" class="form-control" id="fullName" value="{{Auth::user()->admin->lastname}}" name="lastname" required>
                    </div>
                  </div>
{{--
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
           {{-- //         </div> --}}
                  {{-- </div>  --}}






                  <div class="text-center">
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                  </div>
                </form><!-- End Profile Edit Form -->

              </div>

              <div class="tab-pane fade pt-3" id="profile-settings">

                <!-- Settings Form -->
                <form>

                  <div class="row mb-3">
                    <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Email Notifications</label>
                    <div class="col-md-8 col-lg-9">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="changesMade" checked>
                        <label class="form-check-label" for="changesMade">
                          Changes made to your account
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="newProducts" checked>
                        <label class="form-check-label" for="newProducts">
                          Information on new products and services
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="proOffers">
                        <label class="form-check-label" for="proOffers">
                          Marketing and promo offers
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="securityNotify" checked disabled>
                        <label class="form-check-label" for="securityNotify">
                          Security alerts
                        </label>
                      </div>
                    </div>
                  </div>

                  <div class="text-center">
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                  </div>
                </form><!-- End settings Form -->

              </div>

              <div class="tab-pane fade pt-3" id="profile-change-password">
                <!-- Change Password Form -->
                <form>

                  <div class="row mb-3">
                    <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Current Password</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="password" type="password" class="form-control" id="currentPassword">
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New Password</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="newpassword" type="password" class="form-control" id="newPassword">
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Re-enter New Password</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="renewpassword" type="password" class="form-control" id="renewPassword">
                    </div>
                  </div>

                  <div class="text-center">
                    <button type="submit" class="btn btn-primary">Change Password</button>
                  </div>
                </form><!-- End Change Password Form -->

              </div>

            </div><!-- End Bordered Tabs -->

          </div>
        </div>

      </div>
    </div>
  </section>
@endsection
