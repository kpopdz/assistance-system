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
                <div class="card-header">{{ __('Add Class') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('classroom.save') }}" id="add01">
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


                            <div class="row mb-3 student-input  ">
                                <label for="classroom" class="col-md-4 col-form-label text-md-end">{{ __('classroom') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('firstname') is-invalid @enderror" name="classroom" value="{{ old('classroom') }}" required autocomplete="classroom" autofocus>

                                    @error('classroom')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3 student-input  ">
                                <label for="lastname" class="col-md-4 col-form-label text-md-end">{{ __('academic_year') }}</label>

                                <div class="col-md-6">
                                    <select name="academic_year" id="inputState" class="form-select ms-1">
                                        <option value="" selected >year</option>
                                        <?php
                                            $date3=date('Y', strtotime('-5 Years'));

                                        $date2=date('Y', strtotime('+1 Years'));
                                        for($i=$date3; $i<$date2+5;$i++){
                                            echo '<option value="'.$i.'-'.($i+1).'" >'.$i.'-'.($i+1).'</option>';
                                        }
                                     ?>

                                    </select>
                                </div>
                            </div>















                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">

                                <button type="submit" class="btn btn-primary">

                                    {{ __('Add class') }}
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
