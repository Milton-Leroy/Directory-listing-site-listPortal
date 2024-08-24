@extends('frontend.layouts.master')

@section('contents')
     <!--==========================
        BREADCRUMB PART START
    ===========================-->
    <div id="breadcrumb_part">
        <div class="bread_overlay">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 text-center text-white">
                        <h4>About Us</h4>
                        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ url('/') }}"> Home </a></li>
                                <li class="breadcrumb-item active" aria-current="page"> About </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--==========================
        BREADCRUMB PART END
    ===========================-->


    <!--==========================
        ABOUT  START
    ===========================-->
    <section id="about_page">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-xl-6 col-lg-6">
                    <div class="about_text">
                        {!! @$about->description !!}
                        <a href="{{ @$about->buttton_url }}">learn more</a>
                    </div>
                </div>
                <div class="col-xl-5 col-lg-6">
                    <div class="about_img">
                        @if(@$about->video_url)
                        <img src="{{ getYtThumbnail($about->video_url) }}" alt="about" style="height: 600px !important;" class="img-fluid w-100">
                        @endif
                        <a class="venobox" data-autoplay="true" data-vbtype="video" href="{{ @$about->video_url }}">
                            <i class=" fas fa-play"></i>
                        </a>
                        <div class="img_2">
                            <img src="{{ asset(@$about->image) }}" alt="about" class="img-fluid w-100">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--==========================
        ABOUT END
    ===========================-->

    <!--==========================
            FEATURES PART START
        ===========================-->
        @include('frontend.home.sections.features-section')
    <!--==========================
            FEATURES PART END
        ===========================-->


    <!--==========================
            COUNTER PART START
        ===========================-->
        @include('frontend.home.sections.counter-section')
    <!--==========================
            COUNTER PART END
        ===========================-->


    <!--==========================
            FEATURED CATEGORY START
        ===========================-->
        @include('frontend.home.sections.featured-category-section')
    <!--==========================
            FEATURED CATEGORY END
        ===========================-->

@endsection

