<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\SettingsKey;
use Illuminate\Http\Request;
use Illuminate\View\View;

class OrderController extends Controller
{

    public function paymentResult(): View
    {
        $view = 'error';
        $message = '';
        if(request()->has('orderId')){
            $response = alphaService()->gateway(
                config('alpha.orderStatusDo'),
                alphaService()->getIsPaymentSuccessData(request()->get('orderId'))
            );
            if($this->isDataExists($response)){
                $this->updateOrder($response);
                $message = $this->getSetting($response['orderStatus']);
                if($this->isPaymentSuccess($response['orderStatus'])){
                    $view = 'success';
                }
            }
        }        
        return view('order.'.$view, compact('message'));
    }

    private function isDataExists(array $response): bool
    {
        return isset($response['orderNumber']) 
                && isset($response['errorCode']) 
                && isset($response['orderStatus'])
                && isset($response['actionCodeDescription']);
    }

    private function updateOrder(array $response): void
    {
        $order = Order::find($response['orderNumber']);
        if($order){
            $order->update([
                'payment_status' => (int)$response['orderStatus'],
                'payment_error' => (int)$response['errorCode'],
                'payment_action_description' => $response['actionCodeDescription'],
            ]);
        }
    }

    private function getSetting(int $orderStatus): string
    {
        return SettingsKey::whereSlug('order')
            ->first()
            ->settings()
            ->whereSlug($this->isPaymentSuccess($orderStatus) ? 'created' : 'not-created')
            ->first()
            ->value;
    }

    private function isPaymentSuccess(int $orderStatus): bool
    {
        return $orderStatus == 2;
    }
}
