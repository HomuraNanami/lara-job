@extends('admin.layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">求人管理</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
              <li class="breadcrumb-item active">求人管理</li>
            </ol>
          </div>
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->

      <div class="d-flex justify-content-end align-items-center mb-2">
        <a class="btn btn-primary" href="{{ route('admin.jobs.create') }}"><i class="fas fa-plus-circle mr-1"></i>新規追加</a>
      </div>
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">求人一覧</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
          </div>
        </div>
        @if (count($jobs) > 0)
        <div class="card-body p-0">
          <div class="table-responsive">
	          <table class="table table-striped">
	              <thead>
	                  <tr>
	                      <th style="width: 1%">
	                          #
	                      </th>
	                      <th>
	                          求人タイトル
	                      </th>
	                      <th style="width: 30%">
	                      </th>
	                  </tr>
	              </thead>
	              <tbody>
	                  @foreach ($jobs as $job)
	                  <tr>
	                      <td>{{sprintf('%05d', $job->id)}}</td>
	                      <td>
                          <div class="d-flex align-items-center with-icon">
	                        	@if (!empty($job->icon_path))
		                        	<div class="icon" style="background-image:url({{ $job->icon_path }});"></div>
		                        @else
		                          <div class="icon" style="background-image:url({{ asset('/assets/admin/images/no-image.png') }});"></div>
		                        @endif
                            <div class="text">
                              {{ $job->title }}
                            </div>
                          </div>
	                      </td>
	                      <td class="project-actions text-right">
	                          <a class="btn btn-primary btn-sm" href="{{route('admin.jobs.show', ['job' => $job->id])}}">
	                              <i class="fas fa-folder mr-1"></i>詳細
	                          </a>
	                          <a class="btn btn-info btn-sm" href="{{route('admin.jobs.edit', ['job' => $job->id])}}">
	                              <i class="fas fa-pencil-alt mr-1"></i>編集
	                          </a>
	                      </td>
	                  </tr>
	                  @endforeach
	              </tbody>
	          </table>
          </div>
        </div>
        <!-- /.card-body -->
	        @if ($jobs->hasMorePages())
	        <div class="card-footer">
	          {{ $jobs->links('admin.commons.pagination') }}
	          </nav>
	        </div>
	        @endif
			  @else
				  <div class="card-body">
	      	  <div class="alert alert-danger mb-3" role="alert">
	      		  現在、求人はありません。
			  		</div>
				  </div>
			  @endif
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
@endsection