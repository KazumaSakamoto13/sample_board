@extends('app')
@section('title', '記事一覧')
@section('content')
@include('nav') 


  <div class="container">
  @foreach($user->posts as $post)
    <div class="card mt-3">
      <div class="card-body d-flex flex-row">
        <i class="fas fa-user-circle fa-3x mr-1"></i>
        <div> 
          <div class="font-weight-bold">
        <h1>{{ $post->title }}</h1>  
          </div>
          <div class="font-weight-lighter">
          <p>{{ $post->created_at->format('Y/m/d H:i') }}</p>  
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
        <p>{{ $post->content }}</p>
        <div class="col-md-12 mb-4">
        <a href="{{ route('posts.show', $post->id) }}" class="btn btn-primary">詳細</a>
        
  </div>
        </div>
      </div>
    </div>
    @endforeach
  </div>
@endsection