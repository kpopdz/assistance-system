@extends('layouts.teacher')
@section('content')
@if ($message=Session::get('success'))
<div class="alert alert-success alert-dismissible fade show mt-5" role="alert">
    <i class="bi bi-check-circle me-1"></i>
    {!!$message!!}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
 @endif
<div class="pagetitle">
    <h1>Teachers</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>

        <li class="breadcrumb-item active">Teachers</li>
      </ol>
    </nav>
  </div>
<div class="col m-sm-auto">

    <div class="card">
      <div class="card-body">
        <h5 class="card-title">List of Teachers</h5>
<div class="col mb-6">
    <div class="row mb-4 ">    <div class="ms-sm-auto" style="width: fit-content;"><a href="{{route('teachers.view.add')}}" class="btn btn-success ">
        <i class="ri-add-box-line"></i> Add Teacher
    </a></div></div>

<div class="row mb-5">

    <form action="
    {{route('teachers.list.search')}}
    " method="get" class="d-flex">
        <div class="position-relative col-4 me-sm-auto ">
            <input type="search" name="query" id="query" placeholder="Find by name" class="quiz-search ms-1">
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
              <th scope="col">ID Number</th>

              <th scope="col">Full Name</th>
              <th scope="col">Gender</th>
              <th scope="col">Birthdate</th>

              <th scope="col">Grade</th>

              {{-- <th scope="col">Academic level</th> --}}
              <th scope="col">Email</th>
              <th scope="col">Created at</th>
              <th scope="col">Status</th>


              <th scope="col">Actions</th>
            </tr>
          </thead>
          <tbody>
              @php
                 $i=1;
              @endphp
              @foreach ($teachers as $teacher)

            <tr>

              <th scope="row">{{$i}}</th>
              <td>{{$teacher->teacher_id}}</td>

              <td>{{$teacher->firstname}} {{ $teacher->lastname}}</td>
              <td>{{$teacher->sex}}</td>

              <td>{{$teacher->birth_date}}</td>

              {{-- <td>{{$student->academic_year}}</td> --}}

              <td>
                {{$teacher->grade}}
              </td>
              <td>{{$teacher->user->email}}</td>
              <td>{{$teacher->user->created_at}}</td>
              <td>
                @if ($teacher->user->status=='Active')
                <span class="badge bg-success">{{$teacher->user->status}}</span>
                @else
                <span class="badge bg-danger">{{$teacher->user->status}}</span>

                @endif
                </td>



              <td>
                  <div class="row">
                    {{-- <a href="{{route('student.state.update',$student)}}">state</a> --}}
<div class="col-1 me-4">           <a href="{{route('teachers.view',$teacher)}}" class=" btn btn-outline-success" style="margin-right:" data-bs-toggle="tooltip" data-bs-placement="bottom" title="View"><i class="bi bi-eye" ></i>
    </a>     </div> <div class="col-1 me-4">    <a href="{{route('teachers.edit.profile',$teacher)}}" class="btn btn-outline-primary"data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit"><i class="bi bi-pen"></i></a>
</div>
<div class="col-1 me-4">         <button class="btn btn-outline-danger" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Delete"><i class="ri-delete-bin-3-line" data-bs-toggle="modal" data-bs-target="#verticalycentered{{$i}}"></i></button>
</div>

                  </div>

            </td>
            </tr>
            <div class="modal fade" id="verticalycentered{{$i}}" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Deleting the teacher {{$teacher->firstname}} {{$teacher->lastname}}</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Do you want to delete this teacher? This action cannot be undone.          </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>

                                         <a href="{{route('delete.teacher.one',$teacher->id)}}" class="btn btn-danger"> DELETE </a>

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
        {{ $teachers->links() }}
      </div>
        <!-- End Default Table Example -->
      </div>
    </div>







  </div>
@endsection
