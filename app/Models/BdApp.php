<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BdApp extends Model
{
    use HasFactory;
    use HasDateTimeFormatter;

    static $VersionOptions = [
        1 => 'v1 版本'
    ];
}
