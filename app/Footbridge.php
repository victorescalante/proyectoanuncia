<?php

namespace Anuncia;

use Illuminate\Database\Eloquent\Model;

class Footbridge extends Model
{
    /**
     * Database used by this model
     * @var string
     */
    protected $table = 'footbridges';

    protected $fillable = [
        'name', 'availability','municipality_id'
    ];

    public function images()
    {

        return $this->hasMany(Image::class, 'footbridge_id');
    }

    public function municipality()
    {

        return $this->belongsTo(Municipality::class, 'municipality_id');
    }
}
