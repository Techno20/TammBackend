// $(document).ready(function () {
//     $("#btnSendMassage").click(function (event) {
//         event.preventDefault();
//         var form = $('#formSendMassege')[0];
//         var data = new FormData(form);
//         $.ajax({
//             type: "POST",
//             url: "/user/conversation/send-message",
//             data: data,
//             dataType: "json",
//             processData: false,
//             contentType: false,
//             cache: false,
//             timeout: 800000,
//             success: function (response) {
//                 // console.log(response);
//                 if(response.message == "success"){
//                      document.getElementById('alertMessege').innerHTML =  `
//                         <div class="alert alert-success alert-dismissible fade show" role="alert">
//                         تم ارسال الرسالة بنجاح
//                         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
//                           <span aria-hidden="true">&times;</span>
//                         </button>
//                       </div>
//                         `
//                     $('#contact_message').val('');
//                 }
//             },
//             error: function(r) {
//                 document.getElementById('alertMessege').innerHTML =  `
//                 <div class="alert alert-danger alert-dismissible fade show" role="alert">
//                 فشل العملية
//                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
//                   <span aria-hidden="true">&times;</span>
//                 </button>
//               </div>
//                 `            }
//         });
//     });
// });






