@extends($layout)
@section('stylesheets')

@stop
@section('scripts')
<script src="/packages/rrssb/js/rrssb.js"></script>
<script src="/assets/js/articles/results.js"></script>
@stop

@section('content')
	<style type="text/css">
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
	</style>
	<div class="col-md-8">
		@if(isset($search_text))
			<span id="rhead">All articles for '{{$search_text}}'</span>
			<h2 id="rdes">All the featured articles about {{$search_text}}. News, articles, net worth profile, and all biography about {{$search_text}}.</h2>
		@endif

		@if(count($articles) < 1)
			<span id="no_results">No results for this search</span><br>
			<span>Oink! There were no results for your search. Are we missing something?</span>
	        {!! Form::open(array('action' => 'ArticlesController@postSearch', 'class'=>'sform','role'=>"form")) !!}
		        <div class="input-group">
		          <input name="searched_text" name="searched-content" type="text" class="form-control" id="sform-input" placeholder="Search for a Celebrity...">
		          <span class="input-group-btn">
		            <button class="btn btn-primary" type="submit" >Go!</button>
		          </span>
		        </div><!-- /input-group -->
	        {!! Form::close() !!} 
	        <p>&nbsp</p>
	        <p>&nbsp</p>
	        
	    @elseif(count($articles) > 0)
	    	{!! Form::open(array('action' => 'ArticlesController@postSearch', 'class'=>'sform','role'=>"form")) !!}
		        <div class="input-group" style="margin-bottom: 20px">
		          <input name="searched_text" name="searched-content" type="text" class="form-control" id="sform-input" placeholder="Search for a Celebrity...">
		          <span class="input-group-btn">
		            <button class="btn btn-primary" type="submit" >Go!</button>
		          </span>
		        </div><!-- /input-group -->
	        {!! Form::close() !!} 
			@if(isset($articles))
				@foreach($articles as $artskey => $aval)
					<div data="{{$aval->id}}" class="article-wrapper clearfix other-results {{$artskey==0?'result-main':'not'}}">
						<div class="pull-left" style="margin-right: 28px;position: relative;">
							<div class="ad-image {{$artskey==0?'ad-image-main':'not'}}" style="background-image: url('/assets/images/articles/prm/{{$aval->image_src}}')">
	                    	</div>	
						</div>

	                    <div class="content">
	                    	<span class="ctitle cdata {{$artskey==0?'main_color':'not'}} pointer view-this">{{$aval->name}}</span>
	                    	<br>
	                    	<span class="datadate ">{!!$aval->created_at_html!!}</span>
	                    	<p style="margin: 0px 0 5px;">&nbsp</p>
	                    	<span class="cdes cdata {{$artskey==0?'main_color':'not'}}">{{$aval['new_description']}}</span>
	                    	<br>
	                    	<span class="view-this pull-right pointer"><i class="fa fa-arrow-right"></i>&nbsp{{$aval->name}} Net Worth</span>
	                    </div>

					</div>
				@endforeach
			@endif	    
		@endif
		<span id="no_results">Take a look at these pages:</span><br>
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
	                    	<span class="cdes cdata">{{$arts['new_description']}}</span>
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