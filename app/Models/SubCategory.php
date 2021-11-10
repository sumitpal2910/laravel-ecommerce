<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'category_id',
        'name_en',
        'name_hin',
        'slug_en',
        'slug_hin',
    ];

    /**
     * -----------------------------------------------
     *  ----    Relation    ----
     * -----------------------------------------------
     */

    /**
     * Category
     */
    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    /**
     * Sub Sub Category
     */
    public function subSubCategory()
    {
        return $this->hasMany('App\Models\SubSubCategory', 'subcategory_id', 'id')->orderBy('name_en', 'asc');
    }

    /**
     * Sub Sub Category
     */
    public function products()
    {
        return $this->hasMany('App\Models\Product', 'subcategory_id', 'id')->where('status', 1)->orderBy('name_en', 'asc');
    }
}
