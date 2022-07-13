<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="shortcut icon" type="x-icon" href="{{ URL::asset('logo.png') }}">
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="ديجيتال اون جو شركة تعمل على جمع الأفكار التسويقية التي تبتكر أساليب ومفاهيم عصرية وتقديمها بطرق إبداعية خارجة عن المألوف">
    <meta name="keywords" content="الهوية البصرية, التسويق الرقمي, المواقع الإلكترونية, إدارة مواقع التواصل الاجتماعي 2021, العلامة التجارية كتابة محتوى, التصميم, التصاميم , الهوية , الاتصالات التسويقية, دعاية, دعاية واعلان, اعلان, حملات تسويقية , صناعة المحتوى, التسويق الالكتروني , شركات دعاية واعلان , وكالة دعاية واعلان , مؤسسة دعاية واعلان">
    <title>اطلب خدمتك</title>
    <link rel="stylesheet" href="{{ asset('css/loader.css')}}">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/order.css') }}">
</head>

<body>
    <div class="loader-wrapper">
        <span class="loader"><span class="loader-inner"></span></span>
    </div>
    <div class="page">
        <section class="order-section">
            <div class="order-header">
                <h2 class="order-title">لنبدأ في بناء مشروعكم</h2>
                <p class="order-description">ضع تفاصيل طلبكم، سنراجعها ونجري تواصلنا معكم سريعاً</p>
            </div>

            <form class="order-form" action="{{ route('order.store') }}" method="POST">
                @csrf
                <!-- <p class="header-section">
                <span class="number">1</span>
                بيانات الاتصال
            </p> -->
                <div class="input-form right-input">
                    <label for="">الاسم الشخصي</label>
                    <input class="name" name="name" type="text" require>
                    <input name="order" type="text" hidden value="{{ $order }}">
                </div>
                <div class="input-form left-input">
                    <label for="">البريد الإلكتروني</label>
                    <input class="email" name="email" type="text" require>
                </div>
                <div class="input-form right-input">
                    <label for="">رقم الهاتف</label>
                    <input class="" name="phone_number" type="phone" require>
                </div>
                <div class="input-form left-input">
                    <label for="">المؤسسة / المنظمة / الفريق</label>
                    <input class="" name="company" type="text" require>
                </div>
                <div class="input-form  textarea">
                    <label for="">تفاصيل المشروع</label>
                    <textarea name="details"> </textarea>
                </div>

                <div class="submit">
                    <button type="submit">أرسل طلبك</button>

                </div>
                <!-- <p class="header-section">
                <span class="number">2</span>
                ما الذي تحتاجه
            </p>

            <div class="order">
                <img src="{{ asset('images/app_design_hover.svg') }}" alt="">
                <div class="order-title">
                    تطوير تطبيق موبايل
                </div>
            </div>

            <div class="order">
                <img src="{{ asset('images/web_design_hover.svg') }}" alt="">
                <div class="order-title">
                    تصميم صفحات إنترنت
                </div>
            </div>

            <div class="order">
                <img src="{{ asset('images/development_hover.svg') }}" alt="">
                <div class="order-title">
                    برمجة و تطوير
                </div>
            </div>

            <div class="order">
                <img src="{{ asset('images/branding_hover.svg') }}" alt="">
                <div class="order-title">
                    هوية بصرية
                </div>
            </div>

            <div class="order">
                <img src="{{ asset('images/graphic_design_hover.svg') }}" alt="">
                <div class="order-title">
                    أعمال التصميم الجرافيكي
                </div>
            </div>

            <div class="order">
                <img src="{{ asset('images/motion_graphics_hover.svg') }}" alt="">
                <div class="order-title">
                    إنتاج فيديو
                </div>
            </div>

            <div class="order">
                <img src="{{ asset('images/digital_marketing_hover.svg') }}" alt="">
                <div class="order-title">
                    التسويق الرقمي
                </div>
            </div>

            <div class="order">
                <img src="{{ asset('images/hosting_hover.svg') }}" alt="">
                <div class="order-title">
                    استضافة موقع
                </div>
            </div> -->

            </form>
        </section>
    </div>

    <script>
        $(window).on("load", function() {
            $(".loader-wrapper").fadeOut("slow");
            $(".page").css("display", "block");
        });
    </script>

    <script>
        $('input[name="name"]').blur(function() {
            if ($.trim($('input[name="name"]').val()) == '') {
                $('input[name="name"]').css('border', '3px solid red');
            } else {
                $('input[name="name"]').css('border', '1px solid black');
            }

        });

        $('input[name="phone_number"]').blur(function() {
            if ($.trim($('input[name="phone_number"]').val()) == '') {
                $('input[name="phone_number"]').css('border', '3px solid red');
            } else {
                $('input[name="phone_number"]').css('border', '1px solid black');
            }

        });


        $('.submit button').click(function(e) {

            if ($.trim($('input[name="name"]').val()) == '') {
                e.preventDefault();
                // alert($("input[name = 'name']").val());
                // alert("Not a valid Number");
                $('input[name="name"]').css('border', '3px solid red');
            } else {
                $(this).unbind(e);
                $('input[name="name"]').css('border', '1px solid black');
            }

            if ($.trim($('input[name="phone_number"]').val()) == '') {
                e.preventDefault();
                // alert("Not a valid Number");
                $('input[name="phone_number"]').css('border', '3px solid red');
            } else {
                $(this).unbind(e);
                $('input[name="phone_number"]').css('border', '1px solid black');
            }
        });
    </script>

</body>

</html>