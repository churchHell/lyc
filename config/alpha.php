<?php

return [

    'login' => env('ALPHA_LOGIN'),
    'password' => env('ALPHA_PASSWORD'),
    'registerDo' => 'https://ecom.alfabank.by/payment/rest/register.do',
    // 'registerDo' => 'https://web.rbsuat.com/ab_by/rest/register.do',
    'depositDo' => 'https://ecom.alfabank.by/payment/rest/deposit.do',
    // 'depositDo' => 'https://web.rbsuat.com/ab_by/rest/deposit.do',
    'orderStatusDo' => 'https://ecom.alfabank.by/payment/rest/getOrderStatusExtended.do',
    // 'orderStatusDo' => 'https://web.rbsuat.com/ab_by/rest/getOrderStatusExtended.do',
    'returnUrl' => env('APP_URL').'/order/paymentResult'

];