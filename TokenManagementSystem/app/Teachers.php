<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Teachers extends Model
{

	use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'tName', 'tEmail', //'tBranch',
    ];

    public function user(){

    	return $this->belongsTo(User::class, $foreignKey='tEmail', $ownerKey='email');

    }
}
