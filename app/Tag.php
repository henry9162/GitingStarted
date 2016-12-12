<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public function posts()
    {
    	/*	
    		* Here if you do not follow the conventional way, the structure would look like this below;
    		* $this->belongsToMany('App\Post', 'post_tag', 'tag_id', 'post_id')
    		* tag_id, the column name for the current model, while post_id is the foreign key. 
    	*/
    	return $this->belongsToMany('App\Post');
    }
}
