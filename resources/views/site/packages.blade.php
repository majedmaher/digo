<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="shortcut icon" type="x-icon" href="{{ URL::asset('logo.png') }}">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Packages</title>
    <link rel="stylesheet" href="{{ asset('css/packages.css') }}">

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" id="theme-styles">

</head>

<body>
    <section class="how-we-work">
        <h2 class="title">كيف نعمل</h2>
        <ul>
            <li>
                <img src="{{asset('images/idea.png')}}" alt="تقديم الطلب ">
                <h3> تقديم الطلب </h3>
                <p class="p-more"> نستمع جيداً لما يطلبه العميل و نحدد له المناسب من الخدمات و
                    التقنيات التي تساعده على النجاح في أعماله </p>
                <i></i>
            </li>
            <li>
                <img src="{{asset('images/budget.png')}}" alt="عرض السعر ">
                <h3> عرض السعر </h3>
                <p class="p-more"> نُقدم عرض السعر للخدمات التي طلبها العميل في مدة أقصاها 2 يوم
                    عمل </p>
                <i></i>
            </li>
            <li>
                <img src="{{asset('images/handshake.png')}}" alt=" توقيع العقد  ">
                <h3> توقيع العقد </h3>
                <p class="p-more"> بعد موافقة العميل ، نقوم بصياغة العقد الذي يوضح إلتزامات جميع
                    الأطراف </p>
                <i></i>
            </li>
            <li>
                <img src="{{asset('images/search.png')}}" alt="التحليل ">
                <h3> التحليل </h3>
                <p class="p-more"> نستمع جيداً لما يطلبه العميل و نحدد له المناسب من الخدمات و
                    التقنيات التي تساعده على النجاح في أعماله </p>
                <i></i>
            </li>
            <li>
                <img src="{{asset('images/power.png')}}" alt="البدء في التنفيذ">
                <h3> البدء في التنفيذ</h3>
                <p class="p-more"> يتم البدء في التنفيذ بواسطة فريق من المحترفين و بحسب خطة العمل التي
                    وضعها مدير المشروع </p>
                <i></i>
            </li>
            <li>
                <img src="{{asset('images/notepad.png')}}" alt="التسليم المبدئي">
                <h3> التسليم المبدئي</h3>
                <p class="p-more"> بعد الإنتهاء من التنفيذ يتم تسليم العمل للعميل لمراجعته و ابداء
                    الملاحظات و التعديلات التي يرغب بها إن وجدت </p>
                <i></i>
            </li>
            <li>
                <img src="{{asset('images/list.png')}}" alt="التسليم النهائي">
                <h3> التسليم النهائي</h3>
                <p class="p-more"> يتم عمل الملاحظات و التعديلات التي طلبها العميل و يتم تسليمه
                </p>
                <i></i>
            </li>
        </ul>
    </section>
    <section class="packages">
        <h2 class="header">
            باقات التسويق الرقمي
        </h2>
        <div class="packages-items">
            @foreach ($packages as $package)
            <div class="package-item">
                <h3 class="package-header">
                    {{$package->title}}
                </h3>
                <div class="package-content">
                    <ul>
                        @foreach(explode(',',$package->description) as $item)
                        <li>{{ $item }}</li>
                        @endforeach
                    </ul>
                </div>
                <div class="package-price">
                    <span class="price">{{$package->price}}</span>
                    <span class="currency">{{$package->currencyـname}}</span>
                    <span class="duration">{{$package->period}}</span>
                </div>
                <div class="book-now">
                    <a href="{{route('payments.index',['id' => $package->id])}}" rel="noopener noreferrer">احجز الآن</a>
                </div>
            </div>
            @endforeach
        </div>

        <div class="social-links">
            <a href="tel:+966567020925" target="_blank" rel="noopener noreferrer" class="phone">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                    <path d="M188.8 39.3c13.8 8.5 19.6 26.8 13.6 42.7L174.2 156c-5.3 14-18.5 22.5-32.4 21l-42.6-4.6c-17.4 54.1-17.4 113.2 0 167.3l42.6-4.6c13.9-1.5 27.1 7 32.4 21L202.4 430c6.1 15.9 .3 34.2-13.6 42.7l-56.4 34.8c-12.4 7.7-28 5.4-38.1-5.5C-31.4 366.1-31.4 145.9 94.3 10C104.4-.9 120.1-3.1 132.5 4.5l56.4 34.8zm218.4-5.5C471.2 86.6 512 166.6 512 256s-40.8 169.4-104.7 222.2c-10.2 8.4-25.3 7-33.8-3.2s-7-25.3 3.2-33.8C430.1 397.1 464 330.5 464 256s-33.9-141.1-87.3-185.2c-10.2-8.4-11.7-23.6-3.2-33.8s23.6-11.7 33.8-3.2zm-64.4 71.4C387.4 140.4 416 194.8 416 256s-28.6 115.6-73.1 150.8c-10.4 8.2-25.5 6.4-33.7-4s-6.4-25.5 4-33.7C346.6 342.7 368 301.8 368 256s-21.4-86.7-54.8-113.1c-10.4-8.2-12.2-23.3-4-33.7s23.3-12.2 33.7-4zm-65.4 71C303.1 193.5 320 222.8 320 256s-16.9 62.5-42.5 79.7c-11 7.4-25.9 4.5-33.3-6.5s-4.5-25.9 6.5-33.3c12.9-8.7 21.3-23.3 21.3-39.9s-8.4-31.2-21.3-39.9c-11-7.4-13.9-22.3-6.5-33.3s22.3-13.9 33.3-6.5z" />
                </svg>
                <span>+966 56 702 0925</span>
            </a>
            <a href="https://m.me/digoksa1" target="_blank" rel="noopener noreferrer" class="messenger">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                    <path d="M256.55 8C116.52 8 8 110.34 8 248.57c0 72.3 29.71 134.78 78.07 177.94 8.35 7.51 6.63 11.86 8.05 58.23A19.92 19.92 0 0 0 122 502.31c52.91-23.3 53.59-25.14 62.56-22.7C337.85 521.8 504 423.7 504 248.57 504 110.34 396.59 8 256.55 8zm149.24 185.13l-73 115.57a37.37 37.37 0 0 1-53.91 9.93l-58.08-43.47a15 15 0 0 0-18 0l-78.37 59.44c-10.46 7.93-24.16-4.6-17.11-15.67l73-115.57a37.36 37.36 0 0 1 53.91-9.93l58.06 43.46a15 15 0 0 0 18 0l78.41-59.38c10.44-7.98 24.14 4.54 17.09 15.62z" />
                </svg>
            </a>
            <a href="https://wa.me/+966567020925" target="_blank" rel="noopener noreferrer" class="whatsapp">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                    <path d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7.9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z" />
                </svg>
            </a>
        </div>
    </section>


    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })

        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            icon: 'success',
            showConfirmButton: false,
            timer: 6000
        })

        if (`{{session()->has('success')}}`) {
            Toast.fire({
                type: 'success',
                title: `{{session()->get('success')}}`
            })

        } else if (`{{session()->has('error')}}`) {
            const ToastError = Swal.mixin({
                toast: true,
                position: 'top-end',
                icon: 'error',
                showConfirmButton: false,
                timer: 6000
            })
            ToastError.fire({
                type: 'error',
                title: `{{session()->get('error')}}`
            })
        }
    </script>
</body>

</html>