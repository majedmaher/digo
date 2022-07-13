<!DOCTYPE html>
@yield('recaptch')

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=7">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" type="x-icon" href="{{ URL::asset('logo.png') }}">
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="@yield('description')">
    <meta name="keywords" content="وكالة تسويق سعودية, شركة تسويق سعودية, شركة تسويق عالمية, السعودية, الرياض, @yield('keywords')">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/loader.css')}}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('https://pro.fontawesome.com/releases/v5.10.0/css/all.css') }}" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />

    <link rel="stylesheet" href="{{ asset('css/style-rtl.css') }}" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    @yield('css')

    <script>
        $(document).ready(function() {
            $('html, body').animate({
                scrollTop: $('#' + $(location).attr('href').split('#')[1]).offset().top - 120
            }, 200);
        });
    </script>
</head>

<body class="dark">
    <div class="loader-wrapper">
        <span class="loader"><span class="loader-inner"></span></span>
    </div>

    <div class="page">
        <!-- <div class="background"> -->
        <div class="background">
            <!-- Start Navbar Secetion -->
            <nav class="navbar fixed-top navbar-expand-lg navbar-dark p-md-3">
                <div class="container">
                    <a class="navbar-brand my-2 my-lg-0" href="{{ URL::asset('uploads/profile-company.pdf') }}" download="بروفايل الشركة">تحميل البروفايل</a>

                    <a class="navbar-brand my-2 my-lg-0" href="{{ route('orders') }}">أطلب الأن</a>

                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link text-color" href="{{ route('main') }}">الرئيسية</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-color" href="{{ route('main') }}#services">خدماتنا</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-color" href="{{ route('main') }}#works">اعمالنا</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-color" href="{{ route('blog', ['pageNumber' => 1]) }}#blog-content">المدونة</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-color" href="{{ route('job.request') }}#job-request">وظيفة</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-color" href="{{ route('main') }}#contact-us">اتصل بنا</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <!-- End Navbar Section -->

            <!-- Banner Image  -->
            <div id="sliders">
                @foreach ($sliders as $slider)

                <div class="row banner justify-content-center align-items-center" style="background-image: url('{{ asset($slider->background) }}')">
                    <div class="banner-content col-md-6">
                        <h3>{{$slider->sub_title}}</h3>
                        <h2>{{$slider->title}}</h2>
                        <div class="banner-details">{!! $slider->content !!}</div>

                        <a target="_blank" href="{{$slider->more_link}}">{{$slider->more_btn}} <i class="fas fa-long-arrow-alt-left"></i></a>
                    </div>
                    <div class="banner-img col-md-6">

                        @if ($slider->photo != null)
                        <!-- <img src="{{ URL::asset($slider->photo) }}"> -->
                        @endif

                    </div>

                </div>
                @endforeach
            </div>
        </div>
        <div class="follow-us">
            <span>تــابعــونا</span>
            <a target="_blank" href="https://www.instagram.com/digoksa1"><i class="bi bi-instagram text-color mx-1"></i></a>
            <a target="_blank" href="https://www.twitter.com/digoksa1"><i class="bi bi-twitter text-color mx-1"></i></a>
            <a target="_blank" href="https://www.facebook.com/digoksa1"><i class="bi bi-facebook text-color mx-1"></i></a>
            <a target="_blank" href="https://www.linkedin.com/digoksa1"><i class="bi bi-linkedin text-color mx-1"></i></a>
        </div>

        <div class="manual-btns">
            @foreach ($slidersTitle as $slider)
            <div class="manual-btn">
                <!-- <div class="hover">{{$slider->title}}</div> -->
            </div>
            @endforeach
        </div>



        @yield('content')


        <!-- Footer Section Start -->
        <footer class="footer">
            <div class="footer-menu">
                <nav class="navbar navbar-footer navbar-expand-lg navbar-dark">
                    <div class="container justify-content-center align-items-center">
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarFooter" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <div class="collapse navbar-collapse justify-content-center align-items-center" id="navbarFooter">
                            <ul class="navbar-nav">
                                <li class="nav-item">
                                    <a class="nav-link text-color" href="#">الهوية البصرية </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-color" href="#">التسويق</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-color" href="#">التصميم</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-color" href="#">صناعة المحتوى</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-color" href="#">الاعلانات</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>


            <div class="footer-information d-flex align-items-center justify-content-center text-color">
                <div class="footer-info">
                    <img src="{{ asset('images/logo-digo.png') }}" alt="logo">
                    <p>موقع ديجو 2021 جميع الحقوق محفوظة</p>
                    <p>صنع بحب في ديجو</p>
                </div>
            </div>
        </footer>
        <!-- Footer Section End -->




        <!-- Toggle Theme Start - light and dark mode -->
        <div class="toggle-theme">
            <i class="bi bi-moon"></i>
        </div>
        <!-- Toggle Theme End -->
    </div>

    <script>
        $(window).on("load", function() {
            $(".loader-wrapper").fadeOut("slow");
            $(".page").css("display", "block");
        });
    </script>

    <script>
        $(".nav-item a").click(function() {
            $('html, body').animate({
                scrollTop: $('#' + $(this).attr('href').split('#')[1]).offset().top - 120
            }, 200);
        });
    </script>


    <script src="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js') }}" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>



    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/script.js') }}"></script>
    <script src="{{ asset('js/gallery.js') }}"></script>

    <!-- <script>
        // alert($(location).attr("href"));

        var $a = 347 + $('#contact-us').offset().top;

        alert($a);

        $(document).scrollTop($a);
    </script> -->


    @yield('scripts')
</body>

</html>