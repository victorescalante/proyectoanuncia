<?php

namespace Anuncia;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';

    protected $fillable = array('title', 'description', 'extract','user_id');
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    
}
