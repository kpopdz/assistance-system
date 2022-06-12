@extends('layouts.teacher')
@section('content')
<div class="col-lg-6">
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
              foreach($quiz->result as $result) {
                  echo "'".$result->user->name."',";
              }
            @endphp

                ],
                datasets: [{
                  label: 'Quiz Chart ',
                  data: [  @php
              foreach($quiz->result as $result) {
                  echo "'".$result->fullpoint."',";
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
