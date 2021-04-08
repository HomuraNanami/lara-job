@extends('front.layouts.app')

@section('content')
      <section class="job-detail">
        <div class="container">
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
	          <p>{{ nl2br($job->content) }}</p>
	          <div class="information">
	            <h2>基本情報</h2>
	            <table class="table table-bordered">
	              <tbody>
	                <tr>
	                  <th>給与</th>
	                  <td>{{ number_format($job->min_salary) }}～{{ number_format($job->max_salary) }}</td>
	                </tr>
	              </tbody>
	            </table>
	          </div>
	          <div class="d-flex justify-content-center">
	            <a class="btn btn-primary mr-2" href="entry.html">応募する</a>
	          </div>
	        </div>
        </div>
      </section>
@endsection