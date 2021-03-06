@extends('admin.layouts.auth')

@section('content')
    <style>
        .error
        {
            color:red;
        }
    </style>
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div style="width: 50%; margin:0 auto;">
                <img class="img_logo" src="{{ asset('public/quickadmin/images/admin-logo.png') }}"/>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="panel panel-default">
                <div class="panel-heading login_heading">Login</div>
                <div class="panel-body">
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> There were problems with input:
                            <br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    
                    <form class="form-horizontal"
                          role="form" id="login"
                          method="POST"
                          action="{{ url('admin/login') }}">
                        <input type="hidden"
                               name="_token"
                               value="{{ csrf_token() }}">
                        
                        <div class="form-group">
                            <label class="col-md-3 control-label">Email</label>
                            
                            <div class="col-md-8">
                                <input type="email"
                                       class="form-control"
                                       name="email"
                                       value="{{ old('email') }}">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-3 control-label">Password</label>
                            
                            <div class="col-md-8">
                                <input type="password"
                                       class="form-control"
                                       name="password">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-3">
                                <label class="pull-left">
                                    <input type="checkbox"
                                           name="remember"> Remember me
                                </label>
                                <label class="pull-right" style="display: none;">
                                    <a href="#"> Forget Password</a>
                                </label>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit"
                                        class="btn btn-primary"
                                        style="margin-right: 15px;">
                                    Login
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('javascript')
    <script type="text/javascript">
        $(document).ready(function ()
        {
            $("#login").validate(
                {
                    rules:
                        {
                            email: {
                                "email": true ,
                                "required": true
                            },
                            password: {
                                "required": true,
                                "minlength": 2,
                            }
                        }
                }
            );
        });
    </script>
@endsection