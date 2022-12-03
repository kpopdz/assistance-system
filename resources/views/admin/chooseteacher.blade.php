@extends('layouts.teacher')

@section('content')

<div class="row">
        <div class="col-lg-6 mx-sm-auto">

            <div class="card">
              <div class="card-body">
                <h5 class="card-title">choose teacher</h5>
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
            <form action="{{route('indcate.teachers',[$classroom,$data1])}}" method="get">            <div class="dataTable-search">
                <input placeholder="Search..." class="dataTable-input type=" type="search" name="query" id="">
            <input type="submit" value="search">
            </div>
            </form>
            <form action="{{route('indcate.teachers.save')}}" method="post">
                @csrf
                @method('POST')
                <input type="hidden" name="module"value="{{$data1}}">
                <input type="hidden" name="classroom_id" value="{{$classroom->id}}">
                <!-- Default Table -->
                <div class="form-check form-switch mb-2 mt-5">
                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" name="allmod" value="1">
                    <label class="form-check-label" for="flexSwitchCheckChecked">all modules</label>
                  </div>
                <table class="table">
                    <thead>
                      <tr>
                          <th scope="col"></th>

                        <th scope="col">#</th>
                        <th scope="col">Teacher ID</th>

                        <th scope="col">Full Name</th>

                      </tr>
                    </thead>
                    <tbody>

                        @foreach ($teachers as $teacher)

                      <tr>
                          <td>
                            <input type="radio" name="teacher_id" value="{{$teacher->id}}">
                          </td>

                        <th scope="row"></th>
                        <td>{{$teacher->teacher_id}}</td>

                        <td>{{$teacher->firstname}} {{ $teacher->lastname}}</td>






                      </tr>



          @endforeach

                    </tbody>
                  </table>
                <!-- End Table Variants -->
                <h5>Pagination:</h5>
                {{ $teachers->links() }}
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
