@extends('layouts.admin')

@section('admin_content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Admin Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Home</a></li>
              <li class="breadcrumb-item active">SEO Setting</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Info boxes -->
        <div class="row">
          <div class="col-6">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">SEO</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" action="{{route('setting.seo.update',$seo->id)}}" method="Post">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="meta_title">Meta Title</label>
                    <input type="text" class="form-control" name="meta_title" id="meta_title" placeholder="Meta Title" value="{{ $seo->meta_title}}">
                  </div>
                  <div class="form-group">
                    <label for="meta_author">Meta Author</label>
                    <input type="text" class="form-control" name="meta_author" id="meta_author" placeholder="Meta Author" value="{{ $seo->meta_author}}">
                  </div>
                  <div class="form-group">
                    <label for="meta_tag">Meta Tag</label>
                    <input type="text" class="form-control" name="meta_tag" id="meta_tag" placeholder="Meta Tag" value="{{ $seo->meta_tag}}">
                  </div>
                  <div class="form-group">
                    <label for="meta_description">Meta Description</label>
                    <textarea class="form-control" name="meta_description">{{ $seo->meta_description}}</textarea>
                  </div>
                  <div class="form-group">
                    <label for="meta_keyword">Meta Keyword</label>
                    <input type="text" class="form-control" name="meta_keyword" id="meta_keyword" placeholder="Meta Keyword" value="{{ $seo->meta_keyword}}">
                  </div>
                  <div class="form-group">
                    <small class="text-success">------Oteher Field------</small>
                  </div>
                  <div class="form-group">
                    <label for="google_verification">Google Verification</label>
                    <input type="text" class="form-control" name="google_verification" id="google_verification" placeholder="Google Verification" value="{{ $seo->google_verification}}">
                  </div>
                  <div class="form-group">
                    <label for="google_analytics">Google Analytics</label>
                    <input type="text" class="form-control" name="google_analytics" id="google_analytics" placeholder="Google Ananalytics" value="{{ $seo->google_analytics}}">
                  </div>
                  <div class="form-group">
                    <label for="google_adsense">Google Adsense</label>
                    <input type="text" class="form-control" name="google__adsense" id="google_adsense" placeholder="Google Adsense" value="{{ $seo->google_adsense}}">
                  </div>
                  <div class="form-group">
                    <label for="alexa_verification">Alexa Verification</label>
                    <input type="text" class="form-control" name="alexa_verification" id="alexa_verification" placeholder="Alexa verification" value="{{ $seo->alexa_verification}}">
                  </div>
                </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Update SEO</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection
