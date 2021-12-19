<?php

return [

    'login' => env('ALPHA_LOGIN'),
    'password' => env('ALPHA_PASSWORD'),
    'registerDo' => 'https://web.rbsuat.com/ab_by/rest/register.do',
    'depositDo' => 'https://web.rbsuat.com/ab_by/rest/deposit.do',
    'successUrl' => env('APP_URL').'/order/success',
    'errorUrl' => env('APP_URL').'/order/error',

];