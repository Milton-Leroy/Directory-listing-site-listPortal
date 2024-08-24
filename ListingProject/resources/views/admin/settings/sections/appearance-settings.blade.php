<div class="tab-pane fade show" id="appearance4" role="tabpanel" aria-labelledby="home-tab4">
    <div class="card borders">
        <div class="card-body">
            <form action="{{ route('admin.appearance-settings.update') }}" method="post">
                @csrf
                <div class="form-group">
                    <label>Site Default Color</label>
                    <div class="input-group colorpickerinput">
                        <input type="text" name="site_default_color" class="form-control" value="{{ config('settings.site_default_color') }}">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <i class="fas fa-fill-drip"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        $(".colorpickerinput").colorpicker({
            format: 'hex',
            component: '.input-group-append',
        });
    </script>
@endpush
