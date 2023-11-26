<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestedInformation extends Model
{
    use HasFactory;

    protected $table = 'request_information';
    protected $primaryKey = 'ri_id';
    protected $fillable = ['enc_symkey',
                           'request_id',
    ];
}
