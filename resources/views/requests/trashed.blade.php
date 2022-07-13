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
            <th scope="col">البريد الالكتروني</th>
            <th scope="col">رقم الجوال</th>
            <th scope="col">عنوان السكن</th>
            <th scope="col">عنوان الوظيفة</th>
            <th scope="col">رابط العمل</th>
            <th scope="col">تاريخ الطلب</th>
            <th scope="col">الاجراءات</th>
          </tr>
        </thead>
        <tbody>
          <tr>
          </tr> @foreach ($requests as $request)

          <tr>
            <th scope="row">{{++$count}}</th>
            <td>{{$request->name}}</td>
            <td>{{$request->email}}</td>
            <td>{{$request->phone_number}}</td>
            <td>{{$request->homeـadress}}</td>
            <td>{{$request->job_title}}</td>
            <td>{{$request->businessـlink}}</td>
            <td>{{$request->created_at->diffForhumans() }}</td>
            <td>
              <a class="text-danger" href="{{route('job.request.destroy',['id'=> $request->id])}}"> <i class="fas  fa-2x fa-trash-alt"></i> </a>

            </td>
          </tr>

          @endforeach
        </tbody>
      </table>


    </div>
  </div>
</div>

@endsection