@extends('backEnd.layouts.master')
@section('title','Create Pagecategory')
@section('content')
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h5 class="m-0 text-dark">Welcome !! {{auth::user()->name}}</h5>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item active"><a href="#">Pagecategory</a></li>
            <li class="breadcrumb-item active">Create</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
          <div class="col-sm-12">
            <div class="manage-button">
              <div class="body-title">
                <h5>Create Pagecategory</h5>
              </div>
              <div class="quick-button">
                <a href="{{url('editor/pagecategory/manage')}}" class="btn btn-primary btn-actions btn-create">
                Manage Pagecategory
                </a>
              </div>
            </div>
          </div>
      </div>
      <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
          <div class="box-content">
            <div class="row">
              <div class="col-sm-2"></div>
              <div class="col-lg-8 col-md-8 col-sm-8">
                  <div class="card card-primary">
                    <div class="card-header">
                      <h3 class="card-title">Create pagecategory</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form role="form" action="{{url('editor/pagecategory/save')}}" method="POST" enctype="multipart/form-data">
                      @csrf
                      <div class="card-body">
                         <div class="form-group">
                              <label>Page Name</label>
                              <input type="text" name="pagename" class="form-control{{ $errors->has('pagename') ? ' is-invalid' : '' }}" value="{{ old('pagename') }}" placeholder="Ex. terms & condigin">
                              @if ($errors->has('pagename'))
                              <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('pagename') }}</strong>
                              </span>
                              @endif
                          </div>
                          <!-- form group -->
                        <div class="form-group">
                              <label>Parent Menu</label>
                              <select name="menu_id" class="form-control select2 {{ $errors->has('menu_id') ? ' is-invalid' : '' }}" value="{{ old('menu_id') }}">
                                <option value="">=== Select Parent Menu ===</option>
                                <option value="1">About Us</option>
                                <option value="2">Others</option>
                              </select>
                              @if ($errors->has('menu_id'))
                              <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('menu_id') }}</strong>
                              </span>
                              @endif
                         </div>
                        <!-- form group -->
                        <div class="form-group">
                          <div class="custom-label">
                            <label>Publication Status</label>
                          </div>
                          <div class="box-body pub-stat display-inline">
                              <input class="form-control{{ $errors->has('status') ? ' is-invalid' : '' }}" type="radio" id="active" name="status" value="1">
                              <label for="active">Active</label>
                              @if ($errors->has('status'))
                              <span class="invalid-feedback">
                                <strong>{{ $errors->first('status') }}</strong>
                              </span>
                              @endif
                          </div>
                          <div class="box-body pub-stat display-inline">
                              <input class="form-control{{ $errors->has('status') ? ' is-invalid' : '' }}" type="radio" name="status" value="0" id="inactive">
                              <label for="inactive">Inactive</label>
                              @if ($errors->has('status'))
                              <span class="invalid-feedback">
                                <strong>{{ $errors->first('status') }}</strong>
                              </span>
                              @endif
                          </div>
                        </div>
                        <!-- /.form-group -->
                        <div class="form-group">
                          <button type="submit" class="btn btn-primary btn-size">Save</button>
                        </div>
                      </div>
                      <!-- /.card-body -->
                    </form>
                  </div>
              </div>
              <!-- col end -->
              <div class="col-sm-2"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection