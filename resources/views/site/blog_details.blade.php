@extends('site.includes.blog')

@section('title')
{{ $blog->title }}
@endsection

@section('description')
{{ $blog->description }}
@endsection

@section('keywords')
{{ $blog->keywords }}
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">

                <img class="card-img-top img-height" src="{{ URL::asset($blog->photo) }}" alt="{{ $blog->title }}" />
                <div class="card-body">
                    <h1 class="card-title">{{ $blog->title }}</h1>
                    <p class="max-lines">
                        <!--{!! strip_tags($blog->content) !!}-->
                        {!!html_entity_decode($blog->content)!!}
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $('html, body').animate({
            scrollTop: $(window).height()
        }, 200);
    });
</script>
@endsection