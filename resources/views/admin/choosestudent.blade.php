@extends('layouts.teacher')

@section('content')

<div class="row">
        <div class="col-lg-6 mx-sm-auto">

            <div class="card">
              <div class="card-body">
                <h5 class="card-title">add students</h5>
                <div class="col">


                    {{-- <label for="uearacad">choose the year</label> --}}
                {{-- <select name="academic_year" id="uearacad" class="form-select ms-1 col-5"> --}}
                    {{-- <option value="" selected >year</option> --}}
                    <?php
                    //     $date3=date('Y', strtotime('-5 Years'));

                    // $date2=date('Y', strtotime('+1 Years'));
                    // for($i=$date3; $i<$date2+5;$i++){
                    //     echo '<option value="'.$i.'-'.($i+1).'" >'.$i.'-'.($i+1).'</option>';
                    // }
                 ?>

                </select>
            </div>
            <form action="{{route('add.student.to.class',$classroom)}}" method="get">            <div class="dataTable-search">
                <input placeholder="Search..." class="dataTable-input type=" type="search" name="query" id="">
            <input type="submit" value="search">
            </div>
            </form>
            <form action="{{route('indcate.student.save')}}" method="post">
                @csrf
                @method('POST')
                <input type="hidden" name="classroom_id" value="{{$classroom->id}}">
                <!-- Default Table -->

                  <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">#</th>

                        <th scope="col">Full Name</th>


                        <th scope="col">Age</th>
                        <th scope="col">Sex</th>

                      </tr>
                    </thead>
                    <tbody>
                        @php
                           $i=1;
                        @endphp
                        @foreach ($students as $student)

                      <tr>
                        <th scope="row"><input type="radio" name="student_id" id="" value="{{$student->id}}"></th>

                        <td>{{$student->firstname}} {{ $student->lastname}}</td>
                        {{-- <td>{{$student->academic_year}}</td> --}}





                        <td>{{$student->age()}}</td>
                        <td>{{$student->sex}}</td>


                      </tr>
                      <div class="modal fade" id="verticalycentered{{$i}}" tabindex="-1">
                          <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title">Delete student "{{$student->firstname}} {{$student->lastname}}"</h5>
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


          @endforeach

                    </tbody>
                  </table>
                <!-- End Table Variants -->
                <h5>Pagination:</h5>
                {{ $students->links() }}
              </div>
            </div>

          </div>

          </div>
        </div>
        <div class="col-6 mx-sm-auto text-center">

            <button class="btn btn-success col-6 ">save</button>
        </div>
    </form>
@endsection
