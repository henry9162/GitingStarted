<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Post;

class BlogController extends Controller
{
	public function getIndex()
	{
		$posts= Post::orderBy('id', 'desc')->paginate(2);

		return view('blog.index')->withPosts($posts);
	}

    public function getSingle($slug)
    //the parameter slug must correspond to the named unknown route in web
    {
    	// Fetch from the database based on slug
    	$post = Post::where('slug', '=', $slug)->first();
    	// whenver we using a query builder, we finish of with get()..remeber slug is the name of the column in database, 
    	// while $slug is the actual variable
    	// first() is same thing as get(), it just grasbs the first variable, since its just one unique variable, we use first()



    	// Return the view and pass in the post object
    	return view('blog.single')->withPost($post);
    }

}
