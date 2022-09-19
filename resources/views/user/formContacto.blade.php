<!--========= FORMULARIO DE CONTACTO ============-->
{{-- @php
  $about_section=$sections->where('id',10)->first();
@endphp --}}
<div class="container">
    <div class="row">
      <div class="col-12">
        <div class="wsus__section_heading text-center mt_15 mb_15">
          {{-- <h2>{{ $servicios_section->header }}</h2>
          <p>{{ $servicios_section->description }}</p> --}}
          <h2>Formulario de Contacto</h2>
          <p>Dejando sus datos en este formulario nos pondremos en contacto a la brevedad para cualquier consulta que Ud desee realizar</p>
        </div>
      </div>
    </div>
    <div class="row mt_40 xs_mt_15">
      <div class="col-12>
        <div class="wsus__contact_question">
          <h5>{{ $websiteLang->where('lang_key','contact_us')->first()->custom_text }}</h5>
          <form method="POST" action="{{ route('contact.message') }}">
          @csrf
            <div class="row">
              <div class="col-xl-6 col-lg-6">
                <div class="wsus__con_form_single">
                  <input type="text" placeholder="{{ $websiteLang->where('lang_key','name')->first()->custom_text }}*" name="name">
                </div>
              </div>
              <div class="col-xl-6 col-lg-6">
                <div class="wsus__con_form_single">
                  <input type="text" placeholder="{{ $websiteLang->where('lang_key','lastname')->first()->custom_text }}*" name="lastname">
                </div>
              </div>
              <div class="col-xl-6 col-lg-6">
                <div class="wsus__con_form_single">
                  <input type="email" placeholder="{{ $websiteLang->where('lang_key','email')->first()->custom_text }}*" name="email">
                </div>
              </div>
              <div class="col-xl-6 col-lg-6">
                <div class="wsus__con_form_single">
                  <input type="text" placeholder="{{ $websiteLang->where('lang_key','phone')->first()->custom_text }}" name="phone">
                </div>
              </div>
              <div class="col-xl-12">
                <div class="wsus__con_form_single">
                  <input type="text" placeholder="{{ $websiteLang->where('lang_key','subject')->first()->custom_text }}*" name="subject">
                </div>
              </div>
              <div class="col-xl-12">
                <div class="wsus__con_form_single">
                  <textarea cols="3" rows="5" placeholder="{{ $websiteLang->where('lang_key','msg')->first()->custom_text }}*" name="message"></textarea>
  
                  @if($contactSetting->allow_captcha==1)
                    <p class="g-recaptcha mb-3 mt-3" data-sitekey="{{ $contactSetting->captcha_key }}"></p>
                  @endif
  
                </div>
                <div class="form-check mb_15">
                  <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                  <label class="form-check-label" for="flexCheckDefault">
                    Yo he leído y acepto las <a href="/privay-policy">{{ $websiteLang->where('lang_key','privacy-policy')->first()->custom_text }}</a>
                  </label>
                  <label class="form-check-label" for="flexCheckDefault">
                    Usamos SendinBlue como plataforma de Marketing. Al hacer clic a continuación para enviar este formulario, consiente que la información proporcionada sea transferida a Sendinblue para su procesamiento de acuerdo con sus  <a href="https://es.sendinblue.com/legal/termsofuse/">términos de uso</a>
                  </label>
                </div>
                <button type="submit" class="common_btn" id="submit"  disabled>{{ $websiteLang->where('lang_key','send_msg')->first()->custom_text }}</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
<!--========= FIN FORMULARIO DE CONTACTO ============-->
<script>
  // disable comment form until gdpr is checked
   if($('#flexCheckDefault').length > 0 && $('#submit').length > 0){
       if(!$('#flexCheckDefault').is(':checked')) {
          $('#submit').attr('disabled', 'disabled');
       }
       $('#flexCheckDefault').click(function() {
          if ($(this).is(':checked')) {
              $('#submit').removeAttr('disabled');
          } else {
              $('#submit').attr('disabled', 'disabled');
          }
      });
   }
</script>
