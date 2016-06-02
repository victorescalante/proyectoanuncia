<?php

namespace Anuncia;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{

    /**
     * Database used by this model
     * @var string
     */
    protected $table = 'states';

    protected $fillable = [
        'name',
    ];
    

    public function municipalities(){

        return $this->hasMany(Municipality::class,'state_id');
    }
}
