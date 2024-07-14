<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Dotenv\Dotenv;

require 'vendor/autoload.php';

// 環境がlocalの場合のみ .env ファイルを読み込む
if (getenv('APP_ENV') === 'local') {
    $dotenv = Dotenv::createImmutable(__DIR__);
    $dotenv->load();
}

// config.php を読み込む
$config = require 'config.php';

$err_msg = "";
if (isset($_POST['send'])) {
    /*
     * ここからバリデーション
     */
    $email = $_POST['email'] ?? '';
    $user_message = $_POST['user_message'] ?? '';
    $custom = $_POST['custom'] ?? '';
    $utm_source = $_POST['utm_source'] ?? 'newsletter';
    $utm_medium = $_POST['utm_medium'] ?? 'email';
    $utm_campaign = $_POST['utm_campaign'] ?? 'test_campaign';

    // 入力されたメールアドレスの全角英数字を半角に変換
    $email = mb_convert_kana($email, 'as');
    // スペースが混ざってたら除去
    $email = str_replace(" ", "", $email);
    // メールアドレスの形式を正規表現で確認
    if (preg_match("/^[a-zA-Z0-9_+-]+(.[a-zA-Z0-9_+-]+)*@([a-zA-Z0-9][a-zA-Z0-9-]*[a-zA-Z0-9]*\.)+[a-zA-Z]{2,}$/", $email) !== 1) {
        $err_msg = "メールアドレスが正しくありません";
    }

    /*
     * ここまでにエラーがなければ(メールアドレスが正しければ)、メールを送信
     */
    if (!$err_msg) {
        $mail = new PHPMailer(true);

        try {
            // サーバー設定
            $mail->isSMTP();
            $mail->Host = $config['smtp']['host'];
            $mail->SMTPAuth = true;
            $mail->Username = $config['smtp']['username'];
            $mail->Password = $config['smtp']['password'];
            $mail->SMTPSecure = $config['smtp']['encryption'];
            $mail->Port = $config['smtp']['port'];

            // 受信者
            $mail->setFrom($config['email']['from'], $config['email']['from_name']);
            $mail->addAddress($email); // 送信先アドレス

            // コンテンツ
            $mail->isHTML(true);
            $mail->Subject = $config['email']['subject'];
            $tracking_pixel_url = $config['email']['pixel_tracking_url'] . '?custom=' . urlencode($custom);
            $tracking_pixel = "<img src='$tracking_pixel_url' alt='tracking pixel' style='display:none;'>";
            $utm_parameters = "utm_source=$utm_source&utm_medium=$utm_medium&utm_campaign=$utm_campaign";
            $message = "<p>$user_message</p>";
            $message .= "<p>Click the link below to track in Google Analytics:</p>";
            $message .= "<p><a href='{$config['email']['google_analytics_url']}?$utm_parameters'>Track in Google Analytics</a></p>";
            $message .= $tracking_pixel;
            $mail->Body = $message;

            $mail->send();
            echo 'メールが送信されました';
        } catch (Exception $e) {
            $err_msg = "メールの送信に失敗しました。 Mailer Error: {$mail->ErrorInfo}";
        }
    }
}
if ($err_msg) {
    echo $err_msg;
}
