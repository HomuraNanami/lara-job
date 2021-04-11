<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source䦩﫨:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('/assets/admin/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('/assets/admin/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/admin/css/style.css') }}">
    <title>Lara{{ config('app.name', 'Laravel') }}</title>
    <meta name="description" content="">
    <meta name="format-detection" content="telephone=no">
  </head>
  <body class="hold-transition login-page">
		<div class="login-box">
		  <div class="login-logo">
		    {{ config('app.name', 'Laravel') }}
		  </div>
		  <!-- /.login-logo -->
		  <div class="card">
		    <div class="card-body login-card-body">
		      <p class="login-box-msg">Sign in to start your session</p>

		      <form method="POST" action="{{ route('admin.login') }}">
		        @csrf
		        <div class="input-group mb-3">
		          <input type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
		          <div class="input-group-append">
		            <div class="input-group-text">
		              <span class="fas fa-envelope"></span>
		            </div>
		          </div>
		        </div>
		        <div class="input-group mb-3">
		          <input type="password" class="form-control" placeholder="Password" name="password" required autocomplete="current-password">
		          <div class="input-group-append">
		            <div class="input-group-text">
		              <span class="fas fa-lock"></span>
		            </div>
		          </div>
		        </div>
                <div class="form-group mb-3">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label class="form-check-label" for="remember">
                      ログイン情報を記憶する
                    </label>
                  </div>
                </div>
		        @error('email')
		      	  <div class="alert alert-danger mb-3" role="alert">
		      		{{ $message }}
				  		</div>
		        @enderror

		        <div class="row">
		          <div class="col-12">
		            <button type="submit" class="btn btn-primary btn-block">ログイン</button>
		          </div>
		          <!-- /.col -->
		        </div>
		      </form>
		    </div>
		    <!-- /.login-card-body -->
		  </div>
		</div>
		<!-- /.login-box -->

    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="{{ asset('/assets/admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('/assets/admin/js/adminlte.min.js') }}"></script>
  </body>
</html>
