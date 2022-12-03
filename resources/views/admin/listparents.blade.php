@extends('layouts.teacher')
@section('content')
@if ($message=Session::get('error'))
<div class="alert alert-danger alert-dismissible fade show mt-5" role="alert">
    <i class="bi bi-check-circle me-1"></i>
    {!!$message!!}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
 @endif
@if ($message=Session::get('success'))
<div class="alert alert-success alert-dismissible fade show mt-5" role="alert">
    <i class="bi bi-check-circle me-1"></i>
    {!!$message!!}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
 @endif
<div class="pagetitle">
    <h1>List of parents</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>

        <li class="breadcrumb-item active">List of parents</li>
      </ol>
    </nav>
  </div>
<div class="col m-sm-auto">

    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Parents Table</h5>
<div class="col mb-6">
    {{-- <div class="row mb-4 ">    <div class="col-3 ms-sm-auto"><a href="{{route('teachers.view.add')}}" class="btn btn-success ">
        <i class="ri-add-box-line"></i> Add Parents
    </a></div></div> --}}

<div class="row mb-5">

    <form action="
    {{route('teachers.list.search')}}
    " method="get" class="d-flex">
        <div class="position-relative col-4 me-sm-auto ">
            <input type="search" name="query" id="query" placeholder="search " class="quiz-search ms-1">
            <button class="button-search position-absolute end-0 top-0"><i class="bi bi-search"></i></button>

        </div>
        <div class="col-1 ms-1 ">
        {{-- <select name="academic_year" id="inputState" class="form-select ms-1">
            <option value="" selected >year</option>
            <?php
            //     $date3=date('Y', strtotime('-5 Years'));

            // $date2=date('Y', strtotime('+1 Years'));
            // for($i=$date3; $i<$date2+5;$i++){
            //     echo '<option value="'.$i.'-'.($i+1).'" >'.$i.'-'.($i+1).'</option>';
            // }
         ?> --}}

        </select>
        </div>

        {{-- <div class="col-2 ms-1">                <select id="inputState" class="form-select ms-1" name="academic_level">
            <option value="">Academic level</option>
            @foreach ($academic_level as $item)
            <option value="{{$item->id}}">{{$item->level}}</option>

            @endforeach

          </select></div> --}}

        {{-- <div class="col-2 ms-1 ">                <select id="inputState" class="form-select ms-1" name="group">
            <option value="">Choose the class</option>
@foreach ($classrooms as $item)
<option value="{{$item->id}}">{{$item->class_name}}</option>

@endforeach
          </select>
        </div> --}}





        </div>
{{--
          <div class="col-2 ms-1">                <select id="inputState" class="form-select ms-1" name="order">
            <option value="">sort by</option>
            <option value="asc">alphabetical</option>
            <option value="desc">most recent</option>
          </select></div> --}}



    </form>
</div>



        <!-- Default Table -->
        <table class="table">
          <thead>
            <tr>
              <th scope="col">#</th>

              <th scope="col">Full Name</th>
              <th scope="col">Relation</th>
              <th scope="col">email</th>

              <th scope="col">fullname of students</th>

              {{-- <th scope="col">Academic level</th> --}}
              <th scope="col">state</th>


              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
              @php
                 $i=1;
              @endphp
              @foreach ($parents as $parent)

            <tr>
              <th scope="row">{{$i}}</th>

              <td>{{$parent->full_name}}</td>
              <td>

            @foreach ($parent->students as $item)
            {{$item->pivot->relationship}}
            <br>


            @endforeach
            </td>
            <td>{{$parent->user->email}}</td>


              {{-- <td>{{$student->academic_year}}</td> --}}

              <td>
                @foreach ($parent->students as $item)
                {{$item->firstname}}
                {{$item->lastname}}
<br>

                @endforeach
                </td>
              <td>
                @if ($parent->user->status=='Active')
                <span class="badge bg-success">{{$parent->user->status}}</span>
                @else
                @if ($parent->user->status=='Suspended')
                <span class="badge bg-danger">{{$parent->user->status}}</span>

                @else
                <span class="badge bg-warning">{{$parent->user->status}}</span>
                @endif

                @endif
                </td>



              <td>

                  <div class="row">
                    <div class="col-1 me-4">           <a href="{{route('parents.aprove',$parent)}}" class=" btn btn-outline-primary" style="margin-right:" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Aprove"><i class="bi bi-person-check"></i>
                    </a>     </div>
                    {{-- <a href="{{route('student.state.update',$student)}}">state</a> --}}
<div class="col-1 me-4">           <a href="{{route('parents.view',$parent)}}" class=" btn btn-outline-success" style="margin-right:" data-bs-toggle="tooltip" data-bs-placement="bottom" title="View"><i class="bi bi-eye" ></i>
     </a>     </div>{{-- <div class="col-1 me-4">    <a href="{{route('teachers.edit.profile',$parent)}}" class="btn btn-outline-primary"><i class="bi bi-pen"></i></a>
</div> --}}
<div class="col-1 me-4">           <a href="" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#verticalycentered{{$i}}"><i class="ri-delete-bin-3-line"></i></a>
</div>

                  </div>

            </td>
            </tr>
            <div class="modal fade" id="verticalycentered{{$i}}" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Diasble account of parent "{{$parent->full_name}}"</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        do you want Diasble The account teacher  "{{$parent->full_name}}"          </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>

                                         <a href="{{route('parents.disactive',$parent->id)}}" class="btn btn-danger"> DELETE </a>

                    </div>
                  </div>
                </div>
              </div>
@php
    $i++;
@endphp

@endforeach

          </tbody>
        </table>
        <h5>Pagination:</h5>
        {{ $parents->links() }}
      </div>
        <!-- End Default Table Example -->
      </div>
    </div>







  </div>
@endsection
