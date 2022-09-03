@extends('layouts.desokupa.layout')
@section('title')
    <title>{{ $seo_text->title }}</title>
@endsection
@section('meta')
    <meta name="description" content="{{ $seo_text->meta_description }}">
@endsection

@section('user-content')
<!--===== Inicio Banner =====-->
<section class="wsus__banner">
  <div class="row banner_slider">
  @foreach ($sliders as $slider)
    <div class="col-xl-12">
      <div class="wsus__banner_single" style="background: url({{ asset($slider->image) }});"></div>
    </div>
  @endforeach
  </div>
</section>
<!--===== FIN BANNER =====-->

<!--===== INICIO ABOUT =====-->
@php
  $about_section=$sections->where('id',11)->first();
@endphp

@if ($about_section->show_homepage==1)
  <!--=====ABOUT START=====-->
  <section class="wsus__about mt_100 mb_35 xs_mt_75">
    <div class="container">
      <div class="row">
        <div class="col-xl-7 col-lg-7">
          <div class="wsus__about_counter">
            <div class="row">
              <div class="col-12">
                <div class="wsus__section_heading mb_40 mt_30">
                  <h2>{{ $websiteLang->where('lang_key','about_us')->first()->custom_text }}</h2>
                </div>
              </div>
              <div class="col-12">
                <div > {!! clean($aboutUs->about) !!}     </div>
                <a href="{{ route('desokupa.about.us') }}">{{ $websiteLang->where('lang_key','read_more')->first()->custom_text }}</a>
              </div>
          </div>
        </div>
      </div>
      <div class="col-xl-5 col-lg-5">
        <div class="wsus__about_img">
          <img src="{{ asset($aboutUs->image) }}" alt="about images" class="img-fluid w-100">
        </div>
      </div>

      </div>
    </div>
  </section>
  <!--===== FIN ABOUT=====-->
@endif


<!--=====BLOG START=====-->
@php
  $blog_section=$sections->where('id',7)->first();
@endphp
@if ($blog_section->show_homepage==1)
  <section class="wsus__blog mt_90 xs_mt_70">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="wsus__section_heading text-center mb_60">
            <h2>{{ $blog_section->header }}</h2>
            <span>{{ $blog_section->description }}</span>
          </div>
        </div>
      </div>
      <div class="row">
        @php
            $colorId=1;
        @endphp
        @foreach ($blogs->take($blog_section->content_quantity) as $index => $blog_item)
        @php
            if($index %4 ==0){
                $colorId=1;
            }

            $color="";
            if($colorId==1){
                $color="";
            }else if($colorId==2){
                $color="oreangr";
            }else if($colorId==3){
                $color="gren";
            }else if($colorId==4){
                $color="blur";
            }
        @endphp
        <div class="col-xl-4 col-md-6">
          <div class="wsus__single_blog">
            <div class="wsus__blog_img">
              <img src="{{ asset($blog_item->image) }}" alt="blog items" class="img-fluid w-100">
              <span class="category {{ $color }}">{{ $blog_item->category->name }}</span>
            </div>
            <div class="wsus__blog_text">
              <p class="blog_date">
                <span>{{ $blog_item->created_at->format('d') }}</span>
                <span>{{ $blog_item->created_at->format('m') }}</span>
                <span>{{ $blog_item->created_at->format('Y') }}</span>
              </p>
              <span class="comment"><i class="fal fa-comment-dots"></i> {{ $blog_item->comments->count() }}</span>
              <div class="wsus__blog_header d-flex flex-wrap align-items-center justify-content-between">
                <div class="blog_header_images d-flex flex-wrap align-items-center w-100">
                  <img src="{{ $blog_item->admin->image ? url($blog_item->admin->image) : url($default_profile_image->image) }}" alt="bloger" class="img-fluid img-thumbnail">
                  <span>{{ $blog_item->admin->name }}</span>
                </div>
              </div>
              <a href="{{ route('blog.details',$blog_item->slug) }}" class="blog_title">{{ $blog_item->title }}</a>
              <p>{{ $blog_item->short_description }}</p>
            </div>
          </div>
        </div>
        @php
            $colorId ++;
        @endphp
        @endforeach
      </div>
    </div>
  </section>
  @endif
  <!--=====BLOG END=====-->



  <!--=====TESTIMONIAL START=====-->
  @php
      $testimonial_section=$sections->where('id',8)->first();
  @endphp
  @if ($testimonial_section->show_homepage==1)
    <section class="wsus__testimonial mt_75 xs_mt_50 pt_90 xs_pt_65 pb_85 xs_pb_100" style="background: url({{ asset('user/images/bg_shape.jpg') }});">
      <div class="container">
        <div class="row justify-content-between align-content-center">
          <div class="col-xl-4 col-lg-4">
            <div class="wsus__section_heading d-flex align-content-center justify-content-center flex-column">
              <h2>{{ $testimonial_section->header }}</h2>
              <span>{{ $testimonial_section->description }}</span>
            </div>
          </div>
          <div class="col-xl-7 col-lg-8">
            <div class="row testi_slider">
              @foreach ($testimonials->take($testimonial_section->content_quantity) as $testimonial_item)
              <div class="col-12">
                <div class="wsus__testi_item">
                  <div class="row">
                    <div class="col-xl-5 col-md-5">
                      <div class="wsus__testi_img d-flex justify-content-center align-items-center">
                        <i class="fal fa-flower top_icon"></i>
                        <img src="{{ asset($testimonial_item->image) }}" alt="Clients" class="img-fluid img-thumbnail">
                        <i class="fas fa-flower bottom_icon"></i>
                      </div>
                    </div>
                    <div class="col-xl-7 col-md-7">
                      <div class="wsus__testi_text">
                        <h2>{{ $testimonial_item->name }}</h2>
                        <h5>{{ $testimonial_item->designation }}</h5>
                        <p><i class="fal fa-quote-right"></i> {{ $testimonial_item->description }}</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              @endforeach
            </div>
          </div>
        </div>
      </div>
    </section>
    <!--=====TESTIMONIAL END=====-->
  @endif

  @include('user.formContacto');
@endsection
