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
    <h1>Students</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>

        <li class="breadcrumb-item active">Students</li>
      </ol>
    </nav>
  </div>
<div class="col m-sm-auto">

    <div class="card">
      <div class="card-body">
        <h5 class="card-title">List of Students</h5>
<div class="col mb-6">
    <div class="row mb-4 ">    <div class="ms-sm-auto" style="width: fit-content;"><a href="{{route('students.view.add')}}" class="btn btn-success ">
        <i class="ri-add-box-line"></i> Add Student
    </a></div></div>

<div class="row mb-5">

    <form action="
    {{route('students.list.search')}}
    " method="get" class="d-flex">
        <div class="position-relative col-4 me-sm-auto ">
            <input type="search" name="query" id="query" placeholder="Find by name " class="quiz-search ms-1">
            <button class="button-search position-absolute end-0 top-0"><i class="bi bi-search"></i></button>

        </div>
        <div class="col-1 ms-1 ">
        <select name="academic_year" id="inputState" class="form-select ms-1">
            <option value="" selected >Year</option>
            <?php
                $date3=date('Y', strtotime('-5 Years'));

            $date2=date('Y', strtotime('+1 Years'));
            for($i=$date3; $i<$date2+5;$i++){
                echo '<option value="'.$i.'-'.($i+1).'" >'.$i.'-'.($i+1).'</option>';
            }
         ?>

        </select>
        </div>

        <div class="col-2 ms-1">                <select id="inputState" class="form-select ms-1" name="academic_level">
            <option value="">Level</option>
            @foreach ($academic_level as $item)
            <option value="{{$item->id}}">{{$item->level}}</option>

            @endforeach

          </select></div>

        <div class="col-2 ms-1 ">                <select id="inputState" class="form-select ms-1" name="group">
            <option value="">Group</option>
@foreach ($classrooms as $item)
<option value="{{$item->id}}">{{$item->class_name}}</option>

@endforeach
          </select>
        </div>





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
              <th scope="col">Age</th>

              <th scope="col">Gender</th>

              <th scope="col">Academic Level</th>

              {{-- <th scope="col">Academic level</th> --}}

              <th scope="col">Group No</th>

              <th scope="col">Actions</th>
            </tr>
          </thead>
          <tbody>
              @php
                 $i=1;
              @endphp
              @foreach ($students as $student)

            <tr>
              <th scope="row">{{$i}}</th>
              <td>{{$student->student_id}}</td>

              <td>{{$student->firstname}} {{ $student->lastname}}</td>
              {{-- <td>{{$student->academic_year}}</td> --}}
              <td>{{$student->age()}}</td>
              <td>{{$student->sex}}</td>
              <td>
                @if ($student->academic_levelname!==null)
                {{$student->academic_levelname->level}}
              @endif</td>
              <td>
                @foreach ($student->user->classes as $item)
                {{$item->class_name}}
                @endforeach
                {{-- {{$student->class_name}} --}}

            </td>




              <td>
                  <div class="row">
                    {{-- <a href="{{route('student.state.update',$student)}}">state</a> --}}
<div class="col">           <a href="{{route('students.view',$student)}}" class=" btn btn-outline-success" data-bs-toggle="tooltip" data-bs-placement="bottom" title="View"><i class="bi bi-eye" ></i>
    </a>     </div> <div class="col">    <a href="{{route('students.edit.profile',$student)}}" class="btn btn-outline-primary" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit"><i class="bi bi-pen"></i></a>
</div>
<div class="col">           <button class="btn btn-outline-danger" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Delete"><i class="ri-delete-bin-3-line"  data-bs-toggle="modal" data-bs-target="#verticalycentered{{$i}}"></i></button>
</div>

                  </div>

            </td>
            </tr>
            <div class="modal fade" id="verticalycentered{{$i}}" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Deleting the student "{{$student->firstname}} {{$student->lastname}}"</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to delete this student? This action <strong>cannot</strong> be undone.         </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>

                                         <a href="{{route('delete.student',$student)}}" class="btn btn-danger"> Delete </a>

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
        {{ $students->links() }}
      </div>
        <!-- End Default Table Example -->
      </div>
    </div>







  </div>
@endsection
