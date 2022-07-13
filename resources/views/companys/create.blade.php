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

      <form action="{{route('company.store')}}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
          <label for="exampleFormControlInput1">اسم الشركة </label>
          <input type="text" name="company_name" class="form-control">
        </div>

        <div class="form-group">
          <label for="exampleFormControlInput1">اسم مسؤول الشركة </label>
          <input type="text" name="companyـofficial_name" class="form-control">
        </div>

        <div class="form-group">
          <label for="exampleFormControlInput1">رقم السجل التجاري </label>
          <input type="text" name="commercial_registration_no" class="form-control">
        </div>

        <div class="form-group">
          <label for="exampleFormControlInput1">عقد الشركة </label>
          <input type="file" name="companyـcontract" class="form-control">
        </div>

        <div class="form-group">
          <label for="exampleFormControlInput1">عنوان الشركة </label>
          <input type="text" name="address" class="form-control">
        </div>

        <div class="form-group d-flex">
          <label for="exampleFormControlInput1">بداية العقد </label>
          <input type="date" name="start_decade" class="form-control" style="width: 200px!important;">
        </div>

        <div class="form-group d-flex">
          <label for="exampleFormControlInput1">نهاية العقد </label>
          <input type="date" name="end_decade" class="form-control" style="width: 200px!important;">
        </div>

        <label for="exampleFormControlInput1">القسم </label>
        <div class="form-group d-flex">
          @foreach ($sections as $section)
          <input type="checkbox" name="sections[]" value="{{$section->id}}" style="margin: 5px;">
          <label for="">{{$section->name}}</label>
          @endforeach
        </div>

        <div class=" form-group">
          <label class="switch">
            <input name="status" type="checkbox" checked>
            <span class="slider round"></span>
          </label>
        </div>

        <div class="form-group">
          <button class="btn btn-danger" type="submit">حفظ</button>
        </div>

      </form>


    </div>
  </div>
</div>

@endsection