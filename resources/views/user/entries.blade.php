@extends('front.layouts.app')

@section('content')
	    <section class="job-block">
	      <div class="container">
          <h2>応募した求人一覧</h2>

	        @if (count($entries) > 0)
	        <div class="row job-list">
	          @foreach ($entries as $entry)
	          <div class="col-sm-6 col-md-4 col-lg-3">
	            <a href="{{route('jobs.show', ['job' => $entry->job->id])}}">
	              <div class="card">
	                <div class="card-header">
	                  @if (!empty($entry->job->icon_path))
	                  <div class="icon" style="background-image:url({{ $entry->job->icon_path }});"></div>
	                  @else
	                  <div class="icon" style="background-image:url({{ asset('/assets/front/images/no-image.png') }});"></div>
	                  @endif
	                </div>
	                <div class="card-body">
	                  <h3>会社名</h3>
	                  <p class="title">{{$entry->job->title}}</p>
	                  <p class="salary">給与：{{ number_format($entry->job->min_salary) }}～{{ number_format($entry->job->max_salary) }}</p>
	                </div>
	              </div>
	            </a>
	          </div>
	          @endforeach

					  {{ $entries->links('front.commons.pagination') }}
					@else
	      	<div class="alert alert-danger mb-3" role="alert">
		        応募した求人はありません。
			    </div>
					@endif

	      </div>
	    </section>
@endsection