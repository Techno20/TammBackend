<!-- Optional JavaScript -->
<script src="{{ asset('assets/site/js/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('assets/site/js/popper.min.js') }}"></script>
<script src="{{ asset('assets/site/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/site/plugins/owlslider/owl.carousel.min.js') }}"></script>
<script src="{{ asset('assets/site/plugins/fancybox/jquery.fancybox.min.js') }}"></script>

<script src="{{ asset('assets/site/js/wow.min.js') }}"></script>
@if(app()->getLocale() == 'ar')
    <script src="{{ asset('assets/site/js/main-rtl.js') }}"></script>
@else
    <script src="{{ asset('assets/site/js/main.js') }}"></script>
@endif


<script>
    $(document).ready(function () {
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
                    alert(result);
                    console.log(result);
                },
                error:  function(result){
                    // console.log(result.responseJSON.data.errors);
                    // result.responseJSON.data.errors.each(function (index,value) {
                    //     console.log(result.responseJSON.status);
                    //     console.log(index+':'+value);
                    // });
                    $.each(result.responseJSON.data.errors, function(i, item) {
                        console.log(i);
                        console.log(item);
                    });
                }
            });
        });
    });
</script>
