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
              <li class="breadcrumb-item"><a href="{{ route('admin.jobs.index') }}">求人管理</a></li>
              <li class="breadcrumb-item active">カテゴリ管理</li>
            </ol>
          </div>
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">

      @if (session('message'))
      	<div class="alert {{session('message-class')}} mb-3" role="alert">
	        {{session('message')}}
				</div>
			@endif

      <!-- Default box -->
      @if(empty($targetCategory))
        <form method="post" action="{{ route('admin.jobs.categories.store') }}">
      @else
        <form method="post" action="{{ route('admin.jobs.categories.update', ['category' => $targetCategory->id]) }}">
        @method('PUT')
      @endif
      @csrf
      <div class="card mb-4">
        <div class="card-header">
          <h3 class="card-title">カテゴリ@if(empty($targetCategory))新規追加@else編集@endif</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
          </div>
        </div>
        <div class="card-body job-edit">

					@if ($errors->any())
					    <div class="alert alert-danger">
					        <ul>
					            @foreach ($errors->all() as $error)
					                <li>{{ $error }}</li>
					            @endforeach
					        </ul>
					    </div>
					@endif

          <div class="form-group row">
            <label for="inputTitle" class="col-sm-3 col-form-label">カテゴリ名</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" id="inputTitle" name="name" value="@if(!empty($targetCategory)){{$targetCategory->name}}@endif">
            </div>
          </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
          <div class="d-flex justify-content-center">
            <button type="submit" class="btn btn-primary">保存</button>
          </div>
        </div>

      </div>
      <!-- /.card -->
      </form>

      <div class="card">
        <div class="card-header">
          <h3 class="card-title">カテゴリ一覧</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
          </div>
        </div>
        @if (count($categories))
	        <div class="card-body p-0">
	          <div class="table-responsive">
	            <table class="table table-striped">
	                <thead>
	                  <tr>
	                    <th style="width: 1%">
	                      #
	                    </th>
	                    <th>
	                      カテゴリ名
	                    </th>
	                    <th style="width: 30%">
	                    </th>
	                  </tr>
	                </thead>
	                <tbody>
	                  @foreach ($categories as $category)
	                  <tr>
	                    <td>{{sprintf('%05d', $category->id)}}</td>
	                    <td>{{ $category->name }}</td>
	                    <td class="project-actions text-right">
	                      <a class="btn btn-info btn-sm" href="{{ route('admin.jobs.categories.show', ['category' => $category->id]) }}">
	                          <i class="fas fa-pencil-alt mr-1"></i>編集
	                      </a>
	                      <form class="d-inline-block" method="post" action="{{ route('admin.jobs.categories.destroy', ['category' => $category->id]) }}">
	                      	@method('DELETE')
	                      	@csrf
		                      <button type="submit" class="btn btn-danger btn-sm d-inline-block">
		                          <i class="fas fa-trash mr-1"></i>削除
		                      </button>
	                      </form>
	                    </td>
	                  </tr>
	                  @endforeach
	                </tbody>
	            </table>
	          </div>
	        </div>
        @else
				  <div class="card-body">
	      	  <div class="alert alert-danger mb-3" role="alert">
	      		  現在、カテゴリがありません。
			  		</div>
				  </div>
        @endif
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
@endsection