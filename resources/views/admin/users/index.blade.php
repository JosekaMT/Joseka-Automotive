@extends('layouts.admin')

@section('template_title')
    Billing
@endsection

@section('content')
    <main class="main-content position-relative max-height-vh-100 h-100">
        <!-- Navbar -->
        <nav class="navbar navbar-main navbar-expand-lg px-0 mx-0 shadow-none bg-black" id="navbarBlur">
            <div class="container-fluid py-1 px-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Admin</a></li>
                        <li class="breadcrumb-item text-sm text-white active" aria-current="page">Billing</li>
                    </ol>
                    <h6 class="font-weight-normal mb-0 text-white" style="font-size: 1.2rem;">Billing</h6>
                </nav>
                <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
                    <ul class="navbar-nav justify-content-end">
                        <li class="nav-item d-xl-none d-flex align-items-center">
                            <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                                <div class="sidenav-toggler-inner">
                                    <i class="sidenav-toggler-line"></i>
                                    <i class="sidenav-toggler-line"></i>
                                    <i class="sidenav-toggler-line"></i>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- End Navbar -->

        <div class="container-fluid py-4">
            <div class="page-header min-height-300 border-radius-xl mt-4"
                style="background-image: url('{{ asset('img/fondo-profile.jpg') }}');">
                <span class="mask bg-gradient-dark opacity-6"></span>
            </div>

            <div class="card card-body mx-3 mx-md-4 mt-n6">
                <h2 class="vehicle-heading2">Users</h2>
                <div class="row gx-4 mb-2">
           
           
                            <div class="card-header pb-0">
                                <div class="row">
                                    <div class="col-lg-6 col-7">
                                        <div style="display: flex; justify-content: space-between; align-items: center;">
                                           
                                        </div>
                                    </div>
                                    <div class="px-0 d-flex justify-content">
                                        @if ($message = Session::get('success'))
                                            <div class="alert alert-success w-auto p-2 mt-2">
                                                <p>{{ $message }}</p>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="card-body px-0 pb-2">
                                        <div class="float">
                                            <button class="btn btn-success btn-sm align-content-md-end" data-toggle="modal"
                                                data-target="#createUserModal">
                                                <i class="fa fa-plus"></i> Create New
                                            </button>
                                        </div>
                                        <div class="table-responsive">
                                            <table class="table align-items-center mb-0" style="width: 100%;">
                                                <thead>
                                                    <tr>
                                                        <th>ID</th>
                                                        <th>Profile Photo</th>
                                                        <th>Name</th>
                                                        <th>Role</th>
                                                        <th>Email</th>
                                                        <th>Phone Number</th>
                                                        <th>City</th>
                                                        <th>Address</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($users as $user)
                                                        <tr>
                                                            <td class="text-center">{{ $user->id }}</td>
                                                            <td class="text-center">
                                                                @if ($user->profile_photo)
                                                                    <img src="{{ asset('storage/' . $user->profile_photo) }}"
                                                                        alt="Profile Photo"
                                                                        style="max-width: 100px; max-height: 100px; border-radius: 10px;">
                                                                @else
                                                                    No Image
                                                                @endif
                                                            </td>
                                                            <td class="text-center">{{ $user->name }}</td>
                                                            <td class="text-center">
                                                                @if ($user->is_admin)
                                                                    <span class="badge bg-success">Admin</span>
                                                                @else
                                                                    <span class="badge bg-primary">Client</span>
                                                                @endif
                                                            </td>
                                                            <td class="text-center">{{ $user->email }}</td>
                                                            <td class="text-center">{{ $user->phone_number }}</td>
                                                            <td class="text-center">{{ $user->city }}</td>
                                                            <td class="text-center">{{ $user->address }}</td>
                                                            <td class="text-center">
                                                                <div class="d-flex flex-column align-items-center">
                                                                    <button type="button" class="btn btn-info btn-sm mb-1"
                                                                        data-toggle="modal"
                                                                        data-target="#showUserModal{{ $user->id }}">
                                                                        <i class="fa fa-fw fa-eye"
                                                                            style="font-size: 1.2em;"></i>
                                                                    </button>
                                                                    <button type="button"
                                                                        class="btn btn-warning btn-sm mb-1"
                                                                        data-toggle="modal"
                                                                        data-target="#editUserModal{{ $user->id }}">
                                                                        <i class="fa fa-fw fa-edit"
                                                                            style="font-size: 1.2em;"></i>
                                                                    </button>
                                                                    <button type="button"
                                                                        class="btn btn-danger btn-sm mb-1"
                                                                        style="background-color: #9c2121;"
                                                                        data-toggle="modal"
                                                                        data-target="#deleteUserModal{{ $user->id }}">
                                                                        <i class="fa fa-fw fa-trash"
                                                                            style="font-size: 1.2em;"></i>
                                                                    </button>
                                                                </div>
                                                            </td>
                                                        </tr>

                                                        <!-- Edit User Modal -->
                                                        <div class="modal fade" id="editUserModal{{ $user->id }}"
                                                            tabindex="-1" role="dialog"
                                                            aria-labelledby="editUserModalLabel{{ $user->id }}"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog modal-lg" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title"
                                                                            id="editUserModalLabel{{ $user->id }}">
                                                                            {{ __('Edit User') }}</h5>
                                                                        <button type="button" class="close"
                                                                            data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <form method="POST"
                                                                            action="{{ route('users.update', $user->id) }}">
                                                                            @csrf
                                                                            @method('PUT')
                                                                            <div class="row py-3 px-3">
                                                                                <div class="col-md-6">
                                                                                    <div class="form-group mb-4">
                                                                                        <label for="name"
                                                                                            class="form-label">{{ __('Name') }}</label>
                                                                                        <input type="text"
                                                                                            name="name"
                                                                                            class="form-control border @error('name') is-invalid @enderror"
                                                                                            value="{{ old('name', $user->name) }}"
                                                                                            id="name"
                                                                                            placeholder="Name" required>
                                                                                        {!! $errors->first('name', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                                                                                    </div>
                                                                                    <div class="form-group mb-4">
                                                                                        <label for="is_admin"
                                                                                            class="form-label">{{ __('Role') }}</label>
                                                                                        <select name="is_admin"
                                                                                            class="form-select border @error('is_admin') is-invalid @enderror"
                                                                                            id="is_admin" required>
                                                                                            <option value="0"
                                                                                                {{ !$user->is_admin ? 'selected' : '' }}>
                                                                                                Client</option>
                                                                                            <option value="1"
                                                                                                {{ $user->is_admin ? 'selected' : '' }}>
                                                                                                Admin</option>
                                                                                        </select>
                                                                                        {!! $errors->first('is_admin', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                                                                                    </div>
                                                                                    <div class="form-group mb-4">
                                                                                        <label for="email"
                                                                                            class="form-label">{{ __('Email') }}</label>
                                                                                        <input type="email"
                                                                                            name="email"
                                                                                            class="form-control border @error('email') is-invalid @enderror"
                                                                                            value="{{ old('email', $user->email) }}"
                                                                                            id="email"
                                                                                            placeholder="Email" required>
                                                                                        {!! $errors->first('email', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                                                                                    </div>
                                                                                    <div class="form-group mb-4">
                                                                                        <label for="phone_number"
                                                                                            class="form-label">{{ __('Phone Number') }}</label>
                                                                                        <input type="text"
                                                                                            name="phone_number"
                                                                                            class="form-control border @error('phone_number') is-invalid @enderror"
                                                                                            value="{{ old('phone_number', $user->phone_number) }}"
                                                                                            id="phone_number"
                                                                                            placeholder="Phone Number">
                                                                                        {!! $errors->first('phone_number', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                                                                                    </div>
                                                                                    <div class="form-group mb-4">
                                                                                        <label for="city"
                                                                                            class="form-label">{{ __('City') }}</label>
                                                                                        <input type="text"
                                                                                            name="city"
                                                                                            class="form-control border @error('city') is-invalid @enderror"
                                                                                            value="{{ old('city', $user->city) }}"
                                                                                            id="city"
                                                                                            placeholder="City">
                                                                                        {!! $errors->first('city', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <div class="form-group mb-4">
                                                                                        <label for="address"
                                                                                            class="form-label">{{ __('Address') }}</label>
                                                                                        <input type="text"
                                                                                            name="address"
                                                                                            class="form-control border @error('address') is-invalid @enderror"
                                                                                            value="{{ old('address', $user->address) }}"
                                                                                            id="address"
                                                                                            placeholder="Address">
                                                                                        {!! $errors->first('address', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                                                                                    </div>
                                                                                    <div class="form-group mb-4">
                                                                                        <label for="password"
                                                                                            class="form-label">{{ __('Password') }}</label>
                                                                                        <input type="password"
                                                                                            name="password"
                                                                                            class="form-control border @error('password') is-invalid @enderror"
                                                                                            id="password"
                                                                                            placeholder="Password">
                                                                                        {!! $errors->first('password', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                                                                                    </div>
                                                                                    <div class="form-group mb-4">
                                                                                        <label for="password_confirmation"
                                                                                            class="form-label">{{ __('Confirm Password') }}</label>
                                                                                        <input type="password"
                                                                                            name="password_confirmation"
                                                                                            class="form-control border @error('password_confirmation') is-invalid @enderror"
                                                                                            id="password_confirmation"
                                                                                            placeholder="Confirm Password">
                                                                                        {!! $errors->first(
                                                                                            'password_confirmation',
                                                                                            '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>',
                                                                                        ) !!}
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row px-3">
                                                                                <div class="col-md-12 mt-4">
                                                                                    <button type="submit" class="btn"
                                                                                        style="background-color: #9c2121; color: white;">{{ __('Save changes') }}</button>
                                                                                </div>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- End Edit User Modal -->


                                                        <!-- Show User Modal -->
                                                        <div class="modal fade" id="showUserModal{{ $user->id }}"
                                                            tabindex="-1" role="dialog"
                                                            aria-labelledby="showUserModalLabel{{ $user->id }}"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-scrollable modal-lg"
                                                                role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title"
                                                                            id="showUserModalLabel{{ $user->id }}"
                                                                            style="color: black; font-size: 18px;">Show
                                                                            User
                                                                        </h5>
                                                                        <button type="button" class="close"
                                                                            data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="container-fluid">
                                                                            <div class="row mt-3">
                                                                                <div class="col-sm-6">
                                                                                    <div class="form-group">
                                                                                        <strong
                                                                                            style="color: black; font-size: 18px;">Name:</strong>
                                                                                        <p
                                                                                            style="color: black; font-size: 18px;">
                                                                                            {{ $user->name }}</p>
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <strong
                                                                                            style="color: black; font-size: 18px;">Role:</strong>
                                                                                        <p
                                                                                            style="color: black; font-size: 18px;">
                                                                                            {{ $user->is_admin ? 'Admin' : 'Client' }}
                                                                                        </p>
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <strong
                                                                                            style="color: black; font-size: 18px;">Email:</strong>
                                                                                        <p
                                                                                            style="color: black; font-size: 18px;">
                                                                                            {{ $user->email }}</p>
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <strong
                                                                                            style="color: black; font-size: 18px;">Phone
                                                                                            Number:</strong>
                                                                                        <p
                                                                                            style="color: black; font-size: 18px;">
                                                                                            {{ $user->phone_number }}
                                                                                        </p>
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <strong
                                                                                            style="color: black; font-size: 18px;">City:</strong>
                                                                                        <p
                                                                                            style="color: black; font-size: 18px;">
                                                                                            {{ $user->city }}</p>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-sm-6">
                                                                                    <div class="form-group">
                                                                                        <strong
                                                                                            style="color: black; font-size: 18px;">Address:</strong>
                                                                                        <p
                                                                                            style="color: black; font-size: 18px;">
                                                                                            {{ $user->address }}</p>
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <strong
                                                                                            style="color: black; font-size: 18px;">Profile
                                                                                            Photo:</strong>
                                                                                        @if ($user->profile_photo)
                                                                                            <img src="{{ asset('storage/' . $user->profile_photo) }}"
                                                                                                alt="Profile Photo"
                                                                                                style="max-width: 130px; max-height: 130px; border-radius: 10px;">
                                                                                        @else
                                                                                            No Image
                                                                                        @endif
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- End Show User Modal -->

                                                        <!-- Delete User Modal -->
                                                        <div class="modal fade" id="deleteUserModal{{ $user->id }}"
                                                            tabindex="-1" role="dialog"
                                                            aria-labelledby="deleteUserModalLabel{{ $user->id }}"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title"
                                                                            id="deleteUserModalLabel{{ $user->id }}">
                                                                            Delete User</h5>
                                                                        <button type="button" class="close"
                                                                            data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        Are you sure you want to delete this user?
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <form
                                                                            action="{{ route('users.destroy', $user->id) }}"
                                                                            method="POST">
                                                                            @csrf
                                                                            @method('DELETE')
                                                                            <button type="button" class="btn btn-dark"
                                                                                data-dismiss="modal">Close</button>
                                                                            <button type="submit" class="btn"
                                                                                style="background-color: #9c2121; color: white;">Delete</button>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- End Delete User Modal -->
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal for Create User -->
                    <div class="modal fade" id="createUserModal" tabindex="-1" role="dialog"
                        aria-labelledby="createUserModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="createUserModalLabel">{{ __('Create New User') }}
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" action="{{ route('users.store') }}">
                                        @csrf
                                        <div class="row py-3 px-3">
                                            <div class="col-md-6">
                                                <div class="form-group mb-4">
                                                    <label for="name" class="form-label">{{ __('Name') }}</label>
                                                    <input type="text" name="name"
                                                        class="form-control border @error('name') is-invalid @enderror"
                                                        id="name" placeholder="Name" required>
                                                    {!! $errors->first('name', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                                                </div>
                                                <div class="form-group mb-4">
                                                    <label for="is_admin" class="form-label">{{ __('Role') }}</label>
                                                    <select name="is_admin"
                                                        class="form-select border @error('is_admin') is-invalid @enderror"
                                                        id="is_admin" required>
                                                        <option value="0">Client</option>
                                                        <option value="1">Admin</option>
                                                    </select>
                                                    {!! $errors->first('is_admin', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                                                </div>
                                                <div class="form-group mb-4">
                                                    <label for="email" class="form-label">{{ __('Email') }}</label>
                                                    <input type="email" name="email"
                                                        class="form-control border @error('email') is-invalid @enderror"
                                                        id="email" placeholder="Email" required>
                                                    {!! $errors->first('email', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                                                </div>
                                                <div class="form-group mb-4">
                                                    <label for="phone_number"
                                                        class="form-label">{{ __('Phone Number') }}</label>
                                                    <input type="text" name="phone_number"
                                                        class="form-control border @error('phone_number') is-invalid @enderror"
                                                        id="phone_number" placeholder="Phone Number">
                                                    {!! $errors->first('phone_number', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                                                </div>
                                                <div class="form-group mb-4">
                                                    <label for="city" class="form-label">{{ __('City') }}</label>
                                                    <input type="text" name="city"
                                                        class="form-control border @error('city') is-invalid @enderror"
                                                        id="city" placeholder="City">
                                                    {!! $errors->first('city', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group mb-4">
                                                    <label for="address" class="form-label">{{ __('Address') }}</label>
                                                    <input type="text" name="address"
                                                        class="form-control border @error('address') is-invalid @enderror"
                                                        id="address" placeholder="Address">
                                                    {!! $errors->first('address', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                                                </div>
                                                <div class="form-group mb-4">
                                                    <label for="password" class="form-label">{{ __('Password') }}</label>
                                                    <input type="password" name="password"
                                                        class="form-control border @error('password') is-invalid @enderror"
                                                        id="password" placeholder="Password" required>
                                                    {!! $errors->first('password', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                                                </div>
                                                <div class="form-group mb-4">
                                                    <label for="password_confirmation"
                                                        class="form-label">{{ __('Confirm Password') }}</label>
                                                    <input type="password" name="password_confirmation"
                                                        class="form-control border @error('password_confirmation') is-invalid @enderror"
                                                        id="password_confirmation" placeholder="Confirm Password"
                                                        required>
                                                    {!! $errors->first(
                                                        'password_confirmation',
                                                        '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>',
                                                    ) !!}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row px-3">
                                            <div class="col-md-12 mt-4">
                                                <button type="submit" class="btn"
                                                    style="background-color: #9c2121; color: white;">{{ __('Create User') }}</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Modal for Create User -->
                @endsection
