@extends ('main')
<?php $titleTag = htmlspecialchars($post->title); ?>
@section('title', "| $titleTag" ){{-- the double quotations do interpolation, that's the only difference betw it and single --}}

@section ('content')
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<h1>{{ $post->title }}</h1>
			<img class="img-responsive" src="{{ asset('images/' .$post->image) }}" height="400" width="800" />
			<p>{!! $post->body !!}</p>
			<hr>
			<p>Posted In: {{ $post->category->name }} </p>

			{{-- 
				* Explaining the reason behind this code $post->category->name
				* $post is an object that represent the Post mode.
				* category is a method in the Post model that relate 
				  with the categories table in a belongsTo relationship
				* Laravel doesnt need to write the category as a method anymore as in as category(),
				  but as a properties. Its just the way laravel handles it.
			 --}}

			<div class="tags">
				@foreach ($post->tags as $tag)
					<span class="label label-default">{{ $tag->name }}</span>
				@endforeach
			</div>
		</div>
	</div><br>

	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<h3 class="comments-title"><span class="glyphicon glyphicon-comment"></span> {{ $post->comments()->count() }} Comments</h3>
			@foreach ($post->comments as $comment)
				<div class="comment">
					<div class="author-info">
						<img src="{{ "https://www.gravatar.com/avatar/" .md5(strtolower(trim($comment->email))) }}" class="author-image" />
						<div class="author-name">
							<h4>{{ $comment->name }}</h4>
							<p class="author-time">{{ date('F nS, Y - g:iA',strtotime($comment->created_at)) }}</p>
						</div>

						<div class="comment-content">
							<p>{{ $comment->comment }}</p>
						</div>
					</div>
				</div>
			@endforeach
		</div>
	</div>

	<div class="row">
		<div id="comment-form" class="col-md-8 col-md-offset-2" style="margin-top:50px;">
			{{ form::open(['route' => ['comments.store', $post->id], 'method' => 'POST']) }}
				<div class="row">
					<div class="col-md-6">
						{{ form::label('name', 'Name:') }}
						{{ form::text('name', null, ['class' => 'form-control']) }}
					</div>

					<div class="col-md-6">
						{{ form::label('email', 'Email:') }}
						{{ form::text('email', null, ['class' => 'form-control']) }}
					</div>

					<div class="col-md-12">
						{{ form::label('comment', 'Comment:') }}
						{{ form::textarea('comment', null, ['class' => 'form-control label-spacing-down', 'rows' => '5']) }}

						{{ form::submit('Add Comment', ['class' => 'btn btn-success btn-block']) }}
					</div>
				</div>

			{{ form::close() }}
		</div>
	</div>
@endsection