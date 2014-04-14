@extends('admin.layouts.modal')

{{-- Content --}}
@section('content')

	{{-- Create a post form --}}
	<!-- Form -->
	{{ Form::model($post, ['method'=>'POST', 'action'=>['AdminPostsController@postEdit', $post->id], 'files'=>true]) }}
	
	@include('admin.posts.form')

	{{ Form::close() }}
	<!-- ./ form -->

@stop
