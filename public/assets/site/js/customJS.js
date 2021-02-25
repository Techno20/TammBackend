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
                console.log(response);
            }
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
                        ${response.data.data[i].message}                        </div>
                        <i class="fas fa-check-double seen"></i>
                    </div>
                    </div>

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
                </div>
                    `
                }
                
                
                
                response.data.data[i].message
                
            }
            console.log(response);
        }
    });
  }

  $(document).ready(function () {
    $("#btnReplayMessege").click(function (event) {
        event.preventDefault();
        var form = $('#formReplayMessege')[0];
        var data = new FormData(form);
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
                console.log(response);
                getMassegeChats(document.getElementById('tempIdConversations').value)
                $("#txtAeraMessage").val(" ")
            }
        });
    });
});





