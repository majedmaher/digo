@extends('dashboard.include')

@php
$count = 0;
@endphp
@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">

      <table class="table" style="font-size: small;">
        <thead class="thead-dark">
          <tr>
            <th scope="col">#</th>
            <th scope="col">اسم الشركة</th>
            <th scope="col">اسم مسؤول الشركة</th>
            <th scope="col">رقم السجل التجاري</th>
            <th scope="col">عقد الشركة</th>
            <th scope="col">عنوان الشركة</th>
            <th scope="col">بداية العقد </th>
            <th scope="col">نهاية العقد</th>
            <th scope="col">الحالة</th>
            <th scope="col">الاجراءات</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($companys as $company)

          <tr>
            <th scope="row">{{++$count}}</th>
            <td>{{$company->company_name}}</td>
            <td>{{$company->companyـofficial_name}}</td>
            <td>{{$company->commercial_registration_no}}</td>
            <td>@if (isset($company->companyـcontract))
              <a href="{{URL::asset($company->companyـcontract)}}" target="_blank"> انقر هنا </a>
              @endif
            </td>
            <td>{{$company->address}}</td>
            <td>{{$company->start_decade}}</td>
            <td>{{$company->end_decade}}</td>
            <td>{{$company->status == 1 ? 'مستمر': 'متوقف'}}</td>
            <td>
              <a class="text-success" href="{{route('company.restore',['id'=> $company->id])}}"> <i class="fas fa-undo"></i> </a> &nbsp;&nbsp;
              <a class="text-danger" href="{{route('company.hdelete',['id'=> $company->id])}}"> <i class="fas fa-trash-alt"></i> </a>

            </td>
          </tr>

          @endforeach
        </tbody>
      </table>


    </div>
  </div>
</div>

@endsection