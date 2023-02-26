@extends('layouts.dashboard')
@prepend('appTitle')
    <title>{{ config('app.name') }} | Users</title>
@endprepend

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active"><a>Users</a></li>
                    </ol>
                </div>
                <h4 class="page-title"> List of users</h4>
                @include('partials.dashboard.demoMessage')

            </div>

            <div class="card">
                <div class="card-body">
                    <div class="page-title-box">
                        <a href="{{ route('dashboard.users.create') }}" class="btn btn-primary mb-2">
                            <i class=dripicons-plus></i>
                            Add user
                        </a>
                        @if (count($users))
                            <div class="table-responsive">
                                <table class="table text-center  table-centered mb-0 table-sm table-striped">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>Row</th>
                                            <th> Full name </th>
                                            <th>Email </th>
                                            <th>User account status</th>
                                            <th>Date of registration</th>
                                            <th>Actions</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $key => $user)
                                            <tr>
                                                <td>{{ $users->firstItem() + $key }}</td>
                                                <td>{{ $user->name  }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>
                                                    @if ($user->email_verified_at)
                                                        <div class="badge bg-success">Active </div>
                                                    @else
                                                        <div class="badge bg-danger">Inactive</div>
                                                    @endif
                                                </td>
                                                <td>{{ $user->created_at }}</td>
                                                <td>


                                                    <a href="{{ route('dashboard.addresses.index', $user->id) }}"
                                                        class="action-icon">
                                                        <i class="mdi mdi-map-marker-multiple"></i></a>


                                                    <a href="{{ route('dashboard.users.edit', $user->id) }}"
                                                        class="action-icon">
                                                        <i class="mdi mdi-square-edit-outline"></i></a>

                                                    <a href="javascript:void(0);" class="action-icon"
                                                        onclick="deleteData(' User ',`{{ $user->id }}`,`{{ $user->name }}`)">
                                                        <i class="mdi mdi-delete"></i></a>

                                                    <form id="delete-form-{{ $user->id }}"
                                                        action="{{ route('dashboard.users.destroy', $user->id) }}"
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
                                {{ $users->links('partials.dashboard.pagination-custom') }}
                            </div>
                        @else
                            <div class="alert alert-info  " role="alert">
                                <i class="dripicons-information me-2"></i>The list of users is empty
                            </div>
                        @endif

                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
