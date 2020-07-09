var user = Cookies.get('user');
var authHost = 'http://jidian.bxiaobao.com';
var redirect_uri = encodeURIComponent(location.href);
var code = getquery('code');
Cookies.set('proxy_uuid', getquery('proxy_uuid'))
if (!user && !code) {
	Cookies.set('ori_url', location.href)
	var url = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=wxe4b6052e349970d6&redirect_uri=' + redirect_uri +
		'&response_type=code&scope=snsapi_userinfo&state=bigtank#wechat_redirect';
	location.href = url

}
if (code) {
    console.log('获取授权')
    // 获取微信授权
    axios.get(
        authHost + '/api/authorization/wechat',
        {
            params: {
                code: getquery('code')
            }
        }
    )
    .then(function(res){
        console.log(res)
        let user = {
            uuid: res.data.data.uuid,
            inviteCode: res.data.data.inviteCode,
            wechatHeadImgUrl: res.data.data.wechatHeadImgUrl,
            wechatNickname: res.data.data.wechatNickname
        }
        Cookies.set('user', user);
        Cookies.set('authorization', res.data.data.Authorization);
        location.href = Cookies.get('ori_url');
    }).catch(function(e){
        console.log(e)
    })
    // axios.get(
    //     authHost + '/api/authorization?cellphone=12345678910',
    //     {
    //         params: {
    //             cellphone: '12345678910'
    //         }
    //     }
    // )
    // .then(function(res){
    //     console.log(res)
    //     axios.post(authHost + '/api/authorization?cellphone=12345678910', {
    //         cellphone: '12345678910',
    //         smsCode: '1234'
    //     })
    //     .then(function(res){
    //         Cookies.set('user', res.data.data.inviteCode)
    //         Cookies.set('authorization', res.data.data.Authorization);
    //         location.href = Cookies.get('ori_url');
    //     }).catch(function(e){
    //         console.log(e)
    //     })
    // }).catch(function(e){
    //     console.log(e)
    // })
}

