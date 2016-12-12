@extends ('main')

@section('title', "| All Categories" )

@section ('content')
	<div class="row">
		<div class="col-md-8">
			<h1>Categories</h1>
			<table class="table">
				<thead>
					<tr>
						<th>#</th>
						<th>Name:</th>
					</tr>
				</thead>

				<tbody>
					@foreach ($categories as $category)
					<tr>
						<th>{{ $category->id }}</th> {{-- th just makes the text bold --}}
						<td>{{ $category->name }}</td>
					</tr>
					@endforeach
				</tbody>
			</table>	
		</div><!-- end of col-md-8 -->

		<div class="col-md-3">
			<div class="well">
				{!! form::open(['route' => 'categories.store', 'method'=> 'POST']) !!}
					<h2>New Category</h2>
					{{ form::label('name', 'Name:') }}
					{{ form::text('name', null, ['class' => 'form-control']) }}

					{{ form::submit('Create New Category', ['class' => 'btn btn-primary btn-block btn-sm form-spacing-top']) }}

				{!! form::close() !!}
			</div>
		</div>
	</div>
@endsection