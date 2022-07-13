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
            <th scope="col">رقم الهوية</th>
            <th scope="col">الراتب</th>
            <th scope="col">عنوان السكن</th>
            <th scope="col"> البريد الالكتروني</th>
            <th scope="col">رقم الهاتف</th>
            <th scope="col">الحالة</th>
            <th scope="col">الاجراءات</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($officers as $officer)

          <tr>
            <th scope="row">{{++$count}}</th>
            <td>{{$officer->name}}</td>
            <td>{{$officer->id_number}}</td>
            <td>{{$officer->salary}}</td>
            <td>{{$officer->address}}</td>
            <td>{{$officer->email}}</td>
            <td>{{$officer->phone_number}}</td>
            <td>{{$officer->status == 1 ? 'مستمر': 'متوقف'}}</td>
            <td>
              <a class="text-success" href="{{route('officer.restore',['id'=> $officer->id])}}"> <i class="fas fa-2x fa-undo"></i> </a> &nbsp;&nbsp;
              <a class="text-danger" href="{{route('officer.hdelete',['id'=> $officer->id])}}"> <i class="fas  fa-2x fa-trash-alt"></i> </a>

            </td>
          </tr>

          @endforeach
        </tbody>
      </table>


    </div>
  </div>
</div>

@endsection