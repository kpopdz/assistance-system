@extends('layouts.teacher')

@section('content')
<div class="col-12">
    <div class="card">

      <div class="filter">
        <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
          <li class="dropdown-header text-start">
            <h6>Filter</h6>
          </li>

          <li><a class="dropdown-item" href="#">Today</a></li>
          <li><a class="dropdown-item" href="#">This Month</a></li>
          <li><a class="dropdown-item" href="#">This Year</a></li>
        </ul>
      </div>

      <div class="card-body">
        <h5 class="card-title">Reports <span>/{{$arrray['module']}}</span></h5>
        <div class="d-flex justify-content-end">
            <div class="col-2">        <a href="{{route('radar.student',$student)}}" class="btn btn-primary"> radar stat</a>
            </div>
        </div>
        <form action="{{route('student.state.show',$student)}}
        " method="get">

        <div class="row">
            <div class=" col-2">  <select name="module"  id="country" class="form-control ">
                <option value="">Select the module</option>
                <option value="math">math</option>
                <option value="arabic">arabic</option>
                <option value="french">french</option>


            </select></div>

            <div class="col-md-2">         <input type="submit" class="btn btn-success" value="choose">
            </div>        </div>

        </form>
        <!-- Line Chart -->
        <div id="reportsChart"></div>

        <script>
                let module = {!! json_encode($arrray['module']) !!};
                if (module==null) {
                    module="math";
                }
          document.addEventListener("DOMContentLoaded", () => {
            new ApexCharts(document.querySelector("#reportsChart"), {
              series: [{
                name:

                module
                ,
                data: [
                    @php

              foreach($are as $result) {
                  echo "'".($result )."',";
              }
            @endphp
                ],
            //   }, {
            //     name: 'Revenue',
            //     data: [11, 32, 45, 32, 34, 52, 41]
            //   }, {
            //     name: 'Customers',
            //     data: [15, 11, 32, 18, 9, 24, 11]
               }
            ],
              chart: {
                height: 350,
                type: 'area',
                toolbar: {
                  show: false
                },
              },
              markers: {
                size: 4
              },
              colors: [
                '#4154f1',
                 '#2eca6a',
                  '#ff771d'],
              fill: {
                type: "gradient",
                gradient: {
                  shadeIntensity: 1,
                  opacityFrom: 0.3,
                  opacityTo: 0.4,
                  stops: [0, 90, 100]
                }
              },
              dataLabels: {
                enabled: false
              },
              stroke: {
                curve: 'smooth',
                width: 2
              },
              xaxis: {
                type: 'datetime',
                categories: [
                    @php
              foreach($results as $result) {
                  echo "'".($result->quiz->created_at )."',";
              }
            @endphp                ]
              },
              tooltip: {
                x: {
                  format: 'dd/MM/yy HH:mm'
                },
              }
            }).render();
          });
        </script>
        <!-- End Line Chart -->

      </div>

    </div>
  </div><!-- End Reports -->


@endsection
