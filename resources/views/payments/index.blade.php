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
                        <th scope="col">الباقة</th>
                        <th scope="col">سعر الباقة</th>
                        <th scope="col">البريد الالكتروني</th>
                        <th scope="col">رقم الهاتف</th>
                        <th scope="col">الاجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($payments as $payment)

                    <tr>
                        <th scope="row">{{++$count}}</th>
                        <td>{{$payment->first_name}} {{$payment->last_name}}</td>
                        <td>{{$payment->package->title}}</td>
                        <td>{{$payment->package->price}}</td>
                        <td>{{$payment->email}}</td>
                        <td>{{$payment->phone_number}}</td>
                        <td>

                            <a href="{{route('payments.show',['id'=> $payment->id])}}"> <i class="fas fa-2x fa-eye"></i> </a>

                        </td>
                    </tr>

                    @endforeach
                </tbody>
            </table>


        </div>
    </div>
</div>

@endsection