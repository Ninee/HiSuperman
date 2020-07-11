<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="/h5/css/base.css">
    <link rel="stylesheet" href="/h5/css/weui.css">
    <link rel="stylesheet" href="/h5/css/weuix.css">
    <link rel="stylesheet" href="/h5/css/app.css">
    @yield('css')
    <!-- <script src="js/main.js"></script> -->
    <script>
        var _hmt = _hmt || [];
        (function() {
            var hm = document.createElement("script");
            hm.src = "https://hm.baidu.com/hm.js?feebc866f5e48370dfa23b10b3543c5a";
            var s = document.getElementsByTagName("script")[0];
            s.parentNode.insertBefore(hm, s);
        })();
    </script>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-172398707-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-172398707-1');
    </script>
    <script src="/h5/js/zepto.min.js"></script>
    <script src="/h5/js/zepto.weui.min.js"></script>
    <script src="/h5/js/tools.js"></script>
    <script src="/h5/js/iscroll-lite.min.js"></script>
    <script src="/h5/js/clipboard.min.js"></script>
    <script src="https://res.wx.qq.com/open/js/jweixin-1.4.0.js" type="text/javascript" charset="utf-8"></script>
    @yield('js')
    @yield('style')
</head>

<body>
    @yield('content')
</body>

</html>