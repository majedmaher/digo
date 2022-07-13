@extends('layouts.app')


@php
$count = 0;
@endphp
@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card-header">
        <h3> المقالات </h3>
        <a href="{{route('guest.blog.create')}}">اضافة مقالة</a>
      </div>
      <br>


      <table class="table">
        <thead class="thead-dark">
          <tr>
            <th scope="col">#</th>
            <th scope="col">صورة المقالة</th>
            <th scope="col">عنوان المقالة</th>
            <th scope="col"> تاريخ نشر المقالة</th>
            <th scope="col">الاجراءات</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($blogs as $blog)
          <tr>
            <th scope="row">{{++$count}}</th>
            <td><img width="150px" src="{{URL::asset($blog->photo)}}" alt="{{$blog->photo}}"></td>
            <td>{{$blog->title}}</td>
            <td>{{$blog->created_at->diffForhumans() }}</td>
            <td>
              <!-- <a class="text-success" href="{{route('guest.blog.show',['slug'=> $blog->slug])}}"> <i class="fas  fa-2x fa-eye"></i> </a> -->
              &nbsp;&nbsp;
              <a href="{{route('guest.blog.edit',['slug'=> $blog->slug])}}"> <i class="fas fa-2x fa-edit"></i> </a>&nbsp;&nbsp;

            </td>
          </tr>

          @endforeach
        </tbody>
      </table>


    </div>
  </div>
</div>

@endsection