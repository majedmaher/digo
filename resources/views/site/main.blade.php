@extends('site.includes.header_footer')

@section('title', 'ديجو | للتسويق الرقمي وخدمات الويب المتكاملة')

@section('recaptch')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

{!! NoCaptcha::renderJs() !!}
@endsection

@section('description')
شركة تسويق عالمية تعمل بجمع الأفكار التسويقية التي تبتكر أساليب ومفاهيم عصرية وتقديمها بأساليب إبداعية خارجة عن المألوف
@endsection

@section('keywords')
الهوية البصرية, التسويق الرقمي, المواقع الإلكترونية, إدارة مواقع التواصل الاجتماعي 2021, العلامة التجارية كتابة محتوى, التصميم, التصاميم , الهوية , الاتصالات التسويقية, دعاية, دعاية واعلان, اعلان, حملات تسويقية , صناعة المحتوى, التسويق الالكتروني , شركات دعاية واعلان , وكالة دعاية واعلان , مؤسسة دعاية واعلان
@endsection

@section('css')
<link rel="stylesheet" href="{{asset('css/owl.carousel.min.css')}}" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="{{asset('css/owl.theme.min.css')}}" integrity="sha512-f28cvdA4Bq3dC9X9wNmSx21rjWI+5piIW/uoc2LuQ67asKxfQjUow2MkcCNcfJiaLrHcGbed1wzYe3dlY4w9gA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('content')

<section id="who-are-we" class="discount">
    <!-- discount -->

    <div class="container">
        <div class="row">
            <div class="sprites">
                <div class="sprite-item">
                    <div class="sprite-icon sprite-icon-1"></div>
                    <div class="sprite-info">
                        <h3>نبحث</h3>
                        <span>نبحث عن المعلومة</span>
                    </div>
                </div>
                <div class="sprite-item">
                    <div class="sprite-icon sprite-icon-2"></div>
                    <div class="sprite-info">
                        <h3>نكتب</h3>
                        <span>نكتب باحترافية</span>
                    </div>
                </div>
                <div class="sprite-item">
                    <div class="sprite-icon sprite-icon-3"></div>
                    <div class="sprite-info">
                        <h3>نصمم</h3>
                        <span>نصمم بجودة</span>
                    </div>
                </div>
                <div class="sprite-item">
                    <div class="sprite-icon sprite-icon-4"></div>
                    <div class="sprite-info">
                        <h3>إدارة</h3>
                        <span>ندير الحسابات بدقة</span>
                    </div>
                </div>
                <div class="sprite-item">
                    <div class="sprite-icon sprite-icon-5"></div>
                    <div class="sprite-info">
                        <h3>الأرباح</h3>
                        <span>نحقق الأرباح</span>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>


<!-- Start Services Section -->
<section class="services">
    <p class="text-color">
        “ العمل بالطريقة التي تريدها “
    </p>

    <h2 class="text-color">
        خـــدمـــاتـنا
    </h2>

    <h3 class="text-color">
        أنت على طاولة عمل شركتنا..
    </h3>
</section>
<!-- End Background Section-->



<!-- Start Works Section -->
<section id="services" class="works">

    <div class="row p-0 m-0">

        <div class="col-lg-4 col-md-6">

            <!-- Start Work Info -->
            <div class="work-info">

                @foreach ($firstServices as $service)

                <div class="work-item row">
                    <div class="col-md-4 cube">
                        <img src="{{ URL::asset($service->photo) }}" class="w-100" alt="{{ $service->title }}">
                    </div>
                    <div class="col-md-8">

                        <h4 class="work-title mb-2">
                            {{ $service->title }}
                        </h4>
                        <p class="work-description m-0 p-0">
                            {!! $service->content !!}
                        </p>
                    </div>
                </div>

                @endforeach


            </div>
            <!-- End Work Info -->

        </div>


        <div class="col-lg-4 col-md-6">

            <!-- Start Work Info -->
            <div class="work-info">

                @foreach ($secondServices as $service)

                <div class="work-item row">
                    <div class="col-md-4 cube">
                        <img src="{{ URL::asset($service->photo) }}" class="w-100" alt="{{ $service->title }}">
                    </div>
                    <div class="col-md-8">

                        <h4 class="work-title mb-2">
                            {{ $service->title }}
                        </h4>
                        <p class="work-description m-0 p-0">
                            {!! $service->content !!}
                        </p>
                    </div>
                </div>

                @endforeach


            </div>
            <!-- End Work Info -->

        </div>

        <div class="col-lg-4 col-md-6 work-img">

        </div>
    </div>

</section>
<!-- End Works Section -->


<!-- Start Blog End -->
<section id="works" class="blog d-flex justify-content-center">

    <!-- Start Blog Content -->
    <div class="blog-content">

        <div class="container">
            <h3 class="order-now text-color d-inline-block">
                <a class="btn" href="{{ route('orders') }}">أطلب الأن/استفسر</a>
            </h3>

            <h2 class="blog-title text-color">
                شركاء نجاحنا
            </h2>


            <div class="row">
                <div class="carousel-blog col-md-12">
                    <div id="owl-demo" class="owl-carousel owl-theme">
                        @foreach ($works as $work)
                        <div class="item">
                            <a href="{{ $work->link }}">
                                <div class="img-area">
                                    <img src="{{ URL::asset($work->photo) }}" alt="">
                                </div>
                                <div class="img-text">
                                    <p class="text-color">{{ $work->description }}</p>
                                </div>
                            </a>
                        </div>
                        @endforeach

                    </div>
                </div>
            </div>


            <a class="btn btn-display-all-works" href="{{route('latestWorks')}}">عــرض كـــــل
                الاعـــمــــال <i class="bi bi-arrow-left"></i> </a>





            <!-- Start Subscribe Form Section -->
            <div class="subscribe">
                <img src="{{ asset('images/Vector-Smart-Object.png') }}" alt="subscribe-form">
                <!-- Start Subscribe Form -->
                <form action="{{ route('subscribe.store') }}" method="POST" class="subscribe-form">
                    @csrf
                    <input type="text" class="form-input" name="name" placeholder="NAME">
                    <br />
                    <input type="email" class="form-input" name="email" aria-describedby="emailHelp" placeholder="ENTER YOUR MAIL ADDRESS">
                    <button type="submit" hidden></button>

                </form>
                <!-- End Subscribe Form -->
            </div>
            <!-- End Subscribe Form Section -->


            <!-- Start Map Section -->
            <div class="map">
                <img src="{{ asset('images/the-world.png') }}" alt="">
                <div class="point"></div>
            </div>
            <!-- Start Map Section -->
        </div>

    </div>
    <!-- Start Blog Content -->
</section>
<!-- End Blog End -->



<!-- Start Contact-us Section -->
<section id="contact-us" class="contact-us text-color">
    <div class="container">
        <div class="row">
            <div class="col-md-5  d-flex  align-items-center justify-content-center">
                <div class="company-information">
                    <p class="location-city">
                        <i class="bi bi-geo-alt-fill"></i> الرياض ، جدة
                    </p>
                    <p class="phone-number">
                        <i class="bi bi-phone"></i> 00966567020925
                    </p>
                    <p class="email-address">
                        <i class="bi bi-envelope"></i> info@digo.sa
                    </p>
                </div>
            </div>
            <div class="col-md-7">
                <h4 class="contact-us-h4">
                    تواصل معنا
                </h4>
                <p class="contact-description">
                    إذا كنت لديك مشكلة أو حلول يمكنك إرسال لنا رسالة وسوف نرد عليك في أقرب وقت
                </p>
                <form action="{{ route('contact.store') }}" method="POST">
                    @csrf
                    <input type="text" class="form-control" name="name" id="" placeholder="اسمك">
                    <input type="email" class="form-control" name="email" id="" placeholder="البريد الإلكتروني" aria-describedby="emailHelp">
                    <textarea type="text" class="form-control mb-3" name="message" id="" placeholder="رسالة" rows="3"></textarea>


                    <div class="recaptcha">

                        {{-- {!! NoCaptcha::display() !!} --}}

                        {!! NoCaptcha::display(['data-theme' => 'dark']) !!}

                        {{-- @if ($errors->has('g-recaptcha-response')) --}}
                        {{-- <span class="help-block">
                                        <strong> recaptcha هذا الحقل مطلوب </strong>
                                    </span> --}}
                        {{-- @endif --}}
                    </div>

                    <button type="submit" class="form-control mt-3">إرسال <i class="far fa-paper-plane"></i></button>
                </form>
            </div>
        </div>
    </div>
</section>
<!-- End Contact-us Section -->


@endsection


@section('scripts')
<script src="{{asset('js/owl.carousel.min.js')}}" integrity="sha512-9CWGXFSJ+/X0LWzSRCZFsOPhSfm6jbnL+Mpqo0o8Ke2SYr8rCTqb4/wGm+9n13HtDE1NQpAEOrMecDZw4FXQGg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $(document).ready(function() {

        $("#owl-demo").owlCarousel({

            //Basic Speeds
            slideSpeed: 200,
            paginationSpeed: 800,

            //Autoplay
            autoPlay: 3000,
            goToFirst: true,
            goToFirstSpeed: 1000,

            // Navigation
            navigation: false,
            navigationText: ["prev", "next"],
            pagination: true,
            paginationNumbers: false,

            // Responsive
            items: 4,
            itemsDesktop: [1199, 4],
            itemsDesktopSmall: [980, 3],
            itemsTablet: [768, 2],
            itemsMobile: [479, 1]

        });

    });
</script>
@endsection