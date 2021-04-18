@extends('front.layouts.app')

@section('content')
	    <section class="hero">
	      <div class="container">
	        <p class="sub-title">求人検索サイト</p>
	        <p class="title">Lara JOB</p>
	        @unless (Auth::guard('user')->check())
	        <div class="d-flex justify-content-center mb-5">
	          <a class="btn btn-primary mr-2" href="{{ route('user.register') }}">新規登録</a>
	          <a class="btn btn-outline-light" href="{{ route('user.login') }}">ログイン</a>
	        </div>
	        @endif
	        @if (count($pickupCategoies) > 0)
	        <p class="cat-title">注目カテゴリ</p>
	        <div class="d-flex flex-wrap justify-content-center">
	          @foreach ($pickupCategoies as $cat)
	          <a class="btn btn-cat" href="{{route('jobs.index')}}?category[]={{ $cat->id }}">{{ $cat->name }}</a>
	          @endforeach
	        </div>
	        @endif
	      </div>
	    </section>

	    <section class="search">
	      <div class="container">
	        <form method="GET" action="{{route('jobs.index')}}">
	          <p>条件を指定して探す</p>
					  <div class="form-group row">
					    <label for="searchKeyword" class="col-sm-2 col-form-label">キーワード</label>
					    <div class="col-sm-10">
					      <input type="text" class="form-control" id="searchKeyword" name="keyword" value="">
					    </div>
					  </div>
	          <div class="form-group row">
	            <label for="searchSalary" class="col-sm-2 col-form-label">給与</label>
	            <div class="col-sm-10 form-inline">
	              <input type="number" class="form-control" name="min_salary" value="">
	              <span class="ml-2 mr-2">～</span>
	              <input type="number" class="form-control" name="max_salary" value="">
	            </div>
	          </div>
	          @if (count($allCategoies) > 0)
	          <div class="form-group row">
	            <label for="searchCategory" class="col-sm-2 col-form-label">カテゴリ</label>
	            <div class="col-sm-10">
	              <div class="row">
	                @foreach ($allCategoies as $cat)
	                <div class="col-md-3">
	                  <div class="custom-control custom-checkbox my-1 mr-sm-2">
	                    <input type="checkbox" class="custom-control-input" id="searchCategory{{ $cat->id }}" name="category[]" value="{{ $cat->id }}">
	                    <label class="custom-control-label" for="searchCategory{{ $cat->id }}">{{ $cat->name }}</label>
	                  </div>
	                </div>
	                @endforeach
	              </div>
	            </div>
	          </div>
	          @endif
	          <div class="d-flex justify-content-center">
	            <button type="submit" class="btn btn-primary">検索</button>
	          </div>
	        </form>
	      </div>
	    </section>

	    @if (count($resentJobs) > 0)
	    <section class="job-block">
	      <div class="container">
	        <h2>新着求人</h2>

	        <div class="row job-list">
	          @foreach ($resentJobs as $job)
	          <div class="col-sm-6 col-md-4 col-lg-3">
	            @unless (Auth::guard('user')->check())
	            <a href="#" data-toggle="modal" data-target="#needLoginModal">
	            @else
	            <a href="{{route('jobs.show', ['job' => $job->id])}}">
	            @endif
	              <div class="card">
	                <div class="card-header">
	                  <div class="d-flex justify-content-end category-wrap">
	                	@if (!empty($job->getOneCategory()))
	                    <span class="btn btn-cat">{{ $job->getOneCategory()->name }}</span>
	                	@endif
	                  </div>
	                  
	                  @if (!empty($job->icon_path))
	                  <div class="icon" style="background-image:url({{ $job->icon_path }});"></div>
	                  @else
	                  <div class="icon" style="background-image:url({{ asset('/assets/front/images/no-image.png') }});"></div>
	                  @endif
	                </div>
	                <div class="card-body">
	                  <h3>{{ $job->company_name }}</h3>
	                  <p class="title">{{ $job->title }}</p>
	                  <p class="salary">給与：{{ number_format($job->min_salary) }}～{{ number_format($job->max_salary) }}</p>
	                </div>
	              </div>
	            </a>
	          </div>
	          @endforeach
	        </div>

	        <div class="d-flex justify-content-center">
	          <a class="btn btn-primary mr-2" href="{{ route('jobs.index') }}">もっと見る</a>
	        </div>

	      </div>
	    </section>
	    @endif
@endsection