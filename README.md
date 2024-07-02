## 概要
これは、HTMLメールのアクセス解析を検証するリポジトリです。

## デプロイ
Renderの無料枠でデプロイします。

## 調査内容
1. HTMLメールを経由していることの解析方法
HTMLメールに記載されたURLを踏んだ場合のアクセス解析は、
どの様な設定をして、どの様に解析できるのかの確認。

2. メールの開封確認方法
メールを開いたということを確認するためには、
どの様な設定をして、その結果はどの様に出力されるのかの確認。

## 調査結果

パラメータ | 必須 or 任意 | データ | 役割 | 入力例
---- | ----- | ---- | ---- | -----
utm_source | 必須 | 参照元 | 参照元を識別　| line, yahoo, facebook, arara_message
utm_medium | 必須 | メディア | 流入チャネルを識別 | email (注1)
utm_campaign | 必須 | キャンペーン名称 | 広告のキャンペーンやプロモーション名など | 任意の文字
utm_term | 任意 | キーワード | 広告の流入キーワード | 指定のキーワード
utm_content | 任意 | 広告コンテンツ | 広告の種類を識別 | bannerA, banner1

注1）utm_medium は Google によって以下の様に定められている。
用語 | 意味
---- | ----
Organic Search | Googleのような検索サイトからの流入
Direct | 直接URLを入力した訪問
Referral | 他のWebサイトのリンクからの流入
Social | TwitterやFacebookなどのSNSからの流入
Paid Search | リスティング広告からの流入
Display | バナー広告（画像や動画など）からの流入
email | メール内のリンクからの訪問
Other Advertising | リスティング・ディスプレイ以外からの広告流入
Affiriate | アフィリエイトサイトからの訪問


## 参考リンク
- [[GA4] URL 生成ツール: カスタム URL でキャンペーン データを収集する](https://support.google.com/analytics/answer/10917952#cc-set-up&zippy=%2C%E3%81%93%E3%81%AE%E8%A8%98%E4%BA%8B%E3%81%AE%E5%86%85%E5%AE%B9)

## Googleタグマネージャ
1. このコードは、次のようにページの <head> 内のなるべく上のほうに貼り付けてください。

```
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-5SWDS4L3');</script>
<!-- End Google Tag Manager -->
```

2. 開始タグ <body> の直後にこのコードを次のように貼り付けてください。

```
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5SWDS4L3"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
```