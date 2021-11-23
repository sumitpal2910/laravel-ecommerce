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

    /**
     * Category
     */
    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    /**
     * Sub Category
     */
    public function subCategory()
    {
        return $this->belongsTo('App\Models\SubCategory', 'subcategory_id', 'id');
    }

    /**
     * Sub Sub Category
     */
    public function subSubCategory()
    {
        return $this->belongsTo('App\Models\SubSubCategory', 'sub_subcategory_id', 'id');
    }

    /**
     * Brand
     */
    public function brand()
    {
        return $this->belongsTo('App\Models\Brand');
    }
    
    /**
     * Wishlist
     */
    public function wishlist()
    {
        return $this->hasOne('App\Models\Wishlist');
    }
}
