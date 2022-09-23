@php
    $topbar_contact=App\ContactUs::where('modelo','consulting')->first();
    $setting=App\Setting::first();
    $customPages=App\CustomPage::all();
    $navigations=App\Navigation::all();
    $websiteLang=App\ManageText::all();
@endphp


<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport"
    content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no, target-densityDpi=device-dpi" />
    @yield('title')
    @yield('meta')


    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@400;500;600;700;900&family=Poppins:wght@400;500;600;900&display=swap" rel="stylesheet">

  <link rel="icon" type="image/png" href="{{ url($setting->favicon) }}">
  <link rel="stylesheet" href="{{ asset('user/css/all.min.css') }}">
  <link rel="stylesheet" href="{{ asset('user/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('user/css/spacing.css') }}">
  <link rel="stylesheet" href="{{ asset('user/css/slick.css') }}">
  <link rel="stylesheet" href="{{ asset('user/css/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('user/css/add_row_custon.css') }}">

  <link rel="stylesheet" href="{{ asset('user/css/owl/owl.carousel.css') }}">
  <link rel="stylesheet" href="{{ asset('user/css/owl/owl.theme.default.min.css') }}">


  <link rel="stylesheet" href="{{ asset('user/css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('user/css/responsive.css') }}">

  @if ($setting->text_direction=="RTL")
    <link rel="stylesheet" href="{{ asset('user/css/rtl.css') }}">
  @endif
  <link rel="stylesheet" href="{{ asset('user/css/dev.css') }}">
  
  <link rel="stylesheet" href="{{ asset('toastr/toastr.min.css') }}">
  
  @include('user.theme_style')
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
  <script src="{{ asset('user/js/jquery-3.6.0.min.js') }}"></script>
  <script src="{{ asset('user/js/sweetalert2@11.js') }}"></script>
  <script src="{{ asset('user/js/owl/owl.carousel.min.js') }}"></script>

  <!-- TOPBARSCROLL -->
  <script src="{{ asset('user/js/jquery.newsTicker.min.js') }}"></script>
  <link rel="stylesheet" href="{{ asset('user/css/topbarscroll.css') }}">

  <!-- GOOGLE ANALYTICS (gtag.js) -->
  @if ($setting->google_analytic==1)
    <script async src="https://www.googletagmanager.com/gtag/js?id={{ $setting->google_analytic_code }}"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', '{{ $setting->google_analytic_code }}');
    </script>
  @endif
</head>

<body>
    
  @include('layouts.ucrania')
              
  <!--=====TOPBAR START=====-->
  <section class="wsus__topbar">
    <div class="container">
      <div class="row">
        <div class="col-xl-6 col-12 col-sm-8">
          <ul class="wsus__topbar_left d-flex align-items-center">
            <li><a href="tel:{{ $topbar_contact->topbar_phone }}"><i class="fal fa-mobile"></i> {{ $topbar_contact->topbar_phone }}</a></li>
            <li><a href="mailto:{{ $topbar_contact->topbar_email }}"><i class="fas fa-envelope"></i> {{ $topbar_contact->topbar_email }}</a></li>
          </ul>
        </div>
        <div class="col-xl-6 col-sm-4 d-none d-sm-block">
          <ul class="wsus__topbar_right d-flex justify-content-end align-items-center">
                @if ($topbar_contact->facebook)
                <li><a href="{{ $topbar_contact->facebook }}"><i class="fab fa-facebook-f"></i></a></li>
                @endif
                @if ($topbar_contact->twitter)
                <li><a href="{{ $topbar_contact->twitter }}"><i class="fab fa-twitter"></i></a></li>
                @endif
                @if ($topbar_contact->linkedin)
                <li><a href="{{ $topbar_contact->linkedin }}"><i class="fab fa-linkedin-in"></i></a></li>
                @endif
                @if ($topbar_contact->instagram)
                <li><a href="{{ $topbar_contact->instagram }}"><i class="fab fa-instagram"></i></a></li>
                @endif
                @if ($topbar_contact->youtube)
                <li><a href="{{ $topbar_contact->youtube }}"><i class="fab fa-youtube"></i></a></li>
                @endif
            </ul>
        </div>
      </div>
    </div>
  </section>
  <!--=====TOPBAR END=====-->


  <!--=====MAIN MENU START=====-->
  <nav class="navbar navbar-expand-lg main_menu">
    <div class="container">
      <!-- BOTON IZQUIERDO -->
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <i class="fal fa-align-justify"></i>
      </button>
      <!-- FIN BOTON IZQUIERDO -->

      <!-- LOGO -->
      <a class="navbar-brand" href="{{ route('consulting.home') }}">
        <img src="{{ url($setting->logo) }}" alt="logo" class="img-fluid w-100">
      </a>
      <!-- FIN LOGO -->

      <!-- BOTON DERECHO -->
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContactContent"
        aria-controls="navbarContactContent" aria-expanded="false" aria-label="Toggle navigation">
        <i class="fal fa-phone"></i>
      </button>
      <!-- FIN BOTON DERECHO -->

      <!-- TARGET BOTON IZQUIERDO -->
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav m-auto mb-2 mb-lg-0">

            @php
                $home_menu=$navigations->where('id',1)->first();
            @endphp
            {{-- INICIO --}}
            @if ($home_menu->status==1)
            <li class="nav-item">
                <a class="nav-link {{ Route::is('consulting.home') ? 'active' : '' }}" aria-current="page" href="{{ url('/') }}">{{ $home_menu->navbar }}</a>
            </li>
            @endif
            {{-- SOBRE NOSOTROS --}}
            @php
                $about_menu=$navigations->where('id',4)->first();
            @endphp
            @if ($about_menu->status==1)
            <li class="nav-item">
                <a class="nav-link {{ Route::is('about.us') ? 'active' : '' }}" href="{{ route('about.us') }}">{{ $about_menu->navbar }}</a>
            </li>
            @endif

            {{-- PLANES DE PRECIOS --}}
            @php
                $pricing_menu=$navigations->where('id',5)->first();
            @endphp
            @if ($pricing_menu->status==1)
                <li class="nav-item">
                    <a class="nav-link {{ Route::is('pricing.plan') ? 'active' : '' }}" href="{{ route('pricing.plan') }}">{{ $pricing_menu->navbar }}</a>
                </li>
            @endif

            {{-- DROPDOWN SERVICIOS--}}
            @php
                $pages_menu=$navigations->where('id',18)->first();
            @endphp
            @if ($pages_menu->status==1)
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle {{ Route::is('blog') || Route::is('blog.details') || Route::is('custom.page') || Route::is('faq') ? 'active' : '' }}" href="javascript:;" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    {{ $pages_menu->navbar }}
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                  {{-- NOTICIAS --}}
                  {{-- @php
                    $blog_menu=$navigations->where('id',7)->first();
                  @endphp
                  @if ($blog_menu->status==1)
                  <li>
                      <a class="dropdown-item {{ Route::is('blog') || Route::is('blog.details') ? 'active' : '' }}" href="{{ route('blog') }}">{{ $blog_menu->navbar }}</a>
                  </li>
                  @endif --}}

                  {{-- PAGINAS ESPECIALES --}}
                  @if ($customPages->where('modelo', 'consulting')->count() !=0)
                      @foreach ($customPages as $custom_item)
                          <li><a class="dropdown-item {{  Request::url() == route('custom.page',$custom_item->slug) ? 'active' : '' }}" href="{{ route('custom.page',$custom_item->slug) }}">{{ $custom_item->page_name }}</a></li>
                      @endforeach
                  @endif
            </ul>
            </li>
            @endif


            {{-- PREGUNTAS FRECUENTES  --}}
            @php
              $faq_menu=$navigations->where('id',17)->first();
            @endphp
            @if ($faq_menu->status==1)
              <li class="nav-item">
                <a class="nav-link {{ Route::is('faq') ? 'active' : '' }}" href="{{ route('faq') }}">{{ $faq_menu->navbar }}</a>
              </li>
            @endif




            @php
                $contact_menu=$navigations->where('id',8)->first();
            @endphp
            @if ($contact_menu->status==1)
            <li class="nav-item">
                <a class="nav-link {{ Route::is('contact-us')? 'active' : '' }}" href="{{ route('contact.us') }}">{{  $contact_menu->navbar }}</a>
            </li>
            @endif

        </ul>

        @php
            $my_account =$navigations->where('id',22)->first();
        @endphp
        @if ($my_account ->status==1)
            <ul class="login_icon ms-auto">
                <li><a href="{{ route('user.dashboard') }}"><i class="fal fa-user-circle"></i> {{ $my_account->navbar }}</a>
                </li>
            </ul>
        @endif
      </div>
      <!-- FIN TARGET BOTON IZQUIERDO -->

      <!-- TARGET BOTON DERECHO -->
      <div class="collapse navbar-collapse" id="navbarContactContent">
        <ul class="d-md-none navbar-nav m-auto mb-2 mb-lg-0">
            {{-- TELEFONO --}}
            <li class="nav-item">
                {{-- <a class="nav-link {{ Route::is('consulting.home') ? 'active' : '' }}" aria-current="page" href="{{ url('/') }}">{{ $home_menu->navbar }}</a> --}}
                <a class="nav-link {{ Route::is('consulting.home') ? 'active' : '' }}" aria-current="page" href="{{ url('/') }}">TELEFONO</a>
            </li>
            {{-- CORREO --}}
            <li class="nav-item">
              {{-- <a class="nav-link {{ Route::is('consulting.home') ? 'active' : '' }}" aria-current="page" href="{{ url('/') }}">{{ $home_menu->navbar }}</a> --}}
              <a class="nav-link {{ Route::is('consulting.home') ? 'active' : '' }}" aria-current="page" href="{{ url('/') }}">CORREO</a>
          </li>
          {{-- DOMICILIO --}}
          <li class="nav-item">
            {{-- <a class="nav-link {{ Route::is('consulting.home') ? 'active' : '' }}" aria-current="page" href="{{ url('/') }}">{{ $home_menu->navbar }}</a> --}}
            <a class="nav-link {{ Route::is('consulting.home') ? 'active' : '' }}" aria-current="page" href="{{ url('/') }}">DOMICILIO</a>
        </li>
        </ul>
      </div>
      <!-- FIN TARGET BOTON DERECHO -->    

  
      
    </div>
  </nav>
  <!--=====MAIN MENU END=====-->