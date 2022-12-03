@extends('layouts.teacher')
<style>
    /* body{background-color: #e5e5f7;
opacity: 0.2;
background: radial-gradient(circle, transparent 20%, #e5e5f7 20%, #e5e5f7 80%, transparent 80%, transparent), radial-gradient(circle, transparent 20%, #e5e5f7 20%, #e5e5f7 80%, transparent 80%, transparent) 57.5px 57.5px, linear-gradient(#444cf7 4.6000000000000005px, transparent 4.6000000000000005px) 0 -2.3000000000000003px, linear-gradient(90deg, #444cf7 4.6000000000000005px, #e5e5f7 4.6000000000000005px) -2.3000000000000003px 0;
background-size: 115px 115px, 115px 115px, 57.5px 57.5px, 57.5px 57.5px;} */

.list-group li {
    display: flex;
    justify-content: space-between;
    align-items: center;
}
.list-group {
            list-style: none;
            margin: 0;
            padding: 0;
            border: 1px solid #ccc;
            border-radius: .5em;
            width: 20em;
        }

        .list-group li {
            border-top: 1px solid #ccc;
            padding: .5em;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .list-group li:first-child {
            border-top: 0;
        }

        .list-group .badge {
            margin-left: 20
            background-color: rebeccapurple;
            color: #fff;
            font-weight: bold;
            font-size: 80%;
            border-radius: 10em;
            min-width: 1.5em;
            padding: .25em;
            text-align: center
        }
        .size-back-image{width: 340px;
        height: 127.33px;}</style>
@section('content')
      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-xl-4 gutters-sm">
        @foreach ($results as $item)

         <div class="col mb-3">
            <div class="card">
              <img src="{{ url('icons/aqua-d9b59c89.png')}}" alt="Cover" class="card-img-top size-back-image">
              <div class="card-body text-center">
                @if ($item->user->avatar==null)
                <img src="{{ url('icons/person.svg')}}" style="width:100px;margin-top:-65px" alt="User" class="img-fluid img-thumbnail rounded-circle border-0 mb-3">

                @else
                <img src="{{ url($item->user->avatar)}}" style="width:100px;margin-top:-65px" alt="User" class="img-fluid img-thumbnail rounded-circle border-0 mb-3">

                @endif
                <h5 class="card-title">{{$item->user->student->firstname}} {{$item->user->student->lastname}}</h5>
                <p class="text-secondary mb-1">{{$item->class_name}}</p>
                <h5>points earned from quiz</h5>

                <div class="progress mt-3 " style="height: 20px;">
                    <div class="progress-bar
                     {{(($item->fullpoint)/($item->quiz->totalPoint())*100) <50 ? 'progress-bar-striped bg-danger' : 'progress-bar-striped bg-success'}} " role="progressbar"
                     style="width: {{($item->fullpoint)/($item->quiz->totalPoint())*100}}%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">{{($item->fullpoint)/($item->quiz->totalPoint())*100}}%</div>
                  </div>            </div>
              <div class="card-footer">
                <div class="d-grid gap-2 mt-3">
                    <a type="button" href="{{ route('results.show',$item->id)}}" class="btn btn-outline-success btn-sm">Result</a>
                </div>
              </div>
            </div>
          </div>
          @endforeach
      </div>
<div class="container" style="padding-top: 2% ">

       @if ($message=Session::get('success'))
      <div class="container" style="padding-top: 2%">
      <div class="alert alert-primary" role="alert">
      {{$message}}</div>
       </div>
       @endif

       </div>

  {{-- <div class="container" style="padding-top: 2%">


<table class="table" >
  <thead class="table-dark">
    <tr>

      <th scope="col">id</th>
      <th scope="col">title</th>
      <th scope="col">student</th>
      <th scope="col">point </th>




      <th scope="col" style="width: 400px">action</th>


  </tr>
  </thead>
  @foreach ($results as $item)

  <tbody><tr>
      <th scope="row" ><img src="{{ url('icons/person.svg')}}" alt="">
          </th>
      <td >{{$item->quiz_id}}</td>
      <td >{{$item->user->student->firstname}} {{$item->user->student->lastname}}</td>
      <td >{{$item->correct_answers}} {{$item->class_name}}   </td>



      <td>
          <div class="row">

<div class="col-sm">
  <a class="btn btn-primary" href="{{ route('results.show',$item->id)}}">show</a>
</div>






                  </div>
                  </td>
  </tr>

  </tbody>
  @endforeach

</table>
<div class="d-flex justify-content-center">
</div></div> --}}


@endsection
