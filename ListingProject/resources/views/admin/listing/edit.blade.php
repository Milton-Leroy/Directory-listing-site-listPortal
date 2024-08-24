@extends('admin.layouts.master')

@section('contents')
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="{{ route('admin.listing.index') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>Listing</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard.index') }}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('admin.listing.index') }}">Listing</a></div>
                <div class="breadcrumb-item">Update</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Update Listing</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.listing.update', $listing->id) }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Image </label>
                                            <div id="image-preview" class="image-preview">
                                                <label for="image-upload" id="image-label">Choose File</label>
                                                <input type="file" name="image" id="image-upload" />
                                                <input type="hidden" name="old_image" value="{{ $listing->image }}" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Thumbnail Image</label>
                                            <div id="image-preview-2" class="image-preview">
                                                <label for="image-upload-2" id="image-label-2">Choose File</label>
                                                <input type="file" name="thumbnail_image" id="image-upload-2" />
                                                <input type="hidden" name="old_thumbnail"
                                                    value="{{ $listing->thumbnail_image }}" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="">Title <span class="text-danger">*</span></label>
                                    <input type="text" name="title" value="{{ $listing->title }}" class="form-control"
                                        required>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Category <span class="text-danger">*</span></label>
                                            <select name="category_id" id="" class="form-control" required>
                                                <option value="" disabled>Select</option>
                                                @foreach ($categories as $category)
                                                    <option @selected($category->id === $listing->category_id) value="{{ $category->id }}">
                                                        {{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Location<span class="text-danger">*</span></label>
                                            <select name="location_id" id="" class="form-control" required>
                                                <option value="" disabled>Select</option>
                                                @foreach ($locations as $location)
                                                    <option @selected($location->id === $listing->location_id) value="{{ $location->id }}">
                                                        {{ $location->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="">Address <span class="text-danger">*</span></label>
                                    <input type="text" name="address" value="{{ $listing->address }}"
                                        class="form-control" required>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Phone <span class="text-danger">*</span></label>
                                            <input type="tel" name="phone" value="{{ $listing->phone }}"
                                                id="" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Email <span class="text-danger">*</span></label>
                                            <input type="email" name="email" value="{{ $listing->email }}"
                                                class="form-control" required>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Website </label>
                                            <input type="url" name="website" value="{{ $listing->website }}"
                                                class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Facebook Link</label>
                                            <input type="url" name="facebook_link"
                                                value="{{ $listing->facebook_link }}" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">X Link </label>
                                            <input type="url" name="x_link" value="{{ $listing->x_link }}"
                                                class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Linkedin Link</label>
                                            <input type="url" name="linkedin_link"
                                                value="{{ $listing->linkedin_link }}" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Whatsapp Link</label>
                                            <input type="url" name="whatsapp_link"
                                                value="{{ $listing->whatsapp_link }}" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Instagram Link </label>
                                            <input type="url" name="instagram_link"
                                                value="{{ $listing->instagram_link }}" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            @if ($listing->file)
                                                <div>
                                                    <i class="fas fa-file-alt" style="font-size: 70px;"></i>
                                                </div>
                                            @endif
                                            <label for="">Attachment </label>
                                            <input type="file" name="attachment" class="form-control">
                                            <input type="hidden" name="old_attachment" value="{{ $listing->file }}" class="form-control">
                                        </div>
                                    </div>

                                </div>

                                <div class="form-group">
                                    <label>Amenities </label>
                                    <select class="form-control select2" name="amenity_id[]" multiple="">
                                        @foreach ($amenities as $amenity)
                                            <option @selected($amenity->id === $listing->amenity_id) value="{{ $amenity->id }}">
                                                {{ $amenity->name }}</option>
                                        @endforeach
                                    </select>

                                </div>

                                <div class="form-group">
                                    <label for="">Description <span class="text-danger">*</span></label>
                                    <textarea name="description" class="summernote" required>{!! $listing->description !!}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="">Google Map Embed Code <span class="text-danger">(size: 1000x400)</span></label>
                                    <textarea name="google_map_embed_code" class="form-control">{!! $listing->google_map_embed_code !!}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="">Seo Title</label>
                                    <input type="text" name="seo_title" value="{{ $listing->seo_title }}"
                                        class="form-control">
                                </div>

                                <div class="form-group">
                                    <label for="">Seo Description </label>
                                    <textarea name="seo_description" class="form-control">{!! $listing->seo_description !!}</textarea>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Status <span class="text-danger">*</span></label>
                                            <select name="status" id="" class="form-control" required>
                                                <option @selected($listing->status === 1) value="1">Active</option>
                                                <option @selected($listing->status === 0) value="0">Inactive</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Is Featured <span class="text-danger">*</span></label>
                                            <select name="is_featured" id="" class="form-control" required>
                                                <option @selected($listing->is_featured === 0) value="0">No</option>
                                                <option @selected($listing->is_featured === 1) value="1">Yes</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Is Verified <span class="text-danger">*</span></label>
                                            <select name="is_verified" id="" class="form-control" required>
                                                <option @selected($listing->is_verified === 0) value="0">No</option>
                                                <option @selected($listing->is_verified === 1) value="1">Yes</option>
                                            </select>
                                        </div>
                                    </div>
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
        var listingAmenities = {!! json_encode($listingAmenities) !!};
        console.log(listingAmenities);

        $('.select2').select2().val(listingAmenities).trigger("change");

        $(document).ready(function() {
            $('#image-preview').css({
                'background-image': 'url({{ asset($listing->image) }})',
                'background-size': 'cover',
                'background-position': 'center'
            })

            $('#image-preview-2').css({
                'background-image': 'url({{ asset($listing->thumbnail_image) }})',
                'background-size': 'cover',
                'background-position': 'center'
            })
        })

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
