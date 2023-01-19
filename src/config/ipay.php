<?php

return [
  'env' => env('IPAY_ENV', 'demo'),
  'vendor_id' => env('IPAY_VENDOR_ID', 'demo'),
  'secret_key' => env('IPAY_SECRET_KEY', 'demoCHANGED'),
  'currency' => env('IPAY_CURRENCY', 'KES'),
  'mobile_callback_url' => env('IPAY_MOBILE_CALLBACK_URL', 'https://yoursite.com/callback-url'),
  'card_callback_url' => env('IPAY_CARD_CALLBACK_URL', 'https://yoursite.com/callback-url'),
  'email_customer' => env('IPAY_EMAIL_CUSTOMER', 1)
];