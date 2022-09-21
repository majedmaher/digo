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

      <label>الاسم {{$tax->company->company_name}}</label>

      <form action="{{route('tax-invoice.update',['id'=> $tax->id])}}" method="POST">
        @csrf

        <div class="form-group">
          <label for="exampleFormControlInput1">رقم الفاتورة </label> {{$tax->invoice_no}} &nbsp; &nbsp; &nbsp;
          <label for="exampleFormControlInput1">التاريخ </label>
          <input type="date" name="date" value="{{$tax->invoice_date}}">
        </div>
        <br />

        <div class="tax">
          @foreach($tax->taxes as $value)
          <div class="form-group">
            <input type="hidden" name="id" value="{{$value->id}}">
            <label for="exampleFormControlInput1">الوصف </label> : {{$value->description}} &nbsp; &nbsp;
            <label for="exampleFormControlInput1">الكمية </label> : {{$value->quantity}} &nbsp;
            <label for="exampleFormControlInput1">سعر الوحدة </label> : {{$value->price}} &nbsp;
            <label for="exampleFormControlInput1">نسبة الضريبة </label> : {{$value->tax_rate}} &nbsp;
            <i onclick="removeItem(this)" style="color:red; cursor: pointer; font-size: 25px;" class="fa fa-solid fa-minus"></i>
          </div>
          @endforeach
        </div>
        <br />
        <div class="add"><i class="fa fa-solid fa-plus" style="cursor: pointer; font-size:30px;"></i></div>
        <br />


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