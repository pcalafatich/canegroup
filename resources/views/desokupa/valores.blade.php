<!--===== INICIO IMAGETEXT =====-->
{{-- @php
  $about_section=$sections->where('id',11)->first();
@endphp --}}

{{-- @if ($about_section->show_homepage==1) --}}
  <!--=====ABOUT START=====-->
  <section class="wsus__about mt_40 mb_35 xs_mt_55">
    <div class="container">
      <div class="row">
          <div class="col-xl-5 col-lg-5">
            <div class="wsus__about_img">
              <img src="{{ asset('uploads/website-images/justicia01.jpg') }}" alt="justicia" class="img-fluid w-100">
            </div>
          </div>
        <div class="col-xl-7 col-lg-7">
          <div class="wsus__about_counter">
            <div class="row">
              <div class="col-12">
                <div class="wsus__section_heading mb_40 mt_30">
                  {{-- <h2>{{ $websiteLang->where('lang_key','about_us')->first()->custom_text }}</h2> --}}
                  <h2>¿Cuáles son nuestros valores?</h2>

                </div>
              </div>
              <div class="col-12">
                {{-- <div > {!! clean($aboutUs->about) !!}     </div> --}}
                <div>
                    <p class="mb_15">Creemos firmemente en que el <strong>derecho de propiedad</strong> , tal y como reconoce nuestra Constitución en su artículo 33, solo debe estar sujeto a las limitaciones que impone la Ley y no a la voluntad de particulares
                        que deciden saltarsela, que es el marco que permite la convivencia en sociedad.</p>
                    <p class="mb_15">Por este motivo, siempre hemos creído que cualquier persona tiene que tener derecho a que su propiedad se respete. Desde nuestro nacimiento empresarial hemos buscado cumplir siempre con las exigencias legales en lo relativo al derecho de propiedad y  <strong>defender los intereses de los propietarios</strong>.</p>
                    <p class="mb_15">Creemos en la necesidad de proteger el derecho de propiedad frente a los okupas, ya que la justicia, a pesar de poder ser eficaz, no es eficiente. No es eficiente por que los juzgados están saturados de litigios y no pueden hacer frente a la cantidad de pleitos por este y otros temas que se registan hoy día.</p>    
                    <p class="mb_15">Muchos de nuestros clientes lo primero que nos preguntan es si lo que hacemos es legal. No te tienes que preocupar por nada, nuestra actividad es completamente legal <strong>y podrás recuperar tu vivienda sin ningún tipo de conflicto jurídico</strong>.</p>
                </div>
                {{-- <a href="{{ route('desokupa.about.us') }}">{{ $websiteLang->where('lang_key','read_more')->first()->custom_text }}</a> --}}
              </div>
          </div>
        </div>
      </div>

      </div>
    </div>
  </section>
  <!--===== FIN ABOUT=====-->
{{-- @endif --}}