@extends('layouts.teacher')

@section('content')


    <div class="col-lg-10 m-lg-auto">

        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Add Question to quiz</h5>

            <!-- General Form Elements -->
            <form action="{{route('quizs.test.create')}}" method="post">
                @csrf
                <div id="cc2">
                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label" >question <span style="color: red">*</span></label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control" name="question" value="{{ old('question') , '' }}">

                        </div>
                        <div class="col-sm-2">
                          <input type="number" class="form-control" placeholder="Point" name="point">

                        </div>
                      </div>
                      <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label" >hint <span style="color: red">*</span></label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control" name="hint" value="{{ old('hint') , '' }}">

                        </div>

                      </div>


                      <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label">option 1 <span style="color: red">*</span></label>
                        <div class="col-sm-7">
                          <input type="text" class="form-control" name="options[]">

                        </div>
                        <div class="form-check col-sm-1">
                            <input class="form-check-input" type="checkbox" id="gridCheck1" name="correct[]" value="1">
                            <label class="form-check-label" for="gridCheck1">
                              true?
                            </label>
                          </div>
                          <div class="col-sm-2">                  <button type="button" name="addAnswer " onclick="addother()" id="addAnswer3" class="btn btn-success">
                            Add Answer
                        </button>
</div>

                      </div>
                </div>









              <input type="hidden" name="quiz_id" value="{{$quiz->id}}">

              <input type="submit" name="addQuestion" id="addQuestion" class="btn btn-success mb-2 mr-2"
                     value="Add Question"/>
                     <a href="{{route('quizs.show',$quiz->id)}}" class="btn btn-primary mb-2 mr-2">
                        {{ __('cancel') }}
                    </a>
            </form><!-- End General Form Elements -->

          </div>
        </div>

      </div>
    <script>
        let i=1;

temp=0
        par=document.getElementById('cc2');
function addother() {
    i=i+1;

    test=document.getElementById('cc2');
    try2022=document.createElement('div');
    // const attributes = ['name', 'title', 'disabled', 'style'];
    try2022.setAttribute("class", "row mb-3 q");
    try2022.setAttribute("id", "row" + i + "");

    try2022.innerHTML=
               ' <label for="inputText" class="col-sm-2 col-form-label">option '+ i+'</label>'+
                '<div class="col-sm-7">'+
                  '<input type="text" class="form-control" name="options[]">'+

               '</div>'+
                '<div class="form-check col-sm-1">'+
                   ' <input class="form-check-input" type="checkbox" id="gridCheck1" value="' + i + '" name="correct[]">'+
                   ' <label class="form-check-label" for="gridCheck1">'+
                     ' true?'+
                    '</label>'+
                 ' </div>'+
                 ' <div class="col-sm-2">' +
                    '<button type="button" name="remove" id="' + i + '" class="btn btn-danger" onClick="deleteOpt('+i+')">X</button>'+

                '</button>'+
                '</div>'
;
test.appendChild(try2022);

}
function deleteOpt(id) {
    changeChildren(id);
 row=document.getElementById('row'+id);
 row.remove();
 i--;

    // par.parentNode.removeChild(row);
// document.getElementById('row'+id)

}
function changeChildren(id) {
    optionsQuizs = document.querySelectorAll('.q');

    optionsQuizs.forEach(optionsQuiz => {
        if (temp==1) {
            const myElement = document.getElementById('foo');
            str=optionsQuiz.children[0].innerHTML;
            matches = str.match(/(\d+)/) ;
            optionsQuiz.children[0].innerHTML="option"+ (matches[0]-1);
            checkboxValue=optionsQuiz.children[2].children[0].value;
            optionsQuiz.children[2].children[0].value=checkboxValue-1;
//   myElement.children[i].innerHTML='option'+ i;



        }
        if (optionsQuiz.id==('row'+id)) {
temp=1;
        }

});
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
                    '<input type="text" name="options[]" required placeholder="option" class="form-control question_list" />' +
                    '</td>' +
                    '<td>' +
                    '<input type="checkbox" name="correct[]" value="' + n + '" class="" />' +
                    '</td>' +
                    '<td>' +
                    '<button type="button" name="remove" id="' + n + '" class="btn btn-danger btn_remove">X</button>' +
                    '</td>' +
                    '</tr>');
            });
            $('#addAnswer1').click(function () {
                n++;
                $('#dynamic_field1').append('' +
                    '<div id="row' + n + '" class="dynamic-added">' +

                    '<input type="text" name="options[]" required placeholder="option" class="form-control question_list" />' +

                    '<input type="checkbox" name="correct[]" value="' + n + '" class="" />' +

                    '<button type="button" name="remove" id="' + n + '" class="btn btn-danger btn_remove">X</button>' +

                    '</div>');
            });


            $(document).on('click', '.btn_remove', function () {
                var button_id = $(this).attr("id");
                $('#row' + button_id + '').remove();
            });

        });
    </script>
@endsection
