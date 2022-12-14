@extends($layout)
@section('title')
    <title>{{ $menus->where('id',16)->first()->navbar }}</title>
@endsection
@section('user-content')

  <!--=== BREADCRUMB====-->
  <section class="wsus__breadcrumb" style="background: url({{ url($banner_image->image) }});">
    <div class="wsus_bread_overlay">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <h4>{{ $menus->where('id',16)->first()->navbar }}</h4>
                    <nav style="--bs-breadcrumb-divider: '-';" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ $menus->where('id',1)->first()->navbar }}</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $menus->where('id',16)->first()->navbar }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</section>
<!--===BREADCRUMB PART END====-->

<!--========= POLITICA DE PRIVACIDAD ============-->
<section class="wsus__custome_page mt_40 mb_15">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="wsus__privacy_text">
                    @if ($privacy)
                    {!! clean($privacy->privacy_policy) !!}
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
<!--========= FIN POLITICA DE PRIVACIDAD ==========-->

@endsection
