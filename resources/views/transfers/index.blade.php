{{-- @extends('layouts.app') --}}
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
      <label>الاسم {{$officer->name}}</label>

      <form action="{{route('print')}}" method="POST">
        @csrf
        <input type="hidden" name="officer_id" value="{{$officer->id}}">
        <input name="movements" type="number" step="1" min="0">
        <button style="border: none;"><i class="fas fa-2x fa-print"></i></button>

      </form>

      </br>
      </br>

      <form action="{{route('transfer.store')}}" method="POST">
        @csrf

        <input type="hidden" name="officer_id" value="{{$officer->id}}">
        <div class="form-group">
          <label for="exampleFormControlInput1">المبلغ </label>
          <input name="amount" type="number" step="0.01">
        </div>

        <div class="form-group">
          <label for="exampleFormControlInput1">الايضاحات </label>
          <input type="text" name="clarifications" class="form-control">
        </div>

        <div class="form-group d-flex">
          <label for="exampleFormControlInput1">التاريخ </label>
          <input type="date" name="date" class="form-control" style="width: 200px!important;">
        </div>

        <div class="form-group">
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
            <th scope="col">المبلغ</th>
            <th scope="col">الايضاحات</th>
            <th scope="col">التاريخ</th>
            <th scope="col">الاجراءات</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($transfers as $transfer)

          <tr>
            <th scope="row">{{++$count}}</th>
            <td>{{$transfer->amount}}</td>
            <td>{{$transfer->clarifications}}</td>
            <td>{{$transfer->date}}</td>

            <td>

              <a href="{{route('transfer.edit',['id'=> $transfer->id])}}"> <i class="fas fa-2x fa-edit"></i> </a>&nbsp;&nbsp;
              <a class="text-danger" href="{{route('transfer.destroy',['id'=> $transfer->id])}}"> <i class="fas  fa-2x fa-trash-alt"></i> </a>&nbsp;&nbsp;

            </td>
          </tr>

          @endforeach


        </tbody>
      </table>



    </div>
  </div>
</div>

@endsection