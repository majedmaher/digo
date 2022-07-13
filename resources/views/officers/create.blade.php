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

      <form action="{{route('officer.store')}}" method="POST">
        @csrf

        <div class="form-group">
          <label for="exampleFormControlInput1">الاسم </label>
          <input type="text" name="name" class="form-control">
        </div>

        <div class="form-group">
          <label for="exampleFormControlInput1">رقم الهوية </label>
          <input type="number" name="id_number" class="form-control">
        </div>

        <div class="form-group">
          <label for="exampleFormControlInput1">الراتب الشهري </label>
          <input name="salary" type="number" step="0.01">
        </div>

        <div class="form-group">
          <label for="exampleFormControlInput1">عنوان السكن </label>
          <input type="text" name="address" class="form-control">
        </div>

        <div class="form-group">
          <label for="exampleFormControlInput1">البريد الالكتروني </label>
          <input type="text" name="email" class="form-control">
        </div>

        <div class="form-group">
          <label for="exampleFormControlInput1">رقم الهاتف </label>
          <input type="tel" name="phone_number" class="form-control" pattern="[0-9]{10}" placeholder="0599999999">
        </div>

        <div class="form-group">
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