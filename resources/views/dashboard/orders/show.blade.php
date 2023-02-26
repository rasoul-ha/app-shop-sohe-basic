@extends('layouts.dashboard')
@prepend('appTitle')
    <title>{{ config('app.name') }} | {{ $order->sku }} View order </title>
@endprepend

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.orders.index') }}">Orders</a></li>

                        <li class="breadcrumb-item active"><a> View order </a></li>
                    </ol>
                </div>
                <h4 class="page-title"> View order # {{ $order->sku }}</h4>
                @include('partials.dashboard.errorsMessage')
                @include('partials.dashboard.demoMessage')

            </div>
            <div class="row justify-content-center">
                <div class="col-lg-7 col-md-10 col-sm-11">

                    <div class="horizontal-steps mt-4 mb-4 pb-5" id="tooltip-container">
                        <div class="horizontal-steps-content">
                            <div class="step-item @if ($order->step_delivery === 'order_placed') current @endif">
                                <span>Order placed</span>
                            </div>
                            <div class="step-item @if ($order->step_delivery === 'order_accepted') current @endif">
                                <span>Order accepted</span>
                            </div>
                            <div class="step-item @if ($order->step_delivery === 'prepare') current @endif">
                                <span>Processing</span>
                            </div>
                            <div class="step-item @if ($order->step_delivery === 'shipped') current @endif">
                                <span> Order sent</span>
                            </div>
                            <div class="step-item  @if ($order->step_delivery === 'delivered') current @endif">
                                <span>Order delivered</span>
                            </div>
                        </div>
                        <div class="process-line"
                            style="width: @if ($order->step_delivery === 'order_placed') 0%;@elseif($order->step_delivery === 'order_accepted') 25%; @elseif($order->step_delivery === 'prepare') 50%; @elseif($order->step_delivery === 'shipped') 75%; @elseif($order->step_delivery === 'delivered') 99%; @endif">
                        </div>
                    </div>


                </div>
            </div>
            <!-- end row -->


            <div class="row">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title mb-3"> Items from the order # {{ $order->sku }}</h4>

                            <div class="table-responsive">
                                <table class="table mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Item</th>
                                            <th>Quantity</th>
                                            <th>Price </th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($order->products as $product)
                                            <tr>

                                                <td>{{ $product->title }}
                                                    <br>
                                                    ({{ $product->pivot->variant->size }})
                                                    <br>
                                                    <div class="badage " style="{{background-color: $product->color}}"></div>
                                                </td>
                                                <td>{{ $product->pivot->quantity }}</td>
                                                <td>
                                                    {{ number_format($product->pivot->variant->price, 2) }} USD

                                                </td>
                                                <td>
                                                    {{ number_format($product->pivot->variant->price * $product->pivot->quantity, 2) }}
                                                    USD
                                                </td>
                                        @endif
                                        </tr>
                                        @endforeach


                                    </tbody>
                                </table>
                            </div>
                            <!-- end table-responsive -->

                        </div>
                    </div>
                </div> <!-- end col -->

                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title mb-3">order summary</h4>

                            <div class="table-responsive">
                                <table class="table mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Description</th>
                                            <th>Price</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Subtotal :</td>
                                            <td>{{ number_format($order->products_price , 2) }} USD
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>shipping:</td>
                                            <td>{{ number_format($order->shipping_cost, 2) }} USD</td>
                                        </tr>

                                        <tr>
                                            <th> Total Amount :</th>
                                            <th>{{ number_format($order->total_price, 2) }} USD</th>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- end table-responsive -->

                        </div>
                    </div>
                </div> <!-- end col -->
            </div>
            <!-- end row -->


            <div class="row">
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title mb-3">User information</h4>

                            <h5>{{ $order->user->name }}</h5>

                            <address class="mb-0 font-14 address-lg">
                                <abbr title="Street name"> Street name: </abbr>{{ $order?->address?->street_name }}<br>
                                <abbr title="City"> Address: </abbr>{{ $order?->address?->city }}<br>
                                <abbr title="State"> Address: </abbr>{{ $order?->address?->state }}<br>
                                <abbr title="Zip code"> Address: </abbr>{{ $order?->address?->zip_code }}<br>
                                <abbr title="Delivery person name"> Delivery person name:
                                </abbr>{{ $order?->delivery_person_name }}<br>
                                <abbr title="Delivery person name"> Delivery person phone number:
                                </abbr>{{ $order?->delivery_person_phone_number }}<br>

                            </address>

                        </div>
                    </div>
                </div> <!-- end col -->

                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title mb-3">Billing information</h4>

                            <ul class="list-unstyled mb-0">
                                <li>
                                    <p class="mb-2"><span class="fw-bold me-2">Order status:</span>
                                    <form action="{{ route('dashboard.orders.step.status', $order->id) }}"
                                        id="order-step-status-form" method="post">
                                        @csrf
                                        <input type="hidden" name="type" value={{ $order->type }}>
                                        <select class="form-select   @error('step_delivery') is-invalid  @enderror"
                                            id="order-step-select" name="step_delivery">
                                            <option value="order_placed" @if ($order->step_delivery === 'order_placed') selected @endif>
                                                Order placed
                                            </option>
                                            <option value="order_accepted"
                                                @if ($order->step_delivery === 'order_accepted') selected @endif>
                                                Order accepted </option>
                                            <option value="prepare" @if ($order->step_delivery === 'prepare') selected @endif>
                                                Processing </option>
                                            <option value="shipped" @if ($order->step_delivery === 'shipped') selected @endif>
                                                Order sent
                                            </option>
                                            <option value="delivered" @if ($order->step_delivery === 'delivered') selected @endif>
                                                Order delivered
                                            </option>
                                        </select>
                                        <div class="row">
                                            <button type="submit" class="btn btn-primary btn-block mt-1">
                                                Save </button>
                                        </div>

                                    </form>

                                    </p>

                                    <p class="mb-2"><span class="fw-bold me-2">Payment status:</span>
                                    <form action="{{ route('dashboard.orders.payment.status', $order->id) }}"
                                        id="order-payment-status-form" method="post">
                                        @csrf
                                        <select class="form-select   @error('order_status') is-invalid  @enderror"
                                            id="order-status-select" name="order_status">
                                            <option value="1" @if ($order->status === true) selected @endif>
                                                Paid</option>
                                            <option value="0" @if ($order->status === false) selected @endif>
                                                unpaid</option>
                                        </select>
                                    </form>


                                    </p>
                                </li>
                            </ul>

                        </div>
                    </div>
                </div> <!-- end col -->

                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title mb-3">Shipping information</h4>

                            <div class="text-center">
                                <i class="mdi mdi-truck-fast h2 text-muted"></i>


                                <p class="mb-1"><b>Order ID:</b># {{ $order->sku }}</p>
                                <p class="mb-0"><b>Payment Method:</b>
                                    online payment
                                </p>
                            </div>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div>
            <!-- end row -->
            <a href="{{ route('dashboard.orders.index') }}" class="btn btn-secondary">
                Back

            </a>
        </div>
    </div>
@endsection

@prepend('js')
    <script>
        let orderStatusSelectBox = document.getElementById('order-status-select');
        let orderPaymentStatusForm = document.getElementById('order-payment-status-form');
        orderStatusSelectBox.addEventListener('change', function() {
            orderPaymentStatusForm.submit();
        }, false);
    </script>
@endprepend
