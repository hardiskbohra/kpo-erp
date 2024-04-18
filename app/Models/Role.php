<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    public $table = 'roles';
    protected $fillable = [
    	'role_name','role_desc'
    ];

    /**
    * hashmany users
    */
    public function users() {
        return $this->hasMany('App\Models\User', 'role_id');
    }
}