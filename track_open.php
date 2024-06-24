<?php
$config = require 'config.php';
// Google Analytics Measurement Protocol
$ga_tracking_id = $config['ga_tracking_id'];

// クライアントIDを生成または取得（ここでは簡単のため固定値を使用）
$client_id = '555.555';

// Google Analytics Measurement Protocol URL
$ga_url = "https://www.google-analytics.com/collect?v=1&tid=$ga_tracking_id&cid=$client_id&t=event&ec=email&ea=open&el=open&cs=newsletter&cm=email&cn=test_campaign";

// リクエストを送信
file_get_contents($ga_url);

// 1x1ピクセルの透明な画像を生成
header('Content-Type: image/gif');
echo base64_decode('R0lGODlhAQABAIAAAAAAAP///ywAAAAAAQABAAACAUwAOw==');
