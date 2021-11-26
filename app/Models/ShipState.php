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
        return $this->hasMany(ShipDistrict::class);
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
