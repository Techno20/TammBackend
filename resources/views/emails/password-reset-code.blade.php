@component('mail::message')
<div style="text-align: center">
<h1>{!! __('auth.password_reset.code_is',['code' => '<b>'.$Code.'</b>']) !!}</h1>
<hr style="margin: 20px 0;">
<small class="text-muted">{{ __('auth.password_reset.note') }}</small>
</div>
@endcomponent
