@extends ('main')

@section('title', "| Edit Tag")

@section ('content')

	{!! form::model($tag, ['route' => ['tags.update', $tag->id], 'method' => "PUT"]) !!}

		{{ form::label('name', "Title:") }}
		{{ form::text('name', null, ['class' => 'form-control']) }}

		{{ form::submit('Save Changes', ['class' => 'btn btn-success', 'style' => 'margin-top:20px;']) }}
	{!! form::close() !!}

@endsection

