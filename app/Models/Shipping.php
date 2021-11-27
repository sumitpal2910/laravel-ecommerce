<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        "order_id",
        "state_id",
        "district_id",
        'name',
        'email',
        'phone',
        'alt_phone',
        'address',
        'city',
        'landmark',
        'pin_code',
        'notes',
    ];

    /**
     * -------------------------------------------------
     *  ----    Relation    ----
     * -------------------------------------------------
     */

    /**
     * State
     */
    public function state()
    {
        return $this->hasOne(ShipState::class);
    }

    /**
     * District
     */
    public function district()
    {
        return $this->hasOne(ShipDistrict::class);
    }
}
