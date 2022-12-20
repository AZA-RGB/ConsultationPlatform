<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\Relations\HasMany;

class Expert extends Model
{
    use HasFactory;
    protected $fillable=[
        'first_name',
        'last_name',
        'email',
        'password',
        'phone_numder',
        'balance',
        'address',
        'consultation',
        'experience',
        'exp_description',
        'consultation_price',
        'image_path',
    ];

    /**
     * Get all of the apointments for the Expert
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function apointments(): HasMany
    {
        return $this->hasMany(Appointment::class);
    }
    /**
     * Get all of the availableTimes for the Expert
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function availableTimes(): HasMany
    {
        return $this->hasMany(AvailableTime::class);
    }

    public function fullName()
    {
        return $this->first_name .' '. $this->last_name;
    }
}
