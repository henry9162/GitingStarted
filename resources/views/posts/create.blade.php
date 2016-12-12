@extends('main')

@section('title', '| Create New Post')


@section('stylesheets')
	{!! Html::style('css/parsley.css') !!}
	{!! Html::style('css/select2.min.css') !!}

	<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>

	<script>
		tinymce.init({
			selector: 'textarea',
			plugins: 'link code',
			menubar: false
		});
	</script>
@endsection

@section('content')
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<h1>Create New Post</h1>
			<hr>

			{!! form::open(['route' => 'posts.store', 'data-parsley-validate' => '', 'files' => true]) !!}
				{{ form::label('title', 'Title:') }}
				{{ form::text('title', null, array('class' => 'form-control label-spacing-down', 'required' => '', 'maxlength' => '255')) }}

				{{ form::label('slug', 'Slug:') }}
				{{ form::text('slug', null, array('class' => 'form-control label-spacing-down', 'required' => '', 'minlength' => '5', 'maxlength' => '255')) }}

				{{ form::label('category_id', 'Category:') }}
				<select class="form-control label-spacing-down" name="category_id">
					@foreach ($categories as $category)
						<option value="{{ $category->id }}">{{ $category->name }}</option>
					@endforeach
				</select>

				{{ form::label('tags', 'Tags:') }}
				<select class="form-control label-spacing-down select2-multi" name="tags[]" multiple="multiple">
					@foreach ($tags as $tag)
						<option value="{{ $tag->id }}">{{ $tag->name }}</option>
					@endforeach
				</select>

				{{ form::label('featured_image', 'Upload featured image:') }}
				{{ form::file('featured_image') }}

				{{ form::label('body', 'Post Body:') }}
				{{ form::textarea('body', null, array('class' => 'form-control')) }}

				{{ form::submit('Create Post', array('class' => 'btn btn-success btn-lg btn-block', 'style' => 'margin-top: 20px')) }}
			{!! form::close() !!}
		</div>
	</div>
@endsection

@section('scripts')
	{!! Html::script('js/parsley.min.js') !!}
	{!! Html::script('js/select2.min.js') !!}

	<script type="text/javascript">
		$('.select2-multi').select2();
	</script>

@endsection