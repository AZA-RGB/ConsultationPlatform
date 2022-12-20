<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use  \Illuminate\Database\Eloquent\Relations\BelongsTo;
class AvailableTime extends Model
{
    use HasFactory;
    protected $fillables=[
        'expert_id',
        'day',
        'from',
        'to',
    ];
    /**
     * Get the expert that owns the AvailableTime
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function expert(): BelongsTo
    {
        return $this->belongsTo(Expert::class, 'expert_id', 'id');
    }
    
}
