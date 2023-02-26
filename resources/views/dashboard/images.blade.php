@extends('layouts.dashboard')
@prepend('appTitle')
    <title>{{ config('app.name') }} | Images</title>
@endprepend

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active"><a>Images</a></li>
                    </ol>
                </div>
                <h4 class="page-title"> Images</h4>
            </div>

            <div class="card">
                <div class="card-body">
                    <dropzone-component></dropzone-component>
                </div>
            </div>
            <div class="card">
                    <media-list-component></media-list-component>
            </div>

        </div>
    </div>
@endsection
