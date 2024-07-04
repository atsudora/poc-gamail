<?php
/**
 * GA4 Measurement Protocol APIを使用してメール開封イベントをトラッキングするスクリプト
 */

// GETパラメータからメールアドレスを取得
$user_name = isset($_GET['user_name']) ? $_GET['user_name'] : 'unknown';

$api_secret = $config['measurement_protocol']['api_secret'];
$measurement_id = $config['measurement_protocol']['ga_tracking_id'];
$client_id = ['measurement_protocol']['client_id'];

// Measurement Protocol APIのエンドポイント
$url = "https://www.google-analytics.com/mp/collect?api_secret=$api_secret&measurement_id=$measurement_id";

// トラッキングイベントのデータ
$data = [
    'client_id' => $client_id,
    'non_personalized_ads' => false,
    'events' => [
        [
            'name' => 'email_tracking',
            'params' => [
                'user_name' => $user_name,
                'items' => [],
                'action' => 'open'
            ]
        ]
    ]
];

// cURLセッションを初期化
$ch = curl_init($url);

// cURLのオプションを設定
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// リクエストを実行し、レスポンスを取得
$response = curl_exec($ch);

// エラーチェック
if(curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
} else {
    echo 'Success:' . $response;
}

// cURLセッションをクローズ
curl_close($ch);
