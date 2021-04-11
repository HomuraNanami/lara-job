@extends('front.layouts.app')

@section('content')
	    <section class="login">
	      <div class="container">
	        <form method="POST" action="{{ route('user.login') }}">
	          @csrf
	          <h1>ログイン</h1>
					  <div class="form-group row mb-3">
					    <label for="inputEmail" class="col-sm-3 col-form-label">メールアドレス</label>
					    <div class="col-sm-9">
					      <input type="email" class="form-control" id="inputEmail" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
					      @error('email')
					      	<div class="alert alert-danger mt-1" role="alert">
					      		{{ $message }}
									</div>
					      @enderror
					    </div>
					  </div>
	          <div class="form-group row mb-2">
	            <label for="inputPassword" class="col-sm-3 col-form-label">パスワード</label>
	            <div class="col-sm-9">
	              <input type="password" class="form-control" id="inputPassword" name="password" required autocomplete="current-password">
	              @error('password')
					      	<div class="alert alert-danger mt-1" role="alert">
					      		{{ $message }}
									</div>
	              @enderror
	            </div>
	          </div>
            <div class="form-group row">
              <div class="col-md-9 offset-md-3">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                  <label class="form-check-label" for="remember">
                    ログイン情報を記憶する
                  </label>
                </div>
              </div>
            </div>
	          <div class="d-flex justify-content-center">
	            <button type="submit" class="btn btn-primary">ログイン</button>
	          </div>
	        </form>
	      </div>
	    </section>
@endsection