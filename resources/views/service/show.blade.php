{{-- @extends('layouts.app') --}}
@extends('dashboard.include')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card"  >
                <img src="{{URL::asset($service->photo)}}" class="card-img-top" alt="{{$service->photo}}">
                <div class="card-body">
                  <h5 class="card-title">{{$service->title}}</h5>
                  <p class="card-text"> {!! $service->content !!}</p>
                <p> Created at:   {{$service->created_at->diffForhumans() }}</p>
                <p>  Updated at:    {{$service->updated_at->diffForhumans() }}</p>
                <a href="{{route('service.edit',['slug'=> $service->slug])}}"> <i class="fas fa-2x fa-edit"></i>  </a>&nbsp;&nbsp;
                    
    
                    </div>
              </div>
        </div>
    </div>
</div>
@endsection
