@extends('mobile.layout.base')
@section('title')
分享
@endsection

@section('js')
    <script src="{{ asset('js/jQuery.js') }}"></script>
    <script src="http://supercdn.lzhnb.com/html2canvas.min.js"></script>
@endsection

@section('style')
    <style>
        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }
        html,
        body {
            max-width: 100%;
            background-color: white;
        }
        .view {
            display: flex;
            flex-direction: column;
            flex-wrap: nowrap;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.5);;
        }
        .share-tips {
            border: 1px dashed white;
            width: 90%;
            margin: 10px auto;
            text-align: center;
            color: white;
            line-height: 2rem;
        }
        #box {
            overflow-y: scroll;
        }
        #cBox {
            background-color: white;
            width: 90%;
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
            font-size: 2rem;
            color: #144482;
            float: left;
        }
        .header .logo {
            width: 4rem;
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
            min-height: 200px;
            margin: 20px 0;
            padding: 0.5rem;
            box-sizing: border-box;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .text .content {
            width: 90%;
            color: #144482;
            font-weight: bold;
            font-size: 1rem;
        }
        .footer {
            margin-top: 20px;
            box-sizing: border-box;
            background-color: #144482;
            color: white;
            height: 3rem;
            display: flex;
            justify-content: space-around;
            align-items: center;
        }
        .footer .tips {
            text-align: center;
            font-size: 0.8rem;
        }
        .footer .qrcode {
            width: 2.5rem;
        }
        #saveImg {
            position: absolute;
            margin: 0 5%;
            top: 5rem;
            width: 90%;
            opacity: 1;
            z-index: 9999;
        }

    </style>
@endsection

@section('content')
<div class="view">
    <div class="weui-header bg-blue navigator">
        <div id="back-btn" class="weui-header-left"> <a class="icon icon-109 f-white">返回</a>  </div>
        <h1 class="weui-header-title">分享</h1>
    </div>
    <div class="share-tips">长按图片可发送给好友或保存图片分享朋友圈</div>
    <div id="box">
        <div id="cBox">
            <div class="header">
                <div class="name">海外超人</div>
                <img class="logo" src="{{asset('images/logo.png')}}" alt="">
            </div>
            <div class="thin-line"></div>
            <div class="wide-line"></div>
            <div class="text">
                <div class="content">{!! nl2br($info->content) !!} </div>
            </div>
            @if($info->pictures)
                @foreach($info->pictures as $picture)
                    <img class="img" src="{{ $picture }}" alt="">
                @endforeach
            @endif
            <div class="thin-line"></div>
            <div class="wide-line"></div>
            <div class="footer">
                <div class="tips">
                    长按扫码<br>
                    获取更多{{$category->name}}资讯
                </div>
                <img class="qrcode" src="data:image/png;base64,{!! $qrcode !!}" alt="">
            </div>
        </div>
        <img id="saveImg" alt="">
    </div>
</div>
    <script type="text/javascript">
        $(function () {
            var box = document.getElementById("box");
            var el = document.getElementById("cBox");
            var saveImg = document.getElementById("saveImg");
            var canvas = document.createElement("canvas");
//            var scale = window.devicePixelRatio;
            var scale = 4;
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

            $('#back-btn').on('click', function () {
                window.history.go(-1);
            })
        });

    </script>
</div>
@endsection