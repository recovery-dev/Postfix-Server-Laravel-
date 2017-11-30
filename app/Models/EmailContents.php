<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmailContents extends Model
{
    use Notifiable;
	use HasRoles;
	
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'sender', 'receive_time', 'subject', 'body_text', 'body_html', 'sequence', 'status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    // protected $hidden = [
    //     'password', 'remember_token',
    // ];
}
