<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class requesting extends Model
{
    use HasFactory;
    use HasUuids;

    protected $table = 'requesting';
    protected $primaryKey = 'id';

    protected $fillable = ['senderEmail',
                            'receiverEmail',
                            'status',
                            'created_at',
                            'updated_at',
                            'information_id',
                            'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(user::class, 'user_id');
    }
}
