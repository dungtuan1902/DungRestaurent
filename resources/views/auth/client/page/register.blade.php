@extends('auth.client.layout.index')
@section('content')
    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <a class="col-lg-5 d-none d-lg-block bg-register-image" href="{{ route('client.main') }}"></a>
                <div class="col-lg-7">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                        </div>
                        <form class="user" action="{{ route('client.register') }}" method="POST">
                            @csrf
                            <div class="form-group row ">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="text" class="form-control form-control-user" name="firstname"
                                        id="exampleFirstName" placeholder="First Name" value="{{ old('firstname') }}">
                                    @if ($errors->has('firstname'))
                                        <div class=" form-text text-danger">{{ $errors->first('firstname') }}</div>
                                    @endif
                                </div>

                                <div class="col-sm-6">
                                    <input type="text" class="form-control form-control-user" name="lastname"
                                        id="exampleLastName" placeholder="Last Name" value="{{ old('lastname') }}">
                                    @if ($errors->has('lastname'))
                                        <div class=" form-text text-danger ">{{ $errors->first('lastname') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control form-control-user" name="email"
                                    id="exampleInputEmail" placeholder="Email Address" value="{{ old('email') }}">
                                @if ($errors->has('email'))
                                    <div class=" form-text text-danger ">{{ $errors->first('email') }}</div>
                                @endif
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="password" class="form-control form-control-user" name="password"
                                        id="exampleInputPassword" placeholder="Password" value="{{ old('password') }}">
                                    @if ($errors->has('password'))
                                        <div class=" form-text text-danger ">{{ $errors->first('password') }}</div>
                                    @endif
                                </div>
                                <div class="col-sm-6">
                                    <input type="password" class="form-control form-control-user" name="confirm_password"
                                        id="exampleRepeatPassword" placeholder="Repeat Password"
                                        value="{{ old('confirm_password') }}">
                                    @if ($errors->has('confirm_password'))
                                        <div class=" form-text text-danger ">{{ $errors->first('confirm_password') }}</div>
                                    @endif
                                </div>
                            </div>
                            <button class="btn btn-primary btn-user btn-block">
                                Register Account
                            </button>
                            <hr>
                            <a href="index.html" class="btn btn-google btn-user btn-block">
                                <i class="fab fa-google fa-fw"></i> Register with Google
                            </a>
                            <a href="index.html" class="btn btn-facebook btn-user btn-block">
                                <i class="fab fa-facebook-f fa-fw"></i> Register with Facebook
                            </a>
                        </form>
                        <hr>
                        <div class="text-center">
                            <a class="small" href="{{ route('client.forgot') }}">Forgot Password?</a>
                        </div>
                        <div class="text-center">
                            <a class="small" href="{{ route('client.login') }}">Already have an account? Login!</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
