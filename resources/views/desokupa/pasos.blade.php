<!--===== CONSULTING SERVICIOS =====-->
{{-- @php
    $servicios_section=$sections->where('id',3)->first();
@endphp --}}

<div class="container">
{{-- @if ($servicios_section->show_homepage==1) --}}
    <div class="mt_35 mb_35">
        <div class="row">
        <div class="col-12">
          <div class="wsus__section_heading text-center mb_15">
            {{-- <h2>{{ $servicios_section->header }}</h2> --}}
            <h2>Proceso de Desokupación de Principio a Fin</h2>
            {{-- <p>{{ $servicios_section->description }}</p> --}}
            <p>Esto son los seis pasos que recuperarán su vivienda y la pondran nuevamente en su poder</p>
        </div>
        </div>
      </div>
        {{-- PASO 1 --}}
      <div class="row">
        {{-- @foreach ($consultingservices->take($servicios_section->content_quantity) as $item) --}}
        <div class="col-xl-4 col-sm-6 col-lg-4">
          <div class="wsus__single_consulting_service">
            <div class="wsus__single_consulting_service_img">
              <img src="{{ asset('uploads/website-images/paso1.jpg') }}" alt="consulting service images" class="imf-fluid w-100">
            </div>
            {{-- <h4>{{ $item->name }}</h4> --}}
            <h4>Paso 1</h4>
            {{-- <p>{{ $item->description }}</p> --}}
            <p>Nos comenta su caso, lo analizamos y le hacemos llegar nuestra propuesta y presupuesto.</p>
            {{-- <a href="/page/gestion-laboral">Ver Más</a> --}}
            {{-- <a href="{{ route('book') }}"></a>   --}}
          </div>
        </div>
        {{-- @endforeach --}}
      {{-- FIN PASO 1 --}}
      {{-- PASO 2 --}}
            {{-- @foreach ($consultingservices->take($servicios_section->content_quantity) as $item) --}}
            <div class="col-xl-4 col-sm-6 col-lg-4">
                <div class="wsus__single_consulting_service">
                <div class="wsus__single_consulting_service_img">
                    <img src="{{ asset('uploads/website-images/paso2.jpg') }}" alt="consulting service images" class="imf-fluid w-100">
                </div>
                {{-- <h4>{{ $item->name }}</h4> --}}
                <h4>Paso 2</h4>
                {{-- <p>{{ $item->description }}</p> --}}
                <p>Verificamos toda la información solicitada y firmamos el contrato de prestación de servicios.</p>
                {{-- <a href="/page/gestion-laboral">Ver Más</a> --}}
                {{-- <a href="{{ route('book') }}"></a>   --}}
                </div>
            </div>
            {{-- @endforeach --}}
       {{-- FIN PASO 2 --}}
       {{-- PASO 3 --}}
        {{-- @foreach ($consultingservices->take($servicios_section->content_quantity) as $item) --}}
        <div class="col-xl-4 col-sm-6 col-lg-4">
          <div class="wsus__single_consulting_service">
            <div class="wsus__single_consulting_service_img">
              <img src="{{ asset('uploads/website-images/paso3.jpg') }}" alt="consulting service images" class="imf-fluid w-100">
            </div>
            {{-- <h4>{{ $item->name }}</h4> --}}
            <h4>Paso 3</h4>
            {{-- <p>{{ $item->description }}</p> --}}
            <p>Nuestro equipo comienza a trabajar en la desocupación. En breve solucionaremos su problema</p>
            {{-- <a href="/page/gestion-laboral">Ver Más</a> --}}
            {{-- <a href="{{ route('book') }}"></a>   --}}
          </div>
        </div>
        {{-- @endforeach --}}
      {{-- FIN PASO 3 --}}
      {{-- PASO 4 --}}
            {{-- @foreach ($consultingservices->take($servicios_section->content_quantity) as $item) --}}
            <div class="col-xl-4 col-sm-6 col-lg-4">
                <div class="wsus__single_consulting_service">
                <div class="wsus__single_consulting_service_img">
                    <img src="{{ asset('uploads/website-images/paso4.jpg') }}" alt="consulting service images" class="imf-fluid w-100">
                </div>
                {{-- <h4>{{ $item->name }}</h4> --}}
                <h4>Paso 4</h4>
                {{-- <p>{{ $item->description }}</p> --}}
                <p>Comenzamos nuestro trabajo hasta lograr que los okupas se vayan de su propiedad y tomamos posesión de la misma. </p>
                {{-- <a href="/page/gestion-laboral">Ver Más</a> --}}
                {{-- <a href="{{ route('book') }}"></a>   --}}
                </div>
            </div>
            {{-- @endforeach --}}
       {{-- FIN PASO 4 --}}
        {{-- PASO 5 --}}
        {{-- @foreach ($consultingservices->take($servicios_section->content_quantity) as $item) --}}
        <div class="col-xl-4 col-sm-6 col-lg-4">
          <div class="wsus__single_consulting_service">
            <div class="wsus__single_consulting_service_img">
              <img src="{{ asset('uploads/website-images/paso5.jpg') }}" alt="consulting service images" class="imf-fluid w-100">
            </div>
            {{-- <h4>{{ $item->name }}</h4> --}}
            <h4>Paso 5</h4>
            {{-- <p>{{ $item->description }}</p> --}}
            <p>Los okupas firman un contrato blindado en el que aceptan irse de forma voluntaria, consiguiendo así, que no puedan demandar.</p>
            {{-- <a href="/page/gestion-laboral">Ver Más</a> --}}
            {{-- <a href="{{ route('book') }}"></a>   --}}
          </div>
        </div>
        {{-- @endforeach --}}
      {{-- FIN PASO 5 --}}
      {{-- PASO 6 --}}
            {{-- @foreach ($consultingservices->take($servicios_section->content_quantity) as $item) --}}
            <div class="col-xl-4 col-sm-6 col-lg-4">
                <div class="wsus__single_consulting_service">
                <div class="wsus__single_consulting_service_img">
                    <img src="{{ asset('uploads/website-images/paso6.jpg') }}" alt="consulting service images" class="imf-fluid w-100">                    
                </div>
                {{-- <h4>{{ $item->name }}</h4> --}}
                <h4>Paso 6</h4>
                {{-- <p>{{ $item->description }}</p> --}}
                <p>Cambiamos la cerradura de todos los accesos de su vivienda y se da por finalizado el trabajo.</p>
                {{-- <a href="/page/gestion-laboral">Ver Más</a> --}}
                {{-- <a href="{{ route('book') }}"></a>   --}}
                </div>
            </div>
            {{-- @endforeach --}}
            </div>
       {{-- FIN PASO 6 --}}
    </div>
    {{-- @endif --}}
  </div>
  <!--===== FIN CONSULTING SERVICIOS =====-->