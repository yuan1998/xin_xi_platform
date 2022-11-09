<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OppoAccount extends Model
{
    use HasFactory;

    protected $fillable= [
        "username",
        "owner_id",
        "api_id",
        "api_key",
        "enable",
    ];

}
