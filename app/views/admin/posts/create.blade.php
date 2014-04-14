@extends('admin.layouts.modal')

{{-- Content --}}
@section('content')

	{{-- Create a post form --}}
	<!-- Form -->
	{{ Form::model(new Post, ['method'=>'POST', 'action'=>'AdminPostsController@postCreate', 'files'=>true]) }}
	
	@include('admin.posts.form')

	{{ Form::close() }}
	<!-- ./ form -->

@stop
