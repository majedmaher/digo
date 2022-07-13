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

      <form action="{{route('mail.update',['id'=> $mail->id])}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
          <label for="exampleFormControlInput1">عنوان البريد </label>
          <input type="text" name="mail_title" class="form-control" value="{{$mail->mail_title}}">
        </div>

        <div class="form-group">
          <label for="exampleFormControlInput1">صورة الهيدر </label>
          <input type="file" name="header_image" class="form-control">
        </div>
        <div class="form-group">
          <label for="exampleFormControlInput1">صورة المحتوى </label>
          <input type="file" name="body_image" class="form-control">
        </div>

        <div class="form-group">
          <label for="exampleFormControlTextarea1">محتوى النص الاول </label>
          <textarea name="body_text_one" id="summernote">{{$mail->body_text_one}}</textarea>
        </div>
        <div class="form-group">
          <label for="exampleFormControlInput1">محتوى الرابط الرئيسي </label>
          <input type="text" name="button" class="form-control" value="{{$mail->button}}">
        </div>
        <div class="form-group">
          <label for="exampleFormControlInput1">الرابط الرئيسي </label>
          <input type="text" name="button_link" class="form-control" value="{{$mail->button_link}}">
        </div>
        <div class="form-group">
          <label for="exampleFormControlTextarea1">محتوى النص الثاني </label>
          <textarea name="body_text_two" id="summernote">{{$mail->body_text_two}}</textarea>
        </div>
        <div class="form-group">
          <label for="exampleFormControlInput1">محتوى الرابط الأول </label>
          <input type="text" name="button_one" class="form-control" value="{{$mail->button_one}}">
        </div>
        <div class="form-group">
          <label for="exampleFormControlInput1">الرابط الأول </label>
          <input type="text" name="button_one_link" class="form-control" value="{{$mail->button_one_link}}">
        </div>
        <div class="form-group">
          <label for="exampleFormControlInput1">محتوى الرابط الثاني </label>
          <input type="text" name="button_two" class="form-control" value="{{$mail->button_two}}">
        </div>
        <div class="form-group">
          <label for="exampleFormControlInput1">الرابط الثاني </label>
          <input type="text" name="button_two_link" class="form-control" value="{{$mail->button_two_link}}">
        </div>
        <div class="form-group">
          <label for="exampleFormControlInput1">محتوى الرابط الثالث </label>
          <input type="text" name="button_three" class="form-control" value="{{$mail->button_three}}">
        </div>
        <div class="form-group">
          <label for="exampleFormControlInput1">الرابط الثالث </label>
          <input type="text" name="button_three_link" class="form-control" value="{{$mail->button_three_link}}">
        </div>
        <div class="form-group">
          <label for="exampleFormControlInput1">صورة الفوتر </label>
          <input type="file" name="footer_image" class="form-control">
        </div>

        <div class="form-group">

          <button class="btn btn-danger" type="submit">حفظ البريد</button>
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
    placeholder: 'ادخل محتوى النص ',
    tabsize: 10,
    height: 100
  });
  $('#summernote2').summernote({
    placeholder: 'ادخل محتوى النص ',
    tabsize: 10,
    height: 100
  });
</script>
@endsection