<?php

namespace App\Services;

use App\Models\Order;


class AlphaService
{

    public function gateway($method, $data) {
        $curl = curl_init();   
        curl_setopt_array($curl, array(
            CURLOPT_URL => $method, //   
            CURLOPT_RETURNTRANSFER => true, //  
            CURLOPT_POST => true, //  POST
            CURLOPT_POSTFIELDS => http_build_query($data) //   
        ));
        $response = curl_exec($curl); //  
        
        $response = json_decode($response, true); //   JSON  
        curl_close($curl); //  
        return $response; //  
    }

    public function getRegisterData(Order $order): array
    {
        return  [
            'userName' => config('alpha.login'),
            'password' => config('alpha.password'),
            'orderNumber' => urlencode($order->id), 
            'amount' => urlencode($order->price + $order->delivery->getWithDiscount($order->price)),
            'returnUrl' => config('alpha.returnUrl')
        ];
    }

    public function getIsPaymentSuccessData(string $orderId): array
    {
        return  [
            'userName' => config('alpha.login'),
            'password' => config('alpha.password'),
            'orderId' => $orderId,
            'amount' => 0
        ];
    }

    // if ($_SERVER['REQUEST_METHOD'] == 'GET' && !isset($_GET['orderId'])) {
    //     echo '
    //         <form method="post" action="/rest.php">
    //             <label>Order number</label><br />
    //             <input type="text" name="orderNumber" /><br />
    //             <label>Amount</label><br />
    //             <input type="text" name="amount" /><br />
    //             <button type="submit">Submit</button>
    //         </form>
    //     ';
    // } else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //     $data = array(
    //         'userName' => USERNAME,
    //         'password' => PASSWORD,
    //         'orderNumber' => urlencode($_POST['orderNumber']), 
    //         'amount' => urlencode($_POST['amount']),
    //         'returnUrl' => RETURN_URL
    //     );

    //     $response = gateway('register.do', $data);
    // //    $response = gateway('registerPreAuth.do', $data);
        
    //     if (isset($response['errorCode'])) { //     
    //         echo ' #' . $response['errorCode'] . ': ' . $response['errorMessage'];
    //     } else { //        
    //         header('Location: ' . $response['formUrl']);
    //         die();
    //     }
    // } else if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['orderId'])){
    //     $data = array(
    //         'userName' => USERNAME,
    //         'password' => PASSWORD,
    //         'orderId' => $_GET['orderId']
    //     );
        
        
    //     $response = gateway('getOrderStatusExtended.do', $data);
        
    //     //      
    //     echo '
    //         <b>Error code:</b> ' . $response['ErrorCode'] . '<br />
    //         <b>Order status:</b> ' . $response['OrderStatus'] . '<br />
    //         ';
    // }

}