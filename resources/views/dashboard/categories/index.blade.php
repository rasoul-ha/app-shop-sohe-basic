@extends('layouts.dashboard')
@prepend('appTitle')
    <title>{{ config('app.name') }} | {{ __('Categories') }}</title>
@endprepend


@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active"><a>Categories</a></li>
                    </ol>
                </div>
                <h4 class="page-title">List of categories</h4>
                @include('partials.dashboard.demoMessage')

            </div>

            <div class="card">
                <div class="card-body">
                    <div class="page-title-box">
                        <a href="{{ route('dashboard.categories.create') }}" class="btn btn-primary mb-2">
                            <i class=dripicons-plus></i>
                            Add category </a>
                        @if (count($categories))
                            <div class="table-responsive">
                                <table class="table text-center  table-centered mb-0 table-sm table-striped">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>Row</th>
                                            <th> Title </th>
                                            <th>Display status</th>
                                            <th>Created at</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($categories as $key => $category)
                                            <tr>
                                                <td>{{ $categories->firstItem() + $key }}</td>
                                                <td>{{ $category->title }}</td>
   
                                                <td>
                                                    @if ($category->status)
                                                        <div class="badge bg-success">Active</div>
                                                    @else
                                                        <div class="badge bg-danger">Inactive </div>
                                                    @endif
                                                </td>

                                                <td>{{ $category->created_at }}</td>
                                                <td>

                                                    <a href="{{ route('dashboard.categories.edit', $category->id) }}"
                                                        class="action-icon">
                                                        <i class="mdi mdi-square-edit-outline"></i></a>

                                                    <a href="javascript:void(0);" class="action-icon"
                                                        onclick="deleteData('Category',`{{ $category->id }}`,`{{ $category->title }}`)">
                                                        <i class="mdi mdi-delete"></i></a>

                                                    <form id="delete-form-{{ $category->id }}"
                                                        action="{{ route('dashboard.categories.destroy', $category->id) }}"
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
                                {{ $categories->links('partials.dashboard.pagination-custom') }}
                            </div>
                        @else
                            <div class="alert alert-info  " role="alert">
                                <i class="dripicons-information me-2"></i> The list of categories is empty
                            </div>
                        @endif

                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
