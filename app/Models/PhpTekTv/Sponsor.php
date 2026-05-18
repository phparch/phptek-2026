<?php

namespace App\Models\PhpTekTv;

use Illuminate\Database\Eloquent\Model;

class Sponsor extends Model
{
    protected $connection = 'phptek_tv';

    protected $table = 'sponsors';

    protected $guarded = [];
}
