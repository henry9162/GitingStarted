@extends ('main')

@section('title', '| Edit Post')

@section('stylesheets')
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

@section ('content')

	<div class="row">
		{!! form::model($post, ['route' => ['posts.update', $post->id], 'method' => 'PUT', 'files' => true]) !!} 
		{{-- Used single curly braces cos we are not 
		outputting anything out, but just running a command, Double curly braces are used when u are outputting a code --}}

		<div class="col-md-8">
			{{ form::label('title', 'Title:') }}
			{{ form::text('title', null, ["class" => 'form-control input-lg']) }} {{-- The title there reppresent the name of the coloumn, 
			which is title<h1>{{ $post->title }}</h1> --}}

			{{ form::label('slug', 'Slug:', ['class' => 'form-spacing-top']) }}
			{{ form::text('slug', null, ["class" => 'form-control']) }}

			{{ form::label('category_id', 'Category:', ['class' => 'form-spacing-top']) }}
			{{ form::select('category_id', $categories, null, ['class' => 'form-control']) }}

			{{ form::label('tags', 'Tag:', ['class' => 'form-spacing-top']) }}
			{{ form::select('tags[]', $tags, null, ['class' => 'form-control select2-multi', 'multiple' => 'multiple']) }}

			{{ form::label('featured_image', 'Upload featured image:', ['class' => 'form-spacing-top']) }}
			{{ form::file('featured_image') }}


			{{ form::label('title', 'Body:', ['class' => 'form-spacing-top']) }}
			{{ form::textarea('body', null, ['class' => 'form-control']) }} {{-- null is the second parameter which represent size, 
			<p class="lead">{{ $post->body }}</p> --}}
			
		</div>
		<div class="col-md-4">
			<div class="well">
				<dl class="dl-horizontal">
					<dt>Create At:<dt>
					<dd>{{ date('M j, Y h:ia', strtotime($post->created_at)) }}</dd>
				</dl>

				<dl class="dl-horizontal">
					<dt>Last Updated:</dt>
					<dd>{{ date('M j, Y h:ia', strtotime($post->updated_at)) }}</dd>
				</dl>
				<hr>
				<div class="row">
					<div class="col-sm-6">
						{!! Html::linkRoute('posts.show', 'Cancel', array($post->id), array('class' => 'btn btn-danger btn-block')) !!}
					</div>
					<div class="col-sm-6">
						{{ form::submit('Save Changes', ['class' => 'btn btn-success btn-block']) }}
					</div>
				</div>

			</div>
		</div>

		{!! form::close() !!}
	</div><!-- end of .row (form) -->
@endsection

@section('scripts')
	{!! Html::script('js/select2.min.js') !!}

	<script type="text/javascript">
		$('.select2-multi').select2();
		$('.select2-multi').select2().val({!! json_encode($post->tags()->getRelatedIds()) !!}).trigger('change');
	</script>

@endsection