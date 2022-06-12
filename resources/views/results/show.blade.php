@extends('layouts.teacher')

@section('content')

<style>
    .border-right-answer{
        border: 1px solid blueviolet;
        background: antiquewhite;
    }
    .border-wrong{
        border: 1px solid red;
    }
</style>
    <div class="d-flex " id="wrapper">
        <div class="container">
            @if($result)
            <div class="m-sm-auto col-lg-8">
                <div class="col mb-3">
                    <div class="card">
                      <img style="" src="{{ url('icons/aqua-d9b59c89.png')}}" alt="Cover" class="card-img-top size-back-image">
                      <div class="card-body text-center">
                        <img src="{{ url('icons/person.svg')}}" style="width:100px;margin-top:-65px" alt="User" class="img-fluid img-thumbnail rounded-circle border-0 mb-3">
                        <h5 class="card-title">{{$result->class_name}} {{$result->user->student->firstname}} {{$result->user->student->lastname}}</h5>
                        <p class="text-secondary mb-1">{{$result->class_name}}</p>
                        <h5>points earned from quiz is : {{$result->fullpoint}}</h5>

                        <div class="progress mt-3 " style="height: 20px;">
                            <div class="progress-bar
                             {{(($result->fullpoint)/($result->quiz->totalPoint())*100) <50 ? 'progress-bar-striped bg-danger' : 'progress-bar-striped bg-success'}} " role="progressbar"
                             style="width: {{($result->fullpoint)/($result->quiz->totalPoint())*100}}%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">{{($result->fullpoint)/($result->quiz->totalPoint())*100}}%</div>
                          </div>            </div>
                      <div class="card-footer">

                <div class="card">
                  <div class="card-body">
                    <h5 class="card-title">the answers</h5>

                    <!-- Doughnut Chart -->
                    <canvas id="doughnutChart" style="max-height: 400px; display: block; box-sizing: border-box; height: 400px; width: 527.2px;" width="659" height="500"></canvas>
                    <script>
                      document.addEventListener("DOMContentLoaded", () => {
                        new Chart(document.querySelector('#doughnutChart'), {
                          type: 'doughnut',
                          data: {
                            labels: [
                              'wrong answer',
                              'right answer',
                              'Incomplete answers'
                            ],
                            datasets: [{
                              label: 'My First Dataset',
                              data: [{{$result->wronganswer+$result->quiz->question->count() - $result->questions_count}}, {{($result->rightanswer)}}, {{($result->halfanswer)}}],

                              backgroundColor: [
                                'rgb(255, 99, 132)',
                                '#4bc0c0',
                                'rgb(255, 205, 86)'
                              ],
                              hoverOffset: 4
                            }]
                          }
                        });
                      });
                    </script>
                    <!-- End Doughnut CHart -->

                  </div>
                </div>
              </div>
              @php
    $i=1;
@endphp
 <div class="col-lg-10  m-sm-auto">           @foreach ($result->quiz->question as $item)

<div class="row bg-white rounded-2 shadow mb-5" style="border: 1px solid black;">

    <div class="d-flex justify-content-between px-2 py-2 mb-2 bg-header-question align-items-center">
        <div > question {{$i}}</div>
        <div class="d-flex ">


    {{-- delet question --}}

    {{-- ///////// --}}

    </div>
    </div>
    <div class="d-flex align-items-center">


        <div> {{$item->question_content}}</div>

    </div>
    <div class="relative bg-light-1 mb-2" >
   <h1 class="new-middle-line ">
        answer choices
      </h1> </div>
      <div class="d-flex flex-wrap m-2">
          @php
              $temp=0;
              $t=0;
              $array=[];
          @endphp
                          @foreach($result->options as $user_option)
                          @php
                              $array[$t]=$user_option->option_id;
          $t++;
                          @endphp
                          @endforeach
          @foreach ($item->option as $option)

         <div class="w-50 {{ in_array($option->id, $array) ==  true ? 'border-right-answer' : ''  }}"><i class="bi bi-circle-fill me-1 {{ $option->iscorrect ==  1 ? 'answer-right' : 'answer-wrong'  }} "></i>{{$option->option_CONTENT}}</div>
          @php
          $temp=0;
            @endphp
          @endforeach

      </div>
</div>
@php
    $i++;
@endphp
@endforeach


    </div>

                @else
                <h1>No Result</h1>
            @endif
        </div>
    </div>
@endsection


