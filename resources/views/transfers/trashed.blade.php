@extends('dashboard.include')

@php
$count = 0;
@endphp
@section('content')
<div class="container">


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

              <a class="text-success" href="{{route('transfer.restore',['id'=> $transfer->id])}}"> <i class="fas fa-2x fa-undo"></i> </a> &nbsp;&nbsp;
              <a class="text-danger" href="{{route('transfer.hdelete',['id'=> $transfer->id])}}"> <i class="fas  fa-2x fa-trash-alt"></i> </a>

            </td>
          </tr>

          @endforeach
        </tbody>
      </table>



    </div>
  </div>
</div>

@endsection