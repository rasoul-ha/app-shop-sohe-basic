@extends('layouts.dashboard')
@prepend('appTitle')
    <title>{{ config('app.name') }} | {{ __('Banners') }}</title>
@endprepend

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active"><a>Banners</a></li>
                    </ol>
                </div>
                <h4 class="page-title">List of banners</h4>
                @include('partials.dashboard.demoMessage')

            </div>

            <div class="card">
                <div class="card-body">
                    <div class="page-title-box">
                        <a href="{{ route('dashboard.banners.create') }}" class="btn btn-primary mb-2">
                            <i class=dripicons-plus></i>
                            Add banner </a>
                        @if (count($banners))
                            <div class="table-responsive">
                                <table class="table text-center  table-centered mb-0 table-sm table-striped">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>Row</th>
                                            <th> Image </th>
                                            <th> Category </th>
                                            <th> Product </th>

                                            <th>Display status</th>
                                            <th>Created at</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($banners as $key => $banner)
                                            <tr>
                                                <td>{{ $banners->firstItem() + $key }}</td>
                                                <td>
                                                    @if ($banner->entity)
                                                        <img src="{{ $banner->entity->image->path }}"
                                                            alt="{{ $banner->product->title }}" title="{{ $banner->product->title }}"
                                                            class="rounded me-3" height="48">
                                                    @else
                                                        <img src="{{ asset('assets/no-image.png') }}"
                                                            alt="{{ $banner->product->title }}" title="{{ $banner->product->title }}"
                                                            class="rounded me-3" height="48">
                                                    @endif
                                                </td>
                                                <td>{{ $banner->category->title }}</td>
                                                <td><a target="blank" href="{{route('dashboard.products.edit', $banner->product->id)}}">{{$banner->product->title}}</a></td>

                                                <td>
                                                    @if ($banner->status)
                                                        <div class="badge bg-success">Active</div>
                                                    @else
                                                        <div class="badge bg-danger">Inactive </div>
                                                    @endif
                                                </td>

                                                <td>{{ $banner->created_at }}</td>
                                                <td>

                                                    <a href="{{ route('dashboard.banners.edit', $banner->id) }}"
                                                        class="action-icon">
                                                        <i class="mdi mdi-square-edit-outline"></i></a>

                                                    <a href="javascript:void(0);" class="action-icon"
                                                        onclick="deleteData('Category',`{{ $banner->id }}`,`{{ $banner->title }}`)">
                                                        <i class="mdi mdi-delete"></i></a>

                                                    <form id="delete-form-{{ $banner->id }}"
                                                        action="{{ route('dashboard.banners.destroy', $banner->id) }}"
                                                        method="POST" class="d-none">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>

                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                            </div>

                            <div class="d-flex justify-content-center align-items-center mt-2">
                                {{ $banners->links('partials.dashboard.pagination-custom') }}
                            </div>
                        @else
                            <div class="alert alert-info  " role="alert">
                                <i class="dripicons-information me-2"></i> The list of banners is empty
                            </div>
                        @endif

                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
