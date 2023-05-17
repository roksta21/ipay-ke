# iPay Kenya Intergration

This package is designed for use with Laravel.

#### Installation

```bash
composer require roksta/ipay-ke
```

#### Configuration

Publish config file to set iPay options.

```bash
php artisan vendor:publish --provider="Roksta\IPay\Providers\IPayServiceProvider"
```

#### Use

Set your environment variables in your .env file

```
IPAY_ENV=live or sandbox
IPAY_SECRET_KEY="your_ipay_secret_key"
IPAY_VENDOR_ID="your_ipay_vendor_id"
IPAY_MOBILE_CALLBACK_URL="https://yoursite.com/callback-url"
IPAY_CARD_CALLBACK_URL="https://yoursite.com/callback-url"
```

#### Initialize iPay

```php
$ipay = IPay::orderId(1234)
          ->amount(1)
          ->customer($phone_number, $email);

$response = $ipay->initiate();
```

* Note, phone numer and email cannot be null.



#### Mobile STK Push
```php
$stk_response = Ipay::stk('network')->push($phone_number, $response->data->sid);
```
* Note: network options and sid are contained within the $response object

#### Generate Pay with iPay button
```php
$ipay->generateForm('button_text', 'button_class')
```
* button_text refers to the text diplayed in the button, eg, Pay With IPay
* button_class refers to which classes to be applied to the button, eg 'btn btn-primary'

### Licence
The package is provided under the MIT License.