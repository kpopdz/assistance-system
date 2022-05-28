@extends("layouts.teacher")

@section('content')
<style>
.bod{
    width: 100%;
    height: 100%;
    z-index: 10000;
    background-color: #e5e5f7;
opacity: 0.2;
background: radial-gradient(circle, transparent 20%, #e5e5f7 20%, #e5e5f7 80%, transparent 80%, transparent), radial-gradient(circle, transparent 20%, #e5e5f7 20%, #e5e5f7 80%, transparent 80%, transparent) 57.5px 57.5px, linear-gradient(#444cf7 4.6000000000000005px, transparent 4.6000000000000005px) 0 -2.3000000000000003px, linear-gradient(90deg, #444cf7 4.6000000000000005px, #e5e5f7 4.6000000000000005px) -2.3000000000000003px 0;
background-size: 115px 115px, 115px 115px, 57.5px 57.5px, 57.5px 57.5px;}
    .quizimage{
        width: 300px;
        height: 300px;
        border-radius: 8px;
    }
    .quizitem{
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        margin-right: 5px;

        float: left;
    }
    .quiztitle{
    font-family: Roboto-light;
    text-transform: uppercase;

    }

    </style>
    <div class="bod"></div>
@if(session()->has('error'))
<div class="alert alert-danger">
    {{ session()->get('error') }}
</div>
@endif
@php
    $i=0;
@endphp
@foreach ($quizs as $item)

<div class="m-sm-auto col-xl-8 m">


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

 <div class="card d-flex flex-row">

    <div class="col p">

              <div class="card-body profile-card pt-4 d-flex flex-row align-items-start ">

                <div>                        <a href=" {{ route('steponetofinish',$item->id)}}">
                    @if ($item->image==null)
                    <img id="quiz_image_color" src="{{ url('icons/logo_placeholder_sm.png')}}" alt="Profile" class="rounded q">
                    @else
                    <img src="{{url($item->image)}}" alt="" class=" rounded quiz-picture">
                    @endif
            </a>
                </div>
               <div class=" col p-2 d-flex flex-column justify-content-between"style=" height: 150px;" >
           <div class="d-flex flex-row justify-content-between ">
              <h6 style=" flex-shrink: 0;color:#747474;">QUIZ</h6> <span><span></span>Total Point <span> {{$item->totalPoint()}}</span></span>
          </div>
        <div class=" d-flex justify-content-between"><div class="d-flex flex-column justify-content-between">
            <h2 style=" flex-shrink: 0;">{{$item->title}}</h2>
            <div class="social-links mt-2" style=" flex-shrink: 0;">
                <a href="#" class="twitter"><i class="bi bi-list-ul"></i> </a>
                <span>{{$item->question->count()}} Questions</span>
                <a href="#" class="facebook"><i class="bx bxs-graduation"></i></a>
                <span> grade</span>

                <a href="#" class="instagram"><i class="bi bi-play"></i></a>
                <span>{{$item->userpassesquiz()}}</span>



                </div>
                <div>
                    <img src="{{url('icons/unnamed.png')}}" alt="" class="user-icon"> <span class="user-name">{{$item->firstname}} {{$item->lastname}}</span>
           </div>
             </div>
             <div class="d-flex flex-column justify-content-between ">
                <a class="btn btn-danger" href="{{route('myresult',$item)}}">result</a>
                <a class="btn btn-success" href="{{route('student.pass',[$item,$data2[$i]])}}">pass the quiz</a>
             </div>

</div>

            <div style="position: relative">
                <div style="position: absolute;z-index:5;bottom:0;right:0;">





                    </Div>

    </div>


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
                              </div>


                </div>
             </div>


      </div>

      </div>

  </div>
  @endforeach
{{--
<div class="col-lg-6"></div>
@foreach ($quizs as $quiz)
<div class="card" style="flex-direction: column;display: table-cell;" >
    <div class="card-body" style="background-color:; ">
                <div class="quizitem">     <a href="{{route('student.pass',[$quiz,$data2[$i]])}}"><img src="{{url($quiz->image)}}" alt=""
            class="quizimage" style="width: 100px; height:100px"></a>
                </div>
        <div>        <h1 class="quiztitle">{{$quiz->title}} points {{$quiz->totalPoint()}} </h1>
            <h5>{!!$quiz->description!!}</h5> <a class="btn btn-danger" href="{{route('myresult',$quiz)}}">result</a>
            <a class="btn btn-success" href="{{route('student.pass',[$quiz,$data2[$i]])}}" style="float: right">pass the quiz</a>

        </div>

    </div>
  </div>

@php
    $i++;
@endphp
@endforeach --}}
@endsection
