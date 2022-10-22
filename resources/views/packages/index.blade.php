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
                        <th scope="col">العنوان</th>
                        <th scope="col">السعر</th>
                        <th scope="col">الحالة</th>
                        <th scope="col">الاجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($packages as $package)

                    <tr>
                        <th scope="row">{{++$count}}</th>
                        <td>{{$package->title}}</td>
                        <td>{{$package->price}} {{$package->currencyـname}}</td>
                        <td>{{$package->is_active == 'Active' ? 'مستمر': 'متوقف'}}</td>
                        <td>

                            <a href="{{route('packages.edit',['id'=> $package->id])}}"> <i class="fas fa-2x fa-edit"></i> </a>&nbsp;&nbsp;
                            <a class="text-danger" href="{{route('packages.destroy',['id'=> $package->id])}}"> <i class="fas  fa-2x fa-trash-alt"></i> </a>

                        </td>
                    </tr>

                    @endforeach
                </tbody>
            </table>


        </div>
    </div>
</div>

@endsection