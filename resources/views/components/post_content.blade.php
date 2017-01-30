<div class="panel panel-default" id="post-{{ $post->id }}" class="single-post">
    <div class="panel-body">
      <div class="media">
        <div class="media-left single-post-user-avatar">
          <a href="#">
            @include('components.post_user_avatar',['user' => $post->user])
          </a>
        </div>
        <div class="media-body">
          <h4 class="media-heading"><strong>{{ $post->user->firstName }} {{ $post->user->lastName }}</strong>
            @if(Auth::user()->id === $post->user_id)
              <a href="{{ url('posts'.'/'.$post->id.'/edit') }}">Edytuj</a>
              <form action="{{ url('posts'.'/'.$post->id) }}" method="post" class="pull-right">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
                <button class="btn btn-default btn-sm" onclick="return confirm('Czy na pewno chcesz usunąć ten wpis?')">Usuń</button>
              </form>
            @endif
            </h4>
          <div><span class="text-muted">{{ $post->created_at }}</span></div>
        </div>
      </div>
      <br>
      <div>
        {{ $post->content }}
      </div>
      <hr>
      @include('components.add_comment_form')
      <hr>
      @include('components.comments_list')
    </div>
</div>
