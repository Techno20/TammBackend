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
                    <img src="assets/site/images/how-its-work/main-img.png" class="img-fluid">

                </figure>
            </div>
            <div class="col-lg-6">
                <div class="text">
                    <header class="wow fadeInUp" data-wow-duration="1.5s" style="visibility: visible; animation-duration: 1.5s; animation-name: fadeInUp;">
                        <h3>اتصل بنا</h3>
                    </header>
                    <div class="content">
                        نحن نساعدك بالوصول السريع لاعمالك
                    </div>
                    
                    <div>
                        <div class="alert-text content">@include('site.alerts.success')</div>
						<form class="pt-5" action="{{ url('contactus') }}" method="POST" >@csrf
							<div class="form-group mb-4">
								{{-- <label for="exampleFormControlInput1">الاسم</label> --}}
								<input type="text" class="form-control form-control-lg name" placeholder="هنا الاسم " name="name" required>
							</div>
							<div class="form-group mb-4">
								{{-- <label for="exampleFormControlInput1">البريد الإلكتروني</label> --}}
								<input type="email" class="form-control form-control-lg name"  placeholder="هنا البريد الإلكتروني" name="email" required>
							</div>
							<div class="form-group">
								{{-- <label for="exampleFormControlTextarea1">موضع الرسالة</label> --}}
								<textarea class="form-control form-control-lg name"  rows="3" placeholder=" اكتب رسالتك هنا" name="message" required></textarea>
							</div>
							<button type="submit" class="btn btn-lg btn-block btn-yallow ">ارسال</button>
						</form>
					</div>
                </div>
            </div>

        </div>
    </div>
</section>
@endsection
