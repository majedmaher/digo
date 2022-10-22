@extends('dashboard.include')


@section('styles')
<link rel="stylesheet" href="{{asset('css/tagsinput.css')}}" />
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

      <form action="{{route('packages.update',['id'=> $package->id])}}" method="POST">
        @csrf

        <div class="form-group">

          <div class="form-group">
            <label for="exampleFormControlInput1">العنوان </label>
            <input type="text" name="title" class="form-control" value="{{$package->title}}">
          </div>

          <div class="form-group">
            <label for="exampleFormControlInput1">التفاصيل </label>
            <input type="text" class="form-control @error('description') is-invalid @enderror" name="description" value="{{$package->description}}" data-role="tagsinput" required>
          </div>

          <div class="form-group">
            <label for="exampleFormControlInput1">السعر </label>
            <input name="price" type="number" value="{{$package->price}}" step="0.01">
          </div>

          <div class="form-group">
            <label for="exampleFormControlInput1">المدة </label>
            <input name="period" value="{{$package->period}}" type="text">
          </div>

          <div class="form-group">
            <label for="exampleFormControlInput1">اختصار العملة بالعربي </label>
            <input name="currencyـname" value="{{$package->currencyـname}}" type="text">
          </div>

          <div class="form-group">
            <label for="exampleFormControlInput1">اختصار العملة المعتمد </label>
            <input name="currencyـabbreviation" value="{{$package->currencyـabbreviation}}" type="text">
          </div>

          <div class="form-group">
            <label class="switch">
              <input name="is_active" type="checkbox" {{$package->is_active == 'Active' ? 'checked' : '' }}>
              <span class="slider round"></span>
            </label>
          </div>

          <button class="btn btn-danger" type="submit">تعديل</button>
        </div>

      </form>


    </div>
  </div>
</div>

@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js" integrity="sha512-9UR1ynHntZdqHnwXKTaOm1s6V9fExqejKvg5XMawEMToW4sSw+3jtLrYfZPijvnwnnE8Uol1O9BcAskoxgec+g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endsection