<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>فاتورة إلكترونية مقدمة من شركة ديجو</title>
    <link rel="stylesheet" href="{{asset('css/tax-incoive.css')}}">
    <link rel="shortcut icon" href="{{asset('images/logo.png')}}" type="image/x-icon">

</head>

<body>
    <div class="header space">
        <div class="header-title">
            <h1>فاتورة إلكترونية مقدمة من شركة ديجو</h1>
        </div>

        <div class="header-logo">
            <img src="{{asset('images/logo.png')}}" alt="" class="logo-img">
        </div>
    </div>

    <hr class="line-header" />

    <div class="main-inforamtion space">
        <div class="owner-information">
            <span class="title">مقدم الخدمة</span>
            <br />
            <span class="company-name">شركة ديجو لخدمات التسويق الرقمي</span>
            <br />
            مؤسسة نادين الخير
            <br />
            سجل تجاري : 4030242720
            <br />
            الرمز البريدي : 23432
            <br />
            شارع نهضة التاريخ
            <br />
            جدة - حي الروضة
            <br />
            المملكة العربية السعودية
            <br />
            الرقم الضريبي : 301193099200003
        </div>
        <div class="client-information">
            <span class="title">العميل</span>
            <br />
            <span class="company-name">{{$tax->company->company_name}}</span>
            <br />
            {{$tax->company->address}}
            <br />
            رقم السجل التجاري: {{$tax->company->commercial_registration_no}}
        </div>
    </div>

    <div class="invoive-information">
        <div class="invoice-number-title">رقم الفاتورة: <spane class="invoice-number">{{$tax->invoice_no}}</spane>
        </div>
        <div class="invoice-date-title">تاريخ الفاتورة: <spane class="date-number">{{$today}}</spane>
        </div>
    </div>

    <?php
    $netTotal = 0;
    $totalTax = 0;
    $totalAmount = 0;
    ?>

    <div class="table space">

        <table>
            <tr class="th">
                <th>الرقم</th>
                <th>الوصف</th>
                <th>الكمية</th>
                <th>سعر الوحدة</th>
                <th>اجمالي المبلغ الصافي</th>
                <th>نسبة ضريبة القيمة المضافة</th>
                <th>مبلغ ضريبة القيمة المضافة</th>
            </tr>

            @foreach ($tax->taxes as $key => $value )
            <tr>
                <td>{{$key}}</td>
                <td>{{$value->description}}</td>
                <td>{{$value->quantity}}</td>
                <td>{{$value->price}} ر. س</td>
                <td>{{$value->total_price}} ر. س</td>
                <td>{{$value->tax_rate}}%</td>
                <td>{{$value->tax_amount}} ر. س</td>

                <?php
                $netTotal += $value->total_price;
                $totalTax += $value->tax_amount;
                $totalAmount += $value->total_price + $value->tax_amount;
                ?>
            </tr>
            @endforeach

        </table>

    </div>

    <div class="space">
        <div class="total">

            <div class="item">
                <div class="title">المبلغ الاجمالي باستثناء ضريبة القيمة المضافة</div>
                <div class="amount">{{$netTotal}} ر. س</div>
            </div>
            <div class="item">
                <div class="title">مبلغ ضريبة القيمة المضافة</div>
                <div class="amount">{{$totalTax}} ر. س</div>
            </div>
            <hr class="line-total" />
            <div class="item grand-total">
                <div class="title">اجمالي المبلغ المستحق</div>
                <div class="amount">{{$totalAmount}} ر. س</div>
            </div>
        </div>
    </div>

    <div class="space">
        <pre class="bank-info">
اسم البنك : بنك الراجحي 
اسم المحول إليه : Yasir Omar ALfarsi
رقم حساب : 463608010078749 
ايبان الحساب : SA38 8000 0463 6080 1007 8749
        </pre>
    </div>
</body>

</html>