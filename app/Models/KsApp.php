<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KsApp extends Model
{
    use HasFactory;
    use HasDateTimeFormatter;

    public $timestamps = null;
}
