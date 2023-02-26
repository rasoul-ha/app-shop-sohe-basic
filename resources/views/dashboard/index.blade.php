@extends('layouts.dashboard')
@prepend('appTitle')
    <title>{{ config('app.name') }} | Dashboard</title>
@endprepend

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active"><a>Dashboard</a></li>
                    </ol>
                </div>
                <h4 class="page-title"> Dashboard</h4>
                @include('partials.dashboard.demoMessage')

            </div>

        </div>


    </div>
    <div class="row">
        <div class="col-12">
            <div class="card widget-inline">
                <div class="card-body p-0">
                    <div class="row g-0">
                        <div class="col-sm-6 col-lg-3">
                            <div class="card shadow-none m-0">
                                <div class="card-body text-center">
                                    <i class="mdi mdi-account-multiple text-muted" style="font-size: 24px;"></i>
                                    <h3><span>{{ $usersCount }}</span></h3>
                                    <p class="text-muted font-15 mb-0">Users </p>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-lg-3">
                            <div class="card shadow-none m-0 border-start">
                                <div class="card-body text-center">
                                    <i class="mdi mdi-layers-outline text-muted" style="font-size: 24px;"></i>
                                    <h3><span>{{ $categoriesCount }}</span></h3>
                                    <p class="text-muted font-15 mb-0"> Categories</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <div class="card shadow-none m-0 border-start">
                                <div class="card-body text-center">
                                    <i class="uil uil-box text-muted" style="font-size: 24px;"></i>
                                    <h3><span>{{ $productsCount }}</span></h3>
                                    <p class="text-muted font-15 mb-0"> Products</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <div class="card shadow-none m-0 border-start">
                                <div class="card-body text-center">
                                    <i class="mdi mdi-cart-outline" style="font-size: 24px;"></i>
                                    <h3><span>{{ $ordersCount }}</span></h3>
                                    <p class="text-muted font-15 mb-0">Orders </p>
                                </div>
                            </div>
                        </div>




                    </div> <!-- end row -->
                </div>
            </div> <!-- end card-box-->
        </div> <!-- end col-->
    </div>
    <!-- end row-->
    <div class="page-title-box">
        <h4 class="page-title"> Recent orders </h4>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="page-title-box">
                @if (count($latestOrders))
                    <div class="table-responsive">
                        <table class="table text-center  table-centered mb-0 table-sm table-striped">
                            <thead class="table-dark">
                                <tr>
                                    <th>Row</th>
                                    <th> Order ID</th>
                                    <th> Order Status </th>
                                    <th>Total price</th>
                                    <th>Payment status</th>
                                    <th>Order registration time</th>
                                    <th>Actions</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($latestOrders as $key => $latestOrder)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $latestOrder->sku }}</td>
                                        <td>
                                                @if ($latestOrder->step_delivery === 'order_placed')
                                                    The order was placed
                                                @elseif ($latestOrder->step_delivery === 'order_accepted')
                                                    The order was confirmed
                                                @elseif ($latestOrder->step_delivery === 'prepare')
                                                    preparing
                                                @elseif ($latestOrder->step_delivery === 'shipped')
                                                    The order was sent
                                                @elseif ($latestOrder->step_delivery === 'delivered')
                                                    The order was delivered

                                                @endif
                                        </td>

                                        <td>
                                            {{ number_format($latestOrder->total_price) }} USD
                                        </td>
                                        <td>
                                            @if ($latestOrder->status)
                                                <div class="badge bg-success">
                                                    Successful payment
                                                </div>
                                            @else
                                                <div class="badge bg-danger">
                                                    Payment failed </div>
                                            @endif
                                        </td>
                                        <td>{{ $latestOrder->created_at }}</td>
                                        <td>
                                            <a href="{{ route('dashboard.orders.show', $latestOrder->id) }}"
                                                class="action-icon">
                                                <i class="mdi mdi-eye-outline"></i></a>
                                            </a>

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="alert alert-info  " role="alert">
                        <i class="dripicons-information me-2"></i>The order list is empty
                    </div>
                @endif

            </div>
        </div>
    </div>
    <!-- end card -->



    <div class="page-title-box">
        <h4 class="page-title">Recent users</h4>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="page-title-box">
                @if (count($latestUsers))
                    <div class="table-responsive">
                        <table class="table text-center  table-centered mb-0 table-sm table-striped">
                            <thead class="table-dark">
                                <tr>
                                    <th>Row</th>
                                    <th> Full name </th>
                                    <th> Phone number (username)  </th>
                                    <th>Registration time</th>
                                    <th>Actions</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($latestUsers as $key => $latestUser)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $latestUser->name }}</td>
                                        <td>
                                            {{ $latestUser->username }}
                                        </td>

                                        <td>{{ $latestUser->created_at }}</td>
                                        <td>
                                            <a href="{{ route('dashboard.users.edit', $latestUser->id) }}"
                                                class="action-icon">
                                                <i class="mdi mdi-square-edit-outline"></i>
                                            </a>

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="alert alert-info  " role="alert">
                        <i class="dripicons-information me-2"></i> There are currently no users.
                    </div>
                @endif

            </div>
        </div>
    </div>
    <!-- end card -->
@endsection
