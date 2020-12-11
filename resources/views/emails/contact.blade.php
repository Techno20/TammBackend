@component('mail::message')
<h1 style="text-align: center;margin-bottom: 0px;">تفاصيل الرسالة</h1>
@component('mail::table')
|        | |
| ------------- |-------------
|  <b>الاسم</b>      | {{ $Message->name }}
|  <b>البريد الألكتروني</b>      | {{ $Message->email }}
| <b>الرسالة</b>      | {{ $Message->message }}
@endcomponent
@endcomponent
