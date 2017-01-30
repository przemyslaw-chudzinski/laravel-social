@if(Route::current()->uri() !== 'wall')
  @if(Auth::user()->id === $user->id)
    <div class="panel panel-default">
      <div class="panel-body">
        @include('components.add_post_form')
      </div>
    </div>
  @endif
  @else
    <div class="panel panel-default">
      <div class="panel-body">
        @include('components.add_post_form')
      </div>
    </div>
@endif

@if($posts->count() > 0)
  @foreach ($posts as $post)
    @include('components.post_content')
  @endforeach
@elseif(Route::current()->uri() !== 'wall')
  @include('components.no_posts',['user' => $user])
@endif

<div class="center-block">
  @if($posts)
  {{ $posts->links() }}
  @endif
</div>
