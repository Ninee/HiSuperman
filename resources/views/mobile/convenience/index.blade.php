<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>海外超人-便民信息</title>
    <link rel="stylesheet" href="/h5/css/base.css">
    <link rel="stylesheet" href="/h5/css/weui.css">
    <link rel="stylesheet" href="/h5/css/weuix.css">
    <link rel="stylesheet" href="/h5/css/app.css">
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
    <script src="/h5/js/zepto.weui.js"></script>
    <script src="/h5/js/tools.js"></script>
    <script src="/h5/js/iscroll-lite.min.js"></script>
    <script src="/h5/js/clipboard.min.js"></script>
    <script src="https://res.wx.qq.com/open/js/jweixin-1.4.0.js" type="text/javascript" charset="utf-8"></script>

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
            padding-top: 10px;
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
</head>

<body>
    {{--<div class="page-hd">--}}
        {{--<div class="weui-tab" style="height:44px;" id="nav">--}}
            {{--<div class="weui-tab-nav"> <a href="javascript:" class="weui-navbar__item weui-nav-green"> 工厂 </a> <a--}}
                    {{--href="javascript:" class="weui-navbar__item weui-nav-green"> 卖场 </a> </div>--}}
        {{--</div>--}}
    {{--</div>--}}
    <div class="weui-gallery" style="display: none">
        <span class="weui-gallery__img"></span>
        <div class="weui-gallery__opr">
        </div>
    </div>
    <div class="page-hd">
        <p class="page-hd-desc">按条件筛选：</p>

        <div class="weui-cells weui-cells_form">
            <div class="weui-cell">
                <div class="weui-cell__hd"><label for="name" class="weui-label">城市</label></div>
                <div class="weui-cell__bd">
                    <input data-key="city" class="weui-input" id="city" type="text" value="{{$currentCity->name}}">
                </div>
            </div>
            <div class="weui-cell">
                <div class="weui-cell__hd"><label class="weui-label">分类</label></div>
                <div class="weui-cell__bd">
                    <input data-key="category" class="weui-input" id="category" type="text" value="{{$currentCategory->name}}">
                </div>
            </div>
            <div class="weui-cell">
                <div class="weui-cell__hd"><label for="date-multiple" class="weui-label">发布日期</label></div>
                <div class="weui-cell__bd">
                    <input class="weui-input" id="date-multiple" type="text" value="">
                </div>
            </div>
            <a id="search" href="javascript:;" class="weui-btn bg-blue"><i class="icon icon-4"></i>搜索</a>
        </div>
    </div>
    <div class="page-bd">
        <div class="weui-cells__title">信息列表</div>
        <ul class="list" id="factory-list">
            <!--插入列表-->
        </ul>
        <div class="weui-loadmore" id="more">
            <i class="weui-loading"></i>
            <span class="weui-loadmore__tips">正在加载</span>
        </div>
    </div>
    <script src="/h5/js/picker.city.js"></script>
    <script>
        var city = '{{$currentCity->name}}';
        var category = '{{$currentCategory->name}}';

        $("#city").picker({
            title: "请选择您的城市",
            cols: [
                {
                    textAlign: 'center',
                    values: JSON.parse('{!! $cities !!}')
                }
            ],
            onChange: function(p, v, dv) {
                console.log(p, v, dv);
                city = dv;
            },
            onClose: function(p, v, d) {
                console.log("close");
            }
        });

        $("#category").picker({
            title: "请选择分类",
            cols: [
                {
                    textAlign: 'center',
                    values: JSON.parse('{!! $categories !!}')
                }
            ],
            onChange: function(p, v, dv) {
                console.log(p, v, dv);
                category = dv;
            },
            onClose: function(p, v, d) {
                console.log("close");
            }
        });

        $("#end").cityPicker({
            title: "选择地址范围",
            // showDistrict: false,
            onChange: function (picker, values, displayValues) {
                // console.log(values, displayValues);
                $("#districtId").val(values[2])
            }
        });
        var today = Date.parse(new Date());
        var dayRange = null;
        $("#date-multiple").calendar({
            multiple: true,
            value: [today],
            dateFormat: 'yyyy-mm-dd',
            separator: ' 到 ',
            onChange: function (p, values, displayValues) {
                var tmp = displayValues;

                if (displayValues.length > 2) {
                    //做比较和对比
                    if (displayValues[2] > displayValues[1]) {
                        tmp = [displayValues[0], displayValues[2]];
                    }
                    if (displayValues[2] < displayValues[0]) {
                        tmp = [displayValues[2], displayValues[1]];
                    }
                    if ( displayValues[0] < displayValues[2] && displayValues[2] < displayValues[1]) {
                        tmp = [displayValues[0], displayValues[2]];
                    }
                    p.value = tmp;
                    p.updateValue();
                }
                if (displayValues.length == 2) {
                    // console.log(displayValues)
                    if (displayValues[0] > displayValues[1]) {
                        var c = displayValues[0];
                        tmp[0] = displayValues[1];
                        tmp[1] = c;
                        p.value = tmp;
                        p.updateValue();
                    }
                }
                dayRange = tmp;
            }
        });

    </script>
    <script src="/h5/js/request.js"></script>
    <script id="tpl" type="text/html">
        <% for(var i in list) {   %>
        <li class="list-item">
            <div class="header">
                <div class="weui-avatar-circle">
                    <img src="/images/logo.png">
                    <span class="weui-icon-success weui-icon-safe-warn"></span>
                </div>
                <div class="desc">
                    <p class="name"><%=list[i].user.name%>站</p>
                    <p class="time"><%=list[i].created_at%></p>
                </div>
            </div>
            <div class="content copy<%=list[i].id%>">
                <%=nl2br(list[i].content)%> <p>（联系时请告知超人推荐哦）</p>
            </div>
            <div class="weui-uploader__bd">
                <ul class="weui-uploader__files" id="uploaderFiles">
                    <% for(var j in list[i].pictures) {   %>
                    <li class="weui-uploader__file" data-url="<%=list[i].pictures[j]%>" style="background-image:url('<%=list[i].pictures[j]%>-thumb')"></li>
                    <% } %>                 
                </ul>
            </div>
            <div class="tools">
                <div class="btn copy-btn" data-id="<%=list[i].id%>"><i class="icon icon-97"></i>复制问超人</div>
            <a class="btn share-btn" data-id="<%=list[i].id%>" href="/convenience/share/<%=list[i].id%>"><i class="icon icon-3"></i>分享好友</a>
            </div>
        </li>
        <% } %>
    </script>
    <script>
        var pagesize = 10; //每页数据条数
        var page = 1;
        var isMax = false;
        var filter = {};

        $('#more').hide();

        function ajaxpage(filter = {}) {
            $("#more").show();
            var params = $.extend(filter, {
                city: city,
                category: category,
                dayRange: dayRange,
                page: page
            })
            getList(params, function (res) {
                res.list = res.data
                if (res.data.length > 0) {
                    $("#factory-list").append(tpl(document.getElementById('tpl').innerHTML, res));
                    $('#more').hide();
                } else {
                    isMax = true
                    $("#more").html("没有更多数据了");
                    $("#more").show();
                }

                // var maxpage = Math.ceil(rs.total / pagesize);
                // sessionStorage['maxpage'] = maxpage;
            })

        }

        function reset() {
            page = 1
            isMax = false
            $("#more").html(
                "<i class='weui-loading'></i><span class='weui-loadmore__tips'>正在加载</span>");
            $("#factory-list").html('')
        }

        function updateShareInfo() {
            wx.updateAppMessageShareData({
                title: '海外超人-全球最大的华人互助社区', // 分享标题
                desc: '快看！发现了' + city + '最新的' + category + '信息！', // 分享描述
                link: location.href, // 分享链接，该链接域名或路径必须与当前页面对应的公众号JS安全域名一致
                imgUrl: '{{asset('images/logo.png')}}', // 分享图标
                success: function () {
                    // 设置成功
                }
            });
            wx.updateTimelineShareData({
                    title: '海外超人-全球最大的华人互助社区', // 分享标题
                    link: location.href, // 分享链接，该链接域名或路径必须与当前页面对应的公众号JS安全域名一致
                    imgUrl: '{{asset('images/logo.png')}}', // 分享图标
                    success: function () {
                        // 用户点击了分享后执行的回调函数
                    }
                });
        }

        function sharePlus(id) {
            share()
            //统计复制数据
            postStatistic({
                url: location.href,
                target: 'convenience_feed',
                event: 'share',
                data: {
                    id: id
                }
            }, function (){
            });
        }

        $(window).scroll(
            function () {
                var scrollTop = $(this).scrollTop();
                var scrollHeight = $(document).height();
                var windowHeight = $(this).height();
                if (scrollTop + windowHeight == scrollHeight) {
                    if (isMax) return;
                    page++;
                    ajaxpage();
                }

            });
        ajaxpage();
        $(function () {
            //统计浏览数据
            postStatistic({
                url: location.href,
                target: 'convenience',
                event: 'view',
                data: {
                    city: city,
                    category: category
                }
            }, function (){

            });

            $("#search").click(function () {
                updateShareInfo()
                //重置页码
                reset()
                ajaxpage()
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

            // var $uploaderFiles = $("#uploaderFiles");
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
                })
                // $gallery.fadeIn(100);
            });
            $gallery.on("click", function(){
                $gallery.fadeOut(100);
            });

        })

        wx.ready(function () {   //需在用户可能点击分享按钮前就先调用
            updateShareInfo();
        });
    </script>
</body>

</html>