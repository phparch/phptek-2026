<?php

namespace App\Models\PhpTekTv;

use Illuminate\Database\Eloquent\Model;

class ShareIntent extends Model
{
    protected $connection = 'phptek_tv';

    protected $table = 'share_intents';

    protected $guarded = [];
}
