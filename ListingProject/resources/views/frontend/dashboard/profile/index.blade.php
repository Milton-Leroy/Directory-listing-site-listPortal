@extends('frontend.layouts.master')

@section('contents')
    <section id="dashboard">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">

                    @include('frontend.dashboard.sidebar')

                </div>
                <div class="col-lg-9">
                    <div class="dashboard_content">
                        <div class="my_listing">
                            <h4>basic information</h4>
                            <form action="{{ route('user.profile.update') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-xl-8 col-md-12">
                                        <div class="row">
                                            <div class="col-xl-6 col-md-6">
                                                <div class="my_listing_single">
                                                    <label>Name <span class="text-danger">*</span></label>
                                                    <div class="input_area">
                                                        <input type="text" name="name" value="{{ $user->name }}"
                                                            required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-6 col-md-6">
                                                <div class="my_listing_single">
                                                    <label>phone <span class="text-danger">*</span></label>
                                                    <div class="input_area">
                                                        <input type="text" name="phone" value="{{ $user->phone }}"
                                                            required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-12">
                                                <div class="my_listing_single">
                                                    <label>email <span class="text-danger">*</span></label>
                                                    <div class="input_area">
                                                        <input type="Email" name="email" value="{{ $user->email }}"
                                                            required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-12">
                                                <div class="my_listing_single">
                                                    <label>Address <span class="text-danger">*</span></label>
                                                    <div class="input_area">
                                                        <input type="text" name="address" value="{{ $user->address }}"
                                                            required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-12">
                                                <div class="my_listing_single">
                                                    <label>About Me <span class="text-danger">*</span></label>
                                                    <div class="input_area">
                                                        <textarea name="about" rows="3" cols="3" required>{!! $user->about !!}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-6">
                                                <div class="my_listing_single">
                                                    <label>Website</label>
                                                    <div class="input_area">
                                                        <input type="text" name="website" value="{{ $user->website }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-6">
                                                <div class="my_listing_single">
                                                    <label>Facebook</label>
                                                    <div class="input_area">
                                                        <input type="text" name="fb_link"value="{{ $user->fb_link }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-6">
                                                <div class="my_listing_single">
                                                    <label>X</label>
                                                    <div class="input_area">
                                                        <input type="text" name="x_link" value="{{ $user->x_link }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-6">
                                                <div class="my_listing_single">
                                                    <label>LinkedIn</label>
                                                    <div class="input_area">
                                                        <input type="text" name="in_link" value="{{ $user->in_link }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-6">
                                                <div class="my_listing_single">
                                                    <label>Whatsapp</label>
                                                    <div class="input_area">
                                                        <input type="text" name="wa_link" value="{{ $user->wa_link }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-6">
                                                <div class="my_listing_single">
                                                    <label>Instagram</label>
                                                    <div class="input_area">
                                                        <input type="text" name="instra_link"
                                                            value="{{ $user->instra_link }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-xl-4 col-md-5">
                                        <div class="my_listing_single">
                                            <label for="">Avatar</label>
                                            <div class="profile_pic_upload">
                                                <img src="{{ asset($user->avatar) }}" alt="{{ $user->name }} image"
                                                    class="imf-fluid w-100">
                                                <input type="file" name="avatar">
                                                <input type="hidden" name="old_avatar" value="{{ $user->avatar }}">
                                            </div>
                                        </div>

                                        <div class="my_listing_single">
                                            <label for="">Banner</label>
                                            <div class="profile_pic_upload">
                                                <img src="{{ asset($user->banner) }}" alt="{{ $user->name }} image"
                                                    class="imf-fluid w-100">
                                                <input type="file" name="banner">
                                                <input type="hidden" name="old_banner" value="{{ $user->banner }}">
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="col-12">
                                    <button type="submit" class="read_btn">Update</button>
                                </div>
                            </form>
                        </div>
                        <div class="my_listing list_mar">
                            <h4>change password</h4>
                            <form action="{{ route('user.profile-password.update') }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-xl-4 col-md-6">
                                        <div class="my_listing_single">
                                            <label>Current Password <span class="text-danger">*</span></label>
                                            <div class="input_area">
                                                <input type="password" name="current_password" placeholder="Current password" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-md-6">
                                        <div class="my_listing_single">
                                            <label>New Password <span class="text-danger">*</span></label>
                                            <div class="input_area">
                                                <input type="password" name="password" placeholder="Password" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-4">
                                        <div class="my_listing_single">
                                            <label>Confirm Password <span class="text-danger">*</span></label>
                                            <div class="input_area">
                                                <input type="password" name="password_confirmation"
                                                    placeholder="Confirm Password" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <button type="submit" class="read_btn">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
