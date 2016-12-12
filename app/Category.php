<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
	// We really dont have to do this i think, but we want to tell laravel specifically the table to use
	// unlike others that we didnt, its because we followed the normal convention
	// which is singular for model name, while plural for table name, so laravel automatically finds the plural of it model
	// but just in case are we doing this below
    protected $table = 'categories';

    public function posts()
    {
    	// Many posts can belong to a specific category, so therefore, meaning the category has many posts
    	// Whih is why we use the hasMany relationship.
    	// It automatically relate with the category_id behind the scenes, which is what laravel does.
    	// This is what laravl calls a one to many relationship.
    	return $this->hasMany('App\Post');
    }
}
