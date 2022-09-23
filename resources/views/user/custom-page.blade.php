@extends($layout)
@section('title')
    <title>{{ $page->seo_title }}</title>
@endsection
@section('user-content')
    <!--===BREADCRUMB PART START====-->
  <section class="wsus__breadcrumb" style="background: url({{ url($banner_image->image) }});">
    <div class="wsus_bread_overlay">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <h4>{{ $page->page_name }}</h4>
                    <nav style="--bs-breadcrumb-divider: '-';" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ $menus->where('id',1)->first()->navbar }}</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $page->page_name }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</section>
<!--===BREADCRUMB PART END====-->


<!--=========PRIVACY PART START============-->
<section class="wsus__custome_page mt_40 mb_20">
    <div class="container">
        <div class="row">
            <div class="col-xl-8 col-sm-12">
                <div class="wsus__privacy_text">
                    {!! clean($page->description) !!}
                </div>
            </div>

            {{-- FORMULARIO DE CONTACTO RAPIDO --}}
            <div class="col-xl-4 col-sm-12" id="sticky_sidebar">
                <form class="wsus__quick_contact" id="listingAuthContactForm">
                @csrf @csrf
                <div class="row">
                    <div class="col-12 text-center">
                    <h4>{{ $websiteLang->where('lang_key','quick_contact')->first()->custom_text }}</h4>
                    </div>
                    <div class="col-xl-12">
                    <div class="wsus__quick_con_single">
                        <label>{{ $websiteLang->where('lang_key','name')->first()->custom_text }}</label>
                        <input type="text" name="name">
                    </div>
                    <div class="col-xl-12">
                        <div class="wsus__quick_con_single">
                            <label>{{ $websiteLang->where('lang_key','lastname')->first()->custom_text }}</label>
                            <input type="text" name="lastname">
                        </div>
    
                    </div>
                    <div class="col-xl-12">
                    <div class="wsus__quick_con_single">
                        <label>{{ $websiteLang->where('lang_key','email')->first()->custom_text }}</label>
                        <input type="email" name="email">
                    </div>
                    </div>

                    <div class="col-xl-12">
                    <div class="wsus__quick_con_single">
                        <label>{{ $websiteLang->where('lang_key','phone')->first()->custom_text }}</label>
                        <input type="text" name="phone">
                    </div>
                    </div>
                    <div class="col-xl-12">
                    <div class="wsus__quick_con_single">
                        <label>{{ $websiteLang->where('lang_key','subject')->first()->custom_text }}</label>
                        <input type="text" name="subject">
                    </div>
                    </div>

                    <div class="col-xl-12">
                    <div class="wsus__quick_con_single">
                        <label>{{ $websiteLang->where('lang_key','des')->first()->custom_text }}</label>
                        <textarea cols="3" rows="5" name="message"></textarea>
                        {{-- <input type="hidden" name="user_type" value="{{ $user_type }}">
                        @if ($user_type==1)
                        <input type="hidden" name="admin_id" value="{{ $user->id }}">
                        @else
                        <input type="hidden" name="user_id" value="{{ $user->id }}">
                        @endif --}}

                        {{-- @if($setting->allow_captcha==1)
                        <p class="g-recaptcha mb-3" data-sitekey="{{ $setting->captcha_key }}"></p>
                        @endif --}}

                        <button type="submit" class="common_btn" id="listingAuthorContctBtn"><i id="listcontact-spinner" class="loading-icon fa fa-spin fa-spinner d-none mr-5"></i> {{ $websiteLang->where('lang_key','send_msg')->first()->custom_text }}</button>
                    </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</section>
<!--=========PRIVACY PART END==========-->
@endsection
