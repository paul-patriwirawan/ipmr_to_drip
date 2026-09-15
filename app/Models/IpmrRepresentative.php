<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class IpmrRepresentative extends Model
{
    use SoftDeletes;

    protected $table = 'drip_ipmr_representatives';

    protected $fillable = [
        'ipmr_id',
        'first_name',
        'middle_name',
        'last_name',
        'suffix',
        'sex',
        'ad_name',
        'ip_type',
        'ip_group',
        'complete_address',
        'contact_no',
        'email',
        'is_current',
        'birthdate',
        'image_path',
    ];

    protected function casts(): array
    {
        return [
            'is_current' => 'boolean',
            'birthdate' => 'date:Y-m-d',
        ];
    }
}
