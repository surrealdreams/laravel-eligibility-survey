<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Survey extends Model
{
    use HasFactory;

    public function getRouteKeyName()
    {
        return 'uuid';
    }

    // This constant is used throughout the app to key to the Daily selection in the survey form
    const DAILY_LABEL = 'Daily';

    // Acceptable values for the headache_frequency field
    // Also used to generate the options for the survey.create select field
    const HEADACHE_FREQUENCY = array(
        'Monthly',
        'Weekly',
        self::DAILY_LABEL,
    );

    // Acceptable values for the daily_frequency field
    // Also used to generate the options for the survey.create select field
    const DAILY_FREQUENCY = array(
        '1-2',
        '3-4',
        '5+',
    );

    protected $fillable = [
        'first_name',
        'date_of_birth',
        'headache_frequency',
        'daily_frequency',
        'eligible',
        'cohort',
    ];

    public static function boot(): void
    {
        parent::boot();

        static::creating(function ($model) {
            // Auto set UUID
            $model->uuid = Str::uuid();
        });
    }
}
