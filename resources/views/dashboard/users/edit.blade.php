@extends('layouts.dashboard')
@prepend('appTitle')
    <title>{{ config('app.name') }} |  Edit user </title>
@endprepend

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.users.index') }}">Users</a></li>
                        <li class="breadcrumb-item active"><a> Edit user </a></li>
                    </ol>
                </div>
                <h4 class="page-title"> Edit user : {{ $user->email }}</h4>
                @include('partials.dashboard.errorsMessage')
                @include('partials.dashboard.demoMessage')

            </div>

            <div class="card">
                <div class="card-body">
                    <div class="page-title-box">
                        <form action="{{ route('dashboard.users.update', $user->id) }}" method="POST">
                            @csrf
                            @method('put')
                            <div class="row g-2">
                                <div class="mb-3 col-md-6">
                                    <label for="name" class="form-label">Full name *</label>
                                    <input type="text" class="form-control  @error('name') is-invalid  @enderror"
                                        id="name" name="name" value="{{ $user->name }}">
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label for="email" class="form-label">Email *</label>
                                    <input type="text" class="form-control  @error('email') is-invalid  @enderror"
                                        id="email" name="email" value="{{ $user->email }}">
                                </div>
                            </div>
                     
                            <a href="{{ route('dashboard.users.index') }}" class="btn btn-secondary">
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
