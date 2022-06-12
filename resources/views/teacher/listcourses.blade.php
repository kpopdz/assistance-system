@extends('layouts.teacher')
@section('content')
<div class="row">
    <div class="col-lg-12">

      <div class="card">
        <div class="card-body">
          <h5 class="card-title">List of courses</h5>
          <p>here list of your courses you created</p>
          <p>to upload another class click <a href="{{route('page.upload')}}">here</a></p>
          <!-- Table with stripped rows -->
          <div class="dataTable-wrapper dataTable-loading no-footer sortable searchable fixed-columns"><div class="dataTable-top"><div class="dataTable-dropdown"><label><select class="dataTable-selector"><option value="5">5</option><option value="10" selected="">10</option><option value="15">15</option><option value="20">20</option><option value="25">25</option></select> entries per page</label></div><div class="dataTable-search"><input class="dataTable-input" placeholder="Search..." type="text"></div></div><div class="dataTable-container"><table class="table datatable dataTable-table">
            <thead>
              <tr><th scope="col" data-sortable="" style="width: 5.53967%;">
                <a href="#" class="dataTable-sorter">#</a>
            </th><th scope="col" data-sortable="" style="width: 28.2345%;">
                <a href="#" class="dataTable-sorter">Name</a>
            </th><th scope="col" data-sortable="" style="width: 19.4782%;">
                <a href="#" class="dataTable-sorter">Created Date</a></th>
                <th scope="col" data-sortable="" style="width: 19.4782%;">
                    <a href="#" class="dataTable-sorter">Actions</a></th></tr>
            </thead>
            <tbody>
                @php
                    $i=1;
                @endphp
                @foreach ($courses as $course)

                <tr>
                    <th scope="row">{{$i}}</th>
                    <td>{{$course->name}}</td>

                    <td>{{$course->created_at}}</td>
                    <td>
                        <div class="row d-flex">
                            <div class="col">                            <a class="btn btn-success" href="{{route('course.view',$course->id)}}">view</a>
                            </div>
                            <div class="col"><form action="{{route('course.delete',$course->id)}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" type="submit">Delete</button>
                            </form>

    </div>
                            <div class="col">                            <a class="btn btn-primary" href="{{route('course.view',$course->id)}}">Edit</a>
                            </div>

                        </div>

                    </td>

                </tr>
                @php
                    $i++;
                @endphp
                @endforeach

                    </tbody>
          </table></div><div class="dataTable-bottom"><div class="dataTable-info">Showing 1 to 5 of 5 entries</div><nav class="dataTable-pagination"><ul class="dataTable-pagination-list"></ul></nav></div></div>
          <!-- End Table with stripped rows -->

        </div>
      </div>

    </div>
  </div>
@endsection
