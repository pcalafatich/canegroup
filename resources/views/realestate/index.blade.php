@extends('layouts.user.layout')
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
      <div class="wsus__banner_single" style="background: url({{ asset($slider->image) }});">
        {{-- <div class="container banner_content">
          <div class="row">
              <div class="col-xl-5">
                <div class="wsus__banner_text">
                  <a href="javascript:;">{{ $slider->title }}</a>
                  </div>
                </div>
          </div>
        </div> --}}
      </div>
    </div>
  @endforeach
</div>
{{-- Formulario de Busqueda --}}
<div class="container wsus__for_search">
<div class="wsus__banner_search">
  {{-- Encuentre su propiedad --}}
  <h4>{{ $websiteLang->where('lang_key','find_property')->first()->custom_text }}</h4>
  {{-- Botones opciones  --}}
  <ul class="nav nav-pills" id="pills-tab" role="tablist">
    {{-- Todos - Comprar --}}
    <li class="nav-item" role="presentation">
      <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">{{ $websiteLang->where('lang_key','buy')->first()->custom_text }}</button>
    </li>
    {{-- Vender --}}
    <li class="nav-item" role="presentation">
      <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">{{ $websiteLang->where('lang_key','sell')->first()->custom_text }}</button>
    </li>
    {{-- Alquilar --}}
    <li class="nav-item" role="presentation">
      <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">{{ $websiteLang->where('lang_key','rent')->first()->custom_text }}</button>
    </li>
  </ul>

  <div class="tab-content" id="pills-tabContent">
    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
      <form method="GET" action="{{ route('search-property') }}">
        <div class="wsus__serach_single">
          <select class="select_2" name="city_id">
              <option value="">{{ $websiteLang->where('lang_key','select_location')->first()->custom_text }}</option>
              @foreach ($cities as $city_item)
              <option value="{{ $city_item->id }}">{{ $city_item->name }}</option>
              @endforeach
          </select>
        </div>
        <div class="wsus__serach_single">
          <select class="select_2" name="property_type">
              <option value="">{{ $websiteLang->where('lang_key','property_type_s')->first()->custom_text }}</option>
              @foreach ($propertyTypes as $property_type_item)
                  <option value="{{ $property_type_item->id }}">{{ $property_type_item->type }}</option>
              @endforeach
          </select>
        </div>
        <input type="hidden" name="page_type" value="list_view">
          <input type="hidden" name="purpose_type" value="">
        <div class="wsus__serach_single">
          <input type="text" placeholder="{{ $websiteLang->where('lang_key','search_type')->first()->custom_text }}" name="search">
          <button class="common_btn" type="submit">{{ $websiteLang->where('lang_key','search_property')->first()->custom_text }}</button>
        </div>
      </form>
    </div>
    <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
      <form method="GET" action="{{ route('search-property') }}">
          <div class="wsus__serach_single">
            <select class="select_2" name="city_id">
                <option value="">{{ $websiteLang->where('lang_key','select_location')->first()->custom_text }}</option>
                @foreach ($cities as $city_item)
                <option value="{{ $city_item->id }}">{{ $city_item->name }}</option>
                @endforeach
            </select>
          </div>
          <div class="wsus__serach_single">
            <select class="select_2" name="property_type">
                <option value="">{{ $websiteLang->where('lang_key','property_type_s')->first()->custom_text }}</option>
                @foreach ($propertyTypes as $property_type_item)
                    <option value="{{ $property_type_item->id }}">{{ $property_type_item->type }}</option>
                @endforeach
            </select>
          </div>
          <input type="hidden" name="page_type" value="list_view">
          <input type="hidden" name="purpose_type" value="1">
          <div class="wsus__serach_single">
            <input type="text" placeholder="{{ $websiteLang->where('lang_key','search_type')->first()->custom_text }}" name="search">
            <button class="common_btn" type="submit">{{ $websiteLang->where('lang_key','search_property')->first()->custom_text }}</button>
          </div>
      </form>
    </div>
    <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
      <form method="GET" action="{{ route('search-property') }}">
          <div class="wsus__serach_single">
            <select class="select_2" name="city_id">
                <option value="">{{ $websiteLang->where('lang_key','select_location')->first()->custom_text }}</option>
                @foreach ($cities as $city_item)
                <option value="{{ $city_item->id }}">{{ $city_item->name }}</option>
                @endforeach
            </select>
          </div>
          <div class="wsus__serach_single">
            <select class="select_2" name="property_type">
                <option value="">{{ $websiteLang->where('lang_key','property_type_s')->first()->custom_text }}</option>
                @foreach ($propertyTypes as $property_type_item)
                    <option value="{{ $property_type_item->id }}">{{ $property_type_item->type }}</option>
                @endforeach
            </select>
          </div>
          <input type="hidden" name="page_type" value="list_view">
          <input type="hidden" name="purpose_type" value="2">
          <div class="wsus__serach_single">
            <input type="text" placeholder="{{ $websiteLang->where('lang_key','search_type')->first()->custom_text }}" name="search">
            <button class="common_btn" type="submit">{{ $websiteLang->where('lang_key','search_property')->first()->custom_text }}</button>
          </div>
      </form>
    </div>

  </div>
</div>
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
        
        {{--  CONTENIDO QUIENES SOMOS --}}
        <div class="col-xl-7 col-lg-7">
          <div class="wsus__about_counter">
            <div class="row">
              <div class="col-12">
                <div class="wsus__section_heading mb_10 mt_10">
                  <h2>{{ $websiteLang->where('lang_key','about_us')->first()->custom_text }}</h2>
                </div>
              </div>
              <div class="col-12">
                <div class="about_small"> {!! clean($aboutUs->about) !!} 
                  <a href="{{ route('realestate.about.us') }}">{{ $websiteLang->where('lang_key','read_more')->first()->custom_text }}</a>
                </div>
              </div>
              @foreach ($overviews->take($about_section->content_quantity) as $overview)
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
      </div>
      {{-- FIN CONTENIDO QUIENES SOMOS --}}
      {{-- IMAGEN QUIENES SOMOS --}}
      <div class="col-xl-5 col-lg-5">
        <div class="wsus__about_img">
          <img src="{{ asset($aboutUs->image) }}" alt="about images" class="img-fluid w-100">
        </div>
      </div>
      {{-- FIN IMAGEN QUIENES SOMOS --}}
    </div>
  </div>
</section>
  <!--===== FIN ABOUT=====-->
@endif

<!--===== REALESTATE SERVICIOS =====-->
@php
    $servicios_section=$sections->where('id',6)->first();
@endphp

<div class="container">
@if ($servicios_section->show_homepage==1)
    <div class="mt_35 mb_35">
        <div class="row">
        <div class="col-12">
          <div class="wsus__section_heading text-center mb_15">
            <h2>{{ $servicios_section->header }}</h2>
            <p>{{ $servicios_section->description }}</p>
          </div>
        </div>
      </div>
      {{-- LISTADO REALESTATE SERVICIOS --}}
      <div class="row">
        @foreach ($realestateservices->take($servicios_section->content_quantity) as $item)
        <div class="col-xl-4 col-sm-6 col-lg-4">
          <div class="wsus__single_consulting_service">
            <div class="wsus__single_consulting_service_img">
              <img src="{{ asset($item->image) }}" alt="imagen realestate servicios" class="imf-fluid w-100">
            </div>
            <h4>{{ $item->name }}</h4>
            <p>{{ $item->description }}</p>
            <a href="/page/gestion-laboral">Ver Más</a>
            {{-- <a href="{{ route('book') }}"></a>   --}}
          </div>
        </div>
        @endforeach
      </div>
    </div>
    @endif
  </div>
  <!--===== FIN REALESTATE SERVICIOS =====-->

  <!--===== REALESTATE `PROPIEDADES TOP =====-->

  @php
    $top_property_section=$sections->where('id',3)->first();
  @endphp

  @if ($top_property_section->show_homepage==1)
  <!--=====NEW PROPERTIES END=====-->
  <section class="wsus__new_properties pt_30 xs_pt_35 pb_75 xs_pb_50 mt_100 xs_mt_75">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="wsus__section_heading text-center mb_60">
            <h2>{{ $top_property_section->header }}</h2>
            <span>{{ $top_property_section->description }}</span>
          </div>
        </div>
      </div>
      <div class="row">
        @foreach ($properties->where('top_property',1)->take($top_property_section->content_quantity) as $top_item)
        @if ($top_item->expired_date==null)
        <div class="col-xl-4 col-md-6">
          <div class="wsus__single_property">
            <div class="wsus__single_property_img">
              <img src="{{ asset($top_item->thumbnail_image) }}" alt="properties" class="img-fluid w-100">

                @if ($top_item->property_purpose_id==1)
                <span class="sale">{{ $top_item->propertyPurpose->custom_purpose }}</span>

                @elseif($top_item->property_purpose_id==2)
                <span class="sale">{{ $top_item->propertyPurpose->custom_purpose }}</span>
                @endif

                @if ($top_item->urgent_property==1)
                    <span class="rent">{{ $websiteLang->where('lang_key','urgent')->first()->custom_text }}</span>
                @endif

            </div>
            <div class="wsus__single_property_text">
                @if ($top_item->property_purpose_id==1)
                    <span class="tk">{{ $currency->currency_icon }}{{ $top_item->price }}</span>
                @elseif ($top_item->property_purpose_id==2)
                <span class="tk">{{ $currency->currency_icon }}{{ $top_item->price }} /
                    @if ($top_item->period=='Daily')
                    <span>{{ $websiteLang->where('lang_key','daily')->first()->custom_text }}</span>
                    @elseif ($top_item->period=='Monthly')
                    <span>{{ $websiteLang->where('lang_key','monthly')->first()->custom_text }}</span>
                    @elseif ($top_item->period=='Yearly')
                    <span>{{ $websiteLang->where('lang_key','yearly')->first()->custom_text }}</span>
                    @endif
                </span>
                @endif

                <a href="{{ route('property.details',$top_item->slug) }}" class="title w-100">{{ $top_item->title }}</a>
                <ul class="d-flex flex-wrap justify-content-between">
                    <li><i class="fal fa-bed"></i> {{ $top_item->number_of_bedroom }} {{ $websiteLang->where('lang_key','bed')->first()->custom_text }}</li>
                    <li><i class="fal fa-shower"></i> {{ $top_item->number_of_bathroom }} {{ $websiteLang->where('lang_key','bath')->first()->custom_text }}</li>
                    <li><i class="fal fa-draw-square"></i> {{ $top_item->area }} {{ $websiteLang->where('lang_key','sqft_s')->first()->custom_text }}</li>
                </ul>
                <div class="wsus__single_property_footer d-flex justify-content-between align-items-center">
                  <a href="{{ route('search-property',['page_type' => 'list_view','property_type' => $top_item->propertyType->id]) }}" class="category">{{ $top_item->propertyType->type }}</a>

                @php
                    $total_review=$top_item->reviews->where('status',1)->count();
                    if($total_review > 0){
                        $avg_sum=$top_item->reviews->where('status',1)->sum('avarage_rating');

                        $avg=$avg_sum/$total_review;
                        $intAvg=intval($avg);
                        $nextVal=$intAvg+1;
                        $reviewPoint=$intAvg;
                        $halfReview=false;
                        if($intAvg < $avg && $avg < $nextVal){
                            $reviewPoint= $intAvg + 0.5;
                            $halfReview=true;
                        }
                    }
                @endphp

                @if ($total_review > 0)
                  <span class="rating">{{ sprintf("%.1f", $reviewPoint) }}

                    @for ($i = 1; $i <=5; $i++)
                        @if ($i <= $reviewPoint)
                            <i class="fas fa-star"></i>
                        @elseif ($i> $reviewPoint )
                            @if ($halfReview==true)
                            <i class="fas fa-star-half-alt"></i>
                                @php
                                    $halfReview=false
                                @endphp
                            @else
                            <i class="fal fa-star"></i>
                            @endif
                        @endif
                    @endfor
                  </span>
                @else
                    <span class="rating">0.0
                        @for ($i = 1; $i <=5; $i++)
                        <i class="fal fa-star"></i>
                        @endfor
                    </span>
                @endif
                </div>
            </div>
          </div>
        </div>
        @elseif($top_item->expired_date >= date('Y-m-d'))
            <div class="col-xl-4 col-md-6">
                <div class="wsus__single_property">
                <div class="wsus__single_property_img">
                    <img src="{{ asset($top_item->thumbnail_image) }}" alt="properties" class="img-fluid w-100">

                    @if ($top_item->property_purpose_id==1)
                    <span class="sale">{{ $top_item->propertyPurpose->custom_purpose }}</span>

                    @elseif($top_item->property_purpose_id==2)
                    <span class="sale">{{ $top_item->propertyPurpose->custom_purpose }}</span>
                    @endif

                    @if ($top_item->urgent_property==1)
                        <span class="rent">{{ $websiteLang->where('lang_key','urgent')->first()->custom_text }}</span>
                    @endif

                </div>
                <div class="wsus__single_property_text">
                    @if ($top_item->property_purpose_id==1)
                        <span class="tk">{{ $currency->currency_icon }}{{ $top_item->price }}</span>
                    @elseif ($top_item->property_purpose_id==2)
                    <span class="tk">{{ $currency->currency_icon }}{{ $top_item->price }} /
                        @if ($top_item->period=='Daily')
                        <span>{{ $websiteLang->where('lang_key','daily')->first()->custom_text }}</span>
                        @elseif ($top_item->period=='Monthly')
                        <span>{{ $websiteLang->where('lang_key','monthly')->first()->custom_text }}</span>
                        @elseif ($top_item->period=='Yearly')
                        <span>{{ $websiteLang->where('lang_key','yearly')->first()->custom_text }}</span>
                        @endif
                    </span>
                    @endif

                    <a href="{{ route('property.details',$top_item->slug) }}" class="title w-100">{{ $top_item->title }}</a>
                    <ul class="d-flex flex-wrap justify-content-between">
                        <li><i class="fal fa-bed"></i> {{ $top_item->number_of_bedroom }} {{ $websiteLang->where('lang_key','bed')->first()->custom_text }}</li>
                        <li><i class="fal fa-shower"></i> {{ $top_item->number_of_bathroom }} {{ $websiteLang->where('lang_key','bath')->first()->custom_text }}</li>
                        <li><i class="fal fa-draw-square"></i> {{ $top_item->area }} {{ $websiteLang->where('lang_key','sqft_s')->first()->custom_text }}</li>
                    </ul>
                    <div class="wsus__single_property_footer d-flex justify-content-between align-items-center">
                        <a href="{{ route('search-property',['page_type' => 'list_view','property_type' => $top_item->propertyType->id]) }}" class="category">{{ $top_item->propertyType->type }}</a>

                    @php
                        $total_review=$top_item->reviews->where('status',1)->count();
                        if($total_review > 0){
                            $avg_sum=$top_item->reviews->where('status',1)->sum('avarage_rating');

                            $avg=$avg_sum/$total_review;
                            $intAvg=intval($avg);
                            $nextVal=$intAvg+1;
                            $reviewPoint=$intAvg;
                            $halfReview=false;
                            if($intAvg < $avg && $avg < $nextVal){
                                $reviewPoint= $intAvg + 0.5;
                                $halfReview=true;
                            }
                        }
                    @endphp

                    @if ($total_review > 0)
                        <span class="rating">{{ sprintf("%.1f", $reviewPoint) }}

                        @for ($i = 1; $i <=5; $i++)
                            @if ($i <= $reviewPoint)
                                <i class="fas fa-star"></i>
                            @elseif ($i> $reviewPoint )
                                @if ($halfReview==true)
                                <i class="fas fa-star-half-alt"></i>
                                    @php
                                        $halfReview=false
                                    @endphp
                                @else
                                <i class="fal fa-star"></i>
                                @endif
                            @endif
                        @endfor
                        </span>
                    @else
                        <span class="rating">0.0
                            @for ($i = 1; $i <=5; $i++)
                            <i class="fal fa-star"></i>
                            @endfor
                        </span>
                    @endif
                    </div>
                </div>
                </div>
          </div>
        @endif
        @endforeach
      </div>
    </div>
  </section>
  <!--=====NEW PROPERTIES END=====-->
@endif



  <!--=====POPULAR PROPERTIES START=====-->
  @php
$feature_property=$sections->where('id',4)->first();
@endphp
@if ($feature_property->show_homepage==1)
  <section class="wsus__popular_properties mt_90 xs_mt_65">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="wsus__section_heading text-center mb_60">
            <h2>{{ $feature_property->header }}</h2>
            <span>{{ $feature_property->description }}</span>
          </div>
        </div>
      </div>
      <div class="row">
        @foreach ($properties->where('is_featured',1)->take($feature_property->content_quantity) as $featured_item)
        @if ($featured_item->expired_date==null)
        <div class="col-xl-4 col-md-6">
          <div class="wsus__popular_properties_single">
            <img src="{{ asset($featured_item->thumbnail_image) }}" alt="popular properties">
            <a href="{{ route('property.details',$featured_item->slug) }}" class="wsus__popular_text">
              <h4>{{ $featured_item->title }}</h4>
              <ul class="d-flex flex-wrap mt-3">
                <li><i class="fal fa-bed"></i> {{ $featured_item->number_of_bedroom }} {{ $websiteLang->where('lang_key','bed')->first()->custom_text }}</li>
                <li><i class="fal fa-shower"></i> {{ $featured_item->number_of_bathroom }} {{ $websiteLang->where('lang_key','bath')->first()->custom_text }}</li>
                <li><i class="fal fa-draw-square"></i> {{ $featured_item->area }} {{ $websiteLang->where('lang_key','sqft_s')->first()->custom_text }}</li>
              </ul>
            </a>
          </div>
        </div>
        @elseif($featured_item->expired_date >= date('Y-m-d'))
            <div class="col-xl-4 col-md-6">
                <div class="wsus__popular_properties_single">
                <img src="{{ asset($featured_item->thumbnail_image) }}" alt="popular properties">
                <a href="{{ route('property.details',$featured_item->slug) }}" class="wsus__popular_text">
                    <h4>{{ $featured_item->title }}</h4>
                    <ul class="d-flex flex-wrap mt-3">
                    <li><i class="fal fa-bed"></i> {{ $featured_item->number_of_bedroom }} {{ $websiteLang->where('lang_key','bed')->first()->custom_text }}</li>
                    <li><i class="fal fa-shower"></i> {{ $featured_item->number_of_bathroom }} {{ $websiteLang->where('lang_key','bath')->first()->custom_text }}</li>
                    <li><i class="fal fa-draw-square"></i> {{ $featured_item->area }} {{ $websiteLang->where('lang_key','sqft_s')->first()->custom_text }}</li>
                    </ul>
                </a>
                </div>
            </div>
        @endif
        @endforeach
      </div>
    </div>
  </section>
@endif
  <!--=====POPULAR PROPERTIES END=====-->


  @php
  $urgent_property=$sections->where('id',12)->first();
  @endphp
  @if ($urgent_property->show_homepage==1)
  <!--=====TOP PROPERTIES START=====-->
  <section class="wsus__top_properties mt_75 xs_mt_50 pt_90 xs_pt_65 pb_75 xs_pb_50">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="wsus__section_heading text-center mb_60">
            <h2>{{ $urgent_property->header }}</h2>
            <span>{{ $urgent_property->description }}</span>
          </div>
        </div>
      </div>
      <div class="row">
        @foreach ($properties->where('urgent_property',1)->take($urgent_property->content_quantity) as $urgent_item)
            @if ($featured_item->expired_date==null)
                <div class="col-xl-4 col-sm-6 col-lg-4">
                    <div class="wsus__top_properties_item">
                        <div class="row">
                        <div class="col-xl-6">
                            <div class="wsus__top_properties_img">
                            <img src="{{ asset($urgent_item->thumbnail_image) }}" alt="top properties" class="ifg-fluid w-100">
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="wsus__top_properties_text">
                            <a href="{{ route('property.details',$urgent_item->slug) }}">{{ $urgent_item->title }}</a>

                                @if ($urgent_item->property_purpose_id==1)
                                    <p>{{ $currency->currency_icon }}{{ $urgent_item->price }}</p>
                                @elseif ($urgent_item->property_purpose_id==2)
                                <p>{{ $currency->currency_icon }}{{ $urgent_item->price }} /
                                    @if ($urgent_item->period=='Daily')
                                    <span>{{ $websiteLang->where('lang_key','daily')->first()->custom_text }}</span>
                                    @elseif ($urgent_item->period=='Monthly')
                                    <span>{{ $websiteLang->where('lang_key','monthly')->first()->custom_text }}</span>
                                    @elseif ($urgent_item->period=='Yearly')
                                    <span>{{ $websiteLang->where('lang_key','yearly')->first()->custom_text }}</span>
                                    @endif
                                </p>
                                @endif
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            @elseif($featured_item->expired_date >= date('Y-m-d'))
                <div class="col-xl-4 col-sm-6 col-lg-4">
                    <div class="wsus__top_properties_item">
                        <div class="row">
                        <div class="col-xl-6">
                            <div class="wsus__top_properties_img">
                            <img src="{{ asset($urgent_item->thumbnail_image) }}" alt="top properties" class="ifg-fluid w-100">
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="wsus__top_properties_text">
                            <a href="{{ route('property.details',$urgent_item->slug) }}">{{ $urgent_item->title }}</a>

                                @if ($urgent_item->property_purpose_id==1)
                                    <p>{{ $currency->currency_icon }}{{ $urgent_item->price }}</p>
                                @elseif ($urgent_item->property_purpose_id==2)
                                <p>{{ $currency->currency_icon }}{{ $urgent_item->price }} /
                                    @if ($urgent_item->period=='Daily')
                                    <span>{{ $websiteLang->where('lang_key','daily')->first()->custom_text }}</span>
                                    @elseif ($urgent_item->period=='Monthly')
                                    <span>{{ $websiteLang->where('lang_key','monthly')->first()->custom_text }}</span>
                                    @elseif ($urgent_item->period=='Yearly')
                                    <span>{{ $websiteLang->where('lang_key','yearly')->first()->custom_text }}</span>
                                    @endif
                                </p>
                                @endif
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach

      </div>
    </div>
  </section>
  <!--=====TOP PROPERTIES END=====-->
  @endif

  <!--=====SERVICE START=====-->
  @php
    $service_section=$sections->where('id',6)->first();
@endphp
@if ($service_section->show_homepage==1)
  <section class="wsus__services" style="background: url({{ asset($service_bg->image) }});">
    <div class="wsus__services_overlay pt_100 xs_pt_75 pb_75 xs_pb_50">
      <div class="container">
        <div class="row">
          <div class="col-xl-5 col-lg-4">
            <div class="wsus__services_heading">
              <div class="wsus__section_heading">
                <h2 class="text-white">{{ $service_bg->title }}</h2>
                <span class="text-white">{{ $service_bg->description }}</span>
              </div>
            </div>
          </div>
          <div class="col-xl-7 col-lg-8">
            <div class="row">
                @foreach ($services->take($service_section->content_quantity) as $service_item)
                    <div class="col-xl-6 col-md-6">
                        <div class="wsus__single_service">
                        {{-- <i class="{{ $service_item->icon }}"></i> --}}
                        <h4>{{ $service_item->title }}</h4>
                        <p>{{ $service_item->description }}</p>
                        {{-- <span><i class="fas fa-flower"></i></span> --}}
                        </div>
                    </div>
                @endforeach
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endif
  <!--=====SERVICE END=====-->



  <!--=====AGENTS START=====-->

@php
    $agent_section=$sections->where('id',5)->first();
@endphp
@if ($agent_section->show_homepage==1)
  <section class="wsus__agents mt_90 xs_mt_65">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="wsus__section_heading text-center mb_35 xs_mb_30">
            <h2>{{ $agent_section->header }}</h2>
            <span>{{ $agent_section->description }}</span>
          </div>
        </div>
      </div>
      <div class="row">
        @foreach ($agents->take($agent_section->content_quantity) as $agent)
        @php
            $isOrder=$orders->where('user_id',$agent->id)->count();
        @endphp
        @if ($isOrder >0)
        <div class="col-xl-3 col-sm-6 col-lg-4">
          <div class="wsus__single_team">
            <a href="{{ route('agent.show',['user_type' => '2','user_name'=>$agent->slug]) }}" class="wsus__single_team_img">
              <img src="{{ $agent->image ? url($agent->image) : url($default_profile_image->image) }}" alt="team images" class="imf-fluid w-100">
            </a>
            <a href="{{ route('agent.show',['user_type' => '2','user_name'=>$agent->slug]) }}" class="title">{{ $agent->name }}</a>
            <p><i class="fal fa-location-circle"></i> {{ $agent->address }}</p>

            <ul class="agent_link">
                @if ($agent->icon_one && $agent->link_one)
                <li><a href="{{ $agent->link_one }}"><i class="{{ $agent->icon_one }}"></i></a></li>
                @endif

                @if ($agent->icon_two && $agent->link_two)
                <li><a href="{{ $agent->link_two }}"><i class="{{ $agent->icon_two }}"></i></a></li>
                @endif

                @if ($agent->icon_three && $agent->link_three)
                <li><a href="{{ $agent->link_three }}"><i class="{{ $agent->icon_three }}"></i></a></li>
                @endif

                @if ($agent->icon_four && $agent->link_four)
                <li><a href="{{ $agent->link_four }}"><i class="{{ $agent->icon_four }}"></i></a></li>
                @endif
            </ul>
          </div>
        </div>
        @endif
        @endforeach
      </div>
    </div>
  </section>
@endif
  <!--=====AGENTS END=====-->


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
