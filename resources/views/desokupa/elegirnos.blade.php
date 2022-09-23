<!--===== INICIO IMAGETEXT =====-->
{{-- @php
  $about_section=$sections->where('id',11)->first();
@endphp --}}

{{-- @if ($about_section->show_homepage==1) --}}
  <!--=====ABOUT START=====-->
  <section class="wsus__about mt_40 mb_35 xs_mt_55">
    <div class="container">
      <div class="row">
        <div class="col-xl-7 col-lg-7">
          <div class="wsus__about_counter">
            <div class="row">
              <div class="col-12">
                <div class="wsus__section_heading mb_40 mt_30">
                  {{-- <h2>{{ $websiteLang->where('lang_key','about_us')->first()->custom_text }}</h2> --}}
                  <h2>¿Por qué elegirnos?</h2>
                </div>
              </div>
              <div class="col-12">
                {{-- <div > {!! clean($aboutUs->about) !!}     </div> --}}
                <div>
                  <p class="mb_15">Somos <strong>eficaces</strong> pero también <strong>rápidos y eficientes</strong>, no queremos que pases ni un dia más viviendo en casa de un familiar o en un hotel porque tu vivienda haya sido ocupada.</p>
                  <p class="mb_15">Tampoco queremos que por su culpa no puedas usar la casa en la que veraneabas o pasabas esos períodos vacacionales y que tanto esfuerzo te costó conseguir.</p>
                  <p class="mb_15">Y, ante todo, somos una empresa discreta, tu privacidad es lo que más nos importa. No queremos que tengas que sufrir más daños, cuando tú no has tenido culpa alguna en que te hayan ocupado la vivienda.</p>
                  <p class="mb_15">Además, nuestros precios son los mas convenientes del mercado. Si encuentras alguna agencia desokupa más barata: ¡Te bajamos el precio!</p>
                  </div>
                {{-- <a href="{{ route('desokupa.about.us') }}">{{ $websiteLang->where('lang_key','read_more')->first()->custom_text }}</a> --}}
              </div>
          </div>
        </div>
      </div>
      <div class="col-xl-5 col-lg-5">
        <div class="wsus__about_img">
          <img src="{{ asset('uploads/website-images/casaokupada08.jpg') }}" alt="casa okupada" class="img-fluid w-100">
        </div>
      </div>

      </div>
    </div>
  </section>
  <!--===== FIN ABOUT=====-->
{{-- @endif --}}