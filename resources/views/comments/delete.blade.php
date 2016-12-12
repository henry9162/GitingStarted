@extends('main')

@section('title', '|Delete Comment?')

@section('content')
	
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<h4>DELETE THIS COMMENT</h4>
			<hr>
			<p>
				<strong>Name:</strong> {{ $comment->name }}<br>
				<strong>Email:</strong> {{ $comment->email }}<br>
				<strong>Comment:</strong> {{ $comment->comment }}
			</p>

			{{ form::open(['route' => ['comments.destroy', $comment->id], 'method' => 'DELETE']) }}
				{{ form::submit('YES DELETE THIS COMMENT', ['class' => 'btn btn-md btn-block btn-danger']) }}
			{{ form::close() }}
		</div>
	</div>

@endsection