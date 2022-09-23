
@extends($layout)
@section('title')
<title>{{ $seo_text->title }}</title>
@endsection
@section('meta')
    <meta name="description" content="{{ $seo_text->meta_description }}">
@endsection
@section('user-content')

  <!--=== INICIO BREADCRUMB ====-->
  <section class="wsus__breadcrumb" style="background: url({{ url($banner_image->image) }});">
    <div class="wsus_bread_overlay">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <h4>{{ $menus->where('id',8)->first()->navbar }}</h4>
                    <nav style="--bs-breadcrumb-divider: '-';" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ $menus->where('id',1)->first()->navbar }}</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $menus->where('id',8)->first()->navbar }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</section>
<!--=== FIN BREADCRUMB====-->


<!--========= CONTACTO MAIL - TELEFONO - DOMICILIO ============-->
<section class="wsus__contact mt_45 mb_45">
    <div class="container">
        <div class="row">
            <!-- EMAIL -->
            <div class="col-xl-4 col-md-6 col-lg-4">
                <div class="wsus__contact_single">
                    <i class="fal fa-envelope"></i>
                    <h5>{{ $websiteLang->where('lang_key','email')->first()->custom_text }}</h5>
                    <a href="javascript:;">{!! clean(nl2br($contact->emails)) !!}</a>
                </div>
            </div>
            <!-- TELEFONO -->
            <div class="col-xl-4 col-md-6 col-lg-4">
                <div class="wsus__contact_single">
                    <i class="far fa-phone-alt"></i>
                    <h5>{{ $websiteLang->where('lang_key','phone')->first()->custom_text }}</h5>
                    <a href="javascript:;">{!! clean(nl2br($contact->phones)) !!}</a>
                </div>
            </div>
            <!-- DOMICILIO -->
            <div class="col-xl-4 col-md-6 col-lg-4">
                <div class="wsus__contact_single md_mar">
                    <i class="fal fa-map-marker-alt"></i>
                    <h5>{{ $websiteLang->where('lang_key','address')->first()->custom_text }}</h5>
                    <a href="javascript:;">{!! clean(nl2br($contact->address)) !!}</a>
                </div>
            </div>
        </div>
    @include('user.formContacto')
    @include('user.googlemap')
    </div>
</section>
<!--========= FIN CONTACTO==========-->
@endsection
