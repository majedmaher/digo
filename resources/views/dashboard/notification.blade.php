@extends('dashboard.include')



@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">

      @if (session('success'))
      <div class="alert alert-success" role="alert">
        {{ session('success') }}
      </div>
      @endif

      @if (count($errors) > 0)
      <ul>
        @foreach ($errors->all() as $item)
        <li>
          {{$item}}
        </li>
        @endforeach
      </ul>
      @endif

      <form action="{{route('send.notification')}}" method="POST">
        @csrf
        <div class="form-group">
          <label for="exampleFormControlInput1">عنوان الإشعار </label>
          <input type="text" name="title" class="form-control">
        </div>

        <div class="form-group">
          <label for="exampleFormControlTextarea1">محتوى الإشعار </label>
          <input type="text" name="body" class="form-control">
        </div>
        <div class="form-group">

          <button class="btn btn-danger" type="submit">حفظ</button>
        </div>

      </form>


    </div>
  </div>
</div>
@endsection