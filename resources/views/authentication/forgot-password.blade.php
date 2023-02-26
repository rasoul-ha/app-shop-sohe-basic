@extends('layouts.authetication')
@prepend('appTitle')
    @prepend('appTitle')
        <title>{{ config('app.name') }} | I forgot the password</title>
    @endprepend
@endprepend

@section('content')
    <div class="auth-fluid"
    style="background-image: url('{{ \App\Models\Custom::getBgAuthentication() }}')"
     >
        <!--Auth fluid left content -->
        <div class="auth-fluid-form-box">
            <div class="align-items-center d-flex h-100">
                <div class="card-body">
                    <!-- title-->
                    <h4 class="mt-0">Change Password</h4>
                    <p class="text-muted mb-4">
                        Enter your username (mobile number) and we will send you a confirmation code to change your password.                    </p>
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            <i class="dripicons-checkmark me-2"></i> {{ session('status') }}
                        </div>
                    @endif

                    @if (session('demo_message'))
                        <div class="alert alert-warning" role="alert">
                            <i class="dripicons-checkmark me-2"></i> {{ session('demo_message') }}
                        </div>
                    @endif
                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <li class="text-danger">{{ $error }}</li>
                        @endforeach
                    @endif

                    <!-- form -->
                    <form class="needs-validation" action="{{ route('password.request') }}" novalidate method="post">
                        @csrf
                        <div class="position-relative mb-3">
                            <label for="emailUsername" class="form-label">Username </label>
                            <input class="form-control" type="text" id="emailUsername" name="username"
                                value="{{ old('username') }}" required=placeholder="Enter your username">
                            <div class="invalid-tooltip">
                                Enter your username                            </div>
                        </div>
                        <div class="mb-0 text-center d-grid">
                            <button class="btn btn-primary" type="submit"><i class="mdi mdi-link"></i>
                                Send password otp code                            </button>
                        </div>
                    </form>
                    <!-- end form-->
                    <!-- Footer-->
                    <footer class="footer footer-alt">
                        <p class="text-muted"> Back to <a href="{{ route('login') }}"
                                class="text-muted ms-1"><b>login</b></a></p>
                    </footer>


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
