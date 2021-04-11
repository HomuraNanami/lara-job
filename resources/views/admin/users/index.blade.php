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
	              <li class="breadcrumb-item active">ユーザ管理</li>
	            </ol>
            </div>
	        </div><!-- /.row -->
	      </div><!-- /.container-fluid -->
	    </div>
	    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">ユーザ一覧</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
          </div>
        </div>
        @if (count($users) > 0)
	        <div class="card-body p-0">
	          <div class="table-responsive">
		          <table class="table table-striped">
		              <thead>
		                  <tr>
		                      <th style="width: 1%">
		                          #
		                      </th>
		                      <th>
		                          名前
		                      </th>
		                      <th style="width: 30%">
		                      </th>
		                  </tr>
		              </thead>
		              <tbody>
		                  @foreach ($users as $user)
		                  <tr>
		                      <td>{{sprintf('%05d', $user->id)}}</td>
		                      <td>
		                        <div class="d-flex align-items-center with-icon">
		                        	@if (!empty($user->icon_path))
			                        	<div class="icon" style="background-image:url({{ $user->icon_path }});"></div>
			                        @else
			                          <div class="icon" style="background-image:url({{ asset('/assets/admin/images/no-image.png') }});"></div>
			                        @endif
			                        <div class="text">
			                          {{ $user->name }}
			                        </div>
			                      </div>
		                      </td>
		                      <td class="project-actions text-right">
		                          <a class="btn btn-primary btn-sm" href="{{route('admin.users.show', ['user' => $user->id])}}">
		                              <i class="fas fa-folder mr-1"></i>詳細
		                          </a>
		                      </td>
		                  </tr>
		                  @endforeach
		              </tbody>
		          </table>
	          </div>
	        </div>
	        @if ($users->hasMorePages())
	        <!-- /.card-body -->
	        <div class="card-footer">
	          {{ $users->links('admin.commons.pagination') }}
	          </nav>
	        </div>
	        @endif
			  @else
				  <div class="card-body">
	      	  <div class="alert alert-danger mb-3" role="alert">
	      		  現在、ユーザはいません。
			  		</div>
				  </div>
			  @endif
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
@endsection