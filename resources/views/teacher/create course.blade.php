@extends('layouts.teacher')

@section('content')

<div class="row">
    <div class="col-lg-8">

      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Course one</h5>


          <!-- Default Accordion -->
          <div class="accordion" id="accordionExample">
            <div class="accordion-item">
              <h2 class="accordion-header" id="headingOne">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                  PDF
                </button>
              </h2>
              <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample" style="">
                <div class="accordion-body">
                    <embed src="{{url($course->file_pdf)}}" width="600" height="500" alt="pdf" />
                        </div>
              </div>
            </div>
            <div class="accordion-item">
              <h2 class="accordion-header" id="headingTwo">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                  Video

                </button>
              </h2>
              <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <video width="400" controls>
                        <source src="{{url($course->file_video)}}" type="video/mp4">
                        <source src="{{url($course->file_video)}}" type="video/ogg">
                      </video>
            </div>
              </div>
            </div>
            <div class="accordion-item">
              <h2 class="accordion-header" id="headingThree">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                  Quiz
                </button>
              </h2>
              <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                <div class="accordion-body">
@foreach ($course->quizs as $quiz)
<div class="row"><a href="{{route('quizs.show',$quiz->id)}}">{{$quiz->title}}</a></div>
@endforeach                </div>
              </div>
            </div>
          </div><!-- End Default Accordion Example -->

        </div>
      </div>

    </div>


  </div>


@endsection
