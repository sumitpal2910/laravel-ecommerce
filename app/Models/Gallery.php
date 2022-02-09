<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
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
     *  ----    Scope    ----
     * -------------------------------------------------
     */



    /**
     * -------------------------------------------------
     *  ----    Relation    ----
     * -------------------------------------------------
     */

    /**
     * SubCategory
     */
    public function product()
    {
        return $this->belongsTo('App\Models\Product', 'product_id', 'id');
    }
}
