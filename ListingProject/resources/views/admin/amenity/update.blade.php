@extends('admin.layouts.master')

@section('contents')
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="{{ route('admin.amenity.index') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>Amenity</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard.index') }}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('admin.amenity.index') }}">Amenity</a></div>
                <div class="breadcrumb-item">Update</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Update Category</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.amenity.update', $amenity->id) }}" method="post">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="">Icon</label>
                                    <div name="icon" data-align="left" data-icon="{{ $amenity->icon }}" data-selected-class="btn-info" data-unselected-class="" role="iconpicker"></div>
                                </div>
                                <div class="form-group">
                                    <label for="">Name <span class="text-danger">*</span></label>
                                    <input type="text" name="name" value="{{ $amenity->name }}" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="">Status <span class="text-danger">*</span></label>
                                    <select name="status" id="" class="form-control">
                                        <option @selected($amenity->staus === 1) value="1">Active</option>
                                        <option @selected($amenity->staus === 0) value="0">Inactive</option>
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

