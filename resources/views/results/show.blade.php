@extends('layouts.app')

@section('content')

    <div class="d-flex" id="wrapper">
        <div class="container">
            @if($result)
                <div class="row">
                    <div class="col-md-12 mt-4">
                        <table class="table table-bordered table-striped">
                            <tr>
                                <th>User</th>
                                <td>{{$result->user->name}} ({{$result->user->email}})</td>
                            </tr>
                            <tr>
                                <th>fullname</th>
                                <td>{{$result->user->student->firstname}} {{$result->user->student->lastname}}</td>
                            </tr>

                            <tr>
                                <th>Date</th>
                                <td>{{$result->created_at}}</td>
                            </tr>
                            <tr>
                                <th>Score</th>
                                <td>{{$result->correct_answers}}/{{$result->quiz->totalPoint()}}</td>
                            </tr>
                        </table>
                        <table class="table table-bordered table-striped">
                            <?php $n = 0 ?>
                            @foreach($result->quiz->question as $question)
                                <?php $n++ ?>
                                <tr class="test-option-false">
                                    <th style="width: 10%">Question #{{$n}}</th>
                                    <th>{{$question->question_content}}</th>
                                </tr>
                                <tr>
                                    <td>Options</td>
                                    <td>
                                        <ul>
                                            @foreach($question->option as $option)
                                                @if($option->iscorrect == 1)

                                                    <li style="font-weight: bold;">{{$option->option_CONTENT}}
                                                        <em>(correct answer)</em>
                                                        @foreach($result->options as $user_option)
                                                            @if($user_option->option_id == $option->id)
                                                                <em>(your answer)</em>
                                                            @endif
                                                        @endforeach
                                                    </li>
                                                @else
                                                    <li>
                                                        {{$option->option_CONTENT}}
                                                        @foreach($result->options as $user_option)
                                                            @if($user_option->option_id == $option->id)
                                                                <em style="font-weight: bold;">(your answer)</em>
                                                            @endif
                                                        @endforeach
                                                    </li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
                @else
                <h1>No Result</h1>
            @endif
        </div>
    </div>
@endsection

