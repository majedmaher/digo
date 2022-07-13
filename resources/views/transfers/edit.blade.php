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

      <label>الاسم {{$officer->name}}</label>

      <form action="{{route('transfer.update',['id'=> $transfer->id])}}" method="POST">
        @csrf

        <input type="hidden" name="officer_id" value="{{$officer->id}}">
        <div class="form-group">
          <label for="exampleFormControlInput1">المبلغ </label>
          <input name="amount" type="number" step="0.01" value="{{$transfer->amount}}">
        </div>

        <div class="form-group">
          <label for="exampleFormControlInput1">الايضاحات </label>
          <input type="text" name="clarifications" class="form-control" value="{{$transfer->clarifications}}">
        </div>

        <div class="form-group d-flex">
          <label for="exampleFormControlInput1">التاريخ </label>
          <input type="date" name="date" class="form-control" style="width: 200px!important;" value="{{$transfer->date}}">
        </div>

        <div class="form-group">
          <button class="btn btn-danger" type="submit">حفظ</button>
        </div>

      </form>
    </div>
  </div>
</div>

@endsection