@extends('layouts.teacher')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Add User') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('add.user') }}" id="add01">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>




                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>
                        <div class="row mb-3" id="lastinfo">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('role') }}</label>

                            <div class="col-md-6">
                                <select id="selectRole" name="role" class="form-select" aria-label="Default select example">
                                    <option selected >Select his ROLE</option>
                                    <option value="teacher" onclick="">teacher</option>
                                    <option value="student" onclick="">student</option>
                                    <option value="parent" onclick="">parent</option>
                                  </select>

                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">

                                <button type="submit" class="btn btn-primary">

                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- ///////////////////// parent ////////////// --}}

<div class="row mb-3 parent-input d-none">
    <label for="full_name" class="col-md-4 col-form-label text-md-end">{{ __('fullname') }}</label>

    <div class="col-md-6">
        <input id="full_name" type="text" class="form-control @error('full_name') is-invalid @enderror" name="full_name" value="{{ old('full_name') }}" required autocomplete="firstname" autofocus>

        @error('full_name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>





<div class="row mb-3 parent-input d-none">
    <label for="phone" class="col-md-4 col-form-label text-md-end">{{ __('phone') }}</label>
    <div class="col-md-6">
        <input placeholder="06-647-735" id="phone" type="tel" class="form-control @error('phone_number') is-invalid @enderror" name="phone_number" value="{{ old('phone_number') }}" required autocomplete="phone" autofocus>

        @error('phone_number')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>



{{-- ///////////////////// parent ////////////// --}}
{{-- ///////////////////// student ////////////// --}}

<div class="row mb-3 student-input d-none">
    <label for="firstname" class="col-md-4 col-form-label text-md-end">{{ __('firstname') }}</label>

    <div class="col-md-6">
        <input id="name" type="text" class="form-control @error('firstname') is-invalid @enderror" name="firstname" value="{{ old('firstname') }}" required autocomplete="firstname" autofocus>

        @error('firstname')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
<div class="row mb-3 student-input d-none">
    <label for="lastname" class="col-md-4 col-form-label text-md-end">{{ __('lastname') }}</label>

    <div class="col-md-6">
        <input id="name" type="text" class="form-control @error('lastname') is-invalid @enderror" name="lastname" value="{{ old('lastname') }}" required autocomplete="firstname" autofocus>

        @error('lastname')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
<div class="row mb-3 student-input d-none">
    <label for="student_id" class="col-md-4 col-form-label text-md-end">{{ __('student id') }}</label>

    <div class="col-md-6">
        <input id="student_id" type="number" class="form-control @error('student_id') is-invalid @enderror" name="student_id" value="{{ old('student_id') }}" required autocomplete="student_id" autofocus>

        @error('student_id')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
<div class="row mb-3 student-input d-none">
    <label for="birth_date" class="col-md-4 col-form-label text-md-end">{{ __('birthdate') }}</label>

    <div class="col-md-6">
        <input id="birth_date" type="date" class="form-control @error('birth_date') is-invalid @enderror" name="birth_date" value="{{ old('birth_date') }}" required autocomplete="firstname" autofocus>

        @error('birth_date')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>

<div class="row mb-3 student-input d-none">
    <label for="selectSex" class="col-md-4 col-form-label text-md-end">{{ __('sex') }}</label>

    <div class="col-md-6">
        <div class="form-check">
            <input class="form-check-input" type="radio" name="sex" id="gridRadios1" value="male" checked="">
            <label class="form-check-label" for="gridRadios1">
                Male            </label>
          </div>         <div class="form-check">
            <input class="form-check-input" type="radio" name="sex" id="gridRadios1" value="female">
            <label class="form-check-label" for="gridRadios1">
                Female            </label>
          </div>


        @error('sex')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
<div class="row mb-3 student-input d-none">
    <label for="address" class="col-md-4 col-form-label text-md-end">{{ __('address') }}</label>

    <div class="col-md-6">
        <input placeholder="(street, city, and state)" id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}" required autocomplete="address" autofocus>

        @error('address')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
<div class="row mb-3 student-input d-none">
    <label for="nationality" class="col-md-4 col-form-label text-md-end">{{ __('nationality') }}</label>

    <div class="col-md-6">
        <input placeholder="" id="nationality" type="text" class="form-control @error('nationality') is-invalid @enderror" name="nationality" value="{{ old('nationality') }}" required autocomplete="nationality" autofocus>

        @error('nationality')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>

<div class="row mb-3 student-input d-none">

<label for="academic_level" class="col-md-4 col-form-label text-md-end">{{ __('academic level') }}</label>
<div class="col-md-6">
    <select id="academic_level" name="academic_level" class="form-select" aria-label="Default select example">
        <option selected >Select academic_level</option>
        <option value="1st" onclick="">1st </option>
        <option value="2nd" onclick="">2nd</option>
        <option value="3rd" onclick="">3rd</option>
        <option value="4th" onclick="">4th</option>
        <option value="5th" onclick="">5th</option>

      </select>

</div>
</div>
{{-- ///////////////////// student ////////////// --}}


{{-- ///////////////////// Teacher ////////////// --}}

<div class="row mb-3 teacher-input d-none">
    <label for="firstname" class="col-md-4 col-form-label text-md-end">{{ __('firstname') }}</label>

    <div class="col-md-6">
        <input id="name" type="text" class="form-control @error('firstname') is-invalid @enderror" name="firstname" value="{{ old('firstname') }}" required autocomplete="firstname" autofocus>

        @error('firstname')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
<div class="row mb-3 teacher-input d-none">
    <label for="lastname" class="col-md-4 col-form-label text-md-end">{{ __('lastname') }}</label>

    <div class="col-md-6">
        <input id="name" type="text" class="form-control @error('lastname') is-invalid @enderror" name="lastname" value="{{ old('lastname') }}" required autocomplete="firstname" autofocus>

        @error('lastname')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>

<div class="row mb-3 teacher-input d-none">
    <label for="birth_date" class="col-md-4 col-form-label text-md-end">{{ __('birthdate') }}</label>

    <div class="col-md-6">
        <input id="birth_date" type="date" class="form-control @error('birth_date') is-invalid @enderror" name="birth_date" value="{{ old('birth_date') }}" required autocomplete="firstname" autofocus>

        @error('birth_date')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>

<div class="row mb-3 teacher-input d-none">
    <label for="selectSex" class="col-md-4 col-form-label text-md-end">{{ __('sex') }}</label>

    <div class="col-md-6">
        <select id="selectSex" name="sex" class="form-select" aria-label="Default select example">
            <option selected >Select his sex</option>
            <option value="male" >Male</option>
            <option value="female" >Female</option>
          </select>

        @error('sex')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
<div class="row mb-3 teacher-input d-none">
    <label for="address" class="col-md-4 col-form-label text-md-end">{{ __('address') }}</label>

    <div class="col-md-6">
        <input placeholder="(street, city, and state)" id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}" required autocomplete="address" autofocus>

        @error('address')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
<div class="row mb-3 teacher-input d-none">
    <label for="grade" class="col-md-4 col-form-label text-md-end">{{ __('grade') }}</label>

    <div class="col-md-6">
        <input placeholder="" id="grade" type="text" class="form-control @error('grade') is-invalid @enderror" name="grade" value="{{ old('grade') }}" required autocomplete="grade" autofocus>

        @error('grade')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
{{-- ///////////////////// Teacher ////////////// --}}
<script type="text/javascript">
const form=document.getElementById('add01');
const selectRole=document.getElementById('selectRole');
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


                        selectRole.addEventListener('change', (event) => {
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

    if (event.target.value === 'student') {
        for (let index = student.length-1; index >= 0; index--) {
          temp=student[index];
        temp.classList.remove("d-none");
        temp.classList.add("info-person");
        lastInfo.after(temp);

      }
    } else {
        if (event.target.value === 'parent') {
            for (let index = parent.length-1; index >= 0; index--) {
          temp=parent[index];
        temp.classList.remove("d-none");
        temp.classList.add("info-person");
        lastInfo.after(temp);

      }
        }

    }
  }



});


// selectRole.addEventListener('change', function handleChange(event) {
//   if (event.target.value === 'teacher') {
//     const span = document.createElement("span");

//     selectRole.after(span);

//   } else {
//   });
</script>
@endsection
