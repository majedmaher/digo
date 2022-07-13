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

      <form action="{{route('slider.update',['slug'=> $slider->slug])}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
          <label for="exampleFormControlInput1">عنوان السلايدر </label>
          <input type="text" name="title" class="form-control" value="{{$slider->title}}">
        </div>

        <div class="form-group">
          <label for="exampleFormControlInput1">العنوان الفرعي للسلايدر </label>
          <input type="text" name="sub_title" class="form-control" value="{{$slider->sub_title}}">
        </div>

        <div class="form-group">
          <label for="exampleFormControlTextarea1">محتوى السلايدر </label>
          <textarea name="content" id="summernote">{!! $slider->content !!}</textarea>
        </div>
        <div class="form-group">
          <label for="exampleFormControlTextarea1">عرض المزيد </label>
          <input type="text" name="more_btn" class="form-control" value="{{$slider->more_btn}}">
        </div>
        <div class="form-group">
          <label for="exampleFormControlTextarea1">رابط المزيد </label>
          <input type="text" name="more_link" class="form-control" value="{{$slider->more_link}}">
        </div>
        <div class="form-group">
          <label for="exampleFormControlInput1">صورة السلايدر </label>
          <input type="file" name="photo" class="form-control">
        </div>
        <div class="form-group">
          <label for="exampleFormControlInput1">خلفية السلايدر </label>
          <input type="file" name="background" class="form-control">
        </div>

        <div class="form-group">

          <button class="btn btn-danger" type="submit">save</button>
        </div>

      </form>


    </div>
  </div>
</div>

@endsection

@section('styles')
<script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
@endsection

@section('scripts')
<script>
  $('#summernote').summernote({
    placeholder: 'ادخل محتوى السلايدر',
    tabsize: 10,
    height: 100
  });
</script>
@endsection