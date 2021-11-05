<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Models\Payment;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    public function connect($endpoint, $method, $dados)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.pagar.me/core/v5/$endpoint",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => $method,
            CURLOPT_POSTFIELDS => json_encode($dados),
            CURLOPT_HTTPHEADER => array(
                'Authorization: Basic '.base64_encode('sk_test_adMxDGMUdAuRw2EO:'),
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;
    }

    public function index()
    {
        return view('plan', get_defined_vars());
    }

    public function checkoutFinalizado()
    {
        return view('checkoutFinalizado', get_defined_vars());
    }

    public function checkoutPix($id)
    {
        $payment = Payment::find($id);
        $code = $this->getCode($payment->url_qr);

        $transaction = $this->connect('orders/'.$payment->order_id, 'GET', '');
        $transaction = json_decode($transaction);
        if($transaction->status == 'paid') {
            Plan::where('user_id', auth()->user()->id)->where('status', 0)->update(['status' => 1]);
            $payment->update(['status' => 1]);
            return redirect()->route('checkout.finalizado');
        }
        return view('checkoutPix', get_defined_vars());
    }

    public function getCode($code)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $code,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ));

        $response = curl_exec($curl);
        $info = curl_getinfo($curl);

        curl_close($curl);
        return $image = 'data:' . $info['content_type'] . ';base64,' . base64_encode($response);
    }
}
