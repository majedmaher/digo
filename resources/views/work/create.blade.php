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



      <form action="{{route('work.store')}}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
          <label for="exampleFormControlInput1">اسم العمل </label>
          <input type="text" name="description" class="form-control">
        </div>
        <div class="form-group">
          <label for="exampleFormControlInput1">رابط الموقع </label>
          <input type="text" name="link" class="form-control">
        </div>
        <div class="form-group">
          <label for="exampleFormControlInput1">Behance </label>
          <input type="text" name="behance" class="form-control">
        </div>
        <div class="form-group">
          <label for="exampleFormControlInput1">Photo </label>
          <input type="file" name="photo" class="form-control">
        </div>

        <div class="form-group">
          <label for="exampleFormControlInput1">التصنيف </label>
          <select name="category" class="form-select" aria-label="Default select example">
            <option selected value="web-design">تصميم مواقع</option>
            <option value="print">طباعة</option>
            <option value="trademarks">علامات تجارية</option>
            <option value="photography">فوتوجراف</option>
          </select>
        </div>
        <div class="form-group">
          <label for="exampleFormControlInput1">الترتيب </label>
          <input type="number" name="arrangement" class="form-control" min="0"></input>
        </div>
        <div class="form-group">
          <button class="btn btn-danger" type="submit">save</button>
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