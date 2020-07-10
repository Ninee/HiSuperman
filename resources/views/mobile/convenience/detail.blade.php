@extends('mobile.layout.base')
@section('title')
    详情
@endsection
@section('style')
    <style>
        .weui-tab-nav .weui-nav-green {
            display: block;
            -webkit-box-flex: 1;
            -webkit-flex: 1;
            flex: 1;
            width: 100%;
            height: 30px;
            padding: 0;
            font-size: 14px;
            line-height: 31px;
            text-align: center;
            border: 1px solid #10aeff;
            border-width: 1px 1px 1px 0;
            color: #10aeff;
            white-space: nowrap;
            background: #fdfdfd
        }

        .weui-tab-nav .weui-nav-green.bg-green {
            border-color: #10aeff;
            color: #fff;
            background: #10aeff
        }

        .wetui-btn .icon {
            color: #ffffff;
        }

        .simple .icon {
            color: #10aeff;
            margin: 0.8em;
        }

        .page-category-content .simple {
            margin: 1em 0;
        }

        .page-category-content .photo {
            width: 100%;
        }

        .page-category-content .desc {
            padding: 0 1em;
        }

        .weui-picker-container,
        .weui-picker-overlay {
            bottom: 0;
        }
        .list {
            background: #F8F8F8;
        }
        .list-item {
            margin-top: 10px;
            padding: 10px;
            background: #ffffff;
        }
        .list-item .header {
            box-sizing: border-box;
            display: flex;
            justify-content: flex-start;
            align-items: center;
        }
        .list-item .header .avatar{
            width: 2rem;
            border-radius: 50%;
        }
        .list-item .header .desc {
            margin-left: 10px;
        }
        .list-item .header .desc .name {
            font-size: 0.8rem;
            font-weight: bold;
        }
        .list-item .header .desc .time {
            font-size: 0.6rem;
            color: #c0c0c0;
        }
        .list-item .content {
            padding: 10px 0;
        }
        .list-item .tools {
            box-sizing: border-box;
            display: flex;
            align-items: center;
            border-top: #c0c0c0 solid 1px;
            margin-top: 10px;
        }
        .list-item .tools .btn {
            flex: 1;
            text-align: center;
            padding: 10px;
        }
        .list-item .tools .btn i {
            padding-right: 5px;
        }
    </style>
@endsection
@section('content')
    <div class="navigator">
        <div class="weui-header bg-blue navigator">
            <div id="back-btn" class="weui-header-left"> <a class="icon icon-109 f-white">返回</a>  </div>
            <h1 class="weui-header-title"></h1>
        </div>
    </div>
    <ul class="list" id="factory-list">
    <li class="list-item">
        <div class="header">
            <div class="weui-avatar-circle">
                <img src="/images/logo.png">
                <span class="weui-icon-success weui-icon-safe-warn"></span>
            </div>
            <div class="desc">
                <p class="name">{{$info->user->name}}站</p>
                    <p class="time">{{$info->created_at}}</p>
                </div>
            </div>
            <div class="content copy{{$info->id}}">
                {!! nl2br($info->content) !!} <p>（联系时请告知超人推荐哦）</p>
            </div>
            @if($info->pictures)
                <div class="weui-uploader__bd">
                    <ul class="weui-uploader__files" id="uploaderFiles">
                        @foreach($info->pictures as $picture)
                            <li class="weui-uploader__file" data-url="{{$picture}}" style="background-image:url('{{ $picture }}-thumb')"></li>
                        @endforeach
                    </ul>
                </div>
            @endif
        <div class="tools">
            <div class="btn copy-btn" data-id="{{$info->id}}"><i class="icon icon-97"></i>复制问超人</div>
            <a class="btn share-btn" data-id="{{$info->id}}" href="/convenience/share/{{$info->id}}"><i class="icon icon-3"></i>分享好友</a>
            </div>
    </li>
    </ul>
    <script src="/h5/js/request.js"></script>
    <script>
        $(function () {
            $('#back-btn').on('click', function () {
                location.href = '{{ env('APP_URL') . '/convenience/' . $info->user_id . '/' . $category->id }}'
            })

            var clipboard = new Clipboard('.copy-btn', {
                text: function(trigger) {
                    console.log($(trigger).data('id'));
                    var id = $(trigger).data('id');
                    //统计复制数据
                    postStatistic({
                        url: location.href,
                        target: 'convenience_feed',
                        event: 'copy',
                        data: {
                            id: id
                        }
                    }, function (){
                    });
                    return $('.copy' + id).html().replace(/<[^>]+>/g,"").replace(/&nbsp;/ig,'');
                }
            });

            clipboard.on('success', function(e) {
                console.info('Action:', e.action);
                console.info('Text:', e.text);
                console.info('Trigger:', e.trigger);
                e.clearSelection();
                $.toast('已复制以上文本内容');
            });

            clipboard.on('error', function(e) {
                console.error('Action:', e.action);
                console.error('Trigger:', e.trigger);
                $.toast('复制失败，请手动截图', "cancel");
            });

            var $galleryImg = $(".weui-gallery__img");//相册图片地址
            var $gallery = $(".weui-gallery");
            $('#factory-list').on("click", ".weui-uploader__file", function(){
                // $galleryImg.attr("style", this.getAttribute("style"));

                var children = $(this).parent().children();
                var pictures = []
                for (var index = 0; index < children.length; index++) {
                    var element = children[index];
                    pictures.push($(element).data('url'))
                }
                console.log(pictures);
                wx.previewImage({
                    current: $(this).data('url'), // 当前显示图片的http链接
                    urls: pictures // 需要预览的图片http链接列表
                });
                // $gallery.fadeIn(100);
            });
        })
    </script>
@endsection