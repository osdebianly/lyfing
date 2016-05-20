@extends('frontend.user.main')
@section('content')
        <!-- Content Wrapper. Contains page content -->
{{--<link href="http://cdn.bootcss.com/bootstrap-switch/3.3.2/css/bootstrap3/bootstrap-switch.min.css" rel="stylesheet">--}}
{{--<script src="http://cdn.bootcss.com/bootstrap-switch/3.3.2/js/bootstrap-switch.min.js"></script>--}}
<script src="http://cdn.bootcss.com/vue/1.0.24/vue.min.js"></script>
<script src="http://cdn.bootcss.com/vue-resource/0.7.0/vue-resource.min.js"></script>
<div class="content-wrapper" id="app">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            我的下载
            <small>下载墙外的视频或文件</small>
        </h1>
    </section>
    <br>
    <br>


        <div class="row">
            <div class="col-md-6">

                <form class="form-horizontal" method="post" v-on:submit.prevent="queryInfo">

                    <br>
                    <div class="control-group">
                        <label class="control-label" for="inputURL">下载URL :</label>
                        <div class="control" id="inputURL">
                            <input type="text" name="url" v-model="url" class="btn-block" id="inputURL" placeholder="这里输入要下载的资源完整URL">
                        </div>
                    </div>
                    <br><br>
                    <button type="submit" class="btn btn-block btn-success" >获取信息</button>
                </form>
                <br>
                <br>

                <div class="row-fluid">
                    <div class="span12">
                        <dl class="dl-horizontal">
                            <dt>
                                <em>注意</em>
                            </dt>
                            <dd>
                                URL需要带http或https 协议，默认下载视频格式，视频文件使用<a href="https://github.com/soimort/you-get/wiki/中文说明"><em><strong>you-get</strong></em></a> 下载
                            </dd>
                            <dt>
                                通知
                            </dt>
                            <dd>
                                下载完成后，邮箱通知，保留30分钟（视下载队列和硬盘空间动态改变）
                            </dd>

                        </dl>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <label >视频网站:</label>@{{videoHost}}

                        <label >视频标题:</label>@{{videoTitle}}
                    </div>
                </div>


            </div>
            <div class="col-md-6">
                <h3 class="text-danger text-center">
                    支持视频列表
                </h3>
                <table class="table">
                    <thead>
                    <tr>
                        <th align="center">网站</th>
                        <th align="left">URL</th>
                        <th align="center">视频?</th>
                        <th align="center">图像?</th>
                        <th align="center">音频?</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td align="center"><strong>YouTube</strong></td>
                        <td align="left"><a href="https://www.youtube.com/">https://www.youtube.com/</a></td>
                        <td align="center">✓</td>
                        <td align="center"></td>
                        <td align="center"></td>
                    </tr>
                    <tr>
                        <td align="center"><strong>Twitter</strong></td>
                        <td align="left"><a href="https://twitter.com/">https://twitter.com/</a></td>
                        <td align="center">✓</td>
                        <td align="center">✓</td>
                        <td align="center"></td>
                    </tr>
                    <tr>
                        <td align="center">VK</td>
                        <td align="left"><a href="http://vk.com/">http://vk.com/</a></td>
                        <td align="center">✓</td>
                        <td align="center"></td>
                        <td align="center"></td>
                    </tr>
                    <tr>
                        <td align="center">Vine</td>
                        <td align="left"><a href="https://vine.co/">https://vine.co/</a></td>
                        <td align="center">✓</td>
                        <td align="center"></td>
                        <td align="center"></td>
                    </tr>
                    <tr>
                        <td align="center">Vimeo</td>
                        <td align="left"><a href="https://vimeo.com/">https://vimeo.com/</a></td>
                        <td align="center">✓</td>
                        <td align="center"></td>
                        <td align="center"></td>
                    </tr>
                    <tr>
                        <td align="center">Vidto</td>
                        <td align="left"><a href="http://vidto.me/">http://vidto.me/</a></td>
                        <td align="center">✓</td>
                        <td align="center"></td>
                        <td align="center"></td>
                    </tr>
                    <tr>
                        <td align="center">Veoh</td>
                        <td align="left"><a href="http://www.veoh.com/">http://www.veoh.com/</a></td>
                        <td align="center">✓</td>
                        <td align="center"></td>
                        <td align="center"></td>
                    </tr>
                    <tr>
                        <td align="center"><strong>Tumblr</strong></td>
                        <td align="left"><a href="https://www.tumblr.com/">https://www.tumblr.com/</a></td>
                        <td align="center">✓</td>
                        <td align="center">✓</td>
                        <td align="center">✓</td>
                    </tr>
                    <tr>
                        <td align="center">TED</td>
                        <td align="left"><a href="http://www.ted.com/">http://www.ted.com/</a></td>
                        <td align="center">✓</td>
                        <td align="center"></td>
                        <td align="center"></td>
                    </tr>
                    <tr>
                        <td align="center">SoundCloud</td>
                        <td align="left"><a href="https://soundcloud.com/">https://soundcloud.com/</a></td>
                        <td align="center"></td>
                        <td align="center"></td>
                        <td align="center">✓</td>
                    </tr>
                    <tr>
                        <td align="center">Pinterest</td>
                        <td align="left"><a href="https://www.pinterest.com/">https://www.pinterest.com/</a></td>
                        <td align="center"></td>
                        <td align="center">✓</td>
                        <td align="center"></td>
                    </tr>
                    <tr>
                        <td align="center">MusicPlayOn</td>
                        <td align="left"><a href="http://en.musicplayon.com/">http://en.musicplayon.com/</a></td>
                        <td align="center">✓</td>
                        <td align="center"></td>
                        <td align="center"></td>
                    </tr>
                    <tr>
                        <td align="center">MTV81</td>
                        <td align="left"><a href="http://www.mtv81.com/">http://www.mtv81.com/</a></td>
                        <td align="center">✓</td>
                        <td align="center"></td>
                        <td align="center"></td>
                    </tr>
                    <tr>
                        <td align="center">Mixcloud</td>
                        <td align="left"><a href="https://www.mixcloud.com/">https://www.mixcloud.com/</a></td>
                        <td align="center"></td>
                        <td align="center"></td>
                        <td align="center">✓</td>
                    </tr>
                    <tr>
                        <td align="center">Metacafe</td>
                        <td align="left"><a href="http://www.metacafe.com/">http://www.metacafe.com/</a></td>
                        <td align="center">✓</td>
                        <td align="center"></td>
                        <td align="center"></td>
                    </tr>
                    <tr>
                        <td align="center">Magisto</td>
                        <td align="left"><a href="http://www.magisto.com/">http://www.magisto.com/</a></td>
                        <td align="center">✓</td>
                        <td align="center"></td>
                        <td align="center"></td>
                    </tr>
                    <tr>
                        <td align="center">Khan Academy</td>
                        <td align="left"><a href="https://www.khanacademy.org/">https://www.khanacademy.org/</a></td>
                        <td align="center">✓</td>
                        <td align="center"></td>
                        <td align="center"></td>
                    </tr>
                    <tr>
                        <td align="center">JPopsuki TV</td>
                        <td align="left"><a href="http://www.jpopsuki.tv/">http://www.jpopsuki.tv/</a></td>
                        <td align="center">✓</td>
                        <td align="center"></td>
                        <td align="center"></td>
                    </tr>
                    <tr>
                        <td align="center">Internet Archive</td>
                        <td align="left"><a href="https://archive.org/">https://archive.org/</a></td>
                        <td align="center">✓</td>
                        <td align="center"></td>
                        <td align="center"></td>
                    </tr>
                    <tr>
                        <td align="center"><strong>Instagram</strong></td>
                        <td align="left"><a href="https://instagram.com/">https://instagram.com/</a></td>
                        <td align="center">✓</td>
                        <td align="center">✓</td>
                        <td align="center"></td>
                    </tr>
                    <tr>
                        <td align="center">Heavy Music Archive</td>
                        <td align="left"><a href="http://www.heavy-music.ru/">http://www.heavy-music.ru/</a></td>
                        <td align="center"></td>
                        <td align="center"></td>
                        <td align="center">✓</td>
                    </tr>
                    <tr>
                        <td align="center"><strong>Google+</strong></td>
                        <td align="left"><a href="https://plus.google.com/">https://plus.google.com/</a></td>
                        <td align="center">✓</td>
                        <td align="center">✓</td>
                        <td align="center"></td>
                    </tr>
                    <tr>
                        <td align="center">Freesound</td>
                        <td align="left"><a href="http://www.freesound.org/">http://www.freesound.org/</a></td>
                        <td align="center"></td>
                        <td align="center"></td>
                        <td align="center">✓</td>
                    </tr>
                    <tr>
                        <td align="center">Flickr</td>
                        <td align="left"><a href="https://www.flickr.com/">https://www.flickr.com/</a></td>
                        <td align="center">✓</td>
                        <td align="center">✓</td>
                        <td align="center"></td>
                    </tr>
                    <tr>
                        <td align="center">Facebook</td>
                        <td align="left"><a href="https://www.facebook.com/">https://www.facebook.com/</a></td>
                        <td align="center">✓</td>
                        <td align="center"></td>
                        <td align="center"></td>
                    </tr>
                    <tr>
                        <td align="center">eHow</td>
                        <td align="left"><a href="http://www.ehow.com/">http://www.ehow.com/</a></td>
                        <td align="center">✓</td>
                        <td align="center"></td>
                        <td align="center"></td>
                    </tr>
                    <tr>
                        <td align="center">Dailymotion</td>
                        <td align="left"><a href="http://www.dailymotion.com/">http://www.dailymotion.com/</a></td>
                        <td align="center">✓</td>
                        <td align="center"></td>
                        <td align="center"></td>
                    </tr>
                    <tr>
                        <td align="center">CBS</td>
                        <td align="left"><a href="http://www.cbs.com/">http://www.cbs.com/</a></td>
                        <td align="center">✓</td>
                        <td align="center"></td>
                        <td align="center"></td>
                    </tr>
                    <tr>
                        <td align="center">Bandcamp</td>
                        <td align="left"><a href="http://bandcamp.com/">http://bandcamp.com/</a></td>
                        <td align="center"></td>
                        <td align="center"></td>
                        <td align="center">✓</td>
                    </tr>
                    <tr>
                        <td align="center">AliveThai</td>
                        <td align="left"><a href="http://alive.in.th/">http://alive.in.th/</a></td>
                        <td align="center">✓</td>
                        <td align="center"></td>
                        <td align="center"></td>
                    </tr>
                    <tr>
                        <td align="center">interest.me</td>
                        <td align="left"><a href="http://ch.interest.me/tvn">http://ch.interest.me/tvn</a></td>
                        <td align="center">✓</td>
                        <td align="center"></td>
                        <td align="center"></td>
                    </tr>
                    <tr>
                        <td align="center"><strong>755<br>ナナゴーゴー</strong></td>
                        <td align="left"><a href="http://7gogo.jp/">http://7gogo.jp/</a></td>
                        <td align="center">✓</td>
                        <td align="center">✓</td>
                        <td align="center"></td>
                    </tr>
                    <tr>
                        <td align="center"><strong>niconico<br>ニコニコ動画</strong></td>
                        <td align="left"><a href="http://www.nicovideo.jp/">http://www.nicovideo.jp/</a></td>
                        <td align="center">✓</td>
                        <td align="center"></td>
                        <td align="center"></td>
                    </tr>
                    <tr>
                        <td align="center"><strong>163<br>网易视频<br>网易云音乐</strong></td>
                        <td align="left">
                            <a href="http://v.163.com/">http://v.163.com/</a><br><a href="http://music.163.com/">http://music.163.com/</a>
                        </td>
                        <td align="center">✓</td>
                        <td align="center"></td>
                        <td align="center">✓</td>
                    </tr>
                    <tr>
                        <td align="center">56网</td>
                        <td align="left"><a href="http://www.56.com/">http://www.56.com/</a></td>
                        <td align="center">✓</td>
                        <td align="center"></td>
                        <td align="center"></td>
                    </tr>
                    <tr>
                        <td align="center"><strong>AcFun</strong></td>
                        <td align="left"><a href="http://www.acfun.tv/">http://www.acfun.tv/</a></td>
                        <td align="center">✓</td>
                        <td align="center"></td>
                        <td align="center"></td>
                    </tr>
                    <tr>
                        <td align="center"><strong>Baidu<br>百度贴吧</strong></td>
                        <td align="left"><a href="http://tieba.baidu.com/">http://tieba.baidu.com/</a></td>
                        <td align="center">✓</td>
                        <td align="center">✓</td>
                        <td align="center"></td>
                    </tr>
                    <tr>
                        <td align="center">爆米花网</td>
                        <td align="left"><a href="http://www.baomihua.com/">http://www.baomihua.com/</a></td>
                        <td align="center">✓</td>
                        <td align="center"></td>
                        <td align="center"></td>
                    </tr>
                    <tr>
                        <td align="center"><strong>bilibili<br>哔哩哔哩</strong></td>
                        <td align="left"><a href="http://www.bilibili.com/">http://www.bilibili.com/</a></td>
                        <td align="center">✓</td>
                        <td align="center"></td>
                        <td align="center"></td>
                    </tr>
                    <tr>
                        <td align="center">Dilidili</td>
                        <td align="left"><a href="http://www.dilidili.com/">http://www.dilidili.com/</a></td>
                        <td align="center">✓</td>
                        <td align="center"></td>
                        <td align="center"></td>
                    </tr>
                    <tr>
                        <td align="center">豆瓣</td>
                        <td align="left"><a href="http://www.douban.com/">http://www.douban.com/</a></td>
                        <td align="center"></td>
                        <td align="center"></td>
                        <td align="center">✓</td>
                    </tr>
                    <tr>
                        <td align="center">斗鱼</td>
                        <td align="left"><a href="http://www.douyutv.com/">http://www.douyutv.com/</a></td>
                        <td align="center">✓</td>
                        <td align="center"></td>
                        <td align="center"></td>
                    </tr>
                    <tr>
                        <td align="center">凤凰视频</td>
                        <td align="left"><a href="http://v.ifeng.com/">http://v.ifeng.com/</a></td>
                        <td align="center">✓</td>
                        <td align="center"></td>
                        <td align="center"></td>
                    </tr>
                    <tr>
                        <td align="center">风行网</td>
                        <td align="left"><a href="http://www.fun.tv/">http://www.fun.tv/</a></td>
                        <td align="center">✓</td>
                        <td align="center"></td>
                        <td align="center"></td>
                    </tr>
                    <tr>
                        <td align="center">iQIYI<br>爱奇艺</td>
                        <td align="left"><a href="http://www.iqiyi.com/">http://www.iqiyi.com/</a></td>
                        <td align="center">✓</td>
                        <td align="center"></td>
                        <td align="center"></td>
                    </tr>
                    <tr>
                        <td align="center">激动网</td>
                        <td align="left"><a href="http://www.joy.cn/">http://www.joy.cn/</a></td>
                        <td align="center">✓</td>
                        <td align="center"></td>
                        <td align="center"></td>
                    </tr>
                    <tr>
                        <td align="center">酷6网</td>
                        <td align="left"><a href="http://www.ku6.com/">http://www.ku6.com/</a></td>
                        <td align="center">✓</td>
                        <td align="center"></td>
                        <td align="center"></td>
                    </tr>
                    <tr>
                        <td align="center">酷狗音乐</td>
                        <td align="left"><a href="http://www.kugou.com/">http://www.kugou.com/</a></td>
                        <td align="center"></td>
                        <td align="center"></td>
                        <td align="center">✓</td>
                    </tr>
                    <tr>
                        <td align="center">酷我音乐</td>
                        <td align="left"><a href="http://www.kuwo.cn/">http://www.kuwo.cn/</a></td>
                        <td align="center"></td>
                        <td align="center"></td>
                        <td align="center">✓</td>
                    </tr>
                    <tr>
                        <td align="center">乐视网</td>
                        <td align="left"><a href="http://www.letv.com/">http://www.letv.com/</a></td>
                        <td align="center">✓</td>
                        <td align="center"></td>
                        <td align="center"></td>
                    </tr>
                    <tr>
                        <td align="center">荔枝FM</td>
                        <td align="left"><a href="http://www.lizhi.fm/">http://www.lizhi.fm/</a></td>
                        <td align="center"></td>
                        <td align="center"></td>
                        <td align="center">✓</td>
                    </tr>
                    <tr>
                        <td align="center">秒拍</td>
                        <td align="left"><a href="http://www.miaopai.com/">http://www.miaopai.com/</a></td>
                        <td align="center">✓</td>
                        <td align="center"></td>
                        <td align="center"></td>
                    </tr>
                    <tr>
                        <td align="center">MioMio弹幕网</td>
                        <td align="left"><a href="http://www.miomio.tv/">http://www.miomio.tv/</a></td>
                        <td align="center">✓</td>
                        <td align="center"></td>
                        <td align="center"></td>
                    </tr>
                    <tr>
                        <td align="center">痞客邦</td>
                        <td align="left"><a href="https://www.pixnet.net/">https://www.pixnet.net/</a></td>
                        <td align="center">✓</td>
                        <td align="center"></td>
                        <td align="center"></td>
                    </tr>
                    <tr>
                        <td align="center">PPTV聚力</td>
                        <td align="left"><a href="http://www.pptv.com/">http://www.pptv.com/</a></td>
                        <td align="center">✓</td>
                        <td align="center"></td>
                        <td align="center"></td>
                    </tr>
                    <tr>
                        <td align="center">齐鲁网</td>
                        <td align="left"><a href="http://v.iqilu.com/">http://v.iqilu.com/</a></td>
                        <td align="center">✓</td>
                        <td align="center"></td>
                        <td align="center"></td>
                    </tr>
                    <tr>
                        <td align="center">QQ<br>腾讯视频</td>
                        <td align="left"><a href="http://v.qq.com/">http://v.qq.com/</a></td>
                        <td align="center">✓</td>
                        <td align="center"></td>
                        <td align="center"></td>
                    </tr>
                    <tr>
                        <td align="center">阡陌视频</td>
                        <td align="left"><a href="http://qianmo.com/">http://qianmo.com/</a></td>
                        <td align="center">✓</td>
                        <td align="center"></td>
                        <td align="center"></td>
                    </tr>
                    <tr>
                        <td align="center">Sina<br>新浪视频<br>微博秒拍视频</td>
                        <td align="left">
                            <a href="http://video.sina.com.cn/">http://video.sina.com.cn/</a><br><a href="http://video.weibo.com/">http://video.weibo.com/</a>
                        </td>
                        <td align="center">✓</td>
                        <td align="center"></td>
                        <td align="center"></td>
                    </tr>
                    <tr>
                        <td align="center">Sohu<br>搜狐视频</td>
                        <td align="left"><a href="http://tv.sohu.com/">http://tv.sohu.com/</a></td>
                        <td align="center">✓</td>
                        <td align="center"></td>
                        <td align="center"></td>
                    </tr>
                    <tr>
                        <td align="center">天天动听</td>
                        <td align="left"><a href="http://www.dongting.com/">http://www.dongting.com/</a></td>
                        <td align="center"></td>
                        <td align="center"></td>
                        <td align="center">✓</td>
                    </tr>
                    <tr>
                        <td align="center"><strong>Tudou<br>土豆</strong></td>
                        <td align="left"><a href="http://www.tudou.com/">http://www.tudou.com/</a></td>
                        <td align="center">✓</td>
                        <td align="center"></td>
                        <td align="center"></td>
                    </tr>
                    <tr>
                        <td align="center">虾米</td>
                        <td align="left"><a href="http://www.xiami.com/">http://www.xiami.com/</a></td>
                        <td align="center"></td>
                        <td align="center"></td>
                        <td align="center">✓</td>
                    </tr>
                    <tr>
                        <td align="center">阳光卫视</td>
                        <td align="left"><a href="http://www.isuntv.com/">http://www.isuntv.com/</a></td>
                        <td align="center">✓</td>
                        <td align="center"></td>
                        <td align="center"></td>
                    </tr>
                    <tr>
                        <td align="center"><strong>音悦Tai</strong></td>
                        <td align="left"><a href="http://www.yinyuetai.com/">http://www.yinyuetai.com/</a></td>
                        <td align="center">✓</td>
                        <td align="center"></td>
                        <td align="center"></td>
                    </tr>
                    <tr>
                        <td align="center"><strong>Youku<br>优酷</strong></td>
                        <td align="left"><a href="http://www.youku.com/">http://www.youku.com/</a></td>
                        <td align="center">✓</td>
                        <td align="center"></td>
                        <td align="center"></td>
                    </tr>
                    <tr>
                        <td align="center">战旗TV</td>
                        <td align="left"><a href="http://www.zhanqi.tv/lives">http://www.zhanqi.tv/lives</a></td>
                        <td align="center">✓</td>
                        <td align="center"></td>
                        <td align="center"></td>
                    </tr>
                    <tr>
                        <td align="center">央视网</td>
                        <td align="left"><a href="http://www.cntv.cn/">http://www.cntv.cn/</a></td>
                        <td align="center">✓</td>
                        <td align="center"></td>
                        <td align="center"></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>

</div>
<script>


    $(function(){
        var vm = new Vue({
            el: '#app',
            data:{
                fileType:'checked',
                url:'',
                videoHost:'',
                videoTitle:''


            },
            methods:{
                queryInfo: function(){
                    console.log('url'+this.url) ;
                    this.$http.post('/user/download',{url:this.url}).then(function (response) {

                        // get status
                        response.status;

                        // get all headers
                        response.headers();

                        // get 'expires' header
                        response.headers('expires');

                        // set data on vm
                        this.$set('videoHost', response.data.extractor) ;
                        this.$set('videoTitle', response.data.title) ;
                        console.log(response) ;
                    }, function (response) {

                        // error callback
                        console.log(response) ;
                        alert('请求出错') ;
                    });
                }
            }

        }


        ) ;
    }) ;

</script>

@endsection