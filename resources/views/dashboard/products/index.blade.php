@extends('layouts.dashboard')
@prepend('appTitle')
    <title>{{ config('app.name') }} | Products</title>
@endprepend

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active"><a>Products</a></li>
                    </ol>
                </div>
                <h4 class="page-title">List of products</h4>
                @include('partials.dashboard.demoMessage')

            </div>

            <div class="card">
                <div class="card-body">
                    <div class="page-title-box">
                        <a href="{{ route('dashboard.products.create') }}" class="btn btn-primary mb-2">
                            <i class=dripicons-plus></i>
                            Add product

                        </a>
                        @if (count($products))
                            <div class="table-responsive">
                                <table class="table text-center  table-centered mb-0 table-sm table-striped">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>Row</th>
                                            <th>Image</th>
                                            <th> Title </th>
                                            <th>Price(Min-Max)</th>
                                            <th>Quantity</th>
                                            <th>Display status</th>
                                            <th>Created at</th>
                                            <th>Actions</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($products as $key => $product)
                                            <tr>
                                                <td>{{ $products->firstItem() + $key }}</td>
                                                <td>
                                                    @if ($product->entity)
                                                        <img src="{{ $product->entity->image->path }}"
                                                            alt="{{ $product->title }}" title="{{ $product->title }}"
                                                            class="rounded me-3" height="48">
                                                    @else
                                                        <img src="{{ asset('assets/no-image.png') }}"
                                                            alt="{{ $product->title }}" title="{{ $product->title }}"
                                                            class="rounded me-3" height="48">
                                                    @endif
                                                </td>
                                                <td>{{ $product->title}}</td>
                                                <td>{{$product->product_options()->min('price') }} - {{$product->product_options()->max('price')}}  USD</td>                                            
                                            <td>{{$product->product_options()->sum('quantity') }}</td>
                                                <td>
                                                    @if ($product->status)
                                                        <div class="badge bg-success">Active </div>
                                                    @else
                                                        <div class="badge bg-danger">Inactive</div>
                                                    @endif
                                                </td>

                                                <td>{{ $product->created_at}}</td>
                                                <td>

                                                    <a href="{{ route('dashboard.products.edit', $product->id) }}"
                                                        class="action-icon">
                                                        <i class="mdi mdi-square-edit-outline"></i></a>

                                                    <a href="javascript:void(0);" class="action-icon"
                                                        onclick="deleteData(' Product ',`{{ $product->id }}`,`{{ $product->title }}`)">
                                                        <i class="mdi mdi-delete"></i></a>

                                                    <form id="delete-form-{{ $product->id }}"
                                                        action="{{ route('dashboard.products.destroy', $product->id) }}"
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
                                {{ $products->links('partials.dashboard.pagination-custom') }}
                            </div>
                        @else
                            <div class="alert alert-info  " role="alert">
                                <i class="dripicons-information me-2"></i> The product list is empty
                            </div>
                        @endif

                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
