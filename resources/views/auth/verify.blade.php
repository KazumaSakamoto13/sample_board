@extends('app')
@section('title', '記事一覧')
@section('content')

<nav class="navbar navbar-expand navbar-dark blue-gradient">

  <a class="navbar-brand" href="/"><i class="far fa-sticky-note mr-1"></i>掲示板</a>
  

  <ul class="navbar-nav ml-auto">

  <div class="collapse navbar-collapse" id="navbarSupportedContent">


</div>
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">メールアドレス認証はお済みですか？</div>
 
                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            新規認証メールを再送信しました！
                        </div>
                    @endif
 
                    このページを閲覧するには、Eメールによる認証が必要です。
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

</nav>

