@extends('layouts.teacher')

@section('content')
<div class="col-lg-6">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">statistics of modules</h5>

        <!-- Radar Chart -->
        <canvas id="radarChart" style="max-height: 400px;"></canvas>
        <script>
            module = {!! json_encode($module) !!};
          document.addEventListener("DOMContentLoaded", () => {
            new Chart(document.querySelector('#radarChart'), {
              type: 'radar',
              data: {
                labels: [
                    @php
                    foreach($module as $mod) {
    echo "'".($mod )."',";
}


@endphp
                ],
                datasets: [{
                  label: 'modules',
                  data: [ @php

foreach($results as $result) {
    echo "'".($result*20 )."',";
}



@endphp],
                  fill: true,
                  backgroundColor: 'rgba(255, 99, 132, 0.2)',
                  borderColor: 'rgb(255, 99, 132)',
                  pointBackgroundColor: 'rgb(255, 99, 132)',
                  pointBorderColor: '#fff',
                  pointHoverBackgroundColor: '#fff',
                  pointHoverBorderColor: 'rgb(255, 99, 132)'
                }, ]
              },
              options: {
                elements: {
                  line: {
                    borderWidth: 3
                  }
                }
              }
            });
          });
        </script>
        <!-- End Radar CHart -->

      </div>
    </div>
  </div>
@endsection
