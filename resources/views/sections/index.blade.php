@extends('dashboard.include')

@php
$count = 0;
@endphp
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

      <form action="{{route('section.store')}}" method="POST">
        @csrf

        <div class="form-group">
          <label for="exampleFormControlInput1">عنوان القسم </label>
          <input name="name" type="text"">
        </div>

        <div class=" form-group">
          <button class="btn btn-danger" type="submit">حفظ</button>
        </div>

      </form>


    </div>
  </div>


  <div class="row justify-content-center">
    <div class="col-md-12">
      <table class="table">
        <thead class="thead-dark">
          <tr>
            <th scope="col">#</th>
            <th scope="col">عنوان القسم</th>
            <th scope="col">الاجراءات</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($sections as $section)

          <tr>
            <th scope="row">{{++$count}}</th>
            <td>
              <form action="{{route('section.update',['id'=> $section->id])}}" method="POST" style="display: flex;">
                @csrf

                <div class="form-group">
                  <input name="name" type="text" value="{{$section->name}}">
                </div>

                <div class="form-group">
                  <button class="btn btn-danger" type="submit">حفظ</button>
                </div>

              </form>
            </td>

            <td>
              <a class="text-danger" href="{{route('section.destroy',['id'=> $section->id])}}"> <i class="fas  fa-2x fa-trash-alt"></i> </a>&nbsp;&nbsp;
            </td>
          </tr>

          @endforeach


        </tbody>
      </table>



    </div>
  </div>
</div>

@endsection