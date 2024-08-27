<?php

namespace App\Integrations\Payments;

use Throwable;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Modules\Support\Traits\ApiTrait;
use Modules\Support\Traits\ConsumeExternalServices;
use Illuminate\Http\Exceptions\HttpResponseException;

class MyFatoorah
{
    use ConsumeExternalServices, ApiTrait;

    protected string $url;
    protected string $app_key;

    public function __construct()
    {
        $this->url = config('payments.myfatoorah.uri');
        $this->app_key = config('payments.myfatoorah.app_key');
    }

    // to resolve the autorization
    public function resolveAuthorization(&$queryParams, &$formParams, &$headers)
    {
        $headers['Authorization'] = $this->resolveAccessToken();
    }

    // create the access token
    public function resolveAccessToken()
    {
        return "Bearer {$this->app_key}";
    }

    // resolve the factor (to solve zero decimal currency problem)
    public function resolveFactor($currency)
    {
        $zeroDecimalCurrencies = ['JPY'];

        if (in_array(strtoupper($currency), $zeroDecimalCurrencies)) {
            return 1;
        }
        return 100;
    }

    // to decode the response of the sent request
    public function decodeResponse($response)
    {
        return json_decode($response);
    }

    // send a payment
    public function sendPayment($name, $email, $value, $currency)
    {
        try {
            $req = $this->makeRequest(
                'POST',
                '/v2/SendPayment',
                [],
                [
                    "CustomerName" => $name,
                    "NotificationOption" => "LNK",
                    "CustomerEmail" => $email,
                    "InvoiceValue" => round($value * $factor = $this->resolveFactor($currency)) / $factor,
                    "DisplayCurrencyIso" => strtoupper($currency),
                    "CallBackUrl" => route('approval'),
                    "ErrorUrl" => route('cancelled'),
                    "Language" => "en",
                ],
                [],
                $isJsonRequest = true
            );
        } catch (Throwable $th) {

            if ($th->getResponse()) {
                $decodeResponse = json_decode($th->getResponse()->getBody()->getContents(), true);
                $ResponseErrors = data_get($decodeResponse , 'ValidationErrors', [['Error' => 'payment has error']] );
                $errors = collect($ResponseErrors)->pluck('Error')->toArray();

                throw new HttpResponseException($this->sendErrorData(['error' => $errors], data_get($errors, 0, 'payment has error')));
            }

            $message = 'payment has error';
            throw new HttpResponseException($this->sendErrorData(['error' => [$message]], $message));
        }

        return $req;
    }

    // handel the payment
    public function handlePayment(Request $request)
    {
        $name = $request->user()->name;
        $email = $request->user()->email;
        // create order
        $order = $this->sendPayment($name, $email, $request->value, $request->currency);

        if ($order->IsSuccess == true) {
            // get order links
            $orderLinks = collect($order->Data);
            // get approve link
            $approval_link = $orderLinks['InvoiceURL'];
            // put approve id in session
            session()->put('InvoiceId', $orderLinks['InvoiceId']);
            // redirect to the approve link
            return redirect($approval_link);
        }
        return redirect()->route('pay.form')->withErrors('We can not compelete the payment process, please try again');
    }

    // get payment status
    public function getPaymentStatus($invoice_id)
    {
        $keyId   = $invoice_id;
        $KeyType = 'PaymentId';
        return $this->makeRequest(
            'POST',
            '/v2/getPaymentStatus',
            [],
            [
                'Key'     => $keyId,
                'KeyType' => $KeyType
            ],
            [],
            $isJsonRequest = true
        );
    }

    // handle the approval of the payment
    public function handleApproval()
    {
        if (session()->has('InvoiceId')) {
            // get invoice id
            $InvoiceId = session()->get('InvoiceId');
            // get payment status
            $payment_status = $this->getPaymentStatus($InvoiceId);
            $payment = collect($payment_status->Data);

            if ($payment['InvoiceStatus'] == "Paid") {
                // buyer name
                $buyername = $payment['CustomerName'];
                // get amount and currency code
                $amount = $payment['InvoiceDisplayValue'];
                // date and time of the payment
                $date = Carbon::parse($payment['CreatedDate'])->format('d/m/Y h:i A');
                return redirect()->route('pay.form')->withSuccess(['payment' => "Thanks, {$buyername}. We received your {$amount} payment at {$date}."]);
            }

            return redirect()->route('pay.form')->withErrors('The payment process no compeleted, please try again');
        }
        return redirect()->route('pay.form')->withErrors('The payment process no compeleted, please try again');
    }
}