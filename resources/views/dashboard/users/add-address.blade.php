@extends('layouts.dashboard')
@prepend('appTitle')
    <title>{{ config('app.name') }} |  Add Address</title>
@endprepend

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.users.index') }}">Users</a></li>
                        <li class="breadcrumb-item active"><a>Add address</a></li>
                    </ol>
                </div>
                <h4 class="page-title"> Add address for {{$user->name}}  </h4>
                @include('partials.dashboard.errorsMessage')
                @include('partials.dashboard.demoMessage')

            </div>

            <div class="card">
                <div class="card-body">
                    <div class="page-title-box">
                        <form action="{{ route('dashboard.addresses.store',$user) }}" method="POST">
                            @csrf
                            <div class="row g-2">
                                <div class="mb-3 col-md-6">
                                    <label for="street_name" class="form-label">  Street name *</label>
                                    <input type="text" class="form-control  @error('street_name') is-invalid  @enderror"
                                        id="street_name" name="street_name" value="{{ old('street_name') }}">
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="city" class="form-label">  City *  </label>
                                    <input type="text" class="form-control  @error('city') is-invalid  @enderror"
                                        id="city" name="city" value="{{ old('ctty') }}">
                                </div>
                            </div>
                            <div class="row g-2">
                                <div class="mb-3 col-md-6">
                                    <label for="state" class="form-label">  State * </label>
                                    <input type="text" class="form-control  @error('state') is-invalid  @enderror"
                                        id="state" name="state" value="{{ old('state') }}">
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="zip_code" class="form-label">  Zip code * </label>
                                    <input type="text" class="form-control  @error('zip_code') is-invalid  @enderror"
                                        id="zip_code" name="zip_code" value="{{ old('zip_code') }}">
                                </div>
                            </div>
                         
                         
                            <a href="{{ route('dashboard.users.index') }}" class="btn btn-secondary">
                                Back

                            </a>
                            <button type="submit" class="btn btn-primary">
                                Add

                            </button>
                          
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

