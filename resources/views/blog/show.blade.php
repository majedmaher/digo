@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card"  >
                <img src="{{URL::asset($blog->photo)}}" class="card-img-top" alt="{{$blog->photo}}">
                <div class="card-body">
                  <h5 class="card-title">{{$blog->title}}</h5>
                  <p class="card-text"> {!! $blog->content !!}</p>
                <p> Created at:   {{$blog->created_at->diffForhumans() }}</p>
                <p>  Updated at:    {{$blog->updated_at->diffForhumans() }}</p>
                <a href="{{route('blog.edit',['slug'=> $blog->slug])}}"> <i class="fas fa-2x fa-edit"></i>  </a>&nbsp;&nbsp;
                    
    
                    </div>
              </div>
        </div>
    </div>
</div>
@endsection
