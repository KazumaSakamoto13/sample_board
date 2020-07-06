@extends('app')
@section('title', '記事一覧')
@section('content')
@include('nav') 


  <div class="container">
    <div class="card mt-3">
      <div class="card-body d-flex flex-row">
        <i class="fas fa-user-circle fa-3x mr-1"></i>
        <div> 
          <div class="font-weight-bold">
        <h1>{{ $post->title }}</h1>  
          </div>
          <div class="font-weight-lighter">
         
          </div>
        </div>
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
 </div>



        <div class="card-text">
        <p>{{ $post->content }}</p>
        <img src="{{ asset('storage/image/'.$post->image) }}"style="width: 80%; height: auto;">
        </div>
      </div>
    </div>
  </div>

  
  <div class="container">
  
  @foreach($post->comment as $comment)
    <div class="card mt-3">
    @if( Auth::id() === $comment->user_id )
          <!-- dropdown -->
          <div class="ml-auto card-text">
            <div class="dropdown">
              <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <button type="button" class="btn btn-link text-muted m-0 p-2">
                  <i class="fas fa-ellipsis-v"></i>
                </button>
              </a>
              <div class="dropdown-menu dropdown-menu-right">
                <a class="dropdown-item" href="{{ route('comments.edit', ['comment' => $comment]) }}">
                  <i class="fas fa-pen mr-1"></i>コメントを更新する
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item text-danger" data-toggle="modal" data-target="#modal-delete-{{ $post->id }}">
                  <i class="fas fa-trash-alt mr-1"></i>コメントを削除する
                </a>
              </div>
            </div>
          </div>
          <!-- dropdown -->
  
          <!-- modal -->
          <div id="modal-delete-{{ $post->id }}" class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="閉じる">
                    <span aria-hidden="true">×</span>
                  </button>
                </div>
                <form method="POST" action="{{ route('comments.destroy', ['comment' => $comment]) }}">
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
          <!-- modal -->
        @endif
      <div class="cajrd-body d-flex flex-row">
    
        <i class="fas fa-user-circle fa-3x mr-1"></i>
      <div class="card-body pt-0 pb-2">
      
        <h3 class="card-title">
        <p class="card-text">{{ $comment->comment }}</p>
        
        <div class="font-weight-lighter">
        <p class="card-text">{{ $comment->created_at->format('Y/m/d H:i') }}</p>
          </div> 
        <p class="card-text">投稿者:
                        <a href="{{ route('users.show', $comment->user->id) }}">
                            {{ $comment->user->name }}
                        </a></p>
      </div>
    </div>
    @endforeach
    <a href="{{ route('comments.create', ['post_id' => $post->id]) }}" class="btn btn-primary">コメントする</a>
  </div>
  
  @endsection