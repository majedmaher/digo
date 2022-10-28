<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Stripe;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use AmrShawky\LaravelCurrency\Facade\Currency;
use App\Models\Package;
use App\Models\Payment;
use Carbon\Carbon;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::getPayments()->with(['package' => function ($query) {
            $query->getData();
        }])->latest()->get();
        return view('payments.index', compact('payments'));
    }

    public function show($id)
    {
        $payment = Payment::where('id', $id)->with('package')->first();
        return view('payments.show')->with('payment', $payment);
    }

    // PayPal Payment
    public function payment(Request $request)
    {
        if (!$request->id) {
            return redirect()->route('packages');
        }
        return view('payments.payment', ['id' => $request->id]);
    }
    public function processTransaction(Request $request)
    {
        if (!$request->package_id) {
            return redirect()->route('packages');
        }
        $request->validate([
            'package_id' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'phone_number' => 'required',
        ]);
        $package = Package::find($request->package_id);

        $price = Currency::convert()
            ->from($package->currencyـabbreviation)
            ->to('usd')
            ->amount($package->price)
            ->round(2)
            ->get();

        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();

        $data = array();
        $data['package_id'] = $request->package_id;
        $data['first_name'] = $request->first_name;
        $data['last_name'] = $request->last_name;
        $data['email'] = $request->email;
        $data['phone_number'] = $request->phone_number;

        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => route('payments.successTransaction', ['data' => $data]),
                "cancel_url" => route('payments.cancelTransaction'),
            ],
            "purchase_units" => [
                0 => [
                    "amount" => [
                        "currency_code" => "USD",
                        "value" => $price
                    ]
                ]
            ]
        ]);

        if (isset($response['id']) && $response['id'] != null) {

            // redirect to approve href
            foreach ($response['links'] as $links) {
                if ($links['rel'] == 'approve') {
                    return redirect()->away($links['href']);
                }
            }

            return redirect()
                ->route('packages')
                ->with('error', 'هناك خطأ ما.');
        } else {
            return redirect()
                ->route('packages')
                ->with('error', $response['message'] ?? 'هناك خطأ ما.');
        }
    }

    /**
     * success transaction.
     *
     * @return \Illuminate\Http\Response
     */
    public function successTransaction(Request $request)
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($request['token']);

        if (isset($response['status']) && $response['status'] == 'COMPLETED') {
            Payment::create([
                'package_id' => $request['data']['package_id'],
                'first_name' => $request['data']['first_name'],
                'last_name' => $request['data']['last_name'],
                'email' => $request['data']['email'],
                'phone_number' => $request['data']['phone_number'],

                'payment_type' => 'Paypal',
                'transaction_id' => $request['token'],
                'currency' => $response['purchase_units'][0]['payments']['captures'][0]['amount']['currency_code'],
                'gross_amount' => $response['purchase_units'][0]['payments']['captures'][0]['seller_receivable_breakdown']['gross_amount']['value'],
                'paypal_fee' => $response['purchase_units'][0]['payments']['captures'][0]['seller_receivable_breakdown']['paypal_fee']['value'],
                'net_amount' => $response['purchase_units'][0]['payments']['captures'][0]['seller_receivable_breakdown']['net_amount']['value'],
                'order_number' => uniqid(),

                'invoice_no' => 'order-' . uniqid(),
                'order_date' => Carbon::now()->format('d F Y'),
                'client_ip' => request()->ip(),
            ]);
            return redirect()
                ->route('packages')
                ->with('success', 'اكتملت المعاملة.');
        } else {
            return redirect()
                ->route('packages')
                ->with('error', $response['message'] ?? 'هناك خطأ ما.');
        }
    }

    /**
     * cancel transaction.
     *
     * @return \Illuminate\Http\Response
     */
    public function cancelTransaction(Request $request)
    {
        return redirect()
            ->route('packages')
            ->with('error', $response['message'] ?? 'لقد ألغيت الصفقة.');
    }























    // Stripe Payment

    public function stripe()
    {
        return view('payments.stripe');
    }

    public function stripePost(Request $request)
    {
        // return $request->card;
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        Stripe\Charge::create([
            "amount" => 100 * 150,
            "currency" => "sar",
            "source" => $request->stripeToken,
            "description" => "Making test payment."
        ]);

        Session::flash('success', 'Payment has been successfully processed.');

        return back();
    }
}
