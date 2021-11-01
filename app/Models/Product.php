<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are guarded
     *
     * @var string[]
     */
    protected $guarded = [];

    /**
     * -------------------------------------------------
     *  ----    Relation    ----
     * -------------------------------------------------
     */

    /**
     * Multipal images
     */
    public function multiImg()
    {
        return $this->hasMany('App\Models\MultiImg');
    }
}
