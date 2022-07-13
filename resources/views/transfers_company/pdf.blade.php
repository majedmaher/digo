<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print</title>
    <link rel="stylesheet" href="{{ asset('css/bank.css') }}">
</head>

<body>
    <div class="bank-logo">
        <img src="{{ asset('logo.png') }}" alt="">
    </div>
    <div class="page-content">
        <div class="bank-branch">
            ديجو | للتسويق الرقمي وخدمات الويب المتكاملة
        </div>

        <div class="title">
            كشف حساب الحوالات المالية
        </div>

        <div class="personal-data">
            <div class="col">
                <div class="name">
                    اسم الشركة :
                    {{$company->company_name}}
                </div>
                </br>
                <div class="address">
                    {{$company->address}}
                </div>
            </div>
            <div class="col">

                <div class="row">
                    <div class="title-row">
                         النوع
                    </div>
                    <div class="content-row">
                        كشف حوالات مالية
                    </div>
                </div>
                <div class="row">
                    <div class="title-row">
                        العملة
                    </div>
                    <div class="content-row">
                        ريال سعودي
                    </div>
                </div>
                <div class="row">
                    <div class="title-row">
                        بتاريخ
                    </div>
                    <div class="content-row">
                        {{$date_today}}
                    </div>
                </div>

            </div>
        </div>
        <div class="table-data">
            <table>
                @php
                $total = 0;
                @endphp
                <tr>
                    <th> التاريخ</th>
                    <th> الإيضاحات</th>
                    <th> الرصيد</th>
                    <th> الحوالة المالية</th>
                    <th> المطالبة المالية</th>
                </tr>
                @foreach ($transfers as $transfer)
                <tr>
                    <td>{{$transfer->date}}</td>
                    <td>{{$transfer->clarifications}}</td>
                    <td>{{$transfer->amount}}</td>
                    <td>
                        @if ($transfer->passbook)
                        <a href="{{ URL::asset($transfer->passbook) }}" target="_blank" rel="noopener noreferrer">انقر هنا</a>
                        @endif
                    </td>
                    <td>
                        @if ($transfer->financial_claim)
                        <a href="{{ URL::asset($transfer->financial_claim) }}" target="_blank" rel="noopener noreferrer">انقر هنا</a>
                        @endif
                    </td>
                    @php
                    $total += $transfer->amount
                    @endphp
                </tr>
                @endforeach
                <tr class="tfoot line-1">
                    <td>قيمة الحركات</td>
                    <td></td>
                    <td>{{$total}} ريال سعودي</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr class="tfoot line-2">
                    <td>عدد الحركات</td>
                    <td></td>
                    <td>{{$movements}}</td>
                    <td></td>
                    <td></td>
                </tr>
            </table>
        </div>
    </div>
    <div class="footer">
        <div class="signatures">
            <div class="signatur">
                <h3>
                    الطرف الاول
                    </br>
                    قسم المالية
                    </br>
                    </br>
                    </br>
                    </br>
                    </br>
                    شاهد رقم 1
                </h3>
            </div>
            <div class="signatur">
                <h3>
                    الطرف التاني
                    </br>
                    الادارة
                    </br>
                    </br>
                    </br>
                    </br>
                    </br>
                    شاهد رقم 2
                </h3>
            </div>
        </div>
    </div>
</body>

</html>