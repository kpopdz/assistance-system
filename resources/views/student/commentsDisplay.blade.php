@foreach($comments as $comment)
    <div class="display-comment mb-3" @if($comment->parent_id != null) style="margin-left:40px;" @endif>
        <strong>{{ $comment->user->name }}</strong>
        <p>{{ $comment->body }}</p>
        <a href="" id="reply"></a>
        <form method="post" action="{{ route('comments.store') }}">
            @csrf
            <div class="form-group mb-3">
                <input type="text" name="body" class="form-control" />
                <input type="hidden" name="post_id" value="{{ $course_id }}" />
                <input type="hidden" name="parent_id" value="{{ $comment->id }}" />
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-success mb-3" value="Reply" />
            </div>
            <hr />
        </form>
        @include('student.commentsDisplay', ['comments' => $comment->replies])
    </div>
@endforeach
