@extends ('main')

@section('title', '| Edit Comment')

@section ('content')

	<div class="col-md-8 col-md-offset-2">
		<h1>Edit Comment</h1>

		{{ form::model($comment, ['route' => ['comments.update', $comment->id], 'method' => "PUT"]) }}
			{{ form::label('name', 'Name:') }}
			{{ form::text('name', null, ['class' => 'form-control', 'disabled' => '']) }}

			{{ form::label('email', 'Email:') }}
			{{ form::text('email', null, ['class' => 'form-control', 'disabled' => '']) }}

			{{ form::label('comment', 'Comments:') }}
			{{ form::textarea('comment', null, ['class' => 'form-control']) }}

			{{ form::submit('Update Comment', ['class' => 'btn btn-block btn-success', 'style' => 'margin-top:15px;']) }}

		{{ form::close() }}
	</div>
@endsection