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
            <label>اسم الشركة : {{$company->company_name}}</label>

            </br>
            </br>

            <form action="{{route('tax-invoice.store')}}" method="POST">
                @csrf
                <div class="tax">
                    <input type="date" name="date">
                    <input type="hidden" name="company_id" value="{{$company->id}}">
                    <div class="form-group">
                        <label for="exampleFormControlInput1">الوصف </label>
                        <input type="text" name="description[0]">
                        <label for="exampleFormControlInput1">الكمية </label>
                        <input type="number" name="quantity[0]" placeholder="2">
                        <label for="exampleFormControlInput1">سعر الوحدة </label>
                        <input type="number" name="price[0]" step="0.1" placeholder="230.3">
                        <label for="exampleFormControlInput1">نسبة الضريبة </label>
                        <input type="number" name="tax_rate[0]" placeholder="15" style="margin-left: 10px;">
                        <i onclick="removeItem(this)" style="color:red; cursor: pointer; font-size: 25px;" class="fa fa-solid fa-minus"></i>
                    </div>
                </div>
                <br />
                <div class="add"><i class="fa fa-solid fa-plus" style="cursor: pointer; font-size:30px;"></i></div>
                <br />
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
                        <th scope="col">رقم الفاتورة</th>
                        <th scope="col">التاريخ</th>
                        <th scope="col">الاجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tax as $t)

                    <tr>
                        <th scope="row">{{++$count}}</th>
                        <td>{{$t->invoice_no}}</td>
                        <td>{{$t->invoice_date}}</td>

                        <td>

                            <a href="{{route('tax-invoice.edit',['id'=> $t->id])}}"> <i class="fas fa-2x fa-edit"></i> </a>&nbsp;&nbsp;
                            <a class="text-danger" href="{{route('tax-invoice.delete-get',['id'=> $t->id])}}"> <i class="fas  fa-2x fa-trash-alt"></i> </a>&nbsp;&nbsp;
                            <a href="{{ route('tax-invoice',['id'=>$t->id]) }}" target="_blank"><i class="fas fa-2x fa-receipt"></i></a>

                        </td>
                    </tr>

                    @endforeach


                </tbody>
            </table>



        </div>
    </div>

</div>

@endsection

@section('scripts')
<script>
    let i = 0;
    $('.add i').click(function(e) {
        e.preventDefault();
        ++i;
        $item = `<div class="form-group">
    <label for="exampleFormControlInput1">الوصف </label>
            <input type="text" name="description[${i}]">
            <label for="exampleFormControlInput1">الكمية </label>
            <input type="number" name="quantity[${i}]" placeholder="2">
            <label for="exampleFormControlInput1">سعر الوحدة </label>
            <input type="number" name="price[${i}]" step="0.1" placeholder="230.3">
            <label for="exampleFormControlInput1">نسبة الضريبة </label>
            <input type="number" name="tax_rate[${i}]" placeholder="15" style="margin-left: 10px;">            
            <i onclick="removeItem(this)" style="color:red; cursor: pointer; font-size: 25px;" class="fa fa-solid fa-minus"></i>
          </div>`;
        $('.tax').append($item);
    });

    function removeItem(input) {
        item = $(input).parents('.form-group');
        $(item).remove();
    }
</script>
@endsection