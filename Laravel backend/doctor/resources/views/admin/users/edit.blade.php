@extends('admin.layout.default')

@section('content')
    <div class="main-header">
        <div class="sec-page">
          <div class="page-title">
            <h2>User</h2>
          </div>
          <div class="page-options">
            <a class="waves-effect waves-set page-opt-dropBtn setWave btn-floating" href="#"><i class="material-icons">perm_data_setting</i></a>
            <a class="waves-effect waves-set page-opt-dropBtn setWave btn-floating" href="#"><i class="material-icons">chat_bubble_outline</i></a>
        </div>
        </div>
        <!-- ============================-->
        <!-- breadcrumb-->
        <!-- ============================-->
        <div class="sec-breadcrumb">
          <nav class="breadcrumbs-nav left">
            <div class="nav-wrapper">
              <div class="col s12">
                <a class="breadcrumb" href="{{ url('admin/') }}">Home</a>
                <a class="breadcrumb" href="{{ url('admin/user') }}">Users</a>
                <a class="breadcrumb" href="#">Edit User</a>
              </div>
            </div>
          </nav>
        </div>
    </div>
    <div class="main-container">
        <div class="row" style="margin-top:10px !important;">
            {{--  Flash Message  --}}
            <div class="col s12">
                @include('flash')
            </div>
            {{--  PROFILE UPDATE  --}}
            <form class="col m8 push-m2 s12 profile-info-form" role="form" method="POST" action="{{ url('/admin/user/'.$user->id) }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                {{ method_field('PUT') }}
                <div class="card-panel profile-form-cardpanel">
                    <div class="row box-title">
                        <div class="col s12">
                            <h5>Add User</h5>
                        </div>
                    </div>
                    <div class="row">
                        {{--  User Firstname  --}}
                        <div class="input-field col s12">
                            <i class="material-icons prefix">person</i>
                            <input type="text" id="name" name="name" value="{{ $user->name }}">
                            <label for="name">Name</label>
                            @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>

                        {{--  User EMAIL  --}}
                        <div class="input-field col s12">
                            <i class="material-icons prefix">email</i>
                            <input class="validate" type="email" id="email" name="email" value="{{ $user->email }}">
                            <label for="email">Email</label>
                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                        {{--  PICTURE  --}}
                        <div class="input-field col s12">
                            <img-fileinput imgsrc="{{ $picture }}"></img-fileinput>
                            @if ($errors->has('pic'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('pic') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12 right-align">
                            <button class="btn waves-effect waves-set" type="submit" name="update_profile"> Update User
                                <i class="material-icons left">save</i>
                            </button>
                            <a type="button" href="{{ url('/admin/user') }}" class="btn waves-effect waves-set info-bg">
                                Cancel
                            </a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection
