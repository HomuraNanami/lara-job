@extends('front.layouts.app')

@section('content')
	    <section class="login profile">
	      <div class="container">

	        <form method="POST" action="{{ route('user.profile.update') }}">
	        @method('PUT')
	        @csrf
	        <h1>プロフィール</h1>
		    @if (session('message'))
      		  <div class="alert {{session('message-class')}} mb-3" role="alert">
	        	{{session('message')}}
			  </div>
			@endif
			<div class="form-group row">
			  <label for="inputEmail" class="col-sm-3 col-form-label">メールアドレス</label>
			  <div class="col-sm-9">
			    <input type="email" class="form-control" id="inputEmail" name="email" value="@if(old('email')) {{old('email')}} @else {{\Auth::user()->email}} @endif" required autocomplete="email">
                @error('email')
                  <div class="alert alert-danger mb-3" role="alert">
                    <strong>{{ $message }}</strong>
                  </div>
                @enderror
			  </div>
			</div>
            <div class="form-group row">
              <label for="inputName" class="col-sm-3 col-form-label">名前</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" id="inputName" name="name" value="@if(old('name')) {{old('name')}} @else {{\Auth::user()->name}} @endif" required autocomplete="name">
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
                      <input type="radio" class="custom-control-input" id="inputFinalEducation{{$key}}" name="final_education" value="{{$key}}" @if(defined(old('final_education')) && old('final_education') == $key)checked @elseif(!defined(old('final_education')) && \Auth::user()->final_education == $key) checked @endif>
                      <label class="custom-control-label" for="inputFinalEducation{{$key}}">{{$value}}</label>
                    </div>
                  </div>
                  @endforeach
                </div>
              </div>
            </div>
            <div class="form-group row">
              <label for="" class="col-sm-3 col-form-label">アイコン</label>
              <div class="col-sm-9">
                @if(!empty(\Auth::user()->icon_path))
                <div class="icon" style="background-image:url({{\Auth::user()->icon_path}});"></div>
                @else
                <div class="icon" style="background-image:url({{ asset('/assets/front/images/no-image.png') }});"></div>
                @endif
                <div class="custom-file">
                  <input type="file" class="custom-file-input" id="inputIcon" name="icon" value="" accept="image/*">
                  <label class="custom-file-label" for="inputIcon" aria-describedby="inputIconAddon01" data-browse="ファイル選択">Choose file</label>
                </div>
              </div>
            </div>
	          <div class="d-flex justify-content-center">
	            <button type="submit" class="btn btn-primary">更新する</button>
	          </div>
	        </form>
	      </div>
	    </section>
@endsection