@extends('layouts.app')

@section('content')
<style>:root {
    --primary-color: rgb(11, 78, 179);
  }

  *,
  *::before,
  *::after {
    box-sizing: border-box;
  }


  /* Global Stylings */
  label {
    display: block;
    margin-bottom: 0.5rem;
  }

  input {
    display: block;
    width: 100%;
    padding: 0.75rem;
    border: 1px solid #ccc;
    border-radius: 0.25rem;
  }
  textarea{
    display: block;
    width: 100%;
    padding: 0.75rem;
    border: 1px solid #ccc;
    border-radius: 0.25rem;
  }
  select{
    display: block;
    width: 100%;
    padding: 0.75rem;
    border: 1px solid #ccc;
    border-radius: 0.25rem;
  }


  .width-50 {
    width: 50%;
  }

  .ml-auto {
    margin-left: auto;
  }

  .text-center {
    text-align: center;
  }

  /* Progressbar */
  .progressbar {
    position: relative;
    display: flex;
    justify-content: space-between;
    counter-reset: step;
    margin: 2rem 0 4rem;
  }

  .progressbar::before,
  .progress {
    content: "";
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    height: 4px;
    width: 100%;
    background-color: #dcdcdc;
    z-index: -1;
  }

  .progress {
    background-color: var(--primary-color);
    width: 0%;
    transition: 0.3s;
  }

  .progress-step {
    width: 2.1875rem;
    height: 2.1875rem;
    background-color: #dcdcdc;
    border-radius: 50%;
    display: flex;
    justify-content: center;
    align-items: center;
  }

  .progress-step::before {
    counter-increment: step;
    content: counter(step);
  }

  .progress-step::after {
    content: attr(data-title);
    position: absolute;
    top: calc(100% + 0.5rem);
    font-size: 0.85rem;
    color: #666;
  }

  .progress-step-active {
    background-color: var(--primary-color);
    color: #f3f3f3;
  }

  /* Form */
  .form {
    width: clamp(320px, 30%, 430px);
    margin: 0 auto;
    border: 1px solid #ccc;
    border-radius: 0.35rem;
    padding: 1.5rem;
  }

  .form-step {
    display: none;
    transform-origin: top;
    animation: animate 0.5s;
  }

  .form-step-active {
    display: block;
  }

  .input-group {
    margin: 2rem 0;
  }

  @keyframes animate {
    from {
      transform: scale(1, 0);
      opacity: 0;
    }
    to {
      transform: scale(1, 1);
      opacity: 1;
    }
  }

  /* Button */
  .btns-group {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 1.5rem;
  }

  .btn {
    padding: 0.75rem;
    display: block;
    text-decoration: none;
    background-color: var(--primary-color);
    color: #f3f3f3;
    text-align: center;
    border-radius: 0.25rem;
    cursor: pointer;
    transition: 0.3s;
  }
  .btn:hover {
    box-shadow: 0 0 0 2px #fff, 0 0 0 3px var(--primary-color);
  }</style>
<form action="{{route('quizs.update',$quiz->id)}}" class="form" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
        <h1 class="text-center">Create quiz</h1>
    <!-- Progress bar -->
    <div class="progressbar">
      <div class="progress" id="progress"></div>

      <div
        class="progress-step progress-step-active"
        data-title="quiz"
      ></div>
      <div class="progress-step" data-title="visibility"></div>
      <div class="progress-step" data-title="more info"></div>
    </div>

    <!-- Steps -->
    <div class="form-step form-step-active">
      <div class="input-group">
        <label for="title">title</label>

        <input type="text" name="title" id="" value="{{$quiz->title}}"/>
      </div>
      <div class="input-group">
        <label for="description">description</label>
        <textarea name="description" id="position" >{{$quiz->description}}</textarea>
      </div>

      <div class="btns-group">
        <a href="{{route('quizs.index')}}" class="btn btn-success ">cancel</a>

        <a href="#" class="btn btn-next ">Next</a>

      </div>
    </div>
    <div class="form-step">
      <div class="input-group">
        <label for="visibility">visibility</label>
        <select name="visibility"  aria-label="Default select example">
            <option selected value="{{$quiz->visibiltiy}}"></option>
            <option value="Public">Public</option>
            <option selected value="Private">Private</option>
          </select>
      </div>

      <div class="btns-group">
        <a href="#" class="btn btn-prev">Previous</a>
        <a href="#" class="btn btn-next">Next</a>
        <a href="{{route('quizs.index')}}" class="btn btn-success">cancel</a>

      </div>
    </div>
    <div class="form-step">
      <div class="input-group">
        <label for="image">image</label>
        <input type="file" name="image" id="dob"  />
        <img src="{{url($quiz->image)}}" alt="" width="300px">
      </div>
      <div class="input-group">
        <label for="tags">tags</label>
        <input type="text" data-role="tagsinput" name="tags" class="form-control tags" value="{{$res}}">
    </div>
      <div class="btns-group">
        <input type="submit" class="btn"  name="publish" value="Publish the Quiz">
        <input type="submit" class="btn"  name="save" value="Save as Draft">
        <a href="#" class="btn btn-prev">Previous</a>
        <a href="{{route('quizs.index')}}" class="btn btn-success">cancel</a>
      </div>


    </div>
  </form>
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

@endsection
