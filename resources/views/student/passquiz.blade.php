@extends("layouts.teacher")
<style>
.base-timer {
  position: relative;
  width: 300px;
  height: 300px;
}

.base-timer__svg {
  transform: scaleX(-1);
}

.base-timer__circle {
  fill: none;
  stroke: none;
}

.base-timer__path-elapsed {
  stroke-width: 7px;
  stroke: grey;
}

.base-timer__path-remaining {
  stroke-width: 7px;
  stroke-linecap: round;
  transform: rotate(90deg);
  transform-origin: center;
  transition: 1s linear all;
  fill-rule: nonzero;
  stroke: currentColor;
}

.base-timer__path-remaining.green {
  color: rgb(65, 184, 131);
}

.base-timer__path-remaining.orange {
  color: orange;
}

.base-timer__path-remaining.red {
  color: red;
}

.base-timer__label {
  position: absolute;
  width: 300px;
  height: 300px;
  top: 0;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 48px;
}
    .quiz{
        display: none;
        background-color: #461a42;
        font-family: 'Inter';

}
.active{
    display: flex;
    flex-direction: column;
    text-align: center;
  border: 3px solid green;
}
.top-quiz{
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100px;
    color: white;
    background-color: #461a42;
}
.middle-quiz{
display: flex;
justify-content: space-between;
height: 100px;
align-items: center;
gap: 12px;
}
.options-element{
    display:flex;
flex: 1;
height: 100%;
align-items: center;
justify-content: center;
color: white;
border-radius: 5px;
font-size: 27px

}
.quiz-bottom{
    height: 100px;
    display: flex;
    justify-content: flex-end;
    align-items: center;
}

</style>
@section('content')
<div>


{{-- <div id="app"></div> --}}


    <p id="demo"></p>
    {{-- <input type="hidden" value="{{$quiz->dead_line}}" id="dead_line">
@if (Carbon\Carbon::now()>($quiz->dead_line))
        this quiz is close right now
    @else --}}
    @php
           $i=1;

    @endphp
    <form action="{{route('student.answer.test')}}" method="post" id="save-quiz">
        @csrf
        @method('POST')
        <input type="hidden" name="quiz_id" value="{{$quiz->id}}">
        @foreach ($quiz->question as $question)


            @if ($i==1)
                 {{-- d-none --}}

                 <div class="quiz active">
                     <div class="top-quiz">
                         <h1>{{$question->question_content}}</h1>
                     </div>
                        <input type="hidden" name="question_id[]" value="{{$question->id}}">
                     <div class="middle-quiz">
                         @foreach ($question->option as $option)
                         <label class="options-element" style="position: relative" for="{{$option->id}}">
                            <div  id="">
                            {{$option->option_CONTENT}}
                            <input type= "checkbox" style="position:absolute;right:10px;top:10px;"
                            name ="option[{{$question->id}}][{{$option->id}}]"
                            id = "{{$option->id}}"
                            value =" {{$option->iscorrect}}">
                            </div>
                            </label>

                         @endforeach
                     </div>

                     <div class="quiz-bottom">
                            <a href="#" class="btn btn-danger"> next</a>
                     </div>

                 </div>
                 @else
                @if ($i<count($quiz->question))
                <div class="quiz ">
                    <div class="top-quiz">
                        <h1>{{$question->question_content}}</h1>
                    </div>
                       <input type="hidden" name="question_id[]" value="{{$question->id}}">
                    <div class="middle-quiz">
                        @foreach ($question->option as $option)
                        <label class="options-element" style="position: relative" for="{{$option->id}}">
                           <div  id="">
                           {{$option->option_CONTENT}}
                           <input type= "checkbox" style="position:absolute;right:10px;top:10px;"
                           name ="option[{{$question->id}}][{{$option->id}}]"
                           id = "{{$option->id}}"
                           value =" {{$option->iscorrect}}">
                           </div>
                           </label>

                        @endforeach
                    </div>

                    <div class="quiz-bottom">
                           <a href="#" class="btn btn-danger"> next</a>
                    </div>


              </div>
            @else
                <div class="quiz ">
                    <div class="top-quiz">
                        <h1>{{$question->question_content}}</h1>
                    </div>
                       <input type="hidden" name="question_id[]" value="{{$question->id}}">
                    <div class="middle-quiz">
                        @foreach ($question->option as $option)
                        <label class="options-element" style="position: relative" for="{{$option->id}}">
                           <div  id="">
                           {{$option->option_CONTENT}}
                           <input type= "checkbox" style="position:absolute;right:10px;top:10px;"
                           name ="option[{{$question->id}}][{{$option->id}}]"
                           id = "{{$option->id}}"
                           value =" {{$option->iscorrect}}">
                           </div>
                           </label>

                        @endforeach
                    </div>

                    <div class="quiz-bottom">

                    </div>


              </div>
            @endif


            @endif

@php
    $i++;
@endphp

        @endforeach
        <input type="submit" value="answer"  style="padding: 10px;margin:10px">
        </div>
        </form>
<script>
    // Set the date we're counting down to
var countDownDate = new Date("{{$data2->dead_line}}").getTime();
let url = "{{ route( 'public.quizs' )}}";
// Update the count down every 1 second
var x = setInterval(function() {

  // Get today's date and time
  var now = new Date().getTime();

  // Find the distance between now and the count down date
  var distance = countDownDate - now;

  // Time calculations for days, hours, minutes and seconds
  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);

  // Output the result in an element with id="demo"
  document.getElementById("demo").innerHTML = days + "d " + hours + "h "
  + minutes + "m " + seconds + "s ";

  // If the count down is over, write some text
  if (distance < 0) {
    clearInterval(x);
    document.getElementById("demo").innerHTML = "EXPIRED";
    // document.location.assign(url);
    document.getElementById("save-quiz").submit();
}
}, 1000);
    // // dead_line=document.getElementById('dead_line').value;
    // // const date1 = new Date(dead_line);
    // // const date2 = new Date();
    // const nextBtns = document.querySelectorAll(".btn-danger");

    // const quizs = document.querySelectorAll(".quiz");
    // let quizNum = 0;

    // nextBtns.forEach((btn) => {
    //   btn.addEventListener("click", () => {
    //     quizNum++;
    //     updateQuestion();
    //   });
    // });
    // function updateQuestion() {
    //     quizs.forEach((quiz) => {
    //         quiz.classList.contains("active") &&
    //       quiz.classList.remove("active");
    //   });
    //   quizs[quizNum].classList.add("active");

    // //   quizs[quizNum].classList.add("d-block");
    // }

//////////////////////////////////////////////////////////////////////////////////

const nextBtns = document.querySelectorAll(".btn-danger");
const formSteps = document.querySelectorAll(".quiz");

let formStepsNum = 0;

nextBtns.forEach((btn) => {
  btn.addEventListener("click", () => {
    formStepsNum++;
    updateFormSteps();
  });
});



function updateFormSteps() {
  formSteps.forEach((formStep) => {
    formStep.classList.contains("active") &&
      formStep.classList.remove("active");
  });

  formSteps[formStepsNum].classList.add("active");
}

// Credit: Mateusz Rybczonec

const FULL_DASH_ARRAY = 283;
const WARNING_THRESHOLD = 10;
const ALERT_THRESHOLD = 5;


const COLOR_CODES = {
  info: {
    color: "green"
  },
  warning: {
    color: "orange",
    threshold: WARNING_THRESHOLD
  },
  alert: {
    color: "red",
    threshold: ALERT_THRESHOLD
  }
};
  // Get today's date and time
  var now = new Date().getTime();

  // Find the distance between now and the count down date
  var distance = countDownDate - now;

  // Time calculations for days, hours, minutes and seconds
  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor(distance/ 1000);
const TIME_LIMIT = seconds;
let timePassed = 0;
let timeLeft = TIME_LIMIT;
let timerInterval = null;
let remainingPathColor = COLOR_CODES.info.color;

document.getElementById("app").innerHTML = `
<div class="base-timer">
  <svg class="base-timer__svg" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
    <g class="base-timer__circle">
      <circle class="base-timer__path-elapsed" cx="50" cy="50" r="45"></circle>
      <path
        id="base-timer-path-remaining"
        stroke-dasharray="283"
        class="base-timer__path-remaining ${remainingPathColor}"
        d="
          M 50, 50
          m -45, 0
          a 45,45 0 1,0 90,0
          a 45,45 0 1,0 -90,0
        "
      ></path>
    </g>
  </svg>
  <span id="base-timer-label" class="base-timer__label">${formatTime(
    timeLeft
  )}</span>
</div>
`;

startTimer();

function onTimesUp() {
  clearInterval(timerInterval);
}

function startTimer() {
  timerInterval = setInterval(() => {
    timePassed = timePassed += 1;
    timeLeft = TIME_LIMIT - timePassed;
    document.getElementById("base-timer-label").innerHTML = formatTime(
      timeLeft
    );
    setCircleDasharray();
    setRemainingPathColor(timeLeft);

    if (timeLeft === 0) {
      onTimesUp();
    }
  }, 1000);
}

function formatTime(time) {
  const minutes = Math.floor(time / 60);
  let seconds = time % 60;

  if (seconds < 10) {
    seconds = `0${seconds}`;
  }

  return `${minutes}:${seconds}`;
}

function setRemainingPathColor(timeLeft) {
  const { alert, warning, info } = COLOR_CODES;
  if (timeLeft <= alert.threshold) {
    document
      .getElementById("base-timer-path-remaining")
      .classList.remove(warning.color);
    document
      .getElementById("base-timer-path-remaining")
      .classList.add(alert.color);
  } else if (timeLeft <= warning.threshold) {
    document
      .getElementById("base-timer-path-remaining")
      .classList.remove(info.color);
    document
      .getElementById("base-timer-path-remaining")
      .classList.add(warning.color);
  }
}

function calculateTimeFraction() {
  const rawTimeFraction = timeLeft / TIME_LIMIT;
  return rawTimeFraction - (1 / TIME_LIMIT) * (1 - rawTimeFraction);
}

function setCircleDasharray() {
  const circleDasharray = `${(
    calculateTimeFraction() * FULL_DASH_ARRAY
  ).toFixed(0)} 283`;
  document
    .getElementById("base-timer-path-remaining")
    .setAttribute("stroke-dasharray", circleDasharray);
}

</script>
<script>
    var colors = ['#2d70ae', '#2d9da6', '#efa929','#d5546d'];
    const roundeds = document.querySelectorAll(".options-element");
    change();
function change() {
let i=0;

roundeds.forEach((function (rounded) {
if (i>3) {
i=0;
}
  var random_color = colors[i];
rounded.style.backgroundColor = random_color;
i++;
}))
}

</script>
@endsection
