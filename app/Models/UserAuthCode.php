<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAuthCode extends Model
{
    use HasFactory;
    protected $table='user_auth_codes';
    protected $primaryKey='id';
    public $guarded=[];
}
