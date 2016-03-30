@extends($layout)
@section('stylesheets')

@stop
@section('scripts')
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
<script src="/assets/js/articles/add.js"></script>
@stop

@section('content')
<style type="text/css">
  /* This is copied from https://github.com/blueimp/jQuery-File-Upload/blob/master/css/jquery.fileupload.css */
   .fileinput-button {
      position: relative;
      overflow: hidden;
      margin-left: 30px;
  }
  /*Also*/
   .fileinput-button input {
      position: absolute;
      top: 0;
      right: 0;
      margin: 0;
      opacity: 0;
      -ms-filter:'alpha(opacity=0)';
      font-size: 200px;
      direction: ltr;
      cursor: pointer;
  }
</style>
<div class="jumbotron">
  <h1>Articles Add</h1>
</div>
<div class="panel panel-default">


  <div class="panel-body">


    <div class="form-group {!! $errors->has('celebrity_image') ? 'has-error' : false !!}">
      <img src="/assets/images/profile-images/perm/blank_male.png" alt="..." class="img-rounded profile_img" width="125px">
      <span class="btn btn-success fileinput-button">
            <span>Change Avatar</span>
            <form id="file-form" action="handler.php" method="POST" >
              <input type="file" name="file" id="form-submit-btn">
            </form>
        </span>
        @foreach($errors->get('celebrity_image') as $message)
            <span class='help-block'>{{ $message }}</span>
        @endforeach
    </div>


    {!! Form::open(array('action' => 'ArticlesController@postAdd', 'class'=>'','role'=>"form")) !!}
    <input type="hidden" name="celebrity_image" id="imagename" value=""></input>

    <div class="form-group {{ $errors->has('name') ? 'has-error' : false }}">
      <label class="control-label" for="name">Name*</label>
      {!! Form::text('name', null, array('class'=>'form-control', 'placeholder'=>'Name')) !!}
        @foreach($errors->get('name') as $message)
            <span class='help-block'>{{ $message }}</span>
        @endforeach
    </div>

    <div class="form-group {{ $errors->has('title') ? 'has-error' : false }}">
      <label class="control-label" for="title">Title (short description)</label>
      {!! Form::text('title', null, array('class'=>'form-control', 'placeholder'=>'Title')) !!}
        @foreach($errors->get('title') as $message)
            <span class='help-block'>{{ $message }}</span>
        @endforeach
    </div>

    <div class="form-group {{ $errors->has('nicknames') ? 'has-error' : false }}">
      <label class="control-label" for="nicknames">Nicknames</label>
      {!! Form::text('nicknames', null, array('class'=>'form-control', 'placeholder'=>'Nicknames')) !!}
        @foreach($errors->get('nicknames') as $message)
            <span class='help-block'>{{ $message }}</span>
        @endforeach
    </div>

    <div class="form-group {{ $errors->has('networth') ? 'has-error' : false }}">
      <label class="control-label" for="networth">Net Worth*</label>
      {!! Form::text('networth', null, array('class'=>'form-control', 'placeholder'=>'Net Worth')) !!}
        @foreach($errors->get('networth') as $message)
            <span class='help-block'>{{ $message }}</span>
        @endforeach
    </div>

    <div class="form-group {{ $errors->has('dob') ? 'has-error' : false }}">
      <label class="control-label" for="dob">Date of Birth</label>
      {!! Form::text('dob', null, array('class'=>'form-control', 'placeholder'=>'Date of Birth')) !!}
        @foreach($errors->get('dob') as $message)
            <span class='help-block'>{{ $message }}</span>
        @endforeach
    </div>

    <div class="form-group {{ $errors->has('profession') ? 'has-error' : false }}">
      <label class="control-label" for="profession">Profession</label>
      {!! Form::text('profession', null, array('class'=>'form-control', 'placeholder'=>'Profession')) !!}
        @foreach($errors->get('profession') as $message)
            <span class='help-block'>{{ $message }}</span>
        @endforeach
    </div>

    <div class="form-group {{ $errors->has('nationality') ? 'has-error' : false }}">
      <label class="control-label" for="nationality">Nationality</label>
      {!! Form::text('nationality', null, array('class'=>'form-control', 'placeholder'=>'Nationality')) !!}
        @foreach($errors->get('nationality') as $message)
            <span class='help-block'>{{ $message }}</span>
        @endforeach
    </div>

    <div class="form-group {{ $errors->has('height') ? 'has-error' : false }}">
      <label class="control-label" for="height">Height</label>
      {!! Form::text('height', null, array('class'=>'form-control', 'placeholder'=>'Height')) !!}
        @foreach($errors->get('height') as $message)
            <span class='help-block'>{{ $message }}</span>
        @endforeach
    </div>

    <div class="form-group {{ $errors->has('weight') ? 'has-error' : false }}">
      <label class="control-label" for="weight">Weight</label>
      {!! Form::text('weight', null, array('class'=>'form-control', 'placeholder'=>'Weight')) !!}
        @foreach($errors->get('weight') as $message)
            <span class='help-block'>{{ $message }}</span>
        @endforeach
    </div>

    <div class="form-group {{ $errors->has('ethnicity') ? 'has-error' : false }}">
      <label class="control-label" for="ethnicity">Ethnicity</label>
      {!! Form::text('ethnicity', null, array('class'=>'form-control', 'placeholder'=>'Ethnicity')) !!}
        @foreach($errors->get('ethnicity') as $message)
            <span class='help-block'>{{ $message }}</span>
        @endforeach
    </div>

    <div class="form-group {{ $errors->has('salary') ? 'has-error' : false }}">
      <label class="control-label" for="salary">Salary</label>
      {!! Form::text('salary', null, array('class'=>'form-control', 'placeholder'=>'Salary')) !!}
        @foreach($errors->get('salary') as $message)
            <span class='help-block'>{{ $message }}</span>
        @endforeach
    </div>

    <div class="form-group {{ $errors->has('description') ? 'has-error' : false }}">
      <label class="control-label" for="description">Description*</label>
          {!! Form::textarea('description', null, ['class' => 'des field form-control','size' => '30x8', 'placeholder'=>'Description']) !!}
        @foreach($errors->get('description') as $message)
            <span class='help-block'>{{ $message }}</span>
        @endforeach
    </div>


  </div>
  <div class="panel-footer clearfix">
    <a href="{!! route('articles_index') !!} " class="btn btn-info">Back</a>
    <button type="submit" name="submit" class="btn btn-primary pull-right">Add</button>
  </div>
    {!! Form::close() !!}
</div>
@stop