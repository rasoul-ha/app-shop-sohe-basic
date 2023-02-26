@extends('layouts.dashboard')
@prepend('appTitle')
    <title>{{ config('app.name') }} | {{ __('Add banner') }}</title>
@endprepend

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.banners.index') }}">Banners</a></li>

                        <li class="breadcrumb-item active"><a>Add banner </a></li>
                    </ol>
                </div>
                <h4 class="page-title"> Add banner </h4>
                @include('partials.dashboard.errorsMessage')
                @include('partials.dashboard.demoMessage')

            </div>

            <div class="card">
                <div class="card-body">
                    <div class="page-title-box">
                        <form action="{{ route('dashboard.banners.store') }}" method="POST">
                            @csrf
                            <banner-component :categories={{$categories}}></banner-component>

                            
                            <image-input-component title="Image(45X651)" :is-required={{ true }}>
                            </image-input-component>

                            <div class="row">
                                <div class="mb-3 col-md-12">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="customCheck" name="status"
                                            checked>
                                        <label class="form-check-label" for="customCheck">Can be displayed</label>
                                    </div>
                                </div>

                            </div>

                            <a href="{{ route('dashboard.banners.index') }}" class="btn btn-secondary">
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
