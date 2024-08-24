@extends('admin.layouts.master')

@section('contents')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <div class="section-header-back">
                    <a href="features-posts.html" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
                </div>
                <h1>Profile</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Posts</a></div>
                    <div class="breadcrumb-item">Create New Post</div>
                </div>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Update Profile</h4>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('admin.profile.update') }}" method="post"
                                    enctype="multipart/form-data">
                                    @method('PUT')
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Avatar</label>
                                                <div id="image-preview" class="image-preview avatar-preview">
                                                    <label for="image-upload" id="image-label">Choose File</label>
                                                    <input type="file" name="avatar" id="image-upload" />
                                                    <input type="hidden" name="old_avatar" value="{{ $user->avatar }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Banner</label>
                                                <div id="image-preview-2" class="image-preview banner-preview">
                                                    <label for="image-upload-2" id="image-label-2">Choose File</label>
                                                    <input type="file" name="banner" id="image-upload-2" />
                                                    <input type="hidden" name="old_banner" value="{{ $user->banner }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Name <span class="text-danger">*</span></label>
                                                <input type="text" name="name" value="{{ $user->name }}"
                                                    class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Email <span class="text-danger">*</span></label>
                                                <input type="text" name="email" value="{{ $user->email }}"
                                                    class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Phone <span class="text-danger">*</span></label>
                                                <input type="text" name="phone" value="{{ $user->phone }}"
                                                    class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Address <span class="text-danger">*</span></label>
                                                <input type="text" name="address" value="{{ $user->address }}"
                                                    class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="">About <span class="text-danger">*</span></label>
                                                <textarea name="about" class="form-control" required>{!! $user->about !!}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Website</label>
                                                <input type="text" name="website" value="{{ $user->website }}"
                                                    class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Facebook</label>
                                                <input type="text" name="fb_link" value="{{ $user->fb_link }}"
                                                    class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">X</label>
                                                <input type="text" name="x_link" value="{{ $user->x_link }}"
                                                    class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">LinkedIn</label>
                                                <input type="text" name="in_link" value="{{ $user->in_link }}"
                                                    class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Whatsapp</label>
                                                <input type="text" name="wa_link" value="{{ $user->wa_link }}"
                                                    class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Instagram</label>
                                                <input type="text" name="instra_link"
                                                    value="{{ $user->instra_link }}" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <button class="btn btn-primary" type="submit">Update</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Update Password</h4>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('admin.profile-password.update') }}" method="post"
                                    enctype="multipart/form-data">
                                    @method('PUT')
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Password</label>
                                                <input type="password" name="password" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Confirm Pasword</label>
                                                <input type="password" name="password_confirmation" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <button class="btn btn-primary" type="submit">Update</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('.avatar-preview').css({
                'background-image': 'url({{ asset($user->avatar) }})',
                'background-size': 'cover',
                'background-position': 'center'
            })

            $('.banner-preview').css({
                'background-image': 'url({{ asset($user->banner) }})',
                'background-size': 'cover',
                'background-position': 'center'
            })
        })

        $.uploadPreview({
            input_field: "#image-upload", // Default: .image-upload
            preview_box: "#image-preview", // Default: .image-preview
            label_field: "#image-label", // Default: .image-label
            label_default: "Choose File", // Default: Choose File
            label_selected: "Change File", // Default: Change File
            no_label: false, // Default: false
            success_callback: null // Default: null
        });
        $.uploadPreview({
            input_field: "#image-upload-2", // Default: .image-upload
            preview_box: "#image-preview-2", // Default: .image-preview
            label_field: "#image-label-2", // Default: .image-label
            label_default: "Choose File", // Default: Choose File
            label_selected: "Change File", // Default: Change File
            no_label: false, // Default: false
            success_callback: null // Default: null
        });
    </script>
@endpush
