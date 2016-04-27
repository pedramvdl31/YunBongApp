@extends($layout)
@section('stylesheets')
      {!! Html::style('/assets/css/home/homepage.css') !!}
@stop
@section('scripts')
      <script src="/assets/js/homepage.js"></script>
@stop

@section('content')
    <div class="text-center" id="my-title">
        <img src="/assets/images/brand_image/perm/b1.jpg">
    </div>
	    <div class="" id="search-input">
	        {!! Form::open(array('action' => 'ArticlesController@postSearch', 'class'=>'sform','role'=>"form")) !!}
		        <div class="input-group">
		          <input name="searched_text" name="searched-content" type="text" class="form-control" id="sform-input" placeholder="이름을 입력해 주세요">
		          <span class="input-group-btn">
		            <button class="btn btn-primary my-btn-primary" type="submit" >Go!</button>
		          </span>
		        </div><!-- /input-group -->
	        {!! Form::close() !!} 
	        
	        {!! Form::open(array('action' => 'ArticlesController@postSearchRand', 'class'=>'','role'=>"form")) !!}
		        <div id="sbtn">
		            <button class="btn btn-danger">내가 골라줄게!</button>
		        </div>
	        {!! Form::close() !!} 
	    </div>  
     
@stop