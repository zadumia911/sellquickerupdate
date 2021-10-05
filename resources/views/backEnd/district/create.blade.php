@extends('backEnd.layouts.master')
@section('title','Create District')
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
            <li class="breadcrumb-item active"><a href="#">District</a></li>
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
                <h5>Create District</h5>
              </div>
              <div class="quick-button">
                <a href="{{url('editor/district/manage')}}" class="btn btn-primary btn-actions btn-create">
                <i class="fas fa-eye"></i> Manage
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
                      <h3 class="card-title">Create District</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form role="form" action="{{url('editor/district/save')}}" method="POST" enctype="multipart/form-data">
                      @csrf
                      <div class="card-body">
                         <div class="form-group">
                              <label>District Name</label>
                              <input type="text" name="dist_name" class="form-control{{ $errors->has('dist_name') ? ' is-invalid' : '' }}" value="{{ old('dist_name') }}">

                              @if ($errors->has('dist_name'))
                              <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('dist_name') }}</strong>
                              </span>
                              @endif
                          </div>
                        <!-- form group -->
                        <div class="form-group">
                              <label>Division</label>
                              <select name="division_id" class="form-control select2 {{ $errors->has('division_id') ? ' is-invalid' : '' }}" value="{{ old('division_id') }}">
                                <option value="">Select</option>
                                @foreach($divisions as $value)
                                <option value="{{$value->id}}">{{$value->name}}</option>
                                @endforeach
                              </select>

                              @if ($errors->has('division_id'))
                              <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('division_id') }}</strong>
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