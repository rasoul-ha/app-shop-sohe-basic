@extends('layouts.dashboard')
@prepend('appTitle')
    <title>{{ config('app.name') }} | {{ __('Orders') }}</title>
@endprepend


@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active"><a>Orders</a></li>
                    </ol>
                </div>
                <h4 class="page-title">List of orders</h4>
                @include('partials.dashboard.demoMessage')

            </div>

            <div class="card">
                <div class="card-body">
                    <div class="page-title-box">

                        @if (count($orders))
                            <div class="table-responsive">
                                <table class="table text-center  table-centered mb-0 table-sm table-striped">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>Row</th>
                                            <th>Order ID </th>
                                            <th> Order status </th>
                                            <th>Total price</th>
                                            <th>Payment status</th>
                                            <th>Order registration time</th>
                                            <th>Actions</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orders as $key => $order)
                                            <tr>
                                                <td>{{ $orders->firstItem() + $key }}</td>
                                                <td>{{ $order->sku }}</td>
                                                <td>
                                                    @if ($order->step_delivery === 'order_placed')
                                                        Order placed
                                                    @elseif ($order->step_delivery === 'order_accepted')
                                                        Order accepted
                                                    @elseif ($order->step_delivery === 'prepare')
                                                        Processing
                                                    @elseif ($order->step_delivery === 'shipped')
                                                        Order sent
                                                    @elseif ($order->step_delivery === 'delivered')
                                                        Order delivered
                                                    @endif

                                                </td>
                                                <td>
                                                    {{ number_format($order->total_price, 2) }} USD
                                                </td>
                                                <td>
                                                    @if ($order->status)
                                                        <div class="badge bg-success">
                                                            Successful payment </div>
                                                    @else
                                                        <div class="badge bg-danger">
                                                            Payment failed </div>
                                                    @endif
                                                </td>

                                                <td>{{ $order->created_at }}</td>
                                                <td>

                                                    <a href="{{ route('dashboard.orders.show', $order->id) }}"
                                                        class="action-icon">
                                                        <i class="mdi mdi-eye-outline"></i></a>

                                                    <a href="javascript:void(0);" class="action-icon"
                                                        onclick="deleteData(' Order ',`{{ $order->id }}`,`{{ $order->sku }}`)">
                                                        <i class="mdi mdi-delete"></i></a>

                                                    <form id="delete-form-{{ $order->id }}"
                                                        action="{{ route('dashboard.orders.destroy', $order->id) }}"
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
                                {{ $orders->links('partials.dashboard.pagination-custom') }}
                            </div>
                        @else
                            <div class="alert alert-info  " role="alert">
                                <i class="dripicons-information me-2"></i>The order list is empty
                            </div>
                        @endif

                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
