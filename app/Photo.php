<?php

namespace Anuncia;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model {

    protected $table = 'images';

    protected $fillable = array('name', 'path', 'thumbnail_path', 'footbridge_id');

    public function footbridge()
    {

        return $this->belongsTo(Footbridges::class, 'footbridge_id');

    }

    public function scopeOfFootbridge($query, $footbridge)
    {

        return $query->where('footbridge_id', '=', $footbridge->id)
            ->orderBy('order', 'asc')
            ->get();
    }

    public function baseDir()

    {
        return 'images/footbridges';

    }

    public function setNameAttribute($name)

    {

        $this->attributes['name'] = $name;

        $this->path = $this->baseDir() . '/' . $name;

        $this->thumbnail_path = $this->baseDir() . '/tn-' . $name;

    }

    public function delete()
    {
        \File::delete([
            $this->path,
            $this->thumbnail_path
        ]);

        parent::delete();
    }

    public function scopeLast_image($query){
        $last = $query->max('id');
        return $last;
    }
}
