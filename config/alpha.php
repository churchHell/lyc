<?php

return [

    'login' => env('ALPHA_LOGIN'),
    'password' => env('ALPHA_PASSWORD'),
    'registerDo' => 'https://web.rbsuat.com/ab_by/rest/register.do',
    'depositDo' => 'https://web.rbsuat.com/ab_by/rest/deposit.do',
    'orderStatusDo' => 'https://web.rbsuat.com/ab_by/rest/getOrderStatusExtended.do',
    'returnUrl' => env('APP_URL').'/order/paymentResult'

];