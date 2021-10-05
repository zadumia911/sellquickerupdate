@extends('backEnd.layouts.master')
@section('title','Update Union or City Corporation')
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
            <li class="breadcrumb-item active"><a href="#">Union or Thana</a></li>
            <li class="breadcrumb-item active">Update</li>
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
                <h5>Update Union or City Corporation</h5>
              </div>
              <div class="quick-button">
                <a href="{{url('editor/union/manage')}}" class="btn btn-primary btn-actions btn-create">
                Manage
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
                      <h3 class="card-title">Update Union or City Corporation</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form role="form" action="{{url('editor/union/update')}}" method="POST" enctype="multipart/form-data" name="editForm">
                      @csrf
                      <input type="hidden" value="{{$edit_data->id}}" name="hidden_id">
                      <div class="card-body">
                        <div class="form-group">
                            <label>Union Name</label>
                            <input type="text" name="union_name" class="form-control{{ $errors->has('union_name') ? ' is-invalid' : '' }}" value="{{$edit_data->union_name}}">
                            @if ($errors->has('union_name'))
                            <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('union_name') }}</strong>
                            </span>
                            @endif
                         </div>
                        <!-- form group -->
                        <div class="form-group">
                              <label>Thanas</label>
                              <select name="thana_id" class="form-control{{ $errors->has('thana_id') ? ' is-invalid' : '' }}" value="{{ old('thana_id') }}">
                                <option value="">Select</option>
                                @foreach($thanas as $value)
                                <option value="{{$value->id}}">{{$value->thana_name}}</option>
                                @endforeach
                              </select>

                              @if ($errors->has('thana_id'))
                              <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('thana_id') }}</strong>
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
                          <button type="submit" class="btn btn-primary btn-size">Update</button>
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
    <script type="text/javascript">
      document.forms['editForm'].elements['thana_id'].value="{{$edit_data->thana_id}}"
      document.forms['editForm'].elements['status'].value="{{$edit_data->status}}"
    </script>
@endsection
