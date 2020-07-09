<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>信息列表</title>
    <link rel="stylesheet" href="/h5/css/base.css">
    <link rel="stylesheet" href="/h5/css/weui.css">
    <link rel="stylesheet" href="/h5/css/weuix.css">
    <link rel="stylesheet" href="/h5/css/app.css">
    <!-- <script src="js/main.js"></script> -->
    <script src="/h5/js/zepto.min.js"></script>
    <script src="/h5/js/zepto.weui.min.js"></script>
    <script src="/h5/js/tools.js"></script>
    <script src="/h5/js/iscroll-lite.min.js"></script>
    <script src="/h5/js/clipboard.min.js"></script>
    <script src="https://res.wx.qq.com/open/js/jweixin-1.4.0.js" type="text/javascript" charset="utf-8"></script>
    <script type="text/javascript" charset="utf-8">
        wx.config(<?php echo $app->jssdk->buildConfig(array('updateAppMessageShareData', 'updateTimelineShareData'), false) ?>);
    </script>
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
                <div class="weui-cell__hd"><label for="name" class="weui-label">站点</label></div>
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
            <a id="search" href="javascript:;" class="weui-btn bg-blue"><i class="icon icon-4"></i>搜索</a>
        </div>
        <!-- <h1 class="page-hd-title">
            工厂信息列表
        </h1>
        <p class="page-hd-desc">xxx工厂</p> -->
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
            title: "请选择您的站点",
            inputReadOnly: false,
            cols: [
                {
                    textAlign: 'center',
                    values: JSON.parse('{!! $cities !!}')
                }
            ],
            onChange: function(p, v, dv) {
                console.log(p, v, dv);
            },
            onClose: function(p, v, d) {
                console.log("close");
            }
        });

        $("#category").picker({
            title: "请选择您的站点",
            cols: [
                {
                    textAlign: 'center',
                    values: JSON.parse('{!! $categories !!}')
                }
            ],
            onChange: function(p, v, dv) {
                console.log(p, v, dv);
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
                <%=list[i].content%>
            </div>
            <div class="weui-uploader__bd">
                <ul class="weui-uploader__files" id="uploaderFiles">
                    <% for(var j in list[i].pictures) {   %>
                    <li class="weui-uploader__file" style="background-image:url('<%=list[i].pictures[j]%>')"></li>   
                    <% } %>                 
                </ul>
            </div>
            <div class="tools">
                <div class="btn copy-btn" data-id="<%=list[i].id%>"><i class="icon icon-97"></i>复制问超人</div>
                <div class="btn share-btn" data-id="<%=list[i].id%>" onclick="share()"><i class="icon icon-3"></i>分享好友</div>
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
            $("#search").click(function () {
                var inputs = $("input");
                for (var index = 0; index < inputs.length; index++) {
                    var element = inputs[index];
                    var key = $(element).data('key')
                    var val = $(element).val()
                    filter[key] = val
                }
                //重置页码
                reset()
                ajaxpage(filter)
            })
            var clipboard = new Clipboard('.copy-btn', {
                text: function(trigger) {
                    console.log($(trigger).data('id'));
                    var id = $(trigger).data('id');

                    return $('.copy' + id).html().replace(/<[^>]+>/g,"").replace(/&nbsp;/ig,'');
                }
            });

            clipboard.on('success', function(e) {
                console.info('Action:', e.action);
                console.info('Text:', e.text);
                console.info('Trigger:', e.trigger);
                e.clearSelection();
                $.toast('复制成功');
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
                $galleryImg.attr("style", this.getAttribute("style"));
                console.log(this)
                $gallery.fadeIn(100);
            });
            $gallery.on("click", function(){
                $gallery.fadeOut(100);
            });
            // $("#factory-list").on('click', '.copy-btn', function () {
                
            //     var id = $(this).data('id')
            //     var clipboard = new Clipboard('.copy'+id, {
            //         text: 'abc'
            //     });
            //     clipboard.on('success', function(e) {
            //         $.toast('复制成功');

            //     });
            //     clipboard.on('error', function(e) {
            //         console.log(e);
            //     });
            // })

        })
        wx.ready(function () {   //需在用户可能点击分享按钮前就先调用
        wx.updateAppMessageShareData({
            title: '海外超人-全球最大的华人互助社区', // 分享标题
            desc: '快看，我发现一条超好的闲置信息...', // 分享描述
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
        });
    </script>
</body>

</html>