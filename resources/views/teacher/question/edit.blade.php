@extends('layouts.teacher')

@section('content')
<style>
    .delete-user{
        color: rgb(88, 169, 230);
    }
</style>
<div class="col-lg-10 m-lg-auto">

    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Create Question</h5>

        <!-- General Form Elements -->
        <form action="{{route('question.update',[$quiz->id,$question->id])}}" method="post">
            @csrf
            @method('put')

            <div id="cc2">
                <div class="row mb-3">
                    <label for="inputText" class="col-sm-2 col-form-label" >question content</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" name="question" value="{{$question->question_content}}">

                    </div>
                    <div class="col-sm-2">
                      <input type="number" class="form-control"  value="{{$question->question_point}}">

                    </div>
                  </div>


                  @php
                  $i=0;
              @endphp
              {{count($question->option)}}
              @foreach ($question->option as $option)
              @php
              $i++;
          @endphp

                  <div class="row mb-3 q x" id="row{{$i}}">
                    <input type="hidden" name="option_id[]" value="{{$option->id}}">

                    <label for="inputText" class="col-sm-2 col-form-label">option {{$i}}</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" name="options[]" value="{{$option->option_CONTENT}}">

                    </div>
                    <div class="form-check col-sm-1">
                        <input class="form-check-input" type="checkbox" id="gridCheck1" name="correct[]"    value="{{$i}}"
                        {{($option->iscorrect == 1) ? 'checked' : ''}}>
                        <label class="form-check-label" for="gridCheck1">
                          true?
                        </label>
                      </div>
                       <div class="col-sm-2">
                        <button type="button" name="remove" id="{{$i}}" class="btn btn-danger" onClick="deleteOpt({{$i}})">X</button>

                    </button>
                    </div>


                  </div>
                  @endforeach

            </div>








<div class="row mb-3 justify-content-center">
    <div class="col-sm-2"><input type="submit" value="Update" class="btn btn-success mb-2 mr-2"
        /></div><div class="col-sm-2">                  <button type="button" name="addAnswer " onclick="addother()" id="addAnswer3" class="btn btn-success">
    Add Answer
</button></div>

</div>


        </form><!-- End General Form Elements -->

      </div>
    </div>

  </div>
  <script>
          let j={{count($question->option)}};

          let i=0;

    par=document.getElementById('cc2');
function addother() {

j++;
i=i+1;

test=document.getElementById('cc2');
try2022=document.createElement('div');
// const attributes = ['name', 'title', 'disabled', 'style'];
try2022.setAttribute("class", "row mb-3 q y");
try2022.setAttribute("id", "row" + j + "");

try2022.innerHTML=
           ' <label for="inputText" class="col-sm-2 col-form-label">option'+ j+'</label>'+
            '<div class="col-sm-7">'+
              '<input type="text" class="form-control" name="newoptions[]">'+

           '</div>'+
            '<div class="form-check col-sm-1">'+
               ' <input class="form-check-input" type="checkbox" id="gridCheck1" value="' + i + '" name="newcorrect[]">'+
               ' <label class="form-check-label" for="gridCheck1">'+
                 ' true?'+
                '</label>'+
             ' </div>'+
             ' <div class="col-sm-2">' +
                '<button type="button" name="remove" id="' + j + '" class="btn btn-danger" onClick="deleteOpt1('+ j +')">X</button>'+

            '</button>'+
            '</div>'
;
test.appendChild(try2022);

}
function deleteOpt(id) {
    changeChildrenClassX(id);

row=document.getElementById('row'+id);
row.remove();
j--;

// par.parentNode.removeChild(row);
// document.getElementById('row'+id)

}
function changeChildrenClassX(id) {
    optionsQuizs = document.querySelectorAll('.q');
    let temp=0;


    optionsQuizs.forEach(optionsQuiz => {
        if (temp==1) {
            if (optionsQuiz.classList[3]=="x") {
                str=optionsQuiz.children[1].innerHTML;
            matches = str.match(/(\d+)/) ;
            optionsQuiz.children[1].innerHTML="option"+ (matches[0]-1);
            checkboxValue=optionsQuiz.children[3].children[0].value;
            optionsQuiz.children[3].children[0].value=checkboxValue-1;
            }
            if (optionsQuiz.classList[3]=="y") {
                str=optionsQuiz.children[0].innerHTML;
            matches = str.match(/(\d+)/) ;
            optionsQuiz.children[0].innerHTML="option"+ (matches[0]-1);

            }
        }
        if (optionsQuiz.id==('row'+id)) {
temp=1;
        }

});
}
function changeChildrenClassY(id) {
    let temp=0;

    optionsQuizs = document.querySelectorAll('.q');

    optionsQuizs.forEach(optionsQuiz => {
        if (temp==1) {
            if (optionsQuiz.classList[3]=="y") {
                str=optionsQuiz.children[0].innerHTML;
            matches = str.match(/(\d+)/) ;
            optionsQuiz.children[0].innerHTML="option"+ (matches[0]-1);
            checkboxValue=optionsQuiz.children[2].children[0].value;
            optionsQuiz.children[2].children[0].value=checkboxValue-1;
            }
        }
        if (optionsQuiz.id==('row'+id)) {
temp=1;
        }

});
}

//   myElement.children[i].innerHTML='option'+ i;

function deleteOpt1(id) {
    changeChildrenClassY(id);

row=document.getElementById('row'+id);
row.remove();
i--;
j--;


// par.parentNode.removeChild(row);
// document.getElementById('row'+id)

}
</script>



    <script type="text/javascript">
        $(document).ready(function () {
            var n = 1;

            $('#addAnswer').click(function () {
                n++;
                $('#dynamic_field').append('' +
                    '<tr id="row' + n + '" class="dynamic-added">' +
                    '<td>' +
                    '</td>' +
                    '<td>' +
                    '<input type="text" name="options[]" required placeholder="Iveskite atsakyma" class="form-control question_list" />' +
                    '</td>' +
                    '<td>' +
                    '<input type="checkbox" name="correct[]" value="' + n + '" class="form-control question_list" />' +
                    '</td>' +
                    '<td>' +
                    '<button type="button" name="remove" id="' + n + '" class="btn btn-danger btn_remove">X</button>' +
                    '</td>' +
                    '</tr>');
            });


            $(document).on('click', '.btn_remove', function () {
                var button_id = $(this).attr("id");
                $('#row' + button_id + '').remove();
            });

        });
    </script>


@endsection


