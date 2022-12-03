@extends('layouts.teacher')
@section('content')
<div class="col-lg-6">
    <div class="card">
        <div class="card-body">
          <h5 class="card-title">Table avrage of student points in quizzes</h5>

          <!-- Default Table -->
          <table class="table">
            <thead>
              <tr>
                <th scope="col">title</th>
                <th scope="col">Avg>75</th>
                <th scope="col">Avg between 75-50</th>
                <th scope="col">Avg <50 </th>
                <th scope="col">%</th>
              </tr>
            </thead>
            <tbody>
                @foreach($quizs as $quiz)
                {{-- {{$quiz->result()->avg('fullpoint')}}
    {{            $quiz->totalpoint()
    }} --}}

    <tr>
        <th scope="row">                {{$quiz->title}}
        </th>
        @if (($quiz->result()->avg('fullpoint')>(($quiz->totalPoint())*0.75)))
        <td><i class="bi bi-check-circle-fill" style="color: green"></i></td>
        <td></td>
        <td></td>
        <td>{{round((($quiz->result()->avg('fullpoint') )/($quiz->totalpoint()))*100)}}</td>
        @else
        @if (($quiz->result()->avg('fullpoint')<(($quiz->totalPoint())*0.75)) && ($quiz->result()->avg('fullpoint')>(($quiz->totalPoint())*0.5)))

        <td></td>
        <td><i class="bi bi-check-circle-fill" style="color: #dbdb31"></i></td>
        <td></td>
        <td>{{round((($quiz->result()->avg('fullpoint') )/($quiz->totalpoint()))*100)}}</td>
        @else
        <td></td>
        <td></td>
        <td><i class="bi bi-check-circle-fill" style="color: red"></i></td>
        <td>{{(round((($quiz->result()->avg('fullpoint') )/($quiz->totalpoint()))*100))}}</td>
        @endif

        @endif

      </tr>
            @endforeach


            </tbody>
          </table>
          <!-- End Default Table Example -->
        </div>
      </div>
    <div class="card">
      <div class="card-body">

        <h5 class="card-title">Quiz Chart</h5>
        {{-- @php
        $i=0;

      @endphp                    @foreach ($quiz->result as $result )
      @if ($i>0)
      {{ $result->user->name }}'}
      @else
      ,{'{{ $result->user->name }}'}
      @endif
      @php
          $i++;
      @endphp
      @endforeach --}}
        <!-- Bar Chart -->
        <canvas id="barChart" style="max-height: 400px;"></canvas>

        <script>

          document.addEventListener("DOMContentLoaded", () => {
            new Chart(document.querySelector('#barChart'), {
              type: 'bar',
              data: {
                labels: [
                    @php
              foreach($quizs as $quiz) {
                  echo "'".$quiz->title."',";
              }
            @endphp

                ],
                datasets: [{
                  label: 'Quiz Chart ',
                  data: [  @php
              foreach($quizs as $quiz) {
                  echo "'".((($quiz->result()->avg('fullpoint') )/($quiz->totalpoint()))*100)."',";
              }
            @endphp
],
                  backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(255, 159, 64, 0.2)',
                    'rgba(255, 205, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(201, 203, 207, 0.2)'
                  ],
                  borderColor: [
                    'rgb(255, 99, 132)',
                    'rgb(255, 159, 64)',
                    'rgb(255, 205, 86)',
                    'rgb(75, 192, 192)',
                    'rgb(54, 162, 235)',
                    'rgb(153, 102, 255)',
                    'rgb(201, 203, 207)'
                  ],
                  borderWidth: 1
                }]
              },
              options: {
                scales: {
                  y: {
                    beginAtZero: true
                  }
                }
              }
            });
          });
        </script>
        <!-- End Bar CHart -->

      </div>
    </div>
  </div>

@endsection
