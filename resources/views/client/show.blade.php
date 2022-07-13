@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card"  >
                <img src="{{URL::asset($client->photo)}}" class="card-img-top" alt="{{$client->photo}}">
                <div class="card-body">
                  <p class="card-text"> {!! $client->content !!}</p>
                <p> Created at:   {{$client->created_at->diffForhumans() }}</p>
                <p>  Updated at:    {{$client->updated_at->diffForhumans() }}</p>
                <a href="{{route('client.edit',['id'=> $client->id])}}"> <i class="fas fa-2x fa-edit"></i>  </a>&nbsp;&nbsp;
                    
    
                    </div>
              </div>
        </div>
    </div>
</div>
@endsection
