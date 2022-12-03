@extends('layouts.teacher')
@section('content')
<div class="row">
    @foreach ($courses as $course)
    <div class="col-3 me-5" style="">
        <div class="col" style="background-color: white;border: 1px solid black;
        border-radius:6px;
        padding:10px"> <div class="row" class="">

            <a href="{{route('public.courses.view',$course)}}">
                @if ($course->module=='math')
                <img src="{{ asset('uploads/modules/math.jpg')}}" alt="" style="width: 250px;height:150px">

                @else
                @if ($course->module=='arabic')

                @endif
                <img src="{{ asset('uploads/modules/arabic.jpg')}}" alt="" style="width: 250px;height:150px">

                @endif

            </a>
        </div>
        <div class="row">
            <h1>{{$course->name}}</h1>
        </div>
    <div class="d-flex justify-content-between align-content-center">
        <div class="">               <img src="{{url('icons/Account-Avatar.png')}}" alt="Profile" class="rounded-circle" width="25px">

            {{$course->user->teacher->firstname}}  {{$course->user->teacher->firstname}}</div>
        <div class="">{{$course->module}}</div>
    </div></div>


            </div>

    @endforeach


</div>
@endsection
