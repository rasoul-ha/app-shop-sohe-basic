@extends('layouts.authetication')
@prepend('appTitle')
    @prepend('appTitle')
        <title>{{ config('app.name') }} | Password update</title>
    @endprepend
@endprepend

@section('content')
    <div class="auth-fluid" style="background-image: url('{{ \App\Models\Custom::getBgAuthentication() }}')">
        <!--Auth fluid left content -->
        <div class="auth-fluid-form-box">
            <div class="align-items-center d-flex h-100">
                <div class="card-body">
                    <!-- title-->
                    <h4 class="mt-0"> Change Password</h4>
                    <p class="text-muted mb-4">
                        Enter the new password
                    </p>


                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <li class="text-danger">{{ $error }}</li>
                        @endforeach
                    @endif
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

                    <!-- form -->
                    <form class="needs-validation" action="{{ route('password.update') }}" method="post" novalidate>
                        @csrf
                        <div class="position-relative mb-3">
                            <label for="username" class="form-label">username</label>
                            <input class="form-control" type="text" id="username" required=""
                                value="{{ $username }}" readonly name="username" placeholder=" Enter the username">
                            <div class="invalid-tooltip">
                                Enter the username
                            </div>
                        </div>

                        <div class="position-relative mb-3">
                            <label for="code" class="form-label"> OTP Code </label>
                            <input class="form-control" type="text" id="code" required="" name="code"
                                placeholder="Enter the confirmation code">
                            <div class="invalid-tooltip">
                                Enter the confirmation code
                            </div>
                        </div>
                        <div class="position-relative mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input class="form-control" type="password" required="" id="password" name="password"
                                placeholder="Enter the password">
                            <div class="invalid-tooltip">
                                Enter the password
                            </div>
                        </div>

                        <div class="d-grid mb-0 text-center">
                            <button class="btn btn-primary" type="submit"><i class="mdi mdi-update   "></i> Change Password
                            </button>
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
