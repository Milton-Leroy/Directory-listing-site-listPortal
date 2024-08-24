@extends('admin.layouts.master')

@section('contents')
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="{{ route('admin.role-user.index') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>Role Users</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard.index') }}">Dashboard</a></div>
                <div class="breadcrumb-item active"><a href="{{ route('admin.role-user.index') }}">Role Users</a></div>
                <div class="breadcrumb-item">Update</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Update Role User</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.role-user.update',$user->id) }}" method="post">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="">Name<span class="text-danger">*</span></label>
                                    <input type="text" name="name" value="{{ $user->name }}" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="">Email<span class="text-danger">*</span></label>
                                    <input type="text" name="email" value="{{ $user->email }}" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="">Password<span class="text-danger">*</span></label>
                                    <input type="passwword" name="password" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Confirm Password<span class="text-danger">*</span></label>
                                    <input type="passwword" name="password_confirmation" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Roles<span class="text-danger">*</span></label>
                                    <select name="role" class="form-control">
                                        <option value="">Select</option>
                                        @foreach ($roles as $role)
                                        <option @selected($user->getRoleNames()->first() === $role->name) value="{{ $role->name }}">{{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
