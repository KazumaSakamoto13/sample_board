@extends('app')
@section('title', '記事一覧')
@section('content')
@include('nav') 





  <div class="container">
  <form action="{{ route('posts.search') }}" method="get" class="form-inline mr-auto mt-4">
  @csrf
 タイトル：<input class="form-control" type="text" placeholdSer="" name='title' aria-label="earch" style='margin-right:10px'>
 コンテンツ：<input class="form-control" type="text" placeholdSer="" name='content' aria-label="earch">
  <button class="btn aqua-gradient btn-rounded btn-sm my-0" type="submit">検索</button>
</form>


@isset($search_result)
    <h5 class="card-title">{{ $search_result }}</h5>
@endisset


@if(session()->has('message'))
          <div class="alert alert-info mb-3" style="margin-top:2%">
              {{session('message')}}
          </div>
    @endif


  @foreach($posts as $post)
    <div class="card mt-3">
      <div class="card-body d-flex flex-row">
        <i class="fas fa-user-circle fa-3x mr-1"></i>
        <div> 
        

          <div class="font-weight-bold">
        <h1>{{ $post->title }}</h1>  
          </div>
          <div class="font-weight-lighter">
          <p>投稿日:{{ $post->created_at->format('Y/m/d H:i') }}</p>  
          <p>最終更新日:{{ $post->updated_at->format('Y/m/d H:i') }}</p>  
          </div>
        </div>



        @if( Auth::id() === $post->user_id )
         
          <div class="ml-auto card-text">
            <div class="dropdown">
              <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <button type="button" class="btn btn-link text-muted m-0 p-2">
                  <i class="fas fa-ellipsis-v"></i>
                </button>
              </a>
              <div class="dropdown-menu dropdown-menu-right">
                <a class="dropdown-item" href="{{ route('posts.edit', ['post' => $post]) }}">
                  <i class="fas fa-pen mr-1"></i>スレッドを更新する
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item text-danger" data-toggle="modal" data-target="#modal-delete-{{ $post->id }}">
                  <i class="fas fa-trash-alt mr-1"></i>スレッドを削除する
                </a>
              </div>
            </div>
          </div>
        
          <div id="modal-delete-{{ $post->id }}" class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="閉じる">
                    <span aria-hidden="true">×</span>
                  </button>
                </div>
                <form method="POST" action="{{ route('posts.destroy', ['post' => $post]) }}">
                  @csrf
                  @method('DELETE')
                  <div class="modal-body">
                    {{ $post->title }}を削除します。よろしいですか？
                  </div>
                  <div class="modal-footer justify-content-between">
                    <a class="btn btn-outline-grey" data-dismiss="modal">キャンセル</a>
                    <button type="submit" class="btn btn-danger">削除する</button>
                  </div>
                </form>
              </div>
            </div>
          </div>

        @endif

      </div>

      <div class="card-body pt-0 pb-2">
        <h3 class="h4 card-title">
        </h3>
        <div class="card-text">
        投稿者:
         <a href="{{ route('users.show', $post->user_id) }}">{{ $post->user->name }}</a>
               


                
    
        <div class="card-text">
        カテゴリー:
                      <a href="{{ route('posts.index', ['category_id' => $post->category_id]) }}">
                          {{ $post->category->category_name }}
                      </a>
        </div>

        <div class="card-text">

               <div class="card-text"> タグ: 
                @foreach($post->tags as $tag)
                    <a href="{{ route('posts.index', ['tag_name' => $tag->tag_name]) }}">
                      {{ $tag->tag_name }}
                    </a>
                @endforeach
                </div>



        <div class="card-text">
        {{ $post->content }}
        </div>
        <div class="card-text">
       コメント数： {{ $post->comment->count()}}件
       
        </div>
        <div class="col-md-12 mb-4">
        <a href="{{ route('posts.show', $post->id) }}" class="btn btn-primary">詳細</a>
        
  </div>
        </div>
      </div>
    </div>
    @endforeach
    @if(isset($category_id))
    {{ $posts->appends(['category_id' => $category_id])->links() }}

@elseif(isset($tag_name))
    {{ $posts->appends(['tag_name' => $tag_name])->links() }}

@elseif(isset($title,$content))
    {{ $posts->appends(['title' => $title, 'content'=>$content])->links() }}

    @elseif(isset($title))
    {{ $posts->appends(['title' => $title])->links() }}

    @elseif(isset($content))
    {{ $posts->appends(['content' => $content])->links() }}

@else
    {{ $posts->links() }}
@endif
  </div>
@endsection