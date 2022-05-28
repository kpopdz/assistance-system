@extends('layouts.teacher')
<style>.list-group li {
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
        }</style>
@section('content')
<div class="container" style="padding-top: 2% ">

       @if ($message=Session::get('success'))
      <div class="container" style="padding-top: 2%">
      <div class="alert alert-primary" role="alert">
      {{$message}}</div>
       </div>
       @endif

       </div>

  <div class="container" style="padding-top: 2%">


<table class="table" >
  <thead class="table-dark">
    <tr>

      <th scope="col">id</th>
      <th scope="col">title</th>
      <th scope="col">teacher</th>

      <th scope="col">number of question</th>
           <th scope="col"> total points</th>


      <th scope="col">created at</th>

      <th scope="col" style="width: 400px">action</th>


  </tr>
  </thead>
  @foreach ($quizs as $item)

  <tbody><tr>
      <th scope="row" ><input type="radio" name="ids[]" id="" value="{{$item->id}}">
          </th>
      <td >{{$item->title}}</td>
      <td >{{Auth::user()->teacher->firstname}} {{Auth::user()->teacher->lastname}}</td>

      <td>{{$item->question->count()}}</td>
      <td >{{$item->totalPoint()}}</td>



      <td ><div class="time"><span>{{Carbon\Carbon::parse($item->created_at)->diffForHumans()}}</span></div></td>
      <td>
          <div class="row">

<div class="col-sm">
  <a class="btn btn-primary" href="{{ route('teacher.myquizs.results',$item->id)}}">Results</a>
</div>







                  </div>
                  </td>
  </tr>

  </tbody>
  @endforeach

</table>
<div class="d-flex justify-content-center">
</div></div>


@endsection
