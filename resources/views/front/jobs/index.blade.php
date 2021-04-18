@extends('front.layouts.app')

@section('content')
	    <section class="job-block">
	      <div class="container">
          <h2>求人一覧</h2>
          @if ($search_categories)
	      <div class="d-flex flex-wrap">
	        @foreach ($allCategoies as $cat)
	          @foreach ($search_categories as $sc)
	            @if ($sc == $cat->id)
	              <a class="btn btn-cat" href="{{route('jobs.index')}}?category[]={{ $cat->id }}">{{ $cat->name }}</a>
	            @endif
	          @endforeach
	        @endforeach
	      </div>
          @endif
          @if ($search_keyword)
          <p>キーワード：{{$search_keyword}}</p>
          @endif
          @if ($search_min_salary || $search_max_salary)
          <p>給与：{{$search_min_salary}} ～ {{$search_max_salary}}</p>
          @endif
          <div class="d-flex justify-content-end mb-4">
		        <button type="button" class="btn btn-secondary btn-icon" data-toggle="collapse" data-target="#search" aria-expanded="true" aria-controls="search"><i class="fas fa-search"></i></button>
	        </div>

		      <section id="search" class="search collapse">
		        <div class="container">
		          <form method="GET" action="{{route('jobs.index')}}">
		            <p>条件を指定して探す</p>
		            <div class="form-group row">
		              <label for="searchKeyword" class="col-sm-2 col-form-label">キーワード</label>
		              <div class="col-sm-10">
		                <input type="text" class="form-control" id="searchKeyword" name="keyword" value="{{$search_keyword}}">
		              </div>
		            </div>
		            <div class="form-group row">
		              <label for="searchSalary" class="col-sm-2 col-form-label">給与</label>
		              <div class="col-sm-10 form-inline">
		                <input type="number" class="form-control" name="min_salary" value="{{$search_min_salary}}">
		                <span class="ml-2 mr-2">～</span>
		                <input type="number" class="form-control" name="max_salary" value="{{$search_max_salary}}">
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
			                  <input type="checkbox" class="custom-control-input" id="searchCategory{{ $cat->id }}" name="category[]" value="{{ $cat->id }}"
			                  @if ($search_categories)
			                  @foreach($search_categories as $sc)
			                    @if ($sc == $cat->id)
			                      checked
			                    @endif
			                  @endforeach
			                  @endif
			                  >
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


	        @if (count($jobs) > 0)
	        <div class="row job-list">
	          @foreach ($jobs as $job)
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

			{{ $jobs->appends(request()->input())->links('front.commons.pagination') }}
			@else
	      	  <div class="alert alert-danger mb-3" role="alert">
		        該当する求人はありません。
			  </div>
			@endif

	      </div>
	    </section>

@endsection