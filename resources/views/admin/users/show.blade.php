@extends('admin.layouts.app')

@section('content')
	    <!-- Content Header (Page header) -->
	    <div class="content-header">
	      <div class="container-fluid">
	        <div class="row mb-2">
	          <div class="col-sm-6">
	            <h1 class="m-0">ユーザ管理</h1>
	          </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">ユーザ管理</a></li>
                <li class="breadcrumb-item active">ユーザ詳細</li>
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
      <div class="card mb-4">
        <div class="card-header">
          <h3 class="card-title">ユーザ詳細</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
          </div>
        </div>
        <div class="card-body p-0 user-profile">
          <div class="profile-header">
	          <div class="d-flex justify-content-center align-items-center">
	            @if (!empty($user->icon_path))
	              <div class="icon" style="background-image:url({{ $user->icon_path }});"></div>
	            @else
	              <div class="icon" style="background-image:url({{ asset('/assets/admin/images/no-image.png') }});"></div>
	            @endif
	          </div>
	          <p class="name">{{ $user->name }}</p>
	        </div>
	        <div class="profile-body">
	          <table class="table">
						  <tbody>
						    <tr>
						      <th scope="row">メールアドレス</th>
						      <td>{{ $user->email }}</td>
						    </tr>
                <tr>
                  <th scope="row">学歴</th>
                  <td>{{config("const.Users.FINAL_EDUCATION_LIST")[$user->final_education]}}</td>
                </tr>
						  </tbody>
						</table>
	        </div>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">応募した求人一覧</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
          </div>
        </div>
        @if (count($entries) > 0)
	        <div class="card-body p-0">
	          <form method="post" action="{{route('admin.users.change-entries-status', ['user' => $user->id])}}">
	          	@csrf
	            <div class="d-flex p-3 align-items-center flex-wrap flex-sm-nowrap">
	              <div class="form-group mb-2 mb-sm-0">
		              <select class="form-control" name="status">
		                <option selected value="-1">ステータス変更</option>
		                @foreach(config('const.Entries.STATUS_LIST') as $key=>$value)
		                <option value="{{$key}}">{{$value}}</option>
		                @endforeach
		              </select>
	              </div>
	              <button type="submit" class="btn btn-secondary btn-sm ml-sm-2">チェックしたものを変更</button>
		          </div>
	          <div class="table-responsive">
	            <table class="table table-striped">
	                <thead>
	                    <tr>
	                        <th style="width: 1%">
	                        </th>
	                        <th style="width: 20%">
	                            応募日時
	                        </th>
	                        <th>
	                            求人タイトル
	                        </th>
	                        <th style="width: 5%">
	                        </th>
	                        <th style="width: 15%">
	                        </th>
	                    </tr>
	                </thead>
	                <tbody>
	                    @foreach ($entries as $entry)
	                    <tr>
	                        <td>
	                          <div class="form-check">
	                            <input class="form-check-input position-static" type="checkbox" name="entryIdList[]" value="{{$entry->id}}">
	                          </div>
	                        </td>
	                        <td>{{ $entry->created_at }}</td>
	                        <td>
	                          <div class="d-flex align-items-center with-icon">
	                        	@if (!empty($entry->job->icon_path))
		                        	<div class="icon" style="background-image:url({{ $entry->job->icon_path }});"></div>
		                        @else
		                          <div class="icon" style="background-image:url({{ asset('/assets/admin/images/no-image.png') }});"></div>
		                        @endif
	                            <div class="text">
	                              {{ $entry->job->title }}
	                            </div>
	                          </div>
	                        </td>
	                        <td><span class="badge {{ config('const.Entries.STATUS_BADGE_LIST')[$entry->status] }}">{{ config('const.Entries.STATUS_LIST')[$entry->status] }}</span></td>
	                        <td class="project-actions text-right">
	                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#entryDetailModal{{$entry->id}}">
	                                <i class="fas fa-folder">
	                                </i>
	                                詳細
	                            </button>
	                        </td>
	                    </tr>
	                    @endforeach
	                </tbody>
	            </table>
	          </div>
	          </form>
	        </div>
	        @if ($entries->hasMorePages())
	        <!-- /.card-body -->
	        <div class="card-footer">
	          {{ $entries->links('admin.commons.pagination') }}
	          </nav>
	        </div>
	        @endif
        @else
		  <div class="card-body">
      	<div class="alert alert-danger mb-3" role="alert">
	        現在、応募した求人はいません。
				</div>
		  </div>
        @endif
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->

@foreach ($entries as $entry)
<!-- Modal -->
<div class="modal fade" id="entryDetailModal{{$entry->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">応募情報</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body p-0">
      　<table class="table">
		  <tbody>
		    <tr>
		      <th scope="row">応募日時</th>
		      <td>{{ $entry->created_at }}</td>
		    </tr>
            <tr>
              <th scope="row">求人タイトル</th>
              <td>{{ $entry->job->title }}</td>
            </tr>
            <tr>
              <th scope="row">ステータス</th>
              <td><span class="badge {{ config('const.Entries.STATUS_BADGE_LIST')[$entry->status] }}">{{ config('const.Entries.STATUS_LIST')[$entry->status] }}</span></td>
            </tr>
            <tr>
              <th scope="row">応募メッセージ</th>
              <td>{{ nl2br($entry->message) }}</td>
            </tr>
		  </tbody>
		</table>
      	
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
@endforeach

@endsection