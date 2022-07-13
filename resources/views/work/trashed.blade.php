<!-- @extends('layouts.app') -->
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
            <th scope="col">Image</th>
            <th scope="col">link</th>
            <th scope="col">Category</th>
            <th scope="col"> Date</th>
            <th scope="col">Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($works as $work)

          <tr>
            <th scope="row">{{++$count}}</th>
            <td><img width="150px" src="{{URL::asset($work->photo)}}" alt="{{$work->photo}}"></td>
            <td><a href="{{$work->link}}">{{$work->link}}</a></td>
            <td>{{$work->category}}</td>
            <td>{{$work->created_at->diffForhumans() }}</td>
            <td>
              <a class="text-success" href="{{route('work.restore',['id'=> $work->id])}}"> <i class="fas fa-2x fa-undo"></i> </a> &nbsp;&nbsp;
              <a class="text-danger" href="{{route('work.hdelete',['id'=> $work->id])}}"> <i class="fas  fa-2x fa-trash-alt"></i> </a>

            </td>
          </tr>

          @endforeach
        </tbody>
      </table>


    </div>
  </div>
</div>

@endsection