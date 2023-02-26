@extends('layouts.authetication')
@prepend('appTitle')
    @prepend('appTitle')
        <title>{{ config('app.name') }} | Login</title>
    @endprepend
@endprepend
@section('content')
    <div class="auth-fluid" style="background-image: url('{{ \App\Models\Custom::getBgAuthentication() }}')">
        <!--Auth fluid left content -->
        <div class="auth-fluid-form-box">
            <div class="align-items-center d-flex h-100">
                <div class="card-body">

                    <!-- title-->
                    <h4 class="mt-0"> Login</h4>
                    <p class="text-muted mb-4">
                        Enter your username and password to access your account. </p>
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            <i class="dripicons-checkmark me-2"></i> {{ session('status') }}
                        </div>
                    @endif
                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <li class="text-danger">{{ $error }}</li>
                        @endforeach
                    @endif

                    <!-- form -->
                    <form class="needs-validation" action="{{ route('login') }}" method="post" novalidate>
                        @csrf
                        <div class="position-relative mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input class="form-control" type="text" id="username" name="username"
                                value="{{ old('username') }}" required placeholder="Enter your username">
                            <div class="invalid-tooltip">
                                Enter the username </div>

                        </div>
                        <div class="position-relative mb-3">
                            <a href="{{ route('forgotpasswordform') }}" class="text-muted float-end"><small>Forgot your
                                    password?</small></a>
                            <label for="password" class="form-label">Password</label>
                            <input class="form-control" type="password" required id="password" name="password"
                                placeholder="Enter the password">
                            <div class="invalid-tooltip">
                                Enter the password
                            </div>

                        </div>
                        <div class="mb-3">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="checkbox-signin" name="remember">
                                <label class="form-check-label" for="checkbox-signin">remember me</label>
                            </div>
                        </div>
                        <div class="d-grid mb-0 text-center">
                            <button class="btn btn-primary" type="submit"><i class="mdi mdi-login"></i> Login </button>
                        </div>
                    </form>
                    <!-- end form-->


                </div> <!-- end .card-body -->
            </div> <!-- end .align-items-center.d-flex.h-100-->
        </div>
        <!-- end auth-fluid-form-box-->

        <!-- Auth fluid right content -->
        <div class="auth-fluid-right text-center">

        </div>
        <!-- end Auth fluid right content -->
    </div>
@endsection
