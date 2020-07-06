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
            <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
<div class="md-form">
  <label>タイトル</label>
  <input type="text" name="title" class="form-control" required value="{{  old('title') }}">
</div>
<div class="form-group">
                    <label for="exampleFormControlSelect1">カテゴリー</label>
                    <select class="form-control" id="exampleFormControlSelect1" name="category_id"required value="{{old('image') }}">
                        <option selected="">選択する</option>
                        <option value="1">Laravelエラー</option>
                        <option value="2">Railsエラー</option>
                        <option value="3">その他</option>
                    </select>
                </div>
                <div class="form-group">
                <label for="exampleFormControlFile1">画像投稿</label>
                <input type="file" class="form-control-file" id="exampleFormControlFile1" name="image" >
              </div>

<div class="form-group">
  <label></label>
  <textarea name="content" required class="form-control" rows="16" placeholder="本文">{{ old('content') }}</textarea>
</div>

<input type="hidden" name="user_id" value="{{ Auth::id() }}">

                <button type="submit" class="btn blue-gradient btn-block">投稿する</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection