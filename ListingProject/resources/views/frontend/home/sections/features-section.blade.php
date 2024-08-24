<section id="wsus__features">
    <div class="container">
        <div class="row">
            <div class="col-xl-5 m-auto">
                <div class="wsus__heading_area">
                    <h2>{{ @$sectionTitles->our_feature_title }}</h2>
                    <p> {{ @$sectionTitles->our_feature_sub_title }}</p>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach (@$ourFeatures as $ourFeature)
                <div class="col-xl-4 col-md-6">
                    <div class="wsus__feature_single">
                        <div class="icon">
                            <i class="{{ @$ourFeature->icon }}"></i>
                        </div>
                        <h5>{{ @$ourFeature->title }}</h5>
                        <p>{{ @$ourFeature->short_description }}</p>
                        <span>{{ ++$loop->index }}</span>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
