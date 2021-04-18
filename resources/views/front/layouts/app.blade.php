<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/assets/front/css/style.css') }}" />
    <title>{{ config('app.name', 'Laravel') }}</title>
    <meta name="description" content="">
    <meta name="format-detection" content="telephone=no">
  </head>
  <body>
    <header>
      <div class="container">
        <div class="d-flex justify-content-between align-items-center">
          <div><h1><a href="/">{{ config('app.name', 'Laravel') }}</a></h1></div>
          <div class="d-flex">
            @unless (Auth::guard('user')->check())
            <a class="btn btn-primary mr-2" href="{{ route('user.register') }}">新規登録</a>
            <a class="btn btn-outline-secondary" href="{{ route('user.login') }}">ログイン</a>
            @else
            <a class="btn btn-outline-secondary" href="{{ route('user.logout') }}"onclick="event.preventDefault(); document.getElementById('logout-form').submit();">ログアウト</a>
            <form id="logout-form" action="{{ route('user.logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
            @endif
          </div>
        </div>
      </div>
    </header>

    <main>
        @yield('content')
    </main>

    <footer>
      <div class="container">
        <p>Copyright &copy; 2021 {{ config('app.name', 'Laravel') }}</p>
      </div>
    </footer>


<!-- Modal -->
<div class="modal fade" id="needLoginModal" tabindex="-1" role="dialog" aria-labelledby="needLoginModalTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="needLoginModalTitle">これより先はログインが必要です。</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        	<p>これより先のページに進むためにはログインする必要があります。</p>
        	<p>ユーザ登録がまだの方は新規登録してください。</p>
        	<div class="d-flex justify-content-center my-5">
            <a class="btn btn-primary mr-2" href="{{ route('user.register') }}">新規登録</a>
            <a class="btn btn-outline-secondary" href="{{ route('user.login') }}">ログイン</a>
	        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

    <script src="https://kit.fontawesome.com/50232296a1.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="{{ asset('/assets/front/js/bootstrap.bundle.min.js') }}"></script>
  </body>
</html>