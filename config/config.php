<?php
/**
 * This file is part of Notadd.
 *
 * @author        aen233<zhanghe@ibenchu.com>
 * @copyright (c) 2017, notadd.com
 * @datetime      2017-07-31 23:04
 */
return [

    // HTTP 请求的超时时间（秒）
    'timeout' => 5.0,

    // 默认发送配置
    'default' => [
        // 网关调用策略，默认：顺序调用
        'strategy' => \Overtrue\EasySms\Strategies\OrderStrategy::class,

        // 默认可用的发送网关
        'gateways' => [
            'aliyun',
            'alidayu',
            'yunpian',

        ],
    ],
    // 可用的网关配置
    'gateways' => [
        'errorlog' => [
            'file' => '/tmp/easy-sms.log',
        ],
        'aliyun' => [
            'access_key_id' => 'LTAIgzlakVb0DZd3',
            'access_key_secret' => 'PUoTmKqpGfkzSWHF4tIqjq6z3Vam8o',
            'sign_name' => '中农微信采供系统',
        ],
        'alidayu' => [
            'app_key' => 'LTAIgzlakVb0DZd3',
            'app_secret' => 'PUoTmKqpGfkzSWHF4tIqjq6z3Vam8o',
            'sign_name' => '中农微信采供系统',
        ],
        'yunpian' => [
            'api_key' => 'd259c1a6ad15fc1e081568374a3c0887',
        ],
    ],

];
