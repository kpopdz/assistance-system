@extends('layouts.app')
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
      <th scope="col">student</th>
      <th scope="col">point </th>




      <th scope="col" style="width: 400px">action</th>


  </tr>
  </thead>
  @foreach ($results as $item)

  <tbody><tr>
      <th scope="row" >
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
</div></div>


@endsection
