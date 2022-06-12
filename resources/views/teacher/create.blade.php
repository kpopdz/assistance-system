
@extends('layouts.teacher')

@section('content')
<style>
            .bootstrap-tagsinput .tag {
            margin-right: 2px;
            color: #ffffff;
            background: #2196f3;
            padding: 3px 7px;
            border-radius: 3px;
        }
        .bootstrap-tagsinput {
            width: 100%;
        }
</style>
<div class="col-lg-8 m-auto ">

    <div class="card">
      <div class="card-body">
        <h5 class="card-title text-center">Create a new quiz</h5>

        <!-- General Form Elements -->
        <form action="{{route('quizs.store')}}" class="form" method="POST" enctype="multipart/form-data">
        @csrf
          <div class="row mb-3">
            <label for="title" class="col-sm-3 col-form-label">Give the quiz a name <span style="color:red">*</span></label>
            <div class="col-sm-9">
              <input type="text"name="title" id="username" class="form-control">
            </div>
          </div>
          <div class="row mb-3">
            <label for="tags" class="col-sm-3 col-form-label">Select appropriate tags</label>
            <div class="col-sm-9">
              <input type="text"data-role="tagsinput" name="tags" class="form-control tags">
            </div>
          </div>






          <div class="row mb-3">
            <label for="inputPassword" class="col-sm-3 col-form-label">Include a summary : </label>
            <div class="col-sm-9">
              <textarea class="form-control" name="description" id="position" style="width: 300px;"></textarea>
            </div>
          </div>



          <div class="row mb-3  text-center">
            <div class="col-sm-12">
              <button type="submit" class="btn btn-primary ">Next</button>
              <a href="{{route('quizs.index')}}" class="btn btn-danger ">cancel</a>

            </div>
          </div>

        </form><!-- End General Form Elements -->

      </div>
    </div>

  </div>

  <script>
    ClassicEditor
        .create( document.querySelector( '#position' ) )
        .catch( error => {
            console.error( error );
        } );


</script>

<script>const prevBtns = document.querySelectorAll(".btn-prev");
    const nextBtns = document.querySelectorAll(".btn-next");
    const progress = document.getElementById("progress");
    const formSteps = document.querySelectorAll(".form-step");
    const progressSteps = document.querySelectorAll(".progress-step");

    let formStepsNum = 0;

    nextBtns.forEach((btn) => {
      btn.addEventListener("click", () => {
        formStepsNum++;
        updateFormSteps();
        updateProgressbar();
      });
    });

    prevBtns.forEach((btn) => {
      btn.addEventListener("click", () => {
        formStepsNum--;
        updateFormSteps();
        updateProgressbar();
      });
    });

    function updateFormSteps() {
      formSteps.forEach((formStep) => {
        formStep.classList.contains("form-step-active") &&
          formStep.classList.remove("form-step-active");
      });

      formSteps[formStepsNum].classList.add("form-step-active");
    }

    function updateProgressbar() {
      progressSteps.forEach((progressStep, idx) => {
        if (idx < formStepsNum + 1) {
          progressStep.classList.add("progress-step-active");
        } else {
          progressStep.classList.remove("progress-step-active");
        }
      });

      const progressActive = document.querySelectorAll(".progress-step-active");

      progress.style.width =
        ((progressActive.length - 1) / (progressSteps.length - 1)) * 100 + "%";
    }</script>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.js"></script>
@endsection

