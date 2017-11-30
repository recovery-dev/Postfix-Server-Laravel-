<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
class Task extends Model
{
    use Notifiable;
    use HasRoles;
       /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'task_name', 'status', 'description',
        'reservation_time', 'date', 'time',
        'from_equal', 'from_contains', 'from_start', 'from_end','from_regex',
        'recipient_equal','recipient_contains','recipient_start','recipient_end', 'recipient_regex',
        'subject_equal','subject_contains','subject_start','subject_end','subject_regex',
        'body_eqaul','body_contains','body_start','body_end','body_regex',
        'everyhour','everyday','everyweek','everymonth','everyyear'
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
