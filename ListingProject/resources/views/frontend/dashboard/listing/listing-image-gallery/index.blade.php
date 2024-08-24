@extends('frontend.layouts.master')

@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="{{ asset('frontend/css/summernote.min.css') }}" rel="stylesheet">
    <style>
        label {
            margin-top: 15px;
        }
    </style>
@endpush

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
                            <a href="{{ route('user.listing.index') }}" class="read_btn"><i
                                    class="fas fa-chevron-left"></i></a>
                            <h4>Image Gallery ({{ $listingTitle->title }})</h4>
                            <form action="{{ route('user.listing-image-gallery.store') }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    @if ($subscription->package->number_of_photos === -1)
                                        <label class="mb-2" for="">Image <code> ( Unlimited Images ) ( Multi
                                                images supported)</code></label>
                                    @else
                                        <label class="mb-2" for="">Image <code> (
                                                {{ $subscription->package->number_of_photos }} Images is the max) ( Multi
                                                images supported)</code></label>
                                    @endif
                                    <input type="file" name="images[]" class="form-control" multiple>
                                    <input type="hidden" name="listing_id" class="form-control"
                                        value="{{ request()->id }}">
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="read_btn mt-4">Upload</button>
                                </div>
                            </form>
                        </div>

                        <div class="my_listing mt-4">
                            <h4>All Images</h4>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Image</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($images as $image)
                                        <tr>
                                            <th scope="row">{{ ++$loop->index }}</th>
                                            <td>
                                                <img style="width: 100px !important;" src="{{ asset($image->image) }}"
                                                    alt="image of">
                                            </td>
                                            <td>
                                                <a href="{{ route('user.listing-image-gallery.destroy', $image->id) }}"
                                                    class="btn btn-sm btn-danger delete-item"><i
                                                        class="fas fa-trash"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script src="{{ asset('frontend/js/summernote.min.js') }}"></script>
    <script src="{{ asset('admin/assets/modules/upload-preview/assets/js/jquery.uploadPreview.min.js') }}"></script>
    <script src="{{ asset('admin/assets/modules/select2/dist/js/select2.full.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            $('.summernote').summernote();
        });

        $(".select2").select2();

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

        $('body').on('click', '.delete-item', function(e) {
            e.preventDefault();

            let url = $(this).attr('href');
            console.log(url);


            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        method: 'DELETE',
                        url: url,
                        data: {
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(response) {
                            if (response.status === "success") {
                                Swal.fire({
                                    title: "Deleted!",
                                    text: response.message,
                                    icon: "success"
                                });
                                window.location.reload();
                            } else if (response.status === "error") {
                                Swal.fire({
                                    title: "Something went wrong",
                                    text: response.message,
                                    icon: "eror"
                                });
                                window.location.reload();
                            }
                        },
                        eror: function(xhr, status, eror) {
                            console.log(eror)
                        }
                    })
                }
            });
        })
    </script>
@endpush
