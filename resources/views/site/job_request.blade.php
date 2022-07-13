@extends('site.includes.header_footer')

@section('title', 'تقدم لوظيفتك')

@section('description')
ديجيتال اون جو شركة تعمل على جمع الأفكار التسويقية التي تبتكر أساليب ومفاهيم عصرية وتقديمها بطرق إبداعية خارجة عن المألوف
@endsection

@section('keywords')
الهوية البصرية, التسويق الرقمي, المواقع الإلكترونية, إدارة مواقع التواصل الاجتماعي 2021, العلامة التجارية كتابة محتوى, التصميم, التصاميم , الهوية , الاتصالات التسويقية, دعاية, دعاية واعلان, اعلان, حملات تسويقية , صناعة المحتوى, التسويق الالكتروني , شركات دعاية واعلان , وكالة دعاية واعلان , مؤسسة دعاية واعلان
@endsection

@section('content')

<section id="job-request" class="job-request">

    <div class="container">
        <div class="row">
            <!-- <div class="form-job-request"> -->
            <div class="col-md-5">
                <img src="{{ asset('images/form-footer.png') }}" alt="">
            </div>

            <div class="col-md-6">
                <form action="{{ route('job.request.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="text" name="name" class="check" placeholder="إسمك">
                    <input type="email" name="email" class="check" placeholder="البريد الإلكتروني">
                    <input type="phone" name="phone_number" class="check" placeholder="رقم الجوال">
                    <input type="text" name="homeـadress" placeholder="عنوان السكن">
                    <input type="text" name="job_title" placeholder="عنوان الوظيفة">
                    <input type="text" name="businessـlink" placeholder="رابط العمل">
                    <span>السيرة الذاتية <input type="file" name="pdf_file" accept="application/pdf"></span>
                    <button type="submit">أرسل طلبك</button>

                </form>
                <!-- </div> -->
            </div>
        </div>
    </div>

</section>
@endsection

@section('scripts')
<script>
    $('.check').blur(function() {
        if ($.trim($(this).val()) == '') {
            $(this).css('border', '3px solid red');
        } else {
            $(this).css('border', '1px solid black');
        }

    });


    $('button').click(function(e) {

        if ($.trim($('input[name="email"]').val()) == '') {
            e.preventDefault();
            // alert("Not a valid Number");
            $('input[name="email"]').css('border', '3px solid red');
        } else {
            $(this).unbind(e);
            $('input[name="email"]').css('border', '1px solid black');
        }

        if ($.trim($('input[name="name"]').val()) == '') {
            e.preventDefault();
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

        if ($.trim($('input[name="pdf_file"]').val()) == '') {
            e.preventDefault();
            // alert("Not a valid Number");
            $('input[name="pdf_file"]').css('border', '3px solid red');
        } else {
            $(this).unbind(e);
            $('input[name="pdf_file"]').css('border', '1px solid black');
        }

    });
</script>
@endsection