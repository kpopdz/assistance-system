 @extends('layouts.teacher')


@section('content')
<div class="row">

    <!-- Left side columns -->
    <div class="col-lg-7">
      <div class="row">

<div class="card">
            <div class="card-body">
              <h5 class="card-title">Course <span>| {{$course->name}}</span></h5>

              <embed src="{{url($course->file_pdf)}}" width="600" height="500" alt="pdf" />
            </div>

        </div>



        <div class="col-12">
            <div class="card top-selling overflow-auto">


              <div class="card-body pb-0">
                <h5 class="card-title">quizzes for you </h5>
                    <p>after you read the document and the watch the video you can test your self</p>
                <table class="table table-borderless">
                  <thead>
                    <tr>
                      <th scope="col">Preview</th>
                      <th scope="col">Quiz</th>

                      <th scope="col">Play</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($course->quizs as $quiz)
                    <tr>
                        <th scope="row">
                            @if ($quiz->image==null)
                            <img id="quiz_image_color" src="{{ url('icons/logo_placeholder_sm.png')}}" alt="Profile"  style="width: 60px">
                            @else
                            <img src="{{url($quiz->image)}}" alt="" style="width:60px ">
                            @endif</th>
                        <td><p class="text-primary fw-bold">{{$quiz->title}}</p></td>

                        <td><a href="{{route('student.pass.course',$quiz)}}" style="color: green;font-size: 33px;"><i class="bi bi-play-circle-fill"></i></a></td>
                      </tr>
                    @endforeach


                  </tbody>
                </table>

              </div>

            </div>
          </div>

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">

                            <hr />
                            <h4>Display Comments</h4>

                            <hr />
                            @include('student.commentsDisplay', ['comments' => $course->comments, 'course_id' => $course->id])

                            <h4>Add comment</h4>
                            <form method="post" action="{{ route('comments.store') }}">
                                @csrf
                                <div class="form-group">
                                    <textarea class="form-control mb-3" name="body"></textarea>
                                    <input type="hidden" name="course_id" value="{{ $course->id }}" />
                                </div>
                                <div class="form-group">
                                    <input type="submit" class="btn btn-primary mb-3" value="Add Comment" />
                                </div>
                            </form>
                        </div>

            </div>
        </div>
      </div>
    </div><!-- End Left side columns -->

    <!-- Right side columns -->
    <div class="col-lg-5">

      <!-- Recent Activity -->
      <div class="card">


        <div class="card-body">
          <h5 class="card-title">Video</h5>
          <div class="d-flex justify-content-center">
            <div class="mx-sm-auto"> <video width="400" controls>
                <source src="{{url($course->file_video)}}" type="video/mp4">
                <source src="{{url($course->file_video)}}" type="video/ogg">
              </video></div>
          </div>



        </div>

      </div><!-- End Recent Activity -->

      <!-- Budget Report -->

    </div><!-- End Right side columns -->

  </div>
@endsection
