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
     * ---------------------------------------
     * ---      Scope       ---
     * ---------------------------------------
     */

    /**
     * Total Stock
     */
    public function scopeTotalStock()
    {
        $result = 0;
        $stocks = $this->stocks()->get();

        foreach ($stocks as $stock) {
            if ($stock->type == 1) {
                $result += $stock->qty;
            } else {
                $result -= $stock->qty;
            }
        }
        return $result;
    }
    /**
     * -------------------------------------------------
     *  ----    Relation    ----
     * -------------------------------------------------
     */

    /**
     * Multipal images
     */
    public function gallery()
    {
        return $this->hasMany('App\Models\Gallery', 'product_id', 'id')->orderBy('ordering', 'asc');
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

    /**
     * OrderItem
     */
    public function orderItem()
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * review
     */
    public function review()
    {
        return $this->hasMany(Review::class);
    }

    /**
     * Stock
     */
    public function stocks()
    {
        return $this->hasMany(Stock::class);
    }
}
