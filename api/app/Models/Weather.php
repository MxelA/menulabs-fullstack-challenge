<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Weather extends Model
{
    use HasFactory;

    protected $fillable = [
        'temp',
        'temp_unit',
        'pressure',
        'humidity',
    ];

    /************
     * Relations
     ***********/

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
