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


      <form action="{{route('section.update',['id'=> $section->id])}}" method="POST">
        @csrf

        <div class="form-group">
          <label for="exampleFormControlInput1">المبلغ </label>
          <input name="name" type="text" value="{{$section->name}}">
        </div>

        <div class="form-group">
          <button class="btn btn-danger" type="submit">حفظ</button>
        </div>

      </form>
    </div>
  </div>
</div>

@endsection