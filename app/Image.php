<?php

namespace Anuncia;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $table = 'images';

    protected $fillable = array('name', 'url','footbridge_id');

    public function footbridges(){

        return $this->belongsTo(Footbridges::class,'footbridge_id');

    }
}
