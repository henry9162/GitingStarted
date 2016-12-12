@extends ('main')

@section('title', "| All Tags" )

@section ('content')
	<div class="row">
		<div class="col-md-8">
			<h1>Tags</h1>
			<table class="table">
				<thead>
					<tr>
						<th>#</th>
						<th>Name</th>
					</tr>
				</thead>

				<tbody>
					@foreach ($tags as $tag)
					<tr>
						<th>{{ $tag->id }}</th> {{-- th just makes the text bold --}}
						<td><a href="{{ route('tags.show', $tag->id) }}">{{ $tag->name }}</a></td>
					</tr>
					@endforeach
				</tbody>
			</table>	
		</div><!-- end of col-md-8 -->

		<div class="col-md-3">
			<div class="well">
				{!! form::open(['route' => 'tags.store', 'method'=> 'POST']) !!}
					<h2>New Tag</h2>
					{{ form::label('name', 'Name:') }}
					{{ form::text('name', null, ['class' => 'form-control']) }}

					{{ form::submit('Create New Tag', ['class' => 'btn btn-primary btn-block btn-sm form-spacing-top']) }}

				{!! form::close() !!}
			</div>
		</div>
	</div>
@endsection