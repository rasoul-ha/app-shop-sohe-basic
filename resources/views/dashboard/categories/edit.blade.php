@extends('layouts.dashboard')
@prepend('appTitle')
    <title>{{ config('app.name') }} | {{ $category->title }} Edit category </title>
@endprepend

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.categories.index') }}">Categories</a></li>

                        <li class="breadcrumb-item active"><a> Edit category </a></li>
                    </ol>
                </div>
                <h4 class="page-title"> Edit category {{ $category->title }}</h4>
                @include('partials.dashboard.errorsMessage')
                @include('partials.dashboard.demoMessage')


            </div>

            <div class="card">
                <div class="card-body">
                    <div class="page-title-box">
                        <form action="{{ route('dashboard.categories.update', $category->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row g-2">
                                <div class="mb-3 col-md-12">
                                    <label for="inputTtile" class="form-label">Title *</label>
                                    <input type="text" class="form-control  @error('title') is-invalid @enderror"
                                        id="inputTtile" name="title" value="{{ $category->title }}">
                                </div>
                             
                            </div>


                            <div class="row">
                                <div class="mb-3 col-md-12">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="customCheck" name="status"
                                            @if ($category->status) checked @endif>
                                        <label class="form-check-label" for="customCheck"> Can be displayed</label>
                                    </div>

                                </div>
                            </div>

                            <a href="{{ route('dashboard.categories.index') }}" class="btn btn-secondary">
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
