<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Models\Payment;
use Illuminate\Http\Request;

class CheckoutController extends Controller
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

    public function checkout(Request $request)
    {
        $items = [];
        foreach($request->items as $item) {
            $items[] = [
                'amount' => (str_replace('.', '', number_format($item->preco, 2, '.', ''))),
                'description' => $item->name,
                'quantity' => (int)$item->quantity,
            ];
        }

        switch($request->metodo){
            case 'card':
                Plan::find($comanda->id)->update([
                    'user_id' => auth()->user()->id,
                    'plan_name' => $request->plan_name,
                    'duration' => $request->duration,
                    'value' => $request->value,
                ]);

                $dados = [
                    'items' =>  $items,
                    'customer' => [
                        'name' => auth()->user()->name,
                        'email' => auth()->user()->email,
                    ],
                    'payments' =>[
                        [
                            'payment_method' => 'credit_card',
                            'credit_card' => [
                                'recurrence' => false,
                                'installments' => 1,
                                'statement_descriptor' => 'GPLovers',
                                'card' => [
                                    'number' => $request->numero,
                                    'holder_name' => $request->name,
                                    'exp_month' => $request->mes,
                                    'exp_year' => $request->ano,
                                    'cvv' => $request->cvv,
                                    'billing_address' => [
                                        'line_1' => '',
                                        'zip_code' => '',
                                        'city' => '',
                                        'state' => '',
                                        'country' => 'BR',
                                    ],
                                ],
                            ],
                        ],
                    ],
                ];

                $transaction = $this->connect('orders', 'POST', $dados);
                \Log::info($transaction);

                $transaction = json_decode($transaction);
                Payment::create([
                    'user_id' => auth()->guard('cliente')->user()->id,
                    'order_id' => $transaction->id,
                    'payment_method' => $request->metodo,
                    'url_qr' => null,
                ]);
    
                return response()->json(['success', route('comanda.finalizado')], 200);
            break;
            case 'pix':
                Plan::find($comanda->id)->update([
                    'user_id' => auth()->user()->id,
                    'plan_name' => $request->plan_name,
                    'duration' => $request->duration,
                    'value' => $request->value,
                ]);

                $dados = [
                    'items' => $items,
                    'customer' =>[
                        'name' => auth()->user()->name,
                        'email' => auth()->user()->email,
                        'type' => 'individual',
                        'document' => str_replace(['.','-'], '', $request->cpf),
                        'phones' =>[
                            'home_phone' =>[
                                'country_code' => '55',
                                'number' => explode(' ', $request->fone)[1],
                                'area_code' => explode(' ', $request->fone)[0],
                            ],
                        ],
                    ],
                    'payments' =>[
                        [
                            'payment_method' => 'pix',
                            'pix' =>[
                                'expires_in' => '52134613',
                            ],
                        ],
                    ],
                    'shipping' =>[
                        'amount' => null,
                        'description' => 'GPLovers',
                        'recipient_name' => auth()->user()->name,
                        'recipient_phone' => str_replace([' '], '', $request->fone),
                        'address' =>[
                            'line_1' => '',
                            'zip_code' => '',
                            'city' => '',
                            'state' => '',
                            'country' => 'BR',
                        ],
                    ],
                ];

                $transaction = $this->connect('orders', 'POST', $dados);
                \Log::info($transaction);

                $transaction = json_decode($transaction);

                $payment = Payment::create([
                    'user_id' => auth()->guard('cliente')->user()->id,
                    'order_id' => $transaction->id,
                    'payment_method' => $request->metodo,
                    'url_qr' => $transaction->charges[0]->last_transaction->qr_code_url,
                ]);

                return response()->json(['success', route('comanda.pix', $payment->id)], 200);
            break;
        }
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
