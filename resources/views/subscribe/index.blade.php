
{{-- @extends('layouts.app') --}}
@extends('dashboard.include')

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
                    <th scope="col">اسم المشترك</th>
                    <th scope="col">العنوان البريدي للمشترك</th>
                    <th scope="col">تاريخ الاشتراك</th>
                    <th scope="col">الاجراءات</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                  </tr> @foreach ($subscribes as $subscribe)
                        
                    <tr>
                      <th scope="row">{{++$count}}</th>
                      <td>{{$subscribe->name}}</td>
                      <td>{{$subscribe->email}}</td>
                      <td>{{$subscribe->created_at->diffForhumans() }}</td>
                      <td>
                        <a class="text-danger" href="{{route('subscribe.destroy',['id'=> $subscribe->id])}}"> <i class="fas  fa-2x fa-trash-alt"></i> </a>

                      </td>
                    </tr>

                    @endforeach
                </tbody>
              </table>
              
              
        </div>
    </div>
</div>

@endsection