<?php

namespace App\Models;

use Database\Factories\WeatherFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Weather extends Model
{
    const UNIT_METRIC   = 'metric';
    const UNIT_IMPERIAL = 'imperial';
    const UNIT_DEFAULT  = 'default';

    use HasFactory;
    protected $table = 'weathers';
    protected $fillable = [
        'user_id',
        'temp',
        'unit',
        'pressure',
        'humidity',
    ];

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function factory(): Factory
    {
        return WeatherFactory::new();
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return string|null
     */
    protected function tempUnitHtmlCode(): Attribute
    {
        return Attribute::make(
            get: fn () => match ($this->unit) {
                $this::UNIT_METRIC => '&#8451;',
                self::UNIT_IMPERIAL => '&#8457;',
                self::UNIT_DEFAULT => '&#8490;',
                default => null,
            }
        );
    }
}
