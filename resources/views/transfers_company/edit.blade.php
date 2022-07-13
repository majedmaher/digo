@extends('dashboard.include')

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

      <label>الاسم {{$company->company_name}}</label>

      <form action="{{route('transfer.company.update',['id'=> $transfer->id])}}" method="POST" enctype="multipart/form-data">
        @csrf

        <input type="hidden" name="company_id" value="{{$company->id}}">
        <div class="form-group">
          <label for="exampleFormControlInput1">المبلغ </label>
          <input name="amount" type="number" step="0.01" value="{{$transfer->amount}}">
        </div>

        <div class="form-group">
          <label for="exampleFormControlInput1">الايضاحات </label>
          <input type="text" name="clarifications" class="form-control" value="{{$transfer->clarifications}}">
        </div>

        <div class="form-group d-flex">
          <label for="exampleFormControlInput1">بتاريخ </label>
          <input type="date" name="date" class="form-control" style="width: 200px!important;" value="{{$transfer->date}}">
        </div>

        <div class="form-group d-flex">
          <label for="exampleFormControlInput1">لشهر </label>
          <input type="month" name="month_due" class="form-control" style="width: 200px!important;" value="{{$transfer->month_due ? \Carbon\Carbon::parse($transfer->month_due)->format('Y-m') : ''}}">
        </div>

        <div class="form-group">
          <label for="exampleFormControlInput1">صورة الحوالة المالية </label>
          <input type="file" name="passbook" class="form-control">
        </div>

        <div class="form-group">
          <label for="exampleFormControlInput1">المطالبة المالية </label>
          <input type="file" name="financial_claim" class="form-control">
        </div>

        <div class="form-group">
          <button class="btn btn-danger" type="submit">حفظ</button>
        </div>

      </form>
    </div>
  </div>
</div>

@endsection