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
        }
        #cBox {
            width: 750px;
            margin: 0 auto;
        }
        .img {
            max-width: 100%;
            height: auto;
        }
        p {
            padding: 10px;
        }
        #saveImg {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            opacity: 0;
            z-index: 9999;
        }
        .text {
            width: 100%;
            position: relative;
        }
        .text .bg {
            width: 100%;
            height: auto;
        }
        .text .content {
            position:absolute;
            width: 80%;
            left:50%;
            top:50%;
            transform: translate(-50%, -50%);
        }

    </style>
</head>
<body>
<div id="box">
    <div id="cBox">
        <div class="text">
            <img class="bg" src="/images/poster_bg.jpeg" alt="">
            <div class="content">{!! $info->content !!} </div>
        </div>
        @if($info->pictures)
            @foreach($info->pictures as $picture)
                <img class="img" src="{{ Storage::disk('admin')->url($picture) }}" alt="">
            @endforeach
        @endif
    </div>
    <img id="saveImg" alt="">
</div>
<script type="text/javascript">
    //计算字体字数,设置字体大小
//    var text = $('.content').html();
//    var fontSize = 600 / text.length * 10;
//    $('.content').css('font-size', fontSize + 'px');
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