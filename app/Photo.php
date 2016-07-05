<?php

namespace Anuncia;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $table = 'images';

    protected $fillable = array('name', 'url','footbridge_id');

    public function footbridge(){

        return $this->belongsTo(Footbridges::class,'footbridge_id');

    }

    public function scopeOfFootbridge($query,$footbridge){

        return $query->where('footbridge_id','=',$footbridge->id)
            ->orderBy('order', 'asc')
            ->get();
    }
}
