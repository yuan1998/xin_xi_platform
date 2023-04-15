<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JlApp extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'name',
        'app_id',
        'app_secret',
        'version',
    ];

    public static $VersionOptions = [
        '2' => 'v2版本',
        '3' => 'v3版本'
    ];

}
