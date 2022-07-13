<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="x-icon" href="{{ URL::asset('logo.png') }}">

    <meta name="csrf-token" content="{{ csrf_token() }}">


    <title>ديجو | للتسويق الرقمي وخدمات الويب المتكاملة</title>
    <meta name="description" content="شركة تسويق عالمية تعمل بجمع الأفكار التسويقية التي تبتكر أساليب ومفاهيم عصرية وتقديمها بأساليب إبداعية خارجة عن المألوف">
    <meta name="keywords" content="الهوية البصرية, التسويق الرقمي, المواقع الإلكترونية, إدارة مواقع التواصل الاجتماعي 2021, العلامة التجارية كتابة محتوى, التصميم, التصاميم , الهوية , الاتصالات التسويقية, دعاية, دعاية واعلان, اعلان, حملات تسويقية , صناعة المحتوى, التسويق الالكتروني , شركات دعاية واعلان , وكالة دعاية واعلان , مؤسسة دعاية واعلان">
    <link rel="stylesheet" href="{{asset('css/works.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

</head>

<body>

    <section class="works-window">

        <div id="works">

            @foreach ($works as $work)

            <div class="work-item" style="background-image: url('{{URL::asset($work->photo)}}');">
                <span class="work-title">{{$work->description}}</span>
                <div class="links">
                    @if ($work->link)
                    <a href="{{ $work->link }}" target="_blank"><i class="fa-solid fa-globe"></i></a>
                    @endif
                    @if ($work->behance)
                    <a href="{{ $work->behance }}" target="_blank"><i class="fa-brands fa-behance-square"></i></a>
                    @endif
                </div>

            </div>

            @endforeach

        </div>
        <div data-page="{{$pageNumber}}" class="next absolute">
            <i class="fa-solid fa-circle-chevron-left"></i>
        </div>
        <div class="previous absolute">
            <i class="fa-solid fa-circle-chevron-right"></i>
        </div>
    </section>

    <script>
        @if($pageNumber <= '1')
        $('.previous').css('display', 'none');
        @endif

        @if($pageNumber >= $count)
        $('.next').css('display', 'none');
        @endif
    </script>

    <script>
        $('.next').click(function(e) {
            e.preventDefault();
            currentPage = parseInt($(this).attr('data-page')) + 1;
            $.ajax("/works/" + currentPage, {
                type: 'GET', // http method
                dataType: 'json',
                success: function(data) {
                    var rows = ""
                    $('#works').empty();
                    $.each(data.works, function(key, value) {
                        rows += `<div class="work-item" style="background-image: url('${value.photo}');">
                                <span class="work-title">${value.description}</span>
                                <div class="links">
                                ${value.link?
                                    `<a href="${value.link }" target="_blank"><i class="fa-solid fa-globe"></i></a>`
                                    : ``
                                }
                                ${value.behance?
                                    `<a href="${value.behance }" target="_blank"><i class="fa-brands fa-behance-square"></i></a>`
                                    : ``
                                }
                                </div>
                                </div>`
                    });

                    $('#works').html(rows);
                    if (data.pageNumber <= '1') {
                        $('.previous').css('display', 'none');
                    } else {
                        $('.previous').css('display', 'block');
                    }

                    if (data.pageNumber >= data.count) {
                        $('.next').css('display', 'none');
                    } else {
                        $('.next').css('display', 'block');
                    }
                    $('.absolute').attr('data-page', currentPage);

                }
            });
        });

        $('.previous').click(function(e) {
            e.preventDefault();
            currentPage = parseInt($(this).attr('data-page')) - 1;
            $.ajax("/works/" + currentPage, {
                type: 'GET', // http method
                dataType: 'json',
                success: function(data) {
                    var rows = ""
                    $('#works').empty();
                    $.each(data.works, function(key, value) {
                        rows += `<div class="work-item" style="background-image: url('${value.photo}');">
                                <span class="work-title">${value.description}</span>
                                <div class="links">
                                ${value.link?
                                    `<a href="${value.link }" target="_blank"><i class="fa-solid fa-globe"></i></a>`
                                    : ``
                                }
                                ${value.behance?
                                    `<a href="${value.behance }" target="_blank"><i class="fa-brands fa-behance-square"></i></a>`
                                    : ``
                                }
                                </div>
                                </div>`
                    });


                    $('#works').html(rows);

                    if (data.pageNumber <= '1') {
                        $('.previous').css('display', 'none');
                    } else {
                        $('.previous').css('display', 'block');
                    }

                    if (data.pageNumber >= data.count) {
                        $('.next').css('display', 'none');
                    } else {
                        $('.next').css('display', 'block');
                    }
                    $('.absolute').attr('data-page', currentPage);
                }
            });
        });
    </script>

</body>

</html>