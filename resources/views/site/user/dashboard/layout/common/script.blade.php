<!-- Optional JavaScript -->
<script src="{{ asset('assets/site/js/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('assets/site/js/popper.min.js') }}"></script>
<script src="{{ asset('assets/site/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/site/plugins/owlslider/owl.carousel.min.js') }}"></script>
<script src="{{ asset('assets/site/plugins/fancybox/jquery.fancybox.min.js') }}"></script>
<script src="{{ asset('assets/site/plugins/jquery-nice-select-master/js/jquery.nice-select.min.js') }}"></script>
<script src="{{ asset('assets/site/plugins/bootstrap-tagsinput-latest/dist/bootstrap-tagsinput.js') }}"></script>

<script src="{{ asset('assets/site/js/wow.min.js') }}"></script>
@if(app()->getLocale() == 'ar')
    <script src="{{ asset('assets/site/js/main-rtl.js') }}"></script>
    <script src="{{ asset('assets/site/js/dashboard-rtl.js') }}"></script>
@else
    <script src="{{ asset('assets/site/js/main.js') }}"></script>
    <script src="{{ asset('assets/site/js/dashboard.js') }}"></script>
@endif

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.14.0/dist/sweetalert2.all.min.js"></script>
<!-- Optional: include a polyfill for ES6 Promises for IE11 -->
<script src="https://cdn.jsdelivr.net/npm/promise-polyfill"></script>

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
                    Swal.fire({
                        icon: "success",
                        title: "نجاح",
                        text: "تمت عملية التسجيل بنجاح",
                        showConfirmButton : false,
                        confirmButtonText: 'استمرار'
                    });
                    setTimeout(function () {
                        window.location = "{{ url(url()->current()) }}";
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
                        window.location = "{{ url(url()->current()) }}";
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
    });

    function getMassegeChats(id) {
        document.getElementById('tempIdConversations').value = id;
        $.ajax({
            type: "GET",
            url: "/develop/public/user/conversation/messages/"+id,
            data: "data",
            dataType: "json",
            success: function (response) {

                document.getElementById('messages_body_content').innerHTML = ' '
                for (let i = 0; i < response.data.data.length; i++) {
                    if(response.data.data[i].user_id == $("#idMyUSer").val()){
                        document.getElementById('messages_body_content').innerHTML +=
                            `
                    <div class="message-respond-item">
                    <p class="date">${response.data.data[i].created_at}</p>
                    <div class="ms-contnet d-flex flex-row-reverse align-items-end">
                        <div class="content">
                        ${response.data.data[i].message}
                        </div>
                        <i class="fas fa-check-double seen"></i>

                    </div>
                        `

                        if(response.data.data[i].attachments){
                            document.getElementById('messages_body_content').innerHTML +=
                                `
                        <div class="message-respond-item">
                             <a target="_blank" href="/storage/messages/${response.data.data[i].attachments}">استعراض المرفقات</a>
                            <br>
                        </div>
`
                        }
                        `
                    </div>
                    <br>

                    `
                    }else{
                        document.getElementById('messages_body_content').innerHTML +=
                            `
                    <div class="message-item">
                    <div class="ms-head d-flex align-items-center justify-content-between">
                        <div class="media">
                            <img src="${response.data.data[i].user.avatar_full_path}" class="img-fluid">
                            <div class="media-body">
                                <h5>

                                </h5>
                            </div>
                        </div>
                        <p class="date">${response.data.data[i].created_at}</p>
                    </div>
                    <div class="ms-contnet">
                        ${response.data.data[i].message}
                    </div>

                        `
                        if(response.data.data[i].attachments){
                            document.getElementById('messages_body_content').innerHTML +=
                                `
                                <div class="ms-contnet-another">
                                <a target="_blank" href="/storage/messages/${response.data.data[i].attachments}">استعراض المرفقات</a>
                        </div>
                                    `
                        }

                        `
                </div>
                    `
                    }



                    response.data.data[i].message

                }
                // console.log(response);
            }
        });
    }

    $(document).ready(function () {
        $("#btnReplayMessege").click(function (event) {
            event.preventDefault();
            var form = $('#formReplayMessege')[0];
            var data = new FormData(form);
            data.append('_token', '{{csrf_token()}}');

            if(!$('#txtAeraMessage').val())
            {
                $('#txtAeraMessage').prop('required',true);
                alert('يتوجب عليك ادخال نص الرسالة');
            }
            else
            {
                $.ajax({
                    type: "POST",
                    url: "/develop/public/user/conversation/send-reply/"+$('#tempIdConversations').val(),
                    data: data,
                    dataType: "json",
                    processData: false,
                    contentType: false,
                    cache: false,
                    timeout: 800000,
                    success: function (response) {
                        // console.log(response);
                        getMassegeChats(document.getElementById('tempIdConversations').value)
                        $("#txtAeraMessage").val(" ")
                    },

                });
            }

        });
    });

</script>
