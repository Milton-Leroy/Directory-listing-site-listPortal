@extends('admin.layouts.master')

@section('contents')
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="{{ route('admin.testimonials.index') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>Testimonials</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard.index') }}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('admin.testimonials.index') }}">Testimonials</a></div>
                <div class="breadcrumb-item">Update</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Update Testimonial</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.testimonials.update', $testimonial->id) }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Image<span class="text-danger">*</span></label>
                                        <div id="image-preview" class="image-preview">
                                            <label for="image-upload" id="image-label">Choose File</label>
                                            <input type="file" name="image" id="image-upload" />
                                            <input type="hidden" name="old_image" value="{{ $testimonial->image }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="">Name <span class="text-danger">*</span></label>
                                    <input type="text" name="name" class="form-control"
                                        value="{{ $testimonial->name }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="">Title <span class="text-danger">*</span></label>
                                    <input type="text" name="title" class="form-control"
                                        value="{{ $testimonial->title }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="">Rating<span class="text-danger">*</span></label>
                                    <select name="rating" class="form-control">
                                        <option @selected($testimonial->rating === 1) value="1">1</option>
                                        <option @selected($testimonial->rating === 2) value="2">2</option>
                                        <option @selected($testimonial->rating === 3) value="3">3</option>
                                        <option @selected($testimonial->rating === 4) value="4">4</option>
                                        <option @selected($testimonial->rating === 5) value="5">5</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="">Review <span class="text-danger">*</span></label>
                                    <textarea name="review" class="form-control">{{ $testimonial->review }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="">Status <span class="text-danger">*</span></label>
                                    <select name="status" id="" class="form-control">
                                        <option @selected($testimonial->status == 1) value="1">Active</option>
                                        <option @selected($testimonial->status == 0) value="0">Inactive</option>
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

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#image-preview').css({
                'background-image': 'url({{ asset($testimonial->image) }})',
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
