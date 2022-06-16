<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"><!--IEブラウザ対策-->
    <meta name="viewport" content="width=device-width,initial-scale=1"><!--スマホ,タブレット対応-->
    <!-- ページタイトル -->
    @hasSection('title')
    <title>@yield('title') | DAWN SNS</title>
    @else
    <title>DAWN SNS</title>
    @endif
    <!-- ページ説明 -->
    @hasSection('description')
    <meta name="description" itemprop="description" content="@yield('description')">
    @else
    <meta name="description" itemprop="description" content="DAWN SNSは企業向けのオンラインコミュニケーションツールです。">
    @endif
    <!--サイトのアイコン指定-->
    <link rel="icon" href="" sizes="16x16" type="image/png"><!-- 画像URLを入れる -->
    <link rel="icon" href="" sizes="32x32" type="image/png"><!-- 画像URLを入れる -->
    <link rel="icon" href="" sizes="48x48" type="image/png"><!-- 画像URLを入れる -->
    <link rel="icon" href="" sizes="62x62" type="image/png"><!-- 画像URLを入れる -->
    <!-- iphoneのアプリアイコン指定 -->
    <link rel="apple-touch-icon-precomposed" href=""><!-- 画像URLを入れる -->
    <!-- OGPタグ -->
    <meta property="og:image" content=""><!-- 画像URLを入れる -->
    <meta property="og:image:alt" content="/img/ogp.png"><!-- 画像URLを入れる -->
    <meta property="og:url" content="<?php echo (empty($_SERVER["HTTPS"]) ? "http://" : "https://") . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]; ?>">
    <meta property="og:site_name" content="DAWN">
    <meta property="og:locale" content="ja_JP">
    <!-- クローラー -->
    @hasSection('noindex')
    <meta name="robots" content="noindex,nofollow">
    @endif
    <!-- スタイルシート -->
    <link rel="stylesheet" href="/css/format.css">
    <link rel="stylesheet" href="/css/style.css">
    <!-- Javascript -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript" src="/js/common.js"></script>
</head>

<body>
    <header>
        <div class="container">
            <div class="logo-area">
                <a href="/top"><img src="/images/main_logo.png"></a>
            </div>
            <div class="login-user-area" id="menu">
                <div class="login-user-info">
                    <div class="user-name-area">
                        <span class="user-name">{{ $auth["name"] }}さん</span>
                    </div>
                    <div class="arrow-01" id="userMenuArrow"><div class="arrow close"></div></div>
                    <div class="user-icon"><img src="{{ $imageURL }}"></div>
                </div>
            </div>
        </div>
    </header>
    <div class="wrapper" id="mainContent">
        <div class="container">
            <nav class="user-menu">
                <ul>
                    <li><a href="/top">HOME</a></li>
                    <li><a href="/profile">プロフィール編集</a></li>
                    <li><a href="/logout">ログアウト</a></li>
                </ul>
            </nav>
            <div class="content-area">
                @yield('content')
            </div>
            <div id="sideBar">
                <div class="container">
                    <div class="inner-container">
                        <div class="label"><span class="user-name">{{ $auth["name"] }}さんの</div>
                    </div>
                    <div class="inner-container">
                        <div class="row">
                            <div class="label">フォロー数</div>
                            <div class="value-display">{{ $followCount }}名</div>
                        </div>
                        <a class="btn" href="/follow-list">フォローリスト</a>
                        <div class="row">
                            <div class="label">フォロワー数</div>
                            <div class="value-display">{{ $followerCount }}名</div>
                        </div>
                        <a class="btn" href="/follower-list">フォロワーリスト</a>
                    </div>
                    <hr class="lightgray-w1">
                    <div class="inner-container">
                        <a class="btn" href="/search">ユーザー検索</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
