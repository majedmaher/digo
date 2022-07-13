@extends('site.includes.header_footer')

@section('title', 'ديجو | للتسويق الرقمي وخدمات الويب المتكاملة')

@section('description')
شركة تسويق عالمية تعمل بجمع الأفكار التسويقية التي تبتكر أساليب ومفاهيم عصرية وتقديمها بأساليب إبداعية خارجة عن المألوف
@endsection

@section('keywords')
الهوية البصرية, التسويق الرقمي, المواقع الإلكترونية, إدارة مواقع التواصل الاجتماعي 2021, العلامة التجارية كتابة محتوى, التصميم, التصاميم , الهوية , الاتصالات التسويقية, دعاية, دعاية واعلان, اعلان, حملات تسويقية , صناعة المحتوى, التسويق الالكتروني , شركات دعاية واعلان , وكالة دعاية واعلان , مؤسسة دعاية واعلان
@endsection

@section('content')

<!-- Works content start -->
<section class="works-content">
    <div class="wrapper">
        <!-- filter Items -->
        <nav>
            <div class="items">
                <span class="item active" data-name="all">الكل</span>
                <span class="item" data-name="web-design">تصميم مواقع</span>
                <span class="item" data-name="print">طباعة</span>
                <span class="item" data-name="trademarks">علامات تجارية</span>
                <span class="item" data-name="photography">فوتوجراف</span>
            </div>
        </nav>
        <!-- filter Images -->
        <div class="gallery">
            @foreach ($works as $work)
            <a href="{{ $work->link }}" class="image" data-name="{{ $work->category }}"><span><img src="{{ URL::asset($work->photo) }}" alt="{{ $work->description }}"></span></a>
            @endforeach
        </div>
    </div>
    {{-- <!-- fullscreen img preview box -->
        <div class="preview-box">
            <div class="details">
                <span class="title">Image Category: <p></p></span>
                <span class="icon fas fa-times"></span>
            </div>
            <div class="image-box"><img src="" alt=""></div>
        </div>
        <div class="shadow"></div> --}}

</section>
<!-- Works content start -->


@endsection