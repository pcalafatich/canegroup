@extends('layouts.user.layout')
@section('title')
    <title>{{ $seo_text->title }}</title>
@endsection
@section('meta')
    <meta name="description" content="{{ $seo_text->meta_description }}">
@endsection

@section('user-content')

  <!--===== SLIDER =====-->
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

    
  {{-- LISTADO DE EMPRESAS 2 --}}
  @php
    $servicios_section=$sections->where('id',3)->first();
  @endphp
    
   {{-- @if ($servicios_section->show_homepage==1) --}}
    <div class="container mt_35 mb_35">
      <div class="row">
        <div class="col-12">
          <div class="wsus__section_heading text-center mb_15">
            <h2>{{ $servicios_section->header }}</h2>
            <span>Canevari Group es una organizacion empresarial con domicilio en Alicante, España, conformada por un conjunto de empresas, orientados en proyectos de distintos tipos que permitan crecer y generar nuevos emprendimientos comerciales, negocios y servicios.</span>
          </div>
        </div>
      </div>
      {{-- LISTADO CONSULTING SERVICIOS --}}
      <div class="row">
        {{-- CONSULTING --}}
        <div class="col-xl-4 col-sm-12 col-lg-4">
          <div class="wsus__single_consulting_service">
            <div class="wsus__single_consulting_service_img">
            <img src="{{URL::asset('/uploads/custom-images/canevari-group-600x400.png')}}" alt="consulting service images" class="imf-fluid w-100">
            </div>
            <h4>CANEVARI CONSULTING</h4>
            <p class="mb_15">Canevari Consulting es una firma formada por profesionales expertos y de amplia experiencia, especializados en la prestación de servicios económico-financieros, jurídicos y asesoramiento estratégico empresarial.</p>
            <a target="_blank" href="//consulting.canevari.group/">Ir a Canevari Consulting</a>
          </div>
        </div>
        {{-- DESOKUPA --}}
        <div class="col-xl-4 col-sm-12 col-lg-4">
          <div class="wsus__single_consulting_service">
            <div class="wsus__single_consulting_service_img">
            <img src="{{URL::asset('/uploads/custom-images/canevari-group-600x400.png')}}" alt="consulting service images" class="imf-fluid w-100">
            </div>
            <h4>CANEVARI DESOKUPA</h4>
            <p class="mb_15">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Repellendus, quod iste architecto eaque natus sunt nobis. Vitae alias, ex aspernatur consectetur, nam, eum officia quidem nobis soluta quam dolores pariatur.</p>
            <a target="_blank" href="//desokupa.canevari.group/">Ir a Canevari Desokupa</a>
          </div>
        </div>
        {{-- REALESTATE --}}
        <div class="col-xl-4 col-sm-12 col-lg-4">
          <div class="wsus__single_consulting_service">
            <div class="wsus__single_consulting_service_img">
            <img src="{{URL::asset('/uploads/custom-images/canevari-group-600x400.png')}}" alt="consulting service images" class="imf-fluid w-100">
            </div>
            <h4>CANEVARI REALESTATE</h4>
            <p class="mb_15">Canevari Real Estate es una firma de inversionistas expertos en ofrecer soluciones ágiles y efectivas para personas que por cualquier motivo necesitan vender su propiedad de manera rápida y segura. </p>
            <a target="_blank" href="//realestate.canevari.group/">Ir a Canevari RealEstate</a>
          </div>
        </div>

        {{-- @endforeach --}}
      </div>
    </div>
  {{-- FIN NUESTRAS EMPRESAS --}}

@include('user.formContacto');


@endsection
