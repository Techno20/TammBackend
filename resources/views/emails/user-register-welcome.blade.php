@component('mail::message')
<h1 style="text-align: center;margin-top: 20px;margin-bottom: 40px;">{{ __('auth.register_welcome_main_title') }}</h1>
<div>{{ __('auth.register_welcome_main_text') }}</div>
<hr style="border: 1px solid #eee;margin-top: 40px;margin-bottom: 40px;">
@component('mail::button', ['url' => config('app.website_url')])
{{ __('auth.register_welcome_main_btn') }}
@endcomponent
@endcomponent
