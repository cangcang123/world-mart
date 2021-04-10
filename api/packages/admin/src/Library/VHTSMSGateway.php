<?php
/**
 * Created by Kinh Luan.
 * Date: 10/17/2019
 * Time: 10:24 AM
 */

namespace SHOP\Admin\Library;

/**
 * Class VHTSMSGateway
 * @package SHOP\Admin\Library
 */
class VHTSMSGateway
{

    private $is_proxy = FALSE;
    private $apiKey = '';
    private $apiSecret = '';
    private $brandName = '';
    private $alphaSMS = '';
    private $user_agent = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko)';

    private $proxy = NULL;

    public function __construct()
    {
        if (env('APP_ENV') == 'production') $this->is_proxy = TRUE;
        if ($this->is_proxy) $this->proxy = env('PROXY_URL', 'http://10.30.46.99:3128');
    }

    /**
     * @param $id
     * @param $phone
     * @param $content
     * @return bool|mixed|string
     */
    public function sendSMS($id, $phone, $content)
    {
        $url = 'http://sms3.vht.com.vn/ccsms/Sms/SMSService.svc/ccsms/json';
        $params = [
            'submission' => [
                'api_key' => $this->apiKey,
                'api_secret' => $this->apiSecret,
                'sms' => [
                    [
                        'id' => $id,
                        'brandname' => $this->brandName,
                        'text' => $content,
                        'to' => $phone
                    ]
                ]
            ]
        ];

//        return [
//            "response" => [
//                "submission" => [
//                    "sms" => [
//                        [
//                            "id" => "1682e77d-cd98-4706-8c89-bb5a06bcec13",
//                            "status" => "0"
//                        ]
//                    ]
//                ]
//            ]
//        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params));
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        if ($this->is_proxy) {
            curl_setopt($ch, CURLOPT_PROXY, $this->proxy);
        }
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_USERAGENT, $this->user_agent);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 3);
        curl_setopt($ch, CURLOPT_TIMEOUT, 20);
        $response = curl_exec($ch);
        curl_close($ch);
        if ($response) {
            $response = json_decode($response, TRUE, 512, JSON_BIGINT_AS_STRING);
            return $response;
        } else {
            return FALSE;
        }
    }

}