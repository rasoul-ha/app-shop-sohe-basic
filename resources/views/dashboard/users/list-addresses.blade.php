@extends('layouts.dashboard')
@prepend('appTitle')
    <title>{{ config('app.name') }} | Addresses{{$user->name}}</title>
@endprepend

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.users.index') }}">Users</a></li>
                        <li class="breadcrumb-item active"><a> Addresses {{$user->name}}</a></li>
                    </ol>
                </div>
                <h4 class="page-title">List of addresses {{$user->name}}</h4>
                @include('partials.dashboard.demoMessage')
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="page-title-box">
                      
                        <a href="{{ route('dashboard.addresses.create',$user->id) }}" class="btn btn-primary mb-2">
                            <i class=dripicons-plus></i>
                            Add address for user
                        </a>
                        @if (count($addresses))
                            <div class="table-responsive">
                                <table class="table text-center  table-centered mb-0 table-sm table-striped">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>Row</th>
                                            <th> Street name</th>
                                            <th> Zip code</th>

                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($addresses as $key => $address)
                                            <tr>
                                                <td>{{  $key +1}}</td>
                                                <td>{{ $address->street_name }}</td>
                                                <td>{{ $address->zip_code }}</td>

                                                <td>
                                                    <a href="{{ route('dashboard.addresses.edit',[$user,$address]) }}"
                                                        class="action-icon">
                                                        <i class="mdi mdi-square-edit-outline"></i></a>

                                                    <a href="javascript:void(0);" class="action-icon"
                                                        onclick="deleteData(' Address ',`{{ $address->id }}`,`{{ $address->title }}`)">
                                                        <i class="mdi mdi-delete"></i></a>

                                                    <form id="delete-form-{{ $address->id }}"
                                                        action="{{ route('dashboard.addresses.destroy', $address->id) }}"
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
                            @else
                            <div class="alert alert-info  " role="alert">
                                <i class="dripicons-information me-2"></i> The user address list is empty
                            </div>
                        @endif
    
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
