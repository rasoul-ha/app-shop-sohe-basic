@extends('layouts.dashboard')
@prepend('appTitle')
    <title>{{ config('app.name') }} |  Account</title>
@endprepend

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active"><a>  Account</a></li>
                    </ol>
                </div>
                <h4 class="page-title">  Account </h4>
                @include('partials.dashboard.errorsMessage')
                @include('partials.dashboard.errorMessage')
                @include('partials.dashboard.demoMessage')


            </div>

            <div class="card">
                <div class="card-body">
                    <div class="page-title-box">
                        <form action="{{ route('dashboard.profile.update') }}" method="POST">
                            @csrf
                            @method('PUT')
                            <h5 class="mb-3 text-uppercase bg-light p-2"><i class="mdi mdi-account-edit me-1"></i>   Account </h5>
                            <div class="row g-2">
                                <div class="mb-3 col-md-6">
                                    <label for="inputName" class="form-label">  Full name *</label>
                                    <input type="text" class="form-control  @error('name') is-invalid @enderror"
                                        id="inputName" name="name" value="{{ auth()->user()->name }}">
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="inputEmail" class="form-label"> Email *</label>
                                    <input type="text" class="form-control  @error('email') is-invalid @enderror"
                                        id="inputEmail" name="email" value="{{ auth()->user()->email}}">
                                </div>
                            </div>
                            <a href="{{ route('dashboard') }}" class="btn btn-secondary">
                                Back

                            </a>
                            <button type="submit" class="btn btn-primary">
                                Update

                            </button>
                        </form>
                    </div>

                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="page-title-box">

                        <form action="{{route('dashboard.password.update')}}" method="POST">
                            @csrf
                            @method('PUT')
                            <h5 class="mb-3 text-uppercase bg-light p-2"><i class="mdi mdi-shield-lock-open me-1"></i> Password</h5>
                            <div class="row g-2">
                                <div class="mb-3 col-md-6">
                                    <label for="inputPassword" class="form-label">Current password *</label>
                                    <div class="input-group input-group-merge">
                                        <input type="password" id="current_password" name="current_password"
                                            class="form-control  @error('current_password') is-invalid @enderror">
                                        <div class="input-group-text" data-password="false">
                                            <span class="password-eye"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="inputPassword" class="form-label"> New password *</label>
                                    <div class="input-group input-group-merge">
                                        <input type="password" id="password" name="password"
                                            class="form-control  @error('password') is-invalid @enderror">
                                        <div class="input-group-text" data-password="false">
                                            <span class="password-eye"></span>
                                        </div>
                                    </div>
                                </div>
                               
                            </div>  
                            <a href="{{ route('dashboard') }}" class="btn btn-secondary">
                                Back

                            </a>
                            <button type="submit" class="btn btn-primary">
                                Update

                            </button>

                        </form>          
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
