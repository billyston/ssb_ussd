<?php

declare(strict_types=1);

namespace Domain\Shared\Models\Session;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'user_inputs' => 'array',
        'user_data' => 'array',
    ];

    protected $fillable = [
        'id',
        'session_id',
        'msisdn',
        'phone_number',
        'sequence',
        'user_inputs',
        'user_data',
        'state',
    ];
}