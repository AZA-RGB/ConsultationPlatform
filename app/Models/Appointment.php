<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\Relations\BelongsTo;
class Appointment extends Model
{
    use HasFactory;
    protected $fillable=[
        'expert_id',
        'user_id',
        'start_time',
        'end_time',
    ];
    /**
     * Get the user that owns the Appointment
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    /**
     * Get the expert that owns the Appointment
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function expert(): BelongsTo
    {
        return $this->belongsTo(Expert::class, 'expert_id', 'id');
    }
}
