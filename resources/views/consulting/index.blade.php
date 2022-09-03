@extends('layouts.consulting.layout')
@section('title')
    {{-- <title>{{ $seo_text->title }}</title> --}}
    <title>Consulting - Canevari Group</title>
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
</section>
<!--===== FIN BANNER =====-->

<!--===== BIENVENIDOS =====-->
{{-- @php
    $servicios_section=$sections->where('section','Bienvenidos')->first();
@endphp
@if ($servicios_section->show_homepage==1) --}}
<div class="container">
  <div class="mt_35 mb_35">
    <div class="row">
      <div class="col-12">
        <div class="wsus__section_heading mb_15">
          <h2>Bienvenidos a Canevari Consulting</h2>
          {{-- <h2>{{ $servicios_section->header }}</h2> --}}
          {{-- {!! clean($servicios_section->description) !!} --}}
          {{-- <span>{{ $servicios_section->description }}</span> --}}
          <p>Somos una Consultora en Economía y negocios que opera en toda la nacion española. Nuestro propósito es facilitarle toda su gestíon comercial como Autónomo, Comercio, Empresa o Sociedad, liberando sus manos y su tiempo para enfocarse en lo que es el núcleo de su actividad y de su saber, potenciando su crecimiento a través de nuestros servicios profesionales, protegiendo  sus intereses por delante de todo y ayudando a manejarse en la complejidad que muestra la economía de hoy.  <p>Somos el socio comercial que necesita para poder crecer en forma regular y sólidamente.</p> 
          <p>Consúltenos y podremos cotizarle nuestros servicios.</p>        
        </div>
      </div>
    </div>
  </div>
</div>
{{-- @endif --}}
<!--===== FIN BIENVENIDOS =====-->


<!--===== CONSULTING SERVICIOS =====-->
@php
    $servicios_section=$sections->where('id',3)->first();
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
      {{-- LISTADO CONSULTING SERVICIOS --}}
      <div class="row">
        @foreach ($consultingservices->take($servicios_section->content_quantity) as $item)
        <div class="col-xl-4 col-sm-6 col-lg-4">
          <div class="wsus__single_consulting_service">
            <div class="wsus__single_consulting_service_img">
              <img src="{{ asset($item->image) }}" alt="consulting service images" class="imf-fluid w-100">
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
  <!--===== FIN CONSULTING SERVICIOS =====-->
  

@include('user.formContacto');

@endsection

