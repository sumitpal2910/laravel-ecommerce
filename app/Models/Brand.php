<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name_en',
        'name_hin',
        'slug_en',
        'slug_hin',
        'image'
    ];


    /**
     * -------------------------------------------------
     *  ----    Relation    ----
     * -------------------------------------------------
     */

    /**
     * SubCategory
     */
    public function products()
    {
        return $this->hasMany('App\Models\Product')->where('status', 1)->orderBy('name_en', 'asc');
    }
}
