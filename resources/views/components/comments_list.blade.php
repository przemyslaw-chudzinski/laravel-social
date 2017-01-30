@if($post->comments)
  @foreach ($post->comments as $comment)
    <div class="media">
      <div class="media-left">
        <a href="{{ url('users'.'/'.$comment->user->id) }}" class="post_comment_user_avatar">
          @include('components.post_user_avatar',['user' => $comment->user])
        </a>
      </div>
      <div class="media-body">
        <h4 class="media-heading">{{ $comment->user->firstName }} {{ $comment->user->lastName }}
          @if($comment->user_id === Auth::id())
           <a href="{{ url('comments'.'/'.$comment->id.'/edit') }}">Edytuj</a>
           <form action="{{ url('comments'.'/'.$comment->id) }}" method="post" class="pull-right">
             {{ csrf_field() }}
             {{ method_field('DELETE') }}
             <button class="btn btn-default btn-sm" onclick="return confirm('Czy na pewno chcesz usunąć ten komentarz?')">Usuń</button>
           </form>
         @endif
        </h4>
        {{ $comment->content }}
         @include('components.comment_like')
      </div>
    </div>
  @endforeach
@endif
