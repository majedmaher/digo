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

      <form action="{{route('tax-invoice.company',['id'=>$company->id])}}" method="POST" class="d-flex">
        @csrf
        <label for="">من: </label>
        <input type="date" name="start_date" class="form-control" style="width: 200px!important;">
        <label for="">إلى: </label>
        <input type="date" name="end_date" class="form-control" style="width: 200px!important;">
        <button style="border: none;"><i class="fas fa-2x fa-print"></i></button>
      </form>

      <!-- <form action="{{route('pdf')}}" method="POST">
        @csrf
        <input type="hidden" name="company_id" value="{{$company->id}}">
        <input name="movements" type="number" step="1" min="0">
        <button style="border: none;"><i class="fas fa-2x fa-print"></i></button>

      </form> -->

      </br>
      </br>

      <form action="{{route('transfer.company.store')}}" method="POST" enctype="multipart/form-data">
        @csrf

        <input type="hidden" name="company_id" value="{{$company->id}}">
        <!-- <div class="form-group">
          <label for="exampleFormControlInput1">المبلغ </label>
          <input name="amount" type="number" step="0.01">
        </div>
        <br /> -->
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
        <!-- <div class="form-group d-flex">
          <label for="exampleFormControlInput1">لشهر </label>
          <input type="month" name="month_due" class="form-control" style="width: 200px!important;">
        </div>
        <br /> -->
        <div class="form-group">
          <label for="exampleFormControlInput1">صورة الحوالة المالية </label>
          <input type="file" name="passbook" class="form-control">
        </div>
        <br />

        <hr />
        <br />
        <div class="form-group">
          <label for="exampleFormControlInput1">المطالبة المالية </label>
          <div class="tax">
            <!-- <input type="date" name="date">
            <input type="hidden" name="company_id" value="{{$company->id}}"> -->
            <div class="form-group">
              <label for="exampleFormControlInput1">الوصف </label>
              <input type="text" name="description[0]">
              <label for="exampleFormControlInput1">الكمية </label>
              <input type="number" name="quantity[0]" placeholder="2">
              <label for="exampleFormControlInput1">سعر الوحدة </label>
              <input type="number" name="price[0]" step="0.1" placeholder="230.3">
              <label for="exampleFormControlInput1">نسبة الضريبة </label>
              <input type="number" name="tax_rate[0]" placeholder="15" style="margin-left: 10px;">
              <i onclick="removeItem(this)" style="color:red; cursor: pointer; font-size: 25px;" class="fa fa-solid fa-minus"></i>
            </div>
          </div>
          <br />
          <div class="add"><i class="fa fa-solid fa-plus" style="cursor: pointer; font-size:30px;"></i></div>
          <br />
        </div>

        <!-- @if ($taxes->count() > 0)
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
        <hr /> -->
        <br />

        <div class="form-group">
          <label style="vertical-align: text-top;">الحالة </label>
          <label class="switch">
            <input name="status" type="checkbox" checked>
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
            <th scope="col">حالة الدفع</th>
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
            <td>{{$transfer->status == 0 ? 'لم يتم الدفع' : 'تم الدفع'}}</td>
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

@section('scripts')
<script>
  let i = 0;
  $('.add i').click(function(e) {
    e.preventDefault();
    ++i;
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
  });

  function removeItem(input) {
    item = $(input).parent('.form-group');
    $(item).remove();
  }
</script>
@endsection