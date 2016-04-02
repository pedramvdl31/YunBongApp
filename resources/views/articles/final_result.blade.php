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
		font-size: 34px !important;
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
</style>
<div class="col-md-8">
	<span class="ptitle">{{$articles->name}} Net Worth</span>
	<span>How much is {{$articles->name}} Worth? in Richest Businessmen › Richest Billionaires</span>
	<p>&nbsp</p>
	<div class="netw">
		<span class="ntitle">{{$articles->name}} net worth:</span>
		<span class="netv">{{$articles->net}}</span>	
	</div>
	@if(isset($articles->salary) && $articles->salary!='')
		<div class="netw">
			<span class="ntitle">{{$articles->name}} Salary:</span>
			<span class="netv">{{$articles->salary}}</span>	
		</div>
	@endif
	<div class="col-md-12" style="padding-left: 0">
		<div class="main-img-res col-md-6" style="padding-left: 0">
			<div class="ad-image-main-res" style="background-image: url('/assets/images/articles/prm/{{$articles->image_src}}')">
	    	</div>	
		</div>	
		<div class="post-des">
			<p class="post-des-p" >
				{!!$articles->description_new!!}
			</p>
		</div>		
	</div>

	<div class="more-info col-md-12" style="padding-left: 0">


		<div class="par netw">
			<span class="mtitle">{{$articles->name}}</span>
			@if(isset($articles->title) && $articles->title!='')
				<div class="prof">
					<span class="prof-txt">{{$articles->title}}</span>	
				</div>
			@endif		
			@if(isset($articles->dob) && $articles->dob!='')
				<div class="data-wrapper">
					<h5 class="header-d">Date of Birth</h5>
					<span class="data-text">{{$articles->dob}}</span>	
				</div>
			@endif		
			@if(isset($articles->profession) && $articles->profession!='')
				<div class="data-wrapper">
					<h5 class="header-d">Profession</h5>
					<span class="data-text">{{$articles->profession}}</span>	
				</div>
			@endif		
			@if(isset($articles->nationality) && $articles->nationality!='')
				<div class="data-wrapper">
					<h5 class="header-d">Nationality</h5>
					<span class="data-text">{{$articles->nationality}}</span>	
				</div>
			@endif		
			@if(isset($articles->height) && $articles->height!='')
				<div class="data-wrapper">
					<h5 class="header-d">Height</h5>
					<span class="data-text">{{$articles->height}}</span>	
				</div>
			@endif		
			@if(isset($articles->weight) && $articles->weight!='')
				<div class="data-wrapper">
					<h5 class="header-d">Weight</h5>
					<span class="data-text">{{$articles->weight}}</span>	
				</div>
			@endif
			@if(isset($articles->ethnicity) && $articles->ethnicity!='')
				<div class="data-wrapper">
					<h5 class="header-d">Ethnicity</h5>
					<span class="data-text">{{$articles->ethnicity}}</span>	
				</div>
			@endif
			@if(isset($articles->nicknames) && $articles->nicknames!='')
				<div class="data-wrapper">
					<h5 class="header-d">Nicknames</h5>
					<span class="data-text">{{$articles->nicknames}}</span>	
				</div>
			@endif
		<div class="fb-comments" data-href="http://yunbong.app:8000/view/comments/{{$articles->id}}" data-width="100%" data-numposts="5"></div>
		</div>
	</div>


	<br><span id="no_results">Take a look at these pages:</span><br>
	<span class="datadate">Our latest articles on the richest celebrities</span><br>
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
                    	<span class="datadate">{!!$arts->created_at_html!!}</span>
                    	<p style="margin: 0px 0 5px;">&nbsp</p>
                    	<span class="cdes cdata">{!!$arts['new_description']!!}</span>
                    	<br>
                    	<span class="view-this pull-right pointer"><i class="fa fa-arrow-right"></i>&nbsp{{$arts->name}} Net Worth</span>
                    </div>
				</div>
			@endforeach
		@endif
	</div>
</div>
<div class="col-md-4">

	<div class="fb-page" data-href="https://www.facebook.com/yunbong.net/" data-tabs="timeline" data-width="300" data-height="300" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"></div>
</div>

@stop