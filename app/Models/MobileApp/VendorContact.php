<?php

namespace App\Models\MobileApp;

use Illuminate\Database\Eloquent\Model;

class VendorContact extends Model
{
    protected $connection = 'mobile_app';

    protected $table = 'vendor_contacts';

    protected $guarded = [];
}
