<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;


class Event extends Model
{
    use HasFactory;
    use LogsActivity;

    public function getActivitylogOptions(): LogOptions
    {

        return LogOptions::defaults()
        ->setDescriptionForEvent(fn(string $eventName) => "This model has been {$eventName}")
        ->logOnly(['name'])
        ->useLogName('event');

        //return LogOptions::defaults()->logOnly(['name']);
        // Chain fluent methods for configuration options
    }

    protected $fillable = ['name', 'description', 'start_time', 'end_time', 'user_id'];

    public function user(): BelongsTo{
        return $this->belongsTo(User::class);
    }

    public function attendees(): HasMany{
        return $this->hasMany(Attendee::class);
    }

}
