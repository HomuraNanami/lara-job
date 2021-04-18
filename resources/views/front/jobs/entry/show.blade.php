@extends('front.layouts.app')

@section('content')
      <section class="job-detail">
        <div class="container">

		    @if (session('message'))
      		  <div class="alert {{session('message-class')}} mb-3" role="alert">
	        	{{session('message')}}
			  </div>
			@endif

          @if($job)
            <div class="job-header">
	          <div class="d-flex justify-content-center align-items-center flex-wrap">
                @if (!empty($job->icon_path))
                <div class="icon" style="background-image:url({{ $job->icon_path }});"></div>
                @else
                <div class="icon" style="background-image:url({{ asset('/assets/front/images/no-image.png') }});"></div>
                @endif
	            <p class="company">{{ $job->company_name }}</p>
	          </div>
	          <h1>{{ $job->title }}</h1>
	          @if (count($job->categories) > 0)
	          <div class="d-flex flex-wrap justify-content-center">
	          	@foreach ($job->categories as $cat)
	            <a class="btn btn-cat" href="">{{$cat->name}}</a>
	            @endforeach
	          </div>
	          @endif
	        </div>
	        <div class="job-body">
	          <h2 class="mb-4">応募フォーム</h2>
	          <form method="POST" action="{{route('jobs.entry.store', ['job' => $job->id])}}">
	            @csrf
	            <div class="form-group row">
	              <label for="textareaMessage" class="col-sm-3 col-form-label">応募メッセージ</label>
	              <div class="col-sm-9">
	                <textarea class="form-control" id="textareaMessage" name="message" rows="10" required autocomplete="message" autofocus>@if(old('message')) {{old('message')}} @else {{$entry->message}} @endif</textarea>
	                @error('message')
	                  <div class="alert alert-danger mb-3" role="alert">
	                    <strong>{{ $message }}</strong>
	                  </div>
	                @enderror
	              </div>
	            </div>
	            <div class="d-flex justify-content-center">
	              <button type="submit" class="btn btn-primary">応募する</button>
	            </div>
	          </form>
	        </div>
	      @else
	      	<div class="alert alert-danger mb-3" role="alert">
		        求人情報が見つかりませんでした。
			</div>
	      @endif
        </div>
      </section>
@endsection