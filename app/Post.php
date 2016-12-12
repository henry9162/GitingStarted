<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function category()
    {
    	return $this->belongsTo('App\Category');
    }

    public function tags()
    {
    	/*	
    		* This is called a many to many relationship which uses an intermediary/pivot table.
    		* Here we are trying to relate a post to many tags, and tags to many posts which makes it (many many!).
    		* The use of the intermediary table is to relate this two together in a many to many relationship.
    		* The name of the intermediary table is posts_tags, which is the laravel convenitional naming scheme. 
    		* the order of the table name is alphabetical, that is p before t.
    		* The column names are id, post_id, tag_id.
    		* In cases where we do not follow the normal naming convention, the belongsToMany must lok like this below,
    		* $this->belongToMany('App\Tag', posts_tags, post_id, tag_id), specifically in this order
    		* The post_id is the column name for the current model, while tag_id is the foreign key.
*/
    	return $this->belongsToMany('App\Tag');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }
}
