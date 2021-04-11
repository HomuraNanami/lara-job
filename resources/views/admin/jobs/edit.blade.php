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
              <li class="breadcrumb-item active">求人詳細</li>
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
      <div class="d-flex justify-content-end align-items-center mb-2">
      	@if (!empty($job->id))
        <a class="btn btn-primary" href="{{ route('admin.jobs.show', ['job' => $job->id]) }}"><i class="fas fa-folder mr-1"></i>詳細</a>
        @endif
      </div>

      @if (!empty($job->id))
        <form method="POST" action="{{ route('admin.jobs.update', ['job' => $job->id]) }}">
        @method('PUT')
      @else
        <form method="POST" action="{{ route('admin.jobs.store') }}">
      @endif
      @csrf
      <div class="card mb-4">
        <div class="card-header">
          <h3 class="card-title">求人@if (!empty($job->id))編集@else新規追加@endif</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
          </div>
        </div>
        <div class="card-body job-edit">

          <div class="form-group row">
            <label for="inputTitle" class="col-sm-3 col-form-label">タイトル</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" id="inputTitle" name="title" value="{{ $job->title }}">
            </div>
          </div>
          <div class="form-group row">
            <label for="inputCompany" class="col-sm-3 col-form-label">会社名</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" id="inputCompany" name="company_name" value="{{ $job->company_name }}">
            </div>
          </div>
          <div class="form-group row">
            <label for="" class="col-sm-3 col-form-label">アイコン</label>
            <div class="col-sm-9">
	            <div class="d-flex justify-content-center align-items-center">
              	@if (!empty($job->icon_path))
                	<div class="icon" style="background-image:url({{ $job->icon_path }});"></div>
                @else
                  <div class="icon" style="background-image:url({{ asset('/assets/admin/images/no-image.png') }});"></div>
                @endif
	            </div>
              <div class="custom-file">
                //<input type="file" class="custom-file-input" id="inputIcon" name="icon" value="" accept="image/*">
                <label class="custom-file-label" for="inputIcon" aria-describedby="inputIconAddon01" data-browse="ファイル選択">Choose file</label>
              </div>
            </div>
          </div>
          <div class="form-group row">
            <label for="inputCategory" class="col-sm-3 col-form-label">カテゴリ</label>
            <div class="col-sm-9">
              <div class="row">
                @foreach($categories as $category)
                <div class="col-md-4">
                  <div class="custom-control custom-checkbox my-1 mr-sm-2">
                    <input type="checkbox" class="custom-control-input" id="inputCategory{{$category->id}}" name="category[]" value="{{$category->id}}"
											@if(count($job->categories))
											  @foreach($job->categories as $jc)
											    @if($jc->id == $category->id)
											      checked
											    @endif
											  @endforeach
											@endif
                    >
                    <label class="custom-control-label" for="inputCategory{{$category->id}}">{{$category->name}}</label>
                  </div>
                </div>
                @endforeach
              </div>
            </div>
          </div>
          <div class="form-group row">
            <label for="inputMinSalary" class="col-sm-3 col-form-label">給与（下限）</label>
            <div class="col-sm-9">
              <input type="number" class="form-control" id="inputMinSalary" name="min_salary" value="{{$job->min_salary}}">
            </div>
          </div>
          <div class="form-group row">
            <label for="inputMaxSalary" class="col-sm-3 col-form-label">給与（上限）</label>
            <div class="col-sm-9">
              <input type="number" class="form-control" id="inputMaxSalary" name="max_salary" value="{{$job->max_salary}}">
            </div>
          </div>
          <div class="form-group row">
            <label for="textareaContent" class="col-sm-3 col-form-label">求人内容</label>
            <div class="col-sm-9">
              <textarea class="form-control" id="textareaContent" name="content" rows="10">{{$job->content}}</textarea>
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
    </section>
    <!-- /.content -->
@endsection