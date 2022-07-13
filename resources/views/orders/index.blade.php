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
            <th scope="col">الاسم</th>
            <th scope="col">الطلب</th>
            <th scope="col">البريد الالكتروني</th>
            <th scope="col">رقم الجوال</th>
            <th scope="col">إسم الشركة</th>
            <th scope="col">التفاصيل</th>
            <th scope="col">تاريخ الطلب</th>
            <th scope="col">الاجراءات</th>
          </tr>
        </thead>
        <tbody>
          <tr>
          </tr> @foreach ($orders as $order)

          <tr>
            <th scope="row">{{++$count}}</th>
            <td>{{$order->name}}</td>
            <td>{{$order->order}}</td>
            <td>{{$order->email}}</td>
            <td>{{$order->phone_number}}</td>
            <td>{{$order->company}}</td>
            <td>{{$order->details}}</td>
            <td>{{$order->created_at->diffForhumans() }}</td>
            <td>
              <a class="text-danger" href="{{route('order.destroy',['id'=> $order->id])}}"> <i class="fas  fa-2x fa-trash-alt"></i> </a>

            </td>
          </tr>

          @endforeach
        </tbody>
      </table>


    </div>
  </div>
</div>

@endsection