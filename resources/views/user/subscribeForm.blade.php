{{-- Formulario de subscripcion al Newsletter --}}
<div class="container">
    <div class="row large_subscribe">
        <div class="col-xl-4 col-lg-5">
            <div class="large_subscribe_text">
                <h4 class="">{{ $websiteLang->where('lang_key','subscribe_us')->first()->custom_text }}</h4>
            </div>
        </div>
        <div class="col-xl-8 pe-0 col-lg-7">
            <form id="subscribeForm">
                <input type="text" placeholder="{{ $websiteLang->where('lang_key','email')->first()->custom_text }}" name="email">
                <button id="subscribeBtn" type="submit"><i id="subscribe-spinner" class="loading-icon fa fa-spin fa-spinner d-none mt-1"></i>  <i id="angleRight" class="fal fa-angle-right"></i></button>
            </form>
        </div>
    </div>
</div>

<script>
    (function($) {
    "use strict";
    $(document).ready(function () {


        $("#subscribeBtn").on('click',function(e) {
            e.preventDefault();
            // VERIFICAR MODO DEMO
            var isDemo="{{ env('PROJECT_MODE') }}"
            var demoNotify="{{ env('NOTIFY_TEXT') }}"
            if(isDemo==0){
                toastr.error(demoNotify);
                return;
            }
            // FIN

            $("#subscribe-spinner").removeClass('d-none')
            $("#subscribeBtn").addClass('custom-opacity')
            $("#subscribeBtn").removeClass('common_btn_2')
            $("#subscribeBtn").attr('disabled',true);
            $("#angleRight").addClass('d-none');

            $.ajax({
                url: "{{ route('subscribe-us') }}",
                type:"get",
                data:$('#subscribeForm').serialize(),
                success:function(response){
                    if(response.success){
                        $("#subscribeForm").trigger("reset");
                        toastr.success(response.success)

                        $("#subscribe-spinner").addClass('d-none')
                        $("#subscribeBtn").removeClass('custom-opacity')
                        $("#subscribeBtn").addClass('common_btn_2')
                        $("#subscribeBtn").attr('disabled',false);
                        $("#angleRight").removeClass('d-none');

                    }
                    if(response.error){
                        toastr.error(response.error)
                        $("#subscribeForm").trigger("reset");
                        $("#subscribe-spinner").addClass('d-none')
                        $("#subscribeBtn").removeClass('custom-opacity')
                        $("#subscribeBtn").addClass('common_btn_2')
                        $("#subscribeBtn").attr('disabled',false);
                        $("#angleRight").removeClass('d-none');
                    }
                },
                error:function(response){
                    if(response.responseJSON.errors.email){

                        toastr.error(response.responseJSON.errors.email[0])

                        $("#subscribe-spinner").addClass('d-none')
                        $("#subscribeBtn").removeClass('custom-opacity')
                        $("#subscribeBtn").addClass('common_btn_2')
                        $("#subscribeBtn").attr('disabled',false);
                        $("#angleRight").removeClass('d-none');

                    }
                }

            });

        })

    });

    })(jQuery);
</script>