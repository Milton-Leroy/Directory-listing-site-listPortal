@extends('admin.layouts.master')

@section('contents')
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="{{ route('admin.dashboard.index') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>About Us</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard.index') }}">Dashboard</a></div>
                <div class="breadcrumb-item">About Us</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Update About Us</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.about-us.update') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Image<span class="text-danger">*</span></label>
                                        <div id="image-preview" class="image-preview">
                                            <label for="image-upload" id="image-label">Choose File</label>
                                            <input type="file" name="image" id="image-upload" />
                                            <input type="hidden" name="old_image" value="{{ @$about->image }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="">Video Url <span class="text-danger">*</span></label>
                                    <input type="text" name="video_url" value="{{ @$about->video_url }}" class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label for="">Description <span class="text-danger">*</span></label>
                                    <textarea name="description" class="summernote">{!! @$about->description !!}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="">Button Url <span class="text-danger">*</span></label>
                                    <input type="text" name="button_url" class="form-control" value="{{ @$about->button_url }}">
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

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#image-preview').css({
                'background-image': 'url({{ asset(@$about->image) }})',
                'background-size': 'cover',
                'background-position': 'center'
            })
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
