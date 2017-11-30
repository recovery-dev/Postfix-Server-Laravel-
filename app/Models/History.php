<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    use Notifiable;
	use HasRoles;
	
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'status'
    ];

}
