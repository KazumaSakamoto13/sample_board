@extends('app')

@section('title', 'プロフィール更新')

@include('nav')


@section('content')
  <div class="container">
    <div class="row">
      <div class="col-6">
        <div class="card mt-3">
          <div class="card-body pt-0">
       
          @include('error_card_list')
            <form action="{{ route('user.profile') }}" method="POST" >@csrf
            <div class="card-text">
            
            <div class="form-group">
                <label for="name">ユーザー名</label>
                <input type="text" name="name" class="form-control"  value=>
            </div>

            <div class="card-text">
            <div class="form-group">
                <label for="email">メールアドレス</label>
                <input type="email" name="email" class="form-control"  value=>
            </div>

             <button type="submit" class="btn blue-gradient btn-block">更新</button>
              </form>
              </div>
            </div>
          
            </div>
            </div>
            </div>
            <div class="col-6">
            <div class="card mt-3">
          <div class="card-body pt-0">
            <div>
    <p>名前:{{Auth::user()->name}}</p>

    </div>
    
    <div>
    <p>メール:{{Auth::user()->email}}</p>
    
    </div>
            </div>
            </div>

            </div>
            </div>

           
          
@endsection