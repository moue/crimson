<!-- Tabs -->
<ul class="nav nav-tabs">
	<li class="active"><a href="#tab-general" data-toggle="tab">General</a></li>
    <li><a href="#tab-media" data-toggle="tab">Media</a></li>
</ul>
<!-- ./ tabs -->

<!-- Tabs Content -->
<div class="tab-content">
	<!-- General tab -->
	<div class="tab-pane active" id="tab-general">
	
		<!-- Section Category -->
		<div class="form-group">
            {{ Form::label('section', 'Section') }}
            {{ Form::select('section', $section, null, array('class'=>'form-control')) }}
		</div>
		<!-- ./ section category -->
	
		<!-- Post Title -->
		<div class="form-group {{{ $errors->has('title') ? 'has-error' : '' }}}">
            {{ Form::label('title', 'Article Title') }}
            {{ Form::text('title', null, array('class'=>'form-control')) }}
			{{{ $errors->first('title', ':message', array('class'=>'help-block')) }}}
		</div>
		<!-- ./ post title -->
		
		<!-- Post Writer -->
		<div class="form-group">
			{{ Form::label('writer', 'Article Writer', array('class'=>'control-label')) }}
			{{ Form::select('writer', $users, null, array('class'=>'form-control')) }}
		</div>
		<!-- ./ post writer -->

		<!-- Content -->
		<div class="form-group {{{ $errors->has('content') ? 'has-error' : '' }}}">
			{{ Form::label('content', 'Content') }}
			{{ Form::textarea('content', null, array('class'=>'form-control full-width wysihtml5', 'rows'=>'10')) }}
			{{{ $errors->first('content', ':message', array('class'=>'help-block')) }}}
		</div>
		<!-- ./ content -->
	</div>
	<!-- ./ general tab -->

	<!-- Media tab -->
	<div class="tab-pane" id="tab-media">
		<!-- Image Upload -->
		<div class="form-group {{{ $errors->has('meta-title') ? 'has-error' : '' }}}">
            {{ Form::label('image', 'Upload Image') }}
            {{ Form::file('image') }}
			{{{ $errors->first('meta-title', ':message', array('class'=>'help-block')) }}}
		</div>
		<!-- ./ Image Upload -->

		<!-- Photographer -->
		<div class="form-group {{{ $errors->has('meta-description') ? 'has-error' : '' }}}">
            {{ Form::label('photog', 'Photo Credit') }}
			{{ Form::select('photog', $users, null, array('class'=>'form-control')) }}
			{{{ $errors->first('photog', ':message', array('class'=>'help-block')) }}}
		</div>
		<!-- ./ Photographer -->

		<!-- Meta Keywords -->
		<div class="form-group {{{ $errors->has('meta-keywords') ? 'has-error' : '' }}}">
			{{ Form::label('caption', 'Caption') }}
			{{ Form::textarea('snippit', null, array('class'=>'form-control', 'rows'=>2)) }}
		</div>
		<!-- ./ meta keywords -->
	</div>
	<!-- ./ meta data tab -->
</div>
<!-- ./ tabs content -->

<!-- Form Actions -->
<div class="form-group">
	<element class="btn-cancel close_popup">Cancel</element>
	<button type="submit" class="btn btn-success">Submit</button>
</div>