@extends('dashboard.include')

@php
$count = 0;
@endphp
@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">

      @if (count($errors) > 0)
      <ul>
        @foreach ($errors->all() as $item)
        <li>
          {{$item}}
        </li>
        @endforeach
      </ul>
      @endif
      <label>اسم الشركة : {{$company->company_name}}</label>

      <form action="{{route('pdf')}}" method="POST">
        @csrf
        <input type="hidden" name="company_id" value="{{$company->id}}">
        <input name="movements" type="number" step="1" min="0">
        <button style="border: none;"><i class="fas fa-2x fa-print"></i></button>

      </form>

      </br>
      </br>

      <form action="{{route('transfer.company.store')}}" method="POST" enctype="multipart/form-data">
        @csrf

        <input type="hidden" name="company_id" value="{{$company->id}}">
        <div class="form-group">
          <label for="exampleFormControlInput1">المبلغ </label>
          <input name="amount" type="number" step="0.01">
        </div>
        <br />
        <div class="form-group">
          <label for="exampleFormControlInput1">الايضاحات </label>
          <input type="text" name="clarifications" class="form-control">
        </div>
        <br />
        <div class="form-group d-flex">
          <label for="exampleFormControlInput1">بتاريخ </label>
          <input type="date" name="date" class="form-control" style="width: 200px!important;">
        </div>
        <br />
        <div class="form-group d-flex">
          <label for="exampleFormControlInput1">لشهر </label>
          <input type="month" name="month_due" class="form-control" style="width: 200px!important;">
        </div>
        <br />
        <div class="form-group">
          <label for="exampleFormControlInput1">صورة الحوالة المالية </label>
          <input type="file" name="passbook" class="form-control">
        </div>
        <br />

        <hr />
        <br />
        <div class="form-group">
          <label for="exampleFormControlInput1">المطالبة المالية </label>
          <input type="file" name="financial_claim" class="form-control">
        </div>

        @if ($taxes->count() > 0)
        <br />
        -------OR-------
        <br />

        <div class="tax">
          <div class="form-group">
            <label for="exampleFormControlInput1"> اختر المطالبة المالية </label>
            <select name="tax_id">
              @foreach ($taxes as $tax)
              <option value="{{$tax->id}}">{{$tax->invoice_date}}</option>
              @endforeach
            </select>
          </div>
        </div>

        @endif
        <br />
        <hr />
        <br />

        <div class="form-group">
          <button class="btn btn-danger" type="submit">حفظ</button>
        </div>

      </form>


    </div>
  </div>


  <div class="row justify-content-center">
    <div class="col-md-12">
      <table class="table">
        <thead class="thead-dark">
          <tr>
            <th scope="col">#</th>
            <th scope="col">المبلغ</th>
            <th scope="col">الايضاحات</th>
            <th scope="col">التاريخ</th>
            <th scope="col">الحوالة المالية</th>
            <th scope="col">المطالبة المالية</th>
            <th scope="col">الاجراءات</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($transfers as $transfer)

          <tr>
            <th scope="row">{{++$count}}</th>
            <td>{{$transfer->amount}}</td>
            <td>{{$transfer->clarifications}}</td>
            <td>{{$transfer->date}}</td>
            <td>
              @if ($transfer->passbook)
              <a href="{{ URL::asset($transfer->passbook) }}" target="_blank">انقر هنا</a>
              @endif
            </td>
            <td>
              @if ($transfer->tax)
              <a href="{{ route('tax-invoice',['id'=>$transfer->tax->id]) }}" target="_blank">انقر هنا</a>
              @elseif ($transfer->financial_claim)
              <a href="{{ URL::asset($transfer->financial_claim) }}" target="_blank">انقر هنا</a>
              @endif
            </td>
            <td>

              <a href="{{route('transfer.company.edit',['id'=> $transfer->id])}}"> <i class="fas fa-2x fa-edit"></i> </a>&nbsp;&nbsp;
              <a class="text-danger" href="{{route('transfer.company.destroy',['id'=> $transfer->id])}}"> <i class="fas  fa-2x fa-trash-alt"></i> </a>&nbsp;&nbsp;

            </td>
          </tr>

          @endforeach


        </tbody>
      </table>



    </div>
  </div>
</div>

@endsection