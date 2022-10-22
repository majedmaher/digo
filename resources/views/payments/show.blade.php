@extends('dashboard.include')

@section('styles')
<style>
    .payment-details {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
    }

    .payment-details>div {
        width: 30%;
        text-align: center;
    }

    @media (max-width: 1000px) {
        .payment-details {
            flex-direction: column;
        }

        .payment-details>div {
            width: 100%;
        }
    }
</style>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="payment-details">
                <div class="name">الاسم : {{$payment->first_name}} {{$payment->last_name}}</div>
                <div class="email">الايميل : {{$payment->email}}</div>
                <div class="phone-number">رقم الهاتف : {{$payment->phone_number}}</div>
                <div class="package-title">عنوان الحزمة : {{$payment->package->title}}</div>
                <div class="package-price">سعر الطرد : {{$payment->package->price}}</div>
                <div class="package-period">فترة الحزمة : {{$payment->package->period}}</div>
                <div class="package-currencyـname">اسم العملة : {{$payment->package->currencyـname}}</div>
                <div class="payment-type">طريقة الدفع : {{$payment->payment_type}}</div>
                <div class="transaction-id">رقم المعاملة : {{$payment->transaction_id}}</div>
                <div class="currency">العملة : {{$payment->currency}}</div>
                <div class="gross_amount">المبلغ الإجمالي : {{$payment->gross_amount}}</div>
                <div class="paypal_fee">رسوم باي بال : {{$payment->paypal_fee}}</div>
                <div class="net_amount">صافي المبلغ : {{$payment->net_amount}}</div>
                <div class="order_number">رقم الطلب : {{$payment->order_number}}</div>
                <div class="invoice_no">رقم الفاتورة : {{$payment->invoice_no}}</div>
                <div class="order_date">تاريخ الطلب : {{$payment->order_date}}</div>
            </div>
        </div>
    </div>
</div>
@endsection