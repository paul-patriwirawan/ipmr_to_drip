<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IpmrRepresentativeDocument extends Model
{
    protected $table = 'ipmr_representative_documents';

    protected $fillable = [
        'representative_id',
        'document_type',
        'document_name',
        'description',
        'attachment_path',
    ];
}