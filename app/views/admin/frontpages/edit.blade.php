@extends('admin.layouts.modal')

@section('content')
  <div class="row">
    <div class="col-md-8">  
      <div class="well">
        <p class="lead"><a href="{{ url('admin/frontpage')}}" class="btn btn-default pull-right">Go Back</a> frontpage:</p>

		{{ Form::model($item, array('url' => "admin/frontpage/edit/{$item->id}", 'class' => 'form-horizontal')) }}
		@include('admin.frontpage.form')
		{{ Form::close()}}
      </div>
    </div>
    
  </div>
@stop