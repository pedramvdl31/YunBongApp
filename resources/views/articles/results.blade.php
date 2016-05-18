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
		    font-family: 'Titillium Web', sans-serif;
		}		
		.cdes-other{
			margin-bottom: 12px;
		    font-family: inherit;
		    font-weight: normal;
		    font-size: 15px;
		    line-height: 18px;
		    color: black;
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
			color: white;
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
		          <input name="searched_text" name="searched-content" type="text" class="form-control" id="sform-input" placeholder="이름을 입력 해주세요...">
		          <span class="input-group-btn">
		            <button class="btn btn-primary my-btn-primary" type="submit" >Go!</button>
		          </span>
		        </div><!-- /input-group -->
	        {!! Form::close() !!} 
	        <p>&nbsp</p>
	        <p>&nbsp</p>
	        
	    @elseif(count($articles) > 0)
	    	{!! Form::open(array('action' => 'ArticlesController@postSearch', 'class'=>'sform','role'=>"form")) !!}
		        <div class="input-group" style="margin-bottom: 20px">
		          <input name="searched_text" name="searched-content" type="text" class="form-control" id="sform-input" placeholder="이름을 입력 해주세요...">
		          <span class="input-group-btn">
		            <button class="btn btn-primary my-btn-primary" type="submit" >Go!</button>
		          </span>
		        </div><!-- /input-group -->
	        {!! Form::close() !!} 
			@if(isset($articles))
				@foreach($articles as $artskey => $aval)
					<div data="{{$aval->id}}" class="article-wrapper clearfix other-results {{$artskey==0?'result-main':'not'}} col-md-12 m_col">

						<div class="col-md-4 m_col">
							<div class="pull-left" style="margin-right: 28px;position: relative;">
								<div class="ad-image {{$artskey==0?'ad-image-main':'not'}}" 
								    @if(isset($aval->image_src))
										style="background-image: url('/assets/images/articles/prm/{{$aval->image_src}}')"
								    @else
								    	style="background-image: url('/assets/images/profile-images/perm/blank_male.png')"
								    @endif
								    >
		                    	</div>	
							</div>
						</div>

						<div class="col-md-8 m_col">
							<div class="content">
		                    	<span class="ctitle cdata {{$artskey==0?'main_color':'not'}} pointer view-this">{{$aval->name}}</span>
		                    	<br>
		                    	@if(isset($aval->profession))
		                    		<span class="datadate ">{!!$aval->profession!!}</span>
		                    	@endif
		                    	<p style="margin: -6px 0;">&nbsp</p>
		                    	<span class="cdes cdata {{$artskey==0?'main_color':'not'}}">{{$aval['new_description']}}</span>
		                    	<p style="margin: -6px 0;">&nbsp</p>
		                    	<span class="view-this pointer"><i style="color: black" class="fa fa-arrow-right"></i>&nbspClick For More</span>
		                    </div>
						</div>


					</div>
				@endforeach
			@endif	    
		@endif
		<span id="no_results">더 많은 재산 또는 연봉 정보:</span><br>
		<span class="datadate">궁금했던 사람들의 연봉을 확인하세요!</span><br>
		<div id="other-results" style="padding-top: 40px">
			@if(isset($more_articles))
				@foreach($more_articles as $arts)
					<div data="{{$arts->id}}" class="article-wrapper clearfix">
						<div class="col-md-4 m_col">
							<div class="pull-left" style="margin-right: 28px;">



								<div class="ad-image" 


									@if(isset($arts->image_src))
										style="background-image: url('/assets/images/articles/prm/{{$arts->image_src}}')"
								    @else
								    	style="background-image: url('/assets/images/profile-images/perm/blank_male.png')"
								    @endif

								>
		                    	</div>	
							</div>
						</div>
						<div class="col-md-8 m_col">
		                    <div class="content">
		                    	<span class="ctitle cdata view-this pointer">{{$arts->name}}</span>
		                    	<br>
		                    	@if(isset($arts->title))
		                    		<span class="datadate ">{!!$arts->title!!}</span>
		                    	@endif
		                    	<p style="margin: -6px 0;">&nbsp</p>
		                    	<span class="cdes-other cdata">{{$arts['new_description']}}</span>
		                    	<p style="margin: -6px 0;">&nbsp</p>
		                    	<span class="view-this pointer"><i class="fa fa-arrow-right"></i>&nbspClick For More</span>
		                    </div>
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