@extends('layouts.teacher')

@section('content')
<style>
    .time{
        margin: 0;
    }

    .public{
color: #1fbd22;
background: #2cec2f22;
margin: 0%;
        padding: 0px 4px;

        margin-bottom: .5rem;
        border: #1fbd22;
   border-width: 2px;
   border-style: solid;
   border-radius: 20px;
    }
    .private{
color: #ec1111e7;
background: #ec2c2c13;
margin: 0%;
        padding: 0px 4px;
        border: #ec1111e7;
        vertical-align: middle;
        margin-bottom: .5rem;
        border-width: 2px;
   border-style: solid;
border-radius: 20px;
    }


</style>
@if ($message=Session::get('success'))
<div class="container" style="padding-top: 2%">
<div class="alert alert-primary" role="alert">
{{$message}}</div>
 </div>
 @endif
 @if ($message=Session::get('error'))
<div class="container" style="padding-top: 2%">
<div class="alert alert-danger" role="alert">
{{$message}}</div>
 </div>
 @endif
<div class="row justify-content-center">
    <div class="search-flex col-xl-9 d-flex justify-content-between">
        <div class="d-flex">
            <form action="{{route('quizs.index')}}" method="get" class="d-flex justify-content-between">
                <div class="position-relative col-12">
                    <input type="search" name="query" id="query" placeholder="search " class="quiz-search ms-1">
                    <button class="button-search position-absolute end-0 top-0"><i class="bi bi-search"></i></button>

                </div>


                <div class="col-4 ms-1">                </div>

                  <div class="col-3 ms-1">              </div>



            </form>
        </div>
    <div><a href="{{route('quiz.recent')}}" class="btn btn-outline-primary" >most recent</a></div>



    </div>

    @foreach ($quizs as $item)

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
                            <!-- Disabled Backdrop Modal -->
                        {{-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#disablebackdrop5">
                          assign
                        </button> --}}
                        <div class="modal fade" id="disablebackdrop5" tabindex="-1" data-bs-backdrop="false">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title">add quiz to new collection</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <div class="modal-body">
                                <form action="{{route('collection.new.quiz')}}" method="post">
                                    @csrf
                                    @method('POST')
                                    <form class="row g-3">
                                        <div class="col-md-12">
                                          <div class="form-floating">
                                              <input type="hidden" name="quiz_id" value="{{$item->id}}">
                                            <input type="text" class="form-control" id="floatingName" name="collection_name" placeholder="Your Name">
                                            <label for="floatingName">Collection name</label>
                                          </div>
                                        </div>

                            </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button  type="submit" class="btn btn-primary">Save changes</button>
                              </div>
                            </form>

                            </div>
                          </div>
                        </div><!-- End Disabled Backdrop Modal-->
    <div class="modal fade" id="verticalycentered" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Delete the Quiz "{{$item->title}}"</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                do you want delete The quiz with title "{{$item->title}}"          </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <form action="{{ route('quizs.destroy',$item->id)}}" method="POST">
                @csrf
                   @method('DELETE')
                                 <button type="submit" class="btn btn-danger"> DELETE </button>
                 </form>
            </div>
          </div>
        </div>
      </div>
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
              <h6 style=" flex-shrink: 0;color:#747474;">QUIZ</h6>
              @if ($item->publish==0)
              <span class="private">draft</span>



              @endif            </div>
        <div>
        <h2 style=" flex-shrink: 0;">{{$item->title}}</h2>
        <div class="social-links mt-2" style=" flex-shrink: 0;">
            <a href="#" class="twitter"><i class="bi bi-list-ul"></i> </a>
            <span>{{$item->question->count()}} Questions</span>


            <a href="#" class="instagram"><i class="bi bi-play"></i></a>
            <span>{{$item->userpassesquiz()}}</span>

            <a href="#" class="linkedin"><i class="bi bi-heart"></i></a>
            <span>0</span>

            </div>
         </div>

            <div>
                     <img src="{{url('icons/unnamed.png')}}" alt="" class="user-icon"> <span class="user-name">{{$item->name}}</span>
            </div>
            <div style="position: relative">
                <div style="position: absolute;z-index:5;bottom:0;right:0;">



                    <a style="border: 1px solid #0000004e; border-radius: 10px;" href="{{route('addtofav',$item)}}" class="text-black p-1 mx-1" >

                        <i class="bi {{$item->isFavorate($favorite->id)==true ? 'bi-heart-fill' : 'bi-heart'}} " style="{{$item->isFavorate($favorite->id)==true ? 'color:red;' : ''}}?"></i>
                        <span class="button-info">Like</span>


                    </a>
                </form>

                    </Div>

                    </div>

                    @if ($item->publish==1)
                    <div class="position-absolute  top-0 end-0 d-flex">
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

                       <div class="me-2 dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                             add to collection
                            </button>
                            <ul class="dropdown-menu " aria-labelledby="dropdownMenuButton1">
                                <li><a class="dropdown-item border-bottom" href="#" data-bs-toggle="modal" data-bs-target="#disablebackdrop5">new collection</a></li>
                                @php
                                    $collections=Auth::user()->collections;
                                @endphp
@foreach (  $collections as $coll)


                              <li>
                                  <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#disablebackdrop">{{$coll->name}}</button>

                            </li>
                            @endforeach
                            </ul>
                          </div>
                              </div>
                    @endif


                </div>
             </div>


      </div>

      </div>

  </div>
  @endforeach


  <h5>Pagination:</h5>
</div>

{{-- <div class="container" style="padding-top: 2%"> --}}
    <!--<ul class="nav nav-pills container" id="pills-tab" role="tablist">
    <li class="nav-item" role="presentation">
      <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">quizs</button>
    </li>
    <li class="nav-item" role="presentation">
      <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Profile</button>
    </li>
    <li class="nav-item" role="presentation">
      <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Contact</button>
    </li>-->

  {{-- <div class="tab-content" id="pills-tabContent">
  <!-- <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">...</div>
    <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">...</div>
    <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">...</div>-->
  </div>
    </div>
  <div class="container" style="padding-top: 2% ">
      <a class="btn btn-secondary" href="{{ url('teacher/stepform')}}" style="">create</a>

         @if ($message=Session::get('success'))
        <div class="container" style="padding-top: 2%">
        <div class="alert alert-primary" role="alert">
        {{$message}}</div>
         </div>
         @endif

         </div>

    <div class="container" style="padding-top: 2%">

        @foreach ($quizs as $item)
        <div class="f">
            <div class="b">

                <div class="question">
                    <div class="image">
                        <a href=" {{ route('quizs.show',$item->id)}}">

                        @if ($item->image==null)
                        <img src="{{ url('icons/logo_placeholder_sm.png')}}" alt="" class="quiz-picture">
                        @else
                        <img src="{{url($item->image)}}" alt="" class="quiz-picture">
                        @endif
                    </a></div>
                    <div class="info"> <div class="quiz-first"><span class="quiz-type">QUIZ </span></div>
                     <div class="second"><span class="title-quiz">{{$item->title}}</span >



                        </div>
                    <div class="third">
                        <div class="listoficons">
                            <span class="quiz-icons">
                                           <img src="{{ url('icons/format_list_bulleted_FILL0_wght400_GRAD0_opsz48.svg')}}" alt=""class="icons-size">
                                </span> <span class="icon-info">{{$item->question->count()}} Questions</span>


                        </div>
                        <div class="listoficons">
                            <span class="quiz-icons">
                                           <img src="{{ url('icons/school_FILL0_wght400_GRAD0_opsz48.svg')}}" alt=""class="icons-size">
                                </span> <span class="icon-info">{{$item->userpassesquiz()}}</span>

                        </div>            <div class="listoficons">
                            <span class="quiz-icons">
                                           <img src="{{ url('/icons/format_list_bulleted_FILL0_wght400_GRAD0_opsz48.svg')}}" alt=""class="icons-size">
                                </span> <span class="icon-info">Questions</span>

                        </div>
                    </div>
                <div class="quiz-user">
                    <div  class="fourd" style="vertical-align: bottom; text-align: left;">
            <img src="{{url('icons/unnamed.png')}}" alt="" class="user-icon"> <span class="user-name">kpopdz</span>

                    </div>
                    <div  class="fourd" style="vertical-align: bottom; text-align: right;">
                        <div class="user-name-part" ><img style="border: 1px solid #000000; border-radius: 1px;" src="{{url('icons/delete_FILL0_wght400_GRAD0_opsz48.svg')}}" alt="" class="icons-size"></div>

                                </div>
            </div>

                </div>

                </div>
                </div>

            </div>


            @endforeach
        <table class="table" >
        <thead class="table-dark">
        <tr>

            <th scope="col">id</th>
            <th scope="col">title</th>
            <th scope="col">visibilty</th>
            <th scope="col">number of question</th>
            <th scope="col">publish</th>

            <th scope="col">tags</th>
            <th scope="col">created at</th>

            <th scope="col" style="width: 400px">action</th>


        </tr>
        </thead>
        @foreach ($quizs as $item)

         <tbody><tr>
        <th scope="row" ><input type="radio" name="ids[]" id="" value="{{$item->id}}">
            </th>
        <td >{{$item->title}}</td>
        <td >
            @if ($item->visibility=='Private')
            <span class="private">{{$item->visibility}}</span>

            @else
            <span class="public">{{$item->visibility}}</span>

            @endif



        </td>
        <td>{{$item->question->count()}}</td>

        <td>

            @if ($item->publish==0)
            <span class="private">draft</span>

            @else
            <span class="public">publish</span>

            @endif
        <td>
                <div class="post-tags mb-4">


                    @foreach($item->tags as $tag)

                             <span class="badge badge-info">{{$tag->name}}</span>

                     @endforeach

                </div>
        </td>
        <td ><div class="time"><span>{{Carbon\Carbon::parse($item->created_at)->diffForHumans()}}</span></div></td>
        <td>
            <div class="row">
            @if (Auth::User()->id==$item->user_id)
            <div class="col-sm">
                <a class="btn btn-success" href="{{ route('quizs.edit',$item->id)}}">edit</a>
            </div>
            <div class="col-sm">
                <a class="btn btn-primary" href="{{ route('quizs.show',$item->id)}}">show</a>
            </div>
            <div class="col-sm">
                <form action="{{ route('quizs.destroy',$item->id)}}" method="POST">
            @csrf
                @method('DELETE')
                                <button type="submit" class="btn btn-danger"> DELETE </button>
                </form>
            </div>
            @else
            <div class="col-sm">
            <h5>can't edit</h5>
            </div>
            <div class="col-sm">
                <a class="btn btn-primary" href="{{ route('quizs.show',$item->id)}}">show</a>
            </div>
            <div class="col-sm">
                <h5>can't deleted</h5>

            </div>


            @endif





                                </div>
                                </td>
                </tr>

                </tbody>
                @endforeach

            </table>
            <div class="d-flex justify-content-center">

            </div></div>
            <div class="row">
                <div class="col-lg-6">
                <div class="card">
                        <div class="card-body">
                        <h5 class="card-title">Floating labels Form</h5>

              <!-- Floating Labels Form -->
              <form class="row g-3">
                <div class="col-md-12">
                  <div class="form-floating">
                    <input type="text" class="form-control" id="floatingName" placeholder="Your Name">
                    <label for="floatingName">Your Name</label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-floating">
                    <input type="email" class="form-control" id="floatingEmail" placeholder="Your Email">
                    <label for="floatingEmail">Your Email</label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-floating">
                    <input type="password" class="form-control" id="floatingPassword" placeholder="Password">
                    <label for="floatingPassword">Password</label>
                  </div>
                </div>
                <div class="col-12">
                  <div class="form-floating">
                    <textarea class="form-control" placeholder="Address" id="floatingTextarea" style="height: 100px;"></textarea>
                    <label for="floatingTextarea">Address</label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="col-md-12">
                    <div class="form-floating">
                      <input type="text" class="form-control" id="floatingCity" placeholder="City">
                      <label for="floatingCity">City</label>
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-floating mb-3">
                    <select class="form-select" id="floatingSelect" aria-label="State">
                      <option selected>New York</option>
                      <option value="1">Oregon</option>
                      <option value="2">DC</option>
                    </select>
                    <label for="floatingSelect">State</label>
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-floating">
                    <input type="text" class="form-control" id="floatingZip" placeholder="Zip">
                    <label for="floatingZip">Zip</label>
                  </div>
                </div>
                <div class="text-center">
                  <button type="submit" class="btn btn-primary">Submit</button>
                  <button type="reset" class="btn btn-secondary">Reset</button>
                </div>
              </form><!-- End floating Labels Form -->

            </div>
          </div>

        </div>
      </div> --}}


      <script>
        var colors = ['#8854c0', '#00c985', '#ef3c69'];
        const roundeds = document.querySelectorAll(".q");
        change();
    function change() {
    let i=0;

    roundeds.forEach((function (rounded) {
    if (i>2) {
    i=0;
    }
      var random_color = colors[i];
    rounded.style.backgroundColor = random_color;
    i++;
    }))
    }

    </script>
@endsection
