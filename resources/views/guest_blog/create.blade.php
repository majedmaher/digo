@extends('layouts.app')


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

      <form action="{{route('guest.blog.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
          <label for="exampleFormControlInput1">عنوان المقالة </label>
          <input type="text" name="title" class="form-control">
        </div>

        <div class="form-group">
          <label for="exampleFormControlTextarea1">محتوى المقالة </label>
          <textarea name="content" id="summernote"></textarea>
        </div>
        <div class="form-group">
          <label for="exampleFormControlTextarea1">وصف المقالة </label>
          <input type="text" name="description" class="form-control">
        </div>
        <div class="form-group">
          <label for="exampleFormControlTextarea1">الكلمات الدلالية للمقالة </label>
          <input type="text" name="keywords" class="form-control">
        </div>
        <div class="form-group">
          <label for="exampleFormControlInput1">صورة المقالة </label>
          <input type="file" name="photo" class="form-control">
        </div>

        <div class="form-group">

          <button class="btn btn-danger" type="submit">حفظ المقالة</button>
        </div>

      </form>


    </div>
  </div>
</div>

@endsection

@section('script')
<script>
  $('#summernote').summernote({
    placeholder: 'Enter the client content',
    tabsize: 2,
    height: 100
  });
</script>
@endsection