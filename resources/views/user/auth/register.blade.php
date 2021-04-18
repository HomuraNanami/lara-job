@extends('front.layouts.app')

@section('content')
	    <section class="login signup">
	      <div class="container">
	        <form method="POST" action="{{ route('user.register') }}">
	        @csrf
	          <h1>新規登録</h1>
			  <div class="form-group row">
			    <label for="inputEmail" class="col-sm-3 col-form-label">メールアドレス</label>
			    <div class="col-sm-9">
			      <input type="email" class="form-control" id="inputEmail" name="email" value="{{ old('email') }}" required autocomplete="email">
                  @error('email')
                    <div class="alert alert-danger mb-3" role="alert">
                        <strong>{{ $message }}</strong>
                    </div>
                  @enderror
			    </div>
			  </div>
	          <div class="form-group row">
	            <label for="inputPassword" class="col-sm-3 col-form-label">パスワード</label>
	            <div class="col-sm-9">
	              <input type="password" class="form-control" id="inputPassword" name="password" required autocomplete="new-password">
                  @error('password')
                    <div class="alert alert-danger mb-3" role="alert">
                      <strong>{{ $message }}</strong>
                    </div>
                  @enderror
	            </div>
	          </div>
            <div class="form-group row">
              <label for="inputPassword2" class="col-sm-3 col-form-label">パスワード（確認）</label>
              <div class="col-sm-9">
                <input type="password" class="form-control" id="inputPassword2" name="password_confirmation" required autocomplete="new-password">
              </div>
            </div>
            <div class="form-group row">
              <label for="inputName" class="col-sm-3 col-form-label">名前</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" id="inputName" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                @error('name')
                  <div class="alert alert-danger mb-3" role="alert">
                    <strong>{{ $message }}</strong>
                  </div>
                @enderror
              </div>
            </div>
            <div class="form-group row">
              <label for="inputFinalEducation" class="col-sm-3 col-form-label">最終学歴</label>
              <div class="col-sm-9">
                <div class="row">
                  @foreach (config("const.Users.FINAL_EDUCATION_LIST") as $key=>$value)
                  <div class="col-md-4">
                    <div class="custom-control custom-checkbox my-1 mr-sm-2">
                      <input type="radio" class="custom-control-input" id="inputFinalEducation{{$key}}" name="final_education" value="{{$key}}" @if(old('final_education') == $key) checked @endif>
                      <label class="custom-control-label" for="inputFinalEducation{{$key}}">{{$value}}</label>
                    </div>
                  </div>
                  @endforeach
                </div>
              </div>
            </div>
	          <div class="d-flex justify-content-center">
	            <button type="submit" class="btn btn-primary">新規登録する</button>
	          </div>
	        </form>
	      </div>
	    </section>
@endsection