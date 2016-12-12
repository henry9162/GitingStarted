<?php

namespace App\Http\Controllers;

use Session;

use App\Post;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Category;

use App\Tag;

use Purifier;

use Image;

use Storage;


class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $post= Post::orderBy('id', 'desc')->paginate(5);
        return view('posts.index')->withPosts($post);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('posts.create')->withCategories($categories)->withTags($tags);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validate the data
        $this->validate($request, [
            'title' => 'required|max:255',
            'slug'  => 'required|alpha_dash|min:5|max:255|unique:posts,slug',
            'category_id' => 'required|integer',
            'body'  => 'required',
            'featured_image' => 'sometimes|image'
        ]);

        //store in the database
        //instance of a model
        $post = new Post;

        $post->title = $request->title;
        $post->slug = $request->slug;
        $post->category_id = $request->category_id;
        $post->body = Purifier::clean($request->body);

        if($request->hasFile('featured_image'))
        {
            $image = $request->file('featured_image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $location = public_path('images/' . $filename);
            Image::make($image)->resize(800, 400)->save($location);

            $post->image = $filename;
        } else { dd('No image file was passed through'); }

        $post->save();

        $post->tags()->sync($request->tags, false);
        // $post = Our post model
        // tag() = Our tags relationship in the post model($post).
        // $request->tags == grabs all the values(id) in the tags table.
        // false == Meaning not deleting any previous set relationship when saved, it is true by default.
        // it must be set to true in edit, so it will remove and then add relationships, since we are updating.
        // Note this relationship could be vice vasal if needed.

        Session::flash('success', 'The blog post was successfully saved!');

        //redirect to another page
        return redirect()->route('posts.show', $post->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        return view('posts.show')->withPost($post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //Find the post in the database and save it as a variable
        $post = Post::find($id);
        $categories = Category::all();
        $cats = [];
        foreach ($categories as $category){
            $cats[$category->id] = $category->name;
        }
        // This is where the values in the category_id in the posts column is added
        // and since it is added from $category->id, therefore, it tallies automatically with the id in category table 

        $tags = Tag::all();
        $tags2 = [];
        foreach ($tags as $tag){
            $tags2[$tag->id] = $tag->name;
            // Because in the edit, we are storing mainly the id, but we waant humans to see it names thats why we equate them
        }
        //Return the view an pass in the variable we previously created.
        return view('posts.edit')->withPost($post)->withCategories($cats)->withTags($tags2);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //validate the data before using
        $post = Post::find($id);
        
        $this->validate($request, [
            'title' => 'required|max:255',
            'slug'  => "required|alpha_dash|min:5|max:255|unique:posts,slug,$id",
            //The $id up there serves a check for uniqueness, i.e validate anything other than itself.
            //works only with double quote for interpolation.
            'category_id' => 'required|integer',
            'body'  => 'required',
            'featured_image' => 'image'
        ]);
        
        // Save the data to the database
        $post = Post::find($id);
        //this is the big difference between store and update.
        //Here we use a variable to catch the post through the id
        //In store, we just form a new instance of the Post method, i.e $post = new Post

        $post->title = $request->input('title');
        $post->slug = $request->input('slug');
        $post->category_id = $request->input('category_id');
        $post->body = Purifier::clean($request->input('body'));

        if ($request->hasFile('featured_image'))
        {
            // Add the new photo
            $image = $request->file('featured_image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $location = public_path('images/' . $filename);
            Image::make($image)->resize(800, 400)->save($location);

            $oldFileName = $post->image;

            // Update the database
            $post->image = $filename;
            // Delte the old photo

            Storage::delete($oldFileName);
        }

        $post->save();

        if (isset($request->tags)){
            $post->tags()->sync($request->tags);
        } else {
            $post->tags()->sync(array());

            // Should in case no tags were added
            // sync is default set to true.
        }

        //Set flash data with success message
        Session::flash('success', 'This post was successfully updated!');
        // Redirect with flash data to pots.show
        return redirect()->route('posts.show', $post->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);

        $post->tags()->detach();

        Storage::delete($post->image);

        $post->delete();

        Session::flash('success', 'The post was successfully Deleted!');

        return redirect()->route('posts.index');
    }
}
