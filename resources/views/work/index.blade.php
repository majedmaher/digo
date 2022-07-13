@extends('dashboard.include')

@php
$count = 0;
@endphp
@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <!-- <div class="card-header">
        <h3> Works </h3>
        <a href="{{route('work.create')}}">Add Work</a>
        <a href="{{route('works.trashed')}}">Trashed Works</a>
      </div>
      <br> -->
      <table class="table">
        <thead class="thead-dark">
          <tr>
            <th scope="col">#</th>
            <th scope="col">اسم العمل</th>
            <th scope="col">الصورة</th>
            <th scope="col">رابط الموقع</th>
            <th scope="col">Behance</th>
            <th scope="col">التصنيف</th>
            <th scope="col"> بتاريخ</th>
            <th scope="col">الاجراءات</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($works as $work)

          <tr>
            <th scope="row">{{++$count}}</th>
            <td>{{$work->description}}</td>
            <td><img width="150px" src="{{URL::asset($work->photo)}}" alt="{{$work->photo}}"></td>
            <td><a href="{{$work->link}}">{{$work->link}}</a></td>
            <td><a href="{{$work->behance}}">{{$work->behance}}</a></td>
            <td>{{$work->category}}</td>
            <td>{{$work->created_at->diffForhumans() }}</td>
            <td>
              {{-- <a  class="text-success" href="{{route('work.show',['id'=> $work->id])}}"> <i class="fas  fa-2x fa-eye"></i> </a> --}}
              {{-- @if ($item->user_id == Auth::id()) --}}
              &nbsp;&nbsp;
              @if ($work->is_favorite == 1)
              <a class="text-sucess" href="{{route('work.updateFavorite',['id'=> $work->id])}}"> <i class="fas  fa-2x fa-heart"></i> </a>
              @else
              <a class="" href="{{route('work.updateFavorite',['id'=> $work->id])}}"> <i class="far  fa-2x fa-heart"></i> </a>
              @endif
              &nbsp;&nbsp;
              <a href="{{route('work.edit',['id'=> $work->id])}}"> <i class="fas fa-2x fa-edit"></i> </a>&nbsp;&nbsp;
              <a class="text-danger" href="{{route('work.destroy',['id'=> $work->id])}}"> <i class="fas  fa-2x fa-trash-alt"></i> </a>
              {{-- @endif --}}

            </td>
          </tr>

          @endforeach
        </tbody>
      </table>


    </div>
  </div>
</div>

@endsection