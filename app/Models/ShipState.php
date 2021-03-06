<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShipState extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name'
    ];

    /**
     * -------------------------------------------------
     *  ----    Relation    ----
     * -------------------------------------------------
     */

    /**
     * District
     */
    public function district()
    {
        return $this->hasMany(ShipDistrict::class, "state_id", 'id');
    }

    /**
     * Order
     */
    public function order()
    {
        return $this->hasMany(Order::class, "state_id", "id");
    }
}
