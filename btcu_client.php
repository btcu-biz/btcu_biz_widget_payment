<?php

class btcu_client
{
    private $domain = 'btcu.biz';
    private $test_domain = 'dev.client.btcu.ddev.pw';

    private $test_mode;

    const CURRENCY_URL      = '/api/v1/widget/currencies';
    const CHECK_URL         = '/api/v1/widget/check';
    const CHECK_PAYMENT_URL = '/api/v1/widget/check/payment';

    const ALIAS             = 'BTCU_zF5ua'; // взять в профиле пользователя на сайте

    public function __construct($test_mode = true)
    {
        $this->test_mode = $test_mode;
    }

    private function getDomain($path)
    {
        if ($this->test_mode)
        {
            return 'https://'.$this->test_domain.$path;
        }

        return 'https://'.$this->domain.$path;
    }

    /**
     * Получить список курсов
     *
     * @param $amount
     * @param $currency
     * @return bool|string
     */
    public function currency ($amount, $currency) {
        $data = [
            'amount'   => $amount,
            'currency' => $currency
        ];
        return $this->request($this->getDomain(self::CURRENCY_URL), $data);
    }

    /**
     * Проверка возможности проведения платежа
     *
     * @param $amount
     * @param $currency
     * @param $selected
     * @param $order_id
     * @return bool|string
     */
    public function check ($amount, $currency, $selected, $order_id)
    {
        $data = [
            'amount'     => $amount,
            'currency'   => $currency,
            'selected'   => $selected,
            'order_id'   => $order_id
        ];
        return $this->request($this->getDomain(self::CHECK_URL), $data);
    }

    /**
     * Проверка статуса платежа
     *
     * @param $order_id
     * @return bool|string
     */
    public function checkPayment ($order_id)
    {
        $data = [
            'order_id'   => $order_id
        ];
        return $this->request($this->getDomain(self::CHECK_PAYMENT_URL), $data);
    }


    /**
     * Запрос
     *
     * @param $url
     * @param $data
     * @return bool|string
     */
    private function request($url, $data = [])
    {
        $data_string = json_encode(array_merge([
            'alias'=> self::ALIAS // добавляем к запросу алиас для обохначения принадлежности запроса к конкретному пользователю
        ], $data));
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data_string)]
        );
        $response = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        $_response = json_decode($response, true);
        if ($http_code !== 200 || (isset($_response) && array_key_exists('errors',$_response)))
        {
            http_response_code($http_code);
            die('Service Unavailable');
        }
        return $response;
    }
}
