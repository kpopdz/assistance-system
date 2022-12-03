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
    <h1>information about the class</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>

        <li class="breadcrumb-item active">classroom</li>
      </ol>
    </nav>
  </div>
  <div class="col-lg-9">

    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Default Accordion</h5>

        <!-- Default Accordion -->
        <div class="accordion" id="accordionExample">
          <div class="accordion-item">
            <h2 class="accordion-header" id="headingOne">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                the class
              </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample" style="">
              <div class="accordion-body">
                <div class="row mt-4">
                    <div class="col-lg-3 col-md-4 label ">Classroom:
                    </div>
                    <div class="col-lg-9 col-md-8">{{$classroom->class_name}} </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-3 col-md-4 label ">Academic Year:
                    </div>
                    <div class="col-lg-9 col-md-8"> {{$classroom->academic_year}}</div>
                  </div>
                         </div>
            </div>
          </div>
          <div class="accordion-item">
            <h2 class="accordion-header" id="headingTwo">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                Students
              </button>
            </h2>
            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample" style="">
              <div class="accordion-body">
                <div class="col m-sm-auto">

                    <div class="card">
                      <div class="card-body">
                        <h5 class="card-title">Students Table</h5>
                <div class="col mb-6">



                {{--
                          <div class="col-2 ms-1">                <select id="inputState" class="form-select ms-1" name="order">
                            <option value="">sort by</option>
                            <option value="asc">alphabetical</option>
                            <option value="desc">most recent</option>
                          </select></div> --}}



                    </form>
                </div>
<a href="{{route('add.student.to.class',$classroom)}}" class="btn btn-success"> add student</a>


                        <!-- Default Table -->
                        <table class="table">
                          <thead>
                            <tr>
                              <th scope="col">#</th>

                              <th scope="col">Full Name</th>


                              <th scope="col">Age</th>
                              <th scope="col">Sex</th>

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
                              {{-- <td>{{$student->academic_year}}</td> --}}





                              <td>{{$student->age()}}</td>
                              <td>{{$student->sex}}</td>

                              <td>
                                  <div class="row">
                                    {{-- <a href="{{route('student.state.update',$student)}}">state</a> --}}

                <div class="col">           <button class="btn btn-outline-danger" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Delete" ><i class="ri-delete-bin-3-line" data-bs-toggle="modal" data-bs-target="#verticalycentered{{$i}}"></i></button>
                </div>
                                  </div>


                            </td>
                            </tr>
                            <div class="modal fade" id="verticalycentered{{$i}}" tabindex="-1">
                                <div class="modal-dialog modal-dialog-centered">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title">Delete student "{{$student->firstname}} {{$student->lastname}}" from classromm</h5>
                                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        do you want delete The student  "{{$student->firstname}} {{$student->lastname}}"          </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                                                         <a href="{{route('delete.from.classroom',[$classroom,$student])}}" class="btn btn-danger"> DELETE </a>

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
                      </div>
                        <!-- End Default Table Example -->
                      </div>
                    </div>              </div>
            </div>
          </div>

          <div class="accordion-item">
            <h2 class="accordion-header" id="headingThree">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
teachers              </button>
            </h2>
            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample" style="">
              <div class="accordion-body">


                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">Module</th>
                        <th scope="col">ID</th>

                        <th scope="col">Full Name</th>



                        {{-- <th scope="col">Academic level</th> --}}








                        <th scope="col">Actions</th>
                      </tr>
                    </thead>
                    <tbody>
@php
    $j=50;
@endphp

                        @for ($k=0;$k<count($data1['module']);$k++)

                      <tr>
                        <th scope="row">  {{                $data1['module'][$k]
                        }}</th>
@if (!empty($data1['teachers'][$k]->firstname))
<td>
    {{$data1['teachers'][$k]->teacher_id}}
</td>

<td>
                            {{$data1['teachers'][$k]->firstname}}
                            {{ $data1['teachers'][$k]->lastname}}
                        </td>



                        {{-- <td>{{$student->academic_year}}</td> --}}






                        <td>
                            <div class="row">
                              {{-- <a href="{{route('student.state.update',$student)}}">state</a> --}}
          <div class="col-1 me-4">
              {{-- </a>     </div> <div class="col-1 me-4">    <a href="
                {{route('teachers.edit.profile',$data1['teachers'][$k])}}" class="btn btn-outline-primary"><i class="bi bi-pen"></i></a>
          </div> --}}
          <div class="col-1 me-4">           <button class="btn btn-outline-danger" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Delete"><i class="ri-delete-bin-3-line" data-bs-toggle="modal" data-bs-target="#verticalycentered{{$j}}"></i></button>
          </div>

                            </div>

                      </td>

                      </tr>
                      <div class="modal fade" id="verticalycentered{{$j}}" tabindex="-1">
                          <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title">Deleting the teacher from classroom </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <div class="modal-body">
                                  Do you want to delete this teacher? This action <strong>cannot</strong>  be undone.          </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>

                                                   <a href="{{route('delete.teacher.from.classroom',[$classroom,$data1['teachers'][$k],$data1['module'][$k]])}}" class="btn btn-danger"> DELETE </a>

                              </div>
                            </div>
                          </div>
                        </div>
@php
    $j++
@endphp
                        @else
                        <td></td>
                        <td></td>
                        <td>
                            <div class="row">
                              {{-- <a href="{{route('student.state.update',$student)}}">state</a> --}}
          <div class="col-1 me-4">           <a href="{{route('indcate.teachers',[$classroom,$data1['module'][$k]])}}" class=" btn btn-outline-success" style="margin-right:" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Add Teacher to module"><i class="bi bi-person-plus"></i>
              </a>
          </div>


                            </div>

                      </td>
                      @php
                      $j++;
                  @endphp
                        @endif




@endfor

                    </tbody>
                  </table>
                        </div>
            </div>
          </div>
        </div><!-- End Default Accordion Example -->

      </div>
    </div>

  </div>








  </div>
@endsection




