<?php

namespace App\Models\PhpTekTv;

use Illuminate\Database\Eloquent\Model;

class Conference extends Model
{
    protected $connection = 'phptek_tv';

    protected $table = 'conferences';

    protected $guarded = [];
}
