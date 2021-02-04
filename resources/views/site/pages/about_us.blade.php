@extends('site.layout.main')

@section('css')
@endsection

@section('js')
@endsection

@section('content')
    <div class="body-content">

        <!-- about-us-page -->
        <section class="about-us-page">
            <div class="container">
                <header class="sec-header-2 text-center">
                    <h2>@lang('site.about_us')</h2>
                    <p>Lorem Ipsum is simply dummy text of the.</p>
                </header>
                <div class="sec-content">
                    <div class="about-gallery-sec">
                        <div class="wrapper d-flex flex-wrap">
                            <div class="large-col">
                                <figure class="lg-img wow fadeInUp" data-wow-duration="1.5s">
                                    <img src="{{ asset('assets/site/images/aboutus/1.png') }}" class="img-fluid">
                                </figure>
                            </div>
                            <div class="small-col">
                                <div class="row mx-n1">
                                    <div class="col-12 px-1">
                                        <figure class="sm-img wow fadeInUp" data-wow-duration="1.5s" data-wow-delay="0.2s">
                                            <img src="{{ asset('assets/site/images/aboutus/2.png') }}" class="img-fluid">
                                        </figure>
                                    </div>
                                    <div class="col-12 px-1">
                                        <figure class="sm-img wow fadeInUp" data-wow-duration="1.5s" data-wow-delay="0.4s">
                                            <img src="{{ asset('assets/site/images/aboutus/3.png') }}" class="img-fluid">
                                        </figure>
                                    </div>
                                </div>
                            </div>
                            <div class="large-col">
                                <figure class="lg-img wow fadeInUp" data-wow-duration="1.5s" data-wow-delay="0.5s">
                                    <img src="{{ asset('assets/site/images/aboutus/4.png') }}" class="img-fluid">
                                </figure>
                            </div>
                        </div>
                    </div>
                    <div class="content wow fadeInUp" data-wow-duration="1.5s">
                        <p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.</p>
                        <p>The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from "de Finibus Bonorum et Malorum" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.</p>
                        <p>The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from "de Finibus Bonorum et Malorum" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.</p>
                        <p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.</p>
                        <p>The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from "de Finibus Bonorum et Malorum" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.</p>
                        <p>The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from "de Finibus Bonorum et Malorum" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.</p>
                    </div>
                </div>
            </div>
        </section>
        <!-- about-us-page -->
    </div>
@endsection
