<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShipDistrict extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'state_id'
    ];

    /**
     * -------------------------------------------------
     *  ----    Relation    ----
     * -------------------------------------------------
     */

    /**
     * Division
     */
    public function state()
    {
        return $this->belongsTo(ShipState::class);
    }

    /**
     * Sub District
     */
    public function subDistrict()
    {
        return $this->hasMany(ShipSubDistrict::class);
    }

    /**
     * Block
     */
    public function block()
    {
        return $this->hasMany(ShipBlock::class);
    }
}
