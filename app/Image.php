<?php

namespace Anuncia;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $table = 'images';

    protected $fillable = array('name', 'url','footbridges_id');
}
