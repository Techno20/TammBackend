$(document).ready(function () {
    $("#btnSendMassage").click(function (event) {
        event.preventDefault();
        var form = $('#formSendMassege')[0];
        var data = new FormData(form);
        $.ajax({
            type: "POST",
            url: "/user/conversation/send-message",
            data: data,
            dataType: "json",
            processData: false,
            contentType: false,
            cache: false,
            timeout: 800000,
            success: function (response) {
                // console.log(response);
                if(response.message == "success"){
                     document.getElementById('alertMessege').innerHTML =  `
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                        تم ارسال الرسالة بنجاح
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                        `

                }
            },
            error: function(r) {
                document.getElementById('alertMessege').innerHTML =  `
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                فشل العملية
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
                `            }
        });
    });
});

function getMassegeChats(id) {
    document.getElementById('tempIdConversations').value = id;
    $.ajax({
        type: "GET",
        url: "/user/conversation/messages/"+id,
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

        if(!$('#txtAeraMessage').val())
        {
            $('#txtAeraMessage').prop('required',true);
            alert('يتوجب عليك ادخال نص الرسالة');
        }
        else
        {
            $.ajax({
                type: "POST",
                url: "/user/conversation/send-reply/"+$('#tempIdConversations').val(),
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





