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
        <br />

        <div class="form-group">
          <label for="exampleFormControlInput1">الايضاحات </label>
          <input type="text" name="clarifications" class="form-control" value="{{$transfer->clarifications}}">
        </div>
        <br />

        <div class="form-group d-flex">
          <label for="exampleFormControlInput1">بتاريخ </label>
          <input type="date" name="date" class="form-control" style="width: 200px!important;" value="{{$transfer->date}}">
        </div>
        <br />

        <div class="form-group d-flex">
          <label for="exampleFormControlInput1">لشهر </label>
          <input type="month" name="month_due" class="form-control" style="width: 200px!important;" value="{{$transfer->month_due ? \Carbon\Carbon::parse($transfer->month_due)->format('Y-m') : ''}}">
        </div>
        <br />

        <div class="form-group">
          <label for="exampleFormControlInput1">صورة الحوالة المالية </label>
          <input type="file" name="passbook" class="form-control">
        </div>
        <br />

        <div class="form-group">
          <label for="exampleFormControlInput1">المطالبة المالية </label>
          <input type="file" name="financial_claim" class="form-control">
        </div>

        <br />
        @if ($transfer->tax)
        <div class="tax">
          <input type="hidden" name="tax_id" value="{{$transfer->tax->id}}">
          @foreach($transfer->tax->taxes as $value)
          <div class="form-group">
            <input type="hidden" name="id" value="{{$value->id}}">
            <label for="exampleFormControlInput1">الوصف </label> : {{$value->description}}
            <label for="exampleFormControlInput1">الكمية </label> : {{$value->quantity}}
            <label for="exampleFormControlInput1">سعر الوحدة </label> : {{$value->price}}
            <label for="exampleFormControlInput1">نسبة الضريبة </label> : {{$value->tax_rate}}
            <i onclick="removeItem(this)" style="color:red; cursor: pointer; font-size: 25px;" class="fa fa-solid fa-minus"></i>
          </div>
          @endforeach
        </div>
        <br />
        <div class="add"><i class="fa fa-solid fa-plus" style="cursor: pointer; font-size:30px;"></i></div>
        <br />
        @endif


        <div class="form-group">
          <button class="btn btn-danger" type="submit">حفظ</button>
        </div>

      </form>
    </div>
  </div>
</div>

@endsection


@section('scripts')
<script>
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  let i = 0;
  $('.add i').click(function(e) {
    e.preventDefault();
    $item = `<div class="form-group">
    <label for="exampleFormControlInput1">الوصف </label>
            <input type="text" name="description[${i}]">
            <label for="exampleFormControlInput1">الكمية </label>
            <input type="number" name="quantity[${i}]" placeholder="2">
            <label for="exampleFormControlInput1">سعر الوحدة </label>
            <input type="number" name="price[${i}]" step="0.1" placeholder="230.3">
            <label for="exampleFormControlInput1">نسبة الضريبة </label>
            <input type="number" name="tax_rate[${i}]" placeholder="15" style="margin-left: 10px;">
            <i onclick="removeItem(this)" style="color:red; cursor: pointer; font-size: 25px;" class="fa fa-solid fa-minus"></i>
          </div>`;
    $('.tax').append($item);
    i++;
  });

  function removeItem(input) {
    let item = $(input).parent('.form-group');
    let id = $(item).find('input[name="id"]').val();
    $.ajax({
      type: "POST",
      dataType: 'json',
      data: {
        id: id,
        _token: '{{csrf_token()}}'
      },
      url: `{{route('tax-invoice.delete')}}`,
      success: function(data) {
        $(item).remove();
      }
    });
  }
</script>
@endsection