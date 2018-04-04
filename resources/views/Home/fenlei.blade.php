@include('home.common.index_header');





    <link href="/Content/list-v2.css" rel="stylesheet" 0="frontend\assets\BaseAsset">


<!-- //homePage-nav-box -->

<!-- //header -->
    <script>
    var goodsIdArr = ["3266418","3266413","3264483","3266561","3265072","3265735","3266034","3266092","3266088","3265547","3263792","3266723","3262649","3266595","3266580","3266396","3266294","3263253","3266024"];
    var usersIdArr = [10337863,10780799,86746,5904825,7363665,94076,245983,10811352,10386542,10773434,8448744,10286925,8527630,614768,10810151];
    var urlParam   = {"cateId":114,"subcateId":1050,"manuId":0,"productId":0,"type":"price","typeId":0,"quality":0,"maxQuality":0,"minPrice":0,"maxPrice":0,"keyword":"","notKwd":"","tagIds":[],"userid":false,"username":"","provinceId":0,"cityId":0,"style":1,"order":"def","page":1,"position":0};
</script>

<div class="wrapper-box">
    <!-- 手工推广位置 -->
    
<div class="wrapper recommend-ad-section">
            <a href="http://2.fengniao.com/quality" target="_blank"><img src="/Picture/7a3aad13bcc98716c94adfdc6c98b316.jpg" alt=""></a>
            <a href="http://www.fengniao.com/topic/5348902.html" target="_blank"><img src="/Picture/b06da064c58ce0638dc1c7f1c7bac916.jpg" alt=""></a>
            <a href="http://2.fengniao.com/recycle" target="_blank"><img src="/Picture/58c551b73a325a46bd6fef9976ef4de1.jpg" alt=""></a>
            <a href="http://2.fengniao.com/service" target="_blank"><img src="/Picture/c13482ee21fbd83aec000984e35a05d9.jpg" alt=""></a>
            <a href="http://2.fengniao.com/auction" target="_blank"><img src="/Picture/7289c548662dbf135be3405711c77d7b.jpg" alt=""></a>
    </div>
    
    <!-- 面包屑 -->
    
<div class="wrapper location" id="listCrumbs">
    
    
                        
                    
    </div>

    <!-- 筛选 -->
    
<form type="price" id="listFilterForm" action="/home/goods/index" method="get">
<input type="hidden" name="pos" value="1"><ul class="wrapper filter-classification-box" id="listFilter">
                    
                        
    <li class="filter-item clearfix">
        <span class="item-title">更多：</span>
        <div class="filter-bar" style="margin:auto">
            <span class="filter-tag"><em>¥</em><input type="text" class="price" name="tp" placeholder="最低价" value="" maxlength="6"></span>
            <span class="filter-tag"><em>¥</em><input type="text" class="price" name="bp" placeholder="最高价" value="" maxlength="6"></span>
            <!-- <span class="filter-tag"><em>当前</em><input type="text" name="k" data-name="k" value="" placeholder="结果搜索"></span> -->
            <!-- <span class="filter-tag"><em>排除</em><input type="text" name="nk" data-name="nk" value="" placeholder="关键字"></span> -->
            <span class="filter-tag"><input type="text" class="seller-name" name="gname" data-name="u" value="" placeholder="卖家名称/店铺名称"></span>
            <input type="submit" class="search-button" value='筛选'></div>

    </li>
</ul>
    <script>

    </script>
<div class="wrapper search-result">
    <div class="result-count">
        小鹤已为您找到感兴趣器材
    </div>
</div>
<!-- filter-price-box -->

</form>

    <div class="wrapper clearfix">

        <div class="main">
                        
            <!-- 列表 -->
@foreach($goods as $v)
<ul class="goods-list">
    
    
            
    <li class="goods-item clearfix">
        <div class="cell-1">
            <a href="/secforum/3266418.html" target="_blank" class="goods-pic"><img src="/uploads/{{ $v->gpic }}" alt="" title=""></a>
        </div>
        <div class="cell-2" >
            <a class="goods-title"  style="display:block" name="choosegoods" rid="{{ $v->rid }}" target="_blank">{{ $v->gname }}

                                        </a>
            <div class="tags clearfix">
                &nbsp;{{ $v->describe }}
            </div>

                        
            <div class="user-box clearfix">
                <span class="city">{{ $v->raddr }}</span>
                <div class="user-bar" data-role="ser-info" data-id="10337863"></div>
            </div>
        </div>
        <div class="cell-3">
            <span class="quality-tag" style="width:150px;">{{ $v->title }}</span>
        </div>
        <div class="cell-4">
                    <div class="price-bar">
                <span class="price-tag">
                    <em class="unit">¥</em>
                                        <em class="price">{{ $v->nowprice }}</em>
                    <em class="decimal-point">.00</em>
                                    </span>
            </div>
                </div>
        <div class="cell-5">
            <div class="links">
                <a  target="_blank" class="link" rel="nofollow">浏览 {{ $v->PV }} 次</a>
                <a  target="_blank" class="link" rel="nofollow">优质良品</a>
                <p style='margin:10px auto;'>发布于 {{ $v->created_at }}</p>
            </div>
        </div>
    </li>
    
            

    
            <!--<li class="goods-item clearfix">
            <div class="extension-bit-list">
                                    <a href="http://2.fengniao.com/auction" target="_blank" class="item1"><img src="/Picture/cg-77vjc63oidtaiaabmctpmfqwaaflrwealkkaagyi471.jpg" alt="" title=""></a>
                                    <a href="http://2.fengniao.com/recycle" target="_blank" class="item2"><img src="/Picture/cg-40ljc62miyoakaabfb4zfsmeaafm1qi8trsaaf8f731.jpg" alt="" title=""></a>
                                    <a href="http://2.fengniao.com/quality" target="_blank" class="item3"><img src="/Picture/cg-4kljc61wiuboqaabqvdmnybmaaihiggdiaiaagru154.jpg" alt="" title=""></a>
                            </div>
        </li> -->
            

    </ul>
          @endforeach

          <center>{{ $goods->links() }}</center>

          <script>
              $('a[name=choosegoods]').each(function(){

                var rid = $(this).attr('rid');
                $(this).click(function(){

                    $(this).attr('href','/home/goods/details?rid='+rid);

                })
              })
          </script>
            


        </div>

        <div class="aside">
                                                            <a href="http://2.fengniao.com/auction" target="_blank" class="aside-ad-div"><img src="/Picture/cg-77vjc5y6ieaxdaac0rrlwzjwaadfcwnshjsaalre928.jpg" alt=""></a>
                                    <a href="http://2.fengniao.com/quality" target="_blank" class="aside-ad-div"><img src="/Picture/cg-4k1jc5xmigz_4aacbvujv1w8aaiy0qapsriaajtt304.jpg" alt=""></a>
                            
            <div class="hot-auction-section">
                <div class="section-header clearfix">
                    <a href="/auction" target="_blank" class="more-link">去抢拍</a>
                    <h3 class="section-title">热门拍卖</h3>
                </div>

                <ul class="auction-list hot-auction-list clearfix"></ul>
            </div>
                    </div>
    </div>
    <div class="wrapper wechat-code">
        没找到合适的器材？关注 <i>小蜂</i> ，订阅您想要的器材，有合适的器材随时推送给您，省时、省心、更省力哦。
        <div id="wechatLayerBox" class="wechat-layer-box">
            <span class="trigger">点我扫一扫订阅</span>
            <div class="wechat-layer">
                <span class="pic"><img id="qrcode" src="" alt=""></span>
            </div>
        </div>
    </div>
    <div class="wrapper appraisal-section">
        <div class="section-header clearfix">
            <a href="/quality" target="_blank" class="more-link">更多好货</a>
            <h3 class="section-title">大家都在看 </h3>
            <span class="slogan">蜂鸟鉴定好器材<a href="/quality" target="_blank"> (什么是蜂鸟鉴定？去了解)</a></span>
        </div>
        <ul class="appraisal-list clearfix"></ul>
    </div>
</div>

<div id="errorTipDialog" style="display: none;text-align: center;padding-top:15px;">
    <p>加载中...</p>
</div>
<!-- promote-footer -->
<!-- //promote-footer --><!-- foot -->

<!-- footer-box -->

 @include ('home.common.index_footer');