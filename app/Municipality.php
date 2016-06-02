<?php

namespace Anuncia;

use Illuminate\Database\Eloquent\Model;

class Municipality extends Model
{

    /**
     * Database used by this model
     * @var string
     */
    protected $table = 'municipalities';

    protected $fillable = [
        'state_id',
        'name',
    ];
    public function state(){
        return $this->belongsTo(State::class);
    }

    public function footbridges(){
        return $this->hasMany(Footbridge::class);
    }
}
