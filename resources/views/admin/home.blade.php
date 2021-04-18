@extends('admin.layouts.app')

@section('content')
	    <!-- Content Header (Page header) -->
	    <div class="content-header">
	      <div class="container-fluid">
	        <div class="row mb-2">
	          <div class="col-sm-6">
	            <h1 class="m-0">ダッシュボード</h1>
	          </div><!-- /.col -->
	        </div><!-- /.row -->
	      </div><!-- /.container-fluid -->
	    </div>
	    <!-- /.content-header -->

	    <!-- Main content -->
	    <div class="content">
	      <div class="container-fluid">
	        <div class="row">
	          <div class="col-lg-3 col-6">
	            <!-- small box -->
	            <div class="small-box bg-info">
	              <div class="inner">
	                <h3>{{ number_format($userNum) }}</h3>

	                <p>ユーザ数</p>
	              </div>
	              <div class="icon">
	                <i class="fas fa-user"></i>
	              </div>
	              <a href="{{ route('admin.users.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
	            </div>
	          </div>
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-success">
                <div class="inner">
                  <h3>{{ number_format($jobNum) }}</h3>

                  <p>求人数</p>
                </div>
                <div class="icon">
                  <i class="fas fa-newspaper"></i>
                </div>
                <a href="{{ route('admin.jobs.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-warning">
                <div class="inner">
                  <h3>{{ number_format($entryNum) }}</h3>

                  <p>新規応募数</p>
                </div>
                <div class="icon">
                  <i class="far fa-address-card"></i>
                </div>
                <a href="{{ route('admin.jobs.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
	        </div>
	        <!-- /.row -->
	      </div><!-- /.container-fluid -->
	    </div>
	    <!-- /.content -->
@endsection