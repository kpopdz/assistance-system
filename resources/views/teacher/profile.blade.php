@extends('layouts.teacher')

@section('content')
<form action="{{route('post.profile.m')}}" method="post">
@csrf

<div class="container rounded bg-white mt-5 mb-5">
    <div class="row">
        <div class="col-md-3 border-right">
            <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img class="rounded-circle mt-5" width="150px" src="{{url('uploads/quiz/female_teacher.png')}}"><span class="font-weight-bold">{{Auth::user()->name}}</span><span class="text-black-50">{{Auth::user()->email}}</span><span> </span></div>
        </div>
        <div class="col-md-5 border-right">
            <div class="p-3 py-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="text-right">Profile Settings</h4>
                </div>
                <div class="row mt-2">
                    <div class="col-md-6"><label class="labels">Firstname</label><input type="text" class="form-control" name="firstname" placeholder="first name" value=""></div>
                    <div class="col-md-6"><label class="labels">Lastname</label><input type="text" class="form-control" name="lastname" value="" placeholder="Lastname"></div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-12"><label class="labels">birthdate</label><input type="date" class="form-control" name="birthdate"></div>
                    <div class="col-md-12"><label class="labels">Sex</label><select id="" name="sex" class="form-control"">
                        <option value="male">male</option>
                        <option value="female">female</option>
                    </select></div>
                    <div class="col-md-12"><label class="labels">Address</label><input type="text" class="form-control" placeholder="address " value="" name="address"></div>
                    <div class="col-md-12"><label class="labels">Grade</label><input type="text" class="form-control" placeholder="grade" value="" name="grade"></div>
                    <div class="col-md-12"><label class="labels">Marital_situation</label><input type="text" class="form-control" placeholder="situation" value="" name="situation"></div>

                </div>

                <div class="mt-5 text-center"><input type="submit"></div>
            </div>
        </div>

    </div>
</div>
</div>
</div>
</form>
@endsection
