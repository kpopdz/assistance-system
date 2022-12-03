@extends('layouts.teacher')

@section('content')
<style>
    #butgen {
  font-size: 15px;
  border: 2px solid #7100cf;
  width: 100px;
  height: 40px;
  background-color: #7100cf;
  color: rgb(255, 255, 255);
  cursor: pointer;
  border-radius: 5px;
}
</style>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Add a New Student') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('students.add.save') }}" id="add01">
                        @csrf

                        {{-- <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div> --}}


                        {{-- <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div> --}}
                        <input type="hidden" value="student" name="role">
                        <fieldset class="border p-1 mb-2">
                            <legend  class="float-none w-auto p-2">Personal information</legend>
                            <div class="row mb-3 student-input  ">
                                <label for="student_id" class="col-md-4 col-form-label text-md-end">{{ __('ID Number:') }}</label>

                                <div class="col-md-6">
                                    <input id="student_id" type="text" class="form-control @error('student_id') is-invalid @enderror" name="student_id" value="{{ old('student_id') }}" required autocomplete="student_id" autofocus>

                                    @error('student_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3 student-input  ">
                                <label for="lastname" class="col-md-4 col-form-label text-md-end">{{ __('Last Name:') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('lastname') is-invalid @enderror" name="lastname" value="{{ old('lastname') }}" required autocomplete="firstname" autofocus>

                                    @error('lastname')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3 student-input  ">
                                <label for="firstname" class="col-md-4 col-form-label text-md-end">{{ __('First Name:
                                    ') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('firstname') is-invalid @enderror" name="firstname" value="{{ old('firstname') }}" required autocomplete="firstname" autofocus>

                                    @error('firstname')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="row mb-3 student-input  ">
                                <label for="birth_date" class="col-md-4 col-form-label text-md-end">{{ __('Birthdate:
                                    ') }}</label>

                                <div class="col-md-6">
                                    <input id="birth_date" type="date" class="form-control @error('birth_date') is-invalid @enderror" name="birth_date" value="{{ old('birth_date') }}" required autocomplete="firstname" autofocus>

                                    @error('birth_date')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="row mb-3 student-input  ">
                                <label for="nationality" class="col-md-4 col-form-label text-md-end">{{ __('Nationality:
                                    ') }}</label>

                                <div class="col-md-6">
                                    <select name="nationality"  id="country" class="form-control">
                                        <option value="">Select Nationality</option>
                                        @foreach ($countries as $country)
                                            <option value="{{ $country }}">{{ $country }}</option>
                                        @endforeach
                                    </select>
                                    @error('nationality')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3 student-input  ">
                                <label for="selectSex" class="col-md-4 col-form-label text-md-end">{{ __('Gender:') }}</label>

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
                            <div class="row mb-3 student-input  ">
                                <label for="address" class="col-md-4 col-form-label text-md-end">{{ __('Home Address:
                                    ') }}</label>

                                <div class="col-md-6">
                                    <input placeholder="(street, city, and state)" id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}" required autocomplete="address" autofocus>

                                    @error('address')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="row mb-3 student-input ">

                            <label for="academic_level" class="col-md-4 col-form-label text-md-end">{{ __('Academic Level: Choose a level') }}</label>
                            <div class="col-md-6">
                                    <select id="academic_level" name="academic_level" class="form-select" aria-label="Default select example">
                                        @foreach ($academic_level as $item)
                                        <option value="{{$item->id}}" >{{$item->level}} </option>

                                        @endforeach


                                      </select>


                            </div>
                            </div>

                         </fieldset>
                         <fieldset class="border p-1 mb-2">
                            <legend  class="float-none w-auto p-2">Account  information</legend>

                            <div class="row mb-3">
                                <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email:
                                    ') }}</label>

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
                                <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password: (Auto-generated)
                                    ') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="text" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" value="{{$string}}">
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>
                                <div class="col-md-2">
                                </div>


                            </div>

                        </fieldset>


                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">

                                <button type="submit" class="btn btn-primary">

                                    {{ __('Add student') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- ///////////////////// student ////////////// --}}

{{-- ///////////////////// student ////////////// --}}



@endsection
