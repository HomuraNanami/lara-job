@extends('front.layouts.app')

@section('content')
	    <section class="job-block">
	      <div class="container">
          <h2>求人一覧</h2>
          <p>検索：キーワード</p>
          <div class="d-flex justify-content-end mb-4">
		        <button type="button" class="btn btn-secondary btn-icon" data-toggle="collapse" data-target="#search" aria-expanded="true" aria-controls="search"><i class="fas fa-search"></i></button>
	        </div>

		      <section id="search" class="search collapse">
		        <div class="container">
		          <form>
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
			                  <input type="checkbox" class="custom-control-input" id="searchCategory{{ $cat->id }}" name="category[]">
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
	            <a href="{{route('jobs.show', ['job' => $job->id])}}">
	              <div class="card">
	                <div class="card-header">
	                  @if (!empty($job->getOneCategory()))
	                  <div class="d-flex justify-content-end">
	                    <span class="btn btn-cat">{{ $job->getOneCategory()->name }}</span>
	                  </div>
	                  @endif

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

			{{ $jobs->links('front.commons.pagination') }}
			@endif

	      </div>
	    </section>

@endsection