@extends('app')

@section('title', '記事投稿')

@include('nav')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="card mt-3">
          <div class="card-body pt-0">
            @include('error_card_list')
            <div class="card-text">
              <form method="POST" action="{{ route('comments.update', ['comment' => $comment]) }}">
                @method('PATCH')
            <div class="card-text">
              <form method="POST" action="{{ route('comments.store') }}">
              @csrf
<div class="form-group">
  <label></label>
  <textarea name="comment" required class="form-control" rows="16" placeholder="本文" >{{ $comment->comment }}</textarea>
</div>

<input type="hidden" name="user_id" value="{{ $comment->user_id }}">
<input type="hidden" name="post_id" value="{{$comment->post_id}}">

                <button type="submit" class="btn blue-gradient btn-block">更新する</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection