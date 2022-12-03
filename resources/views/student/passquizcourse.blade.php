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
       <div class="top-quiz justify-content-end" style="color: greenyellow">
       <span class="me-2">score </span>   <span id="score" class="me-1"> </span>/{{$quiz->question->count()}}

    </div>
    <form action="{{route('student.answer.test')}}" method="post" id="save-quiz">
        @csrf
        @method('POST')
        <input type="hidden" name="quiz_id" value="{{$quiz->id}}">
        <input type="hidden" id="removeopt" name="remove_option" value="{{$remove->count}}">

        <input type="hidden" id="hintcount" name="remove_option" value="{{$hints->count}}">

        @foreach ($quiz->question as $question)


            @if ($i==1)
                 {{-- d-none --}}

                 <div class="quiz active">

                     <div class="top-quiz">
                        {{-- @if (Auth::user()->student->badge->count>=1)
<button class="btn btn-primary " style="position: absolute; top:200px;right:40px" onclick="">
remove option
</button>
@endif --}}

<div class="d-flex"><h1 class=" me-3">{{$question->question_content}}</h1> <span class="d-none show-hint me-3">{{$question->hint}}</span></div>
                     </div>
                        <input type="hidden" name="question_id[]" value="{{$question->id}}" class="question">
                     <div class="middle-quiz question">

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
                     <div class="top-quiz">
                        {{-- @if (Auth::user()->student->badge->count>=1)
<button class="btn btn-primary " style="position: absolute; top:200px;right:40px" onclick="">
remove option
</button>
@endif --}}
<a href="#" class="btn btn-outline-warning me-4 {{$remove->count>0 ? '' : 'd-none' }}  removeoption" onclick="removeoption()"><div class="d-flex align-content-center">
    <i class="ri-delete-back-2-line "></i> <span> remove option</span>
</div>
   </a>
<a href="#" class="btn btn-warning me-4 {{$hints->count>0 ? '' : 'd-none' }}  hint" onclick="showHint()"><i class="ri-lightbulb-flash-line"></i> hint</a>
<a href="#" class="btn btn-light me-4  d-none time" onclick="addtimetimetoquestion()">add time</a>
                     </div>

                 </div>
                 @else
                @if ($i<count($quiz->question))
                <div class="quiz ">

                    <div class="top-quiz">
                        <h1 class="me-3">{{$question->question_content}}</h1><span class="d-none show-hint me-3">{{$question->hint}}</span>
                    </div>

                       <input type="hidden" name="question_id[]" value="{{$question->id}}">
                    <div class="middle-quiz question">
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
                    <div class="top-quiz">
                        {{-- @if (Auth::user()->student->badge->count>=1)
<button class="btn btn-primary " style="position: absolute; top:200px;right:40px" onclick="">
remove option
</button>
@endif --}}
<a href="#" class="btn btn-outline-warning me-4 {{$remove->count>0 ? '' : 'd-none' }} removeoption" onclick="removeoption()"><div class="d-flex align-content-center">
    <i class="ri-delete-back-2-line "></i> <span> remove option</span>
</div>
   </a>
<a href="#" class="btn btn-warning me-4 {{$hints->count>0 ? '' : 'd-none' }}  hint" onclick="showHint()"><i class="ri-lightbulb-flash-line"></i> hint</a>
<a href="#" class="btn btn-light me-4 d-none time" onclick="addtimetimetoquestion()">add time</a>
                     </div>


              </div>
            @else
                <div class="quiz ">
                    <div class="top-quiz">
                        <h1>{{$question->question_content}}</h1><span class="d-none show-hint">{{$question->hint}}</span>
                    </div>
                       <input type="hidden" name="question_id[]" value="{{$question->id}}">
                    <div class="middle-quiz question">
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
                    <div class="top-quiz">
                        {{-- @if (Auth::user()->student->badge->count>=1)
<button class="btn btn-primary " style="position: absolute; top:200px;right:40px" onclick="">
remove option
</button>
@endif --}}
<a href="#"  class="btn btn-outline-warning me-4 d-none removeoption" onclick="removeoption()"><div class="d-flex align-content-center">
    <i class="ri-delete-back-2-line "></i> <span> remove option</span>
</div>
   </a>
<a href="#"  class="btn btn-warning me-4
 {{-- {{$remove->count>0 ? '' : 'd-none' }} --}}'d-none'
  hint" onclick="showHint()"><i class="ri-lightbulb-flash-line"></i>hint</a>
<a  href="#" class="btn btn-light me-4
{{-- {{$hints->count>0 ? '' : 'd-none' }}  --}} 'd-none'
time" onclick="addtimetimetoquestion()"> <i class="ri-map-pin-time-line"></i>add time</a>
                     </div>


              </div>
            @endif


            @endif

@php
    $i++;
@endphp

        @endforeach
        <input class="btn btn-success" type="submit" value="answer"  style="padding: 10px;margin:10px">
        </div>
        </form>
<script>
    // Set the date we're counting down to
    const question=document.querySelectorAll(".question");
let quostionpos=0;


const nextBtns = document.querySelectorAll(".btn-danger");
const formSteps = document.querySelectorAll(".quiz");
const delbutton = document.querySelectorAll(".removeoption");
const hints = document.querySelectorAll(".hint");
const timeadd = document.querySelectorAll(".time");
const score= document.getElementById('score');
score.innerHTML=quostionpos;
const showhintvar= document.querySelectorAll(".show-hint");
let badgeremove = document.getElementById('removeopt');
let badgehint = document.getElementById('hintcount');
let scoresize=document.getElementById('scoresize');
 let pointcount=document.getElementById('pointcount');
var sizepo= {{Auth::user()->student->points->points}} ;
function hintaddinfo() {
    hints.forEach((hint) => {
    hint.classList.contains("d-none") &&
      hint.classList.remove("d-none");
  });
}function showremovebut() {
    delbutton.forEach((hint) => {
    hint.classList.contains("d-none") &&
      hint.classList.remove("d-none");
  });
  badgeremove.value++;
}
function removehintaddinfo() {
     badgehint.value--;
     if (badgehint.value<=0) {
  hints.forEach((hint) => {
    hint.classList.add("d-none")
  });
     }


}
function badgebon() {
    badgeanswer
    if (badgeanswer==5) {
        alert('you win badge remove option');
        showremovebut()
    }else{
        if (badgeanswer==7) {
            alert('you win badge of hint');
            badgehint.value++;
            hintaddinfo();
        }
    }
}
function showHint(){
    showhintvar.forEach((hint) => {
    hint.classList.contains("d-none") &&
      hint.classList.remove("d-none");
  });
  removehintaddinfo();}

let formStepsNum = 0;

nextBtns.forEach((btn) => {
  btn.addEventListener("click", () => {

    formStepsNum++;
    checkAnswer(question[formStepsNum]);
    score.innerHTML=quostionpos;
    badgebon();
    if (quostionpos==3) {
        alert('you win badge of hint and bonus 10 points after answer 5 question correctly');
        // showremovebut();
        scoresize.style.width='{{((Auth::user()->student->points->points + 10)/200)*100}}%';
    count3=sizepo+10;
    pointcount.innerHTML=count3+' points';
    }
if (quostionpos==5) {
    alert('you win badge of hint and bonus 10 points after answer 5 question correctly');
    // hintaddinfo();
    scoresize.style.width='{{((Auth::user()->student->points->points + 20)/200)*100}}%';
    count3=sizepo+20;
    pointcount.innerHTML=count3+' points';



}
if (quostionpos==7) {
    alert('you have badge remove option');
    // showremovebut();
    scoresize.style.width='{{((Auth::user()->student->points->points + 20 +15)/200)*100}}%';
    count3=sizepo+20+15;
    pointcount.innerHTML=count3+' points';

}
if (quostionpos==9) {
    alert('you win badge of hint and bonus 30 points after answer 5 question correctly');
    // showremovebut();
    scoresize.style.width='{{((Auth::user()->student->points->points + 20+15 +30)/200)*100}}%';
    count3=sizepo+20+30+15;
    pointcount.innerHTML=count3+' points';
}

showhintvar.forEach((hint) => {
    hint.classList.add("d-none") ;
  });

    updateFormSteps();
  });
});
let badgeanswer=0;
function checkAnswer(options) {
    cont=0;
    for (let index = 0; index < options.children.length; index++) {
        test=  options.children[index].children[0].children[0];
        if (test.checked==1 && test.value==1) {
            cont++;
        }
    }
    if (getCountRight(options)==cont) {
       quostionpos++;
       badgeanswer++;

    }else{
        badgeanswer--;
    }
cont=0;

}
let conttt=0;

function removeoption() {
    conttt=0;
    for (let index = 0; index < question[formStepsNum].children.length; index++) {
        if (conttt==0) {
            test=  question[formStepsNum+1].children[index].children[0].children[0];
        if (test.value==0) {
            conttt++;
            question[formStepsNum+1].children[index].classList.add('d-none');
            badgeremove.value--;
if (    badgeremove.value<=0) {
    delbutton.forEach((formStep) => {
    formStep.classList.add("d-none") ;
  });
}


        }
        }


    }

}
function getCountRight(options) {
    total=0;
    for (let index = 0; index < options.children.length; index++) {
        test=  options.children[index].children[0].children[0].value;
        if (test==1) {
            total++;
        }


    }

    return total;
}

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
