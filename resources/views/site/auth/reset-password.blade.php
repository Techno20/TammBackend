@extends('site.layout.main')

@section('css')
@endsection

@section('js')
@endsection

@section('content')

<section class="text-video-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6  order-lg-last ">
                <figure class="wow fadeInUp" data-wow-duration="1.5s" style="visibility: visible; animation-duration: 1.5s; animation-name: fadeInUp;">
                    <img src="{{ asset('assets/site/images/how-its-work/main-img.png') }}" class="img-fluid">

                </figure>
            </div>
            <div class="col-lg-6">
                <div class="text">
                    <header class="wow fadeInUp" data-wow-duration="1.5s" style="visibility: visible; animation-duration: 1.5s; animation-name: fadeInUp;">
                        <h3>@lang('site.reset_password')</h3>
                    </header>
                    <div class="content">
                        @lang('site.reset_password_content')
                    </div>

                    <div>
                        <div class="alert-text content">
                            @if(count($errors) > 0)
                                @foreach($errors->all() as $error)
                                    <div class="alert alert-danger" role="alert">
                                        <strong></strong> {{ $error }}
                                    </div>
                                @endforeach
                            @endif
                        </div>
						<form class="pt-5" action="{{ route('reset.password') }}" method="POST" >
                            @csrf
                            <input type="hidden" name="token" value="{{ $token }}">
							<div class="form-group mb-4">
								{{-- <label for="exampleFormControlInput1">الاسم</label> --}}
								<input type="email" class="form-control form-control-lg name" placeholder="@lang('site.email')" name="email" required>
							</div>
							<div class="form-group mb-4">
								{{-- <label for="exampleFormControlInput1">البريد الإلكتروني</label> --}}
								<input type="password" class="form-control form-control-lg name"  placeholder="@lang('site.New_Password')" name="password" required>
							</div>
                            <div class="form-group mb-4">
                                <input type="password" class="form-control form-control-lg name"  placeholder="@lang('site.Confirm Password')" name="password_confirmation" required>
                            </div>
							<button type="submit" class="btn btn-lg btn-block btn-yallow ">@lang('site.Save Changes')</button>
						</form>
					</div>
                </div>
            </div>

        </div>
    </div>
</section>
@endsection
