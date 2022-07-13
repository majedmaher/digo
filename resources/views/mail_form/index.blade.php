@extends('dashboard.include')

@php
$count = 0;
@endphp
@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">

      <form action="{{route('emails.insert')}}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="file" name="excel_file">
        <input type="submit" value="store">
      </form>

      <table class="table">
        <thead class="thead-dark">
          <tr>
            <th scope="col">#</th>
            <th scope="col">صورة الهيدر</th>
            <th scope="col">عنوان البريد</th>
            <th scope="col"> تاريخ نشر البريد</th>
            <th scope="col">الاجراءات</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($mails as $mail)
          <tr>
            <th scope="row">{{++$count}}</th>
            <td><img width="150px" src="{{URL::asset($mail->header_image)}}" alt="{{$mail->header_image}}"></td>
            <td>{{$mail->mail_title}}</td>
            <td>{{$mail->created_at->diffForhumans() }}</td>
            <td>
              <a class="text-success" href="{{route('mail.show',['id'=> $mail->id])}}"> <i class="fas  fa-2x fa-eye"></i> </a>
              @if ($mail->user_id == Auth::id() || Auth::user()->is_admin == 1)
              &nbsp;&nbsp;
              <a href="{{route('mail.edit',['id'=> $mail->id])}}"> <i class="fas fa-2x fa-edit"></i> </a>&nbsp;&nbsp;
              <a class="text-danger" href="{{route('mail.destroy',['id'=> $mail->id])}}"> <i class="fas  fa-2x fa-trash-alt"></i> </a>
              @endif
              <a href="{{route('send.email',['id'=> $mail->id])}}"> <i class="fas fa-2x  fa-share-all"></i> </a>&nbsp;&nbsp;

            </td>
          </tr>

          @endforeach
        </tbody>
      </table>


    </div>
  </div>
</div>

@endsection