//测试地址
// var host = 'http://info-mall.okmilu.com'

//生产地址
var host = '';

var urls = {
    //获取工厂数据列表
    'list': '/api/convenience',
    'statistic': '/api/statistic'
};

// ajax封装
function request(url, type, data, success, error, async, dataType, cache, alone) {
    var type = type || 'post';//请求类型
    var dataType = dataType || 'json';//接收数据类型
    var async = async || true;//异步请求
    var alone = alone || false;//独立提交（一次有效的提交）
    var cache = cache || false;//浏览器历史缓存
    var success = success || function (data) {
            /*console.log('请求成功');*/
            // setTimeout(function () {
            //     mui.toast('请求成功');//通过layer插件来进行提示信息
            // },500);
            // if(data.status){//服务器处理成功
            //     setTimeout(function () {
            //         if(data.url){
            //             location.replace(data.url);
            //         }else{
            //             location.reload(true);
            //         }
            //     },1500);
            // }else{//服务器处理失败
            //     if(alone){//改变ajax提交状态
            //         // ajaxStatus = true;
            //     }
            // }
        };
    var error = error || function (data) {
            /*console.error('请求成功失败');*/
            /*data.status;//错误状态吗*/
            // setTimeout(function () {
                
            // },500);
            if(data.status == 404){
                $.toast("请求失败，请求未找到",'text');
            }else if(data.status == 500){
                $.toast("请求失败，服务器内部错误",'text');
            }else {
                // mui.toast('请求失败,网络连接超时');
                console.log(data)
            }
            // ajaxStatus = true;
        };
    /*判断是否可以发送请求*/
    // if(!ajaxStatus){
    //     return false;
    // }
    // ajaxStatus = false;//禁用ajax请求
    /*正常情况下1秒后可以再次多个异步请求，为true时只可以有一次有效请求（例如添加数据）*/
    // if(!alone){
    //     setTimeout(function () {
    //         ajaxStatus = true;
    //     },1000);
    // }
    $.ajax({
        'url': host + url,
        'data': type == 'post' ? JSON.stringify(data) : data,
        'type': type,
        // 'headers': {'Authorization': jwt.token_type + ' ' + jwt.access_token},
        'contentType': "application/json",
        'dataType': dataType,
        'async': async,
        'success': success,
        'error': error,
        // 'jsonpCallback': 'jsonp' + (new Date()).valueOf().toString().substr(-4),
        'beforeSend': function () {
            // layer.msg('加载中', {
            //     icon: 16,
            //     shade: 0.01
            // });
        },
    });
}

function getList(data, success) {
    return request(urls['list'], 'get', data, success)
}

function postStatistic(data, success) {
    var ua = navigator.userAgent;
    var defaults = {
        ua: ua
    };
    data = $.extend({}, defaults, data);
    return request(urls['statistic'], 'post', data, success)
}