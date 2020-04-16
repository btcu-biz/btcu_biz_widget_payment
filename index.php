<?php

include_once 'btcu_client.php';

/**
 * НАСТРОЙКИ НАЧАЛО
 */

$is_text = true;
$amount   = 500; // сумма в гривнах
$order_id = (string)substr(mt_rand(1,999999), 0, 6); // номер заказа в Вашем магазине
$currency = 'uah'; // валюта

/**
 * НАСТРОЙКИ КОНЕЦ
 */

$client = new btcu_client($is_text);
$post = json_decode(file_get_contents('php://input'), true)['params'];

if (isset($post['amount'],$post['currency'],$post['order_id'],$post['selected']))
{
   $response = $client->check($post['amount'], $post['currency'], $post['selected'], (string)$post['order_id']);

   //
   // Пример ответа на запрос
   //
   // response
   // [
   //  amount            => "0.00524449"
   //  order_id          => "ch_2uJ2C4PJeEfFt4r4moHXETAfgGdL6"
   //  payment_request   => "lntb5244490n1pw0ur76pp55w7fzscpdlrw53jkah9hznt25wp4tk9vncjmdred0mfq69r4nzeqdqgw3jhxap3cqp5ertj3c9n28ls0z3m86q79qmggqq9zgfr2hhufum9fcpru6yt3x8kd7as0z3kady8w8pgtan36fdqexjwnwzxnjrmwvfwqkv0pgqlkrgp9kftkp"
   //  qr                => "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"
   //  status            => 0
   // ];
   //

   die($response);
}

if (isset($post['amount'],$post['currency']) && !isset($post['order_id'],$post['selected']))
{
   $response = $client->currency($post['amount'],$post['currency']);

   //
   // Пример ответа на запрос
   //
   // response
   // [
   //   'btc' => "0.00524449",
   // ];
   //

   die($response);
}

if (isset($post['order_id']) && !isset($post['amount'],$post['currency']))
{
   $response = $client->checkPayment((string)$post['order_id']);

   //
   // Пример ответа на запрос
   //
   // response
   // [
   //   'status' => 2,
   // ];
   //

   die($response);
}

include 'simple.view.php';
