<!-- Optional JavaScript -->
<script src="{{ asset('assets/site/js/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('assets/site/js/popper.min.js') }}"></script>
<script src="{{ asset('assets/site/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/site/plugins/owlslider/owl.carousel.min.js') }}"></script>
<script src="{{ asset('assets/site/plugins/fancybox/jquery.fancybox.min.js') }}"></script>
<script src="{{ asset('assets/site/plugins/jquery-nice-select-master/js/jquery.nice-select.min.js') }}"></script>
<script src="{{ asset('assets/site/plugins/bootstrap-tagsinput-latest/dist/bootstrap-tagsinput.js') }}"></script>
<script src="{{ asset('assets/site/js/customJS.js') }}"></script>

<script src="{{ asset('assets/site/js/wow.min.js') }}"></script>
@if(app()->getLocale() == 'ar')
    <script src="{{ asset('assets/site/js/main-rtl.js') }}"></script>
@else
    <script src="{{ asset('assets/site/js/main.js') }}"></script>

@endif

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.14.0/dist/sweetalert2.all.min.js"></script>
<!-- Optional: include a polyfill for ES6 Promises for IE11 -->
<script src="https://cdn.jsdelivr.net/npm/promise-polyfill"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="{{ asset('assets/site/plugins/ckeditor5-build-classic/ckeditor.js') }}"></script>

<script>
    $(document).ready(function () {
        $('.select2').select2({
            placeholder: "@lang('site.write_hear')",
            tags:true,
        });

        if ($('#editor').length != 0) {
            ClassicEditor
                .create(document.querySelector('#editor'))
                .catch(error => {
                    console.error(error);
                });
        }

        $('body').on('click','.user_register',function () {
            var name = $('.user_register_block .name').val();
            var email = $('.user_register_block .email').val();
            var password = $('.user_register_block .password').val();
            let data = {
                "_token": "{{ csrf_token() }}",
                "name": name,
                "email": email,
                "password": password
            }
            $.ajax({
                type: "POST",
                url: '{{ url('user/register') }}',
                data: data,
                dataType: 'json',
                success:  function(result){
                    Swal.fire({
                        icon: "success",
                        title: "نجاح",
                        text: "تمت عملية التسجيل بنجاح",
                        showConfirmButton : false,
                        confirmButtonText: 'استمرار'
                    });
                    setTimeout(function () {
                        window.location = "{{ url('user/dashboard') }}";
                    },3000);
                },
                error:  function(result){
                    var errors_text = '';
                    $.each(result.responseJSON.data.errors, function(i, item) {
                        errors_text = errors_text+item+'<br/>';
                    });

                    Swal.fire({
                        icon: 'error',
                        title: 'خطأ',
                        // text: errors_text,
                        html: errors_text,
                        confirmButtonText: 'موافق'
                    })

                }
            });
        });
        $('body').on('click','.user_login',function () {
            var email = $('.user_login_block .email').val();
            var password = $('.user_login_block .password').val();
            let data = {
                "_token": "{{ csrf_token() }}",
                "email": email,
                "password": password
            };
            $.ajax({
                type: "POST",
                url: '{{ url('user/login') }}',
                data: data,
                dataType: 'json',
                success:  function(result){
                    Swal.fire({
                        icon: "success",
                        title: "نجاح",
                        text: "تمت عملية تسجيل الدخول بنجاح",
                        showConfirmButton : false,
                        confirmButtonText: 'استمرار'
                    });
                    setTimeout(function () {
                        window.location = "{{ url('/') }}";
                    },3000);
                },
                error:  function(result){
                    if (result.responseJSON.status == false && result.responseJSON.message == 'login_failed'){
                        Swal.fire({
                            icon: 'error',
                            title: 'خطأ',
                            html: result.responseJSON.message_string,
                            confirmButtonText: 'موافق'
                        })
                    }else if(result.responseJSON && result.responseJSON.data && result.responseJSON.data.hasOwnProperty('errors')){
                        var errors_text = '';
                        $.each(result.responseJSON.data.errors, function(i, item) {
                            errors_text = errors_text+item+'<br/>';
                        });

                        Swal.fire({
                            icon: 'error',
                            title: 'خطأ',
                            // text: errors_text,
                            html: errors_text,
                            confirmButtonText: 'موافق'
                        })
                    }else{
                        Swal.fire({
                            icon: 'error',
                            title: 'خطأ',
                            html: 'الرجاء التأكد من البيانات المدخلة',
                            confirmButtonText: 'موافق'
                        })
                    }

                }
            });
        });

        $('body').on('click keyup keydown change','.input_to_count',function (){
            $('.input_text_count').text(this.value.length);
        });
        $('body').on('click keyup keydown change','.input_to_count_2',function (){
            $('.input_text_count_2').text(this.value.length);
        });
        $('body').on('click keyup keydown change','.input_to_count_3',function (){
            $('.input_text_count_2').text(this.value.length);
        });

        @if(session()->has('have_to_login') && session('have_to_login'))
            $('.btn.btn-white.sign-in').trigger('click');
        @endif
    });
</script>
