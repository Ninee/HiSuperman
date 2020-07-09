<!DOCTYPE html>
<html lang="zh-cmn-Hans">
<head>
    <title></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
    <script src="{{ asset('js/jQuery.js') }}"></script>
    <script src="https://cdn.bootcss.com/html2canvas/0.5.0-beta4/html2canvas.min.js"></script>
    <style>
        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }
        html,
        body {
            max-width: 100%;
            background-color: #0b0b0b;
        }
        #cBox {
            background-color: white;
            width: 750px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            box-sizing: border-box;
            height: 100px;
            line-height: 100px;
            margin: 10px 0;
        }
        .header .name {
            font-weight: bold;
            font-size: 40px;
            color: #144482;
            float: left;
        }
        .header .logo {
            width: 100px;
            float: right;
        }
        .wide-line {
            width: 100%;
            height: 6px;
            background-color: #144482;
        }
        .thin-line {
            margin-bottom: 4px;
            width: 100%;
            height: 2px;
            background-color: #144482;
        }
        .img {
            width: 100%;
            height: auto;
        }
        .text {
            border: 1px solid #144482;
            width: 100%;
            min-height: 400px;
            margin: 20px 0;
            padding: 55px;
            box-sizing: border-box;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .text .content {
            width: 600px;
            color: #144482;
            font-weight: bold;
            font-size: 20px;
        }
        .footer {
            margin-top: 20px;
            box-sizing: border-box;
            background-color: #144482;
            color: white;
            height: 120px;
            display: flex;
            justify-content: flex-start;
            align-items: center;
        }
        .footer .tips {
            text-align: center;
            font-size: 40px;
            width: 420px;
            display: inline-block;
        }
        .footer .qrcode {
            margin-left: 100px;
            width: 100px;
            height: 100px;
            display: inline-block;
        }
        #saveImg {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            opacity: 0;
            z-index: 9999;
        }

    </style>
</head>
<body>
<div id="box">
    <div id="cBox">
        <div class="header">
            <div class="name">海外超人</div>
            <img class="logo" src="{{asset('images/logo.png')}}" alt="">
        </div>
        <div class="thin-line"></div>
        <div class="wide-line"></div>
        <div class="text">
            <div class="content">{!! $info->content !!} </div>
        </div>
        @if($info->pictures)
            @foreach($info->pictures as $picture)
                <img class="img" src="{{ Storage::disk('admin')->url($picture) }}" alt="">
            @endforeach
        @endif
        <div class="thin-line"></div>
        <div class="wide-line"></div>
        <div class="footer">
            <div class="tips">
                长按扫码<br>
                获取更多闲置资讯
            </div>
            <img class="qrcode" src="data:image/png;base64,{!! $qrcode !!}" alt="">
        </div>
    </div>
    <img id="saveImg" alt="">
</div>
<script type="text/javascript">
    $(function () {
        var box = document.getElementById("box");
        var el = document.getElementById("cBox");
        var saveImg = document.getElementById("saveImg");
        var canvas = document.createElement("canvas");
        var scale = window.devicePixelRatio;
        var ctx=canvas.getContext("2d");
        var rect = el.getBoundingClientRect();  //获取元素相对于视察的偏移量
        var w = el.offsetWidth;
        var h = el.offsetHeight;
        canvas.width = w * scale;
        canvas.height = h * scale;
        canvas.style.width = w ;
        canvas.style.height = h ;
        ctx.scale(scale, scale);
        ctx.translate(-rect.left,-rect.top);    //设置context位置，值为相对于视窗的偏移量负值，让图片复位
        html2canvas(el, {
            scale: scale,
            canvas: canvas,
            width: w,
            height: h,
            logging: false,
            background: "#f2f2f2",
            useCORS: true
        }).then(function (canvas) {
            var dataUrl = canvas.toDataURL("jpeg");
            saveImg.src=dataUrl;
        });
    });

</script>
</body>
</html>