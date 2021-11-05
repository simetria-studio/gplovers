<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Models\Payment;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public $plans = [
        1 => [
            'plano' => '14',
            'duracao' => '7',
            'valor' => 15.00
        ],
        2 => [
            'plano' => '21',
            'duracao' => '7',
            'valor' => 19.99,
        ],
        3 => [
            'plano' => '28',
            'duracao' => '7',
            'valor' => 30.00,
        ],
    ];
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

    public function checkoutView($id)
    {
        return view('checkout', get_defined_vars());
    }

    public function checkout(Request $request)
    {
        $plans = $this->plans;
        $items[] = [
            'amount' => $plans[$request->plan_id]['valor'],
            'description' => 'Plano de '.$plans[$request->plan_id]['plano'].' Subidas',
            'quantity' => 1,
        ];

        switch($request->metodo){
            case 'card':
                $plan_data = Plan::create([
                    'user_id' => auth()->user()->id,
                    'plan_name' => $plans[$request->plan_id]['plano'].' Subidas',
                    'duration' => $plans[$request->plan_id]['duracao'],
                    'value' => $plans[$request->plan_id]['valor'],
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
                                        'line_1' => 'Rua Tereza Moreira',
                                        'zip_code' => '83311240',
                                        'city' => 'Piraquara',
                                        'state' => 'PR',
                                        'country' => 'BR',
                                    ],
                                ],
                            ],
                        ],
                    ],
                ];

                $transaction = $this->connect('orders', 'POST', $dados);
                \Log::info($transaction);
                // Descomentar quando for em produção
                // if(isset($transaction->errors)) return response()->json('refused',412);

                $transaction = json_decode($transaction);
                Payment::create([
                    'user_id' => auth()->user()->id,
                    'plan_id' => $request->plan_id,
                    'order_id' => $transaction->id,
                    'payment_method' => $request->metodo,
                    'status' => 1,
                ]);

                Plan::find($plan_data->id)->update(['status' => 1]);
    
                return response()->json(['success', route('checkout.finalizado')], 200);
            break;
            case 'pix':
                Plan::create([
                    'user_id' => auth()->user()->id,
                    'plan_name' => $plans[$request->plan_id]['plano'].' Subidas',
                    'duration' => $plans[$request->plan_id]['duracao'],
                    'value' => $plans[$request->plan_id]['valor'],
                ]);

                $dados = [
                    'items' => $items,
                    'customer' =>[
                        'name' => auth()->user()->name,
                        'email' => auth()->user()->email,
                        'type' => 'individual',
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
                        'address' =>[
                            'line_1' => 'Rua Tereza Moreira',
                            'zip_code' => '83311240',
                            'city' => 'Piraquara',
                            'state' => 'PR',
                            'country' => 'BR',
                        ],
                    ],
                ];

                $transaction = $this->connect('orders', 'POST', $dados);
                \Log::info($transaction);
                // Descomentar quando for em produção
                // if(isset($transaction->errors)) return response()->json('refused',412);

                $transaction = json_decode($transaction);

                $payment = Payment::create([
                    'user_id' => auth()->user()->id,
                    'plan_id' => $request->plan_id,
                    'order_id' => $transaction->id,
                    'payment_method' => $request->metodo,
                    'url_qr' => $transaction->charges[0]->last_transaction->qr_code_url,
                ]);

                return response()->json(['success', route('checkout.pix', $payment->id)], 200);
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
