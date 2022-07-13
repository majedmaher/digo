@extends('site.includes.blog')

@section('title', 'المدونة')

@section('description')
ديجيتال اون جو شركة تعمل على جمع الأفكار التسويقية التي تبتكر أساليب ومفاهيم عصرية وتقديمها بطرق إبداعية خارجة عن المألوف
@endsection

@section('keywords')
الهوية البصرية, التسويق الرقمي, المواقع الإلكترونية, إدارة مواقع التواصل الاجتماعي 2021, العلامة التجارية كتابة محتوى, التصميم, التصاميم , الهوية , الاتصالات التسويقية, دعاية, دعاية واعلان, اعلان, حملات تسويقية , صناعة المحتوى, التسويق الالكتروني , شركات دعاية واعلان , وكالة دعاية واعلان , مؤسسة دعاية واعلان
@endsection

@section('content')


<!-- Blog Content Start -->
<section id="blog-content" class="blog-content">

    <div class="container">
        <div class="row">
            @foreach ($blogs as $blog)
            <div class="col-md-6 col-12">
                <div class="card">

                    <img src="{{ URL::asset($blog->photo) }}" class="card-img-top" alt="{{ $blog->title }}" />
                    <div class="card-body">
                        <h1 class="card-title">{{ $blog->title }}</h1>
                        <p class="max-lines">
                            {!! strip_tags($blog->content) !!}
                        </p>
                        <a href="{{ route('blog.details', ['slug' => $blog->slug]) }}" class="btn btn-warning">عرض
                            التفاصيل</a>
                    </div>
                </div>
            </div>
            @endforeach


            <!-- </div> -->
        </div>

    </div>
    <nav aria-label="Page navigation example">
        <ul class="pagination">
            @if ($pageNumber > 1)

            <li class="page-item">
                <a class="page-link" href="{{ route('blog', ['pageNumber' => $pageNumber - 1]) }}" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                    <span class="sr-only">Previous</span>
                </a>
            </li>

            @endif
            @for ($i = 0; $i < $count; $i++) <li class="page-item"><a class="page-link" href="{{ route('blog', ['pageNumber' => $i + 1]) }}">{{ $i + 1 }}</a></li>
                @endfor
                @if ($count > $pageNumber)

                <li class="page-item">
                    <a class="page-link" href="{{ route('blog', ['pageNumber' => $pageNumber + 1]) }}" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                        <span class="sr-only">Next</span>
                    </a>
                </li>

                @endif
        </ul>
    </nav>
</section>
<!-- Blog Content End -->






@endsection