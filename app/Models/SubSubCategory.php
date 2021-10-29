<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubSubCategory extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'category_id',
        'subcategory_id',
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
        return $this->belongsTo('App\Models\Category', 'category_id', 'id');
    }

    /**
     * Sub Category
     */
    public function subCategory()
    {
        return $this->belongsTo('App\Models\SubCategory', 'subcategory_id', 'id');
    }
}
