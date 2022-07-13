
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
        
        <form action="{{route('client.update',['id'=> $client->id])}}" method="POST" enctype="multipart/form-data">
          @csrf
          
              <div class="form-group">
                <label for="exampleFormControlTextarea1">content  </label>
                <textarea name="content" id="summernote">{!! $client->content !!}</textarea>
              </div>
              <div class="form-group">
                  <label for="exampleFormControlInput1">Photo  </label>
                  <input type="file"  name="photo" class="form-control">
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