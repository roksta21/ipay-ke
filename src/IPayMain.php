<?php

namespace Roksta\IPay;

class IPayMain
{
    protected $url = 'https://apis.ipayafrica.com/payments/v2/transact';

    public $order_id, $amount, $phone_number, $email, $p1, $p2, $p3, $p4, $config;

    public function __construct()
    {
        $this->p1 = 1;
        $this->p2 = 2;
        $this->p3 = 3;
        $this->p4 = 4;
        $this->config = config('ipay');
    }

    public static function ready()
    {
        return new self;
    }

    public function orderId($id)
    {
        $this->order_id = $id;

        return $this;
    }

    public function amount($amount)
    {
        $this->amount = $amount;

        return $this;
    }

    public function customer($phone_number, $email)
    {
        $this->phone_number = $phone_number;
        $this->email = $email;

        return $this;
    }

    public function custom($one = 1, $two = 2, $three = 3, $four = 4)
    {
        $this->p1 = $one;
        $this->p2 = $two;
        $this->p3 = $three;
        $this->p4 = $four;

        return $this;
    }

    protected function generateHash($channel)
    {
        $data_string = $this->config['env'] == 'live' ? 1 : 0;
        $data_string .= $this->order_id;
        $data_string .= $this->order_id;
        $data_string .= $this->amount;
        $data_string .= $this->phone_number;
        $data_string .= $this->email;
        $data_string .= $this->config['vendor_id'];
        $data_string .= $this->config['currency'];
        $data_string .= $this->p1;
        $data_string .= $this->p2;
        $data_string .= $this->p3;
        $data_string .= $this->p4;
        $data_string .= $this->config['email_customer'];
        $data_string .= $channel == 'mobile' ? $this->config['mobile_callback_url'] : $this->config['card_callback_url'];

        return hash_hmac('sha256', $data_string , $this->config['secret_key']);
    }

    public function initiate()
    {
        $form_data = [
            "live"=> $this->config['env'] == 'live' ? 1 : 0,
            "oid"=> $this->order_id,
            "inv"=> $this->order_id,
            "amount"=> $this->amount,
            "tel"=> $this->phone_number,
            "eml"=> $this->email,
            "vid"=> $this->config['vendor_id'],
            "curr"=> $this->config['currency'],
            "p1"=> $this->p1,
            "p2"=> $this->p2,
            "p3"=> $this->p3,
            "p4"=> $this->p4,
            "cbk"=> $this->config['mobile_callback_url'],
            "cst"=> $this->config['email_customer'],
            "crl"=> 0,
            'hash' => $this->generateHash('mobile')
        ];

        $curl = curl_init();

        curl_setopt($curl, CURLOPT_URL, $this->url);

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

        curl_setopt($curl, CURLOPT_POSTFIELDS, $form_data);

        $response = json_decode(curl_exec($curl));

        curl_close($curl);

        return $response;
    }

    public function generateForm($button = 'Pay', $style = '')
    {
        $form_data = [
            "live"=> $this->config['env'] == 'live' ? 1 : 0,
            "oid"=> $this->order_id,
            "inv"=> $this->order_id,
            "ttl"=> $this->amount,
            "tel"=> $this->phone_number,
            "eml"=> $this->email,
            "vid"=> $this->config['vendor_id'],
            "curr"=> $this->config['currency'],
            "p1"=> $this->p1,
            "p2"=> $this->p2,
            "p3"=> $this->p3,
            "p4"=> $this->p4,
            "cbk"=> $this->config['card_callback_url'],
            "cst"=> $this->config['email_customer'],
            "crl"=> 0
        ];

        $html = '<form action="https://payments.ipayafrica.com/v3/ke">';
        
        foreach ($form_data as $key => $value) {
            $html .= "<input name='$key' type='hidden' value='$value'>";
        }

        $html .= "<input name='hsh' type='hidden' value='" . $this->generateHash('card') . "'>";
        $html .= "<button class='$style'>$button</button>";
        $html .= '</form>';

        return $html;
    }
}