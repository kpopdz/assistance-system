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

<a href="{{route('class.level')}}" class="btn btn-success mb-3" style="">class level</a>
<div class="col-xl-8">


    {{-- <div class="card d-flex flex-row">
      <div class="col">
      <div class="card-body profile-card pt-4 d-flex flex-row align-items-start justify-content-between">
<div>        <img id="quiz_image_color" src="{{ url('icons/logo_placeholder_sm.png')}}" alt="Profile" class="rounded">
    <script>
        var colors = ['#8854c0', '#00c985', '#ef3c69'];
var random_color = colors[Math.floor(Math.random() * colors.length)];
document.getElementById('quiz_image_color').style.backgroundColor = random_color;
    </script>
</div>
     <div>
        <h2>Kevin Anderson</h2>
        <h3>Web Designer</h3>
        <div class="social-links mt-2">
          <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
          <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
          <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
          <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
     </div>
        </div>
      </div>
    </div>
    </div> --}}
    @foreach ($quizs as $quiz)
 <div class="card d-flex flex-row">

    <div class="col p">

              <div class="card-body profile-card pt-4 d-flex flex-row align-items-start ">

                <div>                        <a href=" {{ route('quizs.show',$quiz->id)}}">
                    @if ($quiz->image==null)
                    <img id="quiz_image_color" src="{{ url('icons/logo_placeholder_sm.png')}}" alt="Profile" class="rounded q">
                    @else
                    <img src="{{url($quiz->image)}}" alt="" class=" rounded quiz-picture">
                    @endif
</a>
                </div>
               <div class=" col p-2 d-flex flex-column justify-content-between"style=" height: 150px;" >
           <div class="d-flex flex-row justify-content-between ">
              <h6 style=" flex-shrink: 0;color:#747474;">QUIZ</h6>

              <span>{{Carbon\Carbon::parse($quiz->created_at)->diffForHumans()}}


                          </div>
      <div class="d-flex flex-coulmn">
          <div class="col-9 d-flex flex-column justify-content-between"><h2 style=" flex-shrink: 0;">{{$quiz->title}}</h2>
            <div class="social-links mt-2" style=" flex-shrink: 0;">
                <a href="#" class="twitter"><i class="bi bi-list-ul"></i> </a>
                <span>{{$quiz->question->count()}} Questions</span>
                <a href="#" class="facebook"><i class="bx bxs-graduation"></i></a>
                <span> grade</span>

                <a href="#" class="instagram"><i class="bi bi-play"></i></a>
                <span>{{$quiz->userpassesquiz()}}</span>

                <a href="#" class="linkedin"><i class="bi bi-heart"></i></a>
                <span>0</span>

                </div></div><div class="col-3 d-flex flex-row justify-content-end align-items-end">
                                    <a class="btn btn-primary" href="{{ route('teacher.myquizs.results',$quiz->id)}}">Results</a>
          </div>

    </div>

            <div>
                     <img src="{{url('icons/unnamed.png')}}" alt="" class="user-icon"> <span class="user-name">{{$quiz->name}}</span>
            </div>
            <div style="position: relative">




                    </div>

                    @if ($quiz->publish==1)
                                <div class="position-absolute  top-0 end-0">
                                    <!-- Disabled Backdrop Modal -->
                                    {{-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#disablebackdrop">
                                    assign
                                    </button>
                                    <div class="modal fade" id="disablebackdrop" tabindex="-1" data-bs-backdrop="false">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Disabled Backdrop</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Non omnis incidunt qui sed occaecati magni asperiores est mollitia. Soluta at et reprehenderit. Placeat autem numquam et fuga numquam. Tempora in facere consequatur sit dolor ipsum. Consequatur nemo amet incidunt est facilis. Dolorem neque recusandae quo sit molestias sint dignissimos.
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary">Save changes</button>
                                        </div>
                                        </div>
                                    </div>
                                    </div><!-- End Disabled Backdrop Modal--> --}}




                              </div>
                    @endif







                </div>
        </div>


      </div>

      </div>
@endforeach
  </div>



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
</div></div> --}}


@endsection
