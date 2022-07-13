{{-- @extends('layouts.app') --}}
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
                            <th scope="col">الاسم</th>
                            <th scope="col">البريد الالكتروني</th>
                            <th scope="col">تاريخ التسجيل</th>
                            <th scope="col">الاجراءات</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                        </tr>
                        @foreach ($users as $user)

                            <tr>
                                <th scope="row">{{ ++$count }}</th>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->created_at }}</td>
                                <td>
                                    {{-- <a class="text-danger" href="{{route('user.destroy',['id'=> $user->id])}}"> <i class="fas  fa-2x fa-trash-alt"></i> </a> --}}

                                </td>
                            </tr>

                        @endforeach
                    </tbody>
                </table>


            </div>
        </div>
    </div>

@endsection
