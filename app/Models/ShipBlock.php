<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShipBlock extends Model
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
        'sub_district_id',
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
     * Sub District
     */
    public function subDistrict()
    {
        return $this->belongsTo(ShipSubDistrict::class);
    }
}
