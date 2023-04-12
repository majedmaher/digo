<!DOCTYPE html>

<head>
    <link rel="shortcut icon" type="x-icon" href="{{ URL::asset('logo.png') }}">
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="@yield('description')">
    <meta name="keywords" content="وكالة تسويق سعودية, شركة تسويق سعودية, شركة تسويق عالمية, السعودية, الرياض, @yield('keywords')">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/loader.css')}}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('https://pro.fontawesome.com/releases/v5.10.0/css/all.css') }}" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />

    <link rel="stylesheet" href="{{asset('css/blogs.css')}}">
    <link rel="stylesheet" href="{{ asset('css/style-rtl.css') }}" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <!-- <script>
        $(document).ready(function() {
            $('html, body').animate({
                scrollTop: $('#' + $(location).attr('href').split('#')[1]).offset().top - 120
            }, 200);
        });
    </script> -->
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
                                <a class="nav-link text-color" href="{{ route('blog', ['pageNumber' => 1]) }}">المدونة</a>
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

            <section class="blogs-window">
                @foreach ($latestBlogs as $blog)

                <div class="blog-item" style="background-image: url('{{URL::asset($blog->photo)}}');">
                    <span class="blog-title">{{$blog->title}}</span>
                    <a href="{{ route('blog.details', ['slug' => $blog->slug]) }}" target="_blank"></a>
                </div>

                @endforeach

            </section>
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

    @yield('scripts')

    <script>
        $(document).ready(function() {
            $('html').animate({
                scrollTop: $(window).height()
            }, 200);
        });
    </script>

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

    <script>
        // $("nav").css("display", "none");

        // Toggle Theme Start - light and dark mode
        function updateIcon() {
            if ($("body").hasClass("dark")) {
                $(".toggle-theme i").removeClass("bi-moon");
                $(".toggle-theme i").addClass("bi-sun");
            } else {
                $(".toggle-theme i").removeClass("bi-sun");
                $(".toggle-theme i").addClass("bi-moon");
            }
        }

        function toggleTheme() {
            if (localStorage.getItem("theme") !== null) {
                if (localStorage.getItem("theme") === "dark") {
                    $("body").addClass("dark");
                } else {
                    $("body").removeClass("dark");
                }
            }
            updateIcon();
        }
        toggleTheme();


        $(".toggle-theme").on("click", function() {
            $("body").toggleClass("dark");
            if ($("body").hasClass("dark")) {
                localStorage.setItem("theme", "dark");
            } else {
                localStorage.setItem("theme", "light");
            }
            updateIcon();
        });
        // Toggle Theme End - light and dark mode

        // Scroll Navbar Start
        var nav = document.querySelector('nav');

        window.addEventListener('scroll', function() {
            if (window.pageYOffset > 120) {
                nav.classList.add('nav-background', 'shadow');
            } else {
                nav.classList.remove('nav-background', 'shadow');
            }
            // if (window.pageYOffset > window.innerHeight) {
            //     $("nav").css("display", "block");
            // } else {
            //     $("nav").css("display", "none");
            // }
        });
        // Scroll Navbar End
    </script>


</body>

</html>