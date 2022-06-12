@extends('layouts.teacher')
@section('content')
<div class="pagetitle">
    <h1>List of students</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>

        <li class="breadcrumb-item active">List of students</li>
      </ol>
    </nav>
  </div>
<div class="col-lg-8 m-sm-auto">

    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Default Table</h5>

        <!-- Default Table -->
        <table class="table">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Full Name</th>
              <th scope="col">Group</th>
              <th scope="col">Age</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
              @php
                 $i=1;
              @endphp
              @foreach ($students as $student)

            <tr>
              <th scope="row">{{$i}}</th>
              <td>{{$student->firstname}} {{ $student->lastname}}</td>
              <td>{{$student->class_name}}</td>
              <td>{{$student->age()}}</td>
              <td>
                  <div class="row">
<div class="col">           <a href="" class=" btn btn-outline-success"><i class="bi bi-eye" ></i>
    </a>     </div> <div class="col">    <a href="" class="btn btn-outline-primary"><i class="bi bi-pen"></i></a>
</div>
<div class="col">           <a href="" class="btn btn-outline-danger"><i class="ri-delete-bin-3-line"></i></a>
</div>

                  </div>

            </td>
            </tr>

@php
    $i++;
@endphp            @endforeach

          </tbody>
        </table>
        <!-- End Default Table Example -->
      </div>
    </div>







  </div>
@endsection
