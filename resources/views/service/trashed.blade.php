
@extends('layouts.app')

@php
    $count = 0;
@endphp
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <table class="table">
                <thead class="thead-dark">
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Images</th>
                    <th scope="col">Title</th>
                    <th scope="col"> Date</th>
                    <th scope="col">Actions</th>
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
                        <a  class="text-success" href="{{route('service.restore',['id'=> $service->id])}}"> <i class="fas fa-2x fa-undo"></i> </a> &nbsp;&nbsp;
                        <a class="text-danger" href="{{route('service.hdelete',['id'=> $service->id])}}"> <i class="fas  fa-2x fa-trash-alt"></i> </a>

                      </td>
                    </tr>

                    @endforeach
                </tbody>
              </table>
              
              
        </div>
    </div>
</div>

@endsection