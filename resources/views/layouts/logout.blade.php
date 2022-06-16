<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <!--IEブラウザ対策-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content=""><!-- ページの内容を表す説明を入れる -->
    <title></title>
    <link rel="stylesheet" href="/css/format.css">
    <link rel="stylesheet" href="/css/logout.css">
    <!--スマホ,タブレット対応-->
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <!--サイトのアイコン指定-->
    <link rel="icon" href="" sizes="16x16" type="image/png"><!-- 画像URLを入れる -->
    <link rel="icon" href="" sizes="32x32" type="image/png"><!-- 画像URLを入れる -->
    <link rel="icon" href="" sizes="48x48" type="image/png"><!-- 画像URLを入れる -->
    <link rel="icon" href="" sizes="62x62" type="image/png"><!-- 画像URLを入れる -->
    <!--iphoneのアプリアイコン指定-->
    <link rel="apple-touch-icon-precomposed" href=""><!-- 画像URLを入れる -->
    <!--OGPタグ/twitterカード-->
</head>
<body>
    <div class="wrapper">
        <div class="container">
            <header>
                <h1><img src="images/main_logo.png" alt="DAWN SNSロゴ"></h1>
                <p>Social Network Service</p>
            </header>
            <div class="content-area">
                @yield('content')
            </div>
        </div>
    </div>
</body>
</html>