<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
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
        'icon'
    ];

    /**
     * -------------------------------------------------
     *  ----    Relation    ----
     * -------------------------------------------------
     */

    /**
     * SubCategory
     */
    public function subCategory()
    {
        return $this->hasMany('App\Models\SubCategory', 'category_id', 'id')->orderBy('name_en', 'asc');
    }

    /**
     * SubSubCategory
     */
    public function subSubCategory()
    {
        return $this->hasMany('App\Models\SubCategory', 'category_id', 'id')->orderBy('name_en', 'asc');
    }

    /** 
     * Product
     */
    public function products()
    {
        return $this->hasMany('App\Models\Product')->where('status', 1)->orderBy('name_en', 'asc');
    }
}
