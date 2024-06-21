<?php
$err_msg = "";
if (isset($_POST['send'])) {
    /*
     * ここからバリデーション
     */
    $email = $_POST['email'] ?? '';
    //入力されたメールアドレスの全角英数字を半角に変換
    $email = mb_convert_kana($email, 'as');
    //スペースが混ざってたら除去
    $email = str_replace(" ", "", $email);
    //メールアドレスの形式を正規表現で確認
    if (preg_match("/^[a-zA-Z0-9_+-]+(.[a-zA-Z0-9_+-]+)*@([a-zA-Z0-9][a-zA-Z0-9-]*[a-zA-Z0-9]*\.)+[a-zA-Z]{2,}$/", $email) !== 1) {
        $err_msg = "メールアドレスが正しくありません";
    }
    
    /*
     * ここまでにエラーがなければ(メールアドレスが正しければ)、Formspreeにデータを送る
     */
    if (!$err_msg) {
        unset($_POST['send']);
        $user_message = $_POST['user_message'] ?? '';
        $tracking_message = "Click the link below to track in Google Analytics: https://atsudora.github.io/poc-gamail/confirmation.html?utm_source=newsletter&utm_medium=email&utm_campaign=test_campaign";
        $combined_message = $user_message . "\n\n" . $tracking_message;
        
        $data = [
            'email' => $email,
            '_replyto' => $email,
            'message' => $combined_message,
            '_subject' => "Test Email for Google Analytics"
        ];
        
        $ch = curl_init();
        curl_setopt_array($ch, [
            CURLOPT_URL => 'https://formspree.io/f/xdknnalz',
            CURLOPT_POST => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POSTFIELDS => http_build_query($data),
            CURLOPT_HTTPHEADER => [
                'Accept: application/json'
            ],
        ]);

        //Formspreeに問題無くデータが送れた場合、jsonで情報が返却されるので、それをチェックして送信の成否を確認
        $send_result = json_decode(curl_exec($ch));
        curl_close($ch);
        if (empty($send_result->ok)) {
            $err_msg = "フォームが送信出来ませんでした。時間を置いて再度お試しください";
        } else {
            header("Location: ./complete.php");
            exit;
        }
    }
}
