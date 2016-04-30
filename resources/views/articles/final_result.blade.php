@extends($layout)
@section('stylesheets')
	{!! Html::style('/packages/rrssb/css/rrssb.css') !!}
@stop
@section('scripts')
	<script src="/packages/rrssb/js/rrssb.js"></script>
	<script src="/assets/js/articles/results.js"></script>
@stop

@section('content')

<style type="text/css">
	.ptitle{
		display: block;
	    font-family: inherit;
	    font-weight: 700;
	    letter-spacing: 0;
	    text-transform: none;
	    font-style: normal;
	    font-size: 40px;
	    line-height: 34px;
	    color: #0d6161;
	    margin: 0 0 3px 0;
	}
	#no_results {
	    font-size: 28px;
	    line-height: 32px;
	    font-weight: 700;
	    color: #008080;
	    margin-bottom: 3px;
	}
	.ad-image {
	    width: 146px;
		height: 146px;
		border-radius: 50%;
	    background-size: cover;
	    background-repeat: no-repeat;
	    background-position: 50% 50%;
	}
	.ctitle{
	    font-family: inherit;
	    font-weight: normal;
	    font-size: 28px;
	    line-height: 32px;
	    color: #008080;
	    font-family: 'Titillium Web', sans-serif;
	}
	.cdes{
		margin-bottom: 12px;
	    font-family: inherit;
	    font-weight: normal;
	    font-size: 15px;
	    line-height: 18px;
	    color: #222222;
	    font-family: 'Titillium Web', sans-serif;
	}
	.cdata{
	}
	.article-wrapper{
		margin: 0 0 24px 0;
	}
	.datadate{
		font-family: inherit;
	    font-weight: normal;
	    font-size: 13px;
	    line-height: 16px;
	    color: #AEAEAE;
	    margin-bottom: 18px;
	}
	.result-main{
		background-color: #116e6c;
		color: white !important;
	}
	.other-results{
		padding: 20px 10px 20px 20px;
	}
	.main_color{
		color: white !important;
	}
	.star-wrapper{
		font-size: 42px;
	    position: absolute;
	    right: -8px;
	    top: -6px;
	}
	.star-i-wrapper{
		color: #006C84;
	}
	.ad-image-main:before{
	    content: ".";
	    text-indent: -9999px;
	    font-size: 1px;
	    color: transparent;
	    position: absolute;
	    z-index: 500;
	    top: -8px;
	    right: -4px;
	    display: block;
	    width: 46px;
	    height: 46px;
	    background: transparent url('/assets/images/icon-top-spot.png') no-repeat left top;
	}
	.main-container{
		padding-top: 20px !important;
	}
	#rhead{
		font-weight: bold;
	    color: #116e6c;
	    margin-bottom: 6px;
	    font-size: 28px;
	    line-height: 28px;
	}
	#rdes{
		display: block;
	    margin: 0 0 10px 0;
	    padding: 0;
	    font-family: inherit;
	    font-size: inherit;
	    font-weight: inherit;
	    line-height: inherit;
	    color: inherit;
	    text-transform: inherit;
	}
	.netw{
		font-family: 'Titillium Web', Georgia, serif;
	    font-size: 22px;
	    line-height: 22px;
	    font-weight: 600;
	    color: #000000;
	    padding-bottom: 18px;

	}
	.ntitle{
	    display: block;
	    font-family: inherit;
	    font-size: inherit;
	    line-height: inherit;
	    font-weight: inherit;
	    color: inherit;
	}
	.netv{
		display: block;
		font-family: inherit;
		font-weight: 700;
		color: #0d6161;
		font-size: 30px !important;
    	line-height: 38px !important;
	}
	.post-des{
		font-family: 'Titillium Web', sans-serif;
	    font-size: 16px;
	    line-height: 1.5em;
	    font-weight: normal;
	    color: #222222;
	}
	.post-des-p{
	    margin: 0;
	    font-weight: inherit;
	    font-size: inherit;
	    line-height: inherit;
	    font-family: inherit;
	    color: inherit;
	}
	.ad-image-main-res {
    width: 100%;
    height: 280px;
    background-size: cover;
    background-repeat: no-repeat;
    background-position: 50% 50%;
	}
	.mtitle{
		font-family: inherit;
	    font-weight: 600;
	    font-size: 31px;
	    line-height: 34px;
	    color: #1b5c57;
	    text-transform: inherit;
	}
	.prof{
		font-family: inherit;
	    font-weight: 400;
	    font-size: 15px;
	    line-height: 17px;
	    color: #000000;
	    text-transform: inherit;
	    padding-top: 3px;
	}
	.prof-txt{
		font-family: inherit;
	    font-weight: inherit;
	    font-size: inherit;
	    line-height: inherit;
	    color: inherit;
	    text-transform: inherit;
	}
	.data_wrapper{
		display: block;
    	margin-bottom: 18px;
	}
	.header-d{
		font-family: inherit;
	    font-weight: 700;
	    font-size: inherit;
	    line-height: inherit;
	    color: #000000;
	    margin-bottom: 2px;
	    
	}
	.data-wrapper{
		font-size: 15px;
	}
	.data-text{
		font-weight: 400;
	}
	#cnw_share_fb .cnw_share_fb_anchor {
	    display: inline-block;
	    padding: 10px 10px 10px 28px;
	    background: #365899 url('images/cnw_profile/share-fb.png') no-repeat 12px center;
	    outline: none;
	    font-family: 'Titillium Web', sans-serif;
	    font-size: 14px;
	    line-height: 14px;
	    font-weight: 600;
	    color: #ffffff;
	    cursor: pointer;
	    border-radius: 2px;
	}

	#single__bar {
    list-style: none;
    margin: 0 0 12px 0;
    padding: 0;
    display: table;
    width: 100%;
	}
	#single__bar > li {
    float: left;
    padding-right: 6px;
    font-family: 'Titillium Web', Georgia, serif;
    font-size: 14px;
    line-height: 14px;
	}
	#single__bar > li.facebook > .anchor {
    	background-color: #365899;
	}
	#single__bar > li .anchor {
    position: relative;
    display: block;
    font-family: inherit;
    font-size: inherit;
    line-height: inherit;
    font-weight: 600;
    color: #ffffff;
    padding: 14px;
    border-radius: 2px;
	}
	a {
    color: #008080;
    text-decoration: none;
    outline: none;
    cursor: pointer;
	}
	#single__bar > li.icon.share > .anchor:before {
    top: 0;
    left: 0;
    width: 28px;
    height: 35px;
    background-color: transparent;
    background-repeat: no-repeat;
    background-position: center center;
    background-size: 20px 20px;
	}

	#single__bar > li.icon > .anchor:before {
    content: ".";
    text-indent: -9999px;
    font-size: 1px;
    color: transparent;
    position: absolute;
    display: block;
	}
	.btn-bar{
		padding: 10px 0 18px 0;
	}
	.btn-rnd-search{
		background-color: #008080 !important;
    	font-weight: 700 !important;
    	text-transform: uppercase !important;
    	color: white;
	}
	.btn-rnd-search:hover, .btn-rnd-search:focus{
    	color: white !important;
	}
	.link-color{
		    color: #0d6161;
	}
	/*==========  Non-Mobile First Method  ==========*/

    /* Large Devices, Wide Screens */
    @media only screen and (max-width : 1200px) {

    }

    /* Medium Devices, Desktops */
    @media only screen and (max-width : 992px) {

    }

    /* Small Devices, Tablets */
    @media only screen and (max-width : 768px) {

    }

    /* Extra Small Devices, Phones */ 
    @media only screen and (max-width : 480px) {
    	.my-btns{
    		width: 100%;
    	}
		.btn-rnd-search{
			margin-top: 10px;
		}
		.my-cols{
			padding-left: 0;
			padding-right: 0;
		}

    }

    /* Custom, iPhone Retina */ 
    @media only screen and (max-width : 320px) {
        .my-btns{
    		width: 100%;
    	}
    	.btn-rnd-search{
			margin-top: 10px;
		}
		.my-cols{
			padding-left: 0;
			padding-right: 0;
		}
    }

</style>
<div class="col-md-9 clearfix">
	<span class="ptitle">{{$articles->name}}</span>
	<span>{{$articles->name}} Worth? in <span class="link-color">Richest Businessmen</span> › <span class="link-color">Richest Billionaires</span></span>



	<div class="btn-bar col-md-12 clearfix" style="padding-left: 0;padding-right: 0">


		<a  target="_blank" class="btn btn-primary my-btns fb-share" title="send to Facebook" 
	  		href="https://www.facebook.com/dialog/feed?
			  app_id=1124383754261581&amp;
			  display=popup&amp;
			  caption=Yunbong.net&amp;
			  description={{$articles['short_description']}}&amp;
			  name={{$articles->name}}&nbspNet&nbspWorth&amp;
			  link={!!Request::url()!!}&amp;
			  redirect_uri={!!Request::url()!!}&amp;
			  picture={!!Request::root()!!}/assets/images/articles/prm/{{$articles->image_src}}">
			  <i class="fa fa-lg fa-facebook"></i>
			  &nbsp&nbsp소문&nbsp내기
		</a>


		<a href="/rand-articles" class="btn btn-rnd-search pull-right my-btns">
			<span>랜덤</span> 
		<img style="background: white;margin-top: -3px;" width="21px" height="21px" src="/assets/images/icons/dice.png">
		</a>


	</div>
	<style type="text/css">
	.references,.mw-ext-cite-error, .infobox{
		display: none;
	}
	</style>


	<div class="col-md-12">
		<div class="col-md-5 my-cols" style="padding-left: 0">
			<div class="main-img-res col-md-12 my-cols" style="padding-left: 0">
				<div class="ad-image-main-res" style="background-image: url('/assets/images/articles/prm/{{$articles->image_src}}')">
		    	</div>	
			</div>	
			<div class="par netw">
				<span class="mtitle">{{$articles->name}}</span>
				@if(isset($articles->title) && $articles->title!='')
					<div class="prof">
						<span class="prof-txt">{{$articles->title}}</span>	
					</div>
				@endif		
				@if(isset($articles->dob) && $articles->dob!='')
					<div class="data-wrapper">
						<h5 class="header-d">생년월일</h5>
						<span class="data-text">{{$articles->dob}}</span>	
					</div>
				@endif		
				@if(isset($articles->profession) && $articles->profession!='')
					<div class="data-wrapper">
						<h5 class="header-d">직업</h5>
						<span class="data-text">{{$articles->profession}}</span>	
					</div>
				@endif		
				@if(isset($articles->nationality) && $articles->nationality!='')
					<div class="data-wrapper">
						<h5 class="header-d">국적</h5>
						<span class="data-text">{{$articles->nationality}}</span>	
					</div>
				@endif		
				@if(isset($articles->height) && $articles->height!='')
					<div class="data-wrapper">
						<h5 class="header-d">키</h5>
						<span class="data-text">{{$articles->height}}</span>	
					</div>
				@endif		
				@if(isset($articles->weight) && $articles->weight!='')
					<div class="data-wrapper">
						<h5 class="header-d">몸무게</h5>
						<span class="data-text">{{$articles->weight}}</span>	
					</div>
				@endif
				@if(isset($articles->ethnicity) && $articles->ethnicity!='')
					<div class="data-wrapper">
						<h5 class="header-d">특이사항</h5>
						<span class="data-text">{{$articles->ethnicity}}</span>	
					</div>
				@endif
				@if(isset($articles->nicknames) && $articles->nicknames!='')
					<div class="data-wrapper">
						<h5 class="header-d">별명</h5>
						<span class="data-text">{{$articles->nicknames}}</span>	
					</div>
				@endif
			</div>
		</div>

		<div class="more-info" style="padding-left: 0">
			<div class="netw">
				<span class="ntitle">{{$articles->name}} 재산:</span>
				<span class="netv">{{$articles->net}}</span>	
			</div>
			@if(isset($articles->salary) && $articles->salary!='')
				<div class="netw">
					<span class="ntitle">{{$articles->name}} 연봉:</span>
					<span class="netv">{{$articles->salary}}</span>	
				</div>
			@endif
			<div class="post-des">
				<p class="post-des-p" >
					{!!$des_re!!}
				</p>
			</div>	
		</div>	

	</div>


	<div class="fb-comments" data-href="http://yunbong.app:8000/view/comments/{{$articles->code}}" data-width="100%" data-numposts="5"></div>
</div>
<div class="col-md-3">
	<div class="fb-page" data-href="https://www.facebook.com/yunbong.net/" data-tabs="timeline" data-width="300" data-height="300" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"></div>
</div>

<div class="col-md-12">
	<br><span id="no_results">더 많은 재산 또는 연봉 정보:</span><br>
	<span class="datadate">궁금했던 사람들의 연봉을 확인하세요!</span><br>
	<div id="other-results" style="padding-top: 40px">
		@if(isset($more_articles))
			@foreach($more_articles as $arts)
				<div data="{{$arts->id}}" class="article-wrapper clearfix">
					<div class="pull-left" style="margin-right: 28px;">
						<div class="ad-image" style="background-image: url('/assets/images/articles/prm/{{$arts->image_src}}')">
                    	</div>	
					</div>

                    <div class="content">
                    	<span class="ctitle cdata view-this pointer">{{$arts->name}}</span>
                    	<br>
                    	@if(isset($arts->profession))
                    		<span class="datadate ">{!!$arts->profession!!}</span>
                    	@endif
                    	<p style="margin: 0px 0 5px;">&nbsp</p>
                    	@if(isset($arts['new_description']))
                    		<span class="cdes cdata">{!!$arts['new_description']!!}</span>
                    	@endif
                    	<br>
                    	<span class="view-this pull-right pointer"><i class="fa fa-arrow-right"></i>&nbspClick For More</span>
                    </div>
				</div>
			@endforeach
		@endif
	</div>
</div>

@stop