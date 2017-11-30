<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Summary extends Model
{
    use Notifiable;
	use HasRoles;
	
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fqdn', 'username', 'password', 'port', 'protocol', 'folder_name'
    ];

}
