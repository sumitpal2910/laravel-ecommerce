<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        "order_id",
        "product_id",
        "color",
        "size",
        "qty",
        "price",
    ];


    /**
     * -------------------------------------------------
     *  ----    Relation    ----
     * -------------------------------------------------
     */

    /**
     * Order
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
    
    /**
     * Product
     */
    
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
