<div class="tab-pane fade show active" id="home4" role="tabpanel" aria-labelledby="home-tab4">
    <div class="card borders">
        <div class="card-body">
            <form action="{{ route('admin.general-settings.update') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">Site Name</label>
                            <input type="text" class="form-control" name="site_name"
                                value="{{ config('settings.site_name') }}"></input>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Site Email</label>
                            <input type="email" class="form-control" name="site_email"
                                value="{{ config('settings.site_email') }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Site Phone</label>
                            <input type="tel" class="form-control" name="site_phone"
                                value="{{ config('settings.site_phone') }}">
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">Site Time Zone</label>
                            <select class="form-control select2" name="site_timezone">
                                <option value="">Select</option>
                                <option value="UTC">UTC</option>
                                @foreach (config('time-zone') as $key => $timezone)
                                    <option @selected($key === config('settings.site_timezone')) value="{{ $key }}">
                                        {{ $key }} - {{ $timezone }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">Site Default Currency</label>
                            <select class="form-control select2" name="site_default_currency">
                                <option value="">Select</option>
                                @foreach (config('currencies.currency_list') as $key => $currency)
                                    <option @selected($currency === config('settings.site_default_currency')) value="{{ $currency }}">
                                        {{ $key }} ({{ $currency }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Site Currency Icon</label>
                            <input type="text" class="form-control" name="site_currency_icon"
                                value="{{ config('settings.site_currency_icon') }}"></input>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Site Currency Position</label>
                            <select class="form-control" name="site_currency_position">
                                <option @selected(config('settings.site_currency_position') === 'left') value="left">Left</option>
                                <option @selected(config('settings.site_currency_position') === 'right') value="right">Right</option>
                            </select>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>
</div>
