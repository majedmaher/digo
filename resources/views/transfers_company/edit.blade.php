@extends('dashboard.include')

@section('styles')
<style>
  .switch {
    position: relative;
    display: inline-block;
    width: 60px;
    height: 34px;
  }

  .switch input {
    opacity: 0;
    width: 0;
    height: 0;
  }

  .slider {
    position: absolute;
    cursor: pointer;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: #ccc;
    -webkit-transition: .4s;
    transition: .4s;
  }

  .slider:before {
    position: absolute;
    content: "";
    height: 26px;
    width: 26px;
    left: 4px;
    bottom: 4px;
    background-color: white;
    -webkit-transition: .4s;
    transition: .4s;
  }

  input:checked+.slider {
    background-color: #2196F3;
  }

  input:focus+.slider {
    box-shadow: 0 0 1px #2196F3;
  }

  input:checked+.slider:before {
    -webkit-transform: translateX(26px);
    -ms-transform: translateX(26px);
    transform: translateX(26px);
  }

  /* Rounded sliders */
  .slider.round {
    border-radius: 34px;
  }

  .slider.round:before {
    border-radius: 50%;
  }
</style>
@endsection

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
          <label for="exampleFormControlInput1">الايضاحات </label>
          <input type="text" name="clarifications" class="form-control" value="{{$transfer->clarifications}}">
        </div>
        <br />

        <div class="form-group d-flex">
          <label for="exampleFormControlInput1">بتاريخ </label>
          <input type="date" name="date" class="form-control" style="width: 200px!important;" value="{{$transfer->date}}">
        </div>
        <br />

        <div class="form-group">
          <label for="exampleFormControlInput1">صورة الحوالة المالية </label>
          <input type="file" name="passbook" class="form-control">
        </div>
        <br />

        <hr />

        <div class="form-group">
          <label for="exampleFormControlInput1">المطالبة المالية </label>
        </div>

        @if ($transfer->tax)
        <div class="tax">
          <input type="hidden" name="tax_id" value="{{$transfer->tax->id}}">
          @foreach($transfer->tax->taxes as $value)
          <div class="form-group">
            <input type="hidden" name="id" value="{{$value->id}}">
            <label for="exampleFormControlInput1">الوصف </label> : <input type="text" name="description_update" value="{{$value->description}}">
            <label for="exampleFormControlInput1">الكمية </label> : <input type="number" name="quantity_update" value="{{$value->quantity}}">
            <label for="exampleFormControlInput1">سعر الوحدة </label> : <input type="number" name="price_update" value="{{$value->price}}">
            <label for="exampleFormControlInput1">نسبة الضريبة </label> : <input type="number" name="tax_rate_update" value="{{$value->tax_rate}}">
            <i onclick="updateItem(this)" style="color:blue; cursor: pointer; font-size: 20px; vertical-align: sub;" class="fa fa-pen"></i>
            <i onclick="removeItem(this)" style="color:red; cursor: pointer; font-size: 25px; vertical-align: sub;" class="fa fa-solid fa-minus"></i>
          </div>
          @endforeach

        </div>
        <br />
        <div class="add"><i class="fa fa-solid fa-plus" style="cursor: pointer; font-size:30px;"></i></div>
        <br />
        @endif

        <div class="form-group">
          <label style="vertical-align: text-top;">الحالة </label>
          <label class="switch">
            <input name="status" type="checkbox" {{$transfer->status == 1 ? 'checked' : ''}}>
            <span class="slider round"></span>
          </label>
        </div>

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

  function remove(input) {
    item = $(input).parent('.form-group');
    $(item).remove();
  }

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


  function updateItem(input) {
    let item = $(input).parent('.form-group');
    let id = $(item).find('input[name="id"]').val();
    let description = $(item).find('input[name="description_update"]').val();
    let quantity = $(item).find('input[name="quantity_update"]').val();
    let price = $(item).find('input[name="price_update"]').val();
    let tax_rate = $(item).find('input[name="tax_rate_update"]').val();
    $.ajax({
      type: "POST",
      dataType: 'json',
      data: {
        id: id,
        description: description,
        quantity: quantity,
        price: price,
        tax_rate: tax_rate,
        _token: '{{csrf_token()}}'
      },
      url: `{{route('tax.item.update')}}`,
      success: function(data) {
        alert('item updated successfully');
      }
    });
  }
</script>
@endsection