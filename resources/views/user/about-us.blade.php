@extends('layouts.user.layout')
@section('title')
    <title>{{ $seo_text->title }}</title>
@endsection
@section('meta')
    <meta name="description" content="{{ $seo_text->meta_description }}">
@endsection

@section('user-content')


  <!--===BREADCRUMB PART START====-->
  <section class="wsus__breadcrumb" style="background: url({{ url($banner_image->image) }});">
    <div class="wsus_bread_overlay">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <h4>{{ $menus->where('id',4)->first()->navbar }}</h4>
                    <nav style="--bs-breadcrumb-divider: '-';" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ $menus->where('id',1)->first()->navbar }}</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $menus->where('id',4)->first()->navbar }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</section>
<!--===BREADCRUMB PART END====-->


<!--=========ABOUT US START============-->
<section class="wsus__about_page mt_45 mb_45">
  <div class="container">
    @php
        $about_section=$sections->where('id',1)->first();
    @endphp
    @if ($about_section->show_homepage==1)
    <div class="row">
      {{-- IMAGEN --}}
      <div class="col-xl-5 col-lg-5">
        <div class="wsus__about_img about_page_img">
          <img src="{{ asset($about->image) }}" alt="about images" class="img-fluid w-100">
        </div>
      </div>
      {{-- CONTENIDO --}}
      <div class="col-xl-7 col-lg-7">
        <div class="col-12">
          <div class="wsus__about_tab">
            <ul class="nav nav-pills" id="pills-tab" role="tablist">
              <li class="nav-item" role="presentation">
                <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">{{ $websiteLang->where('lang_key','about_us')->first()->custom_text }}</button>
              </li>
              <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">{{ $websiteLang->where('lang_key','service')->first()->custom_text }}</button>
              </li>
              <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">{{ $websiteLang->where('lang_key','history')->first()->custom_text }}</button>
              </li>
            </ul>
            <div class="tab-content" id="pills-tabContent">
              <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                {!! clean($about->about) !!}
              </div>
              <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                {!! clean($about->service) !!}
              </div>
              <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                {!! clean($about->history) !!}
              </div>
            </div>

          </div>
        </div>


        @php
            $award_section=$sections->where('id',2)->first();
        @endphp

        @if ($award_section->show_homepage==1)
            <div class="wsus__about_counter">
                <div class="row">
                    @foreach ($overviews->take($award_section->content_quantity) as $overview)
                        <div class="col-xl-6 col-md-6">
                            <div class="wsus__about_counter_single text-center">
                                <div class="wsus__about_counter_icon">
                                    <i class="{{ $overview->icon }}"></i>
                                </div>
                                <div class="wsus__about_counter_text">
                                    <h3 class="counter m-0">{{ $overview->qty }}</h3>
                                    <p>{{ $overview->name }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
      @endif
      </div>
    </div>
    @endif

{{-- 
@include('user.team')
@include('user.subscribeForm') --}}
  </div>
</section>
<!--=========ABOUT US END==========-->

@endsection
