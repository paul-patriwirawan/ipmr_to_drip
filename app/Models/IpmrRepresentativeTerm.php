<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IpmrRepresentativeTerm extends Model
{
    protected $table = 'ipmr_representative_terms';

    protected $fillable = [
        'representative_id',
        'term',
        'status',
        'benefits_received',
        'date_of_selection',
        'coa_number',
        'date_issued',
        'end_of_term',
        'date_appointed',
        'source_of_funds',
        'other_source',
    ];

    protected function casts(): array
    {
        return [
            'date_of_selection' => 'date:Y-m-d',
            'date_issued' => 'date:Y-m-d',
            'end_of_term' => 'date:Y-m-d',
            'date_appointed' => 'date:Y-m-d',
        ];
    }
}
