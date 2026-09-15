<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ipmr extends Model
{
    protected $table = 'drip_ipmr';

    protected $fillable = [
        'ancestral_domain_id',
        'level_of_representation',
        'governance_body',
        'position_type',
        'area_of_responsibility',
        'region_code',
        'province_code',
        'municipality_code',
        'barangay_code',
        'lgu_represented_name',
    ];
}
