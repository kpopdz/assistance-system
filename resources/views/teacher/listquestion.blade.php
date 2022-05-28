@extends('layouts.teacher')
@section('content')
<style>

    .question{
        width: 500px;
        text-align: center;
        margin-bottom: 20px;
        font-family: 'Inter', sans-serif;
        margin-left: 25%;
        border: 1px solid rgb(26, 106, 255);
        border-radius: 50px;

        }
    .question-options{
        display: grid;
        grid-template-columns:  200px 200px ;


        column-gap: 20px;
        text-align: center;
        margin-left: 7.5%;
          }
         .question-option{
            background-color: white;
        border: 1px solid rgb(26, 106, 255);
        margin-bottom: 7.5%;
        padding-top: 10px;
        padding-top: 10px;
        border-radius: 20px;
font-size: 20px;      }
         .question-title{
            color: grey;
            font-weight: bold;
            font-size: 25px;
            width: 200px;
            margin-left: 30%;
            margin-bottom: 20px


         }
         .correct{
        background-color: rgb(2, 139, 2);
        color: white;
    }
</style>
<div class="row justify-content-end " style="margin-top:80px">
    @php
        $i=1;
    @endphp
     <div class="col-lg-6 m-auto ">
             @foreach ($questions as $item)
             <div class="modal fade" id="deletequestion{{$i}}" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">import the question</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        do you want import The question to the quiz       </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      <form action="{{ route('question.list.post',$item->id)}}" method="POST">
                        @csrf
                           @method('POST')
                           <input type="hidden" name="quizid" value="{{$id}}">
                           <button type="submit" class="btn btn-primary ">import</button>         </form>

                    </div>
                  </div>
                </div>
              </div>

    <div class="row bg-white rounded-2 shadow mb-5" style="border: 1px solid black;">

        <div class="d-flex justify-content-between px-2 py-2 mb-2 bg-header-question align-items-center">
            <div > question {{$i}}</div>
            <div class="d-flex ">
        <a class="d-flex bg-header-question-icon" href="
        {{-- {{ route('question.edit',[$quiz->id,$item->id])}} --}}

        ">        <i class="bi bi-pencil-square"></i>        <div class="ms-2"> Edit</div>
        </a>
        <a class="d-flex bg-header-question-icon" data-bs-toggle="modal" data-bs-target="#deletequestion{{$i}}">

            <i class="bi bi-shift"></i> <div class="ms-2"> Import</div>
        </a>
        {{-- delet question --}}

        {{-- ///////// --}}

        </div>
        </div>
        <div class="d-flex align-items-center">


            <div> {{$item->question_content}}</div>

        </div>
        <div class="relative bg-light-1 mb-2" >
       <h1 class="new-middle-line ">
            answer choices
          </h1> </div>
          <div class="d-flex flex-wrap m-2">
              @foreach ($item->option as $option)
              <div class="w-50"><i class="bi bi-circle-fill me-1 {{ $option->iscorrect ==  1 ? 'answer-right' : 'answer-wrong'  }} "></i>{{$option->option_CONTENT}}</div>

              @endforeach

          </div>
    </div>
    @php
        $i++;
    @endphp

    @endforeach


        </div>

     </div>





@endsection
