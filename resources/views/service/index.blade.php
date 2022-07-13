@extends('dashboard.include')


{{-- @extends('layouts.app') --}}

@php
    $count = 0;
@endphp
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
          {{-- <div class="card-header"> 
            <h3> Works </h3>
            <a href="{{route('service.create')}}">Add Service</a>
            <a href="{{route('services.trashed')}}">Trashed Services</a>
          </div>
          <br> --}}
            <table class="table">
                <thead class="thead-dark">
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">صورة الخدمة</th>
                    <th scope="col">عنوان الخدمة</th>
                    <th scope="col"> تاريخ الخدمة</th>
                    <th scope="col">الاجراءات</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($services as $service)
                        
                    <tr>
                      <th scope="row">{{++$count}}</th>
                      <td><img width="150px" src="{{URL::asset($service->photo)}}" alt="{{$service->photo}}"></td>
                      <td>{{$service->title}}</td>
                      <td>{{$service->created_at->diffForhumans() }}</td>
                      <td>
                        <a  class="text-success" href="{{route('service.show',['slug'=> $service->slug])}}"> <i class="fas  fa-2x fa-eye"></i> </a>
                        {{-- @if ($item->user_id == Auth::id()) --}}
                        &nbsp;&nbsp;
                        <a href="{{route('service.edit',['slug'=> $service->slug])}}"> <i class="fas fa-2x fa-edit"></i>  </a>&nbsp;&nbsp;
                        <a class="text-danger" href="{{route('service.destroy',['id'=> $service->id])}}"> <i class="fas  fa-2x fa-trash-alt"></i> </a>
                        {{-- @endif --}}

                      </td>
                    </tr>

                    @endforeach
                </tbody>
              </table>
              
              
        </div>
    </div>
</div>

@endsection