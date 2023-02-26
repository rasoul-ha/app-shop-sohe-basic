@extends('layouts.dashboard')
@prepend('appTitle')
    <title>{{ config('app.name') }} | Settings</title>
@endprepend

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active"><a> Settings</a></li>
                    </ol>
                </div>
                <h4 class="page-title"> Settings </h4>
                @include('partials.dashboard.errorsMessage')
                @include('partials.dashboard.demoMessage')

            </div>

            <div class="card">
                <div class="card-body">
                    <div class="page-title-box">
                        <form action="{{ route('dashboard.settings.update') }}" method="POST">
                            @csrf
                            @method('PUT')
                            <h5 class="mb-3 text-uppercase bg-light p-2"><i class="mdi mdi-application-edit me-1"></i>
                                General information
                            </h5>
                            <div class="row g-2">

                                <div class="mb-3  col-md-6">
                                    <label for="inputName" class="form-label">Name app *</label>
                                    <input type="text" class="form-control  @error('app_name') is-invalid @enderror"
                                        id="inputName" name="app_name" value="{{ $settings['app_name'] }}">
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="inputMobile" class="form-label"> Phone Call </label>
                                    <input type="text" class="form-control  @error('app_mobile') is-invalid @enderror"
                                        id="inputMobile" name="app_mobile" value="{{ $settings['app_mobile'] }}">
                                </div>
                            </div>
                            <div class="row g-2">
                                <div class="mb-3 col-md-6">
                                    <label for="app_tax" class="form-label"> Tax percent</label>
                                    <input type="text" class="form-control  @error('app_tax') is-invalid @enderror"
                                        id="app_tax" name="app_tax" value="{{ $settings['app_tax'] }}" placeholder="eg:10">
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label for="inputShippingCost" class="form-label">Shipping cost (in USD)</label>
                                    <input type="text"
                                        class="form-control  @error('app_shipping_cost') is-invalid @enderror"
                                        id="inputShippingCost" name="app_shipping_cost"
                                        value="{{ $settings['app_shipping_cost'] }}">
                                    <span class="help-block"><small>An empty field equals free shipping</small></span>

                                </div>

                            </div>
                            <div class="row g-2">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="social-insta" class="form-label">Instagram</label>
                                        <div class="input-group ">
                                            <span class="input-group-text"><i class="mdi mdi-instagram"></i></span>
                                            <input type="text" class="form-control @error('app_instagram') is-invalid @enderror"
                                             id="social-insta"
                                                name="app_instagram" value="{{ $settings['app_instagram'] }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="inputAddress" class="form-label"> Address </label>
                                    <input type="text" class="form-control  @error('app_address') is-invalid @enderror"
                                        id="inputAddress" name="app_address" value="{{ $settings['app_address'] }}">
                                </div>

                            </div>

                 

                            <h5 class="mb-3 text-uppercase bg-light p-2"><i class="mdi mdi-camera me-1"></i> Images </h5>

                            <settings-image-input-component bg_authentication="{{ $settings['app_bg_authentication'] }}"
                                logo="{{ $settings['app_logo'] }}"
>
                            </settings-image-input-component>


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
