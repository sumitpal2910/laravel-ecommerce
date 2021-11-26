<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShipSubDistrict extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'state_id',
        'district_id',
        'name'
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
        return $this->belongsTo(ShipState::class);
    }

    /**
     * District
     */
    public function district()
    {
        return $this->belongsTo(ShipDistrict::class);
    }

    /**
     * Block
     */
    public function block()
    {
        return $this->hasMany(ShipBlock::class);
    }
}
