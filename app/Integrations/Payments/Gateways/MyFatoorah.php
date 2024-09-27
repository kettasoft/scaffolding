<?php

namespace App\Integrations\Payments\Gateways;

use App\Integrations\Payments\PaymentGateway;
use Throwable;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Modules\Support\Traits\ApiTrait;
use Illuminate\Http\Exceptions\HttpResponseException;

class MyFatoorah extends PaymentGateway
{
    use ApiTrait;

    protected string $baseUri;
    protected string $app_key;

    protected string $callback;

    protected string $error_url;

    public function __construct(?string $callback = null, ?string $error_url = null)
    {
        $this->baseUri = config('payments.myfatoorah.uri');
        $this->app_key = config('payments.myfatoorah.app_key');
        $this->app_key = config('payments.myfatoorah.app_key');
        $this->callback = $callback ?? config('payments.myfatoorah.callback');
        $this->error_url = $error_url ?? config('payments.myfatoorah.error_url');
    }

    // create the access token
    public function resolveAccessToken(): string
    {
        return "Bearer {$this->app_key}";
    }

    // to decode the response of the sent request
    public function decodeResponse($response): mixed
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
                    "CallBackUrl" => $this->callback,
                    "ErrorUrl" => $this->error_url,
                    "Language" => "en",
                ],
                [],
                $isJsonRequest = true
            );
        } catch (Throwable $th) {

            if ($th->getResponse()) {
                $decodeResponse = json_decode($th->getResponse()->getBody()->getContents(), true);
                $ResponseErrors = data_get($decodeResponse, 'ValidationErrors', [['Error' => 'payment has error']]);
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
