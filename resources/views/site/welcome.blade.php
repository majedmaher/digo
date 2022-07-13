<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="ديجيتال اون جو شركة تعمل على جمع الأفكار التسويقية التي تبتكر أساليب ومفاهيم عصرية وتقديمها بطرق إبداعية خارجة عن المألوف">
    <meta name="keywords" content="الهوية البصرية, التسويق الرقمي, المواقع الإلكترونية, إدارة مواقع التواصل الاجتماعي 2021, العلامة التجارية كتابة محتوى, التصميم, التصاميم , الهوية , الاتصالات التسويقية, دعاية, دعاية واعلان, اعلان, حملات تسويقية , صناعة المحتوى, التسويق الالكتروني , شركات دعاية واعلان , وكالة دعاية واعلان , مؤسسة دعاية واعلان">

    <link rel="shortcut icon" type="x-icon" href="{{ URL::asset('logo.png') }}">
    <link rel="stylesheet" href="{{ asset('css/loader.css')}}">
    <link rel="stylesheet" href="{{ asset('css/welcome.css')}}">
    <title>ديجو لخدمات التسويق الرقمي</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
</head>

<body>

    <div class="loader-wrapper">
        <span class="loader"><span class="loader-inner"></span></span>
    </div>


    <div class="welcome-content">
        <div class="background">
            <div class="background-1"></div>
            <div class="background-2"></div>
            <div class="background-3"></div>
            <div class="background-4"></div>
        </div>
        <div class="logo">
            <img src="{{asset('images/logo-digo.png')}}" alt="">
        </div>
        <div class="content">
            <h2>
                <span class="color-span">نحن نقود</span> <span class="normal-span">المستقبل الرقمي ونحب انشاء</span>
                <br>
                <span class="normal-span"> المشروعات المميزة والفريدة</span> <span class="color-span">وأكثر!</span>
            </h2>
        </div>
        <br>
        <div class="buttons">
            <a href="{{route('main')}}" target="_blank">ابدأ الآن</a>
            <a href="{{route('orders')}}" target="_blank">أطلب الآن</a>
            <a href="{{ URL::asset('uploads/profile-company.pdf') }}" download="بروفايل الشركة">تحميل البروفايل</a>
        </div>
    </div>

    <script>
        $(window).on("load", function() {
            $(".loader-wrapper").fadeOut("slow");
            $(".welcome-content").addClass("active");
        });
    </script>
</body>

</html>