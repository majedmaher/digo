
{{-- @extends('layouts.app') --}}
@extends('dashboard.include')

@php
    $count = 0;
@endphp
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
          {{-- <div class="card-header"> 
            <h3> Works </h3>
            <a href="{{route('client.create')}}">Add Client</a>
            <a href="{{route('clients.trashed')}}">Trashed Clients</a>
          </div>
          <br> --}}
            <table class="table">
                <thead class="thead-dark">
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">صورة العميل</th>
                    <th scope="col">العميل</th>
                    <th scope="col"> التاريخ</th>
                    <th scope="col">الاجراءات</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($clients as $client)
                        
                    <tr>
                      <th scope="row">{{++$count}}</th>
                      <td><img width="150px" src="{{URL::asset($client->photo)}}" alt="{{$client->photo}}"></td>
                      <td>{!!$client->content!!}</td>
                      <td>{{$client->created_at->diffForhumans() }}</td>
                      <td>
                        <a  class="text-success" href="{{route('client.show',['id'=> $client->id])}}"> <i class="fas  fa-2x fa-eye"></i> </a>
                        {{-- @if ($item->user_id == Auth::id()) --}}
                        &nbsp;&nbsp;
                        <a href="{{route('client.edit',['id'=> $client->id])}}"> <i class="fas fa-2x fa-edit"></i>  </a>&nbsp;&nbsp;
                        <a class="text-danger" href="{{route('client.destroy',['id'=> $client->id])}}"> <i class="fas  fa-2x fa-trash-alt"></i> </a>
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