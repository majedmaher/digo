<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="shortcut icon" type="x-icon" href="{{ URL::asset('logo.png') }}">
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="ديجيتال اون جو شركة تعمل على جمع الأفكار التسويقية التي تبتكر أساليب ومفاهيم عصرية وتقديمها بطرق إبداعية خارجة عن المألوف">
    <meta name="keywords" content="الهوية البصرية, التسويق الرقمي, المواقع الإلكترونية, إدارة مواقع التواصل الاجتماعي 2021, العلامة التجارية كتابة محتوى, التصميم, التصاميم , الهوية , الاتصالات التسويقية, دعاية, دعاية واعلان, اعلان, حملات تسويقية , صناعة المحتوى, التسويق الالكتروني , شركات دعاية واعلان , وكالة دعاية واعلان , مؤسسة دعاية واعلان">
    <title>اطلب خدمتك</title>

    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/orders.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/loader.css')}}">

    <script src="https://code.jquery.com/jquery-3.5.0.js"></script>


</head>

<body>
    <div class="loader-wrapper">
        <span class="loader"><span class="loader-inner"></span></span>
    </div>

    <div class="page">
        <section class="orders">
            <div class="row justify-content-center">
                <a href="{{route('order',['order' => 'تطبيقات الموبايل'])}}" class="order col-lg-3 col-sm-6 ">
                    <div>
                        {{-- <span class="order-img"> --}}
                        <img class="order-img svg" src="{{ asset('images/app_design_hover.svg') }}" alt="">
                        <img class="order-img png" src="{{ asset('images/app_design_hover.png') }}" alt="">
                        {{-- </span> --}}
                        <h5 class="order-title">تطبيقات الموبايل</h5>
                        <p class="order-description">تصميم وتطوير تطبيقات هواتف محمولة احترافية وتتبع أحدث مستويات التقنية،
                            لتحقيق الأهداف من تقديم الخدمات والوصول عبر أجهزة الموبايل.</p>
                    </div>
                </a>
                <a href="{{route('order',['order' => 'مواقع الانترنت'])}}" class="order col-lg-3 col-sm-6 ">
                    <div>
                        <img class="order-img svg" src="{{ asset('images/web_design_hover.svg') }}" alt="">
                        <img class="order-img png" src="{{ asset('images/web_design_hover.png') }}" alt="">
                        <h5 class="order-title">مواقع الانترنت</h5>
                        <p class="order-description">نعبر عنكم بتصميم واجهات صفحات ويب رفيعة الذوق و متجاوبة مع كافة
                            الأجهزة، لتحقق أفضل تجربة مستخدم.</p>
                    </div>
                </a>
                <a href="{{route('order',['order' => 'التصميم الجرافيكي'])}}" class="order col-lg-3 col-sm-6 ">
                    <div>
                        <img class="order-img svg" src="{{ asset('images/graphic_design_hover.svg') }}" alt="">
                        <img class="order-img png" src="{{ asset('images/graphic_design_hover.png') }}" alt="">
                        <h5 class="order-title">التصميم الجرافيكي</h5>
                        <p class="order-description">نرسم لزبوننا التصاميم التي تعبر عنه بحقيقة وتجذب له لفت الإنتباه وإبداع
                            الظهور بالمشهد الأفضل بين الجميع!</p>
                    </div>
                </a>
                <a href="{{route('order',['order' => 'إنتاج الفيديو'])}}" class="order col-lg-3 col-sm-6 ">
                    <div>
                        <img class="order-img svg" src="{{ asset('images/motion_graphics_hover.svg') }}" alt="">
                        <img class="order-img png" src="{{ asset('images/motion_graphics_hover.png') }}" alt="">
                        <h5 class="order-title">إنتاج الفيديو</h5>
                        <p class="order-description">فريقنا يصنع رسوماً متحركة وينتج فيديوهات تلهم العمل وتروي القصة
                            الحقيقية عنكم، حقق الوصول الأفضل!</p>
                    </div>
                </a>
                <a href="{{route('order',['order' => 'تطوير وبرمجة الويب'])}}" class="order col-lg-3 col-sm-6 ">
                    <div>
                        <img class="order-img svg" src="{{ asset('images/development_hover.svg') }}" alt="">
                        <img class="order-img png" src="{{ asset('images/development_hover.png') }}" alt="">
                        <h5 class="order-title">تطوير وبرمجة الويب</h5>
                        <p class="order-description">بناء وتطوير مواقع إنترنت ديناميكية عالية الأداء، وتقديم خدمات زبائننا
                            بمستوى احترافي من التقنية والتقدم</p>
                    </div>
                </a>
                <a href="{{route('order',['order' => 'الهوية البصرية'])}}" class="order col-lg-3 col-sm-6 ">
                    <div>
                        <img class="order-img svg" src="{{ asset('images/branding_hover.svg') }}" alt="">
                        <img class="order-img png" src="{{ asset('images/branding_hover.png') }}" alt="">
                        <h5 class="order-title">الهوية البصرية</h5>
                        <p class="order-description">تصميم هويتكم المرئية واعطاءها اللمسة التي تظل عالقة في أذهان
                            الناس.وجعلها قوية لتحقيق النجاح.</p>
                    </div>
                </a>
                <a href="{{route('order',['order' => 'التسويق الرقمي'])}}" class="order col-lg-3 col-sm-6 ">
                    <div>
                        <img class="order-img svg" src="{{ asset('images/digital_marketing_hover.svg') }}" alt="">
                        <img class="order-img png" src="{{ asset('images/digital_marketing_hover.png') }}" alt="">
                        <h5 class="order-title">التسويق الرقمي</h5>
                        <p class="order-description">We hand craft various design sets from scratch. We present, iterate and
                            collaborate with you until we finalize the design.</p>
                    </div>
                </a>
                <a href="{{route('order',['order' => 'الاستضافة والسيرفرات'])}}" class="order col-lg-3 col-sm-6 ">
                    <div>
                        <img class="order-img svg" src="{{ asset('images/hosting_hover.svg') }}" alt="">
                        <img class="order-img png" src="{{ asset('images/hosting_hover.png') }}" alt="">
                        <h5 class="order-title">الاستضافة والسيرفرات</h5>
                        <p class="order-description">يقود فريقنا عمليات ادارة السيرفرات واعدادها وتأجيرها لتصبح البيت الآمن
                            والاكثر تلبية لاحتياجات بياناتك على شبكة الانترنت.</p>
                    </div>
                </a>
            </div>
        </section>
    </div>

    <script>
        $(window).on("load", function() {
            $(".loader-wrapper").fadeOut("slow");
            $(".page").css("display", "block");
        });
    </script>

    <script>
        $('.orders').css('height', $(document).height());
        $('.order').css('height', $(document).height() / 2);


        // $('.order').hover(function () {
        //     $('.order-description').show(2);

        //     }, function () {
        //         $('.order-description').hide();
        //     }
        // );
    </script>
</body>

</html>