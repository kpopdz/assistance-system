@extends('layouts.teacher')

@section('content')
<style>
.quizimage{
    width: 300px;
    height: 300px;
    border-radius: 8px;
}
.quizitem{
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    margin-right: 5px;

    float: left;
}
.quiztitle{
font-family: Roboto-light;
text-transform: uppercase;

}
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
@if ($message=Session::get('success'))
<div class="alert alert-success alert-dismissible fade show mt-5" role="alert">
    <i class="bi bi-check-circle me-1"></i>
    {!!$message!!}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
 @endif
 <style>
    .size-image{

        display: flex;
        color: white;
        justify-content: center;
        align-items: center;

        width: 64px;
        height: 64px;
        font-size: 28px;
        background-color:#2d9da6 ;
        border-radius: 50%;
    }
    .upload_image{
        display: flex;
        flex-direction: column;
        background-color:transparent;
        justify-content: center;
        align-items: center;
        border: none;



    }
    .text-image{
        font-size: 10px;
        color: grey;
    }</style>
    <div class="position-fixed back-button"><a href="{{route('quizs.index')}}"><i class="bi bi-arrow-left-circle-fill"></i></a></div>
    <div style="      height: 65px;
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    align-items: center;
    top: 60px;
    left:25%;

    position: fixed;
    background-color: #ffffff;
    z-index:1000;
    width:50%;
    padding-left: 10px;
padding-right: 10px;
border: 1px solid #97baff;
  border-top-color: rgb(151, 186, 255);
  border-top-style: solid;
  border-top-width: 1px;
border-top: 0;
border-bottom-left-radius: 29px;
border-bottom-right-radius: 29px;"
    >
<a href="{{route('quizs.finishe',$quiz->id)}}" class="btn btn-outline-dark" >finished</a>
    <a class="btn btn-outline-dark" href="{{route('question.list',$quiz->id)}}"> import</a>
    <a class="btn btn-outline-dark" href="{{ route('quiz.duplicate',$quiz->id)}}" style="">duplicate Quiz</a>

    <a class="btn btn-outline-dark" href="{{ route('quizs.create.posts',$quiz->id)}}" style="">Add Question</a>

</div>

 <div class="row justify-content-end " style="margin-top:80px">
@php
    $i=1;
@endphp
 <div class="col-lg-6 me-3 ">           @foreach ($quiz->question as $item)
    <div class="modal fade" id="deletequestion{{$i}}" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Delete the question</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                do you want delete The question          </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <form action="{{ route('question.delete',[$quiz->id,$item->id])}}" method="POST">
                @csrf
                   @method('DELETE')
                                 <button type="submit" class="btn btn-danger"> DELETE </button>
                 </form>
            </div>
          </div>
        </div>
      </div>
<div class="row bg-white rounded-2 shadow mb-5" style="border: 1px solid black;">

    <div class="d-flex justify-content-between px-2 py-2 mb-2 bg-header-question align-items-center">
        <div > question {{$i}}</div>
        <div class="d-flex ">
    <a class="d-flex bg-header-question-icon" href="{{ route('question.edit',[$quiz->id,$item->id])}}">        <i class="bi bi-pencil-square"></i>        <div class="ms-2"> Edit</div>
    </a>
    <a class="d-flex bg-header-question-icon" data-bs-toggle="modal" data-bs-target="#deletequestion{{$i}}">        <img src="http://127.0.0.1:8000/icons/delete_FILL0_wght400_GRAD0_opsz48.svg" alt="" class="icons-size">
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
    <div class="col-lg-4">

        <div class="card">
          <div class="card-body">

            <h5 class="card-title">Quick information</h5>
           @if ($quiz->image ==null)
           <button class="upload_image">
            <div class="size-image">                <i class="bi bi-image-fill"></i>
            </div>
        </button>
           @else
           <img id="" src="{{url($quiz->image)}}" alt="" class="img-fluid" style="z-index: 1000;">

           @endif
        <h2 class="mt-4">  {{$quiz->title}}</h3>
        <div>
            {!! $quiz->description !!}
        </div>
        <div class="mb-2" style="color: #475af1;"><i class="bi bi-eye-fill"></i>  {{$quiz->visibility}}</div>

            <!-- Vertically centered Modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#verticalycentered">
                Edit
           </button>
            <div class="modal fade" id="verticalycentered" tabindex="-1">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">Update</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <form action="{{ route('quiz.addinfo',$quiz->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                           @method('POST')
                        <div class="row mb-3">
                            <div class="col-sm-10">
                    <div  class="upload_image mb-3" id="default-image" onclick="defaultBtnActive()">
                        @if ($quiz->image !== null)
                        <img id="new-image" src="{{url($quiz->image)}}" alt="" class="img-fluid" style="z-index: 1000;">
                        </div>
                        <span class="text-image mb-3"></span>
                        @else
                        <img id="new-image" src="" alt="" class="img-fluid" style="z-index: 1000;">
                        <div class="size-image" id="back-image">                <i class="bi bi-image-fill"></i>
                        </div>
                        <span class="text-image mb-3"></span>
                        @endif

                    </div>

                      <div class="mb-3">

                        <input class="form-control d-none" type="file" id="up-quiz-image" name="image">

                        <script>

                            const defImg= document.querySelector("#default-image");
                            const defaultBtn = document.querySelector("#up-quiz-image");
                            const img = document.querySelector("#new-image");
                            const backImg = document.querySelector("#back-image");

                            function defaultBtnActive(){
                                            defaultBtn.click();
                                            }

                                            defaultBtn.addEventListener("change", function(){
               const file = this.files[0];
               if(file){
                 const reader = new FileReader();
                 reader.onload = function(){
                   const result = reader.result;
                   img.src = result;
                //    wrapper.classList.add("active");
                 }
                 reader.readAsDataURL(file);
                 backImg.style.display='none';
                }});

                        </script>

                      </div>
                      <div class="row mb-3">
                        <label for="title" class="col-sm-3 col-form-label">Name :<span style="color:red">*</span></label>
                        <div class="col">
                          <input type="text"name="title" id="username" class="form-control" value="{{$quiz->title}}">
                        </div>
                      </div>
                      <div class="row mb-3">
                        <label for="tags" class="col-sm-3 col-form-label">Tags :</label>
                        <div class="col-sm-9">
                          <input type="text"data-role="tagsinput" name="tags" class="form-control tags" value="{{$res}}">
                        </div>
                      </div>






                      <div class="row mb-3">
                        <label for="inputPassword" class="col-sm-3 col-form-label">Summary :</span></label>
                        <div class="col-sm-9">
                            <textarea name="description" id="position" >{{$quiz->description}}</textarea>

                        </div>
                      </div>
                      <div class="d-flex col justify-content-between">
                        <label for="floatingSelect">Visiblity :</label>

                      <div class="form-floating mb-3 col-9 " >

                        <select class="form-select  " name="visibility" id="floatingSelect" aria-label="Floating label select example">
                          <option >choose type</option>
                          <option value="Public" {{ old('visibility', $quiz->visibility) == 'Public' ? 'selected' : ''}}>public</option>
                          <option value="Private" {{ old('visibility', $quiz->visibility) == 'Private' ? 'selected' : ''}}>private</option>
                        </select>
                        <label for="floatingSelect">visiblity</label>
                      </div>
                    </div>
                    </div>
                    </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                  </div>
                                </div>

                    </form>
                </div>
              </div>
              <script>
                ClassicEditor
                    .create( document.querySelector( '#position' ) )
                    .catch( error => {
                        console.error( error );
                    } );
            </script>

             <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
             <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.js"></script>
            </div><!-- End Vertically centered Modal-->

          </div>
        </div>

        </div>
 </div>
<div class="container" >




    @endsection
