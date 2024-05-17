@extends('layouts.admin')

@section('template_title')
    Users
@endsection

@section('content')
    <main class="main-content position-relative max-height-vh-100 h-100">
        <!-- Navbar -->
        <nav class="navbar navbar-main navbar-expand-lg px-0 mx-0 shadow-none bg-black" id="navbarBlur">
            <div class="container-fluid py-1 px-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Admin</a></li>
                        <li class="breadcrumb-item text-sm text-white active" aria-current="page">Users</li>
                    </ol>
                    <h6 class="font-weight-normal mb-0 text-white" style="font-size: 1.2rem;">Users</h6>
                </nav>
                <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
                    <ul class="navbar-nav justify-content-end">
                        <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
                            <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                                <div class="sidenav-toggler-inner">
                                    <i class="sidenav-toggler-line line-white"></i>
                                    <i class="sidenav-toggler-line line-white"></i>
                                    <i class="sidenav-toggler-line line-white"></i>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- End Navbar -->

        <div class="container-fluid py-4">
            <div class="row mb-4">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header pb-0">
                            <div class="row">
                                <div class="col-lg-6 col-7">
                                    <div style="display: flex; justify-content: space-between; align-items: center;">
                                        <h2 class="vehicle-heading2" id="card_title">{{ __('Users') }}</h2>
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
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Phone</th>
                                                    <th>City</th>
                                                    <th>Address</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($users as $user)
                                                    <tr>
                                                        <td class="text-center">{{ $user->id }}</td>
                                                        <td class="text-center">{{ $user->name }}</td>
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
                                                                <button type="button" class="btn btn-warning btn-sm mb-1"
                                                                    data-toggle="modal"
                                                                    data-target="#editUserModal{{ $user->id }}">
                                                                    <i class="fa fa-fw fa-edit"
                                                                        style="font-size: 1.2em;"></i>
                                                                </button>
                                                                <button type="button" class="btn btn-danger btn-sm mb-1"
                                                                    style="background-color: #9c2121;" data-toggle="modal"
                                                                    data-target="#deleteUserModal{{ $user->id }}">
                                                                    <i class="fa fa-fw fa-trash"
                                                                        style="font-size: 1.2em;"></i>
                                                                </button>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <!-- Show User Modal -->
                                                    <div class="modal fade" id="showUserModal{{ $user->id }}"
                                                        tabindex="-1" role="dialog"
                                                        aria-labelledby="showUserModalLabel{{ $user->id }}"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title"
                                                                        id="showUserModalLabel{{ $user->id }}">Show User
                                                                    </h5>
                                                                    <button type="button" class="close"
                                                                        data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <p><strong>Name:</strong> {{ $user->name }}</p>
                                                                    <p><strong>Email:</strong> {{ $user->email }}</p>
                                                                    <p><strong>Phone:</strong> {{ $user->phone_number }}</p>
                                                                    <p><strong>City:</strong> {{ $user->city }}</p>
                                                                    <p><strong>Address:</strong> {{ $user->address }}</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- End Show User Modal -->

                                                    <!-- Edit User Modal -->
                                                    <div class="modal fade" id="editUserModal{{ $user->id }}"
                                                        tabindex="-1" role="dialog"
                                                        aria-labelledby="editUserModalLabel{{ $user->id }}"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog" role="document"
                                                            style="max-width: 800px;">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title"
                                                                        id="editUserModalLabel{{ $user->id }}">Edit User</h5>
                                                                    <button type="button" class="close"
                                                                        data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form method="POST"
                                                                        action="{{ route('admin.users.update', $user->id) }}"
                                                                        enctype="multipart/form-data">
                                                                        @csrf
                                                                        @method('PUT')
                                                                        <div class="form-group">
                                                                            <label for="name">Name</label>
                                                                            <input type="text" class="form-control" id="name"
                                                                                name="name" value="{{ $user->name }}" required>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="email">Email</label>
                                                                            <input type="email" class="form-control" id="email"
                                                                                name="email" value="{{ $user->email }}" required>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="phone_number">Phone</label>
                                                                            <input type="text" class="form-control"
                                                                                id="phone_number" name="phone_number"
                                                                                value="{{ $user->phone_number }}">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="city">City</label>
                                                                            <input type="text" class="form-control" id="city"
                                                                                name="city" value="{{ $user->city }}">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="address">Address</label>
                                                                            <input type="text" class="form-control"
                                                                                id="address" name="address"
                                                                                value="{{ $user->address }}">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="profile_photo">Profile Photo</label>
                                                                            <input type="file" class="form-control"
                                                                                id="profile_photo" name="profile_photo">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="password">Password</label>
                                                                            <input type="password" class="form-control"
                                                                                id="password" name="password">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="password_confirmation">Confirm Password</label>
                                                                            <input type="password" class="form-control"
                                                                                id="password_confirmation" name="password_confirmation">
                                                                        </div>
                                                                        <button type="submit"
                                                                            class="btn btn-primary">Save changes</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- End Edit User Modal -->

                                                    <!-- Delete User Modal -->
                                                    <div class="modal fade" id="deleteUserModal{{ $user->id }}"
                                                        tabindex="-1" role="dialog"
                                                        aria-labelledby="deleteUserModalLabel{{ $user->id }}"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title"
                                                                        id="deleteUserModalLabel{{ $user->id }}">Delete User
                                                                    </h5>
                                                                    <button type="button" class="close"
                                                                        data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    Are you sure you want to delete this user?
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <form method="POST"
                                                                        action="{{ route('admin.users.destroy', $user->id) }}">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-dismiss="modal">Close</button>
                                                                        <button type="submit"
                                                                            class="btn btn-danger">Delete</button>
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
                                <h5 class="modal-title" id="createUserModalLabel">{{ __('Create New User') }}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form method="POST" action="{{ route('admin.users.store') }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control" id="name" name="name" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" id="email" name="email" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="phone_number">Phone</label>
                                        <input type="text" class="form-control" id="phone_number" name="phone_number">
                                    </div>
                                    <div class="form-group">
                                        <label for="city">City</label>
                                        <input type="text" class="form-control" id="city" name="city">
                                    </div>
                                    <div class="form-group">
                                        <label for="address">Address</label>
                                        <input type="text" class="form-control" id="address" name="address">
                                    </div>
                                    <div class="form-group">
                                        <label for="profile_photo">Profile Photo</label>
                                        <input type="file" class="form-control" id="profile_photo" name="profile_photo">
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="password" class="form-control" id="password" name="password" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="password_confirmation">Confirm Password</label>
                                        <input type="password" class="form-control" id="password_confirmation"
                                            name="password_confirmation" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Create User</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Modal for Create User -->
            </div>
        </div>
    </main>
@endsection
