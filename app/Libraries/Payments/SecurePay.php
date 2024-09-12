<?php

namespace App\Libraries\Payments;

/**
 * SecurePay Library
 */
class SecurePay
{

    var $uid = '2690a3ef-acbc-449e-aae0-7ce58aedcc07';
    var $checksum_token = '635c0154e352c2627ce34655a86a6a0d9c51131fe4b9a67ffb2fa49f1a0ba694';
    var $auth_token = 'LM1xUk1-QJb6XNiCzFwH';
    var $url = '';

    function __construct( $environment = 'sandbox') {
        if ($environment == 'sandbox') {
            $this->url = 'https://sandbox.securepay.my/api/v1/payments';
        } else {
            $this->url = 'https://securepay.my/api/v1/payments';
        }
    }

    // website.com/checkout/redirect/securepay

    function go($payment_data) {

        $product_description = 'Bayaran untuk '.$payment_data['order_no'];

        $string = $payment_data['email']."|".
            $payment_data['nama_penuh']."|".
            $payment_data['nombor_telefon']."|".
            $payment_data['callback_url']."|".
            $payment_data['order_no']."|".
            $product_description."|".
            $payment_data['redirect_url'] ."|".
            $payment_data['total_amount']."|".
            $this->uid;

        $sign = hash_hmac('sha256', $string, $this->checksum_token);

        $post_data = "buyer_name=".urlencode($payment_data['nama_penuh'])."&token=". urlencode($this->auth_token) 
        ."&callback_url=".urlencode($payment_data['callback_url'])."&redirect_url=". urlencode($payment_data['redirect_url']) . 
        "&order_number=".urlencode($payment_data['order_no'])."&buyer_email=".urlencode($payment_data['email']).
        "&buyer_phone=".urlencode($payment_data['nombor_telefon'])."&transaction_amount=".urlencode($payment_data['total_amount']).
        "&product_description=".urlencode($product_description)."&redirect_post=".urlencode('true').
        "&checksum=".urlencode($sign);	
        
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $this->url);
        
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,$post_data);
        
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        
        curl_exec($ch);
        
        $output = curl_exec($ch);
        
        echo $output;

    }

    function verify() {
        extract($_POST);

        $string = $buyer_email.'|'.$buyer_name.'|'.$buyer_phone.'|'.$client_ip.'|'.$created_at.'|'.$created_at_unixtime.'|'.$currency.'|'.$exchange_number.'|'.$merchant_reference_number.'|'.$order_number.'|'.$params.'|'.$payment_id.'|'.$payment_method.'|'.$payment_status.'|'.$receipt_url.'|'.$retry_url.'|'.$source.'|'.$status_url.'|'.$transaction_amount.'|'.$transaction_amount_received.'|'.$uid;
        $sign = hash_hmac('sha256', $string, $this->checksum_token);

        return ($sign == $checksum);
    }
}