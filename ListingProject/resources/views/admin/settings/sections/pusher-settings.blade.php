<div class="tab-pane fade show" id="profile4" role="tabpanel" aria-labelledby="home-tab4">
    <div class="card borders">
        <div class="card-body">
            <form action="{{ route('admin.pusher-settings.update') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">Pusher App Id</label>
                            <input type="text" class="form-control" name="pusher_app_id"
                                value="{{ config('settings.pusher_app_id') }}"></input>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">Pusher App Key</label>
                            <input type="text" class="form-control" name="pusher_app_key"
                                value="{{ config('settings.pusher_app_key') }}"></input>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">Pusher Secret Key</label>
                            <input type="text" class="form-control" name="pusher_secret_key"
                                value="{{ config('settings.pusher_secret_key') }}"></input>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">Pusher Cluster</label>
                            <input type="text" class="form-control" name="pusher_cluster"
                                value="{{ config('settings.pusher_cluster') }}"></input>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>
</div>
