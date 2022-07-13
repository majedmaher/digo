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

      <form action="{{route('transfers.financial.claim')}}" method="POST">
        @csrf
        <input type="month" name="month" class="form-control" style="width: 200px!important;">
        <button style="border: none;"><i class="fas fa-2x fa-print"></i></button>

      </form>

      </br>
      </br>



    </div>
  </div>


</div>

@endsection