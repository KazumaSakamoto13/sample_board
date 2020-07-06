 <!-- ナビメニュー -->
<nav class="navbar navbar-expand navbar-dark blue-gradient">

  <a class="navbar-brand" href="/"><i class="far fa-sticky-note mr-1"></i>掲示板</a>
  

  <ul class="navbar-nav ml-auto">

  <div class="collapse navbar-collapse" id="navbarSupportedContent">


</div>

    @guest 
    <li class="nav-item">
      <a class="nav-link" href="{{ route('register') }}">ユーザー登録</a> 
    </li>
    @endguest 

    @guest 
    <li class="nav-item">
      <a class="nav-link" href="{{ route('login') }}">ログイン</a>
    </li>
    @endguest 
      
    @auth 
    <li class="nav-item">
      <a class="nav-link" href="{{ route('posts.create') }}"><i class="fas fa-pen mr-1"></i>投稿する</a>
    </li>
    @endauth 

    <!-- ナビメニュー -->


    @auth 
    <!-- ドロップダウンメニュー -->
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown"
         aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-user-circle">&nbsp;{{Auth::user()->name}}</i>
      </a>
      <div class="dropdown-menu dropdown-menu-right dropdown-primary" aria-labelledby="navbarDropdownMenuLink">
       
        <div class="dropdown-divider"></div>
        <button form="logout-button" class="dropdown-item" type="submit">
          ログアウト
        </button>
        @if(Auth::user()->id === Auth::user()->id)
        <a href="{{route('user.pro')}}">  プロフィール更新</a>
        @else
        <p>ログインしてください。</p>
        @endif             
      </div>
    </li>
    <form id="logout-button" method="POST" action="{{ route('logout') }}"> 
      @csrf 
    </form>
     <!-- ドロップダウンメニュー -->
    @endauth 

  </ul>

</nav>

